<?php get_header(); 
    $post_id = get_queried_object_id();
    $services = get_the_terms( $post_id, 'service' );
?>
    <header class="section page-header section-dark container-fluid">
        <hgroup class="heading reveal">
            <h1 class="heading-title page-heading slide-out-in reveal-2"><?= get_the_title(); ?></h1>
        </hgroup>
    </header>
    <section class="section section-dark page-content container-fluid">
        <?php if(have_rows('paragraphe')): ?>
            <div class="posttype-content">
                    <?php $index=0; while(have_rows('paragraphe')): the_row(); 
                        $title = get_sub_field("title");
                    ?>
                    <div class="posttype-content-inner reveal section-arrow bottom-left bg-primary align-top">
                        <div class="posttype-content-item">
                            <?php if(!empty($title)): ?>
                                <h2 class="posttype-content-item-title slide-out-in reveal-<?= esc_attr($index); ?>"><?= $title; ?></h2>
                            <?php endif; ?>
                            <div class="posttype-content-item-text slide-out-in reveal-<?= esc_attr($index); ?>">
                                <?= get_sub_field("text"); ?>
                            </div>
                        </div>
                    </div>
                <?php $index++; endwhile; ?>
            </div>
        <?php endif; ?>
    </section>
    <?php get_template_part("parts/page/gallery"); ?>
    <?php get_template_part("parts/posttype/service", null, ['services' => $services]); ?>
<?php get_footer(); ?>