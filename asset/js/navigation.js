// Navigation handling for the entire project
document.addEventListener('DOMContentLoaded', function() {
    // Handle pill navigation
    const pillNavigation = () => {
        const navLinks = document.querySelectorAll('.nav-pills .nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                // Remove active class from all links and panes
                navLinks.forEach(l => l.classList.remove('active'));
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.remove('show', 'active');
                });
                
                // Add active class to clicked link
                this.classList.add('active');
                
                // Show corresponding content
                const target = this.getAttribute('href').substring(1);
                const targetPane = document.getElementById(target);
                if (targetPane) {
                    targetPane.classList.add('show', 'active');
                }
            });
        });
    };

    // Handle tab navigation
    const tabNavigation = () => {
        const tabLinks = document.querySelectorAll('.nav-tabs .nav-link');
        tabLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                // Remove active class from all tabs
                tabLinks.forEach(l => l.classList.remove('active'));
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.remove('show', 'active');
                });
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Show corresponding content
                const target = this.getAttribute('href').substring(1);
                const targetPane = document.getElementById(target);
                if (targetPane) {
                    targetPane.classList.add('show', 'active');
                }
            });
        });
    };

    // Handle dashboard card navigation
    const dashboardNavigation = () => {
        const cardLinks = document.querySelectorAll('.panel-body a[data-target]');
        cardLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-target');
                const targetTab = document.querySelector(`[href="#${targetId}"]`);
                if (targetTab) {
                    targetTab.click();
                }
            });
        });
    };

    // Initialize all navigation
    pillNavigation();
    tabNavigation();
    dashboardNavigation();
});
