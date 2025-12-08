<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Add New Placement & Career Section</h2>
            <p class="text-gray-500">Fill out the form to add placement & career development content</p>
        </div>

        <a href="<?= base_url('admin/placement-career') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Placement & Career
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/placement-career/save') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Section Heading -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">Section Details</h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Main Heading</label>
                        <input type="text" name="section_heading"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Placement & Career Development" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sub Heading</label>
                        <input type="text" name="section_subheading"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter subheading...">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Section Description</label>
                        <textarea name="section_description" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Write main section description..." required></textarea>
                    </div>

                    <!-- Card 1 -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2 mt-4">Card 1</h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card 1 Title</label>
                        <input type="text" name="card1_title"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. What Students Get" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card 1 Items (new line separated)</label>
                        <textarea name="card1_items" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. 100% placement support, Resume building, Mock interviews..." required></textarea>
                    </div>

                    <!-- Card 2 -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2 mt-4">Card 2</h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card 2 Title</label>
                        <input type="text" name="card2_title"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Our Commitment to Your Career" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card 2 Description</label>
                        <textarea name="card2_description" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter description..." required></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card 2 Items (new line)</label>
                        <textarea name="card2_items" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Career counseling, Grooming sessions..." required></textarea>
                    </div>

                    <!-- Card 3 -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2 mt-4">Card 3</h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card 3 Title</label>
                        <input type="text" name="card3_title"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Success Stories That Inspire" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card 3 Description</label>
                        <textarea name="card3_description" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter description..." required></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card 3 Items (comma separated)</label>
                        <textarea name="card3_items" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Leading airlines, Airport companies..." required></textarea>
                    </div>

                    <!-- Status -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/placement-career') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Save Placement & Career
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>