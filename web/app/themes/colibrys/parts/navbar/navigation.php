<?php
$navigation = (Theme()->controller('menu'))->getMainMenu();
if(!$navigation) return;
?>
<ul class="navbar-listing">
    <?php foreach($navigation as $key => $link): 
        $classes = $link->classes ? " ".implode(" ", $link->classes) : "";
    ?>
        <li class="navbar-listing-item">
            <a href="<?= esc_url($link->url); ?>" class="navbar-listing-link<?= $classes; ?>"><?= $link->title; ?></a>
        </li>
    <?php endforeach; ?>
</ul>