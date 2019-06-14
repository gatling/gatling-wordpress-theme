<?php get_header(); ?>

<main class="main-content user-stories">
  <div class="container">
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
      <?php $_fields = get_fields(); ?>
      <article>
        <a class="back-link" href="<?php echo get_post_type_archive_link('user-stories'); ?>" title="<?php pll_e("Back to user stories"); ?>"><i class="fas fa-angle-left"></i><span class="back--text"><?php pll_e("Back to user stories"); ?></span></a>

        <header>
          <img class="icon" src="<?php echo $_fields['icon']['sizes']['medium']; ?>" alt=""<?php echo $_fields['icon']['alt']; ?>>
          <h1 class="h1"><?php the_title();?></h1>
          <p><?php pll_e("User story"); ?></p>
        </header>
        
        <div class="quote">
          <?php if ($_fields['quote']['author']['picture']) : ?>
            <img src="<?php echo $_fields['quote']['author']['picture']['sizes']['thumbnail']; ?>" alt="Author icon">
          <?php endif; ?>
          <h2>« <?php echo $_fields['quote']['text']; ?> »</h2>
          <div class="author">
            <p><?php echo $_fields['quote']['author']['name']; ?></p>
            <p><?php echo $_fields['quote']['job_title']; ?></p>
          </div>
        </div>

        <?php 
          $thumbnail_id = get_post_thumbnail_id( $post->ID );
          $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        ?>

        <img class="post-thumbnail" src="<?php echo get_the_post_thumbnail_url($post->ID,'medium'); ?>" alt="<?php echo $alt; ?>">

        <div class="text"><?php the_content(); ?></div>
        
        <a class="back-link" href="<?php echo get_post_type_archive_link('user-stories'); ?>" title="<?php pll_e("Back to user stories"); ?>"><i class="fas fa-angle-left"></i><span class="back--text"><?php pll_e("Back to user stories"); ?></span></a>

      </article>
    <?php endwhile; endif; ?>
  </div>
</main>

<?php get_footer(); ?>