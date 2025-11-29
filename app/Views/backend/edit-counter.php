<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Edit Counter</h2>
            <p class="text-gray-500">Update counter details</p>
        </div>

        <a href="<?= base_url('admin/counters') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Counter List
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/counters/update/' . $counter['id']) ?>">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">Counter Details</h5>

                    <!-- Icon -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Font Awesome Icon</label>
                        <input type="text" name="icon" value="<?= esc($counter['icon']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="e.g. fa-solid fa-trophy" required>
                        <p class="text-xs text-gray-500 mt-1">Use Font Awesome classes for icons.</p>
                    </div>

                    <!-- Count -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Count</label>
                        <input type="number" name="count" value="<?= esc($counter['count']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="e.g. 10" required>
                    </div>

                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" name="title" value="<?= esc($counter['title']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="e.g. Years of Excellence" required>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/counters') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update Counter
                    </button>
                </div>

            </form>

        </div>
    </div>
</main>