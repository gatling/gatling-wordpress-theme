<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
  <label>
    <input type="search" class="search-field"
           placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>"
           value="<?php echo get_search_query() ?>" name="s"
           title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
  </label>
  <br/>
  <input type="hidden" name="post_type" value="post" />
  <input type="submit" class="search-submit btn purple"
         value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
</form>
