<v-back-to-top></v-back-to-top>

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-back-to-top-template"
    >
        <transition
            enter-active-class="transition-all duration-300 ease-out"
            enter-from-class="opacity-0 translate-y-4 scale-90"
            enter-to-class="opacity-100 translate-y-0 scale-100"
            leave-active-class="transition-all duration-200 ease-in"
            leave-from-class="opacity-100 translate-y-0 scale-100"
            leave-to-class="opacity-0 translate-y-4 scale-90"
        >
            <button
                type="button"
                v-show="isVisible"
                @click="scrollToTop"
                class="flex items-center justify-center rounded-full shadow-2xl transition-all duration-300 hover:scale-110 hover:-translate-y-1 focus:outline-none group cursor-pointer"
                style="position: fixed; bottom: 2rem; right: 2rem; top: auto; left: auto; z-index: 90; width: 3rem; height: 3rem; background-color: #163923; color: #ffffff; border: 2px solid #ffffff; box-shadow: 0 10px 30px rgba(22, 57, 35, 0.45);"
                aria-label="Back to Top"
                title="Back to Top"
            >
                <!-- Upward Arrow Icon -->
                <svg
                    class="w-5 h-5 text-white transition-transform duration-300 group-hover:-translate-y-0.5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.5"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
            </button>
        </transition>
    </script>

    <script type="module">
        app.component('v-back-to-top', {
            template: '#v-back-to-top-template',

            data() {
                return {
                    isVisible: false,
                };
            },

            mounted() {
                window.addEventListener('scroll', this.handleScroll, { passive: true });
                this.handleScroll();
            },

            beforeUnmount() {
                window.removeEventListener('scroll', this.handleScroll);
            },

            methods: {
                handleScroll() {
                    this.isVisible = window.scrollY > 300;
                },

                scrollToTop() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth',
                    });
                },
            },
        });
    </script>
@endpushOnce
