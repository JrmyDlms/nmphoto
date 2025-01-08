<?php get_header(); ?>

<main class="home">
    <!-- Hero Section -->
    <section class="hero">
        <?php
        $random_photo = get_posts(array(
            'post_type' => 'photo',
            'orderby' => 'rand',
            'posts_per_page' => 1
        ));

        if ($random_photo) {
            $photo = $random_photo[0];
            $image = get_field('image', $photo->ID);
            if ($image) : ?>
                <div class="hero-image" style="background-image: url('<?php echo esc_url($image); ?>');">
                    <h1>PHOTOGRAPHE EVENT</h1>
                </div>
            <?php endif;
        }
        ?>
    </section>

    <div class="front-wrapper">
        <!-- Filtres -->
        <div class="filters-container">
            <div class="left-filters">
                <select id="category-filter">
                    <option value="">CATÉGORIES</option>
                    <?php 
                    $categories = get_terms('categorie');
                    foreach ($categories as $category) : ?>
                        <option value="<?php echo $category->slug; ?>"><?php echo $category->name; ?></option>
                    <?php endforeach; ?>
                </select>

                <select id="format-filter">
                    <option value="">FORMATS</option>
                    <?php 
                    $formats = get_terms('format');
                    foreach ($formats as $format) : ?>
                        <option value="<?php echo $format->slug; ?>"><?php echo $format->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <select id="date-sort">
                <option value="ASC">TRIER PAR</option>
                <option value="ASC">Les plus récents</option>
                <option value="DESC">Les plus anciens</option>
            </select>
        </div>

        <!-- Grille de photos -->
        <div class="photos-grid" id="photo-container">
            <div class="photos-container">
                <?php
                $args = array(
                    'post_type' => 'photo',
                    'posts_per_page' => 8,
                    'orderby' => 'date',
                    'order' => 'ASC'
                );

                $query = new WP_Query($args);
                if ($query->have_posts()) : 
                    while ($query->have_posts()) : $query->the_post(); 
                        get_template_part('template_parts/photo', 'block');
                    endwhile;
                endif;
                wp_reset_postdata(); 
                ?>
            </div>
            <?php if ($query->max_num_pages > 1) : ?>
                <button id="load-more" data-page="1">Charger plus</button>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>