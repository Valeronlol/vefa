<?php
global $wp_query;
$post = $wp_query->post;
$page_id = $post->ID;
$page_content = get_post( $page_id )->post_content;
$images = get_field("post_slider");
$related = get_posts( array(
	'category' => wp_get_post_categories($page_id),
	'numberposts' => 4,
	'orderby' => 'rand',
	'order'    => 'ASC'
));
get_header();
?>

    <div id="post-main">
        <div class="post-slider">
            <?php if ( !empty($images) ) :?>
                <?php foreach( get_field("post_slider") as $image ): ?>
                    <div
                        class="item"
                        style="background-image: url('<?php echo $image['sizes']['large']; ?>')"
                        title="<?php echo $image['alt']; ?>"
                    ></div>
                <?php endforeach; ?>
            <?php endif ;?>

            <?php if ( empty($images) ) :?>
                <div class="item" style="background-image: url('../wp-content/themes/valeron/frontend/dist/img/23062014-074534alsalaam-mall-jeddah3.jpg')"></div>
                <div class="item" style="background-image: url('../wp-content/themes/valeron/frontend/dist/img/3-office-space.jpg')"></div>
            <?php endif ;?>
        </div>

        <div class="container">
            <div class="row cont">
                <div class="post-content" id="post_page_content">
                    <h1><?php the_title() ;?></h1>
					<?php echo $page_content ;?>
                </div>
            </div>
        </div>
    </div>

    <div class="more-posts">
        <div class="container">
            <div class="row">
                <h1>Другие магазины</h1>
	            <?php if( !empty($related) ) foreach( $related as $post ) { ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 cont">
                        <div class="img" style="background-image: url('<?php echo get_the_post_thumbnail_url($post->ID) ;?>')"></div>
                        <a href="<?php echo get_permalink($post->ID) ;?>"><h2><?php echo get_the_title($post->ID) ;?></h2></a>
                    </div>
                <?php }
                wp_reset_postdata(); ;?>
            </div>
        </div>
    </div>

<?php
get_sidebar();
get_footer();
