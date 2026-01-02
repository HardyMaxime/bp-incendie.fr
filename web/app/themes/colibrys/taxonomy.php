<?php get_header(); 
$page = get_queried_object();
?>
    <header class="section page-header section-dark container-fluid">
        <hgroup class="heading">
            <h1 class="heading-title page-heading"><?= esc_html($page->name); ?></h1>
        </hgroup>
    </header>
    <section class="section section-dark page-content container-fluid">
        <div class="posttype-content">
            <?php $index=0; while(have_posts()): the_post(); ?>
            <div class="posttype-content-inner reveal section-arrow bottom-left bg-primary align-top">
                <div class="posttype-content-item">
                    <h2 class="posttype-content-item-title slide-out-in reveal-<?= esc_attr($index); ?>"><?= get_the_title(); ?></h2>
                    <div class="posttype-content-item-text slide-out-in reveal-<?= esc_attr($index); ?>">
                        <?= Theme()->controller("fields")->get_excerpt(get_the_id()); ?>
                    </div>
                    <a href="<?= get_permalink(); ?>" class="btn mt-4">En savoir plus</a>
                </div>
            </div>
        <?php $index++; endwhile; ?>
    </div>
    </section>
<?php get_footer(); ?>