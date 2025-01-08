jQuery(document).ready(function($) {
    let pageNumero = 1;

    function loadPhotos(reset = false) {
        $('.photos-container').addClass('loading');
        
        if (reset) {
            pageNumero = 1;
        }

        let categorie = $('#category-filter').val();
        let format = $('#format-filter').val();
        let tri = $('#date-sort').val();

        $.ajax({
            url: monThemeAjax.url,
            type: 'POST',
            data: {
                action: 'load_more_photos',
                nonce: monThemeAjax.nonce,
                page: pageNumero,
                category: categorie,
                format: format,
                order: tri
            },
            success: function(reponse) {
                if (reponse.success) {
                    if (reset) {
                        $('.photos-container').html(reponse.data.html);
                    } else {
                        $('.photos-container').append(reponse.data.html);
                    }
                    
                    if (reponse.data.hasMore) {
                        $('#load-more').show();
                    } else {
                        $('#load-more').hide();
                    }
                }
                $('.photos-container').removeClass('loading');
            },
            error: function() {
                $('.photos-container').removeClass('loading');
            }
        });
    }

    $('#category-filter').on('change', function() {
        loadPhotos(true);
    });

    $('#format-filter').on('change', function() {
        loadPhotos(true);
    });

    $('#date-sort').on('change', function() {
        loadPhotos(true);
    });

    $('#load-more').click(function(e) {
        e.preventDefault();
        pageNumero++;
        loadPhotos(false);
    });

    loadPhotos(true);
});
