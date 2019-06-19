<?php
  get_header();
?>

<main class="default-template">
  <section class="landing-screen">
    <div class="container">
      <div class="landing--text">
        <h1 class="text-orange">
            <?php pll_e("Oops! That page can’t be found."); ?>
        </h1>
        <p><?php echo $_fields['landing_subtitle']; ?></p>
        <a href="<?php echo get_home_url() ?>" class="btn orange"><?php pll_e("Back to home") ?></a>
        <a href="<?php echo $_fields['button_2']['button_link']; ?>" class="btn purple"><?php pll_e("Contact us") ?></a>
      </div>
    </div>
  </section>
</main>

<?php
  get_footer();
?>
