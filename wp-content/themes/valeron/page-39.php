<?php
/**
 * Shop page
 */
$thumb = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : '../wp-content/themes/valeron/frontend/dist/img/default_page_preview.jpg';
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
                <ul id="flex-menu">
                    <li><a href="#">Бутики</a></li>
                    <li><a href="#">Мужская одежда</a></li>
                    <li><a href="#">Бутики</a></li>
                    <li><a href="#">Мужская одежда</a></li>
                    <li><a href="#">Бутики</a></li>
                    <li><a href="#">Мужская одежда</a></li>
                    <li><a href="#">Бутики</a></li>
                    <li><a href="#">Мужская одежда</a></li>
                    <li><a href="#">Бутики</a></li>
                    <li><a href="#">Мужская одежда</a></li>
                    <li><a href="#">Бутики</a></li>
                    <li><a href="#">Мужская одежда</a></li>
                    <li><a href="#">Бутики</a></li>
                    <li><a href="#">Мужская одежда</a></li>
                </ul>
            </div>
        </div>
    </div>

	<?php while (have_posts()) : the_post(); ?>
		<?php the_content('');?>
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

