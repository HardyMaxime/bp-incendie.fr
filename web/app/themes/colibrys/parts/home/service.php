<?php
    $content = Theme()->value("section-service");
    $image = Theme()->value("section-service-image");
    $listing = Theme()->value("section-service-listing");
?>
<section class="section section-service section-dark container-left">
    <div class="section-service-content">
        <?php get_template_part('parts/components/section-title', null, [
            'title' => $content['title'],
            'description' => $content['description']
        ]); ?>
        <?php if($listing): ?>
            <div class="section-services-listing reveal">
                <?php foreach($listing as $key => $item): ?>
                    <div class="slide-in-out reveal-<?= esc_attr($key); ?>" >
                        <a href="<?= esc_url(get_permalink($item->ID)); ?>"><?= $item->post_title; ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <figure class="section-service-image reveal reveal-image">
        <img src="<?= esc_url($image['url']); ?>" class="cover" alt="="<?= esc_attr($image['url']); ?>" 
            width="705" height="745" loading="lazy" />
    </figure>
</section>