<?php
/**
 * Template Name: Cherry Plaza
 */

global $current_user; ?>

<div class='app-header header-shadow bg-primary'>
    <div class='app-header__logo'>
        <a class='my-auto' href=''>
            <?php
                if ( function_exists( 'the_custom_logo' ) ):
                    echo the_custom_logo();
                endif;
            ?>
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
                        <input type='text' name='search' class='search-input' placeholder='Search..' aria-label='search'>
                        <button type='button' class='search-icon'>
                            <i class='fa fw fa-search'></i>
                        </button>
                    </div>
                    <button type='button' class='close btn btn-default text-white'>
                        <i class='fa fw fa-plus'></i>
                    </button>
                </div>
            </form>

            <div class='header-megamenu nav my-auto'>
                <div class='nav-item'>
                    <a href='javascript:void(0);' data-placement='bottom' rel='popover-focus' data-offset='300' data-toggle='popover-custom' class='nav-link text-white' data-original-title='' title=''>
                        <i class='nav-link-icon fa fas fa-th'> </i> Menu
                        <i class='fa fa-angle-down ml-2 opacity-5'></i>
                    </a>
                    <div class='rm-max-width'>
                        <div class='d-none popover-custom-content'>
                            <div class='dropdown-mega-menu'>
                                <div class='grid-menu grid-menu-3col'>
                                    <div class='no-gutters row'>
                                        <!--div class='nav-item-header nav-item'> Overview</div-->
                                        <?php wp_nav_menu(
                                            array(
                                                'theme-location' => 'overview',
                                                'walker' => new Col_Walker_Nav_Menu,
                                                'container' => 'div',
                                                'container_class' => 'col-4',
                                                'container_aria_label' => 'Overview',
                                                'menu_class' => 'nav flex-column'
                                            )
                                        ) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='app-header-right my-auto'>
            <div class='header-dots'>
                <div class='dropdown'>
                    <button type='button' aria-haspopup='true' aria-expanded='false' data-toggle='dropdown' class='p-0 mr-2 btn btn-link'>
                    <span class='icon-wrapper icon-wrapper-alt rounded-circle'>
                        <span class='icon-wrapper-bg bg-danger'></span>
                        <i class='icon text-danger icon-anim-pulse fa fas fa-bell my-auto'></i>
                        <span class='badge badge-dot badge-dot-sm badge-danger'>Notifications</span>
                    </span>
                    </button>
                    <div tabindex='-1' role='menu' aria-hidden='true' class='dropdown-menu-lg rm-pointers dropdown-menu dropdown-menu-right'>
                        <div class='dropdown-menu-header mb-0'>
                            <div class='dropdown-menu-header-inner bg-deep-blue'>
                                <div class='menu-header-image opacity-1'></div>
                                <div class='menu-header-content text-dark'>
                                    <h5 class='menu-header-title'>Notifications</h5>
                                    <h6 class='menu-header-subtitle'>You have <b>21</b> unread messages</h6>
                                </div>
                            </div>
                        </div>
                        <div class='tab-content'>
                            <div class='tab-pane active' id='tab-messages-header' role='tabpanel'>
                                <div class='scroll-area-sm'>
                                    <div class='scrollbar-container ps'>
                                        <div class='p-3'>
                                            <div class='notifications-box'>
                                                <div class='vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column'>
                                                    <div class='vertical-timeline-item dot-danger vertical-timeline-element'>
                                                        <div><span class='vertical-timeline-element-icon bounce-in'></span>
                                                            <div class='vertical-timeline-element-content bounce-in'>
                                                                <h4 class='timeline-title'>All Hands Meeting</h4>
                                                                <span class='vertical-timeline-element-date'></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='vertical-timeline-item dot-warning vertical-timeline-element'>
                                                        <div>
                                                            <span class='vertical-timeline-element-icon bounce-in'></span>
                                                            <div class='vertical-timeline-element-content bounce-in'>
                                                                <p>Yet another one, at <span class='text-success'>15:00 PM</span></p>
                                                                <span class='vertical-timeline-element-date'></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='vertical-timeline-item dot-success vertical-timeline-element'>
                                                        <div>
                                                            <span class='vertical-timeline-element-icon bounce-in'></span>
                                                            <div class='vertical-timeline-element-content bounce-in'>
                                                                <h4 class='timeline-title'>Build the production release
                                                                    <span class='badge badge-danger ml-2'>NEW</span>
                                                                </h4>
                                                                <span class='vertical-timeline-element-date'></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='vertical-timeline-item dot-primary vertical-timeline-element'>
                                                        <div>
                                                            <span class='vertical-timeline-element-icon bounce-in'></span>
                                                            <div class='vertical-timeline-element-content bounce-in'>
                                                                <h4 class='timeline-title'>Something not important</h4>
                                                                <span class='vertical-timeline-element-date'></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='vertical-timeline-item dot-info vertical-timeline-element'>
                                                        <div>
                                                            <span class='vertical-timeline-element-icon bounce-in'></span>
                                                            <div class='vertical-timeline-element-content bounce-in'>
                                                                <h4 class='timeline-title'>This dot has an info state</h4>
                                                                <span class='vertical-timeline-element-date'></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='vertical-timeline-item dot-primary vertical-timeline-element'>
                                                        <div>
                                                            <span class='vertical-timeline-element-icon bounce-in'></span>
                                                            <div class='vertical-timeline-element-content bounce-in'>
                                                                <h4 class='timeline-title'>Something not important</h4>
                                                                <span class='vertical-timeline-element-date'></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='vertical-timeline-item dot-info vertical-timeline-element'>
                                                        <div>
                                                            <span class='vertical-timeline-element-icon bounce-in'></span>
                                                            <div class='vertical-timeline-element-content bounce-in'>
                                                                <h4 class='timeline-title'>This dot has an info state</h4>
                                                                <span class='vertical-timeline-element-date'></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='ps__rail-x' style='left: 0; bottom: 0;'>
                                            <div class='ps__thumb-x' tabindex='0' style='left: 0; width: 0;'></div>
                                        </div>
                                        <div class='ps__rail-y' style='top: 0; right: 0;'>
                                            <div class='ps__thumb-y' tabindex='0' style='top: 0; height: 0;'></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class='nav flex-column'>
                            <li class='nav-item-divider nav-item'></li>
                            <li class='nav-item-btn text-center nav-item'>
                                <button class='btn-shadow btn-wide btn-pill btn btn-focus btn-sm'>View All Notifications</button>
                            </li>
                        </ul>
                    </div>
                </div>


                <?php if ( is_user_logged_in() ) {?>
                <div class='header-btn-lg pr-0'>
                    <div class='widget-content p-0'>
                        <div class='widget-content-wrapper'>
                            <div class='widget-content-left'>
                                <div class='btn-group'>
                                    <a data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' class='p-0 btn'>
                                        <?php echo get_avatar( $current_user->ID, 40 ); ?>
                                        <i class='fa fa-angle-down ml-2 opacity-8'></i>
                                    </a>
                                    <div tabindex='-1' role='menu' aria-hidden='true' class='rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right'>
                                        <div class='dropdown-menu-header'>
                                            <div class='dropdown-menu-header-inner bg-info'>
                                                <div class='menu-header-image opacity-2'></div>
                                                <div class='menu-header-content text-left'>
                                                    <div class='widget-content p-0'>
                                                        <div class='widget-content-wrapper'>
                                                            <div class='widget-content-left mr-3'>
                                                                <?php echo get_avatar( $current_user->ID, 40 ); ?>
                                                            </div>
                                                            <div class='widget-content-left'>
                                                                <div class='widget-heading'><?php echo $current_user->user_login ?></div>
                                                                <div class='widget-subheading opacity-8'>A short profile description</div>
                                                            </div>
                                                            <div class='widget-content-right mr-2'>
                                                                <a class='btn-pill btn-shadow btn-shine btn btn-focus' href='<?php echo wp_logout_url() ?>'>
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
                                                <ul class='nav flex-column'>
                                                    <li class='nav-item-header nav-item'>Activity</li>
                                                    <li class='nav-item'>
                                                        <a href='javascript:void(0);' class='nav-link'>Chat
                                                            <div class='ml-auto badge badge-pill badge-info'>8</div>
                                                        </a>
                                                    </li>
                                                    <li class='nav-item'>
                                                        <a href='<?php echo esc_url( wp_lostpassword_url() ); ?>' class='nav-link'>Recover Password</a>
                                                    </li>
                                                    <li class='nav-item-header nav-item'>My Account
                                                    </li>
                                                    <li class='nav-item'>
                                                        <a href='<?php echo get_edit_profile_url( $current_user->ID ); ?>' class='nav-link'>Profile</a>
                                                    </li>
                                                    <li class='nav-item'>
                                                        <a href='javascript:void(0);' class='nav-link'>Messages
                                                            <div class='ml-auto badge badge-warning'>512</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class='ps__rail-x' style='left: 0; bottom: 0;'>
                                                    <div class='ps__thumb-x' tabindex='0' style='left: 0; width: 0;'></div>
                                                </div>
                                                <div class='ps__rail-y' style='top: 0; right: 0;'>
                                                    <div class='ps__thumb-y' tabindex='0' style='top: 0; height: 0;'></div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class='nav flex-column'>
                                            <li class='nav-item-divider mb-0 nav-item'></li>
                                        </ul>
                                        <div class='grid-menu grid-menu-2col'>
                                            <div class='no-gutters row'>
                                                <div class='col-sm-6'>
                                                    <a class='btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-warning' href=''>
                                                        <i class='btn-icon-wrapper mb-2 fa fas fa-file'></i> Published
                                                    </a>
                                                </div>
                                                <div class='col-sm-6'>
                                                    <a class='btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-secondary' href=''>
                                                        <i class='btn-icon-wrapper mb-2 fa fas fa-pencil-ruler'></i> Drafts
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='widget-content-left  ml-3 header-user-info'>
                                <div class='widget-heading'>
                                    Name
                                </div>
                                <div class='widget-subheading'> VP People Manager</div>
                            </div>
                            <div class='widget-content-right header-user-info ml-3'>
                                <button type='button' class='btn-shadow p-1 btn btn-primary btn-sm show-toastr-example'>
                                    <i class='fa text-white fa-calendar pr-1 pl-1'></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } else { wp_loginout(); } ?>

            </div>
        </div>
    </div>
</div>