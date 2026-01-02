<?php
    $services = (isset($args['services']) ? $args['services'] : []);
    if($services):
?>
<section class="section section-dark page-content container-fluid">
    <div class="section page-header section-dark container-fluid">
        <hgroup class="heading reveal">
            <h2 class="heading-title page-heading slide-out-in reveal-2">Services</h2>
        </hgroup>
    </div>
    <?php if(have_rows('paragraphe')): ?>
        <div class="posttype-content">
                <?php $index=0; while(have_rows('service-paragraphe')): the_row(); 
                    $title = get_sub_field("title");
                ?>
                <div class="posttype-content-inner reveal section-arrow bottom-left bg-primary align-top">
                    <div class="posttype-content-item">
                        <?php if(!empty($title)): ?>
                            <h2 class="posttype-content-item-title slide-out-in reveal-<?= esc_attr($index); ?>"><?= $title; ?></h2>
                        <?php endif; ?>
                        <div class="posttype-content-item-text slide-out-in reveal-<?= esc_attr($index); ?>">
                            <?= get_sub_field("text"); ?>
                        </div>
                    </div>
                </div>
            <?php $index++; endwhile; ?>
        </div>
    <?php endif; ?>
</section>
<?php endif; ?>