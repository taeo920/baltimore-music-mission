<form class="form form--search" method="get" action="<?php bloginfo('url'); ?>">
	<div class="input-group input-group">
		<input class="form-control" type="text" value="" name="s" placeholder="Search for an artist or band" required="true">
		<input type="hidden" name="post_type" value="artist">
		<div class="input-group-append">
			<button class="btn btn--alt" type="submit"><i class="btn__icon fa fa-search" aria-hidden="true"></i><span class="btn__text">Search</span></button>
		</div>
	</div>
</form>