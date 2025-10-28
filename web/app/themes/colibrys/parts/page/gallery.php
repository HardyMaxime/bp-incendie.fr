<?php 
$gallery = Theme()->value("page-gallery");
if(!empty($gallery)): ?>
    <section class="section section-dark page-galerie container-fluid">
        <?php foreach($gallery as $key => $thumb): ?>
            <figure class="post-galerie-item">
                <img src="<?= esc_url($thumb['url']) ?>" alt="<?= esc_attr($thumb['alt']) ?>" class="cover"
                    width="810" height="500" loading="lazy" />
            </figure>
        <?php endforeach; ?>
    </section>
<?php endif; ?>