<!-- Main Content Area -->
<main class="p-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Edit Contact Information</h2>
            <p class="text-gray-500">Update the contact details below</p>
        </div>

        <a href="<?= base_url('admin/contact-info') ?>"
           class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Contact Info
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">

            <form method="post" action="<?= base_url('admin/contact-info/update/' . $contact['id']) ?>">
                <?= csrf_field() ?>

                <!-- Contact Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <h5 class="text-lg font-semibold text-secondary md:col-span-2">Contact Details</h5>

                    <!-- Location -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input type="text" name="location" value="<?= esc($contact['location']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                            placeholder="Enter location..." required>
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="text" name="phone" value="<?= esc($contact['phone']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                            placeholder="Enter phone number..." required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" value="<?= esc($contact['email']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none transition"
                            placeholder="Enter email..." required>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <h5 class="text-lg font-semibold text-secondary md:col-span-2">Social Media Links</h5>

                    <!-- Instagram -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                        <input type="text" name="instagram" value="<?= esc($contact['instagram']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none"
                            placeholder="https://instagram.com/...">
                    </div>

                    <!-- LinkedIn -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn</label>
                        <input type="text" name="linkedin" value="<?= esc($contact['linkedin']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none"
                            placeholder="https://linkedin.com/...">
                    </div>

                    <!-- Twitter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Twitter</label>
                        <input type="text" name="twitter" value="<?= esc($contact['twitter']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none"
                            placeholder="https://twitter.com/...">
                    </div>

                    <!-- WhatsApp -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp</label>
                        <input type="text" name="whatsapp" value="<?= esc($contact['whatsapp']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none"
                            placeholder="https://wa.me/...">
                    </div>

                    <!-- Facebook -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                        <input type="text" name="facebook" value="<?= esc($contact['facebook']) ?>"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none"
                            placeholder="https://facebook.com/...">
                    </div>
                </div>

                <!-- Opening Hours -->
                <div class="mt-6">
                    <h5 class="text-lg font-semibold text-secondary">Opening Hours</h5>

                    <label class="block text-sm font-medium text-gray-700 mb-1 mt-2">Opening Hours</label>
                    <textarea name="opening_hours" rows="4"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary outline-none"
                        placeholder="Enter opening hours..."><?= esc($contact['opening_hours']) ?></textarea>
                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/contact-info') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update Contact Info
                    </button>
                </div>

            </form>

        </div>
    </div>

</main>