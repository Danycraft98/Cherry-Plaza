<?php /* Template Name: Cherry Plaza */ ?>

<div class='app-sidebar sidebar-shadow'>
    <div class='app-sidebar__inner mt-4'>
        <div class='vertical-nav-menu metismenu'>
            <div class='app-sidebar__heading'>
                Cafe Information
            </div>
            <?php wp_nav_menu(
                array(
                    'theme-location' => 'navbar1',
                    'menu_class' => 'nav flex-column'
                )
            ) ?>
        </div>
    </div>
</div>