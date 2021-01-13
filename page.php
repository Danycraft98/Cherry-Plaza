<?php
/**
 * Template Name: Page
 */

get_header();

echo "<div class='app-container app-theme-white fixed-header";
if( have_posts() ):
    echo "fixed-sidebar";
endif;
echo "'>";

    get_template_part('includes/section', 'navbar'); ?>

        <div class='app-main'>

            <?php if( have_posts() ):
                get_template_part('includes/section', 'sidebar');
            endif; ?>

            <div class='app-main__outer'>
                <?php get_template_part('includes/section', 'content'); ?>

                <?php get_template_part('includes/section', 'footer'); ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>