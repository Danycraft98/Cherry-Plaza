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
    wp_register_style('fontawesome-all', 'https://pro.fontawesome.com/releases/v5.10.0/css/all.css', null, true, 'all');
    wp_enqueue_style('fontawesome-all');

    wp_register_style('fontawesome-duotone', 'https://pro.fontawesome.com/releases/v5.10.0/css/duotone.css', null, true, 'all');
    wp_enqueue_style('fontawesome-duotone');

    wp_register_style('fontawesome', 'https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css', null, true, 'all');
    wp_enqueue_style('fontawesome');


    // Custom Stylesheets
    //<link rel='shortcut icon' href='static/images/favicon.ico'/>
}

add_action('wp_enqueue_scripts', 'load_css');


// Logo Setup
function cherry_plaza_logo_setup() {
    $defaults = array(
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
        'header-text' => array('site-title', 'site-description'),
        'unlink-homepage-logo' => true,
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'cherry_plaza_logo_setup');


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

// Redirect to login page.
function redirect_login_page($args = array())
{
    $defaults = array(
        'echo' => true,
        // Default 'redirect' value takes the user back to the request URI.
        'redirect' => (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
        'form_id' => 'loginform',
        'label_username' => __('Username or Email Address'),
        'label_password' => __('Password'),
        'label_remember' => __('Remember Me'),
        'label_log_in' => __('Log In'),
        'id_username' => 'user_login',
        'id_password' => 'user_pass',
        'id_remember' => 'rememberme',
        'id_submit' => 'wp-submit',
        'remember' => true,
        'value_username' => '',
        // Set 'value_remember' to true to default the "Remember me" checkbox to checked.
        'value_remember' => false,
    );

    $args = wp_parse_args($args, apply_filters('login_form_defaults', $defaults));

    $login_form_top = apply_filters('login_form_top', '', $args);
    $login_form_middle = apply_filters('login_form_middle', '', $args);
    $login_form_bottom = apply_filters('login_form_bottom', '', $args);

    $login_page = home_url('/login/');
    if ($username == "" || $password == "") {
        if ($args['echo']) {
            echo get_template_part('login');
        } else {
            return $form;
        }
        exit;
    }
    return null;
}

//add_action('init', 'redirect_login_page');


// Login Fail
function login_failed()
{
    $login_page = home_url('/login/');
    wp_redirect($login_page . '?login=failed');
    exit;
}

//add_action( 'wp_login_failed', 'login_failed' );


// Verify Login
function verify_username_password($user, $username, $password) {
    $login_page = home_url('/login/');
    if ($username == "" || $password == "") {
        wp_redirect($login_page . "?login=empty");
        exit;
    }
}
//add_filter( 'authenticate', 'verify_username_password', 1, 3);


function logout_url($redirect = '') {
    $args = array();
    if (!empty($redirect)) {
        $args['redirect_to'] = urlencode($redirect);
    }

    $logout_url = add_query_arg($args, site_url('wp-login.php?action=logout', 'login'));
    $logout_url = wp_nonce_url($logout_url, 'log-out');

    return apply_filters('logout_url', $logout_url, $redirect);
}

//add_action('wp_logout','logout_url');


// Get User Display Name
function get_name($current_user): string
{
    if ($current_user->user_firstname && $current_user->user_lastname) {
        return implode(' ', [$current_user->user_firstname, $current_user->user_lastname]);
    } elseif ($current_user->user_firstname) {
        return $current_user->user_firstname;
    } else {
        return $current_user->user_login;
    }
}


// Menu Configuration ------------------------------------------------------------

// Theme Options
add_theme_support('menus');


//Menus
register_nav_menus(
    array(

        'navbar' => 'Navbar Location',
        'sidebar' => 'Sidebar Location',
        'social' => 'Social Location',

    )
);


function add_link_atts($atts)
{
    $atts['class'] = 'nav-item nav-link py-0 text-secondary';
    return $atts;
}

add_filter('nav_menu_link_attributes', 'add_link_atts');


// Comment Configuration ------------------------------------------------------------

// Comment Form Format
function format_comment_form($args = array(), $post_id = null)
{ ?>
    <form action='http://localhost:8080/wordpress/wp-comments-post.php' method='post' id='commentform'
          class="comment-form">
        <div class="d-flex flex-row align-items-start">
            <?php echo get_avatar($comment, 40); ?>
            <textarea aria-labelledby='comment' class='form-control ml-1 shadow-none textarea' id='comment' name='comment' aria-label='comment'></textarea>
        </div>
        <div class="mt-2 text-right">
            <button class="btn btn-primary btn-sm shadow-none' type='submit">Post comment</button>
            <button class="btn btn-outline-primary btn-sm ml-1 shadow-none' type='reset">Cancel</button>
        </div>
    </form>

<?php }


// Comment Format
function format_comment($comment)
{
    $GLOBALS['comment'] = $comment; ?>

    <div <?php comment_class(); ?> id='comment-<?php comment_ID(); ?>' class='px-4 py-2'>
        <div class='d-flex flex-row user-info'>
            <?php echo get_avatar($comment, 40); ?>
            <div class='d-flex flex-column justify-content-start ml-2'>
                <span class='d-block font-weight-bold name'>
                    <?php comment_author_link(); ?>
                </span>
                <span class='date text-black-50'>
                    Shared publicly - <? printf(
                        "<a href='%1$s'><time datetime='%2$s'>%3$s</time></a>",
                        esc_url(get_comment_link($comment->comment_ID)),
                        get_comment_time('c'),

                        sprintf(__('%1$s at %2$s', 'twentytwelve'), get_comment_date(), get_comment_time())
                    ); ?>
                </span>
            </div>
        </div>
        <div class='mt-2'>
            <?php if ('0' == $comment->comment_approved) : ?>
                <p class='comment-text mb-0 comment-awaiting-moderation'><?php _e('Your comment is awaiting moderation.', 'twentytwelve'); ?></p>
            <?php endif; ?>
            <p class='comment-text mb-0'>
                <?php comment_text(); ?>
            </p>
        </div>

        <div class='d-flex flex-row user-info'>
            <?php echo get_avatar($comment, 40); ?>
            <div class='d-flex flex-column justify-content-start ml-2'>
                <span class='d-block font-weight-bold name'>
                    <?php comment_author_link(); ?>
                </span>
                <span class='date text-black-50'>
                    Shared publicly - <? printf(
                        "<a href='%1$s'><time datetime='%2$s'>%3$s</time></a>",
                        esc_url(get_comment_link($comment->comment_ID)),
                        get_comment_time('c'),
                        sprintf(__('%1$s at %2$s', 'twentytwelve'), get_comment_date(), get_comment_time())
                    ); ?>
                </span>
            </div>
        </div>
        <div class='mt-2'>
            <?php if ('0' == $comment->comment_approved) : ?>
                <p class='comment-text mb-0 comment-awaiting-moderation'><?php _e('Your comment is awaiting moderation.', 'twentytwelve'); ?></p>
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
add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
    add_theme_support('Woocommerce');
}


// Number of Products per Row
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
    function loop_columns(): int
    {
        return 3; // 3 products per row
    }
}


// Woocommerce Product Loop
function loop_products() {
    global $product;

    $link = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product);
    echo '<a href="' . esc_url($link) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
    echo woocommerce_get_product_thumbnail();
    echo '<h2 class="' . esc_attr(apply_filters('woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title')) . '">' . get_the_title() . '</h2>';
    wc_get_template('loop/rating.php');
    echo '</a>';
}
add_action('shop_loop_item', 'loop_products', 10, 2);

