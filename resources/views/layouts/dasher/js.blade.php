<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- SimpleBar JS -->
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Custom JS -->
<script>
    // Sidebar Toggle
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('miniSidebar');
        const content = document.getElementById('content');
        const html = document.documentElement;
        
        // Toggle sidebar collapse
        document.querySelectorAll('.sidebar-toggle').forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                html.classList.toggle('collapsed');
                html.classList.toggle('expanded');
                content.classList.toggle('expanded-content');
            });
        });
        
        // Mobile menu toggle
        const mobileMenuToggle = document.querySelector('[data-bs-toggle="offcanvas"]');
        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
        }
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 991) {
                if (!sidebar.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });
    });
</script>

@stack('scripts')

