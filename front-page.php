<?php
/**
 * Template Name: Home
 */

get_header(); ?>

<div class='app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar'>
    <?php get_template_part('includes/section', 'navbar'); ?>

    <div class='app-main'>
        <?php get_template_part('includes/section', 'sidebar'); ?>

        <div class='app-main__outer'>
            <?php get_template_part('includes/section', 'front-page'); ?>

            <?php get_template_part('includes/section', 'footer'); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>