function form_field($key, $args, $value = null)
{
    $defaults = array(
        'type' => 'text',
        'label' => '',
        'description' => '',
        'placeholder' => '',
        'maxlength' => false,
        'required' => false,
        'autocomplete' => false,
        'id' => $key,
        'class' => array(),
        'label_class' => array(),
        'input_class' => array(),
        'return' => false,
        'options' => array(),
        'custom_attributes' => array(),
        'validate' => array(),
        'default' => '',
        'autofocus' => '',
        'priority' => '',
    );

    $args = wp_parse_args($args, $defaults);
    $args = apply_filters('woocommerce_form_field_args', $args, $key, $value);

    if ($args['required']) {
        $args['class'][] = 'validate-required';
        $required = '&nbsp;<abbr class="required" title="' . esc_attr__('required', 'woocommerce') . '">*</abbr>';
    } else {
        $required = '&nbsp;<span class="optional">(' . esc_html__('optional', 'woocommerce') . ')</span>';
    }

    if (is_string($args['label_class'])) {
        $args['label_class'] = array('form-control', $args['label_class']);
    }

    if (is_null($value)) {
        $value = $args['default'];
    }

    // Custom attribute handling.
    $custom_attributes = array();
    $args['custom_attributes'] = array_filter((array)$args['custom_attributes'], 'strlen');

    if ($args['maxlength']) {
        $args['custom_attributes']['maxlength'] = absint($args['maxlength']);
    }

    if (!empty($args['autocomplete'])) {
        $args['custom_attributes']['autocomplete'] = $args['autocomplete'];
    }

    if (true === $args['autofocus']) {
        $args['custom_attributes']['autofocus'] = 'autofocus';
    }

    if ($args['description']) {
        $args['custom_attributes']['aria-describedby'] = $args['id'] . '-description';
    }

    if (!empty($args['custom_attributes']) && is_array($args['custom_attributes'])) {
        foreach ($args['custom_attributes'] as $attribute => $attribute_value) {
            $custom_attributes[] = esc_attr($attribute) . '="' . esc_attr($attribute_value) . '"';
        }
    }

    if (!empty($args['validate'])) {
        foreach ($args['validate'] as $validate) {
            $args['class'][] = 'validate-' . $validate;
        }
    }

    $field = '';
    $label_id = $args['id'];
    $sort = $args['priority'] ? $args['priority'] : '';
    $field_container = '<p class="form-row %1$s" id="%2$s" data-priority="' . esc_attr($sort) . '">%3$s</p>';

    switch ($args['type']) {
        case 'country':
            $countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

            if (1 === count($countries)) {

                $field .= '<strong>' . current(array_values($countries)) . '</strong>';

                $field .= '<input type="hidden" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" value="' . current(array_keys($countries)) . '" ' . implode(' ', $custom_attributes) . ' class="form-control country_to_state" readonly="readonly" />';

            } else {

                $field = '<select name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" class="country_to_state country_select ' . esc_attr(implode(' ', $args['input_class'])) . '" ' . implode(' ', $custom_attributes) . '><option value="default">' . esc_html__('Select a country / region&hellip;', 'woocommerce') . '</option>';

                foreach ($countries as $ckey => $cvalue) {
                    $field .= '<option value="' . esc_attr($ckey) . '" ' . selected($value, $ckey, false) . '>' . esc_html($cvalue) . '</option>';
                }

                $field .= '</select>';

                $field .= '<noscript><button type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__('Update country / region', 'woocommerce') . '">' . esc_html__('Update country / region', 'woocommerce') . '</button></noscript>';

            }

            break;
        case 'state':
            /* Get country this state field is representing */
            $for_country = isset($args['country']) ? $args['country'] : WC()->checkout->get_value('billing_state' === $key ? 'billing_country' : 'shipping_country');
            $states = WC()->countries->get_states($for_country);

            if (is_array($states) && empty($states)) {

                $field_container = '<p class="form-row %1$s" id="%2$s" style="display: none">%3$s</p>';

                $field .= '<input type="hidden" class="hidden" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" value="" ' . implode(' ', $custom_attributes) . ' placeholder="' . esc_attr($args['placeholder']) . '" readonly="readonly" data-input-classes="' . esc_attr(implode(' ', $args['input_class'])) . '"/>';

            } elseif (!is_null($for_country) && is_array($states)) {

                $field .= '<select name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" class="state_select ' . esc_attr(implode(' ', $args['input_class'])) . '" ' . implode(' ', $custom_attributes) . ' data-placeholder="' . esc_attr($args['placeholder'] ? $args['placeholder'] : esc_html__('Select an option&hellip;', 'woocommerce')) . '"  data-input-classes="' . esc_attr(implode(' ', $args['input_class'])) . '">
						<option value="">' . esc_html__('Select an option&hellip;', 'woocommerce') . '</option>';

                foreach ($states as $ckey => $cvalue) {
                    $field .= '<option value="' . esc_attr($ckey) . '" ' . selected($value, $ckey, false) . '>' . esc_html($cvalue) . '</option>';
                }

                $field .= '</select>';

            } else {

                $field .= '<input type="text" class="input-text ' . esc_attr(implode(' ', $args['input_class'])) . '" value="' . esc_attr($value) . '"  placeholder="' . esc_attr($args['placeholder']) . '" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" ' . implode(' ', $custom_attributes) . ' data-input-classes="' . esc_attr(implode(' ', $args['input_class'])) . '"/>';

            }

            break;
        case 'textarea':
            $field .= '<textarea name="' . esc_attr($key) . '" class="input-text ' . esc_attr(implode(' ', $args['input_class'])) . '" id="' . esc_attr($args['id']) . '" placeholder="' . esc_attr($args['placeholder']) . '" ' . (empty($args['custom_attributes']['rows']) ? ' rows="2"' : '') . (empty($args['custom_attributes']['cols']) ? ' cols="5"' : '') . implode(' ', $custom_attributes) . '>' . esc_textarea($value) . '</textarea>';

            break;
        case 'checkbox':
            $field = '<label class="checkbox ' . implode(' ', $args['label_class']) . '" ' . implode(' ', $custom_attributes) . '>
						<input type="' . esc_attr($args['type']) . '" class="input-checkbox ' . esc_attr(implode(' ', $args['input_class'])) . '" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" value="1" ' . checked($value, 1, false) . ' /> ' . $args['label'] . $required . '</label>';

            break;
        case 'text':
        case 'password':
        case 'datetime':
        case 'datetime-local':
        case 'date':
        case 'month':
        case 'time':
        case 'week':
        case 'number':
        case 'email':
        case 'url':
        case 'tel':
            $field .= '<input type="' . esc_attr($args['type']) . '" class="input-text ' . esc_attr(implode(' ', $args['input_class'])) . '" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" placeholder="' . esc_attr($args['placeholder']) . '"  value="' . esc_attr($value) . '" ' . implode(' ', $custom_attributes) . ' />';

            break;
        case 'hidden':
            $field .= '<input type="' . esc_attr($args['type']) . '" class="input-hidden ' . esc_attr(implode(' ', $args['input_class'])) . '" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" value="' . esc_attr($value) . '" ' . implode(' ', $custom_attributes) . ' />';

            break;
        case 'select':
            $field = '';
            $options = '';

            if (!empty($args['options'])) {
                foreach ($args['options'] as $option_key => $option_text) {
                    if ('' === $option_key) {
                        // If we have a blank option, select2 needs a placeholder.
                        if (empty($args['placeholder'])) {
                            $args['placeholder'] = $option_text ? $option_text : __('Choose an option', 'woocommerce');
                        }
                        $custom_attributes[] = 'data-allow_clear="true"';
                    }
                    $options .= '<option value="' . esc_attr($option_key) . '" ' . selected($value, $option_key, false) . '>' . esc_html($option_text) . '</option>';
                }

                $field .= '<select name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" class="select ' . esc_attr(implode(' ', $args['input_class'])) . '" ' . implode(' ', $custom_attributes) . ' data-placeholder="' . esc_attr($args['placeholder']) . '">
							' . $options . '
						</select>';
            }

            break;
        case 'radio':
            $label_id .= '_' . current(array_keys($args['options']));

            if (!empty($args['options'])) {
                foreach ($args['options'] as $option_key => $option_text) {
                    $field .= '<input type="radio" class="input-radio ' . esc_attr(implode(' ', $args['input_class'])) . '" value="' . esc_attr($option_key) . '" name="' . esc_attr($key) . '" ' . implode(' ', $custom_attributes) . ' id="' . esc_attr($args['id']) . '_' . esc_attr($option_key) . '"' . checked($value, $option_key, false) . ' />';
                    $field .= '<label for="' . esc_attr($args['id']) . '_' . esc_attr($option_key) . '" class="radio ' . implode(' ', $args['label_class']) . '">' . esc_html($option_text) . '</label>';
                }
            }

            break;
    }

    if (!empty($field)) {
        $field_html = '';

        if ($args['label'] && 'checkbox' !== $args['type']) {
            $field_html .= '<label for="' . esc_attr($label_id) . '" class="' . esc_attr(implode(' ', $args['label_class'])) . '">' . wp_kses_post($args['label']) . $required . '</label>';
        }

        $field_html .= '<span class="woocommerce-input-wrapper">' . $field;

        if ($args['description']) {
            $field_html .= '<span class="description" id="' . esc_attr($args['id']) . '-description" aria-hidden="true">' . wp_kses_post($args['description']) . '</span>';
        }

        $field_html .= '</span>';

        $container_class = esc_attr(implode(' ', $args['class']));
        $container_id = esc_attr($args['id']) . '_field';
        $field = sprintf($field_container, $container_class, $container_id, $field_html);
    }

    /**
     * Filter by type.
     */
    $field = apply_filters('woocommerce_form_field_' . $args['type'], $field, $key, $args, $value);

    /**
     * General filter on form fields.
     *
     * @since 3.4.0
     */
    $field = apply_filters('woocommerce_form_field', $field, $key, $args, $value);

    if ($args['return']) {
        return $field;
    } else {
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo $field;
    }
    return null;
}

add_action('shop_form_field', 'form_field');

// Single Product
function single_product()
{
    wc_get_template('single-product/title.php');
    if (post_type_supports('product', 'comments')) {
        wc_get_template('single-product/rating.php');
    }
    wc_get_template('single-product/price.php');
    wc_get_template('single-product/short-description.php');
    wc_get_template('single-product/meta.php');
    wc_get_template('single-product/share.php');

}

add_action('single_product_summary', 'single_product', 5);


?>