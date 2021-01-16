<?php
    /**
     * Template Name: Cherry Plaza
     */

    global $current_user;
?>

<div class='app-header bg-primary'>
    <div class='app-header__logo'>
        <a class='my-auto navbar-brand' href='<?php echo get_home_url() ?>'>
            <?php if (function_exists('the_custom_logo')):
                the_custom_logo();
                echo "<h2 class='text-white my-auto'>" . get_bloginfo() . "</h2>";
            endif; ?>
        </a>
    </div>

    <div class='app-header__mobile-menu'>
        <div>
            <button type='button' class='hamburger hamburger--elastic mobile-toggle-nav'>
                <span class='hamburger-box'>
                    <span class='hamburger-inner'></span>
                </span>
            </button>
        </div>
    </div>

    <div class='app-header__menu'>
        <span>
            <button type='button' class='btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav'>
                <span class='btn-icon-wrapper'>
                    <i class='fa fa-ellipsis-v fa-w-6'></i>
                </span>
            </button>
        </span>
    </div>

    <div class='app-header__content'>
        <div class='app-header-left'>
            <form method='POST' action=''>
                <div class='search-wrapper'>
                    <div class='input-holder'>
                        <input type='text' name='search' class='search-input' placeholder='Search..'
                               aria-label='search'>
                        <button type='button' class='search-icon'>
                            <i class='fa fw fa-search'></i>
                        </button>
                    </div>
                    <button type='button' class='close btn btn-default text-white h4'>
                        <i class='fa fw fa-plus'></i>+
                    </button>
                </div>
            </form>

            <?php if (has_nav_menu('navbar')) {
                wp_nav_menu(
                    array(
                        'theme-location' => 'navbar',
                        'depth' => 1, // 1 = no dropdowns, 2 = with dropdowns.
                        'container' => 'div',
                        'menu_class' => 'nav my-auto'
                    )
                );
            } ?>
        </div>

        <div class='app-header-right'>
            <?php if (is_user_logged_in()) { ?>
                <div class='nav my-auto'>
                    <a class='nav-item nav-link py-0 text-secondary' data-toggle='dropdown' class='btn p-0 d-flex'
                       aria-haspopup='true' aria-expanded='false'>
                        <?php echo get_avatar($current_user->ID, 40); ?>
                        <div class='ml-2 my-2'>
                            Hello,<br/><?php echo get_name($current_user); ?>
                            <i class='fa fa-angle-down ml-2 opacity-8'></i>
                        </div>
                    </a>

                    <div tabindex='-1' role='menu' aria-hidden='true'
                         class='rm-pointers dropdown-menu'>
                        <div class='dropdown-menu-header'>
                            <div class='dropdown-menu-header-inner bg-info'>
                                <div class='menu-header-image opacity-2'></div>
                                <div class='menu-header-content text-left'>
                                    <div class='widget-content p-0'>
                                        <div class='widget-content-wrapper'>
                                            <div class='widget-content-left mr-3'>
                                                <?php echo get_avatar($current_user->ID, 40); ?>
                                            </div>
                                            <div class='widget-content-left'>
                                                <div class='widget-heading'>
                                                    <?php echo get_name($current_user); ?>
                                                </div>
                                                <div class='widget-subheading opacity-8'>Status: ?
                                                </div>
                                            </div>
                                            <div class='widget-content-right mr-2'>
                                                <a class='btn-pill btn-shadow btn-shine btn btn-focus'
                                                   href='<?php echo wp_logout_url() ?>'>
                                                    <i class='fa fas fa-power-off'></i> Logout
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class='scroll-area-xs' style='height: 150px;'>
                            <div class='scrollbar-container ps'>
                                <div class='nav flex-column'>
                                    <div class='nav-item-header nav-item'>
                                        Activity
                                    </div>

                                    <div class='nav flex-row'>
                                        <a class='nav-item nav-link text-secondary' href=''>
                                            Return & Orders
                                            <div class='ml-auto badge badge-pill badge-info'>8</div>
                                        </a>

                                        <a class='nav-item nav-link text-secondary'
                                           href='<?php echo wc_get_cart_url(); ?>'>
                                            <i class='fa fas fa-shopping-cart'></i>Cart
                                            <div class='ml-auto badge badge-pill badge-info'>8</div>
                                        </a>
                                    </div>

                                    <div class="dropdown-divider"></div>

                                    <div class='nav-item-header nav-item'>
                                        My Account
                                    </div>

                                    <div class='nav flex-row'>
                                        <a class='nav-item nav-link text-secondary'
                                           href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"
                                           title="<?php _e('My Account', ''); ?>">
                                            Profile
                                        </a>

                                        <a class='nav-item nav-link text-secondary'
                                           href='<?php echo esc_url(wp_lostpassword_url()); ?>'>
                                            Recover Password
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else {
                wp_loginout();
            } ?>
        </div>
    </div>
</div>