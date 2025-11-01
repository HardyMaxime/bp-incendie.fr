<?php
    $title = Theme()->value("section-about-title");
    $left = Theme()->value("section-about-left");
    $right = Theme()->value("section-about-right");
?>
<section class="section section-about section-dark container">
    <?php get_template_part('parts/components/section-title', null, [
        'title' => $title
    ]); ?>
    <div class="section-about-content reveal">
        <div class="section-about-left slide-out-in reveal-2">
            <?= (($left)); ?>
        </div>
        <div class="section-about-right slide-in-out reveal-4">
            <?= (($right)); ?>
        </div>
    </div>
</section>