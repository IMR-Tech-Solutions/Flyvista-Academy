<?= $this->extend('frontend/layout/main') ?>

<?= $this->section('content') ?>

<style>
    .filter-btn.active {
        background-color: #253D6B !important;
        color: #fff !important;
    }
</style>
<!-- Breadcrumb Hero Section -->
<section
    class="relative w-full h-48 md:h-[22rem] bg-cover bg-center flex items-center fade-in-section"
    style="background-image: url('<?= isset($breadcrumb->bg_image) ? base_url($breadcrumb->bg_image) : base_url('assets/img/default-bg.jpg') ?>');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Content -->
    <div class="relative z-10 w-full px-6 md:px-12 flex justify-between items-center">

        <!-- Left: Page Title -->
        <h1 class="text-white text-3xl md:text-4xl font-semibold animate-fade-in-down">
            <?= isset($breadcrumb->heading) ? esc($breadcrumb->heading) : 'Careers at FlyVista' ?>
        </h1>

        <!-- Right: Breadcrumb -->
        <nav class="text-white flex items-center space-x-2 animate-slide-in-right">
            <a href="<?= base_url('/') ?>" class="hover:text-secondary transition-colors">Home</a>
            <span class="text-white">➤</span>
            <span class="text-white font-bold relative pb-1">
                <?= isset($breadcrumb->heading) ? esc($breadcrumb->heading) : 'careers' ?>
                <span class="absolute left-0 bottom-0 w-full border-b-2 border border-secondary-light opacity-70"></span>
            </span>
        </nav>
    </div>
</section>

<!-- Why Join FlyVista Section -->
<section id="why-flyvista" class="py-16 bg-gray-50 fade-in-section">
    <div class="container mx-auto px-4">

        <!-- Heading & Short Description -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-primary mb-4">
                <?= esc($careerFeatures[0]->heading ?? 'Why Build Your Career at FlyVista?') ?>
                <div class="w-full flex items-center justify-center mt-2 gap-3">

                    <!-- Left Gradient Line -->
                    <div class="w-16 h-[2px] bg-gradient-to-r from-transparent to-primary"></div>

                    <!-- Left Dot -->
                    <span class="h-1 w-1 bg-primary rounded-full"></span>

                    <!-- Center Circle -->
                    <span class="h-3 w-3 border-2 border-primary rounded-full flex items-center justify-center">
                        <span class="h-1 w-1 bg-primary rounded-full"></span>
                    </span>

                    <!-- Right Dot -->
                    <span class="h-1 w-1 bg-primary rounded-full"></span>

                    <!-- Right Gradient Line -->
                    <div class="w-16 h-[2px] bg-gradient-to-l from-transparent to-primary"></div>

                </div>
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                <?= esc($careerFeatures[0]->short_desc ?? 'We offer opportunities for growth, development, and making a real impact in aviation education.') ?>
            </p>
        </div>

        <!-- Dynamic Feature Boxes -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <?php foreach ($careerFeatures as $feature): ?>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 text-center shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-16 h-16 rounded-full bg-primary-light/10 flex items-center justify-center mx-auto mb-4">
                        <i class="<?= esc($feature->icon) ?> text-primary-light text-2xl"></i>
                    </div>

                    <h3 class="text-xl font-bold text-heading-light dark:text-heading-dark mb-2">
                        <?= esc($feature->title) ?>
                    </h3>

                    <p class="text-gray-600 dark:text-gray-400">
                        <?= strip_tags($feature->description) ?>
                    </p>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<!-- Open Positions Section -->
