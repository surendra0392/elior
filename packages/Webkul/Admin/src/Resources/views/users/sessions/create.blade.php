<x-admin::layouts.anonymous>
    <!-- Page Title -->
    <x-slot:title>
        @lang('admin::app.users.sessions.title') — {{ config('app.name', 'ELIOR') }}
    </x-slot>

    @push('styles')
    <style>
        .nature-canvas {
            background-color: #f4f0e6;
            background-image: radial-gradient(#e5decb 1.2px, transparent 1.2px);
            background-size: 24px 24px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .auth-split-wrapper {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 960px;
            min-height: 560px;
            border-radius: 28px;
            overflow: hidden;
            background-color: #205132;
            box-shadow: 0 30px 70px -15px rgba(22, 57, 35, 0.35), 0 0 0 1px rgba(201, 162, 90, 0.25);
        }

        @media (min-width: 900px) {
            .auth-split-wrapper {
                flex-direction: row;
                height: 560px;
                border-radius: 36px;
            }
            .nature-left-panel {
                width: 46% !important;
                height: 100% !important;
            }
            .form-right-panel {
                width: 54% !important;
                height: 100% !important;
                padding: 3.25rem 3.75rem !important;
            }
        }

        .nature-left-panel {
            position: relative;
            width: 100%;
            min-height: 260px;
            background: linear-gradient(180deg, #f4f0e6 0%, #e8f2ec 35%, #c5dfcf 70%, #a3cdb2 100%);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2.5rem 2.5rem;
            box-sizing: border-box;
        }

        .wave-separator {
            display: none;
        }

        @media (min-width: 900px) {
            .wave-separator {
                display: block;
                position: absolute;
                right: -1px;
                top: 0;
                bottom: 0;
                width: 75px;
                height: 100%;
                z-index: 10;
                pointer-events: none;
            }
        }

        .form-right-panel {
            position: relative;
            width: 100%;
            background-color: #205132;
            padding: 2.5rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-sizing: border-box;
            color: #f4f0e6;
        }

        .elior-nature-input {
            width: 100% !important;
            height: 48px !important;
            border-radius: 9999px !important;
            border: 1.5px solid rgba(201, 162, 90, 0.45) !important;
            background-color: rgba(22, 57, 35, 0.6) !important;
            padding-left: 1.35rem !important;
            padding-right: 1.35rem !important;
            font-size: 0.875rem !important;
            color: #ffffff !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-sizing: border-box !important;
        }

        .elior-password-container {
            position: relative !important;
            width: 100% !important;
            display: block !important;
        }

        .elior-password-container input {
            padding-right: 3.25rem !important;
        }

        .elior-password-toggle-btn {
            position: absolute !important;
            top: 50% !important;
            right: 1.15rem !important;
            transform: translateY(-50%) !important;
            z-index: 30 !important;
            background: transparent !important;
            border: none !important;
            cursor: pointer !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #c9a25a !important;
            padding: 0.25rem !important;
            transition: color 0.15s ease !important;
        }

        .elior-password-toggle-btn:hover {
            color: #ffffff !important;
        }

        .elior-nature-input::placeholder {
            color: rgba(244, 240, 230, 0.5) !important;
        }

        .elior-nature-input:focus {
            border-color: #c9a25a !important;
            background-color: rgba(18, 46, 28, 0.85) !important;
            box-shadow: 0 0 0 3px rgba(201, 162, 90, 0.25) !important;
            outline: none !important;
        }

        .elior-submit-mint {
            background: linear-gradient(135deg, #c9a25a 0%, #b08a43 100%);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.9375rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            border-radius: 9999px;
            height: 48px;
            width: 100%;
            box-shadow: 0 8px 24px -3px rgba(201, 162, 90, 0.45);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .elior-submit-mint:hover {
            background: linear-gradient(135deg, #d6b677 0%, #c9a25a 100%);
            transform: translateY(-1px);
            box-shadow: 0 14px 28px -3px rgba(201, 162, 90, 0.6);
        }

        .elior-submit-mint:active {
            transform: translateY(0);
        }

        .elior-botanical-badge {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.5rem !important;
            padding: 0.35rem 0.85rem !important;
            border-radius: 9999px !important;
            background: #ffffff !important;
            border: 1px solid #e5decb !important;
            color: #205132 !important;
            font-size: 0.75rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.02em !important;
            box-shadow: 0 4px 14px rgba(32, 81, 50, 0.15) !important;
        }

        .elior-botanical-badge-dot {
            width: 6px !important;
            height: 6px !important;
            border-radius: 9999px !important;
            background-color: #205132 !important;
        }
    </style>
    @endpush

    <div class="nature-canvas">
        
        <!-- Main Floating Auth Container -->
        <div class="auth-split-wrapper">
            
            <!-- Left Side: Alpine Forest, Cottages, Deer & "WELCOME" -->
            <div class="nature-left-panel">
                
                <!-- Tracked WELCOME Header & Flying Birds -->
                <div class="relative z-20 text-center pt-8 sm:pt-10">
                    <h2 class="text-xl sm:text-2xl font-bold tracking-[0.45em] text-[#3D7A68] uppercase font-sans select-none">
                        W E L C O M E
                    </h2>

                    <!-- Subtle Flying Bird SVG -->
                    <div class="mt-3.5 flex justify-center opacity-60">
                        <svg class="w-8 h-4 text-[#4D8A78]" viewBox="0 0 40 20" fill="currentColor">
                            <path d="M0 10 Q10 0 20 8 Q30 0 40 10 Q28 6 20 16 Q12 6 0 10 Z"/>
                        </svg>
                    </div>
                </div>

                <!-- Vector Landscape Artwork -->
                <div class="absolute inset-0 pointer-events-none z-0">
                    <svg class="w-full h-full object-cover" viewBox="0 0 460 600" preserveAspectRatio="xMidYMax slice" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="skyGrad" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#E8F8F0"/>
                                <stop offset="45%" stop-color="#D2F2E2"/>
                                <stop offset="85%" stop-color="#AEE1CA"/>
                                <stop offset="100%" stop-color="#9AD7BC"/>
                            </linearGradient>

                            <linearGradient id="lakeGrad" x1="0" y1="0" x2="1" y2="0">
                                <stop offset="0%" stop-color="#C7ECE0"/>
                                <stop offset="60%" stop-color="#E4FAF1"/>
                                <stop offset="100%" stop-color="#B8E6D4"/>
                            </linearGradient>

                            <linearGradient id="hillGrad1" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#88C8AB"/>
                                <stop offset="100%" stop-color="#5FA989"/>
                            </linearGradient>

                            <linearGradient id="hillGrad2" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#519F81"/>
                                <stop offset="100%" stop-color="#357D64"/>
                            </linearGradient>
                        </defs>

                        <!-- Base Sky -->
                        <rect width="460" height="600" fill="url(#skyGrad)"/>

                        <!-- Distant Mountain Ridges -->
                        <path d="M-20 280 Q80 210 220 250 Q360 290 480 220 L480 600 L-20 600 Z" fill="#99D5BA" opacity="0.6"/>
                        <path d="M-20 310 Q140 260 300 290 Q400 320 480 260 L480 600 L-20 600 Z" fill="url(#hillGrad1)" opacity="0.8"/>

                        <!-- Mid-distance Pine Forests -->
                        <g fill="#439175">
                            <polygon points="10,290 25,240 40,290"/>
                            <polygon points="30,295 45,235 60,295"/>
                            <polygon points="50,300 68,245 86,300"/>
                            <polygon points="75,290 92,230 110,290"/>
                            <polygon points="100,310 118,250 136,310"/>
                            <polygon points="125,305 142,240 160,305"/>
                            <polygon points="150,315 168,255 186,315"/>
                            <polygon points="175,300 195,235 215,300"/>
                        </g>

                        <!-- Midground Rolling Hill -->
                        <path d="M-20 350 Q160 300 320 370 Q400 420 480 360 L480 600 L-20 600 Z" fill="url(#hillGrad2)"/>

                        <!-- White Cottages with Terracotta Roofs -->
                        <g transform="translate(180, 325) scale(0.7)">
                            <polygon points="20,0 0,15 40,15" fill="#E76F51"/>
                            <rect x="5" y="15" width="30" height="25" fill="#FFFFFF"/>
                            <rect x="10" y="20" width="7" height="7" fill="#1E6B5C"/>
                            <rect x="23" y="20" width="7" height="7" fill="#1E6B5C"/>
                            <rect x="17" y="28" width="6" height="12" fill="#D45B3F"/>
                            <rect x="28" y="2" width="4" height="8" fill="#1E6B5C"/>
                        </g>

                        <g transform="translate(225, 370) scale(0.9)">
                            <polygon points="25,0 0,18 50,18" fill="#E76F51"/>
                            <rect x="6" y="18" width="38" height="30" fill="#FFFFFF"/>
                            <rect x="12" y="25" width="9" height="9" fill="#1E6B5C"/>
                            <rect x="29" y="25" width="9" height="9" fill="#1E6B5C"/>
                            <rect x="21" y="34" width="8" height="14" fill="#C95237"/>
                            <rect x="35" y="3" width="5" height="10" fill="#1E6B5C"/>
                        </g>

                        <!-- Mid-ground Pine Trees Slope -->
                        <g fill="#286E57">
                            <polygon points="0,420 20,330 40,420"/>
                            <polygon points="25,430 50,320 75,430"/>
                            <polygon points="60,440 85,340 110,440"/>
                            <polygon points="95,450 120,350 145,450"/>
                            <polygon points="130,440 155,360 180,440"/>
                            <polygon points="265,420 285,350 305,420"/>
                        </g>

                        <!-- Serene Lake / River Curve -->
                        <path d="M210 440 Q280 430 350 435 Q400 440 480 420 L480 530 Q360 510 270 500 Q220 495 210 440 Z" fill="url(#lakeGrad)"/>

                        <!-- Foreground Dark Silhouette Forest Hill -->
                        <path d="M-20 440 Q100 410 240 510 Q340 570 480 530 L480 600 L-20 600 Z" fill="#113F34"/>

                        <!-- Left Giant Pine Tree Silhouette -->
                        <polygon points="-15,580 15,380 45,580" fill="#0C2D25"/>
                        <polygon points="15,600 40,430 65,600" fill="#0C2D25"/>

                        <!-- Silhouette Stag / Deer 1 -->
                        <g fill="#0B2620" transform="translate(105, 385) scale(0.92)">
                            <ellipse cx="45" cy="85" rx="30" ry="18"/>
                            <rect x="25" y="95" width="4" height="40" rx="2"/>
                            <rect x="33" y="95" width="4" height="38" rx="2"/>
                            <path d="M60 95 Q68 110 65 135 L61 135 Q63 110 56 95 Z"/>
                            <path d="M68 95 Q76 110 73 133 L69 133 Q71 110 64 95 Z"/>
                            <path d="M25 80 Q18 60 22 45 Q26 40 30 42 Q32 55 35 75 Z"/>
                            <circle cx="24" cy="42" r="6"/>
                            <path d="M20 44 L12 47 L16 50 Z"/>
                            <ellipse cx="28" cy="38" rx="3" ry="6" transform="rotate(25 28 38)"/>
                            <path d="M22 38 Q18 20 12 10 Q10 7 8 8 Q12 18 16 36 Z"/>
                            <path d="M16 26 Q8 20 4 22 Q10 28 16 30 Z"/>
                            <path d="M14 18 Q6 10 2 12 Q8 16 13 20 Z"/>
                            <path d="M25 38 Q30 18 36 6 Q39 4 38 6 Q32 18 27 36 Z"/>
                            <path d="M28 24 Q36 18 42 19 Q34 26 29 28 Z"/>
                            <path d="M31 15 Q40 8 45 9 Q38 14 32 18 Z"/>
                        </g>

                        <!-- Silhouette Deer 2 -->
                        <g fill="#0B2620" transform="translate(185, 425) scale(0.8)">
                            <ellipse cx="40" cy="80" rx="25" ry="16"/>
                            <rect x="25" y="90" width="3.5" height="35" rx="1.5"/>
                            <rect x="32" y="90" width="3.5" height="33" rx="1.5"/>
                            <path d="M55 90 Q62 105 59 125 L56 125 Q58 105 51 90 Z"/>
                            <path d="M25 75 Q20 58 24 46 Q28 42 32 44 Q33 58 35 72 Z"/>
                            <circle cx="26" cy="44" r="5.5"/>
                            <path d="M22 46 L15 48 L18 51 Z"/>
                            <ellipse cx="29" cy="40" rx="2.5" ry="5" transform="rotate(20 29 40)"/>
                            <path d="M25 40 Q22 25 18 16 Q20 25 24 38 Z"/>
                            <path d="M27 40 Q31 24 35 15 Q32 25 28 38 Z"/>
                        </g>
                    </svg>
                </div>

                <!-- S-Curve Wave Separator on Right Edge -->
                <svg class="wave-separator" viewBox="0 0 75 600" preserveAspectRatio="none" fill="#205132">
                    <path d="M75,0 C18,120 5,230 58,340 C88,420 32,530 75,600 L75,0 Z"/>
                </svg>

                <!-- Bottom Status with Crisp High Contrast Badge -->
                <div class="relative z-20 flex items-center justify-start">
                    <div class="elior-botanical-badge">
                        <span class="elior-botanical-badge-dot"></span>
                        <span>ELIOR Botanical Console</span>
                    </div>
                </div>
            </div>

            <!-- Right Side: Deep Botanical Forest Authentication Form -->
            <div class="form-right-panel">
                
                <!-- Greetings & Elior Admin Context Header -->
                <div class="space-y-1.5 pt-1">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold tracking-widest uppercase text-[#c9a25a] bg-[#163923] px-3 py-0.5 rounded-full border border-[#c9a25a]/30">
                            Administrative Access
                        </span>
                        <a href="{{ route('shop.home.index') }}" class="text-xs text-[#f4f0e6] hover:text-[#c9a25a] hover:underline font-medium inline-flex items-center gap-1 transition-colors">
                            <span>Storefront</span>
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                <polyline points="15 3 21 3 21 9"/>
                                <line x1="10" x2="21" y1="14" y2="3"/>
                            </svg>
                        </a>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-white tracking-tight font-sans">
                        Elior Admin Portal
                    </h1>
                    <p class="text-xs sm:text-sm text-[#f4f0e6]/80 font-normal leading-relaxed">
                        Sign in to manage catalog, orders, and customer operations.
                    </p>
                </div>

                <!-- Credential Authentication Form -->
                <x-admin::form :action="route('admin.session.store')" class="space-y-4 my-auto">
                    
                    <!-- Row 1: Email Address -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-[#E1F4EC] tracking-wide pl-1">
                            @lang('admin::app.users.sessions.email')
                        </label>

                        <x-admin::form.control-group.control
                            type="email"
                            class="elior-nature-input" 
                            id="email"
                            name="email" 
                            rules="required|email" 
                            :label="trans('admin::app.users.sessions.email')"
                            placeholder="email@example.com"
                            :value="old('email')"
                        />

                        <x-admin::form.control-group.error control-name="email" class="text-xs text-[#FFB4A2] mt-0.5 pl-3" />
                    </div>

                    <!-- Row 2: Password with Properly Placed Right-Aligned Eye Toggle -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-semibold text-[#E1F4EC] tracking-wide pl-1">
                            @lang('admin::app.users.sessions.password')
                        </label>

                        <div class="elior-password-container">
                            <x-admin::form.control-group.control
                                type="password"
                                class="elior-nature-input" 
                                id="password"
                                name="password" 
                                rules="required|min:6" 
                                :label="trans('admin::app.users.sessions.password')"
                                placeholder="••••••••"
                            />

                            <!-- Eye Toggle Positioned Cleanly on the Far Right -->
                            <button 
                                type="button" 
                                class="elior-password-toggle-btn"
                                onclick="switchVisibility()"
                                aria-label="Toggle password visibility"
                            >
                                <svg id="eyeOpenIcon" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <svg id="eyeCloseIcon" class="w-4 h-4 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                    <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                    <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                                    <line x1="2" x2="22" y1="2" y2="22"/>
                                </svg>
                            </button>
                        </div>

                        <x-admin::form.control-group.error control-name="password" class="text-xs text-[#FFB4A2] mt-0.5 pl-3" />
                    </div>

                    <!-- Remember Me Checkbox & Forgot Password Link -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 cursor-pointer select-none text-xs text-[#E1F4EC]">
                            <input
                                type="checkbox"
                                name="remember"
                                id="remember"
                                class="w-4 h-4 rounded border-[#4DA08F] bg-[#165649] text-[#1E6B5C] focus:ring-0 cursor-pointer"
                                {{ old('remember') ? 'checked' : '' }}
                            />
                            <span>Remember Me</span>
                        </label>

                        <a 
                            class="text-xs font-medium text-[#D4F4DC] hover:text-white underline transition-colors"
                            href="{{ route('admin.forget_password.create') }}"
                        >
                            @lang('admin::app.users.sessions.forget-password-link')
                        </a>
                    </div>

                    <!-- Centered Mint Pill Submit Button -->
                    <div class="pt-3">
                        <button
                            type="submit"
                            class="elior-submit-mint"
                        >
                            <span>@lang('admin::app.users.sessions.submit-btn')</span>
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"/>
                                <path d="m12 5 7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </x-admin::form>

                <!-- Bottom Security Encryption Notice -->
                <div class="pt-2 text-center text-[11px] text-white/50">
                    <div class="inline-flex items-center gap-1.5 justify-center">
                        <svg class="w-3.5 h-3.5 text-[#B8E3BF]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                        <span>256-Bit Encrypted Secure Administrative Console</span>
                    </div>
                </div>

            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            function switchVisibility() {
                const passwordField = document.getElementById("password");
                const eyeOpenIcon = document.getElementById("eyeOpenIcon");
                const eyeCloseIcon = document.getElementById("eyeCloseIcon");
                
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    eyeOpenIcon.classList.add("hidden");
                    eyeCloseIcon.classList.remove("hidden");
                } else {
                    passwordField.type = "password";
                    eyeOpenIcon.classList.remove("hidden");
                    eyeCloseIcon.classList.add("hidden");
                }
            }
        </script>
    @endpush
</x-admin::layouts.anonymous>