<?php
/**
 * Edit address form
 */

defined( 'ABSPATH' ) || exit;

$page_title = ( 'billing' === $load_address ) ? esc_html__( 'Billing address', 'woocommerce' ) : esc_html__( 'Shipping address', 'woocommerce' );

do_action( 'woocommerce_before_edit_account_address_form' );

if ( ! $load_address ) :
    wc_get_template( 'myaccount/my-address.php' );
else : ?>

<div class='card border p-0 shadow-none'>
    <div class='card-header'>
        <h6 class='my-auto'>
            Edit <?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?>
        </h6>
    </div>

    <form class='card-body container' method='post'>
        <?php do_action('woocommerce_before_edit_address_form_{$load_address}'); ?>

        <?php foreach ($address as $key => $field) {
            if (strpos($key, 'shipping') !== false) {
                $index = 9;
            } else {
                $index = 8;
            }

            $field_name = substr($key, $index);
            echo $field_name;
            switch ($field_name) {
                case 'first_name':
                case 'company':
                case 'phone': {
                    echo "<div class='row'><div class='col-6'>";

                    break;
                }

                case 'last_name':
                case 'country':
                case 'email': {
                    echo "<div class='col-6'>";

                    break;
                }

                case 'address_1':
                case 'address_2': {
                    echo "<div class='row'><div class='col-12'>";

                    break;
                }


                case 'city':
                    echo "<div class='row'><div class='col-4'>";

                    break;

                case 'state':
                case 'postcode':
                {
                    echo "<div class='col-4'>";

                    break;
                }

            }

            $label_array = explode('_', $field_name);
            $label = '';
            foreach ($label_array as $label_part) {
                $label = implode(' ', [$label, ucfirst($label_part)]);
            }

            echo "<div class='form-group my-2'>
                          <label for='" . $key . "'>" . $label . "</label>";

            switch ($field_name) {

                case 'postcode':
                case 'last_name': {
                    echo "<input class='form-control' id='" . $key . "' name='" . $key . "'/></div></div></div>";

                    break;
                }

                case 'first_name':
                case 'company':
                case 'city': {
                    echo "<input class='form-control' id='" . $key . "' name='" . $key . "'/></div></div>";

                    break;
                }

                case 'phone':
                    echo "<input class='form-control' type='tel' id='" . $key . "' name='" . $key . "'/></div></div>";

                    break;

                case 'email':
                    echo "<input class='form-control' type='email' id='" . $key . "' name='" . $key . "'/></div></div></div>";

                    break;

                case 'address_1':
                case 'address_2': {
                    echo "<textarea class='form-control input-text' name='" . esc_attr($key) . "'" . " id='" . $key . "' placeholder='' rows='2'></textarea></div></div></div>";

                    break;
                }

                case 'state':
                    $for_country = isset($args['country']) ? $args['country'] : WC()->checkout->get_value('billing_state' === $key ? 'billing_country' : 'shipping_country');
                    $states = WC()->countries->get_states($for_country);
                    if (is_array($states) && empty($states)) {

                        echo '<p class="form-row %1$s" id="%2$s" style="display: none">%3$s</p>';

                        echo "<input type='hidden' class='form-control hidden' name='" . $key . "' id='" . $key . "' value='' placeholder='' readonly/>";

                    } elseif (!is_null($for_country) && is_array($states)) {

                        echo "<select class='form-control' name='" . esc_attr($key) . "' id='" . $key . "' data-placeholder='Select an option'>
                                  <option value=''>" . esc_html__('Select an option&hellip;', 'woocommerce') . "</option>";

                        foreach ($states as $ckey => $cvalue) {
                            echo "<option value='" . esc_attr($ckey) . "'>" . esc_html($cvalue) . "</option>";
                        }

                        echo "</select>";

                    } else {

                        echo "<input type='text' class='form-control input-text' value=''  placeholder='' name='" . esc_attr($key) . "' id='" . $key . "'/>";

                    }
                    echo "</div></div>";

                    break;

                case 'country':
                    $countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();
                    if (1 === count($countries)) {

                        echo "<strong>" . current(array_values($countries)) . "</strong>";

                        echo "<input class='form-control country_to_state' type='hidden' name='" . esc_attr($key) . "' id='" . $key . "' value='" . current(array_keys($countries)) . "' readonly='readonly' />";

                    } else {

                        echo "<select class='form-control' name='" . esc_attr($key) . "' id='" . $key . "'>
                                  <option value='default'>" . esc_html__('Select a country / region&hellip;', 'woocommerce') . "</option>";

                        foreach ($countries as $ckey => $cvalue) {
                            echo "<option value='" . esc_attr($ckey) . "'>" . esc_html($cvalue) . "</option>";
                        }

                        echo "</select>
                                  <noscript>
                                      <button type='submit' name='woocommerce_checkout_update_totals' value='" . esc_attr__('Update country / region', 'woocommerce') . "'>" .
                                          esc_html__('Update country / region', 'woocommerce') . "
                                      </button>
                                  </noscript>";

                    }
                    echo "</div></div></div>";

                    break;
            }
        } ?>

        <?php do_action('woocommerce_after_edit_address_form_{$load_address}'); ?>

        <button type='submit' class='button' name='save_address'
                value='<?php esc_attr_e('Save address', 'woocommerce'); ?>'><?php esc_html_e('Save address', 'woocommerce'); ?></button>
        <?php wp_nonce_field('woocommerce-edit_address', 'woocommerce-edit-address-nonce'); ?>
        <input type='hidden' name='action' value='edit_address' />
	</form>
</div>

<?php endif;

do_action( 'woocommerce_after_edit_account_address_form' ); ?>
