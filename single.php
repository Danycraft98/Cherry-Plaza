<?php
/**
 * Template Name: Page
 */

get_header(); ?>

<div class='app-container app-theme-white fixed-header'>
    <?php get_template_part('includes/section', 'navbar'); ?>

    <div class='app-main'>
        <div class='app-main__outer'>
            <?php get_template_part('includes/section', 'post'); ?>

            <?php get_template_part('includes/section', 'footer'); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>