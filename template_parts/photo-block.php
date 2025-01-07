<div class="photo-block" 
     data-reference="<?php echo get_field('reference'); ?>"
     data-category="<?php 
        $categories = get_the_terms(get_the_ID(), 'categorie');
        if ($categories) echo $categories[0]->name;
     ?>">
    <?php 
    $image = get_field('image');
    if ($image) : ?>
        <div class="photo-overlay">
            <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>">
            <div class="overlay">
                <!-- Icônes -->
                <div class="overlay-icons">
                    <a href="<?php the_permalink(); ?>" class="icon-eye">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/eye.png" alt="Voir la photo">
                    </a>
                    <div class="icon-fullscreen">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/fullscreen.png" alt="Plein écran">
                    </div>
                </div>
                <!-- Infos -->
                <div class="overlay-info">
                    <p class="reference"><?php echo get_field('reference'); ?></p>
                    <p class="categorie"><?php 
                        if ($categories) {
                            echo $categories[0]->name;
                        }
                    ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>