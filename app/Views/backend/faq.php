<main class="p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-primary">FAQ Section</h2>
        <p class="text-gray-500">Add & Update FAQs</p>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <p class="bg-green-200 p-2 mb-2 text-sm"><?= session()->getFlashdata('success') ?></p>
    <?php elseif (session()->getFlashdata('error')): ?>
        <p class="bg-red-200 p-2 mb-2 text-sm"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <form method="post" action="<?= base_url('admin/update-faqs') ?>">
                <?= csrf_field() ?>

                <!-- Existing FAQs -->
                <div class="mb-6">
                    <h5 class="text-lg font-semibold text-secondary-dark mb-4">Existing FAQs</h5>
                    <div class="space-y-4" id="faqList">
                        <?php if (!empty($faqs)): foreach ($faqs as $faq): ?>
                            <div class="bg-gray-100 p-4 rounded relative">
                                <input type="hidden" name="faq_ids[]" value="<?= $faq->id ?>">
                                
                                <label class="block text-sm font-medium text-gray-700 mb-1">Question</label>
                                <input type="text" name="questions[]" value="<?= esc($faq->question) ?>"
                                       class="w-full p-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition mb-2" required>

                                <label class="block text-sm font-medium text-gray-700 mb-1">Answer</label>
                                <textarea name="answers[]" rows="2"
                                          class="w-full p-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition" required><?= esc($faq->answer) ?></textarea>

                                <button type="button" onclick="removeExistingFaq(this, <?= $faq->id ?>)"
                                        class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-sm">
                                    &times; Remove
                                </button>
                            </div>
                        <?php endforeach; else: ?>
                            <p class="text-gray-400">No FAQs added yet.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Add New FAQs -->
                <div class="mb-6">
                    <h5 class="text-lg font-semibold text-secondary mb-2">Add New FAQs</h5>
                    <div id="newFaqInputs" class="space-y-4"></div>
                    <button type="button" onclick="addNewFaqInput()"
                            class="mt-3 px-4 py-2 border border-primary text-primary rounded hover:bg-primary/10">
                        + Add FAQ
                    </button>
                </div>

                <!-- Submit Button -->
                <div class="mt-6 flex justify-end">
                    <button type="submit"
                            class="px-6 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Update FAQs
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    function addNewFaqInput() {
        const container = document.getElementById('newFaqInputs');
        const faqDiv = document.createElement('div');
        faqDiv.className = "bg-gray-50 p-4 rounded relative";

        faqDiv.innerHTML = `
            <label class="block text-sm font-medium text-gray-700 mb-1">Question</label>
            <input type="text" name="new_questions[]" class="w-full p-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition mb-2" placeholder="Enter question..." required>

            <label class="block text-sm font-medium text-gray-700 mb-1">Answer</label>
            <textarea name="new_answers[]" rows="2" class="w-full p-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition" placeholder="Enter answer..." required></textarea>

            <button type="button" onclick="this.parentElement.remove()" 
                class="absolute top-2 right-2 text-red-500 hover:text-red-700 text-sm">
                &times; Remove
            </button>
        `;
        container.appendChild(faqDiv);
    }

    function removeExistingFaq(btn, id) {
        const container = document.getElementById('faqList');

        // Add hidden input for deletion
        const hidden = document.createElement('input');
        hidden.type = "hidden";
        hidden.name = "deleted_ids[]";
        hidden.value = id;
        container.appendChild(hidden);

        // Remove the div visually
        btn.closest('.bg-gray-100').remove();
    }
</script>