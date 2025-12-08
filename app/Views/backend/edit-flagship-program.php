<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Edit Flagship Program</h2>
            <p class="text-gray-500">Update the Flagship Program details</p>
        </div>

        <a href="<?= base_url('admin/flagship_program') ?>"
           class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Flagship Programs
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/flagship_program/update/' . $program['id']) ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <h5 class="text-lg font-semibold text-secondary md:col-span-2">Program Details</h5>

                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" name="title" value="<?= esc($program['title']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                            placeholder="Enter program title..." required>
                    </div>

                    <!-- Subtitle -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                        <input type="text" name="subtitle" value="<?= esc($program['subtitle']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                            placeholder="Enter program subtitle...">
                    </div>

                    <!-- Overview -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Overview</label>
                        <textarea name="overview" rows="4"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter program overview..."><?= esc($program['overview']) ?></textarea>
                    </div>

                    <!-- Training Highlights -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Training Highlights (one per line)</label>
                        <textarea name="training_highlights" rows="4"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter each highlight on a new line..."><?= esc($program['training_highlights']) ?></textarea>
                    </div>

                    <!-- Distinctive Features -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Distinctive Features (one per line)</label>
                        <textarea name="distinctive_features" rows="4"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter each feature on a new line..."><?= esc($program['distinctive_features']) ?></textarea>
                    </div>

                    <!-- Tagline -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tagline</label>
                        <input type="text" name="tagline" value="<?= esc($program['tagline']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter right-image tagline e.g., FLAGSHIP PROGRAM">
                    </div>

                    <!-- Success Rate -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Success Rate (%)</label>
                        <input type="number" name="success_rate" value="<?= esc($program['success_rate']) ?>"
                               min="0" max="100"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="e.g., 98">
                    </div>

                    <!-- Outcome Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Outcome Description</label>
                        <textarea name="outcome_description" rows="4"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Describe the outcome e.g., Program leads to superior placements..."><?= esc($program['outcome_description']) ?></textarea>
                    </div>

                    <!-- Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Program Image</label>

                        <?php if (!empty($program['image'])): ?>
                            <div class="mb-2">
                                <img id="current-program-image" 
                                     src="<?= base_url('assets/img/courses/' . $program['image']) ?>" 
                                     width="150" class="rounded shadow">
                            </div>
                        <?php endif; ?>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload New Image</label>

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">

                                    <div class="flex text-sm text-gray-600">
                                        <label for="program_image" 
                                               class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary/80">
                                            <span>Upload a file</span>
                                            <input id="program_image" name="image" type="file" class="sr-only" accept="image/*"
                                                   onchange="previewFlagshipImage(event,'new-program-image','new-image-container');">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>

                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 5MB</p>
                                </div>
                            </div>

                            <!-- New Image Preview -->
                            <div id="new-image-container" class="mt-4 hidden">
                                <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                                <img id="new-program-image" src="#" width="150" class="rounded shadow">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/flagship_program') ?>" 
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update Program
                    </button>
                </div>
            </form>

        </div>
    </div>
</main>

<script>
    function previewFlagshipImage(event, imgId, containerId) {
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