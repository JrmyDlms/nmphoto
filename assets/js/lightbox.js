jQuery(document).ready(function($) {
    const lightbox = $('#lightbox');
    const lightboxImg = $('.lightbox-image');
    const refElem = $('.reference');
    const catElem = $('.category');
    const prevBtn = $('.lightbox-prev');
    const nextBtn = $('.lightbox-next');
    const closeBtn = $('.lightbox-close');

    let photos = [];
    let numPhoto = 0;

    function updateLightbox(photo) {
        const urlImage = photo.find('.photo-overlay img').attr('src');
        const reference = photo.data('reference');
        const category = photo.data('category');

        lightboxImg.attr('src', urlImage);
        refElem.text(reference);
        catElem.text(category);
    }

    $(document).on('click', '.icon-fullscreen', function(e) {
        e.preventDefault();
        
        photos = $('.photo-block').toArray();
        const photoSel = $(this).closest('.photo-block');
        
        numPhoto = photos.indexOf(photoSel[0]);
        updateLightbox(photoSel);
        
        lightbox.css('display', 'flex').fadeIn();
    });

    closeBtn.click(function() {
        lightbox.fadeOut();
    });

    function changePhoto(direction) {
        numPhoto = numPhoto + direction;
        
        if (numPhoto >= photos.length) {
            numPhoto = 0;
        }
        if (numPhoto < 0) {
            numPhoto = photos.length - 1;
        }
        
        updateLightbox($(photos[numPhoto]));
    }

    nextBtn.click(function() {
        changePhoto(1);
    });

    prevBtn.click(function() {
        changePhoto(-1);
    });

    $(document).keyup(function(e) {
        if (!lightbox.is(':visible')) return;
        if (e.key === "Escape") lightbox.fadeOut();
        if (e.key === "ArrowRight") changePhoto(1);
        if (e.key === "ArrowLeft") changePhoto(-1);
    });
});