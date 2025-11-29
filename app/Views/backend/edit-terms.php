<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Edit Terms & Conditions</h2>
            <p class="text-gray-500">Update the Terms & Conditions details</p>
        </div>

        <a href="<?= base_url('admin/terms') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Terms
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/terms/update/' . $term['id']) ?>">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Section -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                        <input type="text" name="section" value="<?= esc($term['section']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter section name" required>
                    </div>

                    <!-- Heading -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                        <input type="text" name="heading" value="<?= esc($term['heading']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter heading" required>
                    </div>

                    <!-- Short Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
                        <textarea name="short_desc" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter short description"><?= esc($term['short_desc']) ?></textarea>
                    </div>

                    <!-- Card Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card Title</label>
                        <input type="text" name="card_title" value="<?= esc($term['card_title']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Card title" required>
                    </div>

                    <!-- Card Icon -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card Icon</label>
                        <input type="text" name="card_icon" value="<?= esc($term['card_icon']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Card icon class e.g. fas fa-user" required>
                    </div>

                    <!-- Card Content -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card Content</label>
                        <textarea name="card_content" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Card content description" required><?= esc($term['card_content']) ?></textarea>
                    </div>

                    <!-- Order in Section -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Order in Section</label>
                        <input type="number" name="order_in_section" value="<?= esc($term['order_in_section']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter display order" required>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/terms') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update Terms
                    </button>
                </div>
            </form>

        </div>
    </div>
</main>