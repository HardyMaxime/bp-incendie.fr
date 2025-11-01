<?php 
    $banner = Theme()->value("footer-banner");
    $description = Theme()->value("post-banner-description");
    if($banner):
?>
<figure class="footer-banner reveal reveal-image" >
    <img src="<?= esc_url($banner['url']); ?>" alt="<?= esc_attr($banner['alt']); ?>" class="cover"
    width="1920" height="570" loading="lazy" />
</figure>
<?php endif; ?>
<?php if($description): ?>
<section class="section section-post-banner container-left container-fluid-right section-primary section-arrow align-top bg-white">
    <p class="section-content">
        <?= $description; ?>
    </p>
</section>
<?php endif; ?>