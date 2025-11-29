<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Edit Breadcrumb Section</h2>
            <p class="text-gray-500">Update breadcrumb section details</p>
        </div>

        <a href="<?= base_url('admin/breadcrumb-sections') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Breadcrumb List
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/breadcrumb-sections/update/' . $section['id']) ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">Breadcrumb Details</h5>

                    <!-- Slug -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                        <input type="text" name="slug" value="<?= esc($section['slug']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. air-hostess-training" required>
                    </div>

                    <!-- Heading -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                        <input type="text" name="heading" value="<?= esc($section['heading']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter page heading" required>
                    </div>

                    <!-- Breadcrumb Title -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Breadcrumb Title</label>
                        <input type="text" name="breadcrumb_title" value="<?= esc($section['breadcrumb_title']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter breadcrumb title">
                    </div>

                    <!-- Background Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Background Image</label>

                        <?php if (!empty($section['bg_image'])): ?>
                            <div class="mb-2">
                                <img id="breadcrumb-current-preview"
                                    src="<?= base_url($section['bg_image']) ?>"
                                    class="h-32 w-auto rounded shadow">
                            </div>
                        <?php endif; ?>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload New Image</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">
                                    <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary/80">
                                        <span>Upload a file</span>
                                        <input type="file" name="bg_image" class="sr-only" accept="image/*"
                                            onchange="previewFlyvistaImage(event,'breadcrumb-new-preview','breadcrumb-preview-container')">
                                    </label>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 10MB</p>
                                </div>
                            </div>

                            <div id="breadcrumb-preview-container" class="mt-4 hidden">
                                <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                                <img id="breadcrumb-new-preview" src="#" class="h-32 w-auto rounded shadow">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/breadcrumb-sections') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update Section
                    </button>
                </div>

            </form>

        </div>
    </div>
</main>

<script>
    function previewFlyvistaImage(event, imgId, containerId) {
        const input = event.target;
        const preview = document.getElementById(imgId);
        const container = document.getElementById(containerId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                container.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>