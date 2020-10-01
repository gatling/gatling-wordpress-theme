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
      
      <div class="main-menu">
        <div class="close-menu">
          <i class="fa fa-times"></i>
        </div>
        <?php
          $menu = nnki_get_menu("main-nav");
          $i = 0;
          foreach($menu as $item) :
            ?>
            <?php if ($i < (count($menu)-1)) : ?>
            <div class="submenu-li <?php if ($i != 0): 
                echo '-nochild';
              endif; ?>">
              <a class="menu-link
              <?php 
              if (get_permalink($the_page) == $item->url || is_child_active($item, get_permalink($the_page)) || is_grandchild_active($item, get_permalink($the_page))) {
                echo "active";
              }
              ?>
              " href="<?php echo $item->url; ?>">
                <?php echo $item->title; ?>
              </a>

              <?php if (count($item->children)): ?>
              <div class="submenu
              <?php if ($i != 0): 
                echo '-nochild';
              endif; ?>
              ">
                <div class="arrow"></div>
                <?php foreach($item->children as $child) { ?>
                <div class="submenu-content">
                  <a href="<?php echo $child->url; ?>" 
                  <?php if (get_permalink($the_page) == $child->url || is_child_active($child, get_permalink($the_page))) {
                    echo "class='active'";
                  } ?>>
                    <?php echo $child->title; ?>
                  </a>

                  <?php if (count($child->children)): ?>
                    <div class="subsubmenu">
                      <?php foreach ($child->children as $subchild) { ?>
                        <a href="<?php echo $subchild->url; ?>" <?php if (get_permalink($the_page) == $subchild->url) {
                    echo "class='active'";
                  } ?>>
                          <?php echo $subchild->title; ?>
                        </a>
                      <?php } ?>
                    </div>
                  <?php endif; ?>
                </div>
                
                <?php } ?>
              </div>
              <?php endif; ?>
            </div>
            <?php else : ?>
              <div class="button-end">
                <a href="<?php echo $item->url; ?>" class="btn btn-primary"><?php echo $item->title; ?></a>
            </div>
            <?php endif; ?>           
          <?php 
          $i++;
          endforeach; ?>
      </div>
    </nav>

    <div class="mask-menu"></div>
  </header>
