<?php
/**
 * Template Name: Account page
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function get_nav_link($endpoint, $label): string {
    if ($endpoint == 'dashboard') {
        $classes = 'nav-item nav-link active';
    } else {
        $classes = 'nav-item nav-link';
    }

    return "<a class='" . $classes . "' data-toggle='tab' href='#" .  $endpoint . "' role='tab'>" . esc_html( $label ) . "</a>";
} ?>

<div class='container-fluid'>
    <div class='row col-12'>
        <div class="nav nav-tabs" id="myTab" role="tablist">
            <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) :
                echo get_nav_link($endpoint, $label);
            endforeach; ?>
        </div>

        <div class="border border-top-0 tab-content" id="myTabContent">
            <div class='tab-pane fade show active' id='dashboard' role='tabpanel'>
                <div class='container-fluid'>
                    <?php echo get_template_part('includes/section', 'dashboard') ?>
                </div>
            </div>

            <div class='tab-pane fade' id='orders' role='tabpanel'>
                <div class='container-fluid'>
                    <?php echo get_template_part('includes/section', 'orders') ?>
                </div>
            </div>

            <div class='tab-pane fade' id='downloads' role='tabpanel'>
                <div class='container-fluid'>
                    <?php echo get_template_part('includes/section', 'downloads') ?>
                </div>
            </div>

            <div class='tab-pane fade' id='edit-address' role='tabpanel'>
                <div class='container-fluid'>
                    <?php echo get_template_part('includes/section', 'address') ?>
                </div>
            </div>

            <div class='tab-pane fade' id='edit-account' role='tabpanel'>
                <div class='container-fluid'>
                    <?php echo get_template_part('includes/section', 'account') ?>
                </div>
            </div>
        </div>
    </div>
<hr/>


<!--div class="woocommerce-MyAccount-content">
	< ?php  do_action( 'woocommerce_account_content' ); ?>
</div-->
