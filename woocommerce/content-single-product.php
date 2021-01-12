<?php
/**
 * Template Name: Woocommerce Product
 */

defined( 'ABSPATH' ) || exit;

    global $product;

    do_action( 'woocommerce_before_single_product' );

    if ( post_password_required() ) {
        echo get_the_password_form(); // WPCS: XSS ok.
        return;
    }
?>

<div id='product-<?php the_ID(); ?>' <?php wc_product_class( '', $product ); ?>>

    <!-- Thumbnail -->
    <?php
        if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
            return;
        }

        $attachment_ids = $product->get_gallery_image_ids();

        if ( $attachment_ids && $product->get_image_id() ) {
            foreach ( $attachment_ids as $attachment_id ) {
                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id ), $attachment_id );
            }
        } else {
            do_action( 'woocommerce_before_single_product_summary' );
        }
    ?>

    <!-- Content -->
    <div class='summary entry-summary'>
        <?php
            the_title( "<h1 class='product_title entry-title'>", '</h1>' );


            global $product;
            global $post;

            if ( post_type_supports( 'product', 'comments' ) ):
                

                if ( ! wc_review_ratings_enabled() ) {
                    return;
                }

                $rating_count = $product->get_rating_count();
                $review_count = $product->get_review_count();
                $average      = $product->get_average_rating();

                if ( $rating_count > 0 ) : ?>

                    <div class='woocommerce-product-rating'>
                        <?php echo wc_get_rating_html( $average, $rating_count ); // WPCS: XSS ok. ?>
                        <?php if ( comments_open() ) : ?>
                            <?php //phpcs:disable ?>
                            <a href='#reviews' class='woocommerce-review-link' rel='nofollow'>(<?php printf( _n( '%s customer review', '%s customer reviews', $review_count, 'woocommerce' ), "<span class='count'>" . esc_html( $review_count ) . '</span>' ); ?>)</a>
                            <?php // phpcs:enable ?>
                        <?php endif ?>
                    </div>

                <?php endif;
            endif; 
        ?>

        <p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>">
            <?php echo $product->get_price_html(); ?>
        </p>

        <?php  $short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

            if ( ! $short_description ) {
                return;
            }

        ?>

        <div class='woocommerce-product-details__short-description'>
            <?php echo $short_description; // WPCS: XSS ok. ?>
        </div>

        <div class='product_meta'>

            <?php
                do_action( 'woocommerce_product_meta_start' );
                if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) :
            ?>

                <span class='sku_wrapper'>
                    <?php esc_html_e( 'SKU:', 'woocommerce' ); ?>
                    <span class='sku'>
                        <?php echo (
                            $sku = $product->get_sku() ) ? $sku :
                            esc_html__( 'N/A', 'woocommerce' );
                        ?>
                    </span>
                </span>

            <?php endif; do_action( 'woocommerce_product_meta_end' ); ?>

        </div>

        <?php do_action( 'woocommerce_share' ); ?>
    
    </div>

    <?php do_action( 'woocommerce_after_single_product_summary' ); ?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
