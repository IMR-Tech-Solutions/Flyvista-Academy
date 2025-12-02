<?= $this->extend('frontend/layout/main') ?>

<?= $this->section('content') ?>

<!-- Breadcrumb Hero Section -->
<section class="relative w-full h-48 md:h-[18rem] bg-cover bg-center flex items-center fade-in-section"
    style="background-image: url('<?= isset($breadcrumb->bg_image) && file_exists(FCPATH . $breadcrumb->bg_image) ? base_url($breadcrumb->bg_image) : base_url('assets/img/default-bg.jpg') ?>');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Content -->
    <div class="relative z-10 w-full px-6 md:px-12 flex justify-between items-center">

        <!-- Left: Page Title -->
        <h1 class="text-white text-3xl md:text-4xl font-semibold animate-fade-in-down">
            <?= isset($breadcrumb->heading) ? esc($breadcrumb->heading) : 'Admission Process' ?>
        </h1>

        <!-- Right: Breadcrumb -->
        <nav class="text-white flex items-center space-x-2 animate-slide-in-right">
            <a href="<?= base_url('/') ?>" class="hover:text-secondary transition-colors">Home</a>
            <span class="text-white">➤</span>
            <span class="text-white font-bold relative pb-1">
                <?= isset($breadcrumb->heading) ? esc($breadcrumb->heading) : 'Admission' ?>
                <span class="absolute left-0 bottom-0 w-full border-b-2 border border-secondary-light opacity-70"></span>
            </span>
        </nav>
    </div>
</section>

<!-- Admission Steps -->
<!-- Admission Steps with Button Between Columns -->
<section class="py-10 bg-background-light">
    <div class="container mx-auto px-6">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="inline-block px-6 py-2 bg-secondary/10 text-secondary rounded-full font-semibold text-sm tracking-wider border border-secondary/20 mb-4">
                <?= esc($admission_heading->subheading ?? 'Admission Simplified') ?>
            </p>

            <h2 class="text-3xl md:text-4xl font-bold text-primary">
                <?= esc($admission_heading->heading ?? 'Simple Admission Process') ?>
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
        </div>

        <!-- GRID Layout with 2-2 cards and center button -->
        <div class="flex flex-col lg:flex-row items-center justify-between mt-5">

            <!-- Left Column - Cards 1 & 2 -->
            <div class="lg:w-5/12 space-y-12">
                <?php foreach (array_slice($admission_steps, 0, 2) as $step): ?>
                    <div class="relative bg-graylight rounded-2xl min-h-[350px] p-6 pt-16
                                border border-primary-light/20 overflow-visible">
                        <!-- Floating Icon -->
                        <div class="absolute -top-8 left-6 w-16 h-16 rounded-xl border-2 border-primary/50 bg-primary-light/10 
                                    flex items-center justify-center shadow-lg">
                            <i class="<?= esc($step->icon) ?> text-primary text-2xl"></i>
                        </div>

                        <!-- Watermark Number -->
                        <div class="absolute top-2 right-4 text-primary-light/25 
                                    text-8xl font-extrabold select-none leading-none">
                            <?= esc($step->step_number) ?>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-bold text-heading-light mb-2">
                            <?= esc($step->title) ?>
                        </h3>

                        <!-- Description -->
                        <p class="text-textbody-light mb-4 text-justify">
                            <?= esc($step->description) ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Center Circular Button (visible on large screens) -->
            <div class="hidden lg:flex items-center justify-center w-2/12">
                <button onclick="openAdmissionModal()" 
                        class="w-32 h-32 rounded-full bg-gradient-to-br from-primary via-primary to-primary-dark text-white 
                               flex flex-col items-center justify-center
                               shadow-2xl hover:shadow-4xl hover:scale-110 
                               active:scale-95 transition-all duration-300
                               border-8 border-white/50 cursor-pointer
                               focus:outline-none focus:ring-8 focus:ring-primary/50
                               hover:rotate-12 transition-transform duration-500">
                    <span class="text-2xl font-bold leading-tight">Apply</span>
                    <span class="text-2xl font-bold leading-tight">Now</span>
                    <i class="fas fa-arrow-right mt-2 text-lg"></i>
                </button>
            </div>

            <!-- Right Column - Cards 3 & 4 -->
            <div class="lg:w-5/12 space-y-12">
                <?php foreach (array_slice($admission_steps, 2, 2) as $step): ?>
                    <div class="relative bg-graylight rounded-2xl min-h-[350px] p-6 pt-16
                                border border-primary-light/20 overflow-visible">
                        <!-- Floating Icon -->
                        <div class="absolute -top-8 left-6 w-16 h-16 rounded-xl border-2 border-primary/50 bg-primary-light/10 
                                    flex items-center justify-center shadow-lg">
                            <i class="<?= esc($step->icon) ?> text-primary text-2xl"></i>
                        </div>

                        <!-- Watermark Number -->
                        <div class="absolute top-2 right-4 text-primary-light/25 
                                    text-8xl font-extrabold select-none leading-none">
                            <?= esc($step->step_number) ?>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-bold text-heading-light mb-2">
                            <?= esc($step->title) ?>
                        </h3>

                        <!-- Description -->
                        <p class="text-textbody-light mb-4 text-justify">
                            <?= esc($step->description) ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Mobile Circular Button (visible on small screens) -->
            <div class="lg:hidden mt-12">
                <button onclick="openAdmissionModal()" 
                        class="w-28 h-28 rounded-full bg-gradient-to-br from-primary to-primary-dark text-white 
                               flex flex-col items-center justify-center
                               shadow-2xl hover:shadow-3xl hover:scale-110 
                               active:scale-95 transition-all duration-300
                               border-8 border-white/40 cursor-pointer
                               focus:outline-none focus:ring-8 focus:ring-primary/40
                               mx-auto">
                    <span class="text-xl font-bold leading-tight">Apply</span>
                    <span class="text-xl font-bold leading-tight">Now</span>
                    <i class="fas fa-arrow-right mt-2 text-base"></i>
                </button>
            </div>

        </div>
    </div>
