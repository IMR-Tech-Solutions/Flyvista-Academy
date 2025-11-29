<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Edit Job</h2>
            <p class="text-gray-500">Update job posting details</p>
        </div>

        <a href="<?= base_url('admin/jobs') ?>"
           class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Jobs
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/jobs/update/' . $job['id']) ?>">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">Job Details</h5>

                    <!-- Job Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
                        <input type="text" name="title" value="<?= esc($job['title']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                               placeholder="Enter job title..." required>
                    </div>

                    <!-- Location -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input type="text" name="location" value="<?= esc($job['location']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                               placeholder="e.g. Mumbai, India" required>
                    </div>

                    <!-- Job Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Job Type</label>
                        <input type="text" name="job_type" value="<?= esc($job['job_type']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                               placeholder="Full-Time / Part-Time" required>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <input type="text" name="category" value="<?= esc($job['category']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                               placeholder="Job category..." required>
                    </div>

                    <!-- Short Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
                        <textarea name="short_description" rows="3"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                                  required><?= esc($job['short_description']) ?></textarea>
                    </div>

                    <!-- Tags -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                        <input type="text" name="tags" value="<?= esc($job['tags']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                               placeholder="aviation, pilot, instructor">
                    </div>

                    <!-- Job Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Job Description</label>
                        <textarea name="job_description" rows="5"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                        ><?= esc($job['job_description']) ?></textarea>
                    </div>

                    <!-- Responsibilities -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Responsibilities</label>
                        <textarea name="responsibilities" rows="5"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                        ><?= esc($job['responsibilities']) ?></textarea>
                    </div>

                    <!-- Requirements -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Requirements</label>
                        <textarea name="requirements" rows="5"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                        ><?= esc($job['requirements']) ?></textarea>
                    </div>

                    <!-- Posted At -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Posted Date</label>
                        <input type="date" name="posted_at"
                               value="<?= esc($job['posted_at']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                               required>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center mt-6">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="status" value="1"
                                   class="w-5 h-5 text-primary"
                                   <?= ($job['status'] == 1) ? 'checked' : '' ?>>
                            <span class="text-gray-700">Active</span>
                        </label>
                    </div>

                </div>

                <!-- Submit -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/jobs') ?>"
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update Job
                    </button>
                </div>

            </form>

        </div>
    </div>
</main>