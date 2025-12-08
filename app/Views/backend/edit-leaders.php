<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Edit Leader</h2>
            <p class="text-gray-500">Update the Leader details</p>
        </div>

        <a href="<?= base_url('admin/leaders') ?>"
           class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Leaders
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/leaders/update/' . $leader->leader_id) ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">Leader Details</h5>

                    <!-- Full Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="full_name" value="<?= esc($leader->full_name) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               required>
                    </div>

                    <!-- Designation -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                        <input type="text" name="designation" value="<?= esc($leader->designation) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               required>
                    </div>

                    <!-- Heading -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                        <input type="text" name="heading" value="<?= esc($leader->heading) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary">
                    </div>

                    <!-- Short Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
                        <textarea name="short_description"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary"
                                  rows="4"><?= esc($leader->short_description) ?></textarea>
                    </div>

                    <!-- Quote -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quote</label>
                        <textarea name="quote"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary"
                                  rows="4"><?= esc($leader->quote) ?></textarea>
                    </div>

                    <!-- Profile Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Profile Image</label>

                        <?php if (!empty($leader->profile_image) && file_exists('assets/img/team/' . $leader->profile_image)): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('assets/img/team/' . $leader->profile_image) ?>"
                                     width="150" class="rounded shadow">
                            </div>
                        <?php endif; ?>

                        <div class="mt-4 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                            <label class="cursor-pointer text-primary">
                                <span>Upload new image</span>
                                <input type="file" name="profile_image" class="sr-only" accept="image/*">
                            </label>
                        </div>
                    </div>

                    <!-- Responsibilities as textarea -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Responsibilities</label>
                        <textarea name="responsibility"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary"
                                  rows="5"><?= esc($leader->responsibility) ?></textarea>
                    </div>

                    <!-- Display Order -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                        <input type="number" name="display_order" value="<?= esc($leader->display_order) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary">
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/leaders') ?>"
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg">
                        <i class="fas fa-save mr-2"></i> Update Leader
                    </button>
                </div>
            </form>

        </div>
    </div>
</main>