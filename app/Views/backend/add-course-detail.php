<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Add Course Details</h2>
            <p class="text-gray-500">Fill out the form to add complete course details</p>
        </div>

        <a href="<?= base_url('admin/course-details') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Course Details
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <form method="post" action="<?= base_url('admin/course-details/save') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Course Name Dropdown -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">
                        Course Basic Information
                    </h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Course Name</label>
                        <select name="course_id"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary" required>
                            <option value="">-- Select Course --</option>

                            <?php foreach ($courses as $course): ?>
                                <option value="<?= $course->id ?>">
                                    <?= esc($course->title) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- About Section -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2 mt-4">
                        About Section
                    </h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">About Title</label>
                        <input type="text" name="about_title"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. About This Course" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">About Description</label>
                        <textarea name="description" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Write about the course..." required></textarea>
                    </div>

                    <!-- Skills Section -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2 mt-4">
                        Skills You Will Learn (JSON)
                    </h5>

                    <div class="md:col-span-2">
                        <div id="skillsWrapper" class="space-y-3"></div>

                        <button type="button" onclick="addSkill()"
                            class="mt-2 px-4 py-2 bg-primary text-white rounded-lg">
                            <i class="fas fa-plus mr-1"></i> Add Skill
                        </button>
                    </div>

                    <!-- Training Methods Section -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2 mt-4">
                        Training Methods (JSON)
                    </h5>

                    <div class="md:col-span-2">
                        <div id="trainingWrapper" class="space-y-3"></div>

                        <button type="button" onclick="addTraining()"
                            class="mt-2 px-4 py-2 bg-primary text-white rounded-lg">
                            <i class="fas fa-plus mr-1"></i> Add Training Method
                        </button>
                    </div>

                    <!-- Program Details -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2 mt-4">
                        Program Details (JSON or Text)
                    </h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Program Details</label>
                        <textarea name="program_details" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter program details..."></textarea>
                    </div>

                    <!-- Eligibility -->
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2 mt-4">
                        Eligibility Criteria (JSON)
                    </h5>

                    <div class="md:col-span-2">
                        <div id="eligibilityWrapper" class="space-y-3"></div>

                        <button type="button" onclick="addEligibility()"
                            class="mt-2 px-4 py-2 bg-primary text-white rounded-lg">
                            <i class="fas fa-plus mr-1"></i> Add Eligibility
                        </button>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/course-details') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Save Course Details
                    </button>
                </div>

            </form>
        </div>
    </div>
</main>

<script>

    let skillIndex = 0;
    let trainingIndex = 0;

    // ========== SKILLS JSON (ICON + TITLE + DESC) ==========
    function addSkill() {
        document.getElementById("skillsWrapper").insertAdjacentHTML("beforeend", `
            <div class="p-4 border rounded-lg bg-gray-50 relative">
                <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-red-500">
                    <i class="fas fa-trash"></i>
                </button>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm mb-1">Icon</label>
                        <input type="text" name="skills[${skillIndex}][icon]" placeholder="fas fa-user"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Title</label>
                        <input type="text" name="skills[${skillIndex}][title]" placeholder="Skill title"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Short Description</label>
                        <input type="text" name="skills[${skillIndex}][description]" placeholder="Short description"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>
                </div>
            </div>
        `);
        skillIndex++;
    }

    // ========== TRAINING METHODS JSON (ICON + TITLE + DESC) ==========
    function addTraining() {
        document.getElementById("trainingWrapper").insertAdjacentHTML("beforeend", `
            <div class="p-4 border rounded-lg bg-gray-50 relative">
                <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-red-500">
                    <i class="fas fa-trash"></i>
                </button>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm mb-1">Icon</label>
                        <input type="text" name="training_methods[${trainingIndex}][icon]" placeholder="fas fa-book"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Title</label>
                        <input type="text" name="training_methods[${trainingIndex}][title]" placeholder="Training title"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Short Description</label>
                        <input type="text" name="training_methods[${trainingIndex}][description]" placeholder="Short description"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>
                </div>
            </div>
        `);
        trainingIndex++;
    }

    // ========== ELIGIBILITY SIMPLE TEXT ==========
    function addEligibility() {
        document.getElementById("eligibilityWrapper").insertAdjacentHTML("beforeend", `
            <div class="flex items-center space-x-3">
                <input type="text" name="eligibility[]" placeholder="Eligibility criteria"
                    class="w-full px-4 py-2 border rounded-lg">
                <button type="button" onclick="this.parentElement.remove()" 
                    class="text-red-600 text-xl">&times;</button>
            </div>
        `);
    }
</script>