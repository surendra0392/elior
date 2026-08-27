<div class="bg-[#FAF8F5] min-h-screen">
    @if (core()->getConfigData('general.general.breadcrumbs.shop'))
        <!-- Breadcrumbs -->
        <div class="site-container pt-4 pb-2 sm:pt-6 sm:pb-3">
            <nav aria-label="Breadcrumb" class="flex items-center space-x-2 text-[11px] sm:text-xs uppercase tracking-[0.14em] text-[#677a6d]">
                <a href="{{ route('shop.home.index') }}" class="hover:text-[#205132] transition-colors">Home</a>
                <span class="text-[#e5decb]">/</span>
                <span class="text-[#163923] font-semibold">About Us</span>
            </nav>
        </div>
    @endif

    <!-- SECTION 1: EDITORIAL HERO & MISSION MANIFESTO -->
    <section class="site-container pt-8 pb-16 sm:pt-14 sm:pb-20 border-b border-[#e5decb]/70">
        <div class="max-w-4xl mx-auto text-center space-y-6">
            <!-- Brand Tagline Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#205132]/10 text-[#205132] text-xs font-semibold tracking-widest uppercase border border-[#205132]/20 shadow-2xs">
                <svg class="w-4 h-4 text-[#205132]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/>
                    <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>
                </svg>
                <span>Pure by Nature, Made for You</span>
            </div>

            <!-- Main Heading -->
            <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#163923] leading-[1.14]">
                Born from a Radical Belief: <br class="hidden sm:inline">
                <span class="italic text-[#205132] font-normal">Nature Needs No Improvement, Only Respect.</span>
            </h1>

            <!-- Mission Paragraph -->
            <p class="text-base sm:text-lg lg:text-xl leading-relaxed text-[#677a6d] max-w-2xl mx-auto">
                We set out to challenge a supplement industry built on high-heat spray drying, synthetic carrier starches, and diluted extracts. ELIOR crafts pure whole-food botanical powders, gently cold-dehydrated below 42°C to preserve the living integrity of the plant.
            </p>

            <!-- Hero Feature Image Card -->
            <div class="relative mt-10 overflow-hidden rounded-3xl border border-[#e5decb] bg-white shadow-xl">
                <img
                    src="{{ asset('storage/theme/cms/elior-about-story.webp') }}"
                    alt="ELIOR Botanical Harvest Terroir"
                    class="h-64 sm:h-96 lg:h-[460px] w-full object-cover transition-transform duration-700 hover:scale-105"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-[#163923]/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-6 left-6 right-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4 text-white text-left">
                    <div>
                        <span class="inline-block px-3 py-1 rounded-full bg-[#c9a25a] text-[#163923] text-[10px] font-bold tracking-widest uppercase mb-2">
                            Regenerative Terroir
                        </span>
                        <h3 class="font-serif text-xl sm:text-2xl font-bold">Pristine Single-Origin Cultivation</h3>
                        <p class="text-xs sm:text-sm text-white/80 max-w-md mt-0.5">Hand-harvested at botanical peak maturity and dried within hours of harvest.</p>
                    </div>
                    <div class="flex items-center gap-2 rounded-2xl bg-white/10 backdrop-blur-md px-4 py-2 border border-white/20">
                        <svg class="w-5 h-5 text-[#83B740]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-xs font-semibold tracking-wide">100% Bioavailable</span>
                    </div>
                </div>
            </div>

            <!-- 4 Trust Metrics Strip -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6 pt-6 text-left">
                <div class="p-5 rounded-2xl bg-white border border-[#e5decb] shadow-2xs hover:border-[#205132]/30 transition-all">
                    <p class="font-serif text-3xl font-bold text-[#163923]">100%</p>
                    <p class="text-xs uppercase tracking-wider text-[#205132] font-semibold mt-1">Whole Food Matter</p>
                    <p class="text-[11px] text-[#677a6d] mt-0.5">Zero maltodextrins or synthetic bulking agents.</p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-[#e5decb] shadow-2xs hover:border-[#205132]/30 transition-all">
                    <p class="font-serif text-3xl font-bold text-[#163923]">&lt; 42°C</p>
                    <p class="text-xs uppercase tracking-wider text-[#205132] font-semibold mt-1">Cold Dehydration</p>
                    <p class="text-[11px] text-[#677a6d] mt-0.5">Living enzymes, aroma, and nutrients intact.</p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-[#e5decb] shadow-2xs hover:border-[#205132]/30 transition-all">
                    <p class="font-serif text-3xl font-bold text-[#163923]">0%</p>
                    <p class="text-xs uppercase tracking-wider text-[#205132] font-semibold mt-1">Synthetic Additives</p>
                    <p class="text-[11px] text-[#677a6d] mt-0.5">No artificial sweeteners, flavors, or silica.</p>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-[#e5decb] shadow-2xs hover:border-[#205132]/30 transition-all">
                    <p class="font-serif text-3xl font-bold text-[#163923]">100%</p>
                    <p class="text-xs uppercase tracking-wider text-[#205132] font-semibold mt-1">Batch Verified</p>
                    <p class="text-[11px] text-[#677a6d] mt-0.5">Third-party tested for heavy metals and purity.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: THE FOUNDING STORY & THE SPARK -->
    <section class="py-16 sm:py-24 bg-white border-b border-[#e5decb]/70">
        <div class="site-container">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                <!-- Left Story Column -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#205132]">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#205132]"></span>
                        <span>The Genesis</span>
                    </div>

                    <h2 class="font-serif text-2xl sm:text-4xl font-bold text-[#163923] leading-tight">
                        The Disillusionment with Modern Supplements
                    </h2>
                    
                    <div class="space-y-4 text-sm sm:text-base text-[#677a6d] leading-relaxed">
                        <p>
                            Like many seeking daily vitality, we turned to nutritional superfoods and adaptogens. But reading the fine print of commercial powders revealed an uncomfortable truth: most products labeled as "pure botanical extracts" contained up to 70% maltodextrin carriers, flow agents, and synthetic processing aids.
                        </p>
                        <p>
                            Worse still, the standard manufacturing process relies on industrial spray-drying—blasting fragile herbs with temperatures over 160°C. This annihilates delicate enzymatic structures, degrades heat-sensitive antioxidants, and destroys the living life-force of the harvest.
                        </p>
                        <p class="p-4 rounded-2xl bg-[#FAF8F5] border-l-4 border-[#205132] text-[#163923] font-medium">
                            We asked a simple question: <strong class="text-[#163923] font-bold">Why compromise the botanical integrity of whole foods when nature already perfected their synergy?</strong>
                        </p>
                        <p>
                            ELIOR was created to build a radically clean alternative: single-origin whole foods dried at ambient low temperatures, micro-milled for instant dissolvability, and delivered with zero fillers.
                        </p>
                    </div>
                </div>

                <!-- Right Pull Quote Card -->
                <div class="lg:col-span-5">
                    <div class="rounded-3xl bg-[#163923] p-8 sm:p-10 text-white space-y-6 shadow-xl relative overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#205132]/40 rounded-full blur-2xl pointer-events-none"></div>
                        
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 text-[#c9a25a] border border-white/15">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                        </div>

                        <blockquote class="font-serif text-lg sm:text-xl italic leading-relaxed text-[#FAF8F5]">
                            "If you cannot trace the botanical directly back to living soil, and if you have to hide it behind artificial sweeteners and bulking agents, it does not belong in your body."
                        </blockquote>

                        <div class="pt-5 border-t border-white/15 text-xs text-[#FAF8F5]/80 flex items-center justify-between">
                            <div>
                                <p class="font-bold text-white tracking-wide">The ELIOR Formulation Standard</p>
                                <p class="text-[11px] text-[#c9a25a] mt-0.5 font-medium">Cold-Dehydrated Whole Food Nutrition</p>
                            </div>
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-[#205132] text-white">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: THE 4 FORMULATION PILLARS -->
    <section class="py-16 sm:py-24 bg-[#F5EFE6] border-b border-[#e5decb]/70">
        <div class="site-container">
            <div class="max-w-3xl mx-auto text-center space-y-4 mb-16">
                <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#205132]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#205132]"></span>
                    <span>Our Guiding Science</span>
                </div>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923]">
                    The Four Pillars of Botanical Purity
                </h2>
                <p class="text-sm sm:text-base text-[#677a6d] leading-relaxed">
                    Every formulation we create adheres strictly to these non-negotiable standards of botanical excellence.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Pillar 01 -->
                <div class="p-8 sm:p-10 rounded-3xl bg-white border border-[#e5decb] shadow-2xs space-y-4 hover:border-[#205132] hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#205132]/10 text-[#205132] font-serif text-lg font-bold border border-[#205132]/20">
                            01
                        </span>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#c9a25a]">Temperature Discipline</span>
                    </div>
                    <h3 class="font-serif text-2xl font-bold text-[#163923]">
                        Cold-Dehydration Under 42°C
                    </h3>
                    <p class="text-sm leading-relaxed text-[#677a6d]">
                        High heat permanently damages sensitive enzymes and oxidizes volatile phytochemicals. We utilize low-temperature vacuum dehydration chambers that extract moisture below 42°C. This preserves the original cellular structure, vibrant chlorophyll, live antioxidants, and genuine taste profile of the raw harvest.
                    </p>
                </div>

                <!-- Pillar 02 -->
                <div class="p-8 sm:p-10 rounded-3xl bg-white border border-[#e5decb] shadow-2xs space-y-4 hover:border-[#205132] hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#205132]/10 text-[#205132] font-serif text-lg font-bold border border-[#205132]/20">
                            02
                        </span>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#c9a25a]">Absolute Honesty</span>
                    </div>
                    <h3 class="font-serif text-2xl font-bold text-[#163923]">
                        Zero-Additive Whole Plant Standard
                    </h3>
                    <p class="text-sm leading-relaxed text-[#677a6d]">
                        We believe ingredient lists should be 100% recognizable whole foods. We refuse to use maltodextrin carriers, anti-caking silicon dioxide, artificial or natural-identical flavors, synthetic dyes, or stevia/erythritol sweeteners. When you open a jar of ELIOR, you receive 100% pure botanical matter and nothing else.
                    </p>
                </div>

                <!-- Pillar 03 -->
                <div class="p-8 sm:p-10 rounded-3xl bg-white border border-[#e5decb] shadow-2xs space-y-4 hover:border-[#205132] hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#205132]/10 text-[#205132] font-serif text-lg font-bold border border-[#205132]/20">
                            03
                        </span>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#c9a25a]">Effortless Rituals</span>
                    </div>
                    <h3 class="font-serif text-2xl font-bold text-[#163923]">
                        Precision Cryo Micro-Milling
                    </h3>
                    <p class="text-sm leading-relaxed text-[#677a6d]">
                        Because we refuse synthetic gums and chemical emulsifiers, we engineer liquid dissolvability mechanically. Our botanicals undergo gentle cryogenic micro-milling, reducing whole dried leaves, roots, and fruits into micron-sized particles that suspend instantaneously in water, smoothies, morning tonics, or warm plant milks.
                    </p>
                </div>

                <!-- Pillar 04 -->
                <div class="p-8 sm:p-10 rounded-3xl bg-white border border-[#e5decb] shadow-2xs space-y-4 hover:border-[#205132] hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#205132]/10 text-[#205132] font-serif text-lg font-bold border border-[#205132]/20">
                            04
                        </span>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#c9a25a]">Total Accountability</span>
                    </div>
                    <h3 class="font-serif text-2xl font-bold text-[#163923]">
                        Single-Origin Sourcing & Batch Verification
                    </h3>
                    <p class="text-sm leading-relaxed text-[#677a6d]">
                        We partner directly with sustainable growers who cultivate in rich, pesticide-free soil. Every single agricultural batch is assigned a unique tracking lot and submitted for comprehensive third-party laboratory analysis to verify absence of heavy metals, pesticides, and microbiological contaminants.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: BOTANICAL TERROIRS & SOURCING GEOGRAPHY -->
    <section class="py-16 sm:py-24 bg-white border-b border-[#e5decb]/70">
        <div class="site-container">
            <div class="max-w-3xl mx-auto text-center space-y-4 mb-16">
                <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#205132]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#205132]"></span>
                    <span>Botanical Origins</span>
                </div>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923]">
                    Harvested in Sacred Terroirs
                </h2>
                <p class="text-sm sm:text-base text-[#677a6d] leading-relaxed">
                    Plants develop peak active phytonutrient density when grown in their native ecological habitats.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Terroir 1 -->
                <div class="p-6 rounded-2xl bg-[#FAF8F5] border border-[#e5decb] space-y-4 hover:border-[#205132]/40 transition-all">
                    <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#205132]">
                        <svg class="w-4 h-4 text-[#205132]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                        <span>Meghalaya, India</span>
                    </div>
                    <h4 class="font-serif text-xl font-bold text-[#163923]">Lakadong Turmeric</h4>
                    <p class="text-xs sm:text-sm leading-relaxed text-[#677a6d]">
                        Cultivated in the pristine volcanic hills of Meghalaya, yielding an astonishing 7.5% natural curcumin density—over triple the potency of ordinary commercial turmeric.
                    </p>
                </div>

                <!-- Terroir 2 -->
                <div class="p-6 rounded-2xl bg-[#FAF8F5] border border-[#e5decb] space-y-4 hover:border-[#205132]/40 transition-all">
                    <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#205132]">
                        <svg class="w-4 h-4 text-[#205132]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                        <span>Tamil Nadu</span>
                    </div>
                    <h4 class="font-serif text-xl font-bold text-[#163923]">Organic Moringa</h4>
                    <p class="text-xs sm:text-sm leading-relaxed text-[#677a6d]">
                        Grown in regenerative agro-forestry belts, hand-harvested at dawn, and shade-dried below 38°C to protect 46 natural antioxidants and complete plant amino acid profiles.
                    </p>
                </div>

                <!-- Terroir 3 -->
                <div class="p-6 rounded-2xl bg-[#FAF8F5] border border-[#e5decb] space-y-4 hover:border-[#205132]/40 transition-all">
                    <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#205132]">
                        <svg class="w-4 h-4 text-[#205132]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                        <span>Mineral Bioreactors</span>
                    </div>
                    <h4 class="font-serif text-xl font-bold text-[#163923]">Artisanal Spirulina</h4>
                    <p class="text-xs sm:text-sm leading-relaxed text-[#677a6d]">
                        Nurtured in pure alkaline waters free from industrial runoff, cold-filtered, and milled into bioavailable phycocyanin with 65% raw plant protein by weight.
                    </p>
                </div>

                <!-- Terroir 4 -->
                <div class="p-6 rounded-2xl bg-[#FAF8F5] border border-[#e5decb] space-y-4 hover:border-[#205132]/40 transition-all">
                    <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#205132]">
                        <svg class="w-4 h-4 text-[#205132]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                        <span>Rajasthan Arid Soils</span>
                    </div>
                    <h4 class="font-serif text-xl font-bold text-[#163923]">Organic Ashwagandha</h4>
                    <p class="text-xs sm:text-sm leading-relaxed text-[#677a6d]">
                        Organic root adaptogen harvested after 180 days of deep root maturation, offering standardized full-spectrum withanolides for nervous system recovery and restorative vitality.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 5: THE MATRIX (WHAT WE NEVER USE VS ALWAYS DELIVER) -->
    <section class="py-16 sm:py-24 bg-[#F5EFE6] border-b border-[#e5decb]/70">
        <div class="site-container">
            <div class="max-w-3xl mx-auto text-center space-y-4 mb-16">
                <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#205132]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#205132]"></span>
                    <span>The Standard Matrix</span>
                </div>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-[#163923]">
                    Our Uncompromising Code
                </h2>
                <p class="text-sm sm:text-base text-[#677a6d] leading-relaxed">
                    What we keep out is just as important as what we put in.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- What We NEVER Use -->
                <div class="p-8 rounded-3xl bg-[#FEF2F2] border border-[#FCA5A5] space-y-5">
                    <div class="flex items-center gap-2.5 text-[#991B1B] font-serif text-xl font-bold">
                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-[#FEE2E2] text-[#991B1B]">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </div>
                        <span>What We NEVER Use</span>
                    </div>
                    <ul class="space-y-3.5 text-xs sm:text-sm text-[#163923]/90 font-medium">
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#991B1B] font-bold shrink-0">✕</span>
                            <span><strong>No Maltodextrin:</strong> Zero cheap carbohydrate carriers or bulking starches.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#991B1B] font-bold shrink-0">✕</span>
                            <span><strong>No Silicon Dioxide:</strong> Zero synthetic anti-caking or free-flow chemical agents.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#991B1B] font-bold shrink-0">✕</span>
                            <span><strong>No High-Heat Spray Drying:</strong> Never exposed to destructive &gt;150°C processing.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#991B1B] font-bold shrink-0">✕</span>
                            <span><strong>No Artificial Sweeteners:</strong> Zero stevia extracts, sucralose, or artificial flavorings.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#991B1B] font-bold shrink-0">✕</span>
                            <span><strong>No Chemical Preservatives:</strong> Never treated with synthetic shelf-life extenders.</span>
                        </li>
                    </ul>
                </div>

                <!-- What We ALWAYS Deliver -->
                <div class="p-8 rounded-3xl bg-[#EBF3EE] border border-[#205132]/30 space-y-5">
                    <div class="flex items-center gap-2.5 text-[#205132] font-serif text-xl font-bold">
                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-[#205132] text-white">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span>What We ALWAYS Deliver</span>
                    </div>
                    <ul class="space-y-3.5 text-xs sm:text-sm text-[#163923]/90 font-medium">
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#205132] font-bold shrink-0">✓</span>
                            <span><strong>100% Whole Plants:</strong> Only pure, recognizable botanical ingredients.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#205132] font-bold shrink-0">✓</span>
                            <span><strong>Cold Dehydration (&lt;42°C):</strong> Living enzymes, aroma, and nutrients fully protected.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#205132] font-bold shrink-0">✓</span>
                            <span><strong>Instant Bioavailability:</strong> Cryogenic micro-milling for seamless dissolvability.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#205132] font-bold shrink-0">✓</span>
                            <span><strong>Third-Party Lab Tested:</strong> Every lot verified for heavy metals and purity.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#205132] font-bold shrink-0">✓</span>
                            <span><strong>Nitrogen Sealed:</strong> Triple-barrier protection against oxidation and humidity.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 6: SUSTAINABILITY & REGENERATIVE STEWARDSHIP -->
    <section class="py-16 sm:py-24 bg-white border-b border-[#e5decb]/70">
        <div class="site-container">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5 space-y-6">
                    <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#205132]">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#205132]"></span>
                        <span>Stewardship</span>
                    </div>
                    <h2 class="font-serif text-3xl sm:text-4xl font-bold tracking-tight text-[#163923] leading-tight">
                        Honoring the Soil that Sustains Us
                    </h2>
                    <p class="text-sm sm:text-base text-[#677a6d] leading-relaxed">
                        Nutrient density starts in healthy living soil. We partner with smallholder farming communities who practice regenerative soil management, crop rotation, and water conservation without synthetic chemical fertilizers.
                    </p>
                    <div class="flex items-center gap-4 text-xs font-semibold uppercase tracking-wider text-[#205132]">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[#205132]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            Regenerative Farming
                        </span>
                        <span class="text-[#e5decb]">•</span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[#205132]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/><path d="M16 21h5v-5"/></svg>
                            Recyclable Packaging
                        </span>
                    </div>
                </div>

                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="p-6 rounded-2xl bg-[#FAF8F5] border border-[#e5decb] space-y-3 hover:border-[#205132]/30 transition-all">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#205132]/10 text-[#205132]">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <h4 class="font-serif text-lg font-bold text-[#163923]">Fair Grower Compensation</h4>
                        <p class="text-xs text-[#677a6d] leading-relaxed">
                            Paying premium above-market rates to family farms that safeguard indigenous botanical varieties and local agricultural biodiversity.
                        </p>
                    </div>

                    <div class="p-6 rounded-2xl bg-[#FAF8F5] border border-[#e5decb] space-y-3 hover:border-[#205132]/30 transition-all">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#205132]/10 text-[#205132]">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>
                        </div>
                        <h4 class="font-serif text-lg font-bold text-[#163923]">Zero-Waste Harvesting</h4>
                        <p class="text-xs text-[#677a6d] leading-relaxed">
                            Every harvest byproduct is composted back into agricultural soil to regenerate natural organic matter for future generations.
                        </p>
                    </div>

                    <div class="p-6 rounded-2xl bg-[#FAF8F5] border border-[#e5decb] space-y-3 hover:border-[#205132]/30 transition-all">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#205132]/10 text-[#205132]">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <h4 class="font-serif text-lg font-bold text-[#163923]">Nitrogen Barrier Seals</h4>
                        <p class="text-xs text-[#677a6d] leading-relaxed">
                            Flushing each jar with inert nitrogen gas preserves fresh botanical potency without requiring chemical preservatives.
                        </p>
                    </div>

                    <div class="p-6 rounded-2xl bg-[#FAF8F5] border border-[#e5decb] space-y-3 hover:border-[#205132]/30 transition-all">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#205132]/10 text-[#205132]">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <h4 class="font-serif text-lg font-bold text-[#163923]">FSSAI Certified</h4>
                        <p class="text-xs text-[#677a6d] leading-relaxed">
                            Manufactured in rigorously audited, certified food processing environments upholding pharmaceutical clean-room hygiene.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 7: EDITORIAL CALL TO ACTION -->
    <section class="py-20 lg:py-24 bg-[#163923] text-white text-center relative overflow-hidden border-t border-[#e5decb]/20">
        <div class="absolute inset-0 bg-gradient-to-br from-[#205132]/40 via-transparent to-[#c9a25a]/20 pointer-events-none"></div>
        <div class="site-container relative z-10 max-w-3xl mx-auto space-y-6">
            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-[10px] font-bold tracking-[0.2em] uppercase bg-white/10 text-[#FAF8F5] border border-white/15">
                <svg class="w-3.5 h-3.5 text-[#c9a25a]" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                Experience The Difference
            </span>

            <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight leading-tight">
                Ready to Experience <br class="hidden sm:inline">
                <span class="text-[#c9a25a]">True Botanical Nutrition?</span>
            </h2>

            <p class="text-sm sm:text-base text-[#FAF8F5]/80 max-w-xl mx-auto leading-relaxed">
                Explore our collection of cold-dehydrated single-origin botanicals and functional blends crafted for clean daily vitality.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                <a
                    href="{{ route('shop.product_or_category.index', 'products') }}"
                    class="px-8 py-4 bg-gradient-to-r from-[#c9a25a] to-[#b08a43] text-white text-xs font-bold tracking-[0.15em] uppercase rounded-full hover:from-[#d6b677] hover:to-[#c9a25a] hover:shadow-lg hover:shadow-[#c9a25a]/30 transition-all duration-300"
                >
                    Explore Formulations &rarr;
                </a>
                <a
                    href="{{ route('shop.recipes.index') }}"
                    class="px-8 py-4 bg-transparent text-[#FAF8F5] text-xs font-bold tracking-[0.15em] uppercase rounded-full border border-[#FAF8F5]/30 hover:border-white hover:text-white hover:bg-white/10 transition-all duration-300"
                >
                    View Botanical Recipes
                </a>
            </div>
        </div>
    </section>
</div>
