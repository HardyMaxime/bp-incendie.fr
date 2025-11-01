<?php

use function Symfony\Component\VarDumper\Dumper\esc;

$title  = isset($args['title'])  ? $args['title']  : "";
$balise = isset($args['balise']) ? $args['balise'] : "h2";
$subtitle = isset($args['subtitle']) ? $args['subtitle'] : "";
$description = isset($args['description']) ? $args['description'] : "";
$classes = isset($args['classes']) ? " ".$args['classes'] : "";

if (empty($title)) return;
?>

<hgroup class="heading section-heading reveal">
    <?php switch ($balise):
        case 'h3': ?>
            <h3 class="heading-title<?= esc_attr($classes); ?>">
                <span class="inner-text"><?= esc_html($title); ?></span>
            </h3>
                <?php if($subtitle): ?>
                    <h4 class="heading-subtitle reveal-translate reveal-2"><?= esc_html($subtitle); ?></h4>
                <?php endif; ?>
            <?php break; ?>
        <?php case 'h4': ?>
            <h4 class="heading-title<?= esc_attr($classes); ?>">
                <span class="inner-text"><?= esc_html($title); ?></span>
            </h4>
                <?php if($subtitle): ?>
                    <h5 class="heading-subtitle reveal-translate reveal-2"><?= esc_html($subtitle); ?></h5>
                <?php endif; ?>
            <?php break; ?>
        <?php case 'h2':
        default: ?>
            <h2 class="heading-title<?= esc_attr($classes); ?>">
                <span class="inner-text"><?= esc_html($title); ?></span>
            </h2>
                <?php if($subtitle): ?>
                    <h3 class="heading-subtitle reveal-translate reveal-2"><?= esc_html($subtitle); ?></h3>
                <?php endif; ?>
            <?php break; ?>
    <?php endswitch; ?>
    <?php if(!empty($description)): ?>
        <div class="heading-description reveal-translate reveal-4">
            <?= $description; ?>
        </div>
    <?php endif; ?>
</hgroup>
