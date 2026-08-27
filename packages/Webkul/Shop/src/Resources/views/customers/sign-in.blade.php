<!-- SEO Meta Content -->
@push('meta')
    <meta name="title" content="@lang('shop::app.customers.login-form.page-title') | ELIOR" />
    <meta name="description" content="Sign in to your ELIOR botanical nutrition account to track orders, manage addresses, and view your wellness rituals." />
@endPush

<x-shop::layouts
    :has-header="true"
    :has-feature="false"
    :has-footer="true"
>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.login-form.page-title') | ELIOR
    </x-slot>

    <div class="bg-elior-cream min-h-[calc(100vh-80px)]">
        <main class="site-container py-12 sm:py-16">
            <!-- Form Container Card -->
            <div class="max-w-md mx-auto rounded-3xl border border-elior-border/80 bg-white p-8 sm:p-10 shadow-elior-subtle space-y-6">
                <!-- Header -->
                <div class="space-y-2 text-center">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#EBF3EE] text-elior-botanical text-[10px] sm:text-xs font-semibold tracking-widest uppercase">
                        <span><span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">eco</span></span>
                        <span>Account Access</span>
                    </div>

                    <h1 class="font-serif text-3xl sm:text-4xl font-bold tracking-tight text-elior-charcoal">
                        @lang('shop::app.customers.login-form.page-title')
                    </h1>

                    <p class="text-xs sm:text-sm text-elior-muted leading-relaxed">
                        @lang('shop::app.customers.login-form.form-login-text')
                    </p>
                </div>

                {!! view_render_event('bagisto.shop.customers.login.before') !!}

                <!-- Login Form -->
                <x-shop::form :action="route('shop.customer.session.create')">
                    {!! view_render_event('bagisto.shop.customers.login_form_controls.before') !!}

                    <div class="space-y-4">
                        <!-- Email -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required text-xs font-semibold uppercase tracking-wider text-elior-charcoal">
                                @lang('shop::app.customers.login-form.email')
                            </x-shop::form.control-group.label>

                            <x-shop::form.control-group.control
                                type="email"
                                class="rounded-xl border border-elior-border bg-white px-4 py-3 text-sm text-elior-charcoal focus:border-elior-botanical focus:ring-elior-botanical"
                                name="email"
                                rules="required|email"
                                value=""
                                :label="trans('shop::app.customers.login-form.email')"
                                placeholder="email@example.com"
                                :aria-label="trans('shop::app.customers.login-form.email')"
                                aria-required="true"
                            />

                            <x-shop::form.control-group.error control-name="email" />
                        </x-shop::form.control-group>

                        <!-- Password -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required text-xs font-semibold uppercase tracking-wider text-elior-charcoal">
                                @lang('shop::app.customers.login-form.password')
                            </x-shop::form.control-group.label>

                            <x-shop::form.control-group.control
                                type="password"
                                class="rounded-xl border border-elior-border bg-white px-4 py-3 text-sm text-elior-charcoal focus:border-elior-botanical focus:ring-elior-botanical"
                                id="password"
                                name="password"
                                rules="required|min:6"
                                value=""
                                :label="trans('shop::app.customers.login-form.password')"
                                :placeholder="trans('shop::app.customers.login-form.password')"
                                :aria-label="trans('shop::app.customers.login-form.password')"
                                aria-required="true"
                            />

                            <x-shop::form.control-group.error control-name="password" />
                        </x-shop::form.control-group>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between text-xs pt-1">
                            <div class="flex items-center gap-2">
                                <input
                                    type="checkbox"
                                    name="remember"
                                    id="remember"
                                    class="h-4 w-4 rounded border-elior-border text-elior-botanical focus:ring-elior-botanical cursor-pointer"
                                >
                                <label for="remember" class="text-elior-slate cursor-pointer select-none">
                                    Remember me
                                </label>
                            </div>

                            <a
                                href="{{ route('shop.customers.forgot_password.create') }}"
                                class="text-elior-botanical hover:text-elior-botanicalDark font-semibold transition-colors"
                            >
                                @lang('shop::app.customers.login-form.forgot-pass')
                            </a>
                        </div>

                        <!-- Captcha if configured -->
                        @if (core()->getConfigData('customer.captcha.credentials.status'))
                            <x-shop::form.control-group class="mt-4">
                                {!! \Webkul\Customer\Facades\Captcha::render() !!}
                                <x-shop::form.control-group.error control-name="recaptcha_token" />
                            </x-shop::form.control-group>
                        @endif

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button
                                class="elior-btn-primary h-12 w-full text-xs uppercase tracking-widest font-semibold flex items-center justify-center gap-2 shadow-elior-card"
                                type="submit"
                            >
                                <span>@lang('shop::app.customers.login-form.button-title')</span>
                                <span class="icon-arrow-right text-xs"></span>
                            </button>
                        </div>
                    </div>

                    {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}
                </x-shop::form>

                {!! view_render_event('bagisto.shop.customers.login.after') !!}

                <!-- Sign Up Link -->
                <div class="pt-4 border-t border-elior-border/60 text-center text-xs text-elior-muted">
                    <span>@lang('shop::app.customers.login-form.new-customer')</span>
                    <a
                        href="{{ route('shop.customers.register.index') }}"
                        class="ml-1 text-elior-botanical hover:text-elior-botanicalDark font-semibold transition-colors"
                    >
                        @lang('shop::app.customers.login-form.create-your-account')
                    </a>
                </div>
            </div>
        </main>
    </div>
</x-shop::layouts>
