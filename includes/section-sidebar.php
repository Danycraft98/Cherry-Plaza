<?php /* Template Name: Cherry Plaza */ ?>

<div class='app-sidebar'>
    <div class='app-sidebar__inner mt-4'>
        <div class='vertical-nav-menu metismenu'>
            <div class='app-sidebar__heading'>
                Categories
            </div>
            <?php if ( has_nav_menu( 'sidebar' ) ) {
                wp_nav_menu(
                    array(
                        'theme-location' => 'sidebar',
                        'menu_class' => 'nav flex-column',
                        'depth' => 1, // 1 = no dropdowns, 2 = with dropdowns.
                        'container' => 'div',
                    )

                );
            } ?>
        </div>
    </div>
</div>