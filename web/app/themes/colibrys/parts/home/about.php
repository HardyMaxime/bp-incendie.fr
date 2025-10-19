<?php
    $title = Theme()->value("section-about-title");
    $left = Theme()->value("section-about-left");
    $right = Theme()->value("section-about-right");
?>
<section class="section section-about section-dark container">
    <hgroup class="heading section-heading">
        <h2 class="heading-title"><?= $title; ?></h2>
    </hgroup>
    <div class="section-about-content">
        <div class="section-about-left">
            <?= (($left)); ?>
        </div>
        <div class="section-about-right">
            <?= (($right)); ?>
        </div>
</section>