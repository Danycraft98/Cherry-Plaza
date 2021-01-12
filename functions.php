<?php
/**
 * Template Name: Cherry Plaza
 */


// Stylesheets Configuration ------------------------------------------------------------
function load_css() {

    // Bootstrap Stylesheets
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('bootstrap');

    wp_register_style('main', get_template_directory_uri() . '/css/main.min.css', array(), false, 'all');
    wp_enqueue_style('main');


    // Font Awesome Stylesheets
    wp_register_style('fontawesome-all', 'https://pro.fontawesome.com/releases/v5.10.0/css/all.css',null, null, true, 'all');
    wp_enqueue_style('fontawesome-all');
    
    wp_register_style('fontawesome-duotone', 'https://pro.fontawesome.com/releases/v5.10.0/css/duotone.css',null, null, true, 'all');
    wp_enqueue_style('fontawesome-duotone');

    wp_register_style('fontawesome', 'https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css',null, null, true, 'all');
    wp_enqueue_style('fontawesome');


	// Custom Stylesheets
	//<link rel='shortcut icon' href='static/images/favicon.ico'/>  
}
add_action('wp_enqueue_scripts', 'load_css');


// Logo Setup
function cherry_plaza_logo_setup() {
    $defaults = array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
    'unlink-homepage-logo' => true, 
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'cherry_plaza_logo_setup' );


// Scripts Configuration ------------------------------------------------------------
function load_js() {

    // Bootstrap Javascript
    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js', array(), false, true);
    wp_enqueue_script('bootstrap');

    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', array(), false, true);
    wp_enqueue_script('jquery');

    wp_register_script('main', get_template_directory_uri() . '/js/main.js', array(), false, true);
    wp_enqueue_script('main');

}
add_action('wp_enqueue_scripts', 'load_js');


// Account Configuration ------------------------------------------------------------

