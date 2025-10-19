<?php
    $image = Theme()->value("section-mission-image");
?>
<section class="section section-mission container">
    <figure class="section-mission-image">
        <img src="<?= esc_url($image['url']); ?>" alt="="<?= esc_attr($image['url']); ?>" 
            width="705" height="745" loading="lazy" />
    </figure>
    <?php if(have_rows("section-mission")): ?>
        <div class="section-mission-content">
            <?php while(have_rows("section-mission")): the_row(); 
                $title = get_sub_field("title");
                $text = get_sub_field("description");
            ?>
                <div class="section-mission-item">
                    <hgroup class="heading section-heading">
                        <h3 class="heading-title section-mission-item-title"><?= esc_html($title); ?></h3>
                    </hgroup>
                    <div class="section-mission-item-text">
                        <?= (($text)); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</section>