<x-admin::layouts>
    <x-slot:title>
        @lang('recipe::app.admin.recipes.edit')
    </x-slot>

    <x-admin::form
        :action="route('admin.recipes.update', $recipe->id)"
        method="PUT"
        enctype="multipart/form-data"
    >
        <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
            <p class="text-xl font-bold text-gray-800">
                @lang('recipe::app.admin.recipes.edit')
            </p>

            <div class="flex items-center gap-x-2.5">
                <a
                    href="{{ route('admin.recipes.index') }}"
                    class="transparent-button hover:bg-gray-200"
                >
                    Back
                </a>

                <button
                    type="submit"
                    class="primary-button"
                >
                    Update Recipe
                </button>
            </div>
        </div>

        <div class="mt-3.5 flex gap-2.5 max-xl:flex-wrap">
            <!-- Left sub-component -->
            <div class="flex flex-1 flex-col gap-2 max-xl:flex-auto">
                <div class="box-shadow rounded bg-white p-4">
                    <p class="mb-4 text-base font-semibold text-gray-800">
                        General Details
                    </p>

                    <!-- Recipe Title -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            Recipe Title
                        </x-admin::form.control-group.label>

                        <v-field
                            type="text"
                            name="name"
                            rules="required"
                            value="{{ old('name') ?? $recipe->name }}"
                            label="Recipe Title"
                            v-slot="{ field, errors }"
                        >
                            <input
                                type="text"
                                id="name"
                                :class="[errors.length ? 'border border-red-600 hover:border-red-600' : '']"
                                class="flex min-h-[39px] w-full rounded-md border px-3 py-2 text-sm text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400"
                                name="name"
                                v-bind="field"
                                placeholder="e.g. Moringa Green Morning Smoothie"
                                v-slugify-target:url_key="setValues"
                            />
                        </v-field>

                        <x-admin::form.control-group.error control-name="name" />
                    </x-admin::form.control-group>

                    <!-- URL Key -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            URL Key (Slug)
                        </x-admin::form.control-group.label>

                        <v-field
                            type="text"
                            name="url_key"
                            rules="required"
                            value="{{ old('url_key') ?? $recipe->url_key }}"
                            label="URL Key"
                            v-slot="{ field, errors }"
                        >
                            <input
                                type="text"
                                id="url_key"
                                :class="[errors.length ? 'border border-red-600 hover:border-red-600' : '']"
                                class="flex min-h-[39px] w-full rounded-md border px-3 py-2 text-sm text-gray-600 transition-all hover:border-gray-400 focus:border-gray-400"
                                name="url_key"
                                v-bind="field"
                                placeholder="moringa-green-morning-smoothie"
                                v-slugify-target:url_key
                            />
                        </v-field>

                        <x-admin::form.control-group.error control-name="url_key" />
                    </x-admin::form.control-group>

                    <!-- Description -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Description / Introduction
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="textarea"
                            name="description"
                            :rows="3"
                            :value="old('description') ?? $recipe->description"
                        />

                        <x-admin::form.control-group.error control-name="description" />
                    </x-admin::form.control-group>

                    <!-- Ingredients -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Ingredients (One per line)
                        </x-admin::form.control-group.label>

                        @php
                            $ingredientsVal = is_array($recipe->ingredients) ? implode("\n", $recipe->ingredients) : $recipe->ingredients;
                        @endphp

                        <x-admin::form.control-group.control
                            type="textarea"
                            name="ingredients"
                            :rows="6"
                            :value="old('ingredients') ?? $ingredientsVal"
                        />

                        <x-admin::form.control-group.error control-name="ingredients" />
                    </x-admin::form.control-group>

                    <!-- Instructions / Method -->
                    <x-admin::form.control-group class="!mb-0">
                        <x-admin::form.control-group.label>
                            Preparation Instructions (One step per line)
                        </x-admin::form.control-group.label>

                        @php
                            $instructionsVal = is_array($recipe->instructions) ? implode("\n", $recipe->instructions) : $recipe->instructions;
                        @endphp

                        <x-admin::form.control-group.control
                            type="textarea"
                            name="instructions"
                            :rows="6"
                            :value="old('instructions') ?? $instructionsVal"
                        />

                        <x-admin::form.control-group.error control-name="instructions" />
                    </x-admin::form.control-group>
                </div>

                <!-- SEO Details -->
                <div class="box-shadow rounded bg-white p-4">
                    <p class="mb-4 text-base font-semibold text-gray-800">
                        SEO Metadata
                    </p>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>Meta Title</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="text" name="meta_title" :value="old('meta_title') ?? $recipe->meta_title" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>Meta Description</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="textarea" name="meta_description" :rows="2" :value="old('meta_description') ?? $recipe->meta_description" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="!mb-0">
                        <x-admin::form.control-group.label>Meta Keywords</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="text" name="meta_keywords" :value="old('meta_keywords') ?? $recipe->meta_keywords" />
                    </x-admin::form.control-group>
                </div>
            </div>

            <!-- Right sub-component -->
            <div class="flex w-[360px] max-w-full flex-col gap-2 max-xl:flex-auto">
                <div class="box-shadow rounded bg-white p-4">
                    <p class="mb-4 text-base font-semibold text-gray-800">
                        Recipe Settings
                    </p>

                    <!-- Status -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>Status</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="select" name="status">
                            <option value="1" {{ $recipe->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ ! $recipe->status ? 'selected' : '' }}>Inactive</option>
                        </x-admin::form.control-group.control>
                    </x-admin::form.control-group>

                    <!-- Prep Time -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>Prep Time (Minutes)</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="number" name="prep_time" :value="old('prep_time') ?? $recipe->prep_time" />
                    </x-admin::form.control-group>

                    <!-- Cook Time -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>Cook Time (Minutes)</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="number" name="cook_time" :value="old('cook_time') ?? $recipe->cook_time" />
                    </x-admin::form.control-group>

                    <!-- Servings -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>Servings</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="number" name="servings" :value="old('servings') ?? $recipe->servings" />
                    </x-admin::form.control-group>

                    <!-- Difficulty -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>Difficulty Level</x-admin::form.control-group.label>
                        <x-admin::form.control-group.control type="select" name="difficulty">
                            <option value="1" {{ $recipe->difficulty == 1 ? 'selected' : '' }}>Easy</option>
                            <option value="2" {{ $recipe->difficulty == 2 ? 'selected' : '' }}>Medium</option>
                            <option value="3" {{ $recipe->difficulty == 3 ? 'selected' : '' }}>Hard</option>
                        </x-admin::form.control-group.control>
                    </x-admin::form.control-group>

                    <!-- Featured Image Upload & Preview -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>Featured Image</x-admin::form.control-group.label>
                        @if ($recipe->featured_image)
                            <div class="mb-2 w-full aspect-[16/9] rounded overflow-hidden bg-gray-100">
                                <img src="{{ Storage::url($recipe->featured_image) }}" alt="{{ $recipe->name }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <x-admin::form.control-group.control type="file" name="featured_image" accept="image/*" />
                    </x-admin::form.control-group>

                    <!-- Linked ELIOR Products -->
                    <x-admin::form.control-group class="!mb-0">
                        <x-admin::form.control-group.label>Associated Products</x-admin::form.control-group.label>
                        @php
                            $selectedIds = $recipe->products->pluck('id')->toArray();
                        @endphp
                        <x-admin::form.control-group.control type="select" name="product_ids[]" multiple class="h-32">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ in_array($product->id, $selectedIds) ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </x-admin::form.control-group.control>
                    </x-admin::form.control-group>
                </div>
            </div>
        </div>
    </x-admin::form>
</x-admin::layouts>