<section id="open-positions" class="py-12 md:py-16 fade-in-section">
    <div class="container mx-auto px-4">

        <!-- Section Heading -->
        <div class="text-center mb-10 md:mb-12">
            <h2 class="text-2xl md:text-3xl font-bold text-primary mb-4">
                Current Open Positions
                <div class="w-full flex items-center justify-center mt-2 gap-2 md:gap-3">

                    <div class="w-10 md:w-16 h-[2px] bg-gradient-to-r from-transparent to-primary"></div>
                    <span class="h-1 w-1 bg-primary rounded-full"></span>

                    <span class="h-3 w-3 border-2 border-primary rounded-full flex items-center justify-center">
                        <span class="h-1 w-1 bg-primary rounded-full"></span>
                    </span>

                    <span class="h-1 w-1 bg-primary rounded-full"></span>
                    <div class="w-10 md:w-16 h-[2px] bg-gradient-to-l from-transparent to-primary"></div>
                </div>
            </h2>

            <p class="text-base md:text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Explore our available roles and find the perfect fit for your skills and career aspirations.
            </p>
        </div>

        <!-- Job Filters -->
        <div class="flex flex-wrap gap-3 md:gap-4 mb-8 justify-center">

            <!-- All Button -->
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 
                hover:bg-gray-700 hover:text-white transition-colors font-medium 
                filter-btn active text-sm md:text-base"
                data-filter="all">
                All Positions
            </button>

            <!-- Dynamic Category Buttons -->
            <?php foreach ($categories as $cat): ?>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 
                    hover:bg-gray-700 hover:text-white transition-colors font-medium filter-btn 
                    text-sm md:text-base"
                    data-filter="<?= strtolower(esc($cat)) ?>">
                    <?= ucwords(str_replace('_', ' ', esc($cat))) ?>
                </button>
            <?php endforeach; ?>

        </div>

        <!-- Job Listings -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 job-listings">

            <?php foreach ($jobs as $job): ?>
                <?php $tags = array_map('trim', explode(',', $job->tags)); ?>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-5 md:p-6 shadow-sm 
                    job-card border border-gray-200 dark:border-gray-700 job-item 
                    <?= strtolower(esc($job->category)) ?>"
                    data-category="<?= strtolower(esc($job->category)) ?>">

                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start mb-4 gap-4 sm:gap-0">
                        <div>
                            <h3 class="text-lg md:text-xl font-bold text-heading-light dark:text-heading-dark">
                                <?= esc($job->title) ?>
                            </h3>

                            <div class="flex flex-wrap items-center mt-2 gap-3 text-sm">
                                <span class="flex items-center text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    <?= esc($job->location) ?>
                                </span>

                                <span class="flex items-center text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-clock mr-1"></i>
                                    <?= esc($job->job_type) ?>
                                </span>
                            </div>
                        </div>

                        <span class="px-3 py-1 bg-primary-light text-white text-xs font-medium rounded-full self-start sm:self-auto">
                            <?= ucwords(str_replace('_', ' ', esc($job->category))) ?>
                        </span>
                    </div>

                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base mb-4">
                        <?= esc($job->short_description) ?>
                    </p>

                    <div class="flex flex-wrap gap-2 mb-6">
                        <?php foreach ($tags as $tag): ?>
                            <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 
                                text-gray-700 dark:text-gray-300 text-xs rounded">
                                <?= esc($tag) ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 sm:gap-0">
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            Posted <?= time_elapsed_string($job->posted_at) ?>
                        </span>

                        <button class="view-job-details px-4 py-2 bg-primary-light text-white 
                            rounded-lg hover:bg-primary-dark transition-colors text-sm font-medium"
                            data-job='<?= json_encode($job, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>'>
                            View Details
                        </button>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>

        <!-- No Jobs Message -->
        <div id="no-jobs-message" class="text-center py-12 hidden">
            <i class="fas fa-search text-4xl text-gray-400 mb-4"></i>
            <h3 class="text-xl font-bold text-heading-light dark:text-heading-dark mb-2">
                No positions match your filters
            </h3>
            <p class="text-gray-600 dark:text-gray-400">
                Try adjusting your filters or check back later for new opportunities.
            </p>
        </div>

    </div>
</section>

