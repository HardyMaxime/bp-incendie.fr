<?php get_header(); ?>
    <header class="section page-header section-dark container-fluid">
        <hgroup class="heading">
            <h1 class="heading-title page-heading"><?= get_the_title(); ?></h1>
        </hgroup>
    </header>
    <section class="page-contact container-fluid section-arrow bg-primary">
        <div class="page-content">
            <?= the_content(); ?>
        </div>
    </section>
    <?php get_template_part("parts/footer/banner"); ?>
<?php get_footer(); ?>