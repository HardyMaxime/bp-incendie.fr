<?php
$navigation = (Theme()->controller('menu'))->getArrayMenuItem();
if(!$navigation) return;
?>
<ul class="navbar-listing">
    <?php foreach($navigation as $key => $link): 
        $classes = $link['classes'] ? " ".implode(" ",  $link['classes']) : "";
        $children = ($link['child']);
        $classes = (!empty($children) ? " parent" : "");
    ?>
        <li class="navbar-listing-item<?= esc_attr($classes); ?>">
            <a href="<?= esc_url( $link['url']); ?>" class="navbar-listing-link<?= $classes; ?>"><?=  $link['title']; ?></a>
            <?php if($children): ?>
                <ul class="menu-child">
                    <?php foreach($children as $key => $child): ?>
                        <li class="menu-child-item">
                            <a href="<?= esc_url( $child->url); ?>" class="menu-child-link"><?=  $child->title; ?></a>
                        </li>
                     <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>