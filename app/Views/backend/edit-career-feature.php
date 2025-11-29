<!-- Main Content Area -->
<main class="p-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Edit Career Feature</h2>
            <p class="text-gray-500">Update the career feature details below</p>
        </div>

        <a href="<?= base_url('admin/career-features') ?>"
           class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Career Feature List
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/career-features/update/' . $career_feature['id']) ?>">
                <?= csrf_field() ?>

                <!-- Feature Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <h5 class="text-lg font-semibold text-secondary md:col-span-2">Feature Details</h5>

                    <!-- Heading -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                        <input type="text" name="heading" value="<?= esc($career_feature['heading']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                            placeholder="Enter main heading...">
                    </div>

                    <!-- Short Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
                        <input type="text" name="short_desc" value="<?= esc($career_feature['short_desc']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none"
                            placeholder="Enter short description...">
                    </div>

                    <!-- Icon -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Icon (Font Awesome class)</label>
                        <input type="text" name="icon" value="<?= esc($career_feature['icon']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none"
                            placeholder="e.g., fas fa-star" required>
                    </div>

                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" name="title" value="<?= esc($career_feature['title']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none"
                            placeholder="Enter title..." required>
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <h5 class="text-lg font-semibold text-secondary">Description</h5>

                    <label class="block text-sm font-medium text-gray-700 mb-1 mt-2">Full Description</label>
                    <textarea name="description" rows="4"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none"
                        placeholder="Write full description..."><?= esc($career_feature['description']) ?></textarea>
                </div>

                <!-- Status -->
                <div class="mt-6">
                    <label class="inline-flex items-center space-x-2">
                        <input type="checkbox" name="status" class="w-5 h-5 text-primary border-gray-300"
                            <?= $career_feature['status'] == 1 ? 'checked' : '' ?>>
                        <span class="text-gray-700">Active Status</span>
                    </label>
                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/career-features') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update Career Feature
                    </button>
                </div>

            </form>

        </div>
    </div>

</main>