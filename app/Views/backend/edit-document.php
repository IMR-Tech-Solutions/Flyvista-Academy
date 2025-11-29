<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Edit Document</h2>
            <p class="text-gray-500">Update the document details</p>
        </div>

        <a href="<?= base_url('admin/documents') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Documents
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/documents/update/' . $document['id']) ?>">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <h5 class="text-lg font-semibold text-secondary md:col-span-2">Document Details</h5>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="category"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary">
                            <option value="Mandatory" <?= $document['category'] == 'Mandatory' ? 'selected' : '' ?>>Mandatory</option>
                            <option value="Additional" <?= $document['category'] == 'Additional' ? 'selected' : '' ?>>Additional</option>
                        </select>
                    </div>

                    <!-- Document Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Document Name</label>
                        <input type="text" name="document_name" value="<?= esc($document['document_name']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                            placeholder="Enter document name..." required>
                    </div>

                    <!-- Is Optional -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Is Optional?</label>
                        <select name="is_optional"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary">
                            <option value="0" <?= $document['is_optional'] == 0 ? 'selected' : '' ?>>No (Mandatory)</option>
                            <option value="1" <?= $document['is_optional'] == 1 ? 'selected' : '' ?>>Yes (Optional)</option>
                        </select>
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                        <input type="number" name="sort_order" value="<?= esc($document['sort_order']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                            placeholder="Enter sort order...">
                    </div>

                </div>

                <!-- Submit Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/documents') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update Document
                    </button>
                </div>

            </form>

        </div>
    </div>
</main>