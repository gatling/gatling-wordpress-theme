  <footer class="page-footer">
    <div class="branding">
      <img class="main-logo" src="<?php the_field('logo', 'option'); ?>" alt="Logo Gatling">
      <ul class="social-links">
        <?php $social = get_field('social_links', 'option'); ?>
        <li><a href="<?php echo $social['facebook'];?>" target="_blank"><i class="fab fa-facebook-f" data-fa-transform="shrink-8" data-fa-mask="fas fa-circle" title="Facebook"></i></a></li>
        <li><a href="<?php echo $social['twitter']; ?>" target="_blank"><i class="fab fa-twitter" data-fa-transform="shrink-8" data-fa-mask="fas fa-circle" title="Twitter"></i></a></li>
        <li><a href="<?php echo $social['linkedin']; ?>" target="_blank"><i class="fab fa-linkedin-in" data-fa-transform="shrink-8" data-fa-mask="fas fa-circle" title="LinkedIn"></i></a></li>
        <li><a href="<?php echo $social['youtube']; ?>" target="_blank"><i class="fab fa-youtube" data-fa-transform="shrink-8" data-fa-mask="fas fa-circle" title="Youtube"></i></a></li>
        <li><a href="<?php echo $social['github']; ?>" target="_blank"><i class="fab fa-github" data-fa-transform="shrink-2" data-fa-mask="fas fa-circle" title="Github"></i></a></li>
      </ul>
    </div>

    <nav class="footer-menu">
      <ul>
        <?php
        $menu = my_get_menu("footer-1");
        foreach($menu as $item) : ?>
          <li><a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a></li>
        <?php endforeach; ?>
      </ul>
      <ul>
        <?php
        $menu = my_get_menu("footer-2");
        foreach($menu as $item) : ?>
          <li><a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <p class="copyright-text">Copyright © <?php echo date('Y'); ?> Gatling Corp 2011-<?php echo date('Y'); ?></p>
  </footer>

  <?php wp_footer(); ?>

  </body>
</html>
