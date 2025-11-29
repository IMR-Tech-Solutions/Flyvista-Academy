<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Add Blog Details</h2>
            <p class="text-gray-500">Fill out the form to add complete blog details</p>
        </div>

        <a href="<?= base_url('admin/blog-details') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Blog Details
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/blog-details/save') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Blog Selection -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">
                        Blog Basic Information
                    </h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Blog Post</label>
                        <select name="blog_post_id"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            required>
                            <option value="">-- Select Blog --</option>

                            <?php foreach ($blogs as $blog): ?>
                                <option value="<?= $blog->id ?>">
                                    <?= esc($blog->title) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Description -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2 mt-4">
                        Blog Description
                    </h5>

                    <div class="md:col-span-2">
                        <textarea name="description" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Write full blog description..." required></textarea>
                    </div>

                    <!-- Aviation Fact -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2 mt-4">
                        Aviation Facts (JSON)
                    </h5>

                    <div class="md:col-span-2">
                        <div id="aviationWrapper" class="space-y-3"></div>

                        <button type="button" onclick="addAviationFact()"
                            class="mt-2 px-4 py-2 bg-primary text-white rounded-lg">
                            <i class="fas fa-plus mr-1"></i> Add Fact
                        </button>
                    </div>

                    <!-- Table of Contents -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2 mt-4">
                        Table of Contents (JSON)
                    </h5>

                    <div class="md:col-span-2">
                        <div id="tocWrapper" class="space-y-3"></div>

                        <button type="button" onclick="addTOC()"
                            class="mt-2 px-4 py-2 bg-primary text-white rounded-lg">
                            <i class="fas fa-plus mr-1"></i> Add Section
                        </button>
                    </div>

                    <!-- Upcoming Courses -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2 mt-4">
                        Upcoming Courses (JSON)
                    </h5>

                    <div class="md:col-span-2">
                        <div id="upcomingWrapper" class="space-y-3"></div>

                        <button type="button" onclick="addUpcoming()"
                            class="mt-2 px-4 py-2 bg-primary text-white rounded-lg">
                            <i class="fas fa-plus mr-1"></i> Add Upcoming Course
                        </button>
                    </div>

                    <!-- Simulator Specs -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2 mt-4">
                        Simulator Specs (JSON)
                    </h5>

                    <div class="md:col-span-2">
                        <div id="specsWrapper" class="space-y-3"></div>

                        <button type="button" onclick="addSpec()"
                            class="mt-2 px-4 py-2 bg-primary text-white rounded-lg">
                            <i class="fas fa-plus mr-1"></i> Add Simulator Spec
                        </button>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/blog-details') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Save Blog Details
                    </button>
                </div>

            </form>
        </div>
    </div>
</main>

<script>
    let aviationIndex = 0;
    let tocIndex = 0;
    let upcomingIndex = 0;
    let specsIndex = 0;

    // ========== AVIATION FACT (TITLE + DESCRIPTION) ==========
    function addAviationFact() {
        document.getElementById("aviationWrapper").insertAdjacentHTML("beforeend", `
            <div class="p-4 border rounded-lg bg-gray-50 relative">
                <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-red-500">
                    <i class="fas fa-trash"></i>
                </button>

                <label class="block text-sm mb-1">Fact Title</label>
                <input type="text" name="aviation_fact[${aviationIndex}][title]" 
                    class="w-full px-3 py-2 border rounded-lg mb-2">

                <label class="block text-sm mb-1">Fact Description</label>
                <input type="text" name="aviation_fact[${aviationIndex}][description]" 
                    class="w-full px-3 py-2 border rounded-lg">
            </div>
        `);
        aviationIndex++;
    }

    // ========== TABLE OF CONTENTS ==========
    function addTOC() {
        document.getElementById("tocWrapper").insertAdjacentHTML("beforeend", `
            <div class="flex items-center space-x-3">
                <input type="text" name="table_of_contents[]" 
                    placeholder="Section Title" class="w-full px-3 py-2 border rounded-lg">
                <button type="button" onclick="this.parentElement.remove()" class="text-red-600 text-xl">&times;</button>
            </div>
        `);
    }

    // ========== UPCOMING COURSES (TITLE + DATE) ==========
    function addUpcoming() {
        document.getElementById("upcomingWrapper").insertAdjacentHTML("beforeend", `
            <div class="p-4 border rounded-lg bg-gray-50 relative">
                <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-red-500">
                    <i class="fas fa-trash"></i>
                </button>

                <label class="block text-sm mb-1">Course Title</label>
                <input type="text" name="upcoming_courses[${upcomingIndex}][title]"
                    class="w-full px-3 py-2 border rounded-lg mb-2">

                <label class="block text-sm mb-1">Start Date</label>
                <input type="text" name="upcoming_courses[${upcomingIndex}][date]"
                    class="w-full px-3 py-2 border rounded-lg">
            </div>
        `);
        upcomingIndex++;
    }

    // ========== SIMULATOR SPECS ==========
    function addSpec() {
        document.getElementById("specsWrapper").insertAdjacentHTML("beforeend", `
            <div class="flex items-center space-x-3">
                <input type="text" name="simulator_specs[]" 
                    placeholder="Simulator Name & Status" class="w-full px-3 py-2 border rounded-lg">
                <button type="button" onclick="this.parentElement.remove()" 
                    class="text-red-600 text-xl">&times;</button>
            </div>
        `);
    }
</script>