</section>

<!-- ================== SCRIPT ================== -->
<script>
    function openAdmissionModal() {
        document.getElementById('admissionModal').classList.remove("hidden");
    }

    function closeAdmissionModal() {
        document.getElementById('admissionModal').classList.add("hidden");
    }
</script>

<!-- Documents Required -->
<section class="py-10 bg-graylight fade-in-section">
    <div class="container mx-auto px-6">

        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="uppercase inline-block px-6 py-2 bg-secondary/10 text-secondary rounded-full font-semibold text-sm tracking-wider border border-secondary/20 mb-4">
                Required Documents
            </p>

            <h2 class="text-3xl md:text-4xl font-bold text-primary">
                Documents Checklist
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
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">

            <!-- Mandatory Documents -->
            <div class="bg-background-light rounded-2xl p-6 shadow-lg 
                border border-primary-light/20">

                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-primary-light/10 rounded-lg 
                        flex items-center justify-center mr-4">
                        <i class="fas fa-file-alt text-primary text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-heading-light">
                        Mandatory Documents
                    </h3>
                </div>

                <ul class="space-y-4">
                    <?php if (!empty($mandatory_docs)): ?>
                        <?php foreach ($mandatory_docs as $doc): ?>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 w-2.5 h-2.5 bg-primary-light rounded-full mt-2 mr-3"></span>
                                <span class="text-textbody-light">
                                    <?= esc($doc->document_name) ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="text-gray-500">No mandatory documents found.</li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Additional Optional Documents -->
            <div class="bg-background-light rounded-2xl p-6 shadow-lg 
                border border-primary-light/20">

                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-secondary-light/20 rounded-lg flex items-center 
                        justify-center mr-4">
                        <i class="fas fa-folder-open text-secondary text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-heading-light">
                        Additional Documents (Optional)
                    </h3>
                </div>

                <ul class="space-y-4">
                    <?php if (!empty($optional_docs)): ?>
                        <?php foreach ($optional_docs as $doc): ?>
                            <li class="flex items-start">
                                <i class="fas fa-star text-sm text-secondary mt-1 mr-3"></i>
                                <span class="text-textbody-light">
                                    <?= esc($doc->document_name) ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="text-gray-500">No optional documents found.</li>
                    <?php endif; ?>
                </ul>
            </div>

        </div>

    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-primary text-white fade-in-section">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto text-center">

            <h2 class="text-3xl md:text-4xl font-bold mb-6">
                Ready to Begin Your Aviation Career?
            </h2>

            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Join hundreds of successful graduates who started their journey with FlyVista Aviation Academy
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">

                <!-- Apply Now Button -->
                <button
                    onclick="openAdmissionForm()"
                    class="bg-secondary/80 hover:bg-secondary text-white font-bold py-4 px-8 rounded-lg 
                           transition-all duration-300 transform hover:scale-105 shadow-lg shine 
                           flex items-center justify-center">
                    <span>Apply Now</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </button>

                <!-- Schedule Campus Visit -->
                <button
                    onclick="openCampusVisit()"
                    class="bg-transparent border-2 border-white text-white hover:bg-white/10 font-bold py-4 px-8 rounded-lg 
                           transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                    <i class="fas fa-calendar-alt mr-2"></i> Schedule Campus Visit
                </button>
            </div>

            <!-- Highlights -->
            <div class="mt-8 flex flex-wrap justify-center gap-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-secondary-light mr-2"></i>
                    <span>No Application Fee</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-secondary-light mr-2"></i>
                    <span>Instant Application Review</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-secondary-light mr-2"></i>
                    <span>Admission Support 24/7</span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===================== POPUP 1: ADMISSION FORM ===================== -->
