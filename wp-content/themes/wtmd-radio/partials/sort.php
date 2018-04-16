<div class="sort">
    <label class="sort__label">Sort</label>
    <div class="sort__options">
        <a class="sort__option btn <?php if( !isset( $_GET['sort'] ) ) echo 'btn--active'; ?>" href="<?php mg_the_sort_link('alphabetical'); ?>">Alphabetically</a>
        <a class="sort__option btn <?php if( isset( $_GET['sort'] ) && $_GET['sort'] == 'date') echo 'btn--active'; ?>" href="<?php mg_the_sort_link('date'); ?>">Newly Added</a>
    </div>
</div>