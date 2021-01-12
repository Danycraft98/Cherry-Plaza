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
                            <a href=''>
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='card mb-4'>
        <div class='card-body'>
            <?php if( have_posts() ): while( have_posts() ): the_post(); ?>

                <?php the_content(); ?>

            <?php endwhile; else: endif; ?>
        </div>
    </div>
</div>