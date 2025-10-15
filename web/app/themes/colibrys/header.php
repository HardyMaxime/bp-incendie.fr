<!DOCTYPE html>
<html <?php language_attributes(); ?> >
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo get_bloginfo('name'); ?></title>
        <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
        <link rel="icon" type="<?= Theme()->getFavicon("type"); ?>" href="<?= Theme()->getFavicon("url"); ?>" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?> >
        <main role="main" class="main" >