<?php get_header(); ?>
    <header class="section page-header section-dark container-fluid">
        <hgroup class="heading">
            <h1 class="heading-title page-heading"><?= get_the_title(); ?></h1>
        </hgroup>
    </header>
    <?php if(have_rows("page-content-listing")): ?>
        <section class="section section-dark page-content paragraph-content container-fluid">
            <?php $index = 0; while(have_rows("page-content-listing")): the_row();
                $className = (get_sub_field("high") ? " high" : "");

                if($index === 0)
                {
                    $className .= " first section-arrow";
                }
            ?>
            <div class="paragraph-content-item-outter">
                <div class="paragraph-content-item<?= esc_attr($className); ?>" >
                    <div class="inner">
                        <?= get_sub_field("description"); ?>
                    </div>
                </div>
            </div>
            <?php $index++; endwhile; ?>
        </section>
    <?php endif; ?>
<?php get_footer(); ?>