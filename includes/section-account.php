<?php
    /**
     * Template Name: Account page
     */

    defined('ABSPATH') || exit;

    if (!defined('ABSPATH')) {
        exit;
    }

    function get_nav_link($endpoint, $label): string{
        if ($endpoint == 'dashboard') {
            $classes = 'nav-item nav-link active';
        } else {
            $classes = 'nav-item nav-link';
        }

        return "<a class='" . $classes . "' data-toggle='tab' href='#" . $endpoint . "' role='tab'>" . esc_html($label) . "</a>";
    }
?>

<div class='container'>
    <div class="nav nav-tabs mb-0" id="myTab" role="tablist">
        <?php foreach (wc_get_account_menu_items() as $endpoint => $label) :
            echo get_nav_link($endpoint, $label);
        endforeach; ?>
    </div>

    <div class="border border-top-0 tab-content" id="myTabContent">
        <div class='tab-pane fade show active' id='dashboard' role='tabpanel'>
            <?php echo get_template_part('includes/section', 'dashboard') ?>
        </div>

        <div class='tab-pane fade' id='orders' role='tabpanel'>
            <?php echo get_template_part('includes/section', 'orders') ?>
        </div>

        <div class='tab-pane fade' id='downloads' role='tabpanel'>
            <?php echo get_template_part('includes/section', 'downloads') ?>
        </div>

        <div class='tab-pane fade' id='edit-address' role='tabpanel'>
            <?php echo get_template_part('includes/section', 'address') ?>
        </div>

        <div class='tab-pane fade show active' id='edit-account' role='tabpanel'>
            <?php echo get_template_part('includes/section', 'account-form') ?>
        </div>

        <div class='tab-pane fade' id='customer-logout' role='tabpanel'>
            <div class='container-fluid py-0'>
                <div class='row col-12 py-2'>
                    <p>Would you like to <a class='text-primary' href='<?php echo wp_logout_url() ?>'>logout</a>?</p>
                </div>
            </div>
        </div>
    </div>
</div>
