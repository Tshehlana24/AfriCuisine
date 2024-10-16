
window.addEventListener('scroll', function() {
    const tabsContainer = document.querySelector('.navbar');
    if (window.scrollY > window.innerHeight) {
        tabsContainer.classList.add('et-hero-tabs-container--top');
    } else {
        tabsContainer.classList.remove('et-hero-tabs-container--top');
    }
});

// Initialization for ES Users


