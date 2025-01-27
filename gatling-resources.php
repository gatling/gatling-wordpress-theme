<?php
/**
 * Template Name: Resources Template
 * Description: Resources page
 */

    get_header();
    $_fields = get_fields();
?>

<main class="main-content">
  <div class="container">
    <h1><?php pll_e("Resources"); ?></h1>

    <?php if ($_fields['events']) : ?>
    <section class="section-events">
      <div class="events--header">
        <h2><?php pll_e("Upcoming events"); ?></h2>

        <div class="slider--navigation"></div>
      </div>

      <div class="slider-events">
        <?php
                    //Sort events by date, remove due events
                    $order = array();
                    $now = new DateTime("now");

                    foreach($_fields['events'] as $i => $row) {
                        $date = DateTime::createFromFormat('Ymd', $row['date']);
                        if ($date < $now)
                            unset($_fields['events'][$i]);
                        else
                            $order[$i] = $row['date'];
                    }

                    array_multisort($order, SORT_ASC, $_fields['events']);
                ?>

        <?php if ($_fields['events']) : foreach ($_fields['events'] as $event) : ?>
        <a href="<?php echo $event['link']['url']; ?>" class="events--slide">
          <div class="main-img">
            <img src="<?php echo $event['image']['sizes']['medium']; ?>" alt="">
            <div class="events--date">
              <?php
                                    $unixtimestamp = strtotime( $event['date'] );
                                ?>
              <span class="day"><?php echo date_i18n( "d", $unixtimestamp ); ?></span>
              <?php echo substr( date_i18n( "F", $unixtimestamp ), 0, 3 ); ?>
            </div>
          </div>
          <p><?php echo $event['name']; ?></p>
        </a>
        <?php endforeach; endif; ?>
      </div>
    </section>
    <?php endif; ?>
  </div> <!-- div.container -->

  <section class="section-resources">
    <div class="container">
      <?php 
                $loop = new WP_Query(array(
                    'post_type' => 'resources',
                    'posts_per_page' => '-1',
                    'meta_key' => 'date',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC'
                ));

                $terms = get_terms(array(
                    'taxonomy'      => 'resources_cat',
                    'hide_empty'    => true,
                ));
            ?>

      <div class="resources-filters">
        <div class="dropdown-buttons">
          <button class="active" data-filter="*"><?php pll_e("All resources"); ?></button>
          <?php foreach ($terms as $term) : ?>
          <button data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></button>
          <?php endforeach; ?>

          <button class="deploy-dropdown">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8">
              <path fill="#1D262C"
                d="M10.25 8c-.468 0-.907-.182-1.243-.518L6 4.298l-3.012 3.19c-.33.33-.77.512-1.238.512C.785 8 0 7.215 0 6.25c0-.466.181-.905.51-1.235L4.763.513c.243-.244.55-.409.884-.477C5.763.012 5.881 0 6 0c.119 0 .237.012.352.036.336.068.642.233.89.482l4.245 4.495c.33.33.513.77.513 1.237C12 7.215 11.215 8 10.25 8z" />
            </svg>
          </button>
        </div>

        <div class="buttons">
          <button class="default-btn active" data-filter="*"><?php pll_e("All resources"); ?></button>
          <?php foreach ($terms as $term) : ?>
          <button data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></button>
          <?php endforeach; ?>
        </div>

        <div class="search-input-ct">
          <button class="search-btn">
            <img src="<?php add_img_html('search-icon.svg'); ?>" alt="">
          </button>
          <input class="search-input active" type="text" id="search"
            placeholder="<?php pll_e("Search webinars, videos..."); ?>" />
        </div>
      </div>

      <div class="resources-grid">
        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

        <?php 
                    $_postFields = get_fields($post);
                    $terms = get_the_terms($post, 'resources_cat');
                    $cat = $terms[0]->slug;
                ?>

        <?php if ($cat == 'videos') : ?>
        <?php 
                        if ($_postFields['video']['video_type'] == 'online') {
                            $url = $_postFields['video']['video_link'];
                        } elseif ($_postFields['video']['video_type'] == 'file') {
                            $url = $_postFields['video']['video_file'];
                        } elseif ($_postFields['video']['video_type'] == 'form') {
                            $url = $_postFields['video']['video_form'];
                        }
                        if ($_postFields['video']['video_type'] == 'online' || $_postFields['video']['video_type'] == 'file') {
                            $data = 'data-fancybox';
                        } else {
                            $data = '';
                        }
                        ?>
        <a <?php echo $data ?> href="<?php echo esc_url($url); ?>" class="grid-item videos"
          style="--color: <?php echo $_postFields['color']; ?>; --img: url('<?php echo $_postFields['video_style']['background_image']['sizes']['medium_large']; ?>')">
          <div class="item--global">
            <div class="category"><?php echo $terms[0]->name; ?></div>
          </div>
          <div class="item--details <?php echo $_postFields['video_style']['text_color']; ?>">
            <div class="title"><?php echo $_postFields['title']; ?></div>
          </div>
          <img class="play" src="<?php add_img_html('play-button.svg'); ?>" alt="">
        </a>
        <?php else : ?>
        <a href="<?php echo esc_url($_postFields['link']); ?>" class="grid-item <?php echo $cat; ?>"
          style="--img: url('<?php echo $_postFields['picture']['sizes']['medium_large'] ?>')<?php if ($_postFields['color']): ?>; --color: <?php echo $_postFields['color']; ?><?php endif; ?>">
          <div class="item--global">
            <div class="category">
              <?php if ($post->post_title !== '') { echo $post->post_title; } else { echo $terms[0]->name; } ?>
            </div>
            <?php if ($cat == 'webinars') : ?>
            <div class="webinar-speaker">
              <img src="<?php echo $_postFields['speaker']['picture']['sizes']['thumbnail']; ?>"
                alt="<?php echo esc_attr($_postFields['speaker']['name']); ?>">
              <p class="name"><?php echo $_postFields['speaker']['name']; ?></p>
              <p class="title"><?php echo $_postFields['speaker']['title']; ?></p>
              <p class="location"><?php echo $_postFields['speaker']['company']; ?></p>
            </div>
            <?php endif; ?>
          </div>
          <div class="item--details">
            <div class="title"><?php echo $_postFields['title']; ?></div>
            <div class="button-ct">
              <p class="date"><?php echo $_postFields['date']; ?></p>
              <button class="btn btn-primary">
                <?php if ($cat == 'webinars') {
                                            $date = strtotime($_postFields['date']);
                                            if ($date <= time()) {
                                                pll_e('Watch now!');
                                            } else {
                                                pll_e('Register now!');
                                            }
                                        } else { pll_e('Read more'); } ?>
              </button>
            </div>
          </div>
        </a>
        <?php endif; ?>
        <?php endwhile; wp_reset_query(); ?>

      </div>
    </div>
  </section>

  <section>
    <div class="useful-resources-block container">
    <?php if (get_field('show_academy')): ?>
      <?php $academy = get_field('gatling_academy'); ?>
      <div class="gatling-academy" style="background-image:url(<?php echo $academy['background']['url']; ?>)">
        <div class="title"><?php echo $academy['title']; ?></div>
        <div class="text"><?php echo $academy['text']; ?></div>
        <div class="badge"><?php echo $academy['badge']; ?></div>
        <div class="icon"><img src="<?php echo $academy['image']['url']; ?>"></div>

        <a class="btn <?php echo $academy['cta_color']; ?>"
          href="<?php echo $academy["cta"]["url"]; ?>"><?php echo $academy["cta"]["title"]; ?></a>
      </div>
      <?php endif; ?>                               
    </div>
  </section>
</main>

<?php 
    get_footer(); 
?>