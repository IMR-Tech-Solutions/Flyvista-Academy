<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Add New Mission & Vision Section</h2>
            <p class="text-gray-500">Fill out the form to add Mission, Vision, Core Values & Images</p>
        </div>

        <a href="<?= base_url('admin/mission-vision') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Mission & Vision
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <form method="post" action="<?= base_url('admin/mission-vision/save') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">
                        Mission Details
                    </h5>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                        <input type="text" name="heading"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                        placeholder="Enter main section heading...">
                    </div>

                    <!-- Mission Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mission Title</label>
                        <input type="text" name="mission_title"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Our Mission" required>
                    </div>

                    <!-- Mission Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mission Description</label>
                        <textarea name="mission_description" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Write mission details..." required></textarea>
                    </div>

                    <!-- Vision -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2 mt-4">
                        Vision Details
                    </h5>

                    <!-- Vision Title -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vision Title</label>
                        <input type="text" name="vision_title"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Our Vision" required>
                    </div>

                    <!-- Vision Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vision Description</label>
                        <textarea name="vision_description" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Write vision details..." required></textarea>
                    </div>

                    <!-- Core Values -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2 mt-4">
                        Core Values Details
                    </h5>

                    <!-- Core Values Title -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Core Values Title</label>
                        <input type="text" name="core_values_title"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Our Core Values" required>
                    </div>

                    <!-- Core Values Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Core Values Description</label>
                        <textarea name="core_values_description" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Describe your core values..." required></textarea>
                    </div>

                    <!-- Badge -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2 mt-4">
                        Badge Details
                    </h5>

                    <!-- Badge Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Badge Title</label>
                        <input type="text" name="badge_title"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Years of Excellence" required>
                    </div>

                    <!-- Badge Count -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Badge Count</label>
                        <input type="number" name="badge_count"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. 10" required>
                    </div>

                    <!-- Top Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Top Image</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">

                            <img id="top-preview" class="hidden mx-auto mb-4 max-h-48 rounded-md object-contain" />

                            <div class="space-y-1 text-center">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary">
                                    <span>Upload a file</span>
                                    <input type="file" name="top_image" class="sr-only" accept="image/*"
                                        onchange="previewFlyvistaImage(event,'top-preview')" required>
                                </label>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 10MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bottom Image</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">

                            <img id="bottom-preview" class="hidden mx-auto mb-4 max-h-48 rounded-md object-contain" />

                            <div class="space-y-1 text-center">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary">
                                    <span>Upload a file</span>
                                    <input type="file" name="bottom_image" class="sr-only" accept="image/*"
                                        onchange="previewFlyvistaImage(event,'bottom-preview')" required>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/mission-vision') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Save Mission & Vision
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