<section class="py-16 bg-graylight/40 fade-in-section">
    <div class="max-w-6xl mx-auto px-6">

        <div class="bg-gradient-primary text-white rounded-3xl p-10 shadow-xl 
                        transform transition-all duration-500 hover:shadow-2xl hover:-translate-y-1 
                        animate-[fadeInUp_0.7s_ease]">

            <!-- Heading -->
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Want to Know About Our Admission Process?
            </h2>

            <!-- Subtext -->
            <p class="text-white/90 text-lg mb-6 max-w-2xl">
                Learn how to apply, eligibility criteria, required documents, and step-by-step guidance
                to join FlyVista’s professional aviation programs.
            </p>

            <!-- Buttons -->
            <div class="flex flex-wrap items-center gap-4">

                <!-- Admission Button -->
                <a href="<?= base_url('admission') ?>"
                    class="px-6 py-3 bg-white text-primary-dark font-semibold rounded-lg 
                            shadow-md hover:bg-gray-100 transition-all duration-300">
                    View Admission Process
                </a>

                <!-- Secondary CTA Button -->
                <a href="<?= base_url('contact') ?>"
                    class="px-6 py-3 bg-secondary-dark text-white font-semibold rounded-lg 
                            shadow-md hover:bg-secondary transition-all duration-300">
                    Contact Support
                </a>

            </div>

        </div>
    </div>
</section>

