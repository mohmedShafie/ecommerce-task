// Dark Mode Toggle Functionality
document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    const darkModeIcon = document.getElementById('darkModeIcon');
    const html = document.documentElement;

    // Check for saved dark mode preference or default to light mode
    const currentTheme = localStorage.getItem('theme') || 'light';

    // Apply the saved theme
    if (currentTheme === 'dark') {
        html.classList.add('dark-style');
        html.classList.remove('light-style');
        darkModeIcon.classList.remove('ti-moon');
        darkModeIcon.classList.add('ti-sun');
    } else {
        html.classList.add('light-style');
        html.classList.remove('dark-style');
        darkModeIcon.classList.remove('ti-sun');
        darkModeIcon.classList.add('ti-moon');
    }

    // Toggle dark mode
    darkModeToggle.addEventListener('click', function() {
        if (html.classList.contains('light-style')) {
            // Switch to dark mode
            html.classList.remove('light-style');
            html.classList.add('dark-style');
            darkModeIcon.classList.remove('ti-moon');
            darkModeIcon.classList.add('ti-sun');
            localStorage.setItem('theme', 'dark');
        } else {
            // Switch to light mode
            html.classList.remove('dark-style');
            html.classList.add('light-style');
            darkModeIcon.classList.remove('ti-sun');
            darkModeIcon.classList.add('ti-moon');
            localStorage.setItem('theme', 'light');
        }

        // Dispatch custom event for theme change
        document.dispatchEvent(new CustomEvent('themeChanged', {
            detail: { theme: html.classList.contains('dark-style') ? 'dark' : 'light' }
        }));
    });
});
