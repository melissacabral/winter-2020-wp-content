<!DOCTYPE html>
<html>
<head>
  <?php wp_head();  //HOOK. this one is required in all WP themes ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php bloginfo('name'); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">
</head>
<body>
<div class="site">
  <header class="header">
    <div class="header-bar">
      <h1 class="site-title">
        <a href="<?php echo home_url(); ?>">
        <?php bloginfo('name'); ?>
          
        </a>
      </h1>
      <h2><?php bloginfo('description'); ?></h2>
      <nav>
        <ul class="menu">
          <?php wp_list_pages( array(
            'title_li' => '',
          ) ); ?>
         
        </ul>
      </nav>

    <?php get_search_form(); ?>   

    </div>
  </header>