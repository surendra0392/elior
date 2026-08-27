/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./src/Resources/**/*.blade.php", "./src/Resources/**/*.js"],

    theme: {
        container: {
            center: true,

            screens: {
                "2xl": "1920px",
            },

            padding: {
                DEFAULT: "16px",
            },
        },

        screens: {
            sm: "525px",
            md: "768px",
            lg: "1024px",
            xl: "1240px",
            "2xl": "1920px",
        },

        extend: {
            colors: {
                brand: '#205132',
                brandAccent: '#83B740',
                darkGreen: '#205132',
                darkBlue: '#205132',
                darkPink: '#F85156',
            },

            fontFamily: {
                inter: ['Inter', 'sans-serif'],
                mono: ['JetBrains Mono', 'monospace'],
                icon: ['icomoon']
            }
        },
    },

    plugins: [],

    safelist: [
        {
            pattern: /icon-/,
        }
    ]
};
