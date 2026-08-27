<x-admin::layouts>
    <!-- Title of the page -->
    <x-slot:title>
        @lang('admin::app.configuration.index.title')
    </x-slot>

    @php
        /**
         * Helper icon mapping for all system configuration items.
         * Returns modern, crisp SVG icon paths and styling.
         */
        $getSectionIcon = function($fullKey) {
            return match($fullKey) {
                'general.general' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>',
                'general.content' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>',
                'general.design' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="13.5" cy="6.5" r=".5" fill="currentColor"/><circle cx="17.5" cy="10.5" r=".5" fill="currentColor"/><circle cx="8.5" cy="7.5" r=".5" fill="currentColor"/><circle cx="6.5" cy="12.5" r=".5" fill="currentColor"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.563-2.512 5.563-5.563C22 6.5 17.5 2 12 2z"/></svg>',
                'general.exchange_rates' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m16 3 4 4-4 4"/><path d="M20 7H4"/><path d="m8 21-4-4 4-4"/><path d="M4 17h16"/></svg>',
                'general.sitemap' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect width="6" height="6" x="9" y="2" rx="1"/><rect width="6" height="6" x="2" y="16" rx="1"/><rect width="6" height="6" x="16" y="16" rx="1"/><path d="M5 16v-3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3"/><path d="M12 12V8"/></svg>',
                'general.gdpr' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>',
                'magic_ai.general' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/><path d="M5 3v4"/><path d="M19 17v4"/><path d="M3 5h4"/><path d="M17 19h4"/></svg>',
                'magic_ai.providers' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect width="16" height="16" x="4" y="4" rx="2"/><rect width="6" height="6" x="9" y="9" rx="1"/><path d="M15 2v2"/><path d="M15 20v2"/><path d="M2 15h2"/><path d="M2 9h2"/><path d="M20 15h2"/><path d="M20 9h2"/><path d="M9 2v2"/><path d="M9 20v2"/></svg>',
                'magic_ai.admin_features' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>',
                'magic_ai.storefront_features' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"/><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"/><path d="M2 7h20"/><path d="M12 7v5"/></svg>',
                'catalog.products' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>',
                'catalog.rich_snippets' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>',
                'catalog.inventory' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>',
                'customer.address' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>',
                'customer.captcha' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',
                'customer.settings' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
                'emails.configure' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>',
                'emails.general' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>',
                'sales.shipping' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>',
                'sales.shipping_zones' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>',
                'sales.payment_methods' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>',
                'sales.order_settings' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>',
                'sales.invoice_settings' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>',
                'sales.taxes' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="19" x2="5" y1="5" y2="19"/><circle cx="6.5" cy="6.5" r="2.5"/><circle cx="17.5" cy="17.5" r="2.5"/></svg>',
                'sales.checkout' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>',
                'sales.rma' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>',
                'sales.eu_withdrawal' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m16 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/><path d="m2 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/><path d="M7 21h10"/><path d="M12 3v18"/><path d="M3 7h2c2 0 5-1 7-2 2 1 5 2 7 2h2"/></svg>',
                'cache_management.general' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>',
                default => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>'
            };
        };

        $getSectionSubtitle = function($item) {
            $key = $item->getKey();
            return match($key) {
                'general' => 'Store defaults, localization, branding, and compliance.',
                'magic_ai' => 'AI models, prompts, automations, and intelligent features.',
                'catalog' => 'Products display, rich snippets, and stock rules.',
                'customer' => 'Customer profiles, authentication, captchas, and addresses.',
                'emails' => 'SMTP mail transport, notifications, and customer alerts.',
                'sales' => 'Payment gateways, shipping methods, taxes, and checkout.',
                'cache_management' => 'System performance, route caches, and view compilers.',
                default => $item->getInfo() !== $item->getName() ? $item->getInfo() : 'Manage configuration settings and options.'
            };
        };
    @endphp

    <!-- Heading & Search Bar -->
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                @lang('admin::app.configuration.index.title')
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Manage global store settings, service integrations, and system parameters.
            </p>
        </div>

        <!-- Configuration Search Bar Vue Component -->
        <v-configuration-search>
            <div class="relative flex w-full sm:w-[380px] lg:w-[440px] items-center">
                <i class="icon-search pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-lg text-slate-400"></i>

                <input
                    type="text"
                    class="block w-full rounded-[12px] border border-slate-200 bg-white py-2 pl-10 pr-4 text-sm text-slate-800 placeholder:text-slate-400 transition-all hover:border-slate-300 focus:border-[#205132] focus:ring-2 focus:ring-[#205132]/20 shadow-xs"
                    placeholder="@lang('admin::app.configuration.index.search')"
                >
            </div>
        </v-configuration-search>
    </div>

    <!-- Page Content Sections -->
    <div class="space-y-10">
        @foreach (system_config()->getItems() as $item)
            @php
                $children = $item->getChildren();
                $childCount = count($children);
            @endphp

            <div class="space-y-4">
                <!-- Section Header -->
                <div class="flex items-center justify-between border-b border-slate-200/80 pb-3">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#205132]/10 text-[#205132] font-semibold text-xs shadow-xs">
                            {{ substr($item->getName(), 0, 2) }}
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-slate-900 tracking-tight">
                                {{ $item->getName() }}
                            </h2>
                            <p class="text-xs text-slate-500">
                                {{ $getSectionSubtitle($item) }}
                            </p>
                        </div>
                    </div>

                    <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-semibold text-slate-600 border border-slate-200">
                        {{ $childCount }} {{ $childCount === 1 ? 'module' : 'modules' }}
                    </span>
                </div>

                <!-- Section Cards Grid -->
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($children as $key => $child)
                        @php
                            $routePath = $item->getKey() . '/' . $key;
                            $fullKey = $item->getKey() . '.' . $key;
                            $url = $routePath === 'sales/shipping_zones' 
                                ? route('admin.settings.shipping.zones.index') 
                                : route('admin.configuration.index', $routePath);
                        @endphp

                        <a
                            href="{{ $url }}"
                            class="group relative flex flex-col justify-between rounded-[16px] border border-slate-200/90 bg-white p-5 shadow-xs transition-all duration-200 hover:-translate-y-0.5 hover:border-[#205132]/40 hover:shadow-md hover:shadow-[#205132]/5 hover:bg-slate-50/40 cursor-pointer"
                        >
                            <div>
                                <!-- Top Row: Icon Badge & Direction Indicator -->
                                <div class="flex items-start justify-between">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-[12px] bg-[#205132]/[0.08] text-[#205132] transition-all duration-200 group-hover:bg-[#205132] group-hover:text-white group-hover:shadow-sm">
                                        {!! $getSectionIcon($fullKey) !!}
                                    </div>

                                    <div class="flex h-7 w-7 items-center justify-center rounded-full text-slate-300 transition-all duration-200 group-hover:translate-x-0.5 group-hover:text-[#205132] group-hover:bg-[#205132]/10">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="9 18 15 12 9 6"></polyline>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Card Content -->
                                <div class="mt-4">
                                    <h3 class="text-[15px] font-semibold tracking-tight text-slate-900 transition-colors duration-200 group-hover:text-[#205132] leading-snug">
                                        {{ $child->getName() }}
                                    </h3>

                                    <p class="mt-1.5 text-xs leading-relaxed text-slate-500 line-clamp-2">
                                        {{ $child->getInfo() }}
                                    </p>
                                </div>
                            </div>

                            <!-- Bottom Status / Tagline indicator -->
                            <div class="mt-4 flex items-center gap-1.5 pt-3 border-t border-slate-100 text-[11px] font-medium text-slate-400 group-hover:text-[#205132] transition-colors">
                                <span>Configure</span>
                                <span class="text-xs">→</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    @pushOnce('scripts')
        <script type="text/x-template" id="v-configuration-search-template">
            <div class="relative flex w-full sm:w-[380px] lg:w-[440px] items-center">
                <i class="icon-search pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-lg text-slate-400"></i>

                <input
                    type="text"
                    class="peer block w-full rounded-[12px] border border-slate-200 bg-white py-2 pl-10 pr-4 text-sm text-slate-800 placeholder:text-slate-400 transition-all hover:border-slate-300 focus:border-[#205132] focus:ring-2 focus:ring-[#205132]/20 shadow-xs"
                    :class="{'border-[#205132] ring-2 ring-[#205132]/20': isDropdownOpen}"
                    placeholder="@lang('admin::app.configuration.index.search')"
                    v-model.lazy="searchTerm"
                    @click="searchTerm.length >= 2 ? isDropdownOpen = true : {}"
                    v-debounce="500"
                >

                <div
                    class="absolute top-12 z-50 w-full rounded-[14px] border border-slate-200 bg-white p-1.5 shadow-xl"
                    v-if="isDropdownOpen"
                >
                    <template v-if="isLoading">
                        <x-admin::shimmer.header.mega-search.categories />
                    </template>

                    <template v-else>
                        <div class="grid max-h-[360px] overflow-y-auto journal-scroll">
                            <a
                                :href="category.url"
                                class="flex items-center justify-between rounded-lg px-3.5 py-2.5 text-sm font-medium text-slate-700 hover:bg-[#205132]/10 hover:text-[#205132] transition-all"
                                v-for="category in searchedResults.data"
                            >
                                <span>@{{ category.title }}</span>
                                <span class="text-xs text-slate-400">→</span>
                            </a>

                            <div
                                class="p-4 text-center text-sm font-medium text-slate-500"
                                v-if="searchedResults.data.length === 0"
                            >
                                @lang('admin::app.configuration.index.no-result-found')
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </script>

        <script type="module">
            app.component('v-configuration-search', {
                template: '#v-configuration-search-template',

                data() {
                    return {
                        isDropdownOpen: false,

                        isLoading: false,

                        searchTerm: '',

                        searchedResults: [],
                    };
                },

                watch: {
                    searchTerm(newVal, oldVal) {
                        this.search();
                    },
                },

                created() {
                    window.addEventListener('click', this.handleFocusOut);
                },

                beforeDestroy() {
                    window.removeEventListener('click', this.handleFocusOut);
                },

                methods: {
                    search() {
                        if (this.searchTerm.length <= 1) {
                            this.searchedResults = [];

                            this.isDropdownOpen = false;

                            return;
                        }

                        this.isDropdownOpen = true;

                        this.isLoading = true;

                        this.$axios.get("{{ route('admin.configuration.search') }}", {
                                params: {query: this.searchTerm}
                            })
                            .then((response) => {
                                this.searchedResults = response.data;

                                this.isLoading = false;
                            })
                            .catch((error) => {});
                    },

                    handleFocusOut(e) {
                        if (! this.$el.contains(e.target)) {
                            this.isDropdownOpen = false;
                        }
                    },
                },
            });
        </script>
    @endpushOnce
</x-admin::layouts>
