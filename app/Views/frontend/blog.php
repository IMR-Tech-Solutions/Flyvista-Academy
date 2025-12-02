<?= $this->extend('frontend/layout/main') ?>

<?= $this->section('content') ?>

<!-- Breadcrumb Hero Section -->
<section
  class="relative w-full h-48 md:h-[18rem] bg-cover bg-center flex items-center fade-in-section"
  style="background-image: url('<?= isset($breadcrumb->bg_image) && !empty($breadcrumb->bg_image) ? base_url($breadcrumb->bg_image) : base_url('assets/img/default-bg.jpg') ?>');">

  <!-- Overlay -->
  <div class="absolute inset-0 bg-black/50"></div>

  <!-- Content -->
  <div class="relative z-10 w-full px-6 md:px-12 flex justify-between items-center">

    <!-- Left: Page Title -->
    <h1 class="text-white text-3xl md:text-4xl font-semibold animate-fade-in-down">
      <?= isset($breadcrumb->heading) && !empty($breadcrumb->heading) ? esc($breadcrumb->heading) : 'Blogs & Insights' ?>
    </h1>

    <!-- Right: Breadcrumb -->
    <nav class="text-white flex items-center space-x-2 animate-slide-in-right">
      <a href="<?= base_url('/') ?>" class="hover:text-secondary transition-colors">Home</a>

      <span class="text-white">➤</span>

      <span class="text-white font-bold relative pb-1">
        <?= isset($breadcrumb->heading) ? esc($breadcrumb->heading) : 'blog' ?>
        <span class="absolute left-0 bottom-0 w-full border-b-2 border border-secondary-light opacity-70"></span>
      </span>
    </nav>
  </div>
</section>


<section class="py-10 bg-graylight/40">
  <div class="max-w-7xl mx-auto px-4">

    <!-- Centered Heading -->
    <div class="text-center mb-12">
      <h4 class="uppercase inline-block px-6 py-2 bg-secondary/10 text-secondary rounded-full font-semibold text-sm tracking-wider border border-secondary/20 mb-4">
        Our Blog
      </h4>
      <h2 class="text-4xl font-bold text-primary">
        Latest Articles & Insights
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

    <!-- BLOG GRID -->
    <div id="blogGrid" class="grid md:grid-cols-3 gap-8"></div>

    <!-- PAGINATION -->
    <div class="flex justify-center items-center mt-10 gap-3">
      <button id="prevBtn" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark disabled:opacity-50">
        Prev
      </button>

      <div id="paginationNumbers" class="flex gap-2"></div>

      <button id="nextBtn" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark disabled:opacity-50">
        Next
      </button>
    </div>

  </div>
</section>

<script>
  const blogPosts = <?= json_encode($blogPosts) ?>;

  const cardsPerPage = 6;
  let blogCurrentPage = 1;

  function displayCards() {
    const blogGrid = document.getElementById("blogGrid");
    blogGrid.innerHTML = "";

    const start = (blogCurrentPage - 1) * cardsPerPage;
    const selectedPosts = blogPosts.slice(start, start + cardsPerPage);

    selectedPosts.forEach(post => {
      blogGrid.innerHTML += `
      <article class="bg-white shadow-lg rounded-2xl overflow-hidden hover:shadow-2xl transition-all">
        <div class="relative">
          <img src="<?= base_url('assets/img/blog/') ?>${post.image}" class="w-full h-60 object-cover">
          <div class="absolute -bottom-6 right-6 bg-white shadow-md rounded-lg px-4 py-2 text-center border-b-4 border-secondary">
            <p class="text-2xl font-bold text-primary">${new Date(post.post_date).getDate()}</p>
            <p class="text-sm text-secondary -mt-1">${new Date(post.post_date).toLocaleString('default', { month: 'short' })}</p>
          </div>
        </div>

        <div class="pt-10 pb-6 px-6">
          <div class="flex items-center gap-6 text-textbody-light text-sm mb-4">
            <span class="flex items-center gap-2">
                <i class="fa-solid fa-tags text-primary-light text-sm"></i>
                ${post.category}
            </span>
            <span class="flex items-center gap-2">
              <svg class="w-4 h-4 text-primary-light" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 5h2v5h4v2H9V5z"/>
              </svg>
              ${post.reading_time} min read
            </span>
          </div>

          <a href="<?= base_url('blog/') ?>${post.slug}" class="block text-heading-light text-xl font-semibold hover:text-secondary-dark transition">
            ${post.title}
          </a>

          <p class="text-textbody-light mt-3 text-justify">${post.content}</p>

          <div class="flex items-center justify-end mt-6">
            <div class="flex-1 border-b border-gray-300 mr-6"></div>
            <a href="<?= base_url('blog/') ?>${post.slug}" class="flex items-center gap-3 text-primary-light font-semibold hover:gap-4 transition-all">
              <span class="text-2xl">→</span>
              <span>Read More</span>
            </a>
          </div>
        </div>
      </article>
    `;
    });
  }

  function setupPagination() {
    const pagination = document.getElementById("paginationNumbers");
    pagination.innerHTML = "";

    const totalPages = Math.ceil(blogPosts.length / cardsPerPage);

    for (let i = 1; i <= totalPages; i++) {
      const btn = document.createElement("button");
      btn.textContent = i;
      btn.className = `px-3 py-1 rounded-lg border ${
              i === blogCurrentPage ? "bg-secondary text-white" : "bg-white"
            } hover:bg-secondary-light`;
      btn.onclick = () => {
        blogCurrentPage = i;
        updateUI();
      };
      pagination.appendChild(btn);
    }
  }

  function updateUI() {
    displayCards();
    setupPagination();
    document.getElementById("prevBtn").disabled = blogCurrentPage === 1;
    document.getElementById("nextBtn").disabled =
      blogCurrentPage === Math.ceil(blogPosts.length / cardsPerPage);
  }

  document.getElementById("prevBtn").onclick = () => {
    if (blogCurrentPage > 1) blogCurrentPage--;
    updateUI();
  };

  document.getElementById("nextBtn").onclick = () => {
    if (blogCurrentPage < Math.ceil(blogPosts.length / cardsPerPage)) blogCurrentPage++;
    updateUI();
  };

  document.addEventListener("DOMContentLoaded", updateUI);
</script>

<?= $this->endSection() ?>