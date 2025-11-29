<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Add New About Section</h2>
            <p class="text-gray-500">Fill out the form to add a new About Section</p>
        </div>

        <a href="<?= base_url('admin/about') ?>"
           class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to About Section
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <form method="post" action="<?= base_url('admin/about/save') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">About Section Details</h5>

                    <!-- Tag Text -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tag Text</label>
                        <input type="text" name="tag_text"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Who We Are" required>
                    </div>

                    <!-- Heading -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                        <input type="text" name="heading"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Learn More About Our Journey" required>
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Write about your company..." required></textarea>
                    </div>

                    <!-- Progress Percent -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Progress Percent</label>
                        <input type="number" name="progress_percent"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. 85" required>
                    </div>

                    <!-- Learn More Link -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Learn More Link</label>
                        <input type="text" name="learn_more_link"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300  focus:ring-primary focus:border-primary"
                            placeholder="e.g. about-us or https://example.com/link" required>
                    </div>

                    <!-- Feature Icon -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Feature Icon (FontAwesome)</label>
                        <input type="text" name="feature1_icon"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. fas fa-plane" required>
                    </div>

                    <!-- Feature Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Feature Title</label>
                        <input type="text" name="feature1_title"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Best Travel Experience" required>
                    </div>

                    <!-- Feature Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Feature Description</label>
                        <textarea name="feature1_description" rows="2"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Short description for feature..." required></textarea>
                    </div>

                    <!-- Instructor Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instructor Title</label>
                        <input type="text" name="instructor_title"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Lead Instructor" required>
                    </div>

                    <!-- Instructor Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instructor Name</label>
                        <input type="text" name="instructor_name"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. John Doe" required>
                    </div>

                    <!-- Image 1 -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image 1</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">

                            <img id="image1-preview" class="hidden mx-auto mb-4 max-h-48 rounded-md object-contain" />

                            <div class="space-y-1 text-center">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary">
                                    <span>Upload a file</span>
                                    <input type="file" name="image1" class="sr-only" accept="image/*"
                                           onchange="previewFlyvistaImage(event,'image1-preview')" required>
                                </label>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 10MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Image 2 -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image 2</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">

                            <img id="image2-preview" class="hidden mx-auto mb-4 max-h-48 rounded-md object-contain" />

                            <div class="space-y-1 text-center">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary">
                                    <span>Upload a file</span>
                                    <input type="file" name="image2" class="sr-only" accept="image/*"
                                           onchange="previewFlyvistaImage(event,'image2-preview')" required>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Instructor Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instructor Image</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">

                            <img id="inst-preview" class="hidden mx-auto mb-4 max-h-48 rounded-md object-contain" />

                            <div class="space-y-1 text-center">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary">
                                    <span>Upload a file</span>
                                    <input type="file" name="instructor_image" class="sr-only" accept="image/*"
                                           onchange="previewFlyvistaImage(event,'inst-preview')" required>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/about') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Save About Section
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