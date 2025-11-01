<?php
    $image = Theme()->value("section-mission-image");
?>
<section class="section section-mission container">
    <figure class="section-mission-image reveal reveal-image reveal-image-right">
        <img src="<?= esc_url($image['url']); ?>" alt="="<?= esc_attr($image['url']); ?>" 
            width="705" height="745" loading="lazy" />
    </figure>
    <?php if(have_rows("section-mission")): ?>
        <div class="section-mission-content">
            <?php $index = 0; while(have_rows("section-mission")): the_row(); 
                $title = get_sub_field("title");
                $text = get_sub_field("description");
            ?>
                <div class="section-mission-item">
                    <?php get_template_part('parts/components/section-title', null, [
                        'title' => $title,
                        'balise' => 'h3'
                    ]); ?>
                    <div class="section-mission-item-text reveal">
                        <div class="slide-in-out reveal-<?= esc_attr($index); ?>" >
                            <?= (($text)); ?>
                        </div>
                    </div>
                </div>
            <?php $index++; endwhile; ?>
        </div>
    <?php endif; ?>
</section>