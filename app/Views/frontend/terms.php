<?= $this->extend('frontend/layout/main') ?>

<?= $this->section('content') ?>

<!-- Breadcrumb Hero Section -->
<section
    class="relative w-full h-48 md:h-[22rem] bg-cover bg-center flex items-center"
    style="background-image: url('<?= isset($breadcrumb->bg_image) ? base_url($breadcrumb->bg_image) : base_url('assets/img/default-bg.jpg') ?>');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Content -->
    <div class="relative z-10 w-full px-6 md:px-12 flex justify-between items-center">

        <!-- Left: Page Title -->
        <h1 class="text-white text-3xl md:text-4xl font-semibold animate-fade-in-down">
            <?= isset($breadcrumb->heading) ? esc($breadcrumb->heading) : 'Terms & Conditions' ?>
        </h1>

        <!-- Right: Breadcrumb -->
        <nav class="text-white flex items-center space-x-2 animate-slide-in-right">
            <a href="<?= base_url('/') ?>" class="hover:text-secondary transition-colors">Home</a>
            <span class="text-white">➤</span>
            <span class="text-white font-bold relative pb-1">
                <?= isset($breadcrumb->heading) ? esc($breadcrumb->heading) : 'Terms & Conditions' ?>
                <span class="absolute left-0 bottom-0 w-full border-b-2 border border-secondary-light opacity-70"></span>
            </span>
        </nav>
    </div>
</section>

<!-- Quick Navigation -->
<section class="py-8 bg-gradient-to-r from-primary/5 to-secondary/5">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-center gap-4">
            <?php foreach ($sections as $section): ?>
                <a href="#<?= strtolower(str_replace(' ', '-', $section)) ?>"
                    class="nav-btn group px-6 py-3 bg-white rounded-xl font-medium hover:bg-primary hover:text-white transition-all duration-300 flex items-center">
                    <i class="fas fa-circle mr-2"></i>
                    <?= esc($section) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Main Content -->
