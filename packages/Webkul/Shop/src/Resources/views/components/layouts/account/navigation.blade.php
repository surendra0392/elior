@php
    $customer = auth()->guard('customer')->user();
@endphp

<div class="w-full lg:w-[300px] xl:w-[320px] shrink-0 space-y-6">
    <!-- Account Profile Card -->
    <div class="rounded-3xl border border-elior-border/80 bg-white p-6 shadow-elior-subtle space-y-4">
        <div class="flex items-center gap-4">
            <div class="shrink-0 w-12 h-12 rounded-full bg-[#EBF3EE] border border-elior-botanical/30 flex items-center justify-center text-elior-botanical font-serif font-bold text-lg">
                {{ strtoupper(substr($customer->first_name ?? 'E', 0, 1)) }}
            </div>

            <div class="min-w-0" v-pre>
                <div class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-[#EBF3EE] text-elior-botanical text-[9px] font-semibold tracking-wider uppercase">
                    <span><span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">eco</span></span>
                    <span>Account</span>
                </div>
                <h3 class="font-serif text-base font-bold text-elior-charcoal truncate mt-0.5">
                    {{ $customer->first_name }} {{ $customer->last_name }}
                </h3>
                <p class="text-xs text-elior-muted truncate">
                    {{ $customer->email }}
                </p>
            </div>
        </div>

        <!-- Account Navigation Menu -->
        <nav class="pt-4 border-t border-elior-border/60 space-y-1">
            @foreach (menu()->getItems('customer') as $menuItem)
                @if ($menuItem->haveChildren())
                    @foreach ($menuItem->getChildren() as $subMenuItem)
                        <a
                            href="{{ $subMenuItem->getUrl() }}"
                            class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs uppercase tracking-wider font-semibold transition-all {{ $subMenuItem->isActive() ? 'bg-[#FAF8F5] text-elior-botanical font-bold border border-elior-botanical/40 shadow-xs' : 'text-elior-charcoal hover:bg-[#FAF8F5] hover:text-elior-botanical' }}"
                        >
                            <span class="flex items-center gap-3">
                                <span class="{{ $subMenuItem->getIcon() }} text-base text-elior-botanical"></span>
                                <span>{{ $subMenuItem->getName() }}</span>
                            </span>

                            <span class="icon-arrow-right text-xs opacity-60"></span>
                        </a>
                    @endforeach
                @endif
            @endforeach
        </nav>

        <!-- Logout Action -->
        <div class="pt-4 border-t border-elior-border/60">
            <x-shop::form
                method="DELETE"
                action="{{ route('shop.customer.session.destroy') }}"
                id="customerLogoutNav"
            />

            <button
                type="button"
                class="elior-btn-outline h-10 w-full text-xs uppercase tracking-widest font-semibold flex items-center justify-center gap-2"
                onclick="event.preventDefault(); document.getElementById('customerLogoutNav').submit();"
            >
                <span class="icon-logout text-sm"></span>
                <span>@lang('shop::app.components.layouts.header.desktop.bottom.logout')</span>
            </button>
        </div>
    </div>
</div>