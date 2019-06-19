<?php get_header(); ?>

<main class="main-content archive-user-stories">
  <div class="container">
    <header class="main-header">
      <h1 class="h1"><?php pll_e("User stories") ;?></h1>
      <h2><?php pll_e("They chose Gatling"); ?></h2>
      <p><?php pll_e("Help us spreading the word about Gatling! Contribute to this project by sending us your own user story! Contact us now: "); ?><a href="mailto:contact@gatling.io">contact@gatling.io</a></p>
    </header>


    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
      <?php $_fields = get_fields(); ?>
      <article>
        <header>
          <img class="icon" src="<?php echo $_fields['icon']['sizes']['medium']; ?>" alt=""<?php echo $_fields['icon']['alt']; ?>>
          <h2><?php the_title(); ?></h2>
        </header>
        <div class="text">
          <?php echo $_fields['excerpt']; ?>
          <div class="text-center">
            <a class="btn btn-secondary" href="<?php the_permalink(); ?>"><?php pll_e("Read more"); ?></a>
          </div>
        </div>
      </article>
    <?php endwhile; endif; ?>
  </div>
</main>

<?php get_footer(); ?>
