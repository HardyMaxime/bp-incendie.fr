<?php get_header(); ?>
    <div class="section-page container">
        <section class="section container flex-grow">
            <?php get_template_part('parts/page/heading', null, array(
                "title" => DefaultController::getPageHeading(get_the_ID(), 'title'),
                "description" => DefaultController::getPageHeading(get_the_ID(), 'description'),
                "class_title" => ['full-title'],
                "class_subtitle" => ["section-subtitle-full"],
            )); ?>
            <div class="section-content mt-5">
                <?php the_content(); ?>
            </div>
        </section>
    </div>
<?php get_footer(); ?>