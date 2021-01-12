<?php
/**
 * Template Name: Comments
 */

if ( post_password_required() )
    return;
?>

<div class='d-flex flex-column comment-section w-100'>
    <div class='bg-light p-4 pb-2'>
        <?php format_comment_form(); ?>
    </div>

    <?php if ( have_comments() ) : ?>

        <div class='p-4 pb-0' <?php comment_class(); ?> id='comment-<?php comment_ID(); ?>'>
            <div class='d-flex flex-row user-info'>
                <h4 class='comments-title'>
                    <?php
                        printf(
                            _nx(
                                'One thought on "%2$s"',
                                '%1$s thoughts on "%2$s"',
                                get_comments_number(),
                                'comments title',
                                'twentythirteen'
                            ),
                            number_format_i18n( get_comments_number() ),
                            '<span>' . get_the_title() . '</span>'
                        );
                    ?>
                </h4>
            </div>

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :?>

                <nav class='navigation comment-navigation' role='navigation'>
                    <h1 class='screen-reader-text section-heading'><?php _e( 'Comment navigation', 'twentythirteen' ); ?></h1>
                    <div class='nav-previous'><?php previous_comments_link( __( '&amp;larr; Older Comments', 'twentythirteen' ) ); ?></div>
                    <div class='nav-next'><?php next_comments_link( __( 'Newer Comments &amp;rarr;', 'twentythirteen' ) ); ?></div>
                </nav>

            <?php endif;

            if ( ! comments_open() && get_comments_number() ) : ?>

                <p class='no-comments'>
                    <?php _e( 'Comments are closed.' , 'twentythirteen' ); ?>
                </p>

            <?php endif;

            if ( have_comments() ) : ?>

                <div class='comment-list'>
                    <?php wp_list_comments('type=comment&callback=format_comment'); ?>
                </div>

            <?php endif; ?>

        </div>

    <?php else: ?>

        <div class='p-4 pb-0' <?php comment_class(); ?> id='comment-<?php comment_ID(); ?>'>
            <div class='d-flex flex-row user-info'>
                <p class='no-comments'>No comment</p>
            </div>
        </div>

    <?php endif; ?>
</div>

 
