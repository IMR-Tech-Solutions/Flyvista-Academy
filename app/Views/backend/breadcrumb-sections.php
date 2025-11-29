<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-secondary-dark">Breadcrumb Sections</h2>
        <a href="<?= base_url('admin/breadcrumb-sections/add') ?>"
            class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Add New Section
        </a>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <p class="bg-green-200 p-2 mb-2 text-sm"><?= session()->getFlashdata('success') ?></p>
    <?php elseif (session()->getFlashdata('error')): ?>
        <p class="bg-red-200 p-2 mb-2 text-sm"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <!-- Breadcrumb Sections Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">

        <!-- Controls Section -->
        <div class="bg-white rounded-lg shadow p-4 mb-4 flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">

            <!-- Search -->
            <div class="flex items-center max-w-xs w-full">
                <label for="searchBreadcrumb" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="searchBreadcrumb" placeholder="Search Heading..."
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary block w-full" />
                </div>
            </div>

            <!-- Show entries -->
            <div class="flex items-center space-x-2">
                <label for="lengthMenuBreadcrumb" class="font-medium text-gray-700">Show entries:</label>
                <select id="lengthMenuBreadcrumb"
                    class="border border-gray-300 rounded px-2 py-1 focus:ring-primary focus:border-primary">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive px-4 pb-4">
            <table id="servicesTable" class="table table-striped table-bordered w-full text-sm md:text-base">
                <thead class="bg-gray-200 border border-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs uppercase">Sr No.</th>
                        <th class="px-6 py-3 text-left text-xs uppercase">Slug</th>
                        <th class="px-6 py-3 text-left text-xs uppercase">Heading</th>
                        <th class="px-6 py-3 text-left text-xs uppercase">Breadcrumb Title</th>
                        <th class="px-6 py-3 text-right text-xs uppercase">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($sections as $index => $item): ?>
                        <tr>
                            <td class="px-6 py-4"><?= $index + 1 ?></td>
                            <td class="px-6 py-4"><?= esc($item->slug) ?></td>
                            <td class="px-6 py-4"><?= esc($item->heading) ?></td>
                            <td class="px-6 py-4"><?= esc($item->breadcrumb_title) ?></td>
                            <td class="px-6 py-4 text-left">
                                <a href="<?= base_url('admin/breadcrumb-sections/edit/' . $item->id) ?>"
                                   class="px-3 py-1 rounded-lg text-white bg-blue-500 hover:bg-blue-800">
                                   <i class="fas fa-edit"></i>
                                </a>

                                <span class="px-2 text-secondary font-bold">|</span>

                                <a href="<?= base_url('admin/breadcrumb-sections/delete/' . $item->id) ?>"
                                   class="px-3 py-1 rounded-lg text-white bg-red-500 hover:bg-red-800">
                                   <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

            <div id="breadcrumbPageInfo" class="text-sm text-gray-600 mt-2"></div>
        </div>
    </div>
</main>