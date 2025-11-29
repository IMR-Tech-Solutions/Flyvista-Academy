<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-dark">Edit About Section</h2>
            <p class="text-gray-500">Update the About Section details</p>
        </div>

        <a href="<?= base_url('admin/about') ?>"
            class="text-secoundry hover:text-gray-700 flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to About Section
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/about/update/' . $about['id']) ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <h5 class="text-lg font-semibold text-secoundry md:col-span-2">About Section Details</h5>

                    <!-- Tag Text -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tag Text</label>
                        <input type="text" name="tag_text" value="<?= esc($about['tag_text']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                            placeholder="Enter tag text..." required>
                    </div>

                    <!-- Heading -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                        <input type="text" name="heading" value="<?= esc($about['heading']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                            placeholder="Enter heading..." required>
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter description..."><?= esc($about['description']) ?></textarea>
                    </div>

                    <!-- Progress Percent -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Progress Percent</label>
                        <input type="number" name="progress_percent" value="<?= esc($about['progress_percent']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. 85" required>
                    </div>

                    <!-- Learn More Link -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Learn More Link</label>
                        <input type="text" name="learn_more_link" value="<?= esc($about['learn_more_link']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter link..." required>
                    </div>

                    <!-- Feature Icon -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Feature Icon</label>
                        <input type="text" name="feature1_icon" value="<?= esc($about['feature1_icon']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. fas fa-plane" required>
                    </div>

                    <!-- Feature Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Feature Title</label>
                        <input type="text" name="feature1_title" value="<?= esc($about['feature1_title']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter title..." required>
                    </div>

                    <!-- Feature Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Feature Description</label>
                        <textarea name="feature1_description" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter feature description..."><?= esc($about['feature1_description']) ?></textarea>
                    </div>

                    <!-- Instructor Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instructor Title</label>
                        <input type="text" name="instructor_title" value="<?= esc($about['instructor_title']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            required>
                    </div>

                    <!-- Instructor Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instructor Name</label>
                        <input type="text" name="instructor_name" value="<?= esc($about['instructor_name']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            required>
                    </div>

                    <!-- Image 1 -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image 1</label>

                        <?php if (!empty($about['image1'])): ?>
                            <div class="mb-2">
                                <img id="image1-current-preview"
                                    src="<?= base_url('assets/img/about/' . $about['image1']) ?>"
                                    width="150" class="rounded shadow">
                            </div>
                        <?php endif; ?>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload New Image 1</label>

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">

                                    <div class="flex text-sm text-gray-600">
                                        <label for="image1"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary/80">
                                            <span>Upload a file</span>
                                            <input id="image1" name="image1" type="file"
                                                class="sr-only" accept="image/*"
                                                onchange="previewImage(event, 'image1-new-preview', 'image1-preview-container')">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>

                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 5MB</p>
                                </div>
                            </div>

                            <div id="image1-preview-container" class="mt-4 hidden">
                                <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                                <img id="image1-new-preview" src="#" width="150" class="rounded shadow">
                            </div>
                        </div>
                    </div>

                    <!-- Image 2 -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image 2</label>

                        <?php if (!empty($about['image2'])): ?>
                            <div class="mb-2">
                                <img id="image2-current-preview"
                                    src="<?= base_url('assets/img/about/' . $about['image2']) ?>"
                                    width="150" class="rounded shadow">
                            </div>
                        <?php endif; ?>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload New Image 2</label>

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">

                                    <div class="flex text-sm text-gray-600">
                                        <label for="image2"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary/80">
                                            <span>Upload a file</span>
                                            <input id="image2" name="image2" type="file"
                                                class="sr-only" accept="image/*"
                                                onchange="previewImage(event, 'image2-new-preview', 'image2-preview-container')">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>

                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 5MB</p>
                                </div>
                            </div>

                            <div id="image2-preview-container" class="mt-4 hidden">
                                <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                                <img id="image2-new-preview" src="#" width="150" class="rounded shadow">
                            </div>
                        </div>
                    </div>

                    <!-- Instructor Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instructor Image</label>

                        <?php if (!empty($about['instructor_image'])): ?>
                            <div class="mb-2">
                                <img id="inst-current-preview"
                                    src="<?= base_url('assets/img/about/' . $about['instructor_image']) ?>"
                                    width="150" class="rounded shadow">
                            </div>
                        <?php endif; ?>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload New Instructor Image</label>

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">

                                    <div class="flex text-sm text-gray-600">
                                        <label for="instructor_image"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary/80">
                                            <span>Upload a file</span>
                                            <input id="instructor_image" name="instructor_image" type="file"
                                                class="sr-only" accept="image/*"
                                                onchange="previewImage(event, 'inst-new-preview', 'inst-preview-container')">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>

                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 5MB</p>
                                </div>
                            </div>

                            <div id="inst-preview-container" class="mt-4 hidden">
                                <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                                <img id="inst-new-preview" src="#" width="150" class="rounded shadow">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/about') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update About Section
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