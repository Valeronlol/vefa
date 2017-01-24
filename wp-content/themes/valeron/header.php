<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="keywords" content="<?php echo  get_post(1)->post_content ;?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta property="og:image" content="path/to/image.jpg">
    <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/frontend/dist/img/favicon/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/frontend/dist/img/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_url'); ?>/frontend/dist/img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_url'); ?>/frontend/dist/img/favicon/apple-touch-icon-114x114.png">
    <meta name="theme-color" content="#000">
    <meta name="msapplication-navbutton-color" content="#000">
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">
    <?php wp_head(); ?>
</head>
<body>
<header class="nav">
    <a href="/"><span class="logo"></span></a>
	<?php wp_nav_menu( array(
	        'menu' => 'header_menu'
    )); ?>

    <div class="burger-cont">
        <div id="burger">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
	<?php get_search_form(); ?>
</header>