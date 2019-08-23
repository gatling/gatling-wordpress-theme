<?php
  get_header();
  $_fields = get_fields();
?>

<main class="default-template">
  <section class="landing-screen">
    <div class="container">
      <div class="landing--text">
        <h1 class="text-<?php echo $_fields['title_color']; ?>">
          <?php
            strip_the_field($_fields['landing_title'],'<strong><br>');
          ?>
        </h1>
        <p><?php echo $_fields['landing_subtitle']; ?></p>
        <?php if (!$_fields['show_image']) : ?>
          <?php if ($_fields['button_1']['button_link']) : ?>
            <a href="<?php echo $_fields['button_1']['button_link']; ?>" class="btn <?php echo $_fields['button_1']['button_color']; ?>"><?php echo $_fields['button_1']['button_text']; ?></a>
          <?php endif;?>
          <?php if ($_fields['button_2']['button_link']) : ?>
            <a href="<?php echo $_fields['button_2']['button_link']; ?>" class="btn <?php echo $_fields['button_2']['button_color']; ?> <?php if ($_fields['button_2']['doc_button']) {echo "btn-icon";}?>"><?php if ($_fields['button_2']['doc_button']) : ?><img src="<?php add_img_html('doc-icon.svg'); ?>" alt="Icon"><?php endif; ?><?php echo $_fields['button_2']['button_text']; ?></a>
          <?php endif; ?>
        <?php else : ?>
            <img class="sub-image" src="<?php echo $_fields['sub_image']; ?>" alt="">
        <?php endif; ?>
      </div>

      <div class="landing--screenshot <?php if (!$_fields['landing_image']['image_in_browser']) : ?>image-only<?php endif; ?>">
        <?php if ($_fields['landing_image']['image_in_browser']) : ?>
          <div class="image-in-browser">
            <?php echo gtl_image_with_srcset($_fields['landing_image']['image']); ?>
          </div>
        <?php else: ?>
          <?php echo gtl_image_with_srcset($_fields['landing_image']['image']); ?>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <?php if ( !empty( get_the_content() ) ) : ?>
      <section class="section-00 text">
        <div class="container">
          <?php the_content(); ?>
        </div>
      </section>
    <?php endif; ?>
  <?php endwhile; endif; ?>

  <?php if (have_rows('flexible_content')) :
    $index = 1;
    while(have_rows('flexible_content')) : the_row(); ?>

      <section class="section-<?= str_pad($index, 2, "0", STR_PAD_LEFT) ?>">
        <a id="section-<?= str_pad($index, 2, "0", STR_PAD_LEFT) ?>"></a>
        <?php get_flexible_block(); ?>
      </section>

      <?php $index ++;
    endwhile;
  endif; ?>

</main>

<?php get_footer(); ?>