<!-- Job Details Modal -->
<div id="job-modal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex justify-between items-start">
                <div>
                    <h3 id="modal-job-title" class="text-2xl font-bold text-heading-light dark:text-heading-dark">Certified Flight Instructor</h3>
                    <div class="flex items-center mt-2 space-x-4">
                        <span class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span id="modal-job-location">Flight City, FC</span>
                        </span>
                        <span class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <i class="fas fa-clock mr-1"></i>
                            <span id="modal-job-type">Full-time</span>
                        </span>
                    </div>
                </div>
                <button id="close-modal" class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="p-6">
            <div id="modal-job-content">
                <!-- Job details will be loaded here dynamically -->
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <h4 class="text-lg font-bold text-heading-light dark:text-heading-dark mb-4">Ready to Apply?</h4>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Submit your application for this position using the form below.</p>

                <form id="job-application-form"
                    class="space-y-4"
                    enctype="multipart/form-data"
                    action="<?= base_url('submit-job-application') ?>"
                    method="POST">

                    <input type="hidden" id="modal-job-id" name="job_id">
                    <input type="hidden" id="hidden-applicant-position" name="applicant_position">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Full Name</label>
                            <input type="text" id="applicant-name" name="applicant_name" required
                                class="w-full p-3 rounded-lg border">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Email Address</label>
                            <input type="email" id="applicant-email" name="applicant_email" required
                                class="w-full p-3 rounded-lg border">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Phone Number</label>
                            <input type="tel" id="applicant-phone" name="applicant_phone" required
                                class="w-full p-3 rounded-lg border">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Position Applying For</label>
                            <input type="text" id="applicant-position" readonly class="w-full p-3 rounded-lg border">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Upload Resume</label>
                        <input type="file" id="applicant-resume" name="resume" required accept=".pdf,.doc,.docx"
                            class="w-full p-3 rounded-lg border">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Cover Letter</label>
                        <textarea id="applicant-cover" name="cover_letter" rows="4" class="w-full p-3 rounded-lg border"></textarea>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit"
                            class="px-6 py-2 bg-primary-light text-white rounded-lg">
                            Submit Application
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {

        const jobModal = document.getElementById('job-modal');
        const closeModal = document.getElementById('close-modal');
        const cancelApplication = document.getElementById('cancel-application');
        const applicationForm = document.getElementById('job-application-form');
        const applicantPositionInput = document.getElementById('applicant-position');
        const modalJobIdInput = document.getElementById('modal-job-id');

        const modalTitle = document.getElementById("modal-job-title");
        const modalLocation = document.getElementById("modal-job-location");
        const modalType = document.getElementById("modal-job-type");
        const modalContent = document.getElementById("modal-job-content");

        // OPEN JOB DETAILS MODAL
        document.querySelectorAll('.view-job-details').forEach(btn => {
            btn.addEventListener("click", () => {
                let job;
                try {
                    job = JSON.parse(btn.dataset.job);
                } catch (err) {
                    console.error("Invalid JSON in data-job:", err);
                    return;
                }

                // Convert text lists
                const desc = job.job_description ?? "No description available.";
                const resList = (job.responsibilities ?? "")
                    .split("\n")
                    .filter(i => i.trim() !== "")
                    .map(i => `<li>${i}</li>`).join("");
                const reqList = (job.requirements ?? "")
                    .split("\n")
                    .filter(i => i.trim() !== "")
                    .map(i => `<li>${i}</li>`).join("");

                // Fill modal
                modalTitle.textContent = job.title;
                modalLocation.textContent = job.location;
                modalType.textContent = job.job_type;
                applicantPositionInput.value = job.title;
                modalJobIdInput.value = job.id;

                modalContent.innerHTML = `
                <div class="mb-6">
                    <h4 class="text-lg font-bold mb-2">Job Description</h4>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">${desc}</p>

                    <h4 class="text-lg font-bold mb-2">Responsibilities</h4>
                    <ul class="list-disc list-inside text-gray-600 dark:text-gray-400 mb-4">
                        ${resList || "<li>No responsibilities listed.</li>"}
                    </ul>

                    <h4 class="text-lg font-bold mb-2">Requirements</h4>
                    <ul class="list-disc list-inside text-gray-600 dark:text-gray-400">
                        ${reqList || "<li>No requirements listed.</li>"}
                    </ul>
                </div>
            `;

                jobModal.classList.remove("hidden");
            });
        });

        // CLOSE MODAL
        function closeJobModal() {
            jobModal.classList.add("hidden");
            applicationForm.reset();
        }
        closeModal.addEventListener("click", closeJobModal);
        if (cancelApplication) cancelApplication.addEventListener("click", closeJobModal);
        jobModal.addEventListener("click", e => {
            if (e.target === jobModal) closeJobModal();
        });

        // SUBMIT FORM TO BACKEND
        applicationForm.addEventListener("submit", async (e) => {
            e.preventDefault();

            const nameInput = document.getElementById('applicant-name');
            const emailInput = document.getElementById('applicant-email');
            const phoneInput = document.getElementById('applicant-phone');
            const resumeInput = document.getElementById('applicant-resume');
            const coverInput = document.getElementById('applicant-cover');

            // Validation: check required fields
            if (!nameInput.value || !emailInput.value || !phoneInput.value || !applicantPositionInput.value || resumeInput.files.length === 0) {
                alert("Please fill all required fields.");
                return;
            }

            const formData = new FormData();
            formData.append("job_id", modalJobIdInput.value);
            formData.append("applicant_name", nameInput.value);
            formData.append("applicant_email", emailInput.value);
            formData.append("applicant_phone", phoneInput.value);
            formData.append("applicant_position", applicantPositionInput.value);
            formData.append("cover_letter", coverInput.value);
            formData.append("resume", resumeInput.files[0]);

            try {
                const res = await fetch("<?= base_url('submit-job-application') ?>", {
                    method: "POST",
                    body: formData
                });

                const result = await res.json();

                if (result.status === "success") {
                    alert("Your application has been submitted successfully!");
                    closeJobModal();
                } else {
                    alert("Error: " + JSON.stringify(result.message));
                }

            } catch (err) {
                console.error(err);
                alert("Something went wrong while submitting your application.");
            }

        });

    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const filterButtons = document.querySelectorAll(".filter-btn");
        const jobItems = document.querySelectorAll(".job-item");

        filterButtons.forEach(button => {
            button.addEventListener("click", () => {

                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove("active"));

                // Add active to clicked button
                button.classList.add("active");

                const filterValue = button.getAttribute("data-filter");

                jobItems.forEach(item => {
                    const category = item.getAttribute("data-category");

                    if (filterValue === "all" || filterValue === category) {
                        item.style.display = "block";
                        item.classList.remove("hidden");
                    } else {
                        item.style.display = "none";
                        item.classList.add("hidden");
                    }
                });

            });
        });

    });
</script>

<?= $this->endSection() ?>