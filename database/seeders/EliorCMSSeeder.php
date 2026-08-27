<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EliorCMSSeeder extends Seeder
{
    /**
     * Seed ELIOR custom CMS editorial & policy pages.
     */
    public function run(): void
    {
        $this->command->info('=== ELIOR CMS Pages Seeder ===');

        $now = Carbon::now();

        // 1. Copy CMS Media Assets from package seeders
        $cmsPackageDir = base_path('packages/Webkul/Installer/src/Resources/assets/images/seeders/cms');
        $storageCmsDir = storage_path('app/public/theme/cms');
        $publicCmsDir = public_path('storage/theme/cms');

        if (! file_exists($storageCmsDir)) {
            mkdir($storageCmsDir, 0777, true);
        }
        if (! file_exists($publicCmsDir)) {
            mkdir($publicCmsDir, 0777, true);
        }

        $cmsFiles = [
            'elior-about-story.jpg',
            'elior-about-story.webp',
            'elior-quality-lab.jpg',
            'elior-quality-lab.webp',
        ];

        foreach ($cmsFiles as $file) {
            $pkgFile = $cmsPackageDir.'/'.$file;
            if (file_exists($pkgFile)) {
                copy($pkgFile, $storageCmsDir.'/'.$file);
                copy($pkgFile, $publicCmsDir.'/'.$file);
            }
        }

        $pages = [
            [
                'id' => 1,
                'url_key' => 'about-us',
                'page_title' => 'Our Philosophy & Origins',
                'meta_title' => 'Our Philosophy & Sourcing Origins | Pure Whole Plant Nutrition | ELIOR',
                'meta_description' => 'Discover the ELIOR genesis: cold-dehydrated botanical nutrition crafted below 42°C from sustainable, regenerative terroir with zero synthetic fillers.',
                'meta_keywords' => 'about elior, elior philosophy, cold dehydration science, regenerative botanicals, clean label whole food, zero additives, ELIOR origins',
                'html_content' => '<div class="bg-[#FAF8F5] min-h-screen">
    
        <!-- Breadcrumbs -->
        <div class="site-container pt-4 pb-2 sm:pt-6 sm:pb-3">
            <nav aria-label="Breadcrumb" class="flex items-center space-x-2 text-[11px] sm:text-xs uppercase tracking-[0.14em] text-[#677a6d]">
                <a href="/" class="hover:text-[#205132] transition-colors">Home</a>
                <span class="text-[#e5decb]">/</span>
                <span class="text-[#163923] font-semibold">About Us</span>
            </nav>
        </div>
    

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
                    src="/storage/theme/cms/elior-about-story.webp"
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
                    href="/products"
                    class="px-8 py-4 bg-gradient-to-r from-[#c9a25a] to-[#b08a43] text-white text-xs font-bold tracking-[0.15em] uppercase rounded-full hover:from-[#d6b677] hover:to-[#c9a25a] hover:shadow-lg hover:shadow-[#c9a25a]/30 transition-all duration-300"
                >
                    Explore Formulations &rarr;
                </a>
                <a
                    href="/page/recipes"
                    class="px-8 py-4 bg-transparent text-[#FAF8F5] text-xs font-bold tracking-[0.15em] uppercase rounded-full border border-[#FAF8F5]/30 hover:border-white hover:text-white hover:bg-white/10 transition-all duration-300"
                >
                    View Botanical Recipes
                </a>
            </div>
        </div>
    </section>
</div>
',
            ],
            [
                'id' => 2,
                'url_key' => 'return-policy',
                'page_title' => 'Return & Replacement Policy',
                'meta_title' => 'Return & Replacement Policy | 100% Botanical Purity Guarantee | ELIOR',
                'meta_description' => 'Our commitment to purity: 48-hour transit damage reporting, hassle-free batch replacement, and guidelines for sealed botanical powder returns.',
                'meta_keywords' => 'return policy, replacement guarantee, order return guidelines, damaged order policy, ELIOR',
                'html_content' => '<h2>1. 100% Botanical Purity Guarantee</h2>
<p>At ELIOR, we stand behind the uncompromising quality and cold-dehydrated freshness of every botanical formulation we craft. If your shipment arrives defective, damaged, or with a broken hermetic seal, we will replace it immediately at zero cost to you.</p>

<h2>2. Eligibility for Replacement</h2>
<ul>
    <li><strong>Damaged or Leaked in Transit:</strong> If the packaging arrived compromised or leaking.</li>
    <li><strong>Incorrect Formulation Received:</strong> If the delivered SKU does not match your order confirmation.</li>
    <li><strong>Broken Induction Seal:</strong> If the inner protective seal was broken upon arrival.</li>
</ul>

<h2>3. How to Request a Replacement</h2>
<p>Please notify our customer care team within <strong>48 hours of delivery</strong> by emailing <a href="mailto:care@elior.in">care@elior.in</a> or sending a message on WhatsApp at <a href="https://wa.me/919876543210">+91 98765 43210</a> with your Order ID and a clear photograph of the damaged product. Our support specialists will arrange a priority replacement dispatch within 24 hours.</p>

<h2>4. Non-Returnable Items</h2>
<p>Due to stringent food safety and hygiene regulations for edible botanical food products, jars that have been unsealed, opened, or consumed cannot be returned for restock.</p>',
            ],
            [
                'id' => 3,
                'url_key' => 'refund-policy',
                'page_title' => 'Refund Policy',
                'meta_title' => 'Refund Policy | Transparent 5-7 Day Banking Reversals | ELIOR',
                'meta_description' => 'Official refund processing timelines, payment gateway SLAs, and reimbursement methods for cancelled or approved return shipments.',
                'meta_keywords' => 'refund policy, refund processing time, payment reversal, customer reimbursement, ELIOR',
                'html_content' => '<h2>1. Refund Eligibility</h2>
<p>Refunds are initiated in cases of order cancellations requested prior to dispatch, verified product unavailability, or where an approved replacement is unavailable.</p>

<h2>2. Refund Processing Timeframes</h2>
<ul>
    <li><strong>Prepaid UPI & Net Banking Orders:</strong> 3–5 business days to credit back to the original bank account.</li>
    <li><strong>Credit & Debit Cards:</strong> 5–7 business days depending on your issuing bank\'s settlement cycle.</li>
    <li><strong>Digital Wallets:</strong> 24–48 hours to credit to the original wallet.</li>
</ul>

<h2>3. Cancellation Policy</h2>
<p>You may cancel an order free of charge at any time prior to shipment dispatch. Once a parcel has been handed over to our logistics partner, cancellations cannot be accepted; however, our replacement policy remains fully applicable upon delivery.</p>',
            ],
            [
                'id' => 4,
                'url_key' => 'terms-conditions',
                'page_title' => 'Terms & Conditions of Sale',
                'meta_title' => 'Terms & Conditions of Sale | Order & Usage Guidelines | ELIOR',
                'meta_description' => 'Official terms and conditions governing purchases, pricing, dispatch, botanical consumption guidelines, and customer agreements on ELIOR.',
                'meta_keywords' => 'terms and conditions, terms of sale, purchase agreement, legal terms, customer rights, ELIOR',
                'html_content' => '<h2>1. Introduction & Agreement</h2>
<p>Welcome to ELIOR ("we," "our," or "us"). By accessing or purchasing botanical nutrition formulations through our website, you agree to be bound by these Terms and Conditions of Sale. Please review these terms carefully before placing an order.</p>

<h2>2. Product Formulation & Botanical Disclaimers</h2>
<p>ELIOR formulations are 100% cold-dehydrated whole-plant food powders and functional botanical ingredients. While our formulations are produced under stringent FSSAI hygiene standards, our products are dietary food supplements and are not intended to diagnose, treat, cure, or prevent any disease.</p>
<p>If you are pregnant, nursing, taking prescription medications, or under medical supervision for a chronic condition, please consult your qualified healthcare practitioner prior to beginning any new botanical ritual.</p>

<h2>3. Orders, Pricing & Payment</h2>
<ul>
    <li><strong>Order Acceptance:</strong> Receipt of an electronic order confirmation does not signify our final acceptance of your order. We reserve the right to cancel or limit order quantities if inventory constraints arise.</li>
    <li><strong>Pricing:</strong> All prices are displayed in Indian Rupees (INR) and are inclusive of applicable goods and services taxes (GST).</li>
    <li><strong>Secure Payments:</strong> Payments are processed via encrypted, RBI-compliant payment gateways. We do not store credit or debit card numbers on our servers.</li>
</ul>

<h2>4. Intellectual Property</h2>
<p>All trademarks, logos, brand photography, botanical educational copy, recipe formulations, and website designs are the exclusive property of ELIOR. Unauthorized reproduction, scraping, or redistribution is strictly prohibited.</p>

<h2>5. Governing Law & Jurisdiction</h2>
<p>These terms and all purchase agreements shall be governed by and construed in accordance with the laws of India. Any disputes arising in connection with these terms shall be subject to the exclusive jurisdiction of the courts in Bengaluru, Karnataka.</p>',
            ],
            [
                'id' => 5,
                'url_key' => 'terms-of-use',
                'page_title' => 'Website Terms of Use',
                'meta_title' => 'Website Terms of Use | Digital Access & Intellectual Property | ELIOR',
                'meta_description' => 'Terms of use governing browsing, content usage, user accounts, and intellectual property rights across the ELIOR digital storefront.',
                'meta_keywords' => 'terms of use, website usage terms, intellectual property, acceptable use, ELIOR',
                'html_content' => '<h2>1. Acceptance of Terms</h2>
<p>By accessing and browsing this website, you acknowledge that you have read, understood, and agreed to adhere to these Terms of Use and all applicable regional laws and regulations.</p>

<h2>2. User Account Responsibility</h2>
<p>If you create a customer account on ELIOR, you are responsible for maintaining the confidentiality of your login credentials and restricting unauthorized access to your device. You agree to accept full responsibility for all activities that occur under your account.</p>

<h2>3. Prohibited Conduct</h2>
<p>You agree not to use the website to transmit malicious software, engage in automated data scraping without authorization, attempt unauthorized access to customer databases, or post unlawful, defamatory, or abusive content in product reviews.</p>

<h2>4. Modifications to the Service</h2>
<p>ELIOR reserves the right to modify, suspend, or discontinue any product collection, educational article, or storefront feature at any time without prior notice.</p>',
            ],
            [
                'id' => 6,
                'url_key' => 'customer-service',
                'page_title' => 'Customer Care & Support',
                'meta_title' => 'Customer Care & SLAs | Multi-Channel Botanical Support | ELIOR',
                'meta_description' => 'Connect with ELIOR customer care for dedicated order tracking, batch lab verification, personalized recipe recommendations, and wholesale inquiries.',
                'meta_keywords' => 'customer service, care team, help desk, order assistance, wholesale inquiry, ELIOR',
                'html_content' => '<h2>How May We Assist You?</h2>
<p>Our dedicated botanical customer care team is available to assist you with order status inquiries, dosage and recipe recommendations, batch testing verification, and wholesale orders.</p>

<h2>Direct Support Channels</h2>
<ul>
    <li><strong>Email Support:</strong> <a href="mailto:care@elior.in">care@elior.in</a> (Replies within 24 business hours)</li>
    <li><strong>Wholesale & Practitioner Email:</strong> <a href="mailto:wholesale@elior.in">wholesale@elior.in</a></li>
    <li><strong>Phone & WhatsApp Hotline:</strong> <a href="tel:+919876543210">+91 98765 43210</a></li>
    <li><strong>Operating Hours:</strong> Monday through Friday, 9:00 AM – 6:00 PM IST</li>
</ul>

<h2>Fulfillment & Packaging Hub</h2>
<p>ELIOR Botanical Research & Dispatch Hub<br>
Plot 42, Road No. 36, Jubilee Hills, Hyderabad, Telangana 500033, India</p>',
            ],
            [
                'id' => 7,
                'url_key' => 'whats-new',
                'page_title' => 'What\'s New',
                'meta_title' => 'What\'s New',
                'meta_description' => '',
                'meta_keywords' => 'new',
                'html_content' => '<div class="static-container"><div class="mb-5">What\'s New page content</div></div>',
            ],
            [
                'id' => 8,
                'url_key' => 'payment-policy',
                'page_title' => 'Payment Security & Methods',
                'meta_title' => 'Payment Security & Methods | RBI-Compliant 256-Bit Encryption | ELIOR',
                'meta_description' => 'Explore safe and encrypted payment options: UPI, major credit/debit cards, net banking, and Cash on Delivery with full RBI-compliant encryption.',
                'meta_keywords' => 'payment policy, secure payment gateway, upi payments, card security, cash on delivery, ELIOR',
                'html_content' => '<h2>1. Accepted Payment Methods</h2>
<p>To provide a smooth and secure checkout experience, ELIOR accepts all major digital payment methods:</p>
<ul>
    <li><strong>Unified Payments Interface (UPI):</strong> Google Pay, PhonePe, Paytm, BHIM, and bank UPI apps.</li>
    <li><strong>Debit & Credit Cards:</strong> Visa, MasterCard, RuPay, and American Express.</li>
    <li><strong>Net Banking:</strong> Supported across 50+ leading Indian banks.</li>
    <li><strong>Digital Wallets:</strong> Paytm, Mobikwik, and Amazon Pay.</li>
</ul>

<h2>2. Bank-Grade Payment Security</h2>
<p>All transactions on ELIOR are encrypted using 256-bit SSL protocols and processed through PCI-DSS Level 1 compliant payment gateways with mandatory Two-Factor Authentication (2FA / OTP verification). We never store sensitive CVV or card numbers on our systems.</p>',
            ],
            [
                'id' => 9,
                'url_key' => 'shipping-policy',
                'page_title' => 'Shipping & Delivery Policy',
                'meta_title' => 'Shipping & Delivery Policy | Express Pan-India Transit | ELIOR',
                'meta_description' => 'Learn about our express dispatch timeline, air-courier transit, temperature-controlled packaging, and free shipping on orders above ₹499.',
                'meta_keywords' => 'shipping policy, pan-india delivery, express courier, free shipping threshold, packaging standards, ELIOR',
                'html_content' => '<h2>1. Dispatch Timelines</h2>
<p>All orders placed before 2:00 PM IST on business days are processed, sealed in protective packaging, and dispatched within <strong>24 business hours</strong> directly from our certified Bengaluru fulfillment center. Orders placed over the weekend or on public holidays are dispatched on the following business day.</p>

<h2>2. Domestic Shipping & Delivery Timelines</h2>
<ul>
    <li><strong>Metro Cities (Bengaluru, Mumbai, Delhi NCR, Hyderabad, Chennai, Kolkata):</strong> 2–4 business days from dispatch.</li>
    <li><strong>Tier II & Tier III Cities:</strong> 4–7 business days from dispatch.</li>
    <li><strong>Remote & Hill Regions:</strong> 6–9 business days from dispatch.</li>
</ul>

<h2>3. Free Shipping Threshold</h2>
<p>We offer <strong>Free Standard Shipping</strong> across all pin codes in India on orders valued at <strong>₹499 or above</strong>. For orders below ₹499, a nominal flat delivery fee of ₹50 is applied at checkout.</p>

<h2>4. Live Tracking Updates</h2>
<p>Upon dispatch, you will receive an automated email and SMS notification containing your courier tracking number and real-time tracking link.</p>

<h2>5. Tamper-Evident Packaging</h2>
<p>Every ELIOR shipment is enclosed in recyclable, shock-resistant outer packaging with an unbroken hermetic inner seal to safeguard delicate botanical nutrients against humidity and temperature fluctuations during transit.</p>',
            ],
            [
                'id' => 10,
                'url_key' => 'privacy-policy',
                'page_title' => 'Privacy Policy & Data Protection',
                'meta_title' => 'Privacy Policy & Data Protection | 256-Bit SSL Security | ELIOR',
                'meta_description' => 'Read how ELIOR protects your personal data, secure payment transactions, cookie preferences, and confidentiality under strict data protection protocols.',
                'meta_keywords' => 'privacy policy, data protection, secure shopping, cookie policy, customer confidentiality, ELIOR',
                'html_content' => '<h2>1. Our Privacy Commitment</h2>
<p>ELIOR is deeply committed to safeguarding your personal privacy. We collect only the information necessary to fulfill your orders, provide customer care, and share functional botanical wellness guidance.</p>

<h2>2. Information We Collect</h2>
<ul>
    <li><strong>Order Fulfillment Information:</strong> Name, shipping address, billing address, email address, and phone number for delivery tracking.</li>
    <li><strong>Payment Details:</strong> Processed securely via tokenized payment gateways. ELIOR never views or stores raw credit/debit card numbers.</li>
    <li><strong>Account Preferences:</strong> Saved delivery addresses, order history, and newsletter subscription preferences.</li>
</ul>

<h2>3. How We Protect & Use Your Data</h2>
<p>We use industry-standard 256-bit SSL encryption to protect all data transmitted between your browser and our servers. We never sell, rent, or trade your personal information to third-party advertisers or data brokers under any circumstances.</p>

<h2>4. Cookies & Analytics</h2>
<p>We use essential cookies to maintain your shopping cart state and anonymized analytics cookies to understand website performance and improve user experience.</p>

<h2>5. Your Rights</h2>
<p>You have the right to request access to, correction of, or deletion of your personal account data at any time by contacting our Data Privacy Officer at <a href="mailto:care@elior.in">care@elior.in</a>.</p>',
            ],
            [
                'id' => 11,
                'url_key' => 'quality',
                'page_title' => 'Quality Standard & Lab Verification',
                'meta_title' => 'Quality Standard & Lab Verification | 5-Stage Purity Code | ELIOR',
                'meta_description' => 'Explore our scientific quality standard: closed-loop thermal dehydration, ISO/IEC 17025 ICP-MS heavy metal testing, and zero-tolerance chemical blacklist.',
                'meta_keywords' => 'quality standard, icp-ms testing, batch verification, heavy metal testing, pesticide screening, clean room dehydration, botanical purity, ELIOR',
                'html_content' => '<div class="bg-[#FAF8F5] min-h-screen">
    
        <!-- Breadcrumbs -->
        <div class="site-container pt-4 pb-2 sm:pt-6 sm:pb-3">
            <nav aria-label="Breadcrumb" class="flex items-center space-x-2 text-[11px] sm:text-xs uppercase tracking-[0.14em] text-[#677a6d]">
                <a href="/" class="hover:text-[#205132] transition-colors">Home</a>
                <span class="text-[#e5decb]">/</span>
                <span class="text-[#163923] font-semibold">Quality Standard</span>
            </nav>
        </div>
    

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
                    src="/storage/theme/cms/elior-quality-lab.webp"
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
                    href="/products"
                    class="px-8 py-4 bg-gradient-to-r from-[#c9a25a] to-[#b08a43] text-white text-xs font-bold tracking-[0.15em] uppercase rounded-full hover:from-[#d6b677] hover:to-[#c9a25a] hover:shadow-lg hover:shadow-[#c9a25a]/30 transition-all duration-300"
                >
                    Explore Formulations &rarr;
                </a>
                <a
                    href="/page/about-us"
                    class="px-8 py-4 bg-transparent text-[#FAF8F5] text-xs font-bold tracking-[0.15em] uppercase rounded-full border border-[#FAF8F5]/30 hover:border-white hover:text-white hover:bg-white/10 transition-all duration-300"
                >
                    Read Our Philosophy
                </a>
            </div>
        </div>
    </section>
</div>
',
            ],
            [
                'id' => 12,
                'url_key' => 'recipes',
                'page_title' => 'Recipes & Rituals',
                'meta_title' => 'Botanical Recipes & Daily Rituals | Functional Nutrition Guides | ELIOR',
                'meta_description' => 'Explore chef-crafted functional recipes, morning smoothie rituals, golden tonics, and nutrient-dense bowls powered by ELIOR pure botanical powders.',
                'meta_keywords' => 'botanical recipes, superfood smoothie recipes, golden milk tonic, moringa smoothie, beetroot bowl, turmeric latte recipe, functional nutrition rituals, ELIOR',
                'html_content' => '<div class="bg-elior-cream min-h-screen">


    <!-- Editorial Hero Section -->
    <section class="site-container pt-8 pb-12 sm:pt-12 sm:pb-16 text-center max-w-4xl mx-auto space-y-4">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#EBF3EE] text-elior-botanical text-[10px] sm:text-xs font-semibold tracking-widest uppercase">
            <span><span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: \'FILL\' 0, \'wght\' 300, \'GRAD\' 0, \'opsz\' 24;">eco</span></span>
            <span>ELIOR Recipes</span>
        </div>

        <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-elior-charcoal leading-[1.12]">
            Recipes & Daily Rituals
        </h1>

        <p class="text-sm sm:text-base text-elior-muted leading-relaxed max-w-2xl mx-auto font-sans">
            Practical whole food culinary ideas, morning tonics, and nourishing drink preparations crafted to incorporate ELIOR pure botanicals seamlessly into your everyday routine.
        </p>
    </section>

    <!-- Main Content Area -->
    <main class="site-container pb-20 space-y-16">
        

            <!-- Recipe Grid -->
            
        
            <!-- Editorial Restrained Empty State -->
            <section class="rounded-3xl border border-elior-border/80 bg-white p-8 sm:p-14 lg:p-20 text-center max-w-3xl mx-auto shadow-elior-subtle space-y-6">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#FAF8F5] border border-elior-border text-2xl">
                    <span class="material-symbols-outlined align-text-bottom text-inherit text-[1.2em] leading-none" aria-hidden="true" style="font-variation-settings: \'FILL\' 0, \'wght\' 300, \'GRAD\' 0, \'opsz\' 24;">emoji_food_beverage</span>
                </div>

                <div class="space-y-2.5">
                    <h2 class="font-serif text-2xl sm:text-3xl font-bold text-elior-charcoal">
                        Recipes Coming Soon
                    </h2>
                    <p class="text-sm text-elior-muted leading-relaxed max-w-lg mx-auto">
                        We are currently documenting authentic culinary preparations, cold-stirred morning tonics, and superblend smoothie rituals. Check back soon for step-by-step guides.
                    </p>
                </div>

                <div class="pt-2">
                    <a
                        href="/search"
                        class="elior-btn-primary inline-flex items-center gap-2 text-xs uppercase tracking-widest font-semibold px-7 py-3.5 shadow-elior-card"
                    >
                        <span>Explore Botanicals</span>
                        <span class="icon-arrow-right text-xs"></span>
                    </a>
                </div>
            </section>
        

        <!-- Botanical Discovery / Shop Ingredients Connection Section -->
        
    </main>
</div>',
            ],
        ];

        $locales = DB::table('locales')->pluck('code')->toArray() ?: ['en'];

        foreach ($pages as $item) {
            $pageId = $item['id'];
            $urlKey = $item['url_key'];
            $pageTitle = $item['page_title'];
            $metaTitle = $item['meta_title'];
            $metaDesc = $item['meta_description'];
            $metaKeywords = $item['meta_keywords'];
            $htmlContent = $item['html_content'];

            DB::table('cms_pages')->updateOrInsert(
                ['id' => $pageId],
                [
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );

            foreach ($locales as $locale) {
                DB::table('cms_page_translations')->updateOrInsert(
                    [
                        'cms_page_id' => $pageId,
                        'locale' => $locale,
                    ],
                    [
                        'url_key' => $urlKey,
                        'page_title' => $pageTitle,
                        'meta_title' => $metaTitle,
                        'meta_description' => $metaDesc,
                        'meta_keywords' => $metaKeywords,
                        'html_content' => $htmlContent,
                    ]
                );
            }

            // Ensure mapped to channel 1
            DB::table('cms_page_channels')->updateOrInsert([
                'cms_page_id' => $pageId,
                'channel_id' => 1,
            ]);
        }

        $this->command->info('ELIOR CMS Pages seeded successfully.');
    }
}