<main class="container mx-auto px-4 py-16">
    <div class="max-w-6xl mx-auto space-y-16">

        <!-- Introduction -->
        <?php foreach ($sections as $sectionName): ?>

            <?php
            // Skip sections with special designs
            if (in_array($sectionName, ['user obligations', 'course terms', 'payments','limitations'])) continue;

            $items = array_values(array_filter($policies, fn($p) => strtolower(trim($p->section)) === $sectionName));
            if (empty($items)) continue;

            $section = $items[0];

            // Split dynamic card fields
            $titles   = array_map('trim', explode(',', $section->card_title ?? ''));
            $icons    = array_map('trim', explode(',', $section->card_icon ?? ''));
            $contents = array_map('trim', preg_split("/\r\n|\n|\r/", $section->card_content ?? ''));

            // Normalize card counts
            $cardCount = max(count($titles), count($icons), count($contents));
            $titles   = array_pad($titles, $cardCount, '');
            $icons    = array_pad($icons, $cardCount, 'fas fa-circle');
            $contents = array_pad($contents, $cardCount, '');
            ?>

            <section id="<?= strtolower(str_replace(' ', '-', $sectionName)) ?>" class="scroll-mt-32">

                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold mb-4 text-primary"><?= esc($section->heading) ?></h2>
                    <div class="section-divider w-24 mx-auto mb-6"></div>
                    <p class="text-xl text-textbody-light max-w-3xl mx-auto">
                        <?= esc($section->short_desc) ?>
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 stagger-animation">
                    <?php for ($i = 0; $i < $cardCount; $i++): ?>
                        <div class="policy-card bg-background-light rounded-2xl p-8 text-center border border-primary/20">

                            <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <i class="<?= esc($icons[$i]) ?> text-2xl text-primary"></i>
                            </div>

                            <h3 class="text-xl font-bold mb-4"><?= esc($titles[$i]) ?></h3>

                            <p><?= nl2br(esc($contents[$i])) ?></p>

                        </div>
                    <?php endfor; ?>
                </div>

            </section>

        <?php endforeach; ?>

        <!-- User Obligations -->
        <section id="user-obligations" class="scroll-mt-32">

            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4 text-primary">User Responsibilities</h2>
                <div class="section-divider w-24 mx-auto mb-6"></div>
                <p class="text-xl text-textbody-light max-w-3xl mx-auto">
                    As a FlyVista student or website user, you are expected to follow ethical, lawful, and respectful behavior at all times.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 stagger-animation">

                <?php
                $userOb = array_values(array_filter($policies, fn($p) => strtolower(trim($p->section)) === 'user obligations'));

                foreach ($userOb as $index => $section):
                    $points = array_map('trim', preg_split("/\r\n|\n|\r/", $section->card_content));
                ?>

                    <div class="policy-card rounded-2xl p-8 border border-primary/20 bg-primary/5">

                        <h3 class="text-2xl font-bold mb-6"><?= esc($section->heading) ?></h3>

                        <ul class="space-y-4">
                            <?php foreach ($points as $p): ?>
                                <li class="flex items-start">
                                    <span class="text-primary text-lg mr-3">●</span>
                                    <p><?= esc($p) ?></p>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </div>

                <?php endforeach; ?>

            </div>
        </section>

        <!-- Course Terms -->
        <?php
        $course = array_values(array_filter($policies, fn($p) => strtolower(trim($p->section)) === 'course terms'));

        if (!empty($course)):

            $section = $course[0];
            $titles   = array_map('trim', explode(',', $section->card_title));
            $icons    = array_map('trim', explode(',', $section->card_icon));
            $contents = array_map('trim', preg_split("/\r\n|\n|\r/", $section->card_content));

            $cardCount = max(count($titles), count($icons), count($contents));
            $titles   = array_pad($titles, $cardCount, '');
            $icons    = array_pad($icons, $cardCount, 'fas fa-circle');
            $contents = array_pad($contents, $cardCount, '');
        ?>

            <section id="course-terms" class="scroll-mt-32">

                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold mb-4 text-primary"><?= esc($section->heading) ?></h2>
                    <div class="section-divider w-24 mx-auto mb-6"></div>
                    <p class="text-xl max-w-3xl mx-auto"><?= esc($section->short_desc) ?></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    <?php for ($i = 0; $i < $cardCount; $i++): ?>
                        <div class="policy-card p-8 rounded-2xl border border-primary/20">

                            <div class="w-16 h-16 bg-primary/10 rounded-xl flex justify-center items-center mx-auto mb-6">
                                <i class="<?= esc($icons[$i]) ?> text-2xl text-primary"></i>
                            </div>

                            <h3 class="text-xl font-bold text-center mb-3"><?= esc($titles[$i]) ?></h3>

                            <p class="text-center"><?= nl2br(esc($contents[$i])) ?></p>

                        </div>
                    <?php endfor; ?>

                </div>

            </section>

        <?php endif; ?>

        <!-- Payments -->
        <section id="payments" class="scroll-mt-32">

            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4 text-primary">Fees & Payments</h2>
                <div class="section-divider w-24 mx-auto mb-6"></div>
                <p class="text-xl max-w-3xl mx-auto">
                    By enrolling in a FlyVista program, you agree to the payment structure and financial policies outlined below.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <?php
                $payments = array_values(array_filter($policies, fn($p) => strtolower(trim($p->section)) === 'payments'));

                foreach ($payments as $index => $section):
                    $points = array_map('trim', preg_split("/\r\n|\n|\r/", $section->card_content));
                ?>

                    <div class="policy-card p-8 rounded-2xl border border-primary/20 bg-primary/5">

                        <h3 class="text-2xl font-bold mb-6"><?= esc($section->heading) ?></h3>

                        <ul class="space-y-4">
                            <?php foreach ($points as $p): ?>
                                <li class="flex items-start">
                                    <span class="text-primary mr-3 text-lg">●</span>
                                    <p><?= esc($p) ?></p>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </div>

                <?php endforeach; ?>

            </div>
        </section>

        <!-- Limitations -->
        <?php
        $limitations = array_values(
            array_filter($policies, fn($p) => strtolower(trim($p->section)) === 'limitations')
        );

        if (!empty($limitations)):

            $section = $limitations[0];

            // Split card fields
            $titles   = array_map('trim', explode(',', $section->card_title ?? ''));
            $icons    = array_map('trim', explode(',', $section->card_icon ?? ''));
            $contents = array_map('trim', preg_split("/\r\n|\n|\r/", $section->card_content ?? ''));

            // Normalize arrays to equal length
            $cardCount = max(count($titles), count($icons), count($contents));
            $titles   = array_pad($titles, $cardCount, '');
            $icons    = array_pad($icons, $cardCount, 'fas fa-circle');
            $contents = array_pad($contents, $cardCount, '');
        ?>

            <section id="limitations" class="scroll-mt-32">

                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold mb-4 text-primary"><?= esc($section->heading) ?></h2>
                    <div class="section-divider w-24 mx-auto mb-6"></div>
                    <p class="text-xl text-textbody-light max-w-3xl mx-auto">
                        <?= esc($section->short_desc) ?>
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 stagger-animation">

                    <?php for ($i = 0; $i < $cardCount; $i++): ?>
                        <div class="policy-card bg-background-light 
                        rounded-2xl p-8 border border-primary/20 
                        hover:shadow-lg transition-all duration-300">

                            <!-- Icon -->
                            <div class="w-16 h-16 rounded-xl bg-primary/10 flex items-center justify-center 
                            text-primary mx-auto mb-6">
                                <i class="<?= esc($icons[$i]) ?> text-2xl"></i>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-bold text-heading-light text-center">
                                <?= esc($titles[$i]) ?>
                            </h3>

                            <!-- Description -->
                            <p class="text-textbody-light text-center mt-3">
                                <?= nl2br(esc($contents[$i])) ?>
                            </p>
                        </div>
                    <?php endfor; ?>

                </div>

            </section>

        <?php endif; ?>

        <!-- Contact -->
        <section id="contact" class="scroll-mt-32">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4 text-primary">Contact & Support</h2>
                <div class="section-divider w-24 mx-auto mb-6"></div>
                <p class="text-xl text-textbody-light max-w-3xl mx-auto">
                    If you have questions regarding these Terms & Conditions, feel free to reach out to our support team.
                </p>
            </div>

            <div class="mt-12 bg-secondary/10 rounded-2xl p-8 border border-secondary/20 text-center">
                <h3 class="text-2xl font-bold mb-4 text-heading-light">We’re Here to Help</h3>
                <p class="text-textbody-light mb-6 max-w-2xl mx-auto">
                    For any queries, clarifications, or concerns, contact FlyVista using the information below.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="mailto:support@flyvista.in" class="px-6 py-3 bg-primary hover:bg-primary-dark text-white rounded-lg font-medium transition-colors flex items-center justify-center">
                        <i class="fas fa-envelope mr-2"></i>
                        Email Support
                    </a>

                    <a href="<?= base_url('contact') ?>" class="px-6 py-3 bg-secondary hover:bg-secondary-dark text-white rounded-lg font-medium transition-colors flex items-center justify-center">
                        <i class="fas fa-headset mr-2"></i>
                        Contact Form
                    </a>
                </div>
            </div>
        </section>

    </div>
</main>

<?= $this->endSection() ?>