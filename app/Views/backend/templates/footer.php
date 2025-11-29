<!-- footer -->
  </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables JS + Extensions -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

  <!-- DataTable Script (safe) -->
  <script>
    $(document).ready(function () {
      // Only initialize DataTable if the target table exists
      if ($('#servicesTable').length) {
        const table = $("#servicesTable").DataTable({
          dom: "Bfrtip",
          pagingType: "full_numbers",
          pageLength: 10,
          buttons: [{
              extend: "excelHtml5",
              title: "Services"
            },
            {
              extend: "pdfHtml5",
              title: "Services"
            }
          ],
          language: {
            paginate: {
              first: "« First",
              previous: "‹ Prev",
              next: "Next ›",
              last: "Last »"
            }
          }
        });

        // Custom search (guard element existence)
        if ($('#search').length) {
          $("#search").on("keyup", function () {
            table.search(this.value).draw();
          });
        }

        // Custom show entries
        if ($('#lengthMenu').length) {
          $("#lengthMenu").on("change", function () {
            table.page.len(this.value).draw();
          });
        }

        // Export buttons
        if ($('#exportExcel').length) {
          $("#exportExcel").on("click", () => table.button(0).trigger());
        }
        if ($('#exportPdf').length) {
          $("#exportPdf").on("click", () => table.button(1).trigger());
        }

        // Page info helper (safely handle page info)
        function updatePageInfo() {
          try {
            const pageInfo = table.page.info();
            $("#pageInfo").text(`Page ${pageInfo.page + 1} of ${pageInfo.pages}`);
          } catch (err) {
            console.warn('updatePageInfo: could not read table.page.info()', err);
            $("#pageInfo").text('');
          }
        }

        table.on("draw", updatePageInfo);
        updatePageInfo(); // Initial load
      } else {
        // No table on this page, hide controls or warn
        console.info('DataTable: #servicesTable not found — skipping initialization.');
      }
    });
  </script>

  <!-- Vanilla JS: DOM-safe & guarded -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Sidebar toggle (guard element)
      const sidebarToggle = document.getElementById('sidebar-toggle');
      const sidebar = document.getElementById('sidebar');
      if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
          sidebar.classList.toggle('w-64');
          sidebar.classList.toggle('w-20');

          const sidebarTexts = document.querySelectorAll('#sidebar span');
          sidebarTexts.forEach(text => text.classList.toggle('hidden'));

          const sidebarIcons = document.querySelectorAll('#sidebar i');
          sidebarIcons.forEach(icon => {
            if (icon.parentElement) {
              icon.parentElement.classList.toggle('justify-center');
              icon.parentElement.classList.toggle('space-x-3');
            }
          });
        });
      } else {
        if (!sidebarToggle) console.warn('#sidebar-toggle not found.');
        if (!sidebar) console.warn('#sidebar not found.');
      }

      // User dropdown toggle (guard elements)
      const userMenuButton = document.getElementById('user-menu-button');
      const userMenuDropdown = document.getElementById('user-menu-dropdown');
      if (userMenuButton && userMenuDropdown) {
        userMenuButton.addEventListener('click', (e) => {
          e.stopPropagation();
          userMenuDropdown.classList.toggle('hidden');
        });

        // Close when clicking outside
        document.addEventListener('click', (e) => {
          if (!userMenuButton.contains(e.target) && !userMenuDropdown.contains(e.target)) {
            userMenuDropdown.classList.add('hidden');
          }
        });
      } else {
        if (!userMenuButton) console.warn('#user-menu-button not found.');
        if (!userMenuDropdown) console.warn('#user-menu-dropdown not found.');
      }

      // Home dropdown toggle
      const homeDropdownToggle = document.getElementById('home-dropdown-toggle');
      const homeDropdownMenu = document.getElementById('home-dropdown-menu');
      if (homeDropdownToggle && homeDropdownMenu) {
        homeDropdownToggle.addEventListener('click', (e) => {
          e.stopPropagation();
          homeDropdownMenu.classList.toggle('hidden');
        });

        // Optional: close on outside click
        document.addEventListener('click', (e) => {
          if (!homeDropdownToggle.contains(e.target) && !homeDropdownMenu.contains(e.target)) {
            homeDropdownMenu.classList.add('hidden');
          }
        });
      } else {
        if (!homeDropdownToggle) console.warn('#home-dropdown-toggle not found.');
        if (!homeDropdownMenu) console.warn('#home-dropdown-menu not found.');
      }
    });
  </script>

  <!-- TinyMCE init (safe guard) -->
  <script>
    (function () {
      // If TinyMCE script failed to load, don't call init (prevents "tinymce is not defined")
      if (typeof tinymce === 'undefined') {
        console.warn('TinyMCE is not loaded — skipping tinyMCE.init(). If you expect TinyMCE to load via CDN, check network or API key.');
        return;
      }

      // Initialize only after DOM is ready
      document.addEventListener('DOMContentLoaded', function () {
        // target only the textarea(s) you want to enhance (example: #editor)
        tinymce.init({
            selector: 'textarea[name=description]',
            setup: function(editor) {
                editor.on('change', function () {
                editor.save(); // keep textarea updated
                });
            }
        });
      });
    })();
  </script>
</body>

</html>