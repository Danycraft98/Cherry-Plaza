<?php /* Template Name: Cherry Plaza */ ?>

<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
    <div class='app-main__inner'>
        <div class='app-page-title'>
            <div class='page-title-wrapper'>
                <div class='page-title-heading'>
                    <div  class='page-title-icon'>
                        <i class='fab fa-home icon-strong-bliss'></i>
                    </div>

                    <div>
                        <?php the_title(); ?>
                        <div class='page-title-subheading'>
                            <div class='breadcrumbs'>
                                <?php
                                    if ( is_singular( 'product' ) ):
                                        
                                    else:
                                        the_author_posts_link();
                                    endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='page-title-actions'>
                    <div class='mr-3'>
                        <?php
                            if ( is_singular( 'product' ) ):
                                
                            else:
                        ?>
                        Updated on: <?php the_time('l, F jS, Y');endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class='card mb-4'>
            <div class='card-header my-2' style='display: inline !important;'>
                <div class='d-flex justify-content-between'>
                    <div class='p-2 bd-highlight my-2'>
                        Tags: 
                        <?php $tags = get_the_tags(); if ($tags): foreach($tags as $tag): ?>

                            <a href='<?php echo get_tag_link($tag->term_id); ?>' class='badge badge-primary my-auto'>
                                <?php echo $tag->name; ?>
                            </a>

                        <?php endforeach;else: ?>

                            <p class='badge badge-primary my-auto'>No tags</p>

                        <?php endif; ?>
                    </div>


                    <div class='p-2 bd-highlight my-2'>
                        Categories: 
                        <?php $cats = get_the_category(); if ($cats): foreach($cats as $cat): ?>

                            <a href='<?php echo get_category_link($cat->term_id); ?>' class='badge badge-primary my-auto'>
                                <?php echo $cat->name; ?>
                            </a>

                        <?php endforeach;else: ?>

                            <p class='badge badge-primary my-auto'>No Categories</p>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class='card-body'>
                <?php the_content(); ?>
            </div>
        </div>

        <?php
            if ( is_singular( 'product' ) ):?>
                                    
            <?php else: ?>
                <div class='card mb-4'>
                    <div class='card-header' style='display: inline !important;'>
                        <div class='d-flex justify-content-between'>
                            <div class='p-2 bd-highlight my-2'>
                                <?php previous_post_link() ?>
                            </div>


                            <div class='p-2 bd-highlight my-2'>
                                <?php next_post_link() ?>
                            </div>
                        </div>
                    </div>

                    <div class='card-footer p-0'>
                        <?php comments_template(); ?>
                    </div>
                </div>
            <?php endif; ?>
    </div>
<?php endwhile; else: endif; ?>

        