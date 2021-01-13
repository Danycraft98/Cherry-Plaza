<div class='app-main__inner'>
    <div class='app-page-title'>
        <div class='page-title-wrapper'>
            <div class='page-title-heading'>
                <div class='page-title-icon'>
                    <i class='fab fa-home icon-strong-bliss'></i>
                </div>

                <div>
                    <?php the_title(); ?>
                    <div class='page-title-subheading'>
                        <div class='breadcrumbs'>
                            <?php if (category_description()) :
                                echo category_description();
                            endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id='carousel_id' class='carousel slide bg-primary' data-ride='carousel' style="height:100px">
        <ol class='carousel-indicators'>
            <li data-target='#carousel_id' data-slide-to='0' class='active'></li>
            <li data-target='#carousel_id' data-slide-to='1'></li>
            <li data-target='#carousel_id' data-slide-to='2'></li>
        </ol>
        <div class='carousel-inner'>
            <div class='carousel-item active'>
                <img class='d-block w-100' src='' alt='First slide'>
            </div>
            <div class='carousel-item'>
                <img class='d-block w-100' src='' alt='Second slide'>
            </div>
            <div class='carousel-item'>
                <img class='d-block w-100' src='' alt='Third slide'>
            </div>
        </div>
        <a class='carousel-control-prev' href='#carousel_id' role='button' data-slide='prev'>
            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
            <span class='sr-only'>Previous</span>
        </a>
        <a class='carousel-control-next' href='#carousel_id' role='button' data-slide='next'>
            <span class='carousel-control-next-icon' aria-hidden='true'></span>
            <span class='sr-only'>Next</span>
        </a>
    </div>


    <?php if (have_posts()): while (have_posts()): the_post(); ?>

        <?php the_content(); ?>

    <?php endwhile; endif; ?>

</div>

