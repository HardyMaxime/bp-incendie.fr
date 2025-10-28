<?php get_header(); 
    $post_id = get_queried_object_id();
    $services = get_the_terms( $post_id, 'service' );
    $classes = (empty($services) ? " no-grid" : "");
?>
    <header class="section page-header section-dark container-fluid">
        <hgroup class="heading">
            <h1 class="heading-title page-heading"><?= get_the_title(); ?></h1>
        </hgroup>
    </header>
    <section class="section section-dark page-content posttype-content<?= esc_attr($classes); ?> container-fluid">
        <div class="page-content-text">
            <?= get_the_content(); ?>
        </div>
        <?php get_template_part("parts/posttype/service", null, ['services' => $services]); ?>
    </section>
    <?php get_template_part("parts/page/gallery"); ?>
<?php get_footer(); ?>