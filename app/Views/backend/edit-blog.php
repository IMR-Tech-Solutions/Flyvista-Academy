<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Edit Blog Post</h2>
            <p class="text-gray-500">Update blog post details</p>
        </div>

        <a href="<?= base_url('admin/blogs') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Blog List
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/blogs/update/' . $blog['id']) ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">Blog Details</h5>

                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" name="title" value="<?= esc($blog['title']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Enter blog title..." required>
                    </div>

                    <!-- Slug -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                        <input type="text" name="slug" value="<?= esc($blog['slug']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="url-friendly-slug" required>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <input type="text" name="category" value="<?= esc($blog['category']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Eg. Travel, News, Aviation..." required>
                    </div>

                    <!-- Reading Time -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Reading Time (in minutes)</label>
                        <input type="number" name="reading_time" value="<?= esc($blog['reading_time']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. 5" required>
                    </div>

                    <!-- Excerpt -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                        <input type="text" name="excerpt" value="<?= esc($blog['excerpt']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="heading of the blog...">
                    </div>

                    <!-- Content -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                        <textarea name="content" rows="6"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="Write the full blog content here..." required><?= esc($blog['content']) ?></textarea>
                    </div>

                    <!-- Post Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Post Date</label>
                        <input type="date" name="post_date" value="<?= esc($blog['post_date']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary" required>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary" required>
                            <option value="published" <?= ($blog['status'] == 'published' ? 'selected' : '') ?>>Published</option>
                            <option value="draft" <?= ($blog['status'] == 'draft' ? 'selected' : '') ?>>Draft</option>
                        </select>
                    </div>

                    <!-- Blog Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Blog Image</label>

                        <?php if (!empty($blog['image'])): ?>
                            <div class="mb-2">
                                <img id="image-current-preview"
                                    src="<?= base_url('assets/img/blog/' . $blog['image']) ?>"
                                    width="150" class="rounded shadow">
                            </div>
                        <?php endif; ?>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload New Image</label>

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">

                                    <div class="flex text-sm text-gray-600">
                                        <label for="image"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary/80">
                                            <span>Upload a file</span>
                                            <input id="image" name="image" type="file"
                                                class="sr-only" accept="image/*"
                                                onchange="previewImage(event, 'image-new-preview', 'image-preview-container')">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>

                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 5MB</p>
                                </div>
                            </div>

                            <div id="image-preview-container" class="mt-4 hidden">
                                <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                                <img id="image-new-preview" src="#" width="150" class="rounded shadow">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Submit Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/blogs') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update Blog Post
                    </button>
                </div>

            </form>

        </div>
    </div>
</main>

<script>
    function previewImage(event, imgId, containerId) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(imgId).src = e.target.result;
            document.getElementById(containerId).classList.remove("hidden");
        };
        reader.readAsDataURL(file);
    }
</script>