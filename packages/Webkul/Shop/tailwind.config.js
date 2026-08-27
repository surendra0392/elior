/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./src/Resources/**/*.blade.php", "./src/Resources/**/*.js"],

    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: "1.25rem",
                sm: "2rem",
                lg: "3rem",
                xl: "4rem",
                "2xl": "5rem",
            },
            screens: {
                sm: "640px",
                md: "768px",
                lg: "1024px",
                xl: "1280px",
                "2xl": "1440px",
            },
        },

        screens: {
            sm: "525px",
            md: "768px",
            lg: "1024px",
            xl: "1240px",
            "2xl": "1440px",
            1180: "1180px",
            1060: "1060px",
            991: "991px",
            868: "868px",
        },

        extend: {
            colors: {
                // Official ELIOR Brand Palette: #205132, #c9a25a, #f4f0e6, #ffffff
                elior: {
                    bg: "#f4f0e6",            // Warm Botanical Linen Canvas
                    surface: "#ece6d8",       // Subtle Linen Surface
                    card: "#ffffff",          // Pure White Card
                    charcoal: "#163923",      // Deep Botanical Charcoal Text (#205132 shade)
                    slate: "#205132",         // Primary Forest Green
                    muted: "#677a6d",         // Muted Sage Text
                    light: "#8e9f94",         // Light Sage Text
                    border: "#e5decb",        // Linen Border
                    borderDark: "#2c5f3e",    // Dark Theme Border
                    botanical: "#205132",     // Primary Forest Green (#205132)
                    botanicalDark: "#163923", // Deep Evergreen (#163923)
                    botanicalLight: "#e8f2ec",// Soft Pale Green Tint
                    terracotta: "#c9a25a",    // Primary Accent Warm Gold (#c9a25a)
                    terracottaDark: "#b08a43",// Rich Amber Gold Hover
                    terracottaLight: "#f5eedd",// Soft Gold Tint
                    sand: "#f4f0e6",          // Linen Canvas (#f4f0e6)
                    gold: "#c9a25a",          // Warm Gold (#c9a25a)
                    goldDark: "#b08a43",      // Gold Hover
                    goldLight: "#f5eedd",     // Soft Gold Pill Tint
                },

                // Compatibility aliases
                navyBlue: "#163923",
                lightOrange: "#f4f0e6",
                darkGreen: "#205132",
                darkBlue: "#205132",
                darkPink: "#c9a25a",
            },

            fontFamily: {
                display: ["'Poppins'", "sans-serif"],
                serif: ["'Poppins'", "sans-serif"],
                sans: ["'Poppins'", "-apple-system", "BlinkMacSystemFont", "'Segoe UI'", "sans-serif"],
                body: ["'Poppins'", "sans-serif"],
                poppins: ["'Poppins'", "sans-serif"],
                dmserif: ["'Poppins'", "sans-serif"],
            },

            letterSpacing: {
                widest: ".2em",
                ultra: ".25em",
            },

            boxShadow: {
                'elior-subtle': '0 2px 12px -2px rgba(32, 81, 50, 0.06)',
                'elior-card': '0 10px 30px -5px rgba(32, 81, 50, 0.08)',
                'elior-hover': '0 20px 40px -10px rgba(32, 81, 50, 0.14)',
                'elior-gold': '0 8px 24px -4px rgba(201, 162, 90, 0.35)',
            },

            borderRadius: {
                'elior': '6px',
                'elior-lg': '12px',
                'elior-pill': '9999px',
            },

            keyframes: {
                marquee: {
                    '0%': { transform: 'translateX(0%)' },
                    '100%': { transform: 'translateX(-50%)' },
                },
            },

            animation: {
                marquee: 'marquee 30s linear infinite',
            },
        }
    },

    plugins: [],

    safelist: [
        {
            pattern: /icon-/,
        }
    ]
};
