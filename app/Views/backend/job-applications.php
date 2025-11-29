<main class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-secondary-dark">Job Applications</h2>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <p class="bg-green-200 p-2 mb-2 text-sm"><?= session()->getFlashdata('success') ?></p>
    <?php elseif (session()->getFlashdata('error')): ?>
        <p class="bg-red-200 p-2 mb-2 text-sm"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <!-- Job Applications Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">

        <!-- Controls: Search, length menu, export -->
        <div class="bg-white rounded-lg shadow p-4 mb-4 flex flex-col md:flex-row md:items-center md:justify-between 
                    space-y-4 md:space-y-0">

            <!-- Search -->
            <div class="flex items-center max-w-xs w-full">
                <label for="search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="search" placeholder="Search Applicant Name..."
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg 
                               focus:ring-primary focus:border-primary block w-full">
                </div>
            </div>

            <!-- Show entries -->
            <div class="flex items-center space-x-2">
                <label for="lengthMenu" class="font-medium text-gray-700">Show entries:</label>
                <select id="lengthMenu" class="border border-gray-300 rounded px-2 py-1 
                        focus:ring-primary focus:border-primary">
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
                        <th class="px-6 py-3 text-left text-xs uppercase">Job ID</th>
                        <th class="px-6 py-3 text-left text-xs uppercase">Applicant Name</th>
                        <th class="px-6 py-3 text-left text-xs uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs uppercase">Phone</th>
                        <th class="px-6 py-3 text-left text-xs uppercase">Position</th>
                        <th class="px-6 py-3 text-left text-xs uppercase">Resume</th>
                        <th class="px-6 py-3 text-left text-xs uppercase">Cover Letter</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($job_applications)): ?>
                        <?php foreach ($job_applications as $index => $app): ?>
                            <tr>
                                <td class="px-6 py-4"><?= $index + 1 ?></td>
                                <td class="px-6 py-4"><?= esc($app->job_id) ?></td>
                                <td class="px-6 py-4"><?= esc($app->applicant_name) ?></td>
                                <td class="px-6 py-4"><?= esc($app->applicant_email) ?></td>
                                <td class="px-6 py-4"><?= esc($app->applicant_phone) ?></td>
                                <td class="px-6 py-4"><?= esc($app->{'applicant-position'}) ?></td>

                                <td class="px-6 py-4">
                                    <a href="<?= base_url('assets/resumes/' . $app->resume_path) ?>" target="_blank"
                                       class="text-primary underline">
                                        View Resume
                                    </a>
                                </td>

                                <td class="px-6 py-4">
                                    <button onclick="alert(`<?= esc($app->cover_letter) ?>`)"
                                            class="text-blue-700 underline">
                                        View Letter
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500">
                                No job applications found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>

            <div id="pageInfo" class="text-sm text-gray-600 mt-2"></div>
        </div>
    </div>

</main>