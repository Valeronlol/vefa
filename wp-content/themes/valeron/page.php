<?php get_header();?>
<?php if (have_posts()) : ?>
	<?php if ( !is_front_page() ) :?>
		<div class="slider_min">
			<div class="el_wrap">
				<h1><?php echo get_the_title(); ?></h1>
			</div>
		</div>
		<div class="breadcrumbs container">
			<?php if(function_exists('bcn_display'))
			{
				bcn_display();
			}?>
		</div>
	<?php endif; ?>

	<?php while (have_posts()) : the_post(); ?>
		<?php the_content('');?>
	<?php endwhile; ?>
<?php else : ?>
	<h2 class="center">Не найдено</h2>
	<p class="center">Попробуйте снова</p>
<?php endif; ?>
<?php get_footer();?>

