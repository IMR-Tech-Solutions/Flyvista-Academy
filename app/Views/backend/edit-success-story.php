<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Edit Success Story</h2>
            <p class="text-gray-500">Update the Student Success Story details</p>
        </div>

        <a href="<?= base_url('admin/success-stories') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Success Stories
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/success-stories/update/' . $story['id']) ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">Student Details</h5>

                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Student Name</label>
                        <input type="text" name="name" value="<?= esc($story['name']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                               placeholder="Enter student name..." required>
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role / Position</label>
                        <input type="text" name="role" value="<?= esc($story['role']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                               placeholder="Enter role/position..." required>
                    </div>

                    <!-- Quote -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quote / Testimonial</label>
                        <textarea name="quote" rows="4"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                                  placeholder="Student's testimonial..." required><?= esc($story['quote']) ?></textarea>
                    </div>

                    <!-- Course -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                        <input type="text" name="course" value="<?= esc($story['course']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="e.g. Airhostess Training, 2022" required>
                    </div>

                    <!-- Featured -->
                    <div class="flex items-center space-x-3 mt-5 md:mt-0">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1"
                               class="h-5 w-5 text-primary border-gray-300 rounded"
                               <?= $story['is_featured'] ? 'checked' : '' ?>>
                        <label for="is_featured" class="text-gray-700 font-medium">Featured Student</label>
                    </div>

                    <!-- Student Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Student Image</label>

                        <?php if (!empty($story['image']) && file_exists('assets/img/success-stories/' . $story['image'])): ?>
                            <div class="mb-2">
                                <img id="image-current-preview"
                                     src="<?= base_url('assets/img/success-stories/' . $story['image']) ?>"
                                     width="150" class="rounded shadow">
                            </div>
                        <?php endif; ?>

                        <div class="mt-4 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                            <div class="space-y-1 text-center">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary/80">
                                    <span>Upload a new image</span>
                                    <input type="file" name="image" class="sr-only" accept="image/*"
                                           onchange="previewImage(event, 'image-new-preview', 'image-preview-container')">
                                </label>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 10MB</p>
                            </div>
                        </div>

                        <div id="image-preview-container" class="mt-4 hidden">
                            <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                            <img id="image-new-preview" src="#" width="150" class="rounded shadow">
                        </div>
                    </div>

                    <!-- LinkedIn URL -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" value="<?= esc($story['linkedin_url']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="https://linkedin.com/in/username">
                    </div>

                </div>

                <!-- Submit -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/success-stories') ?>"
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update Success Story
                    </button>
                </div>

            </form>

        </div>
    </div>
</main>

<script>
    function previewImage(event, imgId, containerId) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(imgId).src = e.target.result;
            document.getElementById(containerId).classList.remove("hidden");
        };
        reader.readAsDataURL(file);
    }
</script>