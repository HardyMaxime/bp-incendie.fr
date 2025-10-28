<?php
    $surtitle = Theme()->value("section-reassurance-surtitle");
    $title = Theme()->value("section-reassurance-title");
?>
<section class="section section-choose-us container">
    <hgroup class="heading section-heading">
        <h2 class="heading-title"><?= esc_html($title); ?></h2>
        <h3 class="heading-subtitle"><?= esc_html($title); ?></h3>
    </hgroup>
    <?php if(have_rows("section-reassurance-listing")): ?>
        <div class="section-reassurance-cols">
            <?php while(have_rows("section-reassurance-listing")): the_row(); 
                $text = get_sub_field("description");
                $image = get_sub_field("image");
            ?>
                <div class="section-reassurance-col">
                    <?php if(!empty($image)): ?>
                        <figure class="section-reassurance-col-image" >
                            <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>" 
                            width="120" height="185" loading="lazy" />
                        </figure>
                    <?php endif; ?>
                    <div class="section-reassurance-col-description">
                        <?= (($text)); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</section>