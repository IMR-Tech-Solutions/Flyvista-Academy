<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-dark">Edit Hero Section</h2>
            <p class="text-gray-500">Update the Hero Section details</p>
        </div>

        <a href="<?= base_url('admin/hero') ?>"
            class="text-secoundry hover:text-gray-700 flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Hero Section
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/hero/update/' . $hero['id']) ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <h5 class="text-lg font-semibold text-secoundry md:col-span-2">Hero Section Details</h5>

                    <!-- Tagline -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tagline</label>
                        <input type="text" name="tagline" value="<?= esc($hero['tagline']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                            placeholder="Enter tagline..." required>
                    </div>

                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" name="title" value="<?= esc($hero['title']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                            placeholder="Enter title..." required>
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter hero description..."><?= esc($hero['description']) ?></textarea>
                    </div>

                    <!-- Button Link -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Button Link</label>
                        <input type="text" name="button_link" value="<?= esc($hero['button_link']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter button link..." required>
                    </div>

                    <!-- Contact Number -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                        <input type="text" name="contact_number" value="<?= esc($hero['contact_number']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter contact number...">
                    </div>

                    <!-- Experience Years -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Experience Years</label>
                        <input type="number" name="experience_years" value="<?= esc($hero['experience_years']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary">
                    </div>

                    <!-- Experience Text -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
                        <input type="text" name="experience_text" value="<?= esc($hero['experience_text']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            required>
                    </div>

                    <!-- Shape Background Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Shape Background Image</label>

                        <?php if (!empty($hero['bg_shape_image'])): ?>
                            <div class="mb-2">
                                <img id="shape-current-preview"
                                    src="<?= base_url('assets/img/home/' . $hero['bg_shape_image']) ?>"
                                    width="150" class="rounded shadow">
                            </div>
                        <?php endif; ?>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload New Shape Background</label>

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">

                                    <div class="flex text-sm text-gray-600">
                                        <label for="bg_shape_image"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary/80">
                                            <span>Upload a file</span>
                                            <input id="bg_shape_image" name="bg_shape_image" type="file"
                                                class="sr-only" accept="image/*"
                                                onchange="previewImage(event, 'shape-new-preview', 'shape-preview-container')">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>

                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 5MB</p>
                                </div>
                            </div>

                            <!-- New Image Preview -->
                            <div id="shape-preview-container" class="mt-4 hidden">
                                <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                                <img id="shape-new-preview" src="#" width="150" class="rounded shadow">
                            </div>
                        </div>
                    </div>

                    <!-- Left Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Left Image</label>

                        <?php if (!empty($hero['left_image'])): ?>
                            <div class="mb-2">
                                <img id="left-current-preview"
                                    src="<?= base_url('assets/img/home/' . $hero['left_image']) ?>"
                                    width="150" class="rounded shadow">
                            </div>
                        <?php endif; ?>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload New Left Image</label>

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">

                                    <div class="flex text-sm text-gray-600">
                                        <label for="left_image"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary/80">
                                            <span>Upload a file</span>
                                            <input id="left_image" name="left_image" type="file"
                                                class="sr-only" accept="image/*"
                                                onchange="previewImage(event, 'left-new-preview', 'left-preview-container')">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>

                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 5MB</p>
                                </div>
                            </div>

                            <!-- New Image Preview -->
                            <div id="left-preview-container" class="mt-4 hidden">
                                <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                                <img id="left-new-preview" src="#" width="150" class="rounded shadow">
                            </div>
                        </div>
                    </div>

                    <!-- Right Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Right Image</label>

                        <?php if (!empty($hero['right_image'])): ?>
                            <div class="mb-2">
                                <img id="right-current-preview"
                                    src="<?= base_url('assets/img/home/' . $hero['right_image']) ?>"
                                    width="150" class="rounded shadow">
                            </div>
                        <?php endif; ?>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload New Right Image</label>

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">

                                    <div class="flex text-sm text-gray-600">
                                        <label for="right_image"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary/80">
                                            <span>Upload a file</span>
                                            <input id="right_image" name="right_image" type="file"
                                                class="sr-only" accept="image/*"
                                                onchange="previewImage(event, 'right-new-preview', 'right-preview-container')">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>

                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 5MB</p>
                                </div>
                            </div>

                            <!-- New Image Preview -->
                            <div id="right-preview-container" class="mt-4 hidden">
                                <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                                <img id="right-new-preview" src="#" width="150" class="rounded shadow">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Submit -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/hero') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update Hero
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