<div id="admissionModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 p-4">

    <!-- Modal Box -->
    <div class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-xl relative
                absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">

        <!-- Close Button -->
        <button onclick="closeAdmissionForm()"
            class="absolute top-3 right-3 text-gray-400 hover:text-primary text-xl">
            &times;
        </button>

        <h2 class="text-2xl font-bold mb-4 text-heading-light">
            Admission Application Form
        </h2>

        <form id="admissionForm" class="space-y-4">

            <div>
                <label class="block text-sm font-medium mb-1">Full Name</label>
                <input name="full_name" type="text" class="w-full p-3 rounded-lg border" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input name="email" type="email" class="w-full p-3 rounded-lg border" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Phone Number</label>
                <input name="phone" type="text" class="w-full p-3 rounded-lg border" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Course Interested In</label>
                <select name="course_id" class="w-full p-3 rounded-lg border" required>
                    <?php foreach ($courses as $c): ?>
                        <option value="<?= $c->id ?>"><?= esc($c->title) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Subject</label>
                <input name="subject" type="text" class="w-full p-3 rounded-lg border" placeholder="Enter subject" required>
            </div>

            <button type="submit" class="w-full bg-primary text-white py-3 rounded-lg hover:bg-primary-dark">
                Submit Application
            </button>
        </form>
    </div>
</div>

<!-- ===================== POPUP 2: CAMPUS VISIT CONTACT ===================== -->
<div id="visitModal"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden flex items-center justify-center z-50 p-4 fade-in-section">

    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-xl relative">

        <!-- Close Button -->
        <button onclick="closeCampusVisit()"
            class="absolute top-3 right-3 text-gray-400 hover:text-primary text-xl">
            &times;
        </button>

        <h2 class="text-2xl font-bold mb-4 text-heading-light">
            Schedule a Campus Visit
        </h2>

        <p class="text-textbody-light mb-4">
            Contact our admission team to book your personalized campus tour.
        </p>

        <div class="space-y-3">
            <div class="flex items-center">
                <i class="fas fa-phone text-primary mr-3"></i>
                <span class="font-medium">+91 98765 43210</span>
            </div>

            <div class="flex items-center">
                <i class="fas fa-envelope text-primary mr-3"></i>
                <span class="font-medium">admissions@flyvistaacademy.com</span>
            </div>

            <div class="flex items-start">
                <i class="fas fa-map-marker-alt text-primary mr-3 mt-1"></i>
                <span class="font-medium">
                    FlyVista Aviation Academy,<br>
                    2nd Floor, Skyline Business Park,<br>
                    Andheri East, Mumbai – 400059
                </span>
            </div>
        </div>
    </div>
