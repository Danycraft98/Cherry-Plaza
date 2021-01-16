<?php
    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly.
    }

    $allowed_html = array(
        'a' => array(
            'href' => array(),
        ),
    );
global $current_user; ?>

<div class='container-fluid py-0'>
    <?php
        echo "<div class='row col-12 py-2'>
                  <p>Hello, " . get_name($current_user) . " (not you? <a class='text-primary' href='" . esc_url( wc_logout_url() ) . "'>Logout</a>)</p>
              </div>
              <div class='row col-12 py-2'>From your account dashboard you can: </div>
              <ul>
                  <li>View your <a class='text-primary' href='" . esc_url( wc_get_endpoint_url( 'orders' ) ) . "'>recent orders</a></li>
                  <li>manage your <a class='text-primary' href='" . esc_url( wc_get_endpoint_url( 'edit-address' ) ) . "'>";

        if ( wc_shipping_enabled() ) {
            echo 'shipping and ';
        }

        echo "        billing addresses</a></li>
                  <li>Edit your <a class='text-primary' href='" . esc_url( wc_get_endpoint_url( 'edit-account' ) ) . "'>password and account details</a></li></ul>";
        printf(
            wp_kses( $dashboard_desc, $allowed_html ),
            esc_url( wc_get_endpoint_url( 'orders' ) ),
            esc_url( wc_get_endpoint_url( 'edit-address' ) ),
            esc_url( wc_get_endpoint_url( 'edit-account' ) )
        );
	?>
</div>

<?php
	do_action( 'woocommerce_account_dashboard' );
	do_action( 'woocommerce_before_my_account' );
    do_action( 'woocommerce_after_my_account' );
?>
