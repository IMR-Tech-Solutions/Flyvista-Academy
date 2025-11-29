<main class="p-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Edit Blog Details</h2>
            <p class="text-gray-500">Update the blog detailed information</p>
        </div>

        <a href="<?= base_url('admin/blog-details') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Blog details
        </a>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/blog-details/update/' . $detail['id']) ?>">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Blog Post Dropdown -->
                    <h5 class="text-lg font-semibold md:col-span-2 text-secondary-dark">
                        Blog Information
                    </h5>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Blog Post</label>
                        <select name="blog_post_id"
                            class="w-full px-4 py-2 border rounded-lg" required>
                            <option value="">-- Select Blog --</option>

                            <?php foreach ($blogs as $b): ?>
                                <option value="<?= $b->id ?>"
                                    <?= $b->id == $detail['blog_post_id'] ? 'selected' : '' ?>>
                                    <?= esc($b->title) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Description -->
                    <h5 class="text-lg font-semibold md:col-span-2 mt-4 text-secondary-dark">
                        Blog Description
                    </h5>

                    <div class="md:col-span-2">
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-2 border rounded-lg"
                            required><?= esc($detail['description']) ?></textarea>
                    </div>

                    <!-- Aviation Facts -->
                    <h5 class="text-lg font-semibold md:col-span-2 mt-4 text-secondary-dark">
                        Aviation Facts (JSON)
                    </h5>

                    <div class="md:col-span-2">
                        <div id="aviationWrapper" class="space-y-3"></div>

                        <button type="button" onclick="addAviation()"
                            class="px-4 py-2 bg-primary text-white rounded-lg mt-2">
                            <i class="fas fa-plus mr-1"></i> Add Fact
                        </button>
                    </div>

                    <!-- Table of Contents -->
                    <h5 class="text-lg font-semibold md:col-span-2 mt-4 text-secondary-dark">
                        Table of Contents (JSON)
                    </h5>

                    <div class="md:col-span-2">
                        <div id="tocWrapper" class="space-y-3"></div>

                        <button type="button" onclick="addTOC()"
                            class="px-4 py-2 bg-primary text-white rounded-lg mt-2">
                            <i class="fas fa-plus mr-1"></i> Add Section
                        </button>
                    </div>

                    <!-- Upcoming Courses -->
                    <h5 class="text-lg font-semibold md:col-span-2 mt-4 text-secondary-dark">
                        Upcoming Courses (JSON)
                    </h5>

                    <div class="md:col-span-2">
                        <div id="upcomingWrapper" class="space-y-3"></div>

                        <button type="button" onclick="addUpcoming()"
                            class="px-4 py-2 bg-primary text-white rounded-lg mt-2">
                            <i class="fas fa-plus mr-1"></i> Add Upcoming Course
                        </button>
                    </div>

                    <!-- Simulator Specs -->
                    <h5 class="text-lg font-semibold md:col-span-2 mt-4 text-secondary-dark">
                        Simulator Specs (JSON)
                    </h5>

                    <div class="md:col-span-2">
                        <div id="specsWrapper" class="space-y-3"></div>

                        <button type="button" onclick="addSpec()"
                            class="px-4 py-2 bg-primary text-white rounded-lg mt-2">
                            <i class="fas fa-plus mr-1"></i> Add Spec
                        </button>
                    </div>

                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-primary text-white rounded-lg">
                        <i class="fas fa-save mr-2"></i> Update Blog Details
                    </button>
                </div>

            </form>

        </div>
    </div>

</main>


<!-- ============ JS FOR JSON ============ -->

