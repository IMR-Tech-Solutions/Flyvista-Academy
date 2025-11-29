<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Add New Hero Section</h2>
            <p class="text-gray-500">Fill out the form to add a new Hero Section</p>
        </div>

        <a href="<?= base_url('admin/hero') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Hero Section
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <form method="post" action="<?= base_url('admin/hero/save') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">Hero Section Details</h5>

                    <!-- Tagline -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tagline</label>
                        <input type="text" name="tagline"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Making Your Travels Easy" required>
                    </div>

                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" name="title"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Fly With Comfort & Confidence" required>
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300  focus:ring-primary focus:border-primary"
                            placeholder="Enter hero section description..." required></textarea>
                    </div>

                    <!-- Button Link -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Button Link</label>
                        <input type="text" name="button_link"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300  focus:ring-primary focus:border-primary"
                            placeholder="e.g. contact-us or https://example.com/page" required>
                    </div>

                    <!-- Contact Number -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                        <input type="text" name="contact_number"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300  focus:ring-primary focus:border-primary"
                            placeholder="e.g. +1 234 567 890">
                    </div>

                    <!-- Experience Years -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Experience Years</label>
                        <input type="number" name="experience_years"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300  focus:ring-primary focus:border-primary"
                            placeholder="e.g. 10">
                    </div>

                    <!-- Experience Text -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
                        <input type="text" name="experience_text"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300  focus:ring-primary focus:border-primary"
                            placeholder="e.g. Years of Excellence">
                    </div>

                    <!-- Background Shape Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Background Shape Image</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg relative">
                            <div class="space-y-1 text-center">

                                <img id="bg-shape-preview" class="hidden mx-auto mb-4 max-h-48 rounded-md object-contain" />

                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary">
                                        <span>Upload a file</span>
                                        <input type="file" name="bg_shape_image" class="sr-only" accept="image/*"
                                               onchange="previewFlyvistaImage(event,'bg-shape-preview')" required>
                                    </label>
                                </div>

                                <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 10MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Left Image -->
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Left Image</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg relative">

                            <img id="left-preview" class="hidden mx-auto mb-4 max-h-48 rounded-md object-contain" />

                            <div class="space-y-1 text-center">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary">
                                    <span>Upload a file</span>
                                    <input type="file" name="left_image" class="sr-only" accept="image/*"
                                           onchange="previewFlyvistaImage(event,'left-preview')">
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Right Image -->
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Right Image</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg relative">

                            <img id="right-preview" class="hidden mx-auto mb-4 max-h-48 rounded-md object-contain" />

                            <div class="space-y-1 text-center">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary">
                                    <span>Upload a file</span>
                                    <input type="file" name="right_image" class="sr-only" accept="image/*"
                                           onchange="previewFlyvistaImage(event,'right-preview')">
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/hero') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Save Hero Section
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    function previewFlyvistaImage(event, previewId) {
        const input = event.target;
        const preview = document.getElementById(previewId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>