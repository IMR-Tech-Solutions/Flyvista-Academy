<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Edit Team Member</h2>
            <p class="text-gray-500">Update the Team Member details</p>
        </div>

        <a href="<?= base_url('admin/team-members') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Team Members
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/team-members/update/' . $member['id']) ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">Team Member Details</h5>

                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" value="<?= esc($member['name']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                               placeholder="Enter name..." required>
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <input type="text" name="role" value="<?= esc($member['role']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                               placeholder="Enter role..." required>
                    </div>

                    <!-- Heading -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                        <input type="text" name="heading" value="<?= esc($member['heading']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                               placeholder="Enter heading...">
                    </div>

                    <!-- Video -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Profile Video</label>

                        <?php if (!empty($member['video']) && file_exists('assets/videos/team/' . $member['video'])): ?>
                            <div class="mb-2">
                                <video width="250" controls class="rounded shadow">
                                    <source src="<?= base_url('assets/videos/team/' . $member['video']) ?>" type="video/mp4">
                                    Your browser does not support HTML video.
                                </video>
                            </div>
                        <?php endif; ?>

                        <div class="mt-1 flex flex-col items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                            <video id="team-video-preview" class="hidden mb-4 max-h-48 rounded-lg" controls></video>

                            <div class="space-y-1 text-center">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary/80">
                                    <span>Upload a video</span>
                                    <input type="file" name="video" class="sr-only" accept="video/*"
                                           onchange="previewVideo(event, 'team-video-preview')">
                                </label>
                                <p class="text-xs text-gray-500">MP4, WEBM up to 50MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Profile Image</label>

                        <?php if (!empty($member['image']) && file_exists('assets/img/team/' . $member['image'])): ?>
                            <div class="mb-2">
                                <img id="image-current-preview"
                                     src="<?= base_url('assets/img/team/' . $member['image']) ?>"
                                     width="150" class="rounded shadow">
                            </div>
                        <?php endif; ?>

                        <div class="mt-4 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                            <div class="space-y-1 text-center">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary/80">
                                    <span>Upload a file</span>
                                    <input type="file" name="image" class="sr-only" accept="image/*"
                                           onchange="previewImage(event, 'image-new-preview', 'image-preview-container')">
                                </label>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 10MB</p>
                            </div>
                        </div>

                        <div id="image-preview-container" class="mt-4 hidden">
                            <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                            <img id="image-new-preview" src="#" width="150" class="rounded shadow">
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Facebook URL</label>
                        <input type="url" name="facebook_url" value="<?= esc($member['facebook_url']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="https://facebook.com/username">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Twitter URL</label>
                        <input type="url" name="twitter_url" value="<?= esc($member['twitter_url']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="https://twitter.com/username">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instagram URL</label>
                        <input type="url" name="instagram_url" value="<?= esc($member['instagram_url']) ?>"
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                               placeholder="https://instagram.com/username">
                    </div>

                </div>

                <!-- Submit -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/team-members') ?>"
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update Team Member
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

    function previewVideo(event, videoId) {
        const file = event.target.files[0];
        if (!file) return;

        const url = URL.createObjectURL(file);
        const video = document.getElementById(videoId);
        video.src = url;
        video.classList.remove("hidden");
    }
</script>