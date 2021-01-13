<?php
/**
 * Template Name: Woocommerce Order History
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
        <?php $customer_orders = get_posts( array(
            'numberposts' => -1,
            'meta_key'    => '_customer_user',
            'meta_value'  => get_current_user_id(),
            'post_type'   => wc_get_order_types(),
            'post_status' => array_keys( wc_get_order_statuses() ),
        ) );
        ?>



        
        <?php get_template_part('includes/section', 'content'); ?>

        <?php get_template_part('includes/section', 'footer'); ?>
    </div>
</div>
</div>

<?php get_footer(); ?>
