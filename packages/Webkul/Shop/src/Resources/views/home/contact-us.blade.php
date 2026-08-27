<!-- Page Layout -->
<x-shop::layouts>
    <!-- Page Title -->
    <x-slot:title>
        Contact ELIOR | Botanical Nutrition, Care & Wholesale Inquiries
    </x-slot>

    @inject('themeCustomizationRepository', 'Webkul\Theme\Repositories\ThemeCustomizationRepository')

    @php
        $channel = core()->getCurrentChannel();
        $contactEmail = core()->getConfigData('emails.configure.email_settings.contact_email') ?: 'care@elior.in';
        $adminEmail = core()->getConfigData('emails.configure.email_settings.admin_email') ?: 'wholesale@elior.in';
        $address = core()->getConfigData('sales.shipping.origin.address') ?: (core()->getConfigData('sales.shipping.origin.address1') ?: 'Plot 42, Road No. 36, Jubilee Hills');
        $city = core()->getConfigData('sales.shipping.origin.city') ?: 'Hyderabad';
        $state = core()->getConfigData('sales.shipping.origin.state') ?: 'Telangana';
        $zipcode = core()->getConfigData('sales.shipping.origin.zipcode') ?: '500033';
        $country = core()->getConfigData('sales.shipping.origin.country') === 'IN' ? 'India' : (core()->getConfigData('sales.shipping.origin.country') ?: 'India');

        $customization = $themeCustomizationRepository->findOneWhere([
            'type'       => 'footer_links',
            'status'     => 1,
            'theme_code' => $channel->theme,
            'channel_id' => $channel->id,
        ]);

        $socialLinks = $customization->options['social_links'] ?? [
            'instagram' => 'https://instagram.com/elior.botanicals',
            'youtube'   => 'https://youtube.com/@eliorbotanicals',
            'linkedin'  => 'https://linkedin.com/company/elior-nutrition',
            'twitter'   => 'https://twitter.com/elior_botanicals',
            'facebook'  => 'https://facebook.com/eliorbotanicals',
        ];
    @endphp

    @push('meta')
        <meta name="title" content="Contact ELIOR | Botanical Care, Wholesale & Batch Support" />
        <meta name="description" content="Connect with the ELIOR botanical care team for cold-dehydrated powder inquiries, daily ritual guidance, batch test reports, and wholesale partnerships." />
        <meta name="keywords" content="contact elior, botanical nutrition support, wholesale superfoods, batch test report, elior customer care, clean label support, ELIOR" />

        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="Contact ELIOR | Botanical Care, Wholesale & Batch Support" />
        <meta name="twitter:description" content="Connect with the ELIOR botanical care team for cold-dehydrated powder inquiries, daily ritual guidance, batch test reports, and wholesale partnerships." />

        <meta property="og:type" content="website" />
        <meta property="og:title" content="Contact ELIOR | Botanical Care, Wholesale & Batch Support" />
        <meta property="og:description" content="Connect with the ELIOR botanical care team for cold-dehydrated powder inquiries, daily ritual guidance, batch test reports, and wholesale partnerships." />
        <meta property="og:url" content="{{ route('shop.home.contact_us') }}" />

        <!-- JSON-LD ContactPage & FAQPage Schema -->
        <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@graph'   => [
                [
                    '@type'       => 'ContactPage',
                    '@id'         => route('shop.home.contact_us') . '/#contactpage',
                    'url'         => route('shop.home.contact_us'),
                    'name'        => 'Contact ELIOR Botanical Care',
                    'description' => 'Connect with the ELIOR botanical nutrition team for batch test queries, recipes, wholesale, and fulfillment.',
                    'mainEntity'  => [
                        '@type'     => 'Organization',
                        'name'      => 'ELIOR Botanical Nutrition',
                        'telephone' => '+91-98765-43210',
                        'email'     => $contactEmail,
                        'address'   => [
                            '@type'           => 'PostalAddress',
                            'streetAddress'   => $address,
                            'addressLocality' => $city,
                            'addressRegion'   => $state,
                            'postalCode'      => $zipcode,
                            'addressCountry'  => $country,
                        ],
                    ],
                ],
                [
                    '@type'      => 'FAQPage',
                    '@id'        => route('shop.home.contact_us') . '/#faq',
                    'mainEntity' => [
                        [
                            '@type'          => 'Question',
                            'name'           => 'How does ELIOR ensure low-temperature nutritional preservation?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text'  => 'We operate proprietary closed-loop cold dehydration chambers below 42°C. This prevents thermal degradation, preserving 94%+ heat-sensitive chlorophyll, antioxidants, polyphenols, and active botanical enzymes without sulfur dioxide or chemical drying agents.',
                            ],
                        ],
                        [
                            '@type'          => 'Question',
                            'name'           => 'Where can I find ICP-MS heavy metal and pesticide test records?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text'  => 'Every production run is tested via NABL-accredited ISO/IEC 17025 laboratories. Batch test reports verifying lead, mercury, arsenic, cadmium, microbiological safety, and 200+ multi-pesticide screens can be requested directly by emailing your batch code to care@elior.in.',
                            ],
                        ],
                        [
                            '@type'          => 'Question',
                            'name'           => 'How should ELIOR dehydrated powders be stored for maximum freshness?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text'  => 'Store sealed within our multi-layer, nitrogen-flushed UV-barrier pouches or jars away from direct sunlight, humidity, and heat sources. Once opened, ensure the air-tight closure is pressed firmly.',
                            ],
                        ],
                        [
                            '@type'          => 'Question',
                            'name'           => 'What are your order dispatch and pan-India shipping timelines?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text'  => 'Orders placed before 2:00 PM IST Monday through Saturday are dispatched the same day from our certified facility. Standard air-express transit takes 2–4 business days across major metros and 3–5 business days for regional pin codes.',
                            ],
                        ],
                        [
                            '@type'          => 'Question',
                            'name'           => 'Do you offer wholesale, bulk ingredient supply, or clinical partnerships?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text'  => 'Yes. We partner with functional beverage formulators, Ayurveda practitioners, clean bakeries, and gourmet culinary studios with certified bulk packaging (5kg to 25kg) with full COA documentation. Contact wholesale@elior.in.',
                            ],
                        ],
                    ],
                ],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
        </script>
    @endPush

    <div class="bg-[#f4f0e6] min-h-screen text-[#163923]">
        @if (core()->getConfigData('general.general.breadcrumbs.shop'))
            <!-- Breadcrumbs Navigation -->
            <div class="site-container pt-5 pb-2 sm:pt-7 sm:pb-3">
                <nav aria-label="Breadcrumb" class="flex items-center space-x-2 text-[11px] sm:text-xs uppercase tracking-[0.18em] text-[#677a6d]">
                    <a href="{{ route('shop.home.index') }}" class="hover:text-[#205132] transition-colors">Home</a>
                    <span class="text-[#c9a25a] font-serif">/</span>
                    <span class="text-[#163923] font-semibold">Contact Care</span>
                </nav>
            </div>
        @endif

        <!-- SECTION 1: EDITORIAL HERO & HEADER -->
        <section class="site-container pt-6 pb-12 sm:pt-10 sm:pb-16 border-b border-[#e5decb]">
            <div class="max-w-3xl mx-auto text-center space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#e8f2ec] text-[#205132] text-xs font-semibold tracking-[0.2em] uppercase border border-[#205132]/20">
                    <span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">spa</span>
                    <span>Direct Botanical Support</span>
                </div>

                <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#163923] leading-[1.15]">
                    We're Here to Assist Your Ritual.
                </h1>

                <p class="text-sm sm:text-base lg:text-lg text-[#677a6d] leading-relaxed font-sans max-w-2xl mx-auto">
                    Have questions regarding cold-dehydrated formulations, batch test certificates (COA), dosage rituals, or wholesale partnerships? Our botanical specialists are here to help.
                </p>

                <!-- Quick SLA Highlight Strip -->
                <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-6 pt-4 text-xs font-semibold uppercase tracking-wider text-[#205132]">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white border border-[#e5decb]">
                        <span class="material-symbols-outlined text-sm text-[#c9a25a]">schedule</span>
                        <span>24h Response SLA</span>
                    </div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white border border-[#e5decb]">
                        <span class="material-symbols-outlined text-sm text-[#205132]">verified</span>
                        <span>Lab Batch Verified</span>
                    </div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white border border-[#e5decb]">
                        <span class="material-symbols-outlined text-sm text-[#c9a25a]">local_shipping</span>
                        <span>Pan-India Dispatch</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 2: MAIN CONTACT EXPERIENCE (CHANNELS + INTERACTIVE FORM) -->
        <main class="site-container py-12 lg:py-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
                
                <!-- Left Column: Detailed Contact Cards (5 Columns) -->
                <div class="lg:col-span-5 space-y-6">
                    
                    <!-- Direct Email Support Card -->
                    <div class="p-6 sm:p-7 rounded-2xl bg-white border border-[#e5decb] shadow-sm space-y-4 hover:border-[#205132]/40 transition-all">
                        <div class="flex items-center gap-3.5">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#e8f2ec] text-[#205132] shrink-0">
                                <span class="material-symbols-outlined text-xl">mail</span>
                            </span>
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#c9a25a]">Direct Email</span>
                                <h3 class="font-serif text-lg font-bold text-[#163923]">Customer & Order Care</h3>
                            </div>
                        </div>

                        <p class="text-xs sm:text-sm text-[#677a6d] leading-relaxed">
                            For order tracking, product dosage guidance, or batch lab verification records:
                        </p>

                        <div class="space-y-2 pt-1 border-t border-[#e5decb]/60">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                <span class="text-xs text-[#677a6d]">General Inquiries:</span>
                                <a href="mailto:{{ $contactEmail }}" class="text-xs sm:text-sm font-semibold text-[#205132] hover:text-[#163923] hover:underline flex items-center gap-1">
                                    <span>{{ $contactEmail }}</span>
                                    <span class="text-xs">&rarr;</span>
                                </a>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                <span class="text-xs text-[#677a6d]">Bulk & Clinics:</span>
                                <a href="mailto:{{ $adminEmail }}" class="text-xs sm:text-sm font-semibold text-[#c9a25a] hover:text-[#b08a43] hover:underline flex items-center gap-1">
                                    <span>{{ $adminEmail }}</span>
                                    <span class="text-xs">&rarr;</span>
                                </a>
                            </div>
                        </div>

                        <div class="pt-2 text-[11px] text-[#677a6d] flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm text-[#205132]">check_circle</span>
                            <span>Dedicated support response within 24 business hours.</span>
                        </div>
                    </div>

                    <!-- Phone & Instant WhatsApp Hotline Card -->
                    <div class="p-6 sm:p-7 rounded-2xl bg-white border border-[#e5decb] shadow-sm space-y-4 hover:border-[#205132]/40 transition-all">
                        <div class="flex items-center gap-3.5">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#e8f2ec] text-[#205132] shrink-0">
                                <span class="material-symbols-outlined text-xl">call</span>
                            </span>
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#c9a25a]">Direct Hotline</span>
                                <h3 class="font-serif text-lg font-bold text-[#163923]">+91 98765 43210</h3>
                            </div>
                        </div>

                        <p class="text-xs sm:text-sm text-[#677a6d] leading-relaxed">
                            Connect directly with our botanical customer desk Monday through Saturday, 9:00 AM – 6:30 PM IST.
                        </p>

                        <div class="grid grid-cols-2 gap-3 pt-1">
                            <a
                                href="https://wa.me/919876543210"
                                target="_blank"
                                rel="noopener"
                                class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl bg-[#e8f2ec] text-[#205132] text-xs font-semibold hover:bg-[#205132] hover:text-white transition-all shadow-sm"
                            >
                                <span class="material-symbols-outlined text-base">chat</span>
                                <span>WhatsApp</span>
                            </a>
                            <a
                                href="tel:+919876543210"
                                class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl border border-[#e5decb] bg-white text-[#163923] text-xs font-semibold hover:border-[#205132] hover:text-[#205132] transition-all shadow-sm"
                            >
                                <span class="material-symbols-outlined text-base">phone</span>
                                <span>Call Direct</span>
                            </a>
                        </div>
                    </div>

                    <!-- Botanical Dispatch Facility Card -->
                    <div class="p-6 sm:p-7 rounded-2xl bg-white border border-[#e5decb] shadow-sm space-y-4 hover:border-[#205132]/40 transition-all">
                        <div class="flex items-center gap-3.5">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#e8f2ec] text-[#205132] shrink-0">
                                <span class="material-symbols-outlined text-xl">location_on</span>
                            </span>
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#c9a25a]">Dispatch Facility</span>
                                <h3 class="font-serif text-lg font-bold text-[#163923]">ELIOR Botanical Hub</h3>
                            </div>
                        </div>

                        <div class="text-xs sm:text-sm text-[#677a6d] leading-relaxed space-y-1">
                            <p class="font-medium text-[#163923]">{{ $address }}</p>
                            <p>{{ $city }}, {{ $state }} {{ $zipcode }}, {{ $country }}</p>
                        </div>

                        <div class="pt-2 text-[11px] text-[#677a6d] flex items-center gap-1.5 border-t border-[#e5decb]/60">
                            <span class="material-symbols-outlined text-sm text-[#c9a25a]">verified_user</span>
                            <span>Clean-room dehydration & nitrogen-flushed packaging center.</span>
                        </div>
                    </div>

                    <!-- Community Channels Card -->
                    <div class="p-6 sm:p-7 rounded-2xl bg-white border border-[#e5decb] shadow-sm space-y-4">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#c9a25a]">Community</span>
                            <h3 class="font-serif text-lg font-bold text-[#163923]">Follow the ELIOR Ritual</h3>
                            <p class="text-xs text-[#677a6d] mt-1">
                                Discover daily functional recipes, harvest origins, and botanical science:
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-2.5 pt-1">
                            @if (!empty($socialLinks['instagram']))
                                <a
                                    href="{{ $socialLinks['instagram'] }}"
                                    target="_blank"
                                    rel="noopener"
                                    class="flex items-center gap-2 p-2.5 rounded-xl bg-[#f4f0e6] hover:bg-[#205132] hover:text-white transition-all text-xs font-semibold text-[#163923] group"
                                >
                                    <span class="material-symbols-outlined text-sm text-[#c9a25a] group-hover:text-white transition-colors">photo_camera</span>
                                    <span>Instagram</span>
                                </a>
                            @endif

                            @if (!empty($socialLinks['youtube']))
                                <a
                                    href="{{ $socialLinks['youtube'] }}"
                                    target="_blank"
                                    rel="noopener"
                                    class="flex items-center gap-2 p-2.5 rounded-xl bg-[#f4f0e6] hover:bg-[#205132] hover:text-white transition-all text-xs font-semibold text-[#163923] group"
                                >
                                    <span class="material-symbols-outlined text-sm text-[#c9a25a] group-hover:text-white transition-colors">play_circle</span>
                                    <span>YouTube</span>
                                </a>
                            @endif

                            @if (!empty($socialLinks['linkedin']))
                                <a
                                    href="{{ $socialLinks['linkedin'] }}"
                                    target="_blank"
                                    rel="noopener"
                                    class="flex items-center gap-2 p-2.5 rounded-xl bg-[#f4f0e6] hover:bg-[#205132] hover:text-white transition-all text-xs font-semibold text-[#163923] group"
                                >
                                    <span class="material-symbols-outlined text-sm text-[#c9a25a] group-hover:text-white transition-colors">work</span>
                                    <span>LinkedIn</span>
                                </a>
                            @endif

                            @if (!empty($socialLinks['twitter']))
                                <a
                                    href="{{ $socialLinks['twitter'] }}"
                                    target="_blank"
                                    rel="noopener"
                                    class="flex items-center gap-2 p-2.5 rounded-xl bg-[#f4f0e6] hover:bg-[#205132] hover:text-white transition-all text-xs font-semibold text-[#163923] group"
                                >
                                    <span class="material-symbols-outlined text-sm text-[#c9a25a] group-hover:text-white transition-colors">tag</span>
                                    <span>X (Twitter)</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column: Interactive Inquiry Form (7 Columns) -->
                <div class="lg:col-span-7">
                    <div class="rounded-3xl border border-[#e5decb] bg-white p-7 sm:p-10 lg:p-12 shadow-sm space-y-6">
                        
                        <!-- Form Title Header -->
                        <div class="space-y-1.5 border-b border-[#e5decb] pb-5">
                            <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#c9a25a]">Send an Inquiry</span>
                            <h2 class="font-serif text-2xl sm:text-3xl font-bold text-[#163923]">
                                How Can We Help Your Ritual?
                            </h2>
                            <p class="text-xs sm:text-sm text-[#677a6d]">
                                Complete the details below and an ELIOR botanical specialist will respond promptly.
                            </p>
                        </div>

                        <!-- Session Notifications -->
                        @if (session('success'))
                            <div class="p-4 rounded-xl bg-[#e8f2ec] border border-[#205132]/30 text-[#205132] text-xs sm:text-sm font-medium flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="p-4 rounded-xl bg-[#fff2f0] border border-red-200 text-red-700 text-xs sm:text-sm font-medium flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-lg">error</span>
                                <span>{{ session('error') }}</span>
                            </div>
                        @endif

                        <!-- Form -->
                        <x-shop::form :action="route('shop.home.contact_us.send_mail')">
                            
                            <!-- Full Name -->
                            <x-shop::form.control-group class="mb-4">
                                <x-shop::form.control-group.label class="required text-xs uppercase tracking-wider font-semibold text-[#163923] mb-1.5 block">
                                    Your Full Name
                                </x-shop::form.control-group.label>

                                <x-shop::form.control-group.control
                                    type="text"
                                    class="w-full rounded-xl border border-[#e5decb] bg-white px-4 py-3 text-sm text-[#163923] placeholder-[#677a6d]/60 focus:border-[#205132] focus:ring-1 focus:ring-[#205132] transition-colors outline-none"
                                    name="name"
                                    rules="required"
                                    :value="old('name')"
                                    label="Full Name"
                                    placeholder="e.g. Dr. Maya Sen"
                                    aria-required="true"
                                />

                                <x-shop::form.control-group.error control-name="name" class="mt-1 text-xs text-red-600" />
                            </x-shop::form.control-group>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                <!-- Email Address -->
                                <x-shop::form.control-group>
                                    <x-shop::form.control-group.label class="required text-xs uppercase tracking-wider font-semibold text-[#163923] mb-1.5 block">
                                        Email Address
                                    </x-shop::form.control-group.label>

                                    <x-shop::form.control-group.control
                                        type="email"
                                        class="w-full rounded-xl border border-[#e5decb] bg-white px-4 py-3 text-sm text-[#163923] placeholder-[#677a6d]/60 focus:border-[#205132] focus:ring-1 focus:ring-[#205132] transition-colors outline-none"
                                        name="email"
                                        rules="required|email"
                                        :value="old('email')"
                                        label="Email"
                                        placeholder="yourname@domain.com"
                                        aria-required="true"
                                    />

                                    <x-shop::form.control-group.error control-name="email" class="mt-1 text-xs text-red-600" />
                                </x-shop::form.control-group>

                                <!-- Phone / WhatsApp -->
                                <x-shop::form.control-group>
                                    <x-shop::form.control-group.label class="text-xs uppercase tracking-wider font-semibold text-[#163923] mb-1.5 block">
                                        Phone / WhatsApp <span class="text-[#677a6d] font-normal lowercase">(optional)</span>
                                    </x-shop::form.control-group.label>

                                    <x-shop::form.control-group.control
                                        type="text"
                                        class="w-full rounded-xl border border-[#e5decb] bg-white px-4 py-3 text-sm text-[#163923] placeholder-[#677a6d]/60 focus:border-[#205132] focus:ring-1 focus:ring-[#205132] transition-colors outline-none"
                                        name="contact"
                                        rules="phone"
                                        :value="old('contact')"
                                        label="Phone Number"
                                        placeholder="+91 98765 43210"
                                    />

                                    <x-shop::form.control-group.error control-name="contact" class="mt-1 text-xs text-red-600" />
                                </x-shop::form.control-group>
                            </div>

                            <!-- Message Content -->
                            <x-shop::form.control-group class="mb-5">
                                <x-shop::form.control-group.label class="required text-xs uppercase tracking-wider font-semibold text-[#163923] mb-1.5 block">
                                    Your Message / Inquiry Details
                                </x-shop::form.control-group.label>

                                <x-shop::form.control-group.control
                                    type="textarea"
                                    class="w-full rounded-xl border border-[#e5decb] bg-white px-4 py-3 text-sm text-[#163923] placeholder-[#677a6d]/60 focus:border-[#205132] focus:ring-1 focus:ring-[#205132] transition-colors outline-none"
                                    name="message"
                                    rules="required"
                                    label="Message"
                                    placeholder="Please share details regarding your question, batch verification inquiry, recipe ritual, or bulk partnership..."
                                    aria-required="true"
                                    rows="5"
                                />

                                <x-shop::form.control-group.error control-name="message" class="mt-1 text-xs text-red-600" />
                            </x-shop::form.control-group>

                            <!-- Captcha (If Configured) -->
                            @if (core()->getConfigData('customer.captcha.credentials.status'))
                                <x-shop::form.control-group class="mb-5">
                                    {!! \Webkul\Customer\Facades\Captcha::render() !!}

                                    <x-shop::form.control-group.error control-name="recaptcha_token" class="mt-1 text-xs text-red-600" />
                                </x-shop::form.control-group>
                            @endif

                            <!-- Submit Button -->
                            <div class="pt-2">
                                <button
                                    class="w-full h-12 rounded-xl bg-[#205132] hover:bg-[#163923] text-white text-xs uppercase tracking-[0.2em] font-semibold flex items-center justify-center gap-2 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5"
                                    type="submit"
                                >
                                    <span>Send Message Directly</span>
                                    <span class="text-sm">&rarr;</span>
                                </button>
                            </div>
                        </x-shop::form>
                    </div>
                </div>
            </div>
        </main>

        <!-- SECTION 3: FREQUENT INQUIRY COLLAPSIBLE ACCORDION -->
        <section class="py-16 sm:py-24 bg-white border-t border-[#e5decb]">
            <div class="site-container">
                <div class="max-w-3xl mx-auto text-center space-y-3 mb-12">
                    <span class="text-xs font-bold uppercase tracking-[0.22em] text-[#c9a25a]">Quick Answers</span>
                    <h2 class="font-serif text-2xl sm:text-4xl font-bold tracking-tight text-[#163923]">
                        Frequently Inquired Topics
                    </h2>
                    <p class="text-xs sm:text-sm text-[#677a6d] leading-relaxed max-w-xl mx-auto">
                        Instant clarity on our cold-dehydration science, batch test records, shipping timelines, and wholesale rituals.
                    </p>
                </div>

                <div class="max-w-4xl mx-auto space-y-4">
                    {{-- FAQ 1 --}}
                    <details class="group rounded-2xl border border-[#e5decb] bg-[#FAF8F5] p-6 transition-all duration-300 open:bg-white open:border-[#205132]/40 open:shadow-sm">
                        <summary class="flex cursor-pointer list-none items-center justify-between font-serif text-base sm:text-lg font-semibold text-[#163923] [&::-webkit-details-marker]:hidden select-none">
                            <span class="flex items-center gap-3.5 pr-4">
                                <span class="material-symbols-outlined text-[#205132] text-xl shrink-0">local_shipping</span>
                                <span>How quickly will my order be dispatched and delivered?</span>
                            </span>
                            <span class="material-symbols-outlined text-[#205132] shrink-0 transition-transform duration-300 group-open:rotate-45" style="font-size:22px">add</span>
                        </summary>
                        <div class="pt-4 text-xs sm:text-sm text-[#677a6d] leading-relaxed border-t border-[#e5decb]/60 mt-4 pl-9">
                            All orders placed before 2:00 PM IST on business days are dispatched within 24 hours directly from our certified fulfillment center. Delivery across major metro cities takes 2–4 business days, and 3–5 business days for regional pin codes. You will receive real-time SMS & email tracking updates as soon as your parcel is handed to the courier partner. Complimentary shipping applies to all orders above ₹499.
                        </div>
                    </details>

                    {{-- FAQ 2 --}}
                    <details class="group rounded-2xl border border-[#e5decb] bg-[#FAF8F5] p-6 transition-all duration-300 open:bg-white open:border-[#205132]/40 open:shadow-sm">
                        <summary class="flex cursor-pointer list-none items-center justify-between font-serif text-base sm:text-lg font-semibold text-[#163923] [&::-webkit-details-marker]:hidden select-none">
                            <span class="flex items-center gap-3.5 pr-4">
                                <span class="material-symbols-outlined text-[#205132] text-xl shrink-0">science</span>
                                <span>How can I view the lab test Certificate of Analysis (COA) for my product batch?</span>
                            </span>
                            <span class="material-symbols-outlined text-[#205132] shrink-0 transition-transform duration-300 group-open:rotate-45" style="font-size:22px">add</span>
                        </summary>
                        <div class="pt-4 text-xs sm:text-sm text-[#677a6d] leading-relaxed border-t border-[#e5decb]/60 mt-4 pl-9">
                            Every ELIOR formulation pouch or jar features a printed Batch/Lot number. To review the complete independent third-party laboratory analysis (including heavy metal ICP-MS screening, pesticide multi-residue tests, and active HPLC biomarker percentages), simply email us at <a href="mailto:care@elior.in" class="text-[#205132] font-semibold underline">care@elior.in</a> with your batch code.
                        </div>
                    </details>

                    {{-- FAQ 3 --}}
                    <details class="group rounded-2xl border border-[#e5decb] bg-[#FAF8F5] p-6 transition-all duration-300 open:bg-white open:border-[#205132]/40 open:shadow-sm">
                        <summary class="flex cursor-pointer list-none items-center justify-between font-serif text-base sm:text-lg font-semibold text-[#163923] [&::-webkit-details-marker]:hidden select-none">
                            <span class="flex items-center gap-3.5 pr-4">
                                <span class="material-symbols-outlined text-[#205132] text-xl shrink-0">handshake</span>
                                <span>Do you provide practitioner discounts or wholesale supply for clinics & cafes?</span>
                            </span>
                            <span class="material-symbols-outlined text-[#205132] shrink-0 transition-transform duration-300 group-open:rotate-45" style="font-size:22px">add</span>
                        </summary>
                        <div class="pt-4 text-xs sm:text-sm text-[#677a6d] leading-relaxed border-t border-[#e5decb]/60 mt-4 pl-9">
                            Yes. We partner closely with certified herbalists, functional medicine practitioners, integrative wellness clinics, and boutique cafes. Please reach out directly to <a href="mailto:wholesale@elior.in" class="text-[#205132] font-semibold underline">wholesale@elior.in</a> or message us on WhatsApp at <a href="https://wa.me/919876543210" class="text-[#205132] font-semibold underline">+91 98765 43210</a> for our wholesale catalog pricing, minimum order quantities, and sample kits.
                        </div>
                    </details>

                    {{-- FAQ 4 --}}
                    <details class="group rounded-2xl border border-[#e5decb] bg-[#FAF8F5] p-6 transition-all duration-300 open:bg-white open:border-[#205132]/40 open:shadow-sm">
                        <summary class="flex cursor-pointer list-none items-center justify-between font-serif text-base sm:text-lg font-semibold text-[#163923] [&::-webkit-details-marker]:hidden select-none">
                            <span class="flex items-center gap-3.5 pr-4">
                                <span class="material-symbols-outlined text-[#205132] text-xl shrink-0">inventory_2</span>
                                <span>What is the recommended storage method once the package is opened?</span>
                            </span>
                            <span class="material-symbols-outlined text-[#205132] shrink-0 transition-transform duration-300 group-open:rotate-45" style="font-size:22px">add</span>
                        </summary>
                        <div class="pt-4 text-xs sm:text-sm text-[#677a6d] leading-relaxed border-t border-[#e5decb]/60 mt-4 pl-9">
                            Store your package in a cool, dry pantry away from direct sunlight, humidity, and heat sources. Always ensure the airtight zip seal or lid is closed firmly after use. Because our products contain zero anti-caking silica chemicals, using a clean, dry spoon prevents ambient moisture from causing natural clumping. Best consumed within 90 days after opening.
                        </div>
                    </details>

                    {{-- FAQ 5 --}}
                    <details class="group rounded-2xl border border-[#e5decb] bg-[#FAF8F5] p-6 transition-all duration-300 open:bg-white open:border-[#205132]/40 open:shadow-sm">
                        <summary class="flex cursor-pointer list-none items-center justify-between font-serif text-base sm:text-lg font-semibold text-[#163923] [&::-webkit-details-marker]:hidden select-none">
                            <span class="flex items-center gap-3.5 pr-4">
                                <span class="material-symbols-outlined text-[#205132] text-xl shrink-0">verified_user</span>
                                <span>What is your policy if my order arrives damaged or compromised?</span>
                            </span>
                            <span class="material-symbols-outlined text-[#205132] shrink-0 transition-transform duration-300 group-open:rotate-45" style="font-size:22px">add</span>
                        </summary>
                        <div class="pt-4 text-xs sm:text-sm text-[#677a6d] leading-relaxed border-t border-[#e5decb]/60 mt-4 pl-9">
                            In the unlikely event that your package arrives damaged, leaked, or with a compromised seal, please take a photo and contact <a href="mailto:care@elior.in" class="text-[#205132] font-semibold underline">care@elior.in</a> or WhatsApp <a href="https://wa.me/919876543210" class="text-[#205132] font-semibold underline">+91 98765 43210</a> within 48 hours of delivery. We will immediately dispatch a priority replacement at zero cost.
                        </div>
                    </details>

                    {{-- FAQ 6 --}}
                    <details class="group rounded-2xl border border-[#e5decb] bg-[#FAF8F5] p-6 transition-all duration-300 open:bg-white open:border-[#205132]/40 open:shadow-sm">
                        <summary class="flex cursor-pointer list-none items-center justify-between font-serif text-base sm:text-lg font-semibold text-[#163923] [&::-webkit-details-marker]:hidden select-none">
                            <span class="flex items-center gap-3.5 pr-4">
                                <span class="material-symbols-outlined text-[#205132] text-xl shrink-0">blender</span>
                                <span>Can I combine multiple ELIOR botanical powders in one daily drink?</span>
                            </span>
                            <span class="material-symbols-outlined text-[#205132] shrink-0 transition-transform duration-300 group-open:rotate-45" style="font-size:22px">add</span>
                        </summary>
                        <div class="pt-4 text-xs sm:text-sm text-[#677a6d] leading-relaxed border-t border-[#e5decb]/60 mt-4 pl-9">
                            Absolutely. Our single-origin botanicals (such as Moringa, Turmeric, Spirulina, and Ashwagandha) are formulated to work harmoniously together. For example, combining Lakadong Turmeric with warm oat milk and a dash of black pepper enhances curcumin absorption. Check our <a href="{{ route('shop.recipes.index') }}" class="text-[#205132] font-semibold underline">Recipes section</a> for curated daily ritual pairings.
                        </div>
                    </details>
                </div>
            </div>
        </section>

        <!-- SECTION 4: BOTANICAL QUALITY & TRUST PILLARS STRIP -->
        <section class="py-12 bg-[#FAF8F5] border-t border-[#e5decb]">
            <div class="site-container">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="flex items-center gap-3 p-4 rounded-xl bg-white border border-[#e5decb]">
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#e8f2ec] text-[#205132] shrink-0">
                            <span class="material-symbols-outlined text-lg">eco</span>
                        </span>
                        <div>
                            <p class="text-xs font-bold text-[#163923]">100% Whole Plants</p>
                            <p class="text-[11px] text-[#677a6d]">Zero maltodextrin or fillers</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-4 rounded-xl bg-white border border-[#e5decb]">
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#e8f2ec] text-[#205132] shrink-0">
                            <span class="material-symbols-outlined text-lg">ac_unit</span>
                        </span>
                        <div>
                            <p class="text-xs font-bold text-[#163923]">Cold-Dried &lt;42°C</p>
                            <p class="text-[11px] text-[#677a6d]">Living enzymes preserved</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-4 rounded-xl bg-white border border-[#e5decb]">
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#e8f2ec] text-[#205132] shrink-0">
                            <span class="material-symbols-outlined text-lg">verified</span>
                        </span>
                        <div>
                            <p class="text-xs font-bold text-[#163923]">Lab Certified COA</p>
                            <p class="text-[11px] text-[#677a6d]">Heavy metal & purity verified</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-4 rounded-xl bg-white border border-[#e5decb]">
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#e8f2ec] text-[#205132] shrink-0">
                            <span class="material-symbols-outlined text-lg">shield</span>
                        </span>
                        <div>
                            <p class="text-xs font-bold text-[#163923]">Nitrogen Sealed</p>
                            <p class="text-[11px] text-[#677a6d]">Triple barrier freshness</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        @if (core()->getConfigData('customer.captcha.credentials.status'))
            {!! \Webkul\Customer\Facades\Captcha::renderJS() !!}
        @endif
    @endpush
</x-shop::layouts>
