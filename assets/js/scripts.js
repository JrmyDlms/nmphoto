// Burger menu
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const headerMenu = document.querySelector('.header-menu');

    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('active');
        headerMenu.classList.toggle('active');
    })

    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', () => {
            hamburger.classList.remove('active');
            headerMenu.classList.remove('active');
        })
    })
});


// Modale
document.addEventListener('DOMContentLoaded', function() {
    const menuContactLink = document.querySelector('.open-modal a');
    const modal = document.getElementById('contact-modal');

    // Ouverture de la modale
    if (menuContactLink && modal) {
        menuContactLink.addEventListener('click', function(e) {
            e.preventDefault();
            modal.classList.add('show');
        });
    }

    // Fermeture de la modale
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.remove('show');
        }
    });
});