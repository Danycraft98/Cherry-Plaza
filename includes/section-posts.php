<div class='app-main__inner'>
    <div class='app-page-title'>
        <div class='page-title-wrapper'>
            <div class='page-title-heading'>
                <div  class='page-title-icon'>
                    <i class='fab fa-home icon-strong-bliss'></i>
                </div>

                <div>
                    Category: <?php single_cat_title(); ?>
                    <div class='page-title-subheading'>
                        <?php
                        // Display optional category description
                         if ( category_description() ) : ?>
                            <?php echo category_description(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='card mb-4'>
        <?php if( have_posts() ): while( have_posts() ): the_post(); ?>
            
            <div class='card-body border-top border-bottom'>
                <div id="content" role="main">
                    <h2>
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <small>
                        <?php the_time('l, F jS, Y') ?> by <?php the_author_posts_link() ?>
                    </small>
                     
                    <div class="entry">
                        <?php the_excerpt(); ?>
                     
                        <p class="postmetadata">
                            <?php comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments closed');
                        ?>
                        </p>
                    </div>
                </div>
            </div>
            
        <?php endwhile;else: ?>

            <div class='card-body border-top border-bottom'>
                <p class='my-2 mx-auto' >Sorry, no posts matched your criteria.</p>
            </div>

        <?php endif; ?>

        <div class='card-footer'>
            <div class='row'>
                <div class='col'>
                    <?php previous_posts_link() ?>
                </div>
                <div class='offset-md-8 col'>
                    <?php next_posts_link() ?>
                </div>
            </div>
            <div class='row'>
                <div class='col text-center'>
                    <?php
                    global $wp_query;

                    $big = 999999999;

                    echo paginate_links( array(
                        'base' => str_replace($big, '%#%', esc_url( get_pagenum_link( $big ) )),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $wp_query->max_num_pages
                    ) );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>