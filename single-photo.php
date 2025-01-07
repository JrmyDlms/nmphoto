<?php get_header(); ?>

<main class="single-photo">
    <div class="single-wrapper">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="photo-container">
                <!-- Partie gauche -->
                <div class="photo-info">
                    <div class="photo-meta">
                        <h1><?php the_title(); ?></h1>
                        <p>RÉFÉRENCE : <?php echo get_field('reference'); ?></p>
                        <p>CATÉGORIE : <?php 
                            $categories = get_the_terms(get_the_ID(), 'categorie');
                            if ($categories) echo $categories[0]->name;
                        ?></p>
                        <p>FORMAT : <?php 
                            $formats = get_the_terms(get_the_ID(), 'format');
                            if ($formats) echo $formats[0]->name;
                        ?></p>
                        <p>TYPE : <?php echo get_field('type'); ?></p>
                        <p>ANNÉE : <?php echo get_field('annee'); ?></p>
                    </div>
                </div>

                <!-- Partie droite -->
                <div class="photo-image">
                    <?php 
                    $image = get_field('image');
                    if ($image) : ?>
                        <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                </div>
            </div>

            <!-- Barre d'interaction -->
            <div class="interaction-bar">
                <div class="interest">
                    <p>Cette photo vous intéresse ?</p>
                    <button class="contact-btn open-modal" data-ref="<?php echo get_field('reference'); ?>">Contact</button>
                </div>
                    <div class="navigation">
                        <?php
                            $prev_post = get_previous_post();
                            $next_post = get_next_post();

                            if (!$next_post) {
                                $next_post = get_posts(array(
                                    'numberposts' => 1,
                                    'order' => 'ASC',
                                    'post_type' => 'photo'
                                ))[0];
                            }

                            if (!$prev_post) {
                                $prev_post = get_posts(array(
                                    'numberposts' => 1,
                                    'order' => 'DESC',
                                    'post_type' => 'photo'
                                ))[0];
                            }

                            $next_post_image = get_field('image', $next_post->ID);
                            $prev_post_image = get_field('image', $prev_post->ID);
                        ?>

                        <div class="thumbnails-navigation">
                            <!-- Flèche gauche -->
                            <div class="nav-item nav-item-prev">
                                <a href="<?php echo get_permalink($prev_post->ID); ?>" class="prev-post">
                                    <img class="arrow-nav" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/previous.png'); ?>" alt="Flèche gauche">
                                </a>
                                <!-- Image associée au survol -->
                                <img src="<?php echo esc_url($prev_post_image); ?>" class="preview preview-prev" alt="Image précédente">
                            </div>

                            <!-- Flèche droite -->
                            <div class="nav-item nav-item-next">
                                <a href="<?php echo get_permalink($next_post->ID); ?>" class="next-post">
                                    <img class="arrow-nav" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/next.png'); ?>" alt="Flèche droite">
                                </a>
                                <!-- Image associée au survol -->
                                <img src="<?php echo esc_url($next_post_image); ?>" class="preview preview-next" alt="Image suivante">
                            </div>
                        </div>
                    </div>
            </div>

            <!-- Photos apparentées -->
            <div class="related-photos">
                <h2>VOUS AIMEREZ AUSSI</h2>
                <div class="photos-grid">
                    <?php
                    $current_category = $categories[0]->term_id;
                    $args = array(
                        'post_type' => 'photo',
                        'posts_per_page' => 2,
                        'post__not_in' => array(get_the_ID()),
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'categorie',
                                'field' => 'term_id',
                                'terms' => $current_category
                            )
                        )
                    );
                    $related_query = new WP_Query($args);

                    if ($related_query->have_posts()) :
                        while ($related_query->have_posts()) : $related_query->the_post();
                            get_template_part('template_parts/photo', 'block');
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>