<?php
/*
 * Template Name: Achieve
 */
?>

<?php get_header(); ?>

<div class='app-container app-theme-white body-tabs-shadow fixed-header'>
    <?php get_template_part('includes/section', 'navbar'); ?>

    <div class='app-main'>

        <div class='app-main__outer'>
            <?php get_template_part('includes/section', 'posts'); ?>

            <?php get_template_part('includes/section', 'footer'); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>