<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Add New Flagship Program</h2>
            <p class="text-gray-500">Fill out the form to add a new Flagship Program</p>
        </div>

        <a href="<?= base_url('admin/flagship_program') ?>"
           class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Flagship Programs
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <form method="post" action="<?= base_url('admin/flagship_program/save') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">Flagship Program Details</h5>

                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" name="title"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="Enter program title" required>
                    </div>

                    <!-- Subtitle -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                        <input type="text" name="subtitle"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="Enter program subtitle">
                    </div>

                    <!-- Tagline -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tagline</label>
                        <input type="text" name="tagline"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="Enter short tagline (optional)">
                    </div>

                    <!-- Overview -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Overview</label>
                        <textarea name="overview" rows="4"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                                  placeholder="Enter program overview"></textarea>
                    </div>

                    <!-- Training Highlights -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Training Highlights</label>
                        <textarea name="training_highlights" rows="4"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                                  placeholder="Enter training highlights (one per line)"></textarea>
                    </div>

                    <!-- Distinctive Features -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Distinctive Features</label>
                        <textarea name="distinctive_features" rows="4"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                                  placeholder="Enter distinctive features (one per line)"></textarea>
                    </div>

                    <!-- Outcome Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Outcome Description</label>
                        <textarea name="outcome_description" rows="4"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                                  placeholder="Describe program outcome"></textarea>
                    </div>

                    <!-- Success Rate -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Success Rate (%)</label>
                        <input type="number" name="success_rate"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="E.g. 98" min="0" max="100">
                    </div>

                    <!-- Image Upload -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Program Image</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg relative">
                            <div class="space-y-1 text-center">

                                <img id="program-image-preview" class="hidden mx-auto mb-4 max-h-48 rounded-md object-contain" />

                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary">
                                        <span>Upload a file</span>
                                        <input type="file" name="image" class="sr-only" accept="image/*"
                                               onchange="previewFlagshipImage(event,'program-image-preview')">
                                    </label>
                                </div>

                                <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 10MB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/flagship_program') ?>"
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>

                    <button type="submit"
                            class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Save Flagship Program
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    function previewFlagshipImage(event, previewId) {
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