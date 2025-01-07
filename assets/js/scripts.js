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