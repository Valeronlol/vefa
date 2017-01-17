<?php
/**
 * Entertament page
 */
$thumb = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : '../wp-content/themes/valeron/frontend/dist/img/default_page_preview.jpg';
$posts = get_posts(array(
        'category' => 7,
        'numberposts' => 0,
        'orderby' => 'rand',
        'order'    => 'ASC'
));
?>
<?php get_header();?>

<?php if (have_posts()) : ?>

    <div class="page-preview" style="background-image: url('<?php echo $thumb; ?>')">
        <div class="container">
            <h1><?php echo get_the_title(); ?></h1>
        </div>
    </div>

    <div class="flex-nav">
        <div class="container">
            <div class="row">
	            <?php wp_nav_menu( array(
		            'menu' => 'shop_menu',
		            'menu_id' => 'flex-menu'
	            )); ?>
            </div>
        </div>
    </div>

	<?php while (have_posts()) : the_post(); ?>
        <div class="shop-page-content">
            <div class="container">
                <div class="row">

                    <?php foreach ( $posts as $post): ?>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 cont">
                            <div class="img" style="background-image: url('<?php echo get_the_post_thumbnail_url($post->ID) ;?>')"></div>
                            <a href="<?php echo get_permalink($post->ID) ;?>"><h2><?php the_title() ;?></h2></a>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
	<?php endwhile; ?>

    <div class="container shop-more">
        <div class="row">
            <div id="shop-more">развернуть</div>
        </div>
    </div>

<?php else : ?>
    <div class="container">
        <div class="row">
            <h1 class="error">Не найдено</h1>
            <p class="error">Попробуйте снова</p>
        </div>
    </div>
<?php endif; ?>
<?php get_footer();?>

