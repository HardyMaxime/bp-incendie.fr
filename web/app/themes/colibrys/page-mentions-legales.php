<?php get_header(); ?>
    <header class="section page-header section-dark container-fluid">
        <hgroup class="heading">
            <h1 class="heading-title page-heading"><?= get_the_title(); ?></h1>
        </hgroup>
    </header>
    <section class="section section-dark page-content container-fluid">
        <?php if(have_rows("mentions_colonnes")): ?>
            <div class="section-default-layout reset-list">
                <?php while(have_rows('mentions_colonnes')): the_row(); ?>
                    <div class="section-default-layout-col" >
                        <?= the_sub_field("mentions_colonne_content", false); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php if(have_rows("mentions_paragraphes")): ?>
            <?php while(have_rows('mentions_paragraphes')): the_row(); ?>
                <div class="section-mentions-paragraphe">
                    <?= the_sub_field("mentions_paragraphe_text"); ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </section>
<?php get_footer(); ?>