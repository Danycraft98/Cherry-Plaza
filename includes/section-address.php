<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

defined('ABSPATH') || exit;

$customer_id = get_current_user_id();

if (!wc_ship_to_billing_address_only() && wc_shipping_enabled()) {
    $get_addresses = apply_filters(
        'woocommerce_my_account_get_addresses',
        array(
            'billing' => __('Billing address', 'woocommerce'),
            'shipping' => __('Shipping address', 'woocommerce'),
        ),
        $customer_id
    );
} else {
    $get_addresses = apply_filters(
        'woocommerce_my_account_get_addresses',
        array(
            'billing' => __('Billing address', 'woocommerce'),
        ),
        $customer_id
    );
}

$oldcol = 1;
$col = 1;
?>

<div class='container-fluid py-0'>
    <div class='row col-12 py-2'>
        <p><?php echo apply_filters('woocommerce_my_account_my_address_description', esc_html__('The following addresses will be used on the checkout page by default.', 'woocommerce')); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
    </div>

    <div class='card-group row px-2 pb-2'>
        <?php
            foreach ($get_addresses as $name => $address_title) :
                $address = wc_get_account_formatted_address($name);
                $col = $col * -1;
                $oldcol = $oldcol * -1;

        if (!wc_ship_to_billing_address_only() && wc_shipping_enabled()) : ?>

            <div class='card col-6 p-0 woocommerce-Address border shadow-none'>

        <?php else: ?>

            <div class='card col-12 p-0 woocommerce-Address border shadow-none'>

        <?php endif; ?>
                <div class='card-header woocommerce-Address-title d-flex'>
                    <h6 class='my-auto mr-auto'>
                        <?php echo esc_html($address_title); ?>
                    </h6>

                    <a class='btn btn-primary ml-auto'
                       href='<?php echo esc_url(wc_get_endpoint_url('edit-address', $name)); ?>' class='edit'>
                        <?php echo $address ? esc_html__('Edit', 'woocommerce') : esc_html__('Add', 'woocommerce'); ?>
                    </a>
                </div>

                <div class='card-body container-fluid'>
                    <address>
                        <?php echo $address ? wp_kses_post($address) : esc_html_e('You have not set up this type of address yet.', 'woocommerce'); ?>
                    </address>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

