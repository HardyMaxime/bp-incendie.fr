<?php
    $surtitle = Theme()->value("section-reassurance-surtitle");
    $title = Theme()->value("section-reassurance-title");
?>
<section class="section section-choose-us container">
    <?php get_template_part('parts/components/section-title', null, [
        'title' => $surtitle,
        'subtitle' => $title,
        'classes' => "center"
    ]); ?>
    <?php if(have_rows("section-reassurance-listing")): ?>
        <div class="section-reassurance-cols">
            <?php $index = 0; while(have_rows("section-reassurance-listing")): the_row(); 
                $text = get_sub_field("description");
                $image = get_sub_field("image");
            ?>
                <div class="section-reassurance-col reveal ">
                    <?php if(!empty($image)): ?>
                        <figure class="section-reassurance-col-image reveal-translate reveal-<?= esc_attr(($index * 2)); ?>" >
                            <img src="<?= esc_url($image['url']); ?>" class="flame" alt="<?= esc_attr($image['alt']); ?>" 
                            width="120" height="185" loading="lazy" />
                        </figure>
                    <?php endif; ?>
                    <div class="section-reassurance-col-description reveal-translate reveal-<?= esc_attr(($index + 1 * 2)); ?>">
                        <?= (($text)); ?>
                    </div>
                </div>
            <?php $index++; endwhile; ?>
        </div>
    <?php endif; ?>
</section>