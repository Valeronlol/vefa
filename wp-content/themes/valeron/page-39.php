<?php
/**
 * Shop page
 */
$thumb = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : '../wp-content/themes/valeron/frontend/dist/img/default_page_preview.jpg';
$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
$the_query = new WP_Query( array(
	    'post_type' => 'post',
	    'posts_per_page' => 12,
        'cat' => 7,
        'numberposts' => 0,
        'orderby' => 'rand',
        'order'    => 'ASC',
	    'paged' => $paged
));
$categories = get_categories( array('child_of' => 7) );
?>
<?php get_header();?>

<?php if ($the_query->have_posts()) : ?>

    <div class="page-preview" style="background-image: url('<?php echo $thumb; ?>')">
        <div class="container">
            <h1><?php echo get_the_title(); ?></h1>
        </div>
    </div>

    <div class="flex-nav">
        <div class="container">
            <div class="row">
                <ul id="flex-menu">
                    <?php foreach ($categories as $category) :?>
                        <li><a href="<?php echo get_category_link($category) ;?>"><?php echo $category->cat_name ;?></a></li>
                    <?php endforeach ;?>
                </ul>
            </div>
        </div>
    </div>

    <div class="shop-page-content">
        <div class="container">
            <div class="row">
                <?php while ($the_query-> have_posts()) : $the_query->the_post(); ?>
                    <?php
                        $thumbnail = get_the_post_thumbnail_url($post->ID);
                        if ( !$thumbnail ) $thumbnail = '../wp-content/themes/valeron/frontend/dist/img/default_page_item.jpg';
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 cont">
                        <div class="img" style="background-image: url('<?php echo $thumbnail ;?>')"></div>
                        <a href="<?php echo get_permalink($post->ID) ;?>"><h2><?php the_title() ;?></h2></a>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <?php wp_reset_postdata();?>



    <div class="container shop-more">
        <div class="row">
            <div id="pagi">
	            <?php echo paginate_links(array(
		            'base'    => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
		            'format'  => '?paged=%#%',
		            'current' => max( 1, get_query_var('paged') ),
		            'total'   => $the_query->max_num_pages
	            ));?>
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