<script>
    function safeJson(val) {
        if (typeof val === "object") return val;           // already array
        if (!val) return [];                               // null/empty
        try { return JSON.parse(val); } catch { return []; }
    }

    let aviation = safeJson(<?= json_encode($detail['aviation_fact']) ?>);
    let toc = safeJson(<?= json_encode($detail['table_of_contents']) ?>);
    let upcoming = safeJson(<?= json_encode($detail['upcoming_courses']) ?>);
    let specs = safeJson(<?= json_encode($detail['simulator_specs']) ?>);


    /* -----------------------------------
        AVIATION FACTS
    ----------------------------------- */
    function renderAviation() {
        const wrap = document.getElementById("aviationWrapper");
        wrap.innerHTML = "";

        aviation.forEach((a, i) => {
            wrap.insertAdjacentHTML("beforeend", `
                <div class="p-4 border bg-gray-50 rounded-lg relative">
                    <input type="text" name="aviation_fact[${i}][title]" value="${a.title}"
                        class="w-full px-3 py-2 border rounded-lg mb-2" placeholder="Fact title">

                    <input type="text" name="aviation_fact[${i}][description]" value="${a.description}"
                        class="w-full px-3 py-2 border rounded-lg" placeholder="Fact description">

                    <button type="button" onclick="aviation.splice(${i},1);renderAviation()" 
                        class="absolute top-2 right-2 text-red-600 text-xl">&times;</button>
                </div>
            `);
        });
    }
    function addAviation() {
        aviation.push({ title: "", description: "" });
        renderAviation();
    }


    /* -----------------------------------
        TABLE OF CONTENTS
    ----------------------------------- */
    function renderTOC() {
        const wrap = document.getElementById("tocWrapper");
        wrap.innerHTML = "";

        toc.forEach((t, i) => {
            wrap.insertAdjacentHTML("beforeend", `
                <div class="flex space-x-3">
                    <input type="text" name="table_of_contents[${i}]"
                        class="w-full px-3 py-2 border rounded-lg"
                        value="${t}" placeholder="Section title">

                    <button type="button" onclick="toc.splice(${i},1);renderTOC()"
                        class="text-red-600 text-xl">&times;</button>
                </div>
            `);
        });
    }
    function addTOC() {
        toc.push("");
        renderTOC();
    }


    /* -----------------------------------
        UPCOMING COURSES
    ----------------------------------- */
    function renderUpcoming() {
        const wrap = document.getElementById("upcomingWrapper");
        wrap.innerHTML = "";

        upcoming.forEach((u, i) => {
            wrap.insertAdjacentHTML("beforeend", `
                <div class="p-4 border bg-gray-50 rounded-lg relative">
                    <input type="text" name="upcoming_courses[${i}][title]" value="${u.title}"
                        class="w-full px-3 py-2 border rounded-lg mb-2" placeholder="Course Title">

                    <input type="text" name="upcoming_courses[${i}][date]" value="${u.date}"
                        class="w-full px-3 py-2 border rounded-lg" placeholder="Start date">

                    <button type="button" onclick="upcoming.splice(${i},1);renderUpcoming()"
                        class="absolute top-2 right-2 text-red-600 text-xl">&times;</button>
                </div>
            `);
        });
    }
    function addUpcoming() {
        upcoming.push({ title: "", date: "" });
        renderUpcoming();
    }


    /* -----------------------------------
        SIMULATOR SPECS
    ----------------------------------- */
    function renderSpecs() {
        const wrap = document.getElementById("specsWrapper");
        wrap.innerHTML = "";

        specs.forEach((s, i) => {
            wrap.insertAdjacentHTML("beforeend", `
                <div class="flex space-x-3">
                    <input type="text" name="simulator_specs[${i}]"
                        class="w-full px-3 py-2 border rounded-lg"
                        value="${s}" placeholder="Simulator name">

                    <button type="button" onclick="specs.splice(${i},1);renderSpecs()"
                        class="text-red-600 text-xl">&times;</button>
                </div>
            `);
        });
    }
    function addSpec() {
        specs.push("");
        renderSpecs();
    }


    // Initial Rendering
    renderAviation();
    renderTOC();
    renderUpcoming();
    renderSpecs();
</script>