<footer class="site-footer">
        <nav class="footer-nav">
            <?php
            wp_nav_menu([
                'theme_location' => 'footer-menu',
                'menu_class' => 'footer-menu',
                'container' => false
            ]);
            ?>
        </nav>
    </footer>
</div>

<?php get_template_part('template_parts/modal', 'contact'); ?>
<?php wp_footer(); ?>
</body>
</html>