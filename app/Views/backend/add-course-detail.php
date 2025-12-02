<!-- MAIN CONTENT -->
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

                    <!-- BASIC INFO -->
                    <h5 class="text-lg font-semibold md:col-span-2 text-secondary-dark">
                        Course Information
                    </h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Course Name</label>
                        <select name="course_id" class="w-full border px-4 py-2 rounded-lg" required>
                            <option value="">-- Select Course --</option>
                            <?php foreach ($courses as $c): ?>
                                <option value="<?= $c->id ?>"><?= esc($c->title) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- ABOUT -->
                    <h5 class="text-lg font-semibold md:col-span-2 text-secondary-dark mt-6">About Section</h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm">About Title</label>
                        <input type="text" name="about_title"
                               class="w-full border px-4 py-2 rounded-lg" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm">About Description</label>
                        <textarea name="description" rows="4"
                                  class="w-full border px-4 py-2 rounded-lg" required></textarea>
                    </div>


                    <!-- SKILLS -->
                    <h5 class="text-lg font-semibold md:col-span-2 text-secondary-dark mt-6">
                        Skills You Will Learn
                    </h5>

                    <div class="md:col-span-2">
                        <div id="skillsWrapper" class="space-y-3"></div>

                        <button type="button" onclick="addSkill()"
                                class="bg-primary text-white px-4 py-2 rounded-lg mt-2">
                            <i class="fas fa-plus mr-1"></i> Add Skill
                        </button>
                    </div>


                    <!-- TRAINING -->
                    <h5 class="text-lg font-semibold md:col-span-2 text-secondary-dark mt-6">
                        Training Methods
                    </h5>

                    <div class="md:col-span-2">
                        <div id="trainingWrapper" class="space-y-3"></div>

                        <button type="button" onclick="addTraining()"
                                class="bg-primary text-white px-4 py-2 rounded-lg mt-2">
                            <i class="fas fa-plus mr-1"></i> Add Training Method
                        </button>
                    </div>



                    <!-- PROGRAM DETAILS -->
                    <h5 class="text-lg font-semibold md:col-span-2 text-secondary-dark mt-6">
                        Program Details (JSON Format)
                    </h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm">Program Details</label>
                        <textarea name="program_details" rows="6"
                                  class="w-full border px-4 py-2 rounded-lg"
                                  placeholder='{"duration":"6 months","modules":[...]}'></textarea>
                    </div>


                    <!-- ELIGIBILITY -->
                    <h5 class="text-lg font-semibold md:col-span-2 text-secondary-dark mt-6">
                        Eligibility
                    </h5>

                    <div class="md:col-span-2">
                        <div id="eligibilityWrapper" class="space-y-3"></div>

                        <button type="button" onclick="addEligibility()"
                                class="bg-primary text-white px-4 py-2 rounded-lg mt-2">
                            <i class="fas fa-plus mr-1"></i> Add Eligibility
                        </button>
                    </div>

                </div>

                <!-- SUBMIT -->
                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg">
                        <i class="fas fa-save mr-2"></i> Save Course Details
                    </button>
                </div>

            </form>
        </div>
    </div>
</main>


<!-- ==========================================
     JAVASCRIPT — SAME STRUCTURE AS EDIT PAGE
=========================================== -->
<script>

    let skills = [];
    let training = [];
    let eligibility = [];

    /* ===============================
       ADD SKILL (icon, title, items)
    =============================== */
    function addSkill() {
        let index = skills.length;
        skills.push({ icon: "", title: "", items: [] });

        document.getElementById("skillsWrapper").insertAdjacentHTML("beforeend", `
            <div class="p-4 border rounded-lg bg-gray-50 space-y-3">
                <input type="text" name="skills[${index}][icon]" placeholder="Icon"
                       class="w-full border px-2 py-2 rounded">

                <input type="text" name="skills[${index}][title]" placeholder="Title"
                       class="w-full border px-2 py-2 rounded">

                <label class="block text-sm">Items (one per line)</label>
                <textarea name="skills[${index}][items][]" rows="4"
                          class="w-full border px-2 py-2 rounded"></textarea>

                <button type="button"
                        onclick="this.parentElement.remove(); skills.splice(${index},1)"
                        class="text-red-600 text-xl">&times;</button>
            </div>
        `);
    }


    /* ===============================
       TRAINING METHODS
    =============================== */
    function addTraining() {
        let index = training.length;
        training.push({ icon: "", title: "", items: [] });

        document.getElementById("trainingWrapper").insertAdjacentHTML("beforeend", `
            <div class="p-4 border rounded-lg bg-gray-50 space-y-3">
                <input type="text" name="training_methods[${index}][icon]" placeholder="Icon"
                       class="w-full border px-2 py-2 rounded">

                <input type="text" name="training_methods[${index}][title]" placeholder="Title"
                       class="w-full border px-2 py-2 rounded">

                <label class="block text-sm">Items (one per line)</label>
                <textarea name="training_methods[${index}][items][]" rows="4"
                          class="w-full border px-2 py-2 rounded"></textarea>

                <button type="button"
                        onclick="this.parentElement.remove(); training.splice(${index},1)"
                        class="text-red-600 text-xl">&times;</button>
            </div>
        `);
    }


    /* ===============================
       ELIGIBILITY (simple string list)
    =============================== */
    function addEligibility() {
        let index = eligibility.length;
        eligibility.push("");

        document.getElementById("eligibilityWrapper").insertAdjacentHTML("beforeend", `
            <div class="flex space-x-3">
                <input type="text" name="eligibility[${index}]"
                       class="w-full border px-2 py-2 rounded"
                       placeholder="Eligibility criteria">

                <button type="button"
                        onclick="this.parentElement.remove(); eligibility.splice(${index},1)"
                        class="text-red-600 text-xl">&times;</button>
            </div>
        `);
    }

</script>