<div class="bg-[#FAF8F5] min-h-screen">
    @if (core()->getConfigData('general.general.breadcrumbs.shop'))
        <!-- Breadcrumbs -->
        <div class="site-container pt-4 pb-2 sm:pt-6 sm:pb-3">
            <nav aria-label="Breadcrumb" class="flex items-center space-x-2 text-[11px] sm:text-xs uppercase tracking-[0.14em] text-[#677a6d]">
                <a href="{{ route('shop.home.index') }}" class="hover:text-[#205132] transition-colors">Home</a>
                <span class="text-[#e5decb]">/</span>
                <span class="text-[#163923] font-semibold">Quality Standard</span>
            </nav>
        </div>
    @endif

    <!-- SECTION 1: EDITORIAL HERO & QUALITY CODE -->
    <section class="site-container pt-8 pb-16 sm:pt-14 sm:pb-20 border-b border-[#e5decb]/70">
        <div class="max-w-4xl mx-auto text-center space-y-6">
            <!-- Brand Tagline Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#205132]/10 text-[#205132] text-xs font-semibold tracking-widest uppercase border border-[#205132]/20 shadow-2xs">
                <svg class="w-4 h-4 text-[#205132]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    <path d="m9 12 2 2 4-4"/>
                </svg>
                <span>Pure by Nature, Made for You</span>
            </div>

            <!-- Main Heading -->
            <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#163923] leading-[1.14]">
                Scientific Precision. <br class="hidden sm:inline">
                <span class="italic text-[#205132] font-normal">Pure Botanical Integrity.</span>
            </h1>

            <!-- Subtitle -->
            <p class="text-base sm:text-lg lg:text-xl leading-relaxed text-[#677a6d] max-w-2xl mx-auto">
                Quality is not a marketing buzzword; it is our quantifiable formulation discipline. From low-temperature vacuum drying below 42°C to multi-parameter lab testing, discover the science behind our uncompromised plant powders.
            </p>

            <!-- Hero Feature Image Card -->
            <div class="relative mt-10 overflow-hidden rounded-3xl border border-[#e5decb] bg-white shadow-xl">
                <img
                    src="{{ asset('storage/theme/cms/elior-quality-lab.webp') }}"
                    alt="ELIOR Clean-Label Laboratory & Quality Standard"
                    class="h-64 sm:h-96 lg:h-[460px] w-full object-cover transition-transform duration-700 hover:scale-105"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-[#163923]/85 via-transparent to-transparent"></div>
                <div class="absolute bottom-6 left-6 right-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4 text-white text-left">
                    <div>
                        <span class="inline-block px-3 py-1 rounded-full bg-[#c9a25a] text-[#163923] text-[10px] font-bold tracking-widest uppercase mb-2">
                            Clean-Label Science
                        </span>
                        <h3 class="font-serif text-xl sm:text-2xl font-bold">Uncompromising Formulation Rigor</h3>
                        <p class="text-xs sm:text-sm text-white/80 max-w-md mt-0.5">Every agricultural lot undergoes HPLC potency quantification & ICP-MS safety verification.</p>
                    </div>
                    <div class="flex items-center gap-2 rounded-2xl bg-white/10 backdrop-blur-md px-4 py-2 border border-white/20">
                        <svg class="w-5 h-5 text-[#83B740]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <span class="text-xs font-semibold tracking-wide">FSSAI Certified</span>
                    </div>
                </div>
            </div>

            <!-- 4 Trust Metrics Strip -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6 pt-6 text-left">
                <div class="p-5 rounded-2xl bg-white border border-[#e5decb] shadow-2xs hover:border-[#205132]/30 transition-all">
                    <p class="font-serif text-3xl font-bold text-[#163923]">&lt; 42°C</p>
                    <p class="text-xs uppercase tracking-wider text-[#205132] font-semibold mt-1">Vacuum Drying</p>
                    <p class="text-[11px] text-[#677a6d] mt-0.5">Living cellular structures & enzymes preserved.</p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-[#e5decb] shadow-2xs hover:border-[#205132]/30 transition-all">
                    <p class="font-serif text-3xl font-bold text-[#163923]">0%</p>
                    <p class="text-xs uppercase tracking-wider text-[#205132] font-semibold mt-1">Fillers & Silica</p>
                    <p class="text-[11px] text-[#677a6d] mt-0.5">No maltodextrin, gums, or chemical flow agents.</p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-[#e5decb] shadow-2xs hover:border-[#205132]/30 transition-all">
                    <p class="font-serif text-3xl font-bold text-[#163923]">100%</p>
                    <p class="text-xs uppercase tracking-wider text-[#205132] font-semibold mt-1">Lab Screened</p>
                    <p class="text-[11px] text-[#677a6d] mt-0.5">Every batch tested for heavy metals & microbes.</p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-[#e5decb] shadow-2xs hover:border-[#205132]/30 transition-all">
                    <p class="font-serif text-3xl font-bold text-[#163923]">N₂ Flush</p>
                    <p class="text-xs uppercase tracking-wider text-[#205132] font-semibold mt-1">Nitrogen Sealed</p>
                    <p class="text-[11px] text-[#677a6d] mt-0.5">Zero oxygen oxidation without chemical preservatives.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: THE 5-STAGE SEED-TO-JAR QUALITY PIPELINE -->
    <section class="py-16 sm:py-24 bg-white border-b border-[#e5decb]/70">
        <div class="site-container">
            <div class="max-w-3xl mx-auto text-center space-y-4 mb-16">
                <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#205132]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#205132]"></span>
                    <span>Formulation Pipeline</span>
                </div>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923]">
                    Our 5-Stage Verification Protocol
                </h2>
                <p class="text-sm sm:text-base text-[#677a6d] leading-relaxed">
                    How raw agricultural harvests become pure, bioavailable daily ritual powders.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                <!-- Stage 1 -->
                <div class="p-6 rounded-3xl bg-[#FAF8F5] border border-[#e5decb] space-y-3 hover:border-[#205132]/40 hover:shadow-sm transition-all">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#205132]/10 text-[#205132] font-serif font-bold text-base border border-[#205132]/20">
                        01
                    </div>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">Harvest Selection</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        Hand-harvested at peak biological maturity from regenerative smallholder growers practicing pesticide-free farming.
                    </p>
                </div>

                <!-- Stage 2 -->
                <div class="p-6 rounded-3xl bg-[#FAF8F5] border border-[#e5decb] space-y-3 hover:border-[#205132]/40 hover:shadow-sm transition-all">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#205132]/10 text-[#205132] font-serif font-bold text-base border border-[#205132]/20">
                        02
                    </div>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">Cold Dehydration</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        Vacuum dehydrated below 42°C in low-pressure chambers to gently evaporate moisture while keeping live enzymes intact.
                    </p>
                </div>

                <!-- Stage 3 -->
                <div class="p-6 rounded-3xl bg-[#FAF8F5] border border-[#e5decb] space-y-3 hover:border-[#205132]/40 hover:shadow-sm transition-all">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#205132]/10 text-[#205132] font-serif font-bold text-base border border-[#205132]/20">
                        03
                    </div>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">Cryo Micro-Milling</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        Mechanically reduced to micron-fine particles without heat friction, ensuring instant dissolvability without chemical emulsifiers.
                    </p>
                </div>

                <!-- Stage 4 -->
                <div class="p-6 rounded-3xl bg-[#FAF8F5] border border-[#e5decb] space-y-3 hover:border-[#205132]/40 hover:shadow-sm transition-all">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#205132]/10 text-[#205132] font-serif font-bold text-base border border-[#205132]/20">
                        04
                    </div>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">Lab Screening</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        Third-party testing for heavy metals, microbial safety, pesticide residues, and active phytochemical potency via HPLC.
                    </p>
                </div>

                <!-- Stage 5 -->
                <div class="p-6 rounded-3xl bg-[#FAF8F5] border border-[#e5decb] space-y-3 hover:border-[#205132]/40 hover:shadow-sm transition-all">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#205132]/10 text-[#205132] font-serif font-bold text-base border border-[#205132]/20">
                        05
                    </div>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">Nitrogen Barrier</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        Nitrogen-flushed hermetic packaging locks in raw freshness, preventing oxidation and spoilage without synthetic preservatives.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: COLD-DEHYDRATION VS SPRAY DRYING (DEEP SCIENCE) -->
    <section class="py-16 sm:py-24 bg-[#F5EFE6] border-b border-[#e5decb]/70">
        <div class="site-container">
            <div class="max-w-3xl mx-auto text-center space-y-4 mb-16">
                <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#205132]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#205132]"></span>
                    <span>Thermal Discipline</span>
                </div>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923]">
                    Cold Dehydration vs. Industrial Spray-Drying
                </h2>
                <p class="text-sm sm:text-base text-[#677a6d] leading-relaxed">
                    Why the temperature at which plants are dried determines their true nutritional bioavailability.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- ELIOR Cold-Dehydration -->
                <div class="p-8 sm:p-10 rounded-3xl bg-white border-2 border-[#205132]/40 shadow-sm space-y-5">
                    <div class="flex items-center justify-between">
                        <span class="px-3.5 py-1 rounded-full bg-[#205132]/10 text-[#205132] text-xs font-bold uppercase tracking-wider border border-[#205132]/20">
                            ELIOR Standard
                        </span>
                        <span class="font-serif text-2xl font-bold text-[#205132]">&lt; 42°C</span>
                    </div>

                    <h3 class="font-serif text-2xl font-bold text-[#163923]">
                        Low-Temperature Vacuum Drying
                    </h3>

                    <ul class="space-y-3.5 text-xs sm:text-sm text-[#163923]/90 font-medium">
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#205132] font-bold shrink-0">✓</span>
                            <span><strong>Live Enzymes Intact:</strong> Low temperature preserves thermolabile biological catalysts and living plant proteins.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#205132] font-bold shrink-0">✓</span>
                            <span><strong>Cellular Pigmentation:</strong> Vivid green chlorophyll, golden curcuminoids, and deep betalains remain unoxidized.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#205132] font-bold shrink-0">✓</span>
                            <span><strong>100% Whole Food:</strong> Requires zero carrier starches or maltodextrins during dehydration.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#205132] font-bold shrink-0">✓</span>
                            <span><strong>Authentic Aroma &amp; Flavor:</strong> Volatile aromatic terpenes and natural phytonutrients are gently retained.</span>
                        </li>
                    </ul>
                </div>

                <!-- Conventional Spray-Drying -->
                <div class="p-8 sm:p-10 rounded-3xl bg-white border border-[#FCA5A5] shadow-2xs space-y-5">
                    <div class="flex items-center justify-between">
                        <span class="px-3.5 py-1 rounded-full bg-[#FEF2F2] text-[#991B1B] text-xs font-bold uppercase tracking-wider border border-[#FCA5A5]">
                            Industry Conventional
                        </span>
                        <span class="font-serif text-2xl font-bold text-[#991B1B]">&gt; 160°C</span>
                    </div>

                    <h3 class="font-serif text-2xl font-bold text-[#163923]">
                        High-Heat Spray Drying
                    </h3>

                    <ul class="space-y-3.5 text-xs sm:text-sm text-[#163923]/90 font-medium">
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#991B1B] font-bold shrink-0">✕</span>
                            <span><strong>Enzymatic Denaturation:</strong> Extreme heat permanently destroys natural enzymes and degrades Vitamin C by up to 80%.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#991B1B] font-bold shrink-0">✕</span>
                            <span><strong>Pigment Oxidation:</strong> Causes browning and degradation of delicate carotenoids and flavonoids.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#991B1B] font-bold shrink-0">✕</span>
                            <span><strong>High Maltodextrin Bulking:</strong> Requires 40–70% synthetic carbohydrate carriers to prevent powders from sticking to hot spray nozzles.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#991B1B] font-bold shrink-0">✕</span>
                            <span><strong>Scorched Taste:</strong> Blasts away subtle botanical aromas, requiring artificial or "natural-identical" flavoring additives.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: LABORATORY TESTING PROTOCOLS -->
    <section class="py-16 sm:py-24 bg-white border-b border-[#e5decb]/70">
        <div class="site-container">
            <div class="max-w-3xl mx-auto text-center space-y-4 mb-16">
                <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#205132]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#205132]"></span>
                    <span>Analytical Rigor</span>
                </div>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923]">
                    Independent Lab Verification
                </h2>
                <p class="text-sm sm:text-base text-[#677a6d] leading-relaxed">
                    Every batch is analyzed by accredited third-party laboratories against strict safety thresholds.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Test 1 -->
                <div class="p-6 rounded-3xl bg-[#FAF8F5] border border-[#e5decb] space-y-3 hover:border-[#205132]/30 transition-all">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#205132]/10 text-[#205132]">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 2v7.31L4.41 18.5A2 2 0 0 0 6 22h12a2 2 0 0 0 1.59-3.5L14 9.31V2"/><path d="M8.5 2h7"/><path d="M14 9.3a6.5 6.5 0 1 1-4 0"/></svg>
                    </div>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">Heavy Metal Screening</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        ICP-MS tested for Lead (&lt;0.5 ppm), Arsenic (&lt;0.5 ppm), Cadmium (&lt;0.3 ppm), and Mercury (&lt;0.1 ppm), well below stringent international limits.
                    </p>
                </div>

                <!-- Test 2 -->
                <div class="p-6 rounded-3xl bg-[#FAF8F5] border border-[#e5decb] space-y-3 hover:border-[#205132]/30 transition-all">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#205132]/10 text-[#205132]">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m4.93 4.93 4.24 4.24"/><path d="m14.83 9.17 4.24-4.24"/><path d="m14.83 14.83 4.24 4.24"/><path d="m9.17 14.83-4.24 4.24"/><circle cx="12" cy="12" r="4"/></svg>
                    </div>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">Microbiological Safety</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        Screened for Total Plate Count, Yeast &amp; Mold, E. Coli, Salmonella, and Staphylococcus aureus to guarantee clean-room sterility.
                    </p>
                </div>

                <!-- Test 3 -->
                <div class="p-6 rounded-3xl bg-[#FAF8F5] border border-[#e5decb] space-y-3 hover:border-[#205132]/30 transition-all">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#205132]/10 text-[#205132]">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>
                    </div>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">Pesticide Residue Screen</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        Multi-residue screening against 150+ common synthetic pesticides, fungicides, and chemical herbicides ensuring pure regenerative purity.
                    </p>
                </div>

                <!-- Test 4 -->
                <div class="p-6 rounded-3xl bg-[#FAF8F5] border border-[#e5decb] space-y-3 hover:border-[#205132]/30 transition-all">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#205132]/10 text-[#205132]">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                    </div>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">Phytochemical Potency</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        HPLC quantification of active biomarkers: Curcumin in Turmeric (≥7.5%), Withanolides in Ashwagandha, and Chlorophyll in Moringa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 5: THE ZERO-TOLERANCE BLACKLIST -->
    <section class="py-16 sm:py-24 bg-[#F5EFE6] border-b border-[#e5decb]/70">
        <div class="site-container">
            <div class="max-w-3xl mx-auto text-center space-y-4 mb-16">
                <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#205132]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#205132]"></span>
                    <span>Absolute Transparency</span>
                </div>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923]">
                    Our Zero-Tolerance Blacklist
                </h2>
                <p class="text-sm sm:text-base text-[#677a6d] leading-relaxed">
                    We maintain an unconditional ban on every synthetic carrier, chemical texturizer, and artificial masking agent.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <div class="p-6 rounded-3xl bg-white border border-[#FCA5A5] space-y-2 hover:shadow-xs transition-all">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#991B1B]">Banned Ingredient 01</span>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">Maltodextrin &amp; Dextrose</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        Cheap starch derivatives commonly used to artificially bulk powder volume and reduce active botanical concentration.
                    </p>
                </div>

                <div class="p-6 rounded-3xl bg-white border border-[#FCA5A5] space-y-2 hover:shadow-xs transition-all">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#991B1B]">Banned Ingredient 02</span>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">Silicon Dioxide (E551)</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        Synthetic silica anti-caking agent used by conventional factories to force humid powder flow through machines.
                    </p>
                </div>

                <div class="p-6 rounded-3xl bg-white border border-[#FCA5A5] space-y-2 hover:shadow-xs transition-all">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#991B1B]">Banned Ingredient 03</span>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">Artificial Sweeteners</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        Steviol glycosides, sucralose, aspartame, acesulfame-K, or sugar alcohols that distort genuine whole botanical flavors.
                    </p>
                </div>

                <div class="p-6 rounded-3xl bg-white border border-[#FCA5A5] space-y-2 hover:shadow-xs transition-all">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#991B1B]">Banned Ingredient 04</span>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">Flavor Chemicals</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        "Natural-identical" aroma solvents, synthetic vanilla esters, or maskers used to cover low-grade scorched plant matter.
                    </p>
                </div>

                <div class="p-6 rounded-3xl bg-white border border-[#FCA5A5] space-y-2 hover:shadow-xs transition-all">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#991B1B]">Banned Ingredient 05</span>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">Synthetic Dyes &amp; Colorants</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        Tartrazine, sunset yellow, or artificial chlorophyll dyes used to fake fresh harvest pigmentation.
                    </p>
                </div>

                <div class="p-6 rounded-3xl bg-white border border-[#FCA5A5] space-y-2 hover:shadow-xs transition-all">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#991B1B]">Banned Ingredient 06</span>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">Chemical Preservatives</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        Sodium benzoate, potassium sorbate, and sulfur dioxide. We preserve botanical freshness through nitrogen sealing alone.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 6: PACKAGING SCIENCE -->
    <section class="py-16 sm:py-24 bg-white border-b border-[#e5decb]/70">
        <div class="site-container">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5 space-y-6">
                    <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#205132]">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#205132]"></span>
                        <span>Packaging Engineering</span>
                    </div>
                    <h2 class="font-serif text-3xl sm:text-4xl font-bold tracking-tight text-[#163923] leading-tight">
                        Packaging as a Functional Shield
                    </h2>
                    <p class="text-sm sm:text-base text-[#677a6d] leading-relaxed">
                        Even the purest cold-dehydrated powder degrades rapidly if exposed to ambient oxygen and ultraviolet light. Our packaging is engineered as a protective barrier system.
                    </p>
                    <div class="flex items-center gap-4 text-xs font-semibold uppercase tracking-wider text-[#205132]">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[#205132]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                            Nitrogen Flushed
                        </span>
                        <span class="text-[#e5decb]">•</span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[#205132]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                            UV Protection
                        </span>
                    </div>
                </div>

                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="p-6 rounded-3xl bg-[#FAF8F5] border border-[#e5decb] space-y-3 hover:border-[#205132]/30 transition-all">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#205132]/10 text-[#205132]">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <h4 class="font-serif text-lg font-bold text-[#163923]">Oxygen Displacement</h4>
                        <p class="text-xs text-[#677a6d] leading-relaxed">
                            Food-grade inert nitrogen flush displaces atmospheric oxygen, eliminating lipid oxidation and preserving live aroma.
                        </p>
                    </div>

                    <div class="p-6 rounded-3xl bg-[#FAF8F5] border border-[#e5decb] space-y-3 hover:border-[#205132]/30 transition-all">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#205132]/10 text-[#205132]">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m9 12 2 2 4-4"/></svg>
                        </div>
                        <h4 class="font-serif text-lg font-bold text-[#163923]">Triple Moisture Barrier</h4>
                        <p class="text-xs text-[#677a6d] leading-relaxed">
                            High-density induction hermetic seal prevents ambient moisture ingress without requiring toxic silica gel packets inside.
                        </p>
                    </div>

                    <div class="p-6 rounded-3xl bg-[#FAF8F5] border border-[#e5decb] space-y-3 hover:border-[#205132]/30 transition-all">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#205132]/10 text-[#205132]">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="M2 12h2"/><path d="M20 12h2"/></svg>
                        </div>
                        <h4 class="font-serif text-lg font-bold text-[#163923]">Photodegradation Shield</h4>
                        <p class="text-xs text-[#677a6d] leading-relaxed">
                            Light-opaque container wall structures prevent UV breakdown of sensitive plant chlorophyll, betalains, and carotenoids.
                        </p>
                    </div>

                    <div class="p-6 rounded-3xl bg-[#FAF8F5] border border-[#e5decb] space-y-3 hover:border-[#205132]/30 transition-all">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#205132]/10 text-[#205132]">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/><path d="M16 21h5v-5"/></svg>
                        </div>
                        <h4 class="font-serif text-lg font-bold text-[#163923]">Eco-Conscious Recyclable</h4>
                        <p class="text-xs text-[#677a6d] leading-relaxed">
                            100% recyclable, BPA-free food-safe packaging designed for environmental responsibility and reuse.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 7: CERTIFICATIONS & COMPLIANCE -->
    <section class="py-16 sm:py-24 bg-[#F5EFE6] border-b border-[#e5decb]/70">
        <div class="site-container">
            <div class="max-w-3xl mx-auto text-center space-y-4 mb-16">
                <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#205132]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#205132]"></span>
                    <span>Trust &amp; Compliance</span>
                </div>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923]">
                    Certified Purity You Can Trust
                </h2>
                <p class="text-sm sm:text-base text-[#677a6d] leading-relaxed">
                    Upholding the highest national and international standards in clean food production.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6 rounded-3xl bg-white border border-[#e5decb] text-center space-y-3 shadow-2xs hover:border-[#205132]/40 transition-all">
                    <div class="flex h-14 w-14 mx-auto items-center justify-center rounded-2xl bg-[#205132]/10 text-[#205132] border border-[#205132]/20">
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                    </div>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">FSSAI Certified</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        Licensed and registered under Food Safety and Standards Authority of India regulations.
                    </p>
                </div>

                <div class="p-6 rounded-3xl bg-white border border-[#e5decb] text-center space-y-3 shadow-2xs hover:border-[#205132]/40 transition-all">
                    <div class="flex h-14 w-14 mx-auto items-center justify-center rounded-2xl bg-[#205132]/10 text-[#205132] border border-[#205132]/20">
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>
                    </div>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">100% Plant-Based</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        Zero animal derivatives, dairy, gluten, or gelatin across all manufacturing lines.
                    </p>
                </div>

                <div class="p-6 rounded-3xl bg-white border border-[#e5decb] text-center space-y-3 shadow-2xs hover:border-[#205132]/40 transition-all">
                    <div class="flex h-14 w-14 mx-auto items-center justify-center rounded-2xl bg-[#205132]/10 text-[#205132] border border-[#205132]/20">
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" x2="9.01" y1="9" y2="9"/><line x1="15" x2="15.01" y1="9" y2="9"/></svg>
                    </div>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">Non-GMO Verified</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        Traceable heirloom seed sources free from genetic modification or hybridization.
                    </p>
                </div>

                <div class="p-6 rounded-3xl bg-white border border-[#e5decb] text-center space-y-3 shadow-2xs hover:border-[#205132]/40 transition-all">
                    <div class="flex h-14 w-14 mx-auto items-center justify-center rounded-2xl bg-[#205132]/10 text-[#205132] border border-[#205132]/20">
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h4 class="font-serif text-lg font-bold text-[#163923]">Zero Preservatives</h4>
                    <p class="text-xs text-[#677a6d] leading-relaxed">
                        Guaranteed zero chemical shelf-life extenders, parabens, or synthetic stabilizers.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 8: CALL TO ACTION -->
    <section class="py-20 lg:py-24 bg-[#163923] text-white text-center relative overflow-hidden border-t border-[#e5decb]/20">
        <div class="absolute inset-0 bg-gradient-to-br from-[#205132]/40 via-transparent to-[#c9a25a]/20 pointer-events-none"></div>
        <div class="site-container relative z-10 max-w-3xl mx-auto space-y-6">
            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-[10px] font-bold tracking-[0.2em] uppercase bg-white/10 text-[#FAF8F5] border border-white/15">
                <svg class="w-3.5 h-3.5 text-[#c9a25a]" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                Taste The Purity
            </span>

            <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight leading-tight">
                Pure Plant Food. <br class="hidden sm:inline">
                <span class="text-[#c9a25a]">Zero Compromises.</span>
            </h2>

            <p class="text-sm sm:text-base text-[#FAF8F5]/80 max-w-xl mx-auto leading-relaxed">
                Discover the difference of genuine cold-dehydrated whole food powders crafted for clean daily vitality.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                <a
                    href="{{ route('shop.product_or_category.index', 'products') }}"
                    class="px-8 py-4 bg-gradient-to-r from-[#c9a25a] to-[#b08a43] text-white text-xs font-bold tracking-[0.15em] uppercase rounded-full hover:from-[#d6b677] hover:to-[#c9a25a] hover:shadow-lg hover:shadow-[#c9a25a]/30 transition-all duration-300"
                >
                    Explore Formulations &rarr;
                </a>
                <a
                    href="{{ route('shop.cms.page', 'about-us') }}"
                    class="px-8 py-4 bg-transparent text-[#FAF8F5] text-xs font-bold tracking-[0.15em] uppercase rounded-full border border-[#FAF8F5]/30 hover:border-white hover:text-white hover:bg-white/10 transition-all duration-300"
                >
                    Read Our Philosophy
                </a>
            </div>
        </div>
    </section>
</div>
