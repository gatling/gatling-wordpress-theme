<?php get_header(); ?>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>

<main class="main-content blog single-post">
  <header class="main-header" style="background-image: linear-gradient(0deg, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0.8) 100%), url('<?php echo the_post_thumbnail_url(); ?>')">
    <h1 class="h1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
  </header>
  <div class="container">
    <div class="articles">
        <?php $_fields = get_fields(); ?>
        <article>
          <div class="content">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="text"><?php the_content(); ?></div>
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
        <div class="navigation">
            <?php previous_post_link(); ?>
            <?php next_post_link(); ?>
        </div>
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

<?php endwhile; endif; ?>
<?php get_footer(); ?>
