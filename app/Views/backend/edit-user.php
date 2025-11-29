<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-secondary-dark">Edit User</h2>
            <p class="text-gray-500">Update user details</p>
        </div>
        <a href="<?= base_url('admin/user') ?>"
            class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Users
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <form action="<?= base_url('admin/user/update/' . $user['id']) ?>" method="POST"
                enctype="multipart/form-data">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-primary mb-2">User Information</h3>
                    <p class="text-sm text-gray-500">Update the details below to modify the user.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="first-name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                        <input type="text" id="first-name" name="first_name"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"
                            value="<?= esc($user['first_name'] ?? '') ?>" required>
                    </div>

                    <div>
                        <label for="last-name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                        <input type="text" id="last-name" name="last_name"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"
                            value="<?= esc($user['last_name'] ?? '') ?>" required>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" id="email" name="email"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"
                            value="<?= esc($user['email'] ?? '') ?>" required>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" id="phone" name="phone"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"
                            value="<?= esc($user['phone'] ?? '') ?>">
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status" name="status"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"
                            required>
                            <?php
                            $status = (string)($user['status'] ?? '1');
                            ?>
                            <option value="1" <?= $status === '1' ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= $status === '0' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Current Profile Photo</label>
                        <?php if (!empty($user['profile_photo'])): ?>
                            <div class="mb-2">
                                <img id="current-photo" src="<?= base_url('assets/img/users/' . $user['profile_photo']) ?>"
                                    width="150" class="rounded shadow">
                            </div>
                        <?php endif; ?>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload New Photo</label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">
                                    <div class="flex text-sm text-gray-600">
                                        <label for="profile_photo"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary/80 focus-within:outline-none">
                                            <span>Upload a file</span>
                                            <input id="profile_photo" name="profile_photo" type="file" class="sr-only"
                                                accept="image/*" onchange="previewProfilePhoto(event)">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG up to 5MB</p>
                                </div>
                            </div>

                            <!-- Image preview -->
                            <div id="preview-container" class="mt-4 hidden">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Preview:</label>
                                <img id="preview-img" src="#" alt="Image Preview" class="rounded-full shadow w-[150px]">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/user') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    function previewProfilePhoto(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('preview-container');
        const previewImg = document.getElementById('preview-img');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewContainer.classList.remove('hidden');
            };

            reader.readAsDataURL(file);
        } else {
            previewImg.src = '#';
            previewContainer.classList.add('hidden');
        }
    }
</script>