<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Add New Team Member</h2>
            <p class="text-gray-500">Fill out the form to add a new Team Member</p>
        </div>

        <a href="<?= base_url('admin/team-members') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Team Members
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <form method="post" action="<?= base_url('admin/team-members/save') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">Team Member Details</h5>

                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" name="name"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. John Doe" required>
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <input type="text" name="role"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. CEO, ABC Company" required>
                    </div>

                    <!-- Heading -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                        <input type="text" name="heading"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Expert in Digital Marketing">
                    </div>

                    <!-- Team Member Video -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Profile Video</label>
                        <div class="mt-1 flex flex-col items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">

                            <!-- Video Preview -->
                            <video id="team-member-video-preview" class="hidden mb-4 max-h-48 rounded-lg" controls></video>

                            <div class="space-y-1 text-center">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary">
                                    <span>Upload a video</span>
                                    <input type="file" name="video" class="sr-only" data-max-size="52428800" accept="video/*"
                                        onchange="previewFlyvistaVideo(event,'team-member-video-preview')">
                                </label>
                                <p class="text-xs text-gray-500">MP4, WEBM up to 20MB</p>
                            </div>
                        </div>
                    </div>

                    <script>
                        function previewFlyvistaVideo(event, previewId) {
                            const input = event.target;
                            const preview = document.getElementById(previewId);

                            if (input.files && input.files[0]) {
                                const file = input.files[0];
                                const url = URL.createObjectURL(file);
                                preview.src = url;
                                preview.classList.remove('hidden');
                            }
                        }
                    </script>

                    <!-- Team Member Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Profile Image</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">

                            <img id="team-member-image-preview" class="hidden mx-auto mb-4 max-h-48 rounded-full object-cover" />

                            <div class="space-y-1 text-center">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary">
                                    <span>Upload a file</span>
                                    <input type="file" name="image" class="sr-only" accept="image/*"
                                        onchange="previewFlyvistaImage(event,'team-member-image-preview')">
                                </label>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 10MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Facebook URL</label>
                        <input type="url" name="facebook_url"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="https://facebook.com/username">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Twitter URL</label>
                        <input type="url" name="twitter_url"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="https://twitter.com/username">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instagram URL</label>
                        <input type="url" name="instagram_url"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="https://instagram.com/username">
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/team-members') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Save Team Member
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    // Image Preview (already existing)
    function previewFlyvistaImage(event, previewId) {
        const input = event.target;
        const preview = document.getElementById(previewId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Video Preview
    function previewVideo(url) {
        const container = document.getElementById('video-preview-container');
        const iframe = document.getElementById('video-preview');

        if (!url) {
            container.style.display = 'none';
            iframe.src = '';
            return;
        }

        // YouTube URL -> convert to embed
        let embedUrl = '';
        if (url.includes('youtube.com') || url.includes('youtu.be')) {
            const videoId = url.split('v=')[1] || url.split('youtu.be/')[1];
            if (videoId) {
                const id = videoId.split('&')[0]; // remove extra params
                embedUrl = 'https://www.youtube.com/embed/' + id;
            }
        } else {
            // direct video link
            embedUrl = url;
        }

        if (embedUrl) {
            iframe.src = embedUrl;
            container.style.display = 'block';
        } else {
            container.style.display = 'none';
            iframe.src = '';
        }
    }
</script>