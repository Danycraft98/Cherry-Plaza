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
?>
<li <?php wc_product_class( '', $product ); ?>>
    <?php do_action( 'shop_loop_item' ); ?>
</li>
