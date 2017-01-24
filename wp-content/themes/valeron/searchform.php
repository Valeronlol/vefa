<div class="search" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>">
	<form id="search-form">
		<input class="text" type="text" value="<?php get_search_query() ;?>" name="s" id="s" placeholder="Что ищем?">
		<input class="submit" name="submit" type="submit" value="">
	</form>
</div>