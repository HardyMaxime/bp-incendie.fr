<?php
    $services = (isset($args['services']) ? $args['services'] : []);
    if($services):
?>
<div class="posttype-taxonomy container-fluid reveal">
    <h2 class="title slide-out-in reveal-2">SERVICE ASSOCIÉS</h2>
    <ul class="posttype-taxonomy-list slide-out-in reveal-4" >
        <?php foreach($services as $key => $service): ?>
        <li class="posttype-taxonomy-list-item">
            <?= esc_html( $service->name ); ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>