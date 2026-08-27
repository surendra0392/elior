@props([
    'isActive' => false,
])

<v-modal
    is-active="{{ $isActive }}"
    {{ $attributes }}
>
    @isset($toggle)
        <template v-slot:toggle>
            {{ $toggle }}
        </template>
    @endisset

    @isset($header)
        <template v-slot:header="{ toggle, isOpen }">
            <div {{ $header->attributes->merge(['class' => 'flex items-center justify-between gap-2.5 border-b border-slate-200 px-5 py-4 text-slate-900']) }}>
                {{ $header }}

                <span
                    class="icon-cancel-1 cursor-pointer rounded-full p-1 text-2xl text-slate-400 hover:bg-slate-100 hover:text-slate-900 transition-all"
                    @click="toggle"
                >
                </span>
            </div>
        </template>
    @endisset

    @isset($content)
        <template v-slot:content>
            <div {{ $content->attributes->merge(['class' => 'border-b border-slate-200 px-5 py-4 text-slate-700']) }}>
                {{ $content }}
            </div>
        </template>
    @endisset

    @isset($footer)
        <template v-slot:footer>
            <div {{ $footer->attributes->merge(['class' => 'flex justify-end gap-2.5 px-5 py-3.5 bg-slate-50']) }}>
                {{ $footer }}
            </div>
        </template>
    @endisset
</v-modal>

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-modal-template"
    >
        <div>
            <div @click="toggle">
                <slot name="toggle">
                </slot>
            </div>

            <transition
                tag="div"
                name="modal-overlay"
                enter-class="duration-300 ease-out"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-class="duration-200 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div
                    class="fixed inset-0 z-[10001] bg-gray-500 bg-opacity-50 transition-opacity"
                    v-show="isOpen"
                ></div>
            </transition>

            <transition
                tag="div"
                name="modal-content"
                enter-class="duration-300 ease-out"
                enter-from-class="translate-y-4 opacity-0 md:translate-y-0 md:scale-95"
                enter-to-class="translate-y-0 opacity-100 md:scale-100"
                leave-class="duration-200 ease-in"
                leave-from-class="translate-y-0 opacity-100 md:scale-100"
                leave-to-class="translate-y-4 opacity-0 md:translate-y-0 md:scale-95"
            >
                <div
                    class="fixed inset-0 z-[10002] transform overflow-y-auto transition"
                    v-if="isOpen"
                >
                    <div class="flex min-h-screen items-end justify-center p-4 sm:items-center sm:p-0">
                        <div
                            class="relative z-[999] w-screen rounded-[14px] bg-white border border-slate-200 shadow-2xl overflow-hidden max-lg:mb-4 max-lg:mt-4 max-md:w-[90%]"
                            :class="panelClass || 'max-w-[568px]'"
                        >
                            <!-- Header Slot -->
                            <slot
                                name="header"
                                :toggle="toggle"
                                :isOpen="isOpen"
                            >
                            </slot>

                            <!-- Content Slot -->
                            <slot name="content"></slot>
                            
                            <!-- Footer Slot -->
                            <slot name="footer"></slot>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </script>

    <script type="module">
        app.component('v-modal', {
            template: '#v-modal-template',

            props: ['isActive', 'panelClass'],

            data() {
                return {
                    isOpen: this.isActive,
                };
            },

            methods: {
                toggle() {
                    this.isOpen = ! this.isOpen;

                    if (this.isOpen) {
                        document.body.style.overflow = 'hidden';
                    } else {
                        document.body.style.overflow = 'auto';
                    }

                    this.$emit('toggle', { isActive: this.isOpen });
                },

                open() {
                    this.isOpen = true;

                    document.body.style.overflow = 'hidden';

                    this.$emit('open', { isActive: this.isOpen });
                },

                close() {
                    this.isOpen = false;

                    document.body.style.overflow = 'auto';

                    this.$emit('close', { isActive: this.isOpen });
                }
            }
        });
    </script>
@endPushOnce
