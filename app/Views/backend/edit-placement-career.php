<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Edit Placement & Career Development</h2>
            <p class="text-gray-500">Update the Placement & Career section details</p>
        </div>

        <a href="<?= base_url('admin/placement-career') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Placement & Career
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/placement-career/update/' . $pc['id']) ?>">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Section Details -->
                    <h5 class="text-lg font-semibold text-secondary md:col-span-2">Section Details</h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Main Heading</label>
                        <input type="text" name="section_heading" 
                            value="<?= esc($pc['section_heading']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter section heading..." required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sub Heading</label>
                        <input type="text" name="section_subheading" 
                            value="<?= esc($pc['section_subheading']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter section subheading...">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Section Description</label>
                        <textarea name="section_description" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter section description..." required><?= esc($pc['section_description']) ?></textarea>
                    </div>

                    <!-- CARD 1 -->
                    <h5 class="text-lg font-semibold text-secondary md:col-span-2 mt-6">Card 1 — What Students Get</h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card 1 Title</label>
                        <input type="text" name="card1_title" 
                            value="<?= esc($pc['card1_title']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. What Students Get" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card 1 Items (comma separated)</label>
                        <textarea name="card1_items" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. 100% placement support, resume building..."><?= esc($pc['card1_items']) ?></textarea>
                    </div>

                    <!-- CARD 2 -->
                    <h5 class="text-lg font-semibold text-secondary md:col-span-2 mt-6">Card 2 — Our Commitment</h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card 2 Title</label>
                        <input type="text" name="card2_title" 
                            value="<?= esc($pc['card2_title']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Our Commitment To Your Career" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card 2 Description</label>
                        <textarea name="card2_description" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter description..." required><?= esc($pc['card2_description']) ?></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card 2 Items (comma separated)</label>
                        <textarea name="card2_items" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. interview prep, grooming sessions..."><?= esc($pc['card2_items']) ?></textarea>
                    </div>

                    <!-- CARD 3 -->
                    <h5 class="text-lg font-semibold text-secondary md:col-span-2 mt-6">Card 3 — Success Stories</h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card 3 Title</label>
                        <input type="text" name="card3_title" 
                            value="<?= esc($pc['card3_title']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Success Stories That Inspire" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card 3 Description</label>
                        <textarea name="card3_description" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter card description..." required><?= esc($pc['card3_description']) ?></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Card 3 Items (comma separated)</label>
                        <textarea name="card3_items" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. domestic airlines, luxury hotels..."><?= esc($pc['card3_items']) ?></textarea>
                    </div>

                    <!-- STATUS -->
                    <h5 class="text-lg font-semibold text-secondary md:col-span-2 mt-6">Status</h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select Status</label>
                        <select name="status"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary">
                            <option value="1" <?= $pc['status'] == 1 ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= $pc['status'] == 0 ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/placement-career') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update Placement & Career
                    </button>
                </div>

            </form>

        </div>
    </div>
</main>