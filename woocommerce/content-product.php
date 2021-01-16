<?php
    /**
     * Template Name: Woocommerce Category
     */

    defined( 'ABSPATH' ) || exit;

    global $product;

    // Ensure visibility.
    if ( empty( $product ) || ! $product->is_visible() ) {
        return;
    }

    echo '<li ';
    wc_product_class( '', $product);
    echo do_action( 'shop_loop_item' ) . '</li>';
