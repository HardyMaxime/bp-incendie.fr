<?php
    $footer_logo = Theme()->value("footer-logo", get_option('page_on_front'));
    $footer_link = Theme()->value("footer-link", get_option('page_on_front'));
?>
<footer class="footer section-dark container-left container-fluid-right">
    <hgroup class="heading section-heading">
        <h2 class="heading-title"><?= Theme()->value("footer-title", get_option('page_on_front')); ?></h2>
    </hgroup>
    <div class="footer-content">
        <?php if($footer_logo): ?>
            <figure class="footer-logo">
                <img src="<?= esc_url($footer_logo['url']); ?>" alt="<?= esc_attr($footer_logo['alt']); ?>"
                width="245" height="115" loading="lazy" />
            </figure>
        <?php endif; ?>
        <div class="footer-address">
            <?= Theme()->value("footer-description", get_option('page_on_front')); ?>
        </div>
        <div class="footer-schedule">
            <?= Theme()->value("footer-schedule", get_option('page_on_front')); ?>
        </div>
        <?php if(!empty($footer_link)): ?>
            <a href="<?= esc_url($footer_link); ?>" class="btn" target="_blank" rel="external noopener nofollow">
                Itinéraire
            </a>
        <?php endif; ?>
    </div>
    <?php get_template_part("parts/footer/navigation"); ?>
</footer>