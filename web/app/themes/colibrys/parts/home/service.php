<?php
    $content = Theme()->value("section-service");
    $image = Theme()->value("section-service-image");
?>
<section class="section section-service section-dark container-left">
    <div class="section-service-content">
        <div class="heading section-heading">
            <h2 class="heading-title"><?= $content['title']; ?></h2>
            <?php if(!empty($content['description'])): ?>
                <div class="heading-description">
                    <?= $content['description']; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="section-services-listing">
            <a href="#">Extincteurs</a>
            <a href="#">Extincteurs</a>
            <a href="#">Extincteurs</a>
            <a href="#">Extincteurs</a>
            <a href="#">Extincteurs</a>
            <a href="#">Extincteurs</a>
        </div>
    </div>
    <figure class="section-service-image">
        <img src="<?= esc_url($image['url']); ?>" class="cover" alt="="<?= esc_attr($image['url']); ?>" 
            width="705" height="745" loading="lazy" />
    </figure>
</section>