<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Add New Leader</h2>
            <p class="text-gray-500">Fill out the form to add a new Leader</p>
        </div>

        <a href="<?= base_url('admin/leaders') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Leaders
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <form method="post" action="<?= base_url('admin/leaders/save') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">Leader Details</h5>

                    <!-- Full Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="full_name"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="e.g. John Doe" required>
                    </div>

                    <!-- Designation -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                        <input type="text" name="designation"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="e.g. CEO, Flyvista Education" required>
                    </div>

                    <!-- Heading -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                        <input type="text" name="heading"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="e.g. Visionary Leader in Education">
                    </div>

                    <!-- Short Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
                        <textarea name="short_description"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                                  rows="4" placeholder="Max 200 characters"></textarea>
                    </div>

                    <!-- Quote -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quote</label>
                        <textarea name="quote"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                                  rows="4" placeholder="Leader's personal quote"></textarea>
                    </div>

                    <!-- Profile Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Profile Image</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">

                            <img id="leader-image-preview" class="hidden mx-auto mb-4 max-h-48 rounded-full object-cover" />

                            <div class="space-y-1 text-center">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary">
                                    <span>Upload a file</span>
                                    <input type="file" name="profile_image" class="sr-only" accept="image/*"
                                           onchange="previewLeaderImage(event,'leader-image-preview')">
                                </label>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 10MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Responsibilities as textarea -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Responsibilities</label>
                        <textarea name="responsibility"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary"
                                  rows="5" placeholder="Enter responsibilities separated by new lines"></textarea>
                    </div>

                    <!-- Display Order -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                        <input type="number" name="display_order"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="e.g. 1">
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/leaders') ?>"
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>

                    <button type="submit"
                            class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Save Leader
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    /* Image Preview */
    function previewLeaderImage(event, previewId) {
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