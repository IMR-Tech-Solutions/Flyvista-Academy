<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Edit Course</h2>
            <p class="text-gray-500">Update the Course details</p>
        </div>

        <a href="<?= base_url('admin/courses') ?>"
           class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Courses
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/courses/update/' . $course['id']) ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <h5 class="text-lg font-semibold text-secondary md:col-span-2">Course Details</h5>

                    <!-- Subheading -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subheading</label>
                        <input type="text" name="subheading" value="<?= esc($course['subheading']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="Enter subheading...">
                    </div>

                    <!-- Heading -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                        <input type="text" name="heading" value="<?= esc($course['heading']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="Enter heading...">
                    </div>

                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" name="title" value="<?= esc($course['title']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="Enter title..." required>
                    </div>

                    <!-- Slug -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                        <input type="text" name="slug" value="<?= esc($course['slug']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="Enter slug..." required>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <input type="text" name="category" value="<?= esc($course['category']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="Enter category..." required>
                    </div>

                    <!-- Icon -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Icon (FontAwesome)</label>
                        <input type="text" name="icon" value="<?= esc($course['icon']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="fas fa-plane" required>
                    </div>

                    <!-- Duration -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
                        <input type="text" name="duration" value="<?= esc($course['duration']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="e.g. 3 Months" required>
                    </div>

                    <!-- Level -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                        <select name="level"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary" required>
                            <option value="Beginner"     <?= $course['level'] === "Beginner" ? "selected" : "" ?>>Beginner</option>
                            <option value="Intermediate" <?= $course['level'] === "Intermediate" ? "selected" : "" ?>>Intermediate</option>
                            <option value="Advanced"     <?= $course['level'] === "Advanced" ? "selected" : "" ?>>Advanced</option>
                        </select>
                    </div>

                    <!-- Progress -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Progress (0-100)
                            <span id="progress-value" class="ml-2 text-primary font-semibold">
                                <?= esc($course['progress']) ?>%
                            </span>
                        </label>

                        <input type="range" name="progress" min="0" max="100"
                               value="<?= esc($course['progress']) ?>"
                               class="w-full cursor-pointer accent-primary"
                               oninput="document.getElementById('progress-value').innerText = this.value + '%'">
                    </div>

                    <!-- Short Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
                        <textarea name="short_description" rows="3"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                                  placeholder="Enter short description..."><?= esc($course['short_description']) ?></textarea>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary">
                            <option value="1" <?= $course['status'] == 1 ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= $course['status'] == 0 ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>

                    <!-- Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Course Image</label>

                        <?php if (!empty($course['image'])): ?>
                            <div class="mb-3">
                                <img id="current-image-preview"
                                     src="<?= base_url('assets/img/courses/' . $course['image']) ?>"
                                     width="150" class="rounded shadow">
                            </div>
                        <?php endif; ?>

                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload New Image</label>

                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                            <div class="space-y-1 text-center">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary">
                                    <span>Upload a file</span>
                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*"
                                           onchange="previewImage(event,'new-image-preview','new-image-container')">
                                </label>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 5MB</p>
                            </div>
                        </div>

                        <div id="new-image-container" class="mt-4 hidden">
                            <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                            <img id="new-image-preview" src="#" width="150" class="rounded shadow">
                        </div>
                    </div>

                </div>

                <!-- Submit -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/courses') ?>"
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>

                    <button type="submit"
                            class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update Course
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