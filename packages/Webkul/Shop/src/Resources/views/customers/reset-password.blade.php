<!-- SEO Meta Content -->
@push('meta')
    <meta name="title" content="@lang('shop::app.customers.reset-password.title') | ELIOR" />
    <meta name="description" content="Set a new password for your ELIOR botanical nutrition account." />
@endPush

<x-shop::layouts
    :has-header="true"
    :has-feature="false"
    :has-footer="true"
>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.reset-password.title') | ELIOR
    </x-slot>

    <div class="bg-elior-cream min-h-[calc(100vh-80px)]">
        <main class="site-container py-12 sm:py-16">
            <!-- Form Container Card -->
            <div class="max-w-md mx-auto rounded-3xl border border-elior-border/80 bg-white p-8 sm:p-10 shadow-elior-subtle space-y-6">
                <!-- Header -->
                <div class="space-y-2 text-center">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#EBF3EE] text-elior-botanical text-[10px] sm:text-xs font-semibold tracking-widest uppercase">
                        <span><span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">eco</span></span>
                        <span>New Password</span>
                    </div>

                    <h1 class="font-serif text-3xl sm:text-4xl font-bold tracking-tight text-elior-charcoal">
                        @lang('shop::app.customers.reset-password.title')
                    </h1>
                </div>

                {!! view_render_event('bagisto.shop.customers.reset_password.before') !!}

                <!-- Reset Password Form -->
                <x-shop::form :action="route('shop.customers.reset_password.store')">
                    <x-shop::form.control-group.control
                        type="hidden"
                        name="token"
                        :value="$token"
                    />

                    {!! view_render_event('bagisto.shop.customers.reset_password_form_controls.before') !!}

                    <div class="space-y-4">
                        <!-- Email -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required text-xs font-semibold uppercase tracking-wider text-elior-charcoal">
                                @lang('shop::app.customers.reset-password.email')
                            </x-shop::form.control-group.label>

                            <x-shop::form.control-group.control
                                type="email"
                                class="rounded-xl border border-elior-border bg-white px-4 py-3 text-sm text-elior-charcoal focus:border-elior-botanical focus:ring-elior-botanical"
                                id="email"
                                name="email"
                                rules="required|email"
                                :value="old('email')"
                                :label="trans('shop::app.customers.reset-password.email')"
                                placeholder="email@example.com"
                                :aria-label="trans('shop::app.customers.reset-password.email')"
                                aria-required="true"
                            />

                            <x-shop::form.control-group.error control-name="email" />
                        </x-shop::form.control-group>

                        <!-- Password -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required text-xs font-semibold uppercase tracking-wider text-elior-charcoal">
                                @lang('shop::app.customers.reset-password.password')
                            </x-shop::form.control-group.label>

                            <x-shop::form.control-group.control
                                type="password"
                                class="rounded-xl border border-elior-border bg-white px-4 py-3 text-sm text-elior-charcoal focus:border-elior-botanical focus:ring-elior-botanical"
                                name="password"
                                rules="required|min:6"
                                value=""
                                :label="trans('shop::app.customers.reset-password.password')"
                                :placeholder="trans('shop::app.customers.reset-password.password')"
                                ref="password"
                                :aria-label="trans('shop::app.customers.reset-password.password')"
                                aria-required="true"
                            />

                            <x-shop::form.control-group.error control-name="password" />
                        </x-shop::form.control-group>

                        <!-- Confirm Password -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required text-xs font-semibold uppercase tracking-wider text-elior-charcoal">
                                @lang('shop::app.customers.reset-password.confirm-password')
                            </x-shop::form.control-group.label>

                            <x-shop::form.control-group.control
                                type="password"
                                class="rounded-xl border border-elior-border bg-white px-4 py-3 text-sm text-elior-charcoal focus:border-elior-botanical focus:ring-elior-botanical"
                                name="password_confirmation"
                                rules="confirmed:@password"
                                value=""
                                :label="trans('shop::app.customers.reset-password.confirm-password')"
                                :placeholder="trans('shop::app.customers.reset-password.confirm-password')"
                                :aria-label="trans('shop::app.customers.reset-password.confirm-password')"
                                aria-required="true"
                            />

                            <x-shop::form.control-group.error control-name="password_confirmation" />
                        </x-shop::form.control-group>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button
                                class="elior-btn-primary h-12 w-full text-xs uppercase tracking-widest font-semibold flex items-center justify-center gap-2 shadow-elior-card"
                                type="submit"
                            >
                                <span>@lang('shop::app.customers.reset-password.submit-btn-title')</span>
                                <span class="icon-arrow-right text-xs"></span>
                            </button>
                        </div>
                    </div>

                    {!! view_render_event('bagisto.shop.customers.reset_password_form_controls.after') !!}
                </x-shop::form>

                {!! view_render_event('bagisto.shop.customers.reset_password.after') !!}
            </div>
        </main>
    </div>
</x-shop::layouts>
