<?php $thumb = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : '../wp-content/themes/valeron/frontend/dist/img/default_page_preview.jpg'; ?>

<?php get_header();?>

<?php if (have_posts()) : ?>

	<?php if ( !is_front_page() ) :?>
        <div class="page-preview" style="background-image: url('<?php echo $thumb; ?>')">
            <div class="container">
                <h1><?php echo get_the_title(); ?></h1>
            </div>
        </div>
	<?php endif; ?>

	<?php while (have_posts()) : the_post(); ?>
		<?php the_content('');?>
	<?php endwhile; ?>

<?php else : ?>
    <div class="container">
        <div class="row">
            <h1 class="center">Не найдено</h1>
            <p class="center">Попробуйте снова</p>
        </div>
    </div>
<?php endif; ?>
<?php get_footer();?>

