<?php
    $title = Theme()->value("block-title-field");
    $banner = Theme()->value("block-title-banner");
?>
<header class="section section-header">
    <hgroup class="heading container reveal">
        <h1 class="heading-title main-title line-appear"><?= $title; ?></h1>
    </hgroup>
    <?php if($banner) : ?>
        <figure class="section-banner container-fluid reveal reveal-image">
            <img src="<?= esc_url($banner['url']); ?>" alt="<?= esc_url($banner['alt']); ?>" 
            class="cover" width="1640" height="780" loading="lazy" />
        </figure>
    <?php endif; ?>
</header>