<?php
/**
 * Cafe page
 */
$thumb = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : '../wp-content/themes/valeron/frontend/dist/img/default_page_preview.jpg';
$posts = get_posts(array(
        'category' => 10,
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

    <div class="cafe">
        <div class="container">
            <div class="row">
	            <?php foreach ($posts as $post) :?>
		            <?php
		            $thumbnail = get_the_post_thumbnail_url($post->ID);
		            if ( !$thumbnail ) $thumbnail = '../wp-content/themes/valeron/frontend/dist/img/default_page_item.jpg'
		            ;?>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 cont">
                        <div class="img" style="background-image: url('<?php echo $thumbnail ;?>')"></div>
                        <a href="<?php echo get_permalink($post->ID) ;?>"><h2><?php the_title() ;?></h2></a>
                    </div>
	            <?php endforeach; ?>
            </div>
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

