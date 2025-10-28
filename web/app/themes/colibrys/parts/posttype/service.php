<?php
    $services = (isset($args['services']) ? $args['services'] : []);
    if($services):
?>
<div class="posttype-taxonomy">
    <h2 class="title title-arrow bottom-left bg-primary">SERVICE ASSOCIÉS</h2>
    <ul class="posttype-taxonomy-list" >
        <?php foreach($services as $key => $service): ?>
        <li class="posttype-taxonomy-list-item">
            <?= esc_html( $service->name ); ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>