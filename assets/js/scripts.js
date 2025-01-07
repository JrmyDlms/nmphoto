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
    const singleContactBtn = document.querySelector('.contact-btn');
    const modal = document.getElementById('contact-modal');

    // Ouverture de la modale Menu
    if (menuContactLink && modal) {
        menuContactLink.addEventListener('click', function(e) {
            e.preventDefault();
            modal.classList.add('show');
        });
    }

    // Ouverture de la modale Bouton
    if (singleContactBtn && modal) {
        singleContactBtn.addEventListener('click', function(e) {
            e.preventDefault();
            // Récupère la référence de la photo
            const photoRef = this.getAttribute('data-ref');
            // On met à jour le champ de référence dans le formulaire
            const refInput = document.querySelector('input[name="reference"]');
            if (refInput) {
                refInput.value = photoRef;
            }
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