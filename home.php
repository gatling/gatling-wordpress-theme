<?php get_header(); ?>

<main class="main-content blog">
  <header class="main-header">
    <h1 class="h1"><?php pll_e("Blog") ;?></h1>
  </header>

  <div class="container">
    <div class="articles">
      <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <?php $_fields = get_fields(); ?>
        <article style="background-image: url('<?php the_post_thumbnail_url('large'); ?>');">
          <?php if (get_the_post_thumbnail()) : ?>
            <a href="<?php the_permalink(); ?>" class="header" title="<?php the_title(); ?>"></a>
          <?php endif; ?>
          <div class="content">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="text"><p><?php echo wp_trim_excerpt('') ; ?></p></div>
            <div class="text-center">
              <a class="btn purple" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php pll_e("Read more"); ?></a>
            </div>
            <footer>
              <div>
                <?php pll_e("Posted in"); ?>
                <?php
                  $catList = '';
                  foreach((get_the_category()) as $cat) {
                    $catID = get_cat_ID( $cat->cat_name );
                    $catLink = get_category_link( $catID );
                    if(!empty($catList)) {
                      $catList .= ', ';
                    }
                    $catList .= '<a href="'.$catLink.'">'.$cat->cat_name.'</a>';
                  }
                  echo $catList;
                ?>
              </div>
              <?php pll_e("Posted on"); ?><?php echo " " . get_the_date(); ?>
            </footer>
          </div>
        </article>
      <?php endwhile; endif; ?>
      <div class="navigation text-center"><?php posts_nav_link(' — ','« Newer Posts','Older Posts »'); ?></div>
    </div>
    <div class="sidebar">
      <div class="sidebar--element">
        <h2><?php pll_e("Search for"); ?></h2>
        <?php echo get_search_form(); ?>
      </div>
      <nav class="category-menu sidebar--element">
        <h2><?php pll_e("Categories"); ?></h2>
        <ul class="category-list">
          <?php
            $categories = get_categories( array(
              'orderby' => 'name',
              'order'   => 'ASC'
            ) );
            foreach( $categories as $category ) : ?>
              <li>
                <a href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name; ?> (<?php echo $category->count; ?>)</a>
              </li>
            <?php endforeach
          ?>
        </ul>
      </nav>
      <div class="twitter-feed sidebar--element">
        <h2><?php pll_e("Follow us"); ?></h2>
        <?php the_field('twitter_feed', 'option'); ?>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>
