<?php get_header(); ?>
<?php
$thumb = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : '../wp-content/themes/valeron/frontend/dist/img/default_page_preview.jpg';
$s=get_search_query();
$args = array(
	's' =>$s
);
$i = 1;
$the_query = new WP_Query( $args );
?>

<div class="page-preview" style="background-image: url('<?php echo $thumb; ?>')">
    <div class="container">
        <h1><?php echo get_the_title(); ?></h1>
    </div>
</div>

<?php
if ( $the_query->have_posts() ) { ?>
    <div class="container">
        <div class="row search-result">
	        <?php _e("<h2>Результаты поиска по запросу: ".get_query_var('s')."</h2>"); ?>
            <?php  while ( $the_query->have_posts()) :
		        $the_query->the_post(); ?>
                <ul>
                    <li>
                        <a href="<?php the_permalink(); ?>"><?php echo $i ; $i++; ?>) <?php the_title(); ?></a>
                    </li>
                </ul>
            <?php endwhile; ?>
        </div>
    </div>
<?php
    }else{
        ?>
        <div class="container">
            <div class="row search-no-result">
                <h2>Ничего не найдено.</h2>
                <div class="alert alert-info">
                    <p>По вашему запросу ничего не найдено.</p>
                </div>
            </div>
        </div>
    <?php } ?>

<?php get_footer(); ?>