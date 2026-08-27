<!-- SEO Meta Content -->
@push('meta')
    <meta name="title" content="@lang('shop::app.customers.forgot-password.title') | ELIOR" />
    <meta name="description" content="Reset your ELIOR account password securely to regain access to your orders and account settings." />
@endPush

<x-shop::layouts
    :has-header="true"
    :has-feature="false"
    :has-footer="true"
>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.forgot-password.title') | ELIOR
    </x-slot>

    <div class="bg-elior-cream min-h-[calc(100vh-80px)]">
        <main class="site-container py-12 sm:py-16">
            <!-- Form Container Card -->
            <div class="max-w-md mx-auto rounded-3xl border border-elior-border/80 bg-white p-8 sm:p-10 shadow-elior-subtle space-y-6">
                <!-- Header -->
                <div class="space-y-2 text-center">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#EBF3EE] text-elior-botanical text-[10px] sm:text-xs font-semibold tracking-widest uppercase">
                        <span><span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;">eco</span></span>
                        <span>Account Recovery</span>
                    </div>

                    <h1 class="font-serif text-3xl sm:text-4xl font-bold tracking-tight text-elior-charcoal">
                        @lang('shop::app.customers.forgot-password.title')
                    </h1>

                    <p class="text-xs sm:text-sm text-elior-muted leading-relaxed">
                        @lang('shop::app.customers.forgot-password.forgot-password-text')
                    </p>
                </div>

                {!! view_render_event('bagisto.shop.customers.forget_password.before') !!}

                <!-- Forgot Password Form -->
                <x-shop::form :action="route('shop.customers.forgot_password.store')">
                    {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.before') !!}

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
                                <span>@lang('shop::app.customers.forgot-password.submit')</span>
                                <span class="icon-arrow-right text-xs"></span>
                            </button>
                        </div>
                    </div>

                    {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.email.after') !!}
                </x-shop::form>

                {!! view_render_event('bagisto.shop.customers.forget_password.after') !!}

                <!-- Back to Sign In Link -->
                <div class="pt-4 border-t border-elior-border/60 text-center text-xs text-elior-muted">
                    <a
                        href="{{ route('shop.customer.session.index') }}"
                        class="text-elior-botanical hover:text-elior-botanicalDark font-semibold transition-colors inline-flex items-center gap-1.5"
                    >
                        <span class="icon-arrow-left text-xs"></span>
                        <span>@lang('shop::app.customers.forgot-password.back')</span>
                    </a>
                </div>
            </div>
        </main>
    </div>
</x-shop::layouts>
