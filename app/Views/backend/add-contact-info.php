<!-- Main Content Area -->
<main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-primary">Add Contact Information</h2>
            <p class="text-gray-500">Fill out the form to add new contact details</p>
        </div>

        <a href="<?= base_url('admin/contact-info') ?>"
           class="text-primary hover:text-secondary flex items-center bg-primary/10 border border-primary rounded-full px-4 py-2">
            <i class="fas fa-arrow-left mr-2"></i> Back to Contact Info List
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <form method="post" action="<?= base_url('admin/contact-info/save') ?>">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">Contact Details</h5>

                    <!-- Location -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input type="text" name="location"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="e.g. Mumbai, India" required>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="text" name="phone"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="+91 9876543210" required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="example@domain.com" required>
                    </div>

                </div>

                <!-- Social Links Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <h5 class="text-lg font-semibold text-secondary-dark md:col-span-2">Social Media Links</h5>

                    <!-- Instagram -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                        <input type="text" name="instagram"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="https://instagram.com/yourpage">
                    </div>

                    <!-- LinkedIn -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn</label>
                        <input type="text" name="linkedin"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="https://linkedin.com/in/yourprofile">
                    </div>

                    <!-- Twitter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Twitter</label>
                        <input type="text" name="twitter"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="https://twitter.com/yourprofile">
                    </div>

                    <!-- WhatsApp -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp</label>
                        <input type="text" name="whatsapp"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="https://wa.me/1234567890">
                    </div>

                    <!-- Facebook -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                        <input type="text" name="facebook"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                            placeholder="https://facebook.com/yourpage">
                    </div>
                </div>

                <!-- Opening Hours -->
                <div class="mt-6">
                    <h5 class="text-lg font-semibold text-secondary-dark">Opening Hours</h5>

                    <label class="block text-sm font-medium text-gray-700 mb-1 mt-2">Opening Hours</label>
                    <textarea name="opening_hours" rows="3"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                        placeholder="Mon - Fri: 9:00 AM - 6:00 PM&#10;Sat: 10:00 AM - 2:00 PM&#10;Sun: Closed"></textarea>
                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="<?= base_url('admin/contact-info') ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>

                    <button type="submit"
                        class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Save Contact Info
                    </button>
                </div>

            </form>
        </div>
    </div>
</main>