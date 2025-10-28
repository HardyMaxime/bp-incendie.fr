<?php
$navigation = (Theme()->controller('menu'))->getSecondaryMenu();
if(!$navigation) return;
?>
<ul class="footer-navigation">
    <?php foreach($navigation as $key => $link): 
        $classes = $link->classes ? " ".implode(" ", $link->classes) : "";
    ?>
        <li class="footer-navigation-item">
            <a href="<?= esc_url($link->url); ?>" class="footer-navigation-link<?= $classes; ?>"><?= $link->title; ?></a>
        </li>
    <?php endforeach; ?>
</ul>