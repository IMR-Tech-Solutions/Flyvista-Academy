<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Edit Mission & Vision</h2>
            <p class="text-gray-500">Update the Mission & Vision details</p>
        </div>

        <a href="<?= base_url('admin/mission-vision') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Mission & Vision
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/mission-vision/update/' . $mv['id']) ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <h5 class="text-lg font-semibold text-secoundry md:col-span-2">Mission Section</h5>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                        <input type="text" name="heading"
                            value="<?= esc($mv['heading']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary">
                    </div>

                    <!-- Mission Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mission Title</label>
                        <input type="text" name="mission_title" value="<?= esc($mv['mission_title']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter mission title..." required>
                    </div>

                    <!-- Mission Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mission Description</label>
                        <textarea name="mission_description" rows="4"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter mission description..." required><?= esc($mv['mission_description']) ?></textarea>
                    </div>

                    <!-- Mission Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mission Image</label>

                        <?php if (!empty($mv['mission_image'])): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('assets/img/mission-vision/' . $mv['mission_image']) ?>"
                                    width="150" class="rounded shadow" id="mission-current-img">
                            </div>
                        <?php endif; ?>

                        <label class="block mb-2 text-sm font-medium text-gray-700">Upload New Mission Image</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                            <div class="space-y-1 text-center">
                                <div class="flex text-sm text-gray-600">
                                    <label for="mission_image"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary/80">
                                        <span>Upload a file</span>
                                        <input id="mission_image" name="mission_image" type="file" class="sr-only" accept="image/*"
                                            onchange="previewImage(event, 'mission-new-preview', 'mission-preview-box')">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 5MB</p>
                            </div>
                        </div>

                        <div id="mission-preview-box" class="hidden mt-4">
                            <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                            <img id="mission-new-preview" src="#" width="150" class="rounded shadow">
                        </div>
                    </div>

                    <!-- Vision Section -->
                    <h5 class="text-lg font-semibold text-secoundry md:col-span-2 mt-6">Vision Section</h5>

                    <!-- Vision Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vision Title</label>
                        <input type="text" name="vision_title" value="<?= esc($mv['vision_title']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter vision title..." required>
                    </div>

                    <!-- Vision Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vision Description</label>
                        <textarea name="vision_description" rows="4"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter vision description..." required><?= esc($mv['vision_description']) ?></textarea>
                    </div>

                    <!-- Vision Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vision Image</label>

                        <?php if (!empty($mv['vision_image'])): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('assets/img/mission-vision/' . $mv['vision_image']) ?>"
                                    width="150" class="rounded shadow" id="vision-current-img">
                            </div>
                        <?php endif; ?>

                        <label class="block mb-2 text-sm font-medium text-gray-700">Upload New Vision Image</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                            <div class="space-y-1 text-center">
                                <div class="flex text-sm text-gray-600">
                                    <label for="vision_image"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary/80">
                                        <span>Upload a file</span>
                                        <input id="vision_image" name="vision_image" type="file" class="sr-only" accept="image/*"
                                            onchange="previewImage(event, 'vision-new-preview', 'vision-preview-box')">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 5MB</p>
                            </div>
                        </div>

                        <div id="vision-preview-box" class="hidden mt-4">
                            <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                            <img id="vision-new-preview" src="#" width="150" class="rounded shadow">
                        </div>
                    </div>

                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/mission-vision') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update Mission & Vision
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