//
function redirect_login_page( $args = array() ) {
    $defaults = array(
        'echo'           => true,
        // Default 'redirect' value takes the user back to the request URI.
        'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
        'form_id'        => 'loginform',
        'label_username' => __( 'Username or Email Address' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in'   => __( 'Log In' ),
        'id_username'    => 'user_login',
        'id_password'    => 'user_pass',
        'id_remember'    => 'rememberme',
        'id_submit'      => 'wp-submit',
        'remember'       => true,
        'value_username' => '',
        // Set 'value_remember' to true to default the "Remember me" checkbox to checked.
        'value_remember' => false,
    );


    $args = wp_parse_args( $args, apply_filters( 'login_form_defaults', $defaults ) );
    
    $login_form_top = apply_filters( 'login_form_top', '', $args );
    $login_form_middle = apply_filters( 'login_form_middle', '', $args );
    $login_form_bottom = apply_filters( 'login_form_bottom', '', $args );
    
    $login_page  = home_url( '/login/' );
    if( $username == "" || $password == "" ) {
        if ( $args['echo'] ) {
            echo get_template_part('login');
        } else {
            return $form;
        }
        exit;
    }
}
//add_action('init', 'redirect_login_page');



// Login Fail
function login_failed() {
  $login_page  = home_url( '/login/' );
  wp_redirect( $login_page . '?login=failed' );
  exit;
}
//add_action( 'wp_login_failed', 'login_failed' );


// Verify Login
function verify_username_password( $user, $username, $password ) {
  $login_page  = home_url( '/login/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "?login=empty" );
        exit;
    }
}
//add_filter( 'authenticate', 'verify_username_password', 1, 3);




function logout_url( $redirect = '' ) {
    $args = array();
    if ( ! empty( $redirect ) ) {
        $args['redirect_to'] = urlencode( $redirect );
    }
 
    $logout_url = add_query_arg( $args, site_url( 'wp-login.php?action=logout', 'login' ) );
    $logout_url = wp_nonce_url( $logout_url, 'log-out' );

    return apply_filters( 'logout_url', $logout_url, $redirect );
}
//add_action('wp_logout','logout_url');


// Menu Configuration ------------------------------------------------------------

// Theme Options
add_theme_support('menus');


//Menus
register_nav_menus(

    array(

        'overview' => 'Overview Location',
        'sidebar' => 'Sidebar Location',
        'social' => 'Social Location',

    )

);


// Navbar Menu Walker Class
class Col_Walker_Nav_Menu extends Walker_Nav_Menu {

    var $current_menu = null;
    var $break_point = null;

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

        global $wp_query;

        if( !isset( $this->current_menu ) )
            $this->current_menu = wp_get_nav_menu_object( $args->menu );

        if( !isset( $this->break_point ) )
            $this->break_point = ceil( $this->current_menu->count / 2 ) + 1;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        if( $this->break_point == $item->menu_order )
            $output .= $indent . '</li></ul></div><div class="col-4"><ul class="nav flex-column"><li' . $id . $value . $class_names .'>';
        else
            $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}


// Comment Configuration ------------------------------------------------------------

// Comment Form Format
function format_comment_form( $args = array(), $post_id = null ) { ?>

    <form action='http://localhost:8080/wordpress/wp-comments-post.php' method='post' id='commentform' class="comment-form">
        <div class="d-flex flex-row align-items-start">
            <?php echo get_avatar( $comment, 40 ); ?>
            <textarea class="form-control ml-1 shadow-none textarea' id='comment' name='comment' aria-label='comment"></textarea>
        </div>
        <div class="mt-2 text-right">
            <button class="btn btn-primary btn-sm shadow-none' type='submit">Post comment</button>
            <button class="btn btn-outline-primary btn-sm ml-1 shadow-none' type='reset">Cancel</button>
        </div>
    </form>

<?php }


// Comment Format
function format_comment($comment) {
    $GLOBALS['comment'] = $comment; ?>

    <div <?php comment_class(); ?> id='comment-<?php comment_ID(); ?>' class='px-4 py-2'>
        <div class='d-flex flex-row user-info'>
            <?php echo get_avatar( $comment, 40 ); ?>
            <div class='d-flex flex-column justify-content-start ml-2'>
                <span class='d-block font-weight-bold name'>
                    <?php comment_author_link(); ?>
                </span>
                <span class='date text-black-50'>
                    Shared publicly - <? printf(
                        '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                        esc_url( get_comment_link( $comment->comment_ID ) ),
                        get_comment_time( 'c' ),

                        sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
                    ); ?>
                </span>
            </div>
        </div>
        <div class='mt-2'>
            <?php if ( '0' == $comment->comment_approved ) : ?>
                <p class='comment-text mb-0 comment-awaiting-moderation'><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
            <?php endif; ?>
            <p class='comment-text mb-0'>
                <?php comment_text(); ?>
            </p>
        </div>

        <div class='d-flex flex-row user-info'>
            <?php echo get_avatar( $comment, 40 ); ?>
            <div class='d-flex flex-column justify-content-start ml-2'>
                <span class='d-block font-weight-bold name'>
                    <?php comment_author_link(); ?>
                </span>
                <span class='date text-black-50'>
                    Shared publicly - <? printf(
                        '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                        esc_url( get_comment_link( $comment->comment_ID ) ),
                        get_comment_time( 'c' ),
                        sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
                    ); ?>
                </span>
            </div>
        </div>
        <div class='mt-2'>
            <?php if ( '0' == $comment->comment_approved ) : ?>
                <p class='comment-text mb-0 comment-awaiting-moderation'><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
            <?php endif; ?>
            <p class='comment-text mb-0'>
                <?php comment_text(); ?>
            </p>
        </div>

        <div class='d-flex flex-row user-info'>
                <div class='edit p-2 cursor'>
                    <?php edit_comment_link(
                        '<i class="fa fas fa-pencil"></i><span class="ml-1">Edit<span class="ml-1">'
                    ); ?>
                </div>

                <a class='like p-2 cursor' href=''>
                    <i class='fa fas fa-thumbs-up'></i><span class='ml-1'>Like</span>
                </a>
                
                <div class='p-2 cursor'>
                    <i class='fa fas fa-comments'></i><span class='ml-1'>Reply</span>
                    <?php comment_reply_link(
                        '<i class="fa fas fa-comments"></i><span class="ml-1">Reply<span class="ml-1">'
                    ); ?>
                </div>
                
                <a class='like p-2 cursor' href=''>
                    <i class='fa fas fa-share'></i><span class='ml-1'>Share</span>
                </a>
            </div>
    </div>
<?php }


// Woocommerce Configuration ------------------------------------------------------------

// Woocommerce Theme Initialize
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {

    add_theme_support( 'Woocommerce' );

}


// Woocommerce Pre-Link Loop
function loop_products() {
    global $product;
    $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
    echo '<a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
    echo woocommerce_get_product_thumbnail();
    echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h2>';
    wc_get_template( 'loop/rating.php' );
    echo '</a>';

}
add_action( 'shop_loop_item', 'loop_products', 10, 2 ); 


// Single Product
function single_product() {
    wc_get_template( 'single-product/title.php' );
    if ( post_type_supports( 'product', 'comments' ) ) {
        wc_get_template( 'single-product/rating.php' );
    }
    wc_get_template( 'single-product/price.php' );
    wc_get_template( 'single-product/short-description.php' );
    wc_get_template( 'single-product/meta.php' );
    wc_get_template( 'single-product/share.php' );

}
add_action( 'single_product_summary', 'single_product', 5 );









?>