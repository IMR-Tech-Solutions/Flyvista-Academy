<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-secondary-dark">User Management</h2>
        <a href="<?= base_url('admin/user/add') ?>"
            class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-user-plus mr-2"></i> Create New User
        </a>
    </div>

    <!-- Flash messages -->
    <?php if (session()->getFlashdata('success')): ?>
    <p class="bg-green-200 p-2 mb-2 text-sm"><?= session()->getFlashdata('success') ?></p>
    <?php elseif (session()->getFlashdata('error')): ?>
    <p class="bg-red-200 p-2 mb-2 text-sm"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <!-- Users Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Controls: Search + Entries + Export -->
        <div
            class="bg-white rounded-lg shadow p-4 mb-4 flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <!-- Search -->
            <div class="flex items-center max-w-xs w-full">
                <label for="search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="search" placeholder="Search User..."
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

            <!-- Export buttons -->
            <div class="flex items-center space-x-2">
                <button id="exportExcel"
                    class="px-3 py-1 rounded-lg hover:bg-primary/20 bg-secondary/30 text-xl"
                    title="Download Excel">
                    <i class="fas fa-file-csv text-green-600"></i>
                </button>
                <button id="exportPdf"
                    class="px-3 py-1 rounded-lg hover:bg-primary/20 bg-secondary/30 text-xl"
                    title="Download PDF">
                    <i class="fas fa-file-pdf text-red-600"></i>
                </button>
            </div>
        </div>

        <div class="table-responsive px-4 pb-4">
            <table id="servicesTable" class="table table-striped table-bordered w-full text-sm md:text-base">
                <thead class="bg-gray-200 text-white-500 border border-gray-900">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs uppercase">User</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs uppercase">Contact No.</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div
                                    class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                    <span><img src="<?= base_url('assets/img/users/' . $user->profile_photo) ?>"
                                            alt="profile-img" class="rounded-full"></span>
                                </div>
                                <div class="ml-4">
                                    <div class="font-medium"><?= esc($user->first_name) ?> <?= esc($user->last_name) ?></div>
                                    <div class="text-gray-500 text-sm"><?= esc($user->email) ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4"><?= esc($user->phone) ?></td>
                        <td class="px-6 py-4 text-left">
                            <a href="<?= base_url('admin/user/edit/' . $user->id) ?>"
                                class="px-3 py-1 rounded-lg text-light bg-blue-500 hover:bg-blue-800"><i
                                    class="fas fa-edit"></i></a>
                            <span class="px-2 text-secondary font-bold">|</span>
                            <a href="<?= base_url('admin/user/change-password/' . $user->id) ?>"
                                class="px-3 py-1 rounded-lg text-light bg-yellow-500 hover:bg-yellow-800"><i
                                    class="fas fa-key"></i></a>
                            <span class="px-2 text-secondary font-bold">|</span>
                            <a href="<?= base_url('admin/delete-user/' . $user->id) ?>"
                                class="px-3 py-1 rounded-lg text-light bg-red-500 hover:bg-red-800"><i
                                    class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div id="pageInfo" class="text-sm text-gray-600 mt-2"></div>
        </div>
    </div>
</main>