</div>

<!-- ===================== MODAL SCRIPT ===================== -->
<script>
    function openAdmissionForm() {
        document.getElementById("admissionModal").classList.remove("hidden");
    }

    function closeAdmissionForm() {
        document.getElementById("admissionModal").classList.add("hidden");
    }

    function openCampusVisit() {
        document.getElementById("visitModal").classList.remove("hidden");
    }

    function closeCampusVisit() {
        document.getElementById("visitModal").classList.add("hidden");
    }
</script>

<!-- FAQ Section -->
<section class="py-10 bg-background-light fade-in-section">
    <div class="container mx-auto px-6">

        <!-- Heading -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <p class="uppercase inline-block px-6 py-2 bg-secondary/10 text-secondary rounded-full font-semibold text-sm tracking-wider border border-secondary/20 mb-4">
                Need Help?
            </p>
            <h2 class="text-3xl md:text-4xl font-bold text-primary">
                Frequently Asked Questions
                <div class="w-full flex items-center justify-center mt-2 gap-3">

                    <!-- Left Gradient Line -->
                    <div class="w-20 h-[2px] bg-gradient-to-r from-transparent to-primary"></div>

                    <!-- Left Dot -->
                    <span class="h-1 w-1 bg-primary rounded-full"></span>

                    <!-- Center Circle -->
                    <span class="h-3 w-3 border-2 border-primary rounded-full flex items-center justify-center">
                        <span class="h-1 w-1 bg-primary rounded-full"></span>
                    </span>

                    <!-- Right Dot -->
                    <span class="h-1 w-1 bg-primary rounded-full"></span>

                    <!-- Right Gradient Line -->
                    <div class="w-20 h-[2px] bg-gradient-to-l from-transparent to-primary"></div>

                </div>
            </h2>
        </div>

        <div class="max-w-4xl mx-auto">
            <?php if (!empty($faqs)): ?>
                <?php foreach ($faqs as $faq): ?>
                    <div class="faq-item bg-graylight rounded-xl p-3 mb-4 border border-primary-light/20">
                        <div class="faq-header flex justify-between items-center cursor-pointer">
                            <h3 class="text-lg font-semibold text-heading-light">
                                <?= esc($faq->question) ?>
                            </h3>
                            <i class="fas fa-chevron-down text-primary transition-transform duration-300"></i>
                        </div>
                        <div class="faq-answer mt-4 hidden">
                            <p class="text-textbody-light">
                                <?= esc($faq->answer) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-500 text-center">No FAQs available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            const header = item.querySelector('.faq-header');
            const answer = item.querySelector('.faq-answer');
            const icon = header.querySelector('.fa-chevron-down');

            header.addEventListener('click', () => {
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                        otherItem.querySelector('.faq-answer').classList.add('hidden');
                        otherItem.querySelector('.fa-chevron-down').classList.remove('rotate-180');
                    }
                });
                answer.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
                item.classList.toggle('active');
            });
        });

        const style = document.createElement('style');
        style.textContent = `.rotate-180 { transform: rotate(180deg); }`;
        document.head.appendChild(style);
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const form = document.getElementById("admissionForm");

        form.addEventListener("submit", async function(e) {
            e.preventDefault();

            let formData = new FormData(form);

            let response = await fetch("<?= base_url('apply-admission') ?>", {
                method: "POST",
                body: formData
            });

            let res = await response.json();

            console.log(res); // DEBUG

            if (res.status === "success") {
                alert("Application submitted successfully!");
                closeAdmissionForm();
                form.reset();
            } else {
                alert("Submission failed! Server did not return success.");
            }
        });

    });
</script>
<?= $this->endSection() ?>