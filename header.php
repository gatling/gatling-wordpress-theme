<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-53375088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-53375088-1');
    </script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MJX8KRG');</script>
    <!-- End Google Tag Manager -->

    <!-- Plezi Analytics -->
    <script type='text/javascript' async src='https://app.plezi.co/scripts/ossleads_analytics.js?tenant=5c14dfd2e317a77267b80dbf&tw=5c14dfd3e317a77267b80ed7'></script>
    <!-- End Plezi Analytics -->

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MJX8KRG" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <header class="page-header">
    <div class="navicon-ct">
      <a class="navicon-button x">
        <div class="navicon"></div>
      </a>
    </div>

    <a class="splash-link" href="<?php echo get_home_url(); ?>"><img class="main-logo" src="<?php the_field('logo', 'option'); ?>" alt="Logo Gatling"></a>

    <nav>
      <ul class="main-menu">
        <?php
          $menu = my_get_menu("main-nav");
          $numItems = count($menu);
          $i = 0;
          foreach($menu as $item) :

            //First level menu ?>
            <?php if (count($item->children) === 0) : ?>
              <?php if ($i < ($numItems-1)) : ?>
                <li class="menu--element">
                  <a class="menu-link
                  <?php
                    if (get_permalink($the_page) == $item->url) {
                      echo "active";
                    }
                  ?>
                  " href="<?php echo $item->url; ?>">
                    <?php echo $item->title; ?>
                  </a>
                </li>
              <?php endif; ?>

              <?php  if ($i === ($numItems-1)) : ?>
                <li><a href="<?php echo $item->url; ?>" class="btn btn-primary"><?php echo $item->title; ?></a></li>
              <?php endif; ?>
            <?php endif; ?>

            <?php
              //Second level menu
              if(count($item->children) > 0) :
            ?>
              <li class="submenu-li">
                <a class="menu-link
                <?php
                  if (get_permalink($the_page) == $item->url ||
                   basename(get_permalink()) == 'consulting-and-training') {
                    echo "active";
                  }
                ?>
                " href="<?php echo $item->url; ?>">
                  <?php echo $item->title; ?>
                </a>
                <i class="fas fa-chevron-down fa-xs"></i>
                <ul class="submenu">
                  <?php foreach($item->children as $child) { ?>
                  <li>
                    <a href="<?php echo $child->url; ?>">
                      <?php echo $child->title; ?>
                    </a>
                  </li>
                  <?php } ?>
                </ul>
              </li>
            <?php endif; ?>
            <?php $i++; ?>
          <?php endforeach; ?>
      </ul>
    </nav>
  </header>
