<?php get_header(); ?>

<div class="main-content">
    <div class="search-container">
        <form role="search" method="get" action="<?php echo home_url('/'); ?>">
            <input type="search" id="search-input" placeholder="Enter a town, city or suburb" value="<?php echo get_search_query(); ?>" name="s" title="Search for:" />
            <button id="search-btn" type="submit">Search</button>
        </form>
    </div>
</div>

<?php get_footer(); ?>
