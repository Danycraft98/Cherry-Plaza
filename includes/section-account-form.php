<?php
    /**
     * Edit account form
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see https://docs.woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 3.5.0
     */

    defined('ABSPATH') || exit;

    do_action('woocommerce_before_edit_account_form');
?>

<style>
    fieldset.box_fieldset {
        border: 1px groove #ffffff !important;
        padding: 0.7em 1.4em !important;
        -webkit-box-shadow: 0 0 rgba(26,54,126,.525);
        box-shadow: 0 0 rgba(26,54,126,.525);
    }
</style>

<div class='card border p-0 shadow-none'>
    <div class='card-header'>
        <h6 class='my-auto'>Edit My Account</h6>
    </div>

    <form class='card-body container' action='' method='post' <?php do_action('woocommerce_edit_account_form_tag'); ?>>

        <?php do_action('woocommerce_edit_account_form_start'); ?>

        <div class='row'>
            <div class='col form-group'>
                <label for='account_first_name'>First Name</label>
                <input type='text' class='form-control' name='account_first_name' id='account_first_name'
                       autocomplete='given-name' value='<?php echo esc_attr($user->first_name); ?>'/>
            </div>

            <div class='col form-group'>
                <label for='account_last_name'>Last Name</label>
                <input type='text' class='form-control' name='account_last_name' id='account_last_name'
                       autocomplete='family-name' value='<?php echo esc_attr($user->last_name); ?>'/>
            </div>
        </div>

        <div class='row'>
            <div class='clear'></div>

            <div class='col form-group'>
                <label for='account_display_name'>Display Name</label>
                <input type='text' class='form-control' name='account_display_name' id='account_display_name'
                       value='<?php echo esc_attr($user->display_name); ?>'
                       title='<?php esc_html_e('This will be how your name will be displayed in the account section and in reviews', 'woocommerce'); ?>'/>
            </div>

            <div class='clear'></div>

            <div class='col form-group'>
                <label for='account_email'>Email Address</label>
                <input type='email' class='form-control' name='account_email' id='account_email' autocomplete='email'
                       value='<?php echo esc_attr($user->user_email); ?>'/>
            </div>
        </div>

        <fieldset class='row box_fieldset m-1 mb-3'>
            <legend class='px-2' style='width: auto; max-width: none;'>Password Change</legend>

            <div class='col form-group'>
                <label for='password_current'>Current Password<br/>(leave blank to leave unchanged)</label>
                <input type='password' class='form-control' name='password_current' id='password_current'
                       autocomplete='off'/>
            </div>

            <div class='col form-group'>
                <label for='password_1'>New Password<br/>(leave blank to leave unchanged)</label>
                <input type='password' class='form-control' name='password_1' id='password_1' autocomplete='off'/>
            </div>

            <div class='col form-group'>
                <label for='password_2'>Confirm new password<br/>
                    <div style='visibility: hidden'>__</div>
                </label>
                <input type='password' class='form-control' name='password_2' id='password_2' autocomplete='off'/>
            </div>
        </fieldset>

        <div class='clear'></div>

        <?php do_action('woocommerce_edit_account_form'); ?>

        <?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
        <button type='submit' class='button' name='save_account_details'
                value='<?php esc_attr_e('Save changes', 'woocommerce'); ?>'><?php esc_html_e('Save changes', 'woocommerce'); ?></button>
        <input type='hidden' name='action' value='save_account_details'/>

        <?php do_action('woocommerce_edit_account_form_end'); ?>
    </form>
</div>

<?php do_action('woocommerce_after_edit_account_form'); ?>
