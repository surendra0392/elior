<x-admin::layouts>
    <x-slot:title>
        Edit Hero Slider
    </x-slot>

    <!-- Input Form -->
    <x-admin::form
        :action="route('admin.cms.hero_sliders.update', $heroSlider->id)"
        enctype="multipart/form-data"
        method="PUT"
    >
        <div class="flex gap-4 justify-between items-center max-sm:flex-wrap">
            <p class="text-xl text-gray-800 font-bold">
                Edit Hero Slider: {{ $heroSlider->name }}
            </p>

            <div class="flex gap-x-2.5 items-center">
                <!-- Cancel Button -->
                <a
                    href="{{ route('admin.cms.hero_sliders.index') }}"
                    class="transparent-button hover:bg-gray-200"
                >
                    @lang('admin::app.cms.edit.back-btn')
                </a>

                <!-- Save Button -->
                <button 
                    type="submit" 
                    class="primary-button"
                >
                    Save Slider
                </button>
            </div>
        </div>

        <!-- body content -->
        <div class="flex gap-2.5 mt-3.5 max-xl:flex-wrap">
            <!-- Left sub-component -->
            <div class="flex flex-col gap-2.5 flex-1 max-xl:flex-auto">
                <div class="p-4 bg-white rounded box-shadow">
                    <p class="text-base text-gray-800 font-semibold mb-4">
                        General
                    </p>

                    <!-- Slider Name -->
                    <x-admin::form.control-group class="mb-2.5">
                        <x-admin::form.control-group.label class="required">
                            Name
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="name"
                            :value="old('name') ?: $heroSlider->name"
                            rules="required"
                            label="Name"
                            placeholder="Name"
                        >
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error
                            control-name="name"
                        >
                        </x-admin::form.control-group.error>
                    </x-admin::form.control-group>

                    <!-- Slider Code -->
                    <x-admin::form.control-group class="mb-2.5">
                        <x-admin::form.control-group.label class="required">
                            Code (Identifier)
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="code"
                            :value="old('code') ?: $heroSlider->code"
                            rules="required"
                            label="Code"
                            placeholder="homepage-hero"
                        >
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error
                            control-name="code"
                        >
                        </x-admin::form.control-group.error>
                    </x-admin::form.control-group>
                </div>

                <!-- Slide & Layer Editor (Vue Component) -->
                <v-hero-slider-editor :slider-id="{{ $heroSlider->id }}" :initial-slides="{{ json_encode($heroSlider->slides) }}"></v-hero-slider-editor>
            </div>

            <!-- Right sub-component -->
            <div class="flex flex-col gap-2.5 w-[360px] max-w-full max-sm:w-full">
                <!-- Settings Panel -->
                <div class="p-4 bg-white rounded box-shadow">
                    <p class="text-base text-gray-800 font-semibold mb-4">
                        Settings
                    </p>

                    <!-- Status -->
                    <x-admin::form.control-group class="mb-2.5">
                        <x-admin::form.control-group.label>
                            Status
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="switch"
                            name="status"
                            class="cursor-pointer"
                            value="1"
                            label="Status"
                            :checked="(boolean) $heroSlider->status"
                        >
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error
                            control-name="status"
                        >
                        </x-admin::form.control-group.error>
                    </x-admin::form.control-group>

                    <!-- Autoplay Enabled -->
                    <x-admin::form.control-group class="mb-2.5">
                        <x-admin::form.control-group.label>
                            Autoplay
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="switch"
                            name="settings[autoplay]"
                            class="cursor-pointer"
                            value="1"
                            label="Autoplay"
                            :checked="(boolean) ($heroSlider->settings['autoplay'] ?? true)"
                        >
                        </x-admin::form.control-group.control>
                    </x-admin::form.control-group>

                    <!-- Autoplay Speed / Duration (ms) -->
                    <x-admin::form.control-group class="mb-2.5">
                        <x-admin::form.control-group.label class="required">
                            Autoplay Speed (ms)
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="settings[duration]"
                            :value="old('settings.duration') ?: ($heroSlider->settings['duration'] ?? 6000)"
                            rules="required|numeric|min_value:1000"
                            label="Autoplay Speed (ms)"
                            placeholder="6000"
                        >
                        </x-admin::form.control-group.control>

                        <p class="text-xs text-gray-500 mt-1">
                            Duration per slide in milliseconds (e.g. 5000 = 5 seconds, 6000 = 6s, 8000 = 8s).
                        </p>
                    </x-admin::form.control-group>
                </div>
            </div>
        </div>
    </x-admin::form>

    @pushOnce('scripts')
        <script type="text/x-template" id="v-hero-slider-editor-template">
            <div class="p-4 bg-white rounded box-shadow mt-4">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-base text-gray-800 font-semibold">
                        Slides & Layers
                    </p>
                    <button type="button" @click="addSlide" class="secondary-button text-sm">
                        + Add Slide
                    </button>
                </div>

                <input type="hidden" name="slides_data" :value="JSON.stringify(slides)">

                <div v-if="slides.length === 0" class="text-gray-500 italic text-center py-8">
                    No slides added yet. Click "+ Add Slide" to begin.
                </div>

                <!-- Slide Accordion -->
                <div v-for="(slide, slideIndex) in slides" :key="slideIndex" class="mb-4 border border-gray-200 rounded">
                    <!-- Slide Header -->
                    <div class="flex justify-between items-center bg-gray-50 p-3 cursor-pointer" @click="toggleSlide(slideIndex)">
                        <div class="font-medium text-gray-800 flex items-center gap-2">
                            <i :class="slide.expanded ? 'icon-arrow-down' : 'icon-arrow-right'" class="text-lg"></i>
                            Slide @{{ slideIndex + 1 }}: @{{ slide.name || 'Untitled' }}
                        </div>
                        <div class="flex gap-2">
                            <button type="button" @click.stop="removeSlide(slideIndex)" class="text-red-600 hover:text-red-800">
                                <i class="icon-delete text-xl"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Slide Content -->
                    <div v-show="slide.expanded" class="p-4 border-t border-gray-200">
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Slide Name</label>
                                <input type="text" v-model="slide.name" class="w-full border border-gray-300 rounded p-2 text-sm" placeholder="e.g. Botanical Nutrition">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Media Type</label>
                                <select v-model="slide.media_type" class="w-full border border-gray-300 rounded p-2 text-sm">
                                    <option value="image">Image</option>
                                    <option value="video">Video</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Slide Duration (ms)</label>
                                <input type="number" v-model="slide.duration" class="w-full border border-gray-300 rounded p-2 text-sm" placeholder="6000" min="1000" step="500">
                            </div>
                        </div>

                        <!-- Image Settings -->
                        <div v-if="slide.media_type === 'image'" class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Desktop Image URL</label>
                                <input type="text" v-model="slide.desktop_media" class="w-full border border-gray-300 rounded p-2 text-sm" placeholder="/storage/...">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Mobile Image URL (Optional)</label>
                                <input type="text" v-model="slide.mobile_media" class="w-full border border-gray-300 rounded p-2 text-sm" placeholder="/storage/...">
                            </div>
                        </div>

                        <!-- Video Settings -->
                        <div v-if="slide.media_type === 'video'" class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Video URL (MP4)</label>
                            <input type="text" v-model="slide.video_url" class="w-full border border-gray-300 rounded p-2 text-sm mb-2" placeholder="/storage/...">
                            
                            <label class="block text-sm font-medium text-gray-700 mb-1">Desktop Poster Image</label>
                            <input type="text" v-model="slide.desktop_media" class="w-full border border-gray-300 rounded p-2 text-sm" placeholder="/storage/... (fallback)">
                        </div>

                        <!-- Layers Section -->
                        <div class="mt-6 bg-gray-50 rounded p-4">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="font-medium text-gray-800">Layers</h4>
                                <button type="button" @click="addLayer(slideIndex)" class="text-[#205132] text-sm font-medium hover:underline">+ Add Layer</button>
                            </div>

                            <div v-if="!slide.layers || slide.layers.length === 0" class="text-sm text-gray-500 italic">
                                No layers added to this slide.
                            </div>

                            <!-- Layer Item -->
                            <div v-for="(layer, layerIndex) in slide.layers" :key="layerIndex" class="mb-3 bg-white p-3 rounded border border-gray-200">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex gap-2 w-full">
                                        <select v-model="layer.type" class="border border-gray-300 rounded p-1 text-sm w-32">
                                            <option value="text">Text/Eyebrow</option>
                                            <option value="heading">Heading</option>
                                            <option value="button">Button</option>
                                        </select>
                                        <input type="text" v-model="layer.content" class="border border-gray-300 rounded p-1 text-sm flex-1" placeholder="Content (HTML allowed)">
                                    </div>
                                    <button type="button" @click="removeLayer(slideIndex, layerIndex)" class="text-red-500 ml-2">
                                        <i class="icon-delete"></i>
                                    </button>
                                </div>
                                
                                <!-- Layer Settings (Desktop X, Y) -->
                                <div class="grid grid-cols-4 gap-2 mt-2">
                                    <div>
                                        <label class="block text-xs text-gray-500">Left (X)</label>
                                        <input type="text" v-model="layer.desktop_settings.x" class="w-full border border-gray-300 rounded p-1 text-sm" placeholder="e.g. 10%">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500">Top (Y)</label>
                                        <input type="text" v-model="layer.desktop_settings.y" class="w-full border border-gray-300 rounded p-1 text-sm" placeholder="e.g. 50%">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500">Width</label>
                                        <input type="text" v-model="layer.desktop_settings.width" class="w-full border border-gray-300 rounded p-1 text-sm" placeholder="e.g. auto, 400px">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500">Extra Classes</label>
                                        <input type="text" v-model="layer.settings.classes" class="w-full border border-gray-300 rounded p-1 text-sm" placeholder="e.g. text-white">
                                    </div>
                                </div>
                                
                                <!-- Mobile Overrides -->
                                <div class="grid grid-cols-2 gap-2 mt-2">
                                    <div>
                                        <label class="block text-xs text-gray-500">Mobile Left (X)</label>
                                        <input type="text" v-model="layer.mobile_settings.x" class="w-full border border-gray-300 rounded p-1 text-sm" placeholder="e.g. 5%">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500">Mobile Top (Y)</label>
                                        <input type="text" v-model="layer.mobile_settings.y" class="w-full border border-gray-300 rounded p-1 text-sm" placeholder="e.g. 40%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </script>

        <script type="module">
            app.component('v-hero-slider-editor', {
                template: '#v-hero-slider-editor-template',
                props: ['sliderId', 'initialSlides'],
                data() {
                    return {
                        slides: []
                    };
                },
                mounted() {
                    if (this.initialSlides && this.initialSlides.length > 0) {
                        this.slides = this.initialSlides.map(slide => ({
                            ...slide,
                            expanded: false,
                            layers: (slide.layers || []).map(layer => ({
                                ...layer,
                                desktop_settings: typeof layer.desktop_settings === 'string' ? JSON.parse(layer.desktop_settings || '{}') : (layer.desktop_settings || {}),
                                mobile_settings: typeof layer.mobile_settings === 'string' ? JSON.parse(layer.mobile_settings || '{}') : (layer.mobile_settings || {}),
                                settings: typeof layer.settings === 'string' ? JSON.parse(layer.settings || '{}') : (layer.settings || {}),
                            }))
                        }));
                    }
                },
                methods: {
                    addSlide() {
                        this.slides.push({
                            id: null,
                            name: '',
                            media_type: 'image',
                            desktop_media: '',
                            mobile_media: '',
                            video_url: '',
                            expanded: true,
                            layers: []
                        });
                    },
                    removeSlide(index) {
                        if (confirm('Are you sure you want to remove this slide?')) {
                            this.slides.splice(index, 1);
                        }
                    },
                    toggleSlide(index) {
                        this.slides[index].expanded = !this.slides[index].expanded;
                    },
                    addLayer(slideIndex) {
                        if (!this.slides[slideIndex].layers) {
                            this.slides[slideIndex].layers = [];
                        }
                        this.slides[slideIndex].layers.push({
                            id: null,
                            type: 'heading',
                            content: '',
                            desktop_settings: { x: '10%', y: '50%', width: 'auto' },
                            mobile_settings: { x: '5%', y: '50%' },
                            settings: { classes: 'text-white' }
                        });
                    },
                    removeLayer(slideIndex, layerIndex) {
                        this.slides[slideIndex].layers.splice(layerIndex, 1);
                    }
                }
            });
        </script>
    @endPushOnce
</x-admin::layouts>
