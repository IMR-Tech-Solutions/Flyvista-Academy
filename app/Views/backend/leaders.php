<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-secondary">Leaders Section</h2>

        <a href="<?= base_url('admin/leaders/add') ?>"
            class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Add Leader
        </a>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <p class="bg-green-200 p-2 mb-2 text-sm"><?= session()->getFlashdata('success') ?></p>
    <?php elseif (session()->getFlashdata('error')): ?>
        <p class="bg-red-200 p-2 mb-2 text-sm"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div
            class="bg-white rounded-lg shadow p-4 mb-4 flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">

            <!-- Search -->
            <div class="flex items-center max-w-xs w-full">
                <label for="search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="search" placeholder="Search Leader Name or Designation..."
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary block w-full" />
                </div>
            </div>

            <!-- Show entries -->
            <div class="flex items-center space-x-2">
                <label for="lengthMenu" class="font-medium text-gray-700">Show entries:</label>
                <select id="lengthMenu"
                    class="border border-gray-300 rounded px-2 py-1 focus:ring-primary focus:border-primary">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>

            <!-- Export Buttons -->
            <div class="flex items-center space-x-2">
                <button id="exportExcel" class="px-3 py-1 rounded-lg hover:bg-primary/20 bg-secondary/30 text-xl"
                    title="Download Excel">
                    <i class="fas fa-file-csv text-green-600"></i>
                </button>
                <button id="exportPdf" class="px-3 py-1 rounded-lg hover:bg-primary/20 bg-secondary/30 text-xl"
                    title="Download PDF">
                    <i class="fas fa-file-pdf text-red-600"></i>
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive px-4 pb-4">
            <table id="servicesTable" class="table table-striped table-bordered w-full text-sm md:text-base">
                <thead class="bg-gray-200 border border-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs uppercase">Sr No.</th>
                        <th class="px-6 py-3 text-left text-xs uppercase">Image</th>
                        <th class="px-6 py-3 text-left text-xs uppercase">Full Name</th>
                        <th class="px-6 py-3 text-left text-xs uppercase">Designation</th>
                        <th class="px-6 py-3 text-right text-xs uppercase">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($leaders)): ?>
                        <?php foreach ($leaders as $index => $item): ?>
                            <tr>
                                <td class="px-6 py-4"><?= $index + 1 ?></td>

                                <!-- Profile Image -->
                                <td class="px-6 py-4">
                                    <?php if (!empty($item->profile_image) && file_exists('assets/img/team/' . $item->profile_image)): ?>
                                        <img src="<?= base_url('assets/img/team/' . $item->profile_image) ?>"
                                            alt="<?= esc($item->full_name) ?>" class="w-12 h-12 rounded-full object-cover">
                                    <?php else: ?>
                                        <span class="text-gray-400">No Image</span>
                                    <?php endif; ?>
                                </td>

                                <td class="px-6 py-4"><?= esc($item->full_name) ?></td>
                                <td class="px-6 py-4"><?= esc($item->designation) ?></td>

                                <td class="px-6 py-4 text-left">
                                    <a href="<?= base_url('admin/leaders/edit/' . $item->leader_id) ?>"
                                        class="px-3 py-1 rounded-lg text-white bg-blue-500 hover:bg-blue-800">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <span class="px-2 text-secondary font-bold">|</span>

                                    <a href="<?= base_url('admin/leaders/delete/' . $item->leader_id) ?>"
                                        class="px-3 py-1 rounded-lg text-white bg-red-500 hover:bg-red-800">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No leaders found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div id="pageInfo" class="text-sm text-gray-600 mt-2"></div>
        </div>
    </div>
</main>