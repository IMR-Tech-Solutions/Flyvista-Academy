<?= $this->extend('frontend/layout/main') ?>

<?= $this->section('content') ?>

<!-- Breadcrumb Hero Section -->
<section
    class="relative w-full h-48 md:h-[18rem] bg-cover bg-center flex items-center fade-in-section"
    style="background-image: url('<?= isset($breadcrumb->bg_image) && !empty($breadcrumb->bg_image) ? base_url($breadcrumb->bg_image) : base_url('assets/img/default-bg.jpg') ?>');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Content -->
    <div class="relative z-10 w-full px-6 md:px-12 flex flex-col md:flex-row justify-center md:justify-between items-center space-y-4 md:space-y-0">

        <!-- Left: Page Title -->
        <h1 class="text-white text-3xl md:text-4xl font-semibold animate-fade-in-down text-center md:text-left">
            <?= isset($breadcrumb->heading) && !empty($breadcrumb->heading) ? esc($breadcrumb->heading) : esc($post->title) ?>
        </h1>

        <!-- Right: Breadcrumb -->
        <nav class="text-white flex flex-row flex-wrap items-center space-x-2 animate-slide-in-right justify-center text-center md:text-left">
            <a href="<?= base_url('/') ?>" class="hover:text-secondary transition-colors">Home</a>
            <span class="text-white">➤</span>
            <span class="text-white">Blog</span>
            <span class="text-white">➤</span>
            <span class="text-white font-bold relative pb-1">
                <?= isset($breadcrumb->heading) && !empty($breadcrumb->heading) ? esc($breadcrumb->heading) : esc($post->title) ?>
                <span class="absolute left-0 bottom-0 w-full border-b-2 border border-secondary-light opacity-70"></span>
            </span>
        </nav>
    </div>
</section>

<main class="container mx-auto px-4 py-8">

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Main Content -->
        <article class="lg:col-span-3">
            <!-- Article Header -->
            <header class="mb-8">
                <div class="flex items-center space-x-2 mb-4">
                    <span class="px-3 py-1 bg-primary-light text-white text-xs font-medium rounded-full"><?= esc($post->category) ?></span>
                    <span class="text-sm text-gray-500"><?= esc($post->reading_time) ?> min read</span>
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-primary mb-4 text-shadow"><?= esc($post->title) ?></h1>

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <div>
                            <p class="font-medium text-heading-light">Published</p>
                            <p class="text-sm text-gray-500"><?= date("F d, Y", strtotime($post->post_date)) ?> • <?= esc($post->reading_time) ?> min read</p>
                        </div>
                    </div>

                    <div class="flex space-x-2">
                        <button class="p-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="p-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </button>
                        <button class="p-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition-colors">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                </div>

                <div class="relative h-80 md:h-96 rounded-xl overflow-hidden mb-6">
                    <img src="<?= base_url('assets/img/blog/' . $post->image) ?>"
                        alt="<?= esc($post->title) ?>"
                        class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <p class="text-sm">FlyVista's state-of-the-art Boeing 737 NG simulator</p>
                    </div>
                </div>
            </header>

            <!-- Article Content -->
            <div class="prose max-w-none mb-12">
                <p class="text-xl mb-6 text-gray-600"><?= $post->content ?></p>

                <div class="prose max-w-none mb-12">
                    <?= $description ?>
                </div>
        </article>

        <!-- Sidebar -->
        <aside class="lg:col-span-1 space-y-8">

            <!-- Blog Info (Aviation Fact) -->
            <div class="bg-gray-100 rounded-xl p-6 mb-8 text-center">

                <?php if (!empty($aviation)): ?>
                    <div class="w-12 h-12 mx-auto mb-3 flex items-center justify-center rounded-full bg-primary-light text-white">
                        <i class="fas fa-plane-departure text-lg"></i>
                    </div>

                    <h3 class="text-xl font-bold mb-2"><?= esc($aviation[0]['title']) ?></h3>

                    <p class="text-sm text-gray-500">
                        <?= esc($aviation[0]['description']) ?>
                    </p>
                <?php endif; ?>

            </div>

            <!-- ⭐ NEW: Related Blogs Card -->
            <div class="bg-gray-100 rounded-xl p-6 mb-8">
                <h3 class="text-xl font-bold mb-4">Related Blogs</h3>

                <div class="space-y-4">
                    <?php foreach ($recentPosts as $rp): ?>
                        <a href="<?= base_url('blog/' . $rp->slug) ?>" class="block group">
                            <div class="flex space-x-3 items-start">
                                <div class="w-12 h-12 rounded-lg bg-primary-light flex items-center justify-center text-white">
                                    <i class="fas fa-file-alt text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium group-hover:text-primary-light transition-colors">
                                        <?= esc($rp->title) ?>
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">
                                        <?= date("M d, Y", strtotime($rp->post_date)) ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Table of Contents -->
            <div class="bg-gray-100 rounded-xl p-6 mb-8">
                <h3 class="text-xl font-bold mb-4">In This Article</h3>

                <ul class="space-y-2">
                    <?php foreach ($toc as $t): ?>
                        <li>
                            <span class="flex items-start text-gray-600">
                                <span class="text-secondary-light mr-2">•</span>
                                <?= esc($t) ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Upcoming Courses -->
            <div class="bg-gray-100 rounded-xl p-6 mb-8">
                <h3 class="text-xl font-bold mb-4">Upcoming Courses</h3>

                <div class="space-y-4">
                    <?php foreach ($upcoming as $u): ?>
                        <div class="flex space-x-3">
                            <div class="w-16 h-16 rounded-lg bg-primary-light flex items-center justify-center text-white">
                                <i class="fas fa-plane"></i>
                            </div>
                            <div>
                                <h4 class="font-medium"><?= esc($u['title']) ?></h4>
                                <p class="text-xs text-gray-500 mt-1">Starts: <?= esc($u['date']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Simulator Specs -->
            <div class="bg-gray-100 rounded-xl p-6">
                <h3 class="text-xl font-bold mb-4">Our Simulator Fleet</h3>

                <div class="space-y-3">
                    <?php foreach ($specs as $s):
                        $parts = explode(":", $s);
                        $name = trim($parts[0]);
                        $type = trim($parts[1] ?? '');
                    ?>
                        <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                            <span class="text-sm"><?= esc($name) ?></span>
                            <span class="text-xs bg-primary-light text-white px-2 py-1 rounded"><?= esc($type) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- CTA Sticky Card -->
            <div class="sticky top-28">
                <div class="bg-primary-light text-white rounded-xl p-6 shadow-xl transform transition-all duration-500 hover:scale-[1.04] hover:shadow-2xl">
                    <h3 class="text-2xl font-bold mb-3">Start Your Aviation Journey</h3>
                    <p class="text-sm mb-4 opacity-90">
                        Join our industry-leading aviation training programs and take the first step toward becoming a professional pilot.
                    </p>
                    <a href="<?= base_url('courses') ?>" class="block w-full text-center bg-white text-primary-light font-semibold py-2 rounded-lg transition-all duration-300 hover:bg-gray-100">
                        Explore Courses
                    </a>
                </div>
            </div>

        </aside>

        <!-- Animations -->
        <style>
            @keyframes fadeInUp {
                0% {
                    opacity: 0;
                    transform: translateY(15px);
                }

                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>

    </div>
</main>

<?= $this->endSection() ?>