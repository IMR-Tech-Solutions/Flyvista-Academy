<main class="p-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Edit Course Details</h2>
            <p class="text-gray-500">Update the course information</p>
        </div>

        <a href="<?= base_url('admin/course-details') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Course details
        </a>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6">

            <form method="post"
                action="<?= base_url('admin/course-details/update/' . $detail['id']) ?>"
                enctype="multipart/form-data">

                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Course -->
                    <h5 class="text-lg font-semibold md:col-span-2 text-secondary-dark">Course Information</h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Course Name</label>
                        <select name="course_id"
                            class="w-full px-4 py-2 border rounded-lg" required>
                            <option value="">-- Select Course --</option>

                            <?php foreach ($courses as $c): ?>
                                <option value="<?= $c->id ?>"
                                    <?= $c->id == $detail['course_id'] ? 'selected' : '' ?>>
                                    <?= esc($c->title) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- About -->
                    <h5 class="text-lg font-semibold md:col-span-2 mt-4 text-secondary-dark">About Section</h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium">About Title</label>
                        <input type="text" name="about_title"
                            value="<?= esc($detail['about_title']) ?>"
                            class="w-full px-4 py-2 border rounded-lg" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium">About Description</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-2 border rounded-lg"
                            required><?= esc($detail['about_description']) ?></textarea>
                    </div>

                    <!-- SKILLS -->
                    <h5 class="text-lg font-semibold md:col-span-2 mt-4 text-secondary-dark">Skills You Will Learn</h5>

                    <div class="md:col-span-2">
                        <div id="skillsWrapper" class="space-y-3"></div>

                        <button type="button" onclick="addSkill()"
                            class="px-4 py-2 bg-primary text-white rounded-lg mt-2">
                            <i class="fas fa-plus mr-1"></i> Add Skill
                        </button>
                    </div>

                    <!-- TRAINING -->
                    <h5 class="text-lg font-semibold md:col-span-2 mt-4 text-secondary-dark">Training Methods</h5>

                    <div class="md:col-span-2">
                        <div id="trainingWrapper" class="space-y-3"></div>

                        <button type="button" onclick="addTraining()"
                            class="px-4 py-2 bg-primary text-white rounded-lg mt-2">
                            <i class="fas fa-plus mr-1"></i> Add Training
                        </button>
                    </div>

                    <h5 class="text-lg font-semibold md:col-span-2 mt-4 text-secondary-dark">
                        Program Details
                    </h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Program Details</label>

                        <textarea name="program_details" rows="4"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter program details..."><?= esc($detail['program_details']) ?></textarea>
                    </div>

                    <!-- Eligibility -->
                    <h5 class="text-lg font-semibold md:col-span-2 mt-4 text-secondary-dark">Eligibility</h5>

                    <div class="md:col-span-2">
                        <div id="eligibilityWrapper" class="space-y-3"></div>

                        <button type="button" onclick="addEligibility()"
                            class="px-4 py-2 bg-primary text-white rounded-lg mt-2">
                            <i class="fas fa-plus mr-1"></i> Add Eligibility
                        </button>
                    </div>

                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-primary text-white rounded-lg">
                        <i class="fas fa-save mr-2"></i> Update Course Details
                    </button>
                </div>

            </form>

        </div>
    </div>

</main>

<script>
    let skills = <?= json_encode(is_string($detail['skills']) ? json_decode($detail['skills'], true) : $detail['skills']) ?>;
    let training = <?= json_encode(is_string($detail['training_methods']) ? json_decode($detail['training_methods'], true) : $detail['training_methods']) ?>;
    let eligibility = <?= json_encode(is_string($detail['eligibility']) ? json_decode($detail['eligibility'], true) : $detail['eligibility']) ?>;
    let program = <?= json_encode(is_string($detail['program_details']) ? json_decode($detail['program_details'], true) : $detail['program_details']) ?>;

    function renderSkills() {
        const wrap = document.getElementById("skillsWrapper");
        wrap.innerHTML = "";
        skills.forEach((s, i) => {
            wrap.insertAdjacentHTML("beforeend", `
                <div class="flex space-x-3 p-4 border rounded-lg bg-gray-50 relative">
                    <input type="text" name="skills[${i}][icon]" placeholder="Icon" value="${s.icon}"
                           class="w-1/4 px-2 py-2 border rounded">
                    <input type="text" name="skills[${i}][title]" placeholder="Title" value="${s.title}"
                           class="w-1/4 px-2 py-2 border rounded">
                    <input type="text" name="skills[${i}][description]" placeholder="Description" value="${s.description}"
                           class="w-1/2 px-2 py-2 border rounded">
                    <button type="button" onclick="skills.splice(${i},1);renderSkills()" 
                            class="text-red-600 text-xl">&times;</button>
                </div>
            `);
        });
    }

    function addSkill() {
        skills.push({
            icon: "",
            title: "",
            description: ""
        });
        renderSkills();
    }

    // TRAINING JSON
    function renderTraining() {
        const wrap = document.getElementById("trainingWrapper");
        wrap.innerHTML = "";
        training.forEach((s, i) => {
            wrap.insertAdjacentHTML("beforeend", `
            <div class="flex space-x-3 p-4 border rounded-lg bg-gray-50 relative">
                <input type="text" name="training_methods[${i}][icon]" placeholder="Icon" value="${s.icon}"
                        class="w-1/4 px-2 py-2 border rounded">
                <input type="text" name="training_methods[${i}][title]" placeholder="Title" value="${s.title}"
                        class="w-1/4 px-2 py-2 border rounded">
                <input type="text" name="training_methods[${i}][description]" placeholder="Description" value="${s.description}"
                        class="w-1/2 px-2 py-2 border rounded">
                <button type="button" onclick="training.splice(${i},1);renderTraining()" 
                        class="text-red-600 text-xl">&times;</button>
            </div>
        `);
        });
    }

    function addTraining() {
        training.push({
            icon: "",
            title: "",
            description: ""
        });
        renderTraining();
    }

    // ELIGIBILITY JSON
    function renderEligibility() {
        const wrap = document.getElementById("eligibilityWrapper");
        wrap.innerHTML = "";
        eligibility.forEach((e, i) => {
            wrap.insertAdjacentHTML("beforeend", `
                <div class="flex space-x-3">
                    <input type="text" name="eligibility[${i}]" value="${e}" 
                           class="w-full px-2 py-2 border rounded">
                    <button type="button" onclick="eligibility.splice(${i},1);renderEligibility()"
                            class="text-red-600 text-xl">&times;</button>
                </div>
            `);
        });
    }

    function addEligibility() {
        eligibility.push("");
        renderEligibility();
    }

    function renderProgram() {
        const wrap = document.getElementById("programWrapper");
        wrap.innerHTML = "";
        program.forEach((p, i) => {
            wrap.insertAdjacentHTML("beforeend", `
            <div class="flex space-x-3 p-4 border rounded-lg bg-gray-50 relative">
                <input type="text" name="program_details[${i}][title]" placeholder="Title" value="${p.title}"
                       class="w-1/4 px-2 py-2 border rounded">
                <input type="text" name="program_details[${i}][description]" placeholder="Description" value="${p.description}"
                       class="w-3/4 px-2 py-2 border rounded">
                <button type="button" onclick="program.splice(${i},1);renderProgram()" 
                        class="text-red-600 text-xl">&times;</button>
            </div>
        `);
        });
    }

    function addProgram() {
        program.push({
            title: "",
            description: ""
        });
        renderProgram();
    }

    renderProgram();

    // Load existing data
    renderSkills();
    renderTraining();
    renderEligibility();
</script>