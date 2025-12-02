<?= $this->extend('frontend/layout/main') ?>

<?= $this->section('content') ?>

<!-- Breadcrumb Hero Section -->
<section
    class="relative w-full h-48 md:h-[18rem] bg-cover bg-center flex items-center"
    style="background-image: url('<?= isset($breadcrumb->bg_image) ? base_url($breadcrumb->bg_image) : base_url('assets/img/default-bg.jpg') ?>');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Content -->
    <div class="relative z-10 w-full px-6 md:px-12 flex justify-between items-center">

        <!-- Left: Page Title -->
        <h1 class="text-white text-3xl md:text-4xl font-semibold animate-fade-in-down">
            <?= isset($breadcrumb->heading) ? esc($breadcrumb->heading) : 'Privacy Policy' ?>
        </h1>

        <!-- Right: Breadcrumb -->
        <nav class="text-white flex items-center space-x-2 animate-slide-in-right">
            <a href="<?= base_url('/') ?>" class="hover:text-secondary transition-colors">Home</a>
            <span class="text-white">➤</span>
            <span class="text-white font-bold relative pb-1">
                <?= isset($breadcrumb->heading) ? esc($breadcrumb->heading) : 'privacy policy' ?>
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
                    <i class="fas fa-circle mr-2 group-hover:scale-110 transition-transform"></i>
                    <?= esc($section) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Main Content -->
<main class="container mx-auto px-4 py-16">
    <div class="max-w-6xl mx-auto space-y-16">

        <?php
        // Fetch the "Overview" section from the database
        $overview = array_filter($policies, fn($p) => strtolower($p->section) === 'overview');

        if (!empty($overview)) {
            $section = array_values($overview)[0];

            // Split card titles and icons by comma
            $cardTitles = array_map('trim', explode(',', $section->card_title));
            $cardIcons  = array_map('trim', explode(',', $section->card_icon));

            // Split card content by newline (each line corresponds to one card)
            $cardContents = array_map('trim', preg_split("/\r\n|\n|\r/", $section->card_content));

            // Ensure all arrays have same length
            $cardCount = count($cardTitles);
            if (count($cardIcons) < $cardCount) {
                $cardIcons = array_pad($cardIcons, $cardCount, 'fas fa-circle');
            }
            if (count($cardContents) < $cardCount) {
                $cardContents = array_pad($cardContents, $cardCount, '');
            }
        ?>
            <section id="overview" class="scroll-mt-32">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold mb-4 text-primary"><?= esc($section->heading) ?></h2>
                    <div class="section-divider w-24 mx-auto mb-6"></div>
                    <p class="text-xl text-textbody-light max-w-3xl mx-auto">
                        <?= esc($section->short_desc) ?>
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 stagger-animation">
                    <?php for ($i = 0; $i < $cardCount; $i++): ?>
                        <div class="policy-card bg-background-light rounded-2xl p-8 text-center border border-gray-100">
                            <div class="w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center text-primary mx-auto mb-6">
                                <i class="<?= esc($cardIcons[$i]) ?> text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-4 text-heading-light"><?= esc($cardTitles[$i]) ?></h3>
                            <p class="text-textbody-light"><?= esc($cardContents[$i]) ?></p>
                        </div>
                    <?php endfor; ?>
                </div>
            </section>
        <?php } ?>

        <!-- Data Collection -->
        <section id="data-collection" class="scroll-mt-32">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4 text-primary">Data We Collect</h2>
                <div class="section-divider w-24 mx-auto mb-6"></div>
                <p class="text-xl text-textbody-light max-w-3xl mx-auto">
                    To offer world-class aviation training and provide seamless student services, FlyVista collects certain personal and technical information.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 stagger-animation">
                <?php
                // Filter Data Collection section
                $dataCollection = array_filter($policies, fn($p) => strtolower($p->section) === 'data collection');

                if (!empty($dataCollection)) {
                    foreach ($dataCollection as $index => $section) {

                        // Split titles and contents
                        $titles = array_map('trim', explode(',', $section->card_title));
                        $contents = array_map('trim', preg_split("/\r\n|\n|\r/", $section->card_content));
                        $icons = array_map('trim', explode(',', $section->card_icon));
                        $icon = $icons[0] ?? 'fas fa-circle';

                        // Card color: primary for first, secondary for second
                        $bgClass = $index === 1
                            ? 'bg-primary/10 text-primary'
                            : 'bg-secondary/10 text-secondary';
                ?>
                        <div class="policy-card rounded-2xl p-8 border border-primary/20 <?= $bgClass ?>">
                            <!-- Top: Icon + Heading + Short Desc -->
                            <div class="flex items-start mb-6">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center mr-4 <?= $index === 1 ? 'bg-primary/10 text-primary' : 'bg-secondary/20 text-secondary' ?>">
                                    <i class="<?= esc($icon) ?>"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-heading-light"><?= esc($section->heading) ?></h3>
                                    <p class="text-textbody-light mt-2"><?= esc($section->short_desc) ?></p>
                                </div>
                            </div>

                            <!-- Card Content: Titles + Contents -->
                            <ul class="space-y-4">
                                <?php
                                $maxItems = max(count($titles), count($contents));
                                for ($i = 0; $i < $maxItems; $i++):
                                    $title = $titles[$i] ?? '';
                                    $content = $contents[$i] ?? '';
                                ?>
                                    <li class="flex items-start">
                                        <span class="text-lg mr-3 mt-1">●</span>
                                        <div class="mt-1">
                                            <span class="font-medium text-heading-light"><?= esc($title) ?></span>
                                            <p class="text-textbody-light text-sm mt-1"><?= nl2br(esc($content)) ?></p>
                                        </div>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </section>

        <!-- Data Usage -->
        <section id="data-usage" class="scroll-mt-32">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4 text-primary">How We Use Your Data</h2>
                <div class="section-divider w-24 mx-auto mb-6"></div>
                <p class="text-xl text-textbody-light max-w-3xl mx-auto">
                    Your information helps FlyVista deliver high-quality aviation training and improve your learning experience.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 stagger-animation">
                <?php
                // Filter Data Usage section and reindex
                $dataUsage = array_values(array_filter($policies, fn($p) => strtolower($p->section) === 'data usage'));

                if (!empty($dataUsage)) {
                    foreach ($dataUsage as $index => $section) {
                        // Split titles and contents
                        $titles = array_map('trim', explode(',', $section->card_title));
                        $contents = array_map('trim', preg_split("/\r\n|\n|\r/", $section->card_content));
                        $icons = array_map('trim', explode(',', $section->card_icon));
                        $icon = $icons[0] ?? 'fas fa-circle';

                        // Card colors: first → primary, second → secondary
                        $bgGradient = $index === 0
                            ? 'bg-gradient-to-br from-primary/5 to-secondary/5'
                            : 'bg-gradient-to-br from-secondary/5 to-primary/5';

                        $borderClass = $index === 0 ? 'border-primary/20' : 'border-secondary/20';
                        $iconBgClass = $index === 0 ? 'bg-primary text-white' : 'bg-secondary text-white';
                ?>
                        <div class="policy-card <?= $bgGradient ?> rounded-2xl p-8 border <?= $borderClass ?>">
                            <!-- Card Heading -->
                            <div class="flex items-center justify-center mb-6">
                                <h3 class="text-2xl font-bold text-heading-light text-center"><?= esc($section->heading) ?></h3>
                            </div>

                            <!-- Card Content -->
                            <div class="space-y-6">
                                <?php
                                $maxItems = max(count($titles), count($contents));
                                for ($i = 0; $i < $maxItems; $i++):
                                    $title = $titles[$i] ?? '';
                                    $content = $contents[$i] ?? '';
                                ?>
                                    <div class="flex items-start">
                                        <div class="w-10 h-10 rounded-lg <?= $iconBgClass ?> flex items-center justify-center text-white mr-4 flex-shrink-0">
                                            <i class="<?= esc($icon) ?>"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-lg text-heading-light"><?= esc($title) ?></h4>
                                            <p class="text-textbody-light mt-1"><?= nl2br(esc($content)) ?></p>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </section>

        <?php
        // Fetch the "Protection" section from the database
        $protection = array_filter($policies, fn($p) => strtolower($p->section) === 'protection');

        if (!empty($protection)) {
            $section = array_values($protection)[0];

            // Split card titles and icons by comma
            $cardTitles = array_map('trim', explode(',', $section->card_title));
            $cardIcons  = array_map('trim', explode(',', $section->card_icon));

            // Split card content by newline (each line corresponds to one card)
            $cardContents = array_map('trim', preg_split("/\r\n|\n|\r/", $section->card_content));

            // Ensure all arrays have the same length
            $cardCount = count($cardTitles);
            if (count($cardIcons) < $cardCount) {
                $cardIcons = array_pad($cardIcons, $cardCount, 'fas fa-circle');
            }
            if (count($cardContents) < $cardCount) {
                $cardContents = array_pad($cardContents, $cardCount, '');
            }
        ?>
            <section id="protection" class="scroll-mt-32">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold mb-4 text-primary"><?= esc($section->heading) ?></h2>
                    <div class="section-divider w-24 mx-auto mb-6"></div>
                    <p class="text-xl text-textbody-light max-w-3xl mx-auto">
                        <?= esc($section->short_desc) ?>
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 stagger-animation">
                    <?php for ($i = 0; $i < $cardCount; $i++):
                        // Alternate card colors: first = primary, second = secondary
                        $bgClass = $i % 2 === 0
                            ? 'bg-background-light border border-primary/20'
                            : 'bg-background-light border border-secondary/20';

                        $iconBgClass = $i % 2 === 0
                            ? 'bg-primary/20 text-primary'
                            : 'bg-secondary/20 text-secondary';
                    ?>
                        <div class="policy-card <?= $bgClass ?> rounded-2xl p-6 text-center">
                            <div class="w-20 h-20 rounded-2xl <?= $iconBgClass ?> flex items-center justify-center mx-auto mb-4">
                                <i class="<?= esc($cardIcons[$i]) ?> text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-heading-light"><?= esc($cardTitles[$i]) ?></h3>
                            <p class="text-textbody-light"><?= esc($cardContents[$i]) ?></p>
                        </div>
                    <?php endfor; ?>
                </div>
            </section>
        <?php } ?>

        <?php
        // Fetch the "Rights" section from the database
        $rights = array_filter($policies, fn($p) => strtolower($p->section) === 'rights');

        if (!empty($rights)) {
            $section = array_values($rights)[0];

            // Split card titles and icons by comma
            $cardTitles = array_map('trim', explode(',', $section->card_title));
            $cardIcons  = array_map('trim', explode(',', $section->card_icon));

            // Split card content by newline
            $cardContents = array_map('trim', preg_split("/\r\n|\n|\r/", $section->card_content));

            // Ensure all arrays have the same length
            $cardCount = count($cardTitles);
            if (count($cardIcons) < $cardCount) {
                $cardIcons = array_pad($cardIcons, $cardCount, 'fas fa-circle');
            }
            if (count($cardContents) < $cardCount) {
                $cardContents = array_pad($cardContents, $cardCount, '');
            }
        ?>
            <section id="rights" class="scroll-mt-32">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold mb-4 text-primary"><?= esc($section->heading) ?></h2>
                    <div class="section-divider w-24 mx-auto mb-6"></div>
                    <p class="text-xl text-textbody-light max-w-3xl mx-auto">
                        <?= esc($section->short_desc) ?>
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 stagger-animation">
                    <?php for ($i = 0; $i < $cardCount; $i++):
                        // Alternate card colors: first = primary, second = secondary
                        $bgClass = $i % 2 === 0
                            ? 'bg-background-light border border-primary/20'
                            : 'bg-background-light border border-secondary/20';

                        $iconBgClass = $i % 2 === 0
                            ? 'bg-primary/10 text-primary'
                            : 'bg-secondary/10 text-secondary';
                    ?>
                        <div class="policy-card <?= $bgClass ?> rounded-2xl p-6 text-center group hover:bg-primary hover:text-white transition-all duration-300">
                            <div class="w-16 h-16 rounded-2xl <?= $iconBgClass ?> group-hover:bg-white/20 flex items-center justify-center text-primary group-hover:text-white mx-auto mb-4">
                                <i class="<?= esc($cardIcons[$i]) ?> text-xl"></i>
                            </div>
                            <h3 class="text-lg font-bold mb-2 group-hover:text-white"><?= esc($cardTitles[$i]) ?></h3>
                            <p class="text-sm group-hover:text-white/90"><?= esc($cardContents[$i]) ?></p>
                        </div>
                    <?php endfor; ?>
                </div>

                <?php if (!empty($section->additional_info)): ?>
                    <div class="mt-12 bg-secondary/10 rounded-2xl p-8 border border-secondary/20 text-center">
                        <h3 class="text-2xl font-bold mb-4 text-heading-light"><?= esc($section->additional_heading) ?></h3>
                        <p class="text-textbody-light mb-6 max-w-2xl mx-auto">
                            <?= esc($section->additional_info) ?>
                        </p>
                        <?php if (!empty($section->contact_email) || !empty($section->contact_link)): ?>
                            <div class="flex flex-col sm:flex-row justify-center gap-4">
                                <?php if (!empty($section->contact_email)): ?>
                                    <a href="mailto:<?= esc($section->contact_email) ?>" class="px-6 py-3 bg-primary hover:bg-primary-dark text-white rounded-lg font-medium transition-colors flex items-center justify-center">
                                        <i class="fas fa-envelope mr-2"></i>
                                        Email DPO
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($section->contact_link)): ?>
                                    <a href="<?= esc($section->contact_link) ?>" class="px-6 py-3 bg-secondary hover:bg-secondary-dark text-white rounded-lg font-medium transition-colors flex items-center justify-center">
                                        <i class="fas fa-headset mr-2"></i>
                                        Contact Form
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </section>
        <?php } ?>
    </div>
</main>

<?= $this->endSection() ?>