<?php
  function get_flexible_block() {
    switch (get_row_layout()):
      case 'blocks_icon_text': ?>
<?php if (get_sub_field('title')): ?>
<h2 class="h2 text-center"><?php the_sub_field('title'); ?></h2>
<?php endif; ?>
<?php if (have_rows('block')): ?>

<div class="container icon-block-ct">
  <div class="icon-block--wrapper advantages-slick">
    <?php while (have_rows('block')) : the_row(); ?>
    <article class="icon-block">
      <header>
        <img src="<?php the_sub_field('icon'); ?>" alt="Icone">
        <h3><?php the_sub_field('title'); ?></h3>
      </header>
      <?php the_sub_field('text'); ?>
    </article>
    <?php endwhile; ?>
  </div>
</div>
<?php endif;
        break; ?>

<?php case 'floating_circles': ?>
<div class="floating-circles--block container">
  <div class="container text-center">
    <h2 class="h2"><?php the_sub_field('title'); ?></h2>
    <p><?php the_sub_field('subtitle'); ?></p>
  </div>
  <?php if (have_rows('business')) : ?>
  <div class="floating-circles">
    <div class="circles-viewport">
      <?php
                  $index = 1;
                  while (have_rows('business')) : the_row(); ?>
      <a class="circle circle-<?php echo $index; ?>" href="<?php the_sub_field('link'); ?>"
        title="<?php the_sub_field('name'); ?>" target="_blank">
        <?php $image = get_sub_field('image'); ?>
        <img src="<?php echo $image['sizes']['medium']; ?>" alt="Logo <?php the_sub_field('name'); ?>">
      </a>
      <?php
                  $index++;
                  endwhile;
                ?>
    </div>
  </div>
  <?php endif; ?>

</div>
<?php break;

        case 'big_image_text': ?>
<div class="container">
  <div class="big-image--block">
    <div class="features--img">
      <div class="img--text">
        <?php
                    $key1 = get_sub_field('key_1');
                    $key2 = get_sub_field('key_2');
                  ?>
        <div class="features--number">
          <img src="<?php echo $key1['icon'] ?>" alt="Icon">
          <p class="value"><?php echo $key1['value']; ?></p>
          <p class="unit"><?php echo $key1['unit']; ?></p>
        </div>
        <div class="features--number">
          <img src="<?php echo $key2['icon'] ?>" alt="Icon">
          <p class="value"><?php echo $key2['value']; ?></p>
          <p class="unit"><?php echo $key2['unit']; ?></p>
        </div>
      </div>
    </div>
    <div class="features--text text">
      <h2 class="h2"><?php strip_the_field(get_sub_field('title'), '<strong>'); ?></h2>
      <?php the_sub_field('text'); ?>
      <?php $link = get_sub_field('link'); ?>
      <a href="<?php echo $link['url']; ?>" class="link"><?php echo $link['title']; ?> <span
          class="arrow-char">→</span></a>
    </div>
    <a href="<?php echo $link['url']; ?>" class="mobile-link link"><?php echo $link['title']; ?> <span
        class="arrow-char">→</span></a>
  </div>
</div>
<?php break;

        case 'block_with_icones_and_values': ?>
<div class="container">
  <div class="block-icons-values">
    <div class="features--img">
      <?php while (have_rows('values')) : the_row(); 
                $img = get_sub_field('icon'); ?>
      <div class="img--text">
        <div class="features--number">
          <img src="<?php echo $img['url']; ?>" alt="Icon">
          <div>
            <p class="value"><?php the_sub_field('value'); ?></p>
            <p class="unit"><?php the_sub_field('label'); ?></p>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
    <?php if (get_sub_field('link')):
              $link = get_sub_field('link'); ?>
    <a href="<?php echo $link['url']; ?>" class="mobile-link link text-center"><?php echo $link['title']; ?> <span
        class="arrow-char">→</span></a>

    <?php endif; ?>
  </div>
</div>
<?php break;

        case 'screenshots_comparison': ?>
<div class="container text-center screenshots-block">
  <h2 class="h2"><?php the_sub_field('title'); ?></h2>
  <p class="subtitle"><?php the_sub_field('subtitle'); ?></p>
  <div class="screenshots--wrapper">
    <?php
                $solution1 = get_sub_field('solution_1');
                $solution2 = get_sub_field('solution_2');
              ?>
    <div class="screenshot">
      <figure>
        <div class="image-in-browser">
          <img src="<?php echo $solution1['screenshot']['sizes']['large'] ?>" alt="Screenshot application">
        </div>
      </figure>
      <?php echo $solution1['legend']; ?>
      <a href="<?php echo $solution1['link']['url']; ?>"
        class="btn btn-primary"><?php echo $solution1['link']['title']; ?></a>
    </div>
    <div class="screenshot">
      <figure>
        <div class="image-in-browser">
          <img src="<?php echo $solution2['screenshot']['sizes']['large'] ?>" alt="Screenshot application">
        </div>
      </figure>
      <?php echo $solution2['legend']; ?>
      <a href="<?php echo $solution2['link']['url']; ?>"
        class="btn btn-secondary"><?php echo $solution2['link']['title']; ?></a>
    </div>
  </div>
</div>
<?php break;

        case 'testimonial_slider' : ?>
<div class="testimonials-slick">
  <?php
            $args = array(
                'post_type'=> 'user-stories',
                'numberposts' => -1,
                'meta_key'  => 'is_visible',
                'meta_value' => true,
                );

            $posts = get_posts($args);
          ?>

  <?php foreach ($posts as $post) : ?>
  <?php $_postFields = get_fields($post->ID); ?>
  <div class="testimonial">
    <div class="content">
      <?php if ($_postFields['author']['picture']) : ?>
      <img class="main-img" src="<?php echo $_postFields['author']['picture']['sizes']['thumbnail']; ?>"
        alt="<?php echo $_postFields['quote']['author']['name']; ?> photo">
      <?php else : ?>
      <div></div>
      <?php endif;?>
      <p class="main-text">"<?php echo $_postFields['quote']['text']; ?>"</p>
      <div class="testimonial--author">
        <p class="name"><?php echo $_postFields['quote']['author']['name']; ?></p>
        <p class="job"><?php echo $_postFields['quote']['job_title']; ?></p>
      </div>
      <a href="<?php echo get_permalink($post); ?>" class="readmore-btn"><?php pll_e("Read more"); ?></a>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php break;

        case 'press_slider' : ?>
<section class="press container text-center">
  <h2 class="h2"><?php the_sub_field('title'); ?></h2>
  <div class="press-slick">
    <?php
                $press_list = get_sub_field('press');
                foreach ($press_list as $press) :
              ?>
    <a class="press--slide" target="_blank" href="<?php echo $press['link']; ?>" title="<?php echo $press['name']; ?>">
      <div class="vertical-align-img">
        <img src="<?php echo $press['image']['sizes']['medium'] ?>" alt="Logo <?php echo $press['name']; ?>">
      </div>
    </a>
    <?php endforeach; ?>
  </div>
</section>
<?php break;

        case 'newsletter_subscription' : ?>
<div class="newsletter">
  <div class="container">
    <div class="text-center">
      <h2 class="h2"><?php the_sub_field('title'); ?></h2>
      <p class="header--text"><?php the_sub_field('subtitle'); ?></p>
      <p class="text"><?php the_sub_field('text'); ?></p>

      <?php the_sub_field('form_code'); ?>
    </div>

  </div>
</div>
<?php break;

        case 'timeline' : ?>
<div class="container icon-block-ct">
  <h2 class="h2"><?php the_sub_field('title'); ?></h2>
  <div class="icon-block--wrapper timeline-slick">
    <?php while (have_rows('dates')) : the_row(); ?>
    <article class="icon-block">
      <header>
        <img src="<?php the_sub_field('icon'); ?>" alt="Icone">
        <h3><?php the_sub_field('date_text'); ?></h3>
      </header>
      <p><?php the_sub_field('description'); ?></p>
    </article>
    <?php endwhile; ?>
  </div>
</div>
<?php break;

        case 'text_paragraphs' : ?>
<div class="container text-block <?php the_sub_field('main_color'); ?>">
  <?php if (get_sub_field('title')) : ?>
  <h2 class="h2"><?php strip_the_field(get_sub_field('title'),'<strong>'); ?></h2>
  <?php endif; ?>

  <?php if (!get_sub_field('two_columns')) : ?>
  <?php while (have_rows('full_paragraphs')) : the_row(); ?>
  <div class="text text-paragraph <?php the_sub_field('primary_color'); ?>">
    <h3 class="h2 <?php the_sub_field('primary_color'); ?>"><?php the_sub_field('title'); ?></h3>
    <?php if (get_sub_field('subtitle')) : ?>
    <h4><?php the_sub_field('subtitle'); ?></h4>
    <?php endif; ?>
    <?php the_sub_field('text'); ?>
  </div>
  <?php endwhile; ?>

  <?php else : ?>
  <?php $columns = get_sub_field('columns'); ?>
  <div class="two-columns--text text-paragraph">
    <?php foreach ($columns as $column) : ?>
    <div class="column">
      <?php foreach ($column as $paragraph) : ?>
      <div class="text <?php echo $paragraph['primary_color']; ?>">
        <?php if ($paragraph['title']): ?>
        <h3 class="h2 <?php echo $paragraph['primary_color']; ?>"><?php echo $paragraph['title']; ?></h3>
        <?php endif; ?>
        <?php if ($paragraph['subtitle']) : ?>
        <h4><?php echo $paragraph['subtitle']; ?></h4>
        <?php endif; ?>
        <?php echo $paragraph['text']; ?>
        <?php echo $paragraph['code']; ?>
        <?php if ($paragraph['image']) : ?>
        <img src="<?php echo $paragraph['image']['sizes']['large']; ?>" alt="<?php echo $paragraph['image']['alt']; ?>">
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <?php if (get_sub_field('centered_image')) : ?>
  <?php $image = get_sub_field('centered_image'); ?>
  <div class="text-center centered-image">
    <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
  </div>
  <?php endif; ?>

  <?php if (get_sub_field('links')) : ?>
  <div class="links-ct text-center">
    <?php foreach (get_sub_field('links') as $link) : ?>
    <a href="<?php echo $link['link']['url']; ?>" class="btn btn-primary"><?php echo $link['link']['title']; ?></a>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>
<?php break;

        case 'text_bg_image' : ?>
<div class="text-with-bg" style="background-image: url('<?php the_sub_field('bg_image');?>);">
  <div class="container">
    <?php the_sub_field('text'); ?>
  </div>
</div>
<?php break;

        case 'row_images' : ?>
<div class="row-gallery">
  <?php $gallery = get_sub_field('images'); ?>
  <?php foreach ($gallery as $image) : ?>
  <div class="image-ct">
    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
  </div>
  <?php endforeach; ?>
</div>
<?php break;

        case 'team_presentation' : ?>
<div class="container team-block" id="our-team">
  <h2 class="h2"><?php strip_the_field(get_sub_field('title'),'<strong>'); ?></h2>
  <?php $members = get_sub_field('team_members'); ?>
  <div class="members-ct">
    <?php foreach ($members as $member) : ?>
    <div class="member">
      <figure>
        <img class="member--photo" src="<?php echo $member['photo']['sizes']['medium']; ?>"
          alt="<?php echo $member['name'];?>">
      </figure>
      <h3><?php echo $member['name']; ?></h3>
      <p class="position"><?php echo $member['job']; ?></p>
    </div>
    <?php endforeach; ?>
  </div>
  <div class="team-slick">
    <?php foreach ($members as $member) : ?>
    <div class="member">
      <figure>
        <img class="member--photo" src="<?php echo $member['photo']['sizes']['medium']; ?>"
          alt="<?php echo $member['name'];?>">
      </figure>
      <h3><?php echo $member['name']; ?></h3>
      <p class="position"><?php echo $member['job']; ?></p>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php break;

        case 'welcome_jungle' : ?>
<div class="hiring-block">
  <div class="hiring--image" style="background-image: url('<?php the_sub_field('image');?>);"></div>
  <div class="hiring--content">
    <img src="<?php add_img_html('wttj-square.svg'); ?>" alt="Wttj Logo">
    <p><?php the_sub_field('text'); ?></p>
    <?php $link = get_sub_field('link'); ?>
    <a target="_blank" href="<?php echo $link['url']; ?>" class="btn"><?php echo $link['title']; ?></a>
  </div>
</div>
<?php break;

        case 'external_link' : ?>
<div class="external-link-block">
  <div class="container">
    <h2 class="h2"><?php strip_the_field(get_sub_field('title'),'<strong>'); ?></h2>
    <img class="external--img" src="<?php the_sub_field('image'); ?>" alt="<?php the_sub_field('subtitle'); ?>">
    <h3><?php the_sub_field('subtitle'); ?></h3>
    <?php the_sub_field('text'); ?>
    <?php $link = get_sub_field('link_button'); ?>
    <a href="<?php echo $link['url']; ?>" target="_blank" class="btn purple"><?php echo $link['title']; ?></a>
  </div>
</div>
<?php break;

        case 'external_links' : ?>
<div class="external-link-block">
  <div class="container">
    <h2 class="h2"><?php strip_the_field(get_sub_field('title'),'<strong>'); ?></h2>
    <div class="two-columns--text" style="display:flex">
      <?php foreach (get_sub_field('blocks') as $block) : ?>
      <div class="column" style="flex:1">
        <img class="external--img" src="<?= $block['image']['sizes']['medium']; ?>" alt="<?= $block['title']; ?>"
          style="height:100px;width:auto">
        <h3><?= $block['title']; ?></h3>
        <?= $block['text']; ?>
        <?php $link = $block['link_button']; ?>
        <a href="<?php echo $link['url']; ?>" target="_blank" class="btn purple"><?php echo $link['title']; ?></a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php break;

        case 'references_block' : ?>
<div class="references-block">
  <div class="container">
    <h2 class="h2"><?php strip_the_field(get_sub_field('title'),'<strong>'); ?></h2>
    <?php $references = get_sub_field('references'); ?>
    <div class="references-ct">
      <?php foreach ($references as $ref) : ?>
      <a href="<?php echo $ref['link']; ?>" title="<?php echo $ref['title'];?>" target="_blank"><img
          src="<?php echo $ref['image']['sizes']['medium']; ?>" alt="<?php echo $ref['image']['alt']; ?>"></a>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php break;

        case 'gatling_presentation' : ?>
<div class="container gatling-presentation">
  <div class="presentation--content">
    <h2 class="h2 h2-bar"><?php the_sub_field('title'); ?></h2>
    <div class="text">
      <?php the_sub_field('text'); ?>
    </div>
    <?php $link = get_sub_field('button_link'); ?>
    <a href="<?php echo $link['url']; ?>" class="btn btn-secondary"><?php echo $link['title']; ?></a>
  </div>
  <div class="release-info">
    <h3><img class="icon"
        src="<?php add_img_html('information-icon.svg'); ?>" /><?php the_sub_field('information_block_title'); ?></h3>
    <?php $information = get_sub_field('information'); ?>
    <ul>
      <?php foreach ($information as $value) : ?>
      <li><?php echo $value['information_title']; ?><br />
        <?php echo $value['information_value']; ?></li>
      <?php endforeach ;?>
    </ul>
  </div>
</div>
<?php break;

        case 'get_gatling_block' : ?>
<div class="container get-gatling">
  <h2 class="h2 h2-bar"><?php the_sub_field('title'); ?></h2>
  <div class="method-ct">
    <?php $method1 = get_sub_field('first_method'); ?>
    <div class="method">
      <h3><span class="round-number">1</span><?php echo $method1['title']; ?></h3>
      <p class="text-center"><?php echo $method1['text']; ?></p>
      <div class="text-center">
        <img class="icon" src="<?php add_img_html('download-icon.svg') ;?>" alt="Download icon">
        <a href="<?php echo $method1['button_link']['url']; ?>"
          class="btn btn-primary"><?php echo $method1['button_link']['title']; ?></a>
      </div>
    </div>
    <?php $method2 = get_sub_field('second_method'); ?>
    <div class="method">
      <h3><span class="round-number">2</span><?php echo $method2['title']; ?></h3>
      <div class="text">
        <?php echo $method2['text']; ?>
      </div>
      <?php $tools = $method2['tools']; ?>
      <?php foreach ($tools as $tool) : ?>
      <div class="tool-instruction">
        <div class="title"><?php echo $tool['title'] ; ?></div>
        <div class="instruction--content">
          <?php foreach($tool['instructions'] as $instruction) : ?>
          <div class="step">
            <?php echo $instruction['text']; ?>
            <pre><code class="language-<?php echo $instruction['language']; ?>"><?php echo htmlspecialchars($instruction['code_snippet']); ?></code></pre>
          </div>
          <?php endforeach ;?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php break;

        case "resources_block" : ?>
<div class="container resources-block">
  <h2 class="h2 h2-bar"><?php the_sub_field('title'); ?></h2>
  <div class="resources-ct resources-slick">
    <?php foreach (get_sub_field('resources') as $resource) : ?>
    <div class="resource">
      <img src="<?php echo $resource['icon']; ?>" alt="Icon <?php echo $resource['title']; ?>">
      <h3><?php echo $resource['title']; ?></h3>
      <div class="links">
        <?php foreach ($resource['links'] as $link) : ?>
        <a target="<?php echo $link['button_link']['target']; ?>" href="<?php echo $link['button_link']['url']; ?>"
          class="btn <?php echo $link['button_color']; ?>"><?php echo $link['button_link']['title']; ?></a>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php break;

        case "text-with-image" : ?>
<div class="text-with-image">
  <div class="container">
    <h2 class="h2
    <?php if (get_sub_field('bar_on_title')) echo 'h2-bar -'.get_sub_field('bar_color'); ?>
    "><?php the_sub_field('title'); ?></h2>
    <div class="text-ct">
      <div class="text">
        <?php the_sub_field('text'); ?>
        <?php $link = get_sub_field('button_link'); ?>
        <?php if ($link) : ?>
        <div class="text-center">
          <a href="<?php echo $link['url']; ?>" class="btn btn-primary"><?php echo $link['title']; ?></a>
        </div>
        <?php endif; ?>
      </div>
      <div class="image">
        <?php $image = get_sub_field('image'); ?>
        <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
      </div>
    </div>
  </div>
</div>
<?php break;

        case "price_comparison" : ?>
<div id="price-comparison" class="price-comparison">
  <div class="title">
    <?php $image = get_sub_field('image_title'); ?>
    <?php if ($image) : ?>
    <img src="<?php echo $image; ?>" alt="<?php the_sub_field('title'); ?>">
    <?php endif; ?>
    <h2 class="<?php if ($image) {echo "hidden";} ?>"><?php the_sub_field('title'); ?></h2>
  </div>
  <?php
              $blocs2 = get_sub_field('blocs_2');
              $numBlocs = 0;
              if ($blocs2) {
                $numBlocs = count($blocs2);
              }
            ?>
  <div class="container<?php if ($numBlocs === 5) {echo '-5';} ?>">
    <div class="price-slick<?php if ($numBlocs === 5) {echo '-5';} elseif ($numBlocs > 2) {echo '-2';} ?>">
      <?php if (get_sub_field('template') == 'template-1') : ?>
      <?php foreach (get_sub_field('blocs_1') as $bloc) : ?>
      <div class="price-bloc template-1">
        <img class="main-icon" src="<?php echo $bloc['icon']; ?>" alt="Icon <?php echo $bloc['title']; ?>">
        <h3><?php echo $bloc['title']; ?></h3>
        <div class="price-text"><span
            class="currency"><?php echo $bloc['currency']; ?></span><?php echo $bloc['price']; ?></div>
        <?php echo $bloc['detail']; ?>
      </div>
      <?php endforeach ;?>
      <?php else : ?>
      <?php $index = 0; ?>
      <?php foreach (get_sub_field('blocs_2') as $bloc) : ?>
      <div class="price-bloc template-2">
        <img class="main-icon" src="<?php echo $bloc['icon']; ?>" alt="Icon <?php echo $bloc['title']; ?>">
        <h3><?php echo $bloc['title']; ?></h3>
        <p class="subtitle"><?php echo $bloc['subtitle']; ?></p>
        <div class="price-text <?= gtl_price_comparison_color($index) ?>">
          <span class="info"><?php echo $bloc['abo_infos']['prefixe']; ?></span><span
            class="currency"><?php echo $bloc['currency']; ?></span><?php echo $bloc['price']; ?><span
            class="info"><?php echo $bloc['abo_infos']['suffix']; ?></span>
          <p class="other-price"><?php echo $bloc['other_price']; ?></p>
        </div>
        <?php echo $bloc['detail']; ?>
        <a class="btn <?= gtl_price_comparison_color($index) ?>"
          href="<?php echo $bloc['button_link']['url']; ?>"><?php echo $bloc['button_link']['title']; ?></a>
      </div>
      <?php $index++; ?>
      <?php endforeach ;?>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php break;

        case "training_information": ?>
<div class="container training-block">
  <div class="training--program">
    <?php $program = get_sub_field('training_program'); ?>
    <h2><?php echo $program['title']; ?></h2>
    <?php $index = 1;
              foreach ($program['program_days'] as $day) : ?>
    <div class="program--day">
      <h3><img src="<?php add_img_html('calendar-date.svg'); ?>" alt="Calendar icon"><?php pll_e("DAY"); ?>
        <?php echo $index; ?></h3>
      <h4><?php pll_e("Morning:"); ?></h4>
      <?php echo $day['morning_content']; ?>
      <h4><?php pll_e("Afternoon:"); ?></h4>
      <?php echo $day['afternoon_content']; ?>
    </div>
    <?php $index++; endforeach; ?>
  </div>
  <div class="training--sessions">
    <?php $sessions = get_sub_field('public_sessions'); ?>
    <h2><?php echo $sessions['title']; ?></h2>
    <div class="sessions-ct">
      <?php foreach ($sessions['sessions'] as $session) : ?>
      <div class="session">
        <h4><?php echo $session['date']; ?></h4>
        <div class="session--address">
          <img src="<?php echo $session['address_icon']; ?>" alt="Country Icon">
          <p><?php pll_e("Where?"); ?><br /><?php echo $session['address_text']; ?></p>
        </div>
        <a href="<?php echo get_permalink(4710);?>" class="btn purple"><?php pll_e("I am interested!"); ?></a>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="sessions-slick">
      <?php foreach ($sessions['sessions'] as $session) : ?>
      <div class="session">
        <h4><?php echo $session['date']; ?></h4>
        <div class="session--address">
          <img src="<?php echo $session['address_icon']; ?>" alt="Country Icon">
          <p><?php pll_e("Where?"); ?><br /><?php echo $session['address_text']; ?></p>
        </div>
        <a href="#" class="btn purple"><?php pll_e("I am interested!"); ?></a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php break;

        case 'tiles_and_text': ?>
<div class="container tiles-block">
  <h2 class="h2 h2-bar"><?php the_sub_field('title');?></h2>
  <div class="tiles--text">
    <div class="text">
      <?php the_sub_field('text'); ?>
    </div>
    <?php $image = get_sub_field('image'); ?>
    <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>">
  </div>
  <div class="tiles-slick">
    <?php foreach (get_sub_field('tiles') as $tile) : ?>
    <div>
      <div class="small-tiles">
        <img src="<?php echo $tile['icon']; ?>" alt="Icon <?php echo $tile['title']; ?>">
        <h3><?php echo $tile['title']; ?></h3>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <div class="tiles">
    <div class="small-tiles-ct">
      <?php foreach (get_sub_field('tiles') as $tile) : ?>
      <div class="small-tiles">
        <img src="<?php echo $tile['icon']; ?>" alt="Icon <?php echo $tile['title']; ?>">
        <h3><?php echo $tile['title']; ?></h3>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="release-info">
      <?php $information = get_sub_field('information_tile'); ?>
      <h3><img class="icon" src="<?php add_img_html('information-icon.svg'); ?>" /><?php echo $information['title']; ?>
      </h3>
      <ul>
        <?php foreach ($information['entries'] as $value) : ?>
        <li><?php echo $value['title']; ?><br />
          <?php echo $value['value']; ?></li>
        <?php endforeach ;?>
      </ul>
      <a href="<?php echo $information['button_1']['url']; ?>" class="btn btn-icon btn-1"><img
          src="<?php add_img_html('bookmark-icon.svg'); ?>"
          alt="Icon"><?php echo $information['button_1']['title']; ?></a>
      <a href="<?php echo $information['button_2']['url']; ?>" class="btn btn-icon purple btn-2"><img
          src="<?php add_img_html('doc-icon.svg');?>" alt="Icon"><?php echo $information['button_2']['title']; ?></a>
    </div>
  </div>
</div>
<?php break;

        case 'demo_block' : ?>
<div class="container demo-block">
  <div class="content">
    <h2 class="h2 h2-bar"><?php the_sub_field('title'); ?></h2>
    <div class="demo--link">
      <img src="<?php add_img_html('calendar-book.svg') ;?>" alt="Icon calendar">
      <?php $link = get_sub_field('demo_link'); ?>
      <a href="<?php echo $link['url']; ?>" class="btn btn-primary"><?php echo $link['title']; ?></a>
    </div>
  </div>
  <div class="image-in-browser">
    <img src="<?php the_sub_field('image'); ?>" alt="Demo image">
  </div>
</div>
<?php break;

        case 'paragraph_links_column' : ?>
<div class="container links-column">
  <?php foreach (get_sub_field('paragraphs') as $paragraph) : ?>
  <div class="text-paragraph">
    <div class="text">
      <h2 class="h2 h2-bar"><?php echo $paragraph['title']; ?></h2>
      <?php echo $paragraph['text']; ?>
    </div>
    <?php if ($paragraph['has_links']) : ?>
    <div class="links">
      <?php if ($paragraph['buttons']) : ?>
      <?php foreach ($paragraph['buttons'] as $button) : ?>
      <a class="btn <?php echo $button['color']; ?> <?php if ($button['icon']!='none') {echo 'btn-icon';} ?>"
        href="<?php echo $button['link']['url'];?>">
        <?php if ($button['icon'] === 'bookmark') : ?>
        <img src="<?php add_img_html('bookmark-icon.svg'); ?>" alt="Bookmark icon">
        <?php elseif ($button['icon'] === 'doc') : ?>
        <img src="<?php add_img_html('doc-icon.svg'); ?>" alt="Doc icon">
        <?php endif; ?>
        <?php echo $button['link']['title']; ?>
      </a>
      <?php endforeach; ?>
      <?php endif; ?>
      <?php if ($paragraph['image_link']) : ?>
      <a class="image-link" href="<?php echo $paragraph['image_link']['link']; ?>">
        <img src="<?php echo $paragraph['image_link']['image']['sizes']['medium']; ?>"
          alt="<?php echo $paragraph['image_link']['image']['alt']; ?>">
      </a>
      <?php endif; ?>
    </div>
    <?php endif; ?>
  </div>
  <?php endforeach; ?>
</div>
<?php break;

        case 'table_comparison_block' : ?>
<div class="container table-comparison-block">
  <h2 class="h2 text-center"><?php the_sub_field('title'); ?></h2>
  <p class="subtitle text-center"><?php the_sub_field('subtitle'); ?></p>
  <div class="button-ct">
    <button class="solution-btn clean-btn active" data-solution="solution-1"><img
        src="<?php the_sub_field('solution_1'); ?>" alt="Load Testing"></button>
    <button class="solution-btn clean-btn solution-2" data-solution="solution-2"><img
        src="<?php the_sub_field('solution_2'); ?>" alt="FrontLine"></button>
  </div>
  <table class="table-comparison">
    <tr class="row-header category-1">
      <td></td>
      <td><img src="<?php the_sub_field('solution_1'); ?>" alt="Load Testing"></td>
      <td><img src="<?php the_sub_field('solution_2'); ?>" alt="FrontLine"></td>
    </tr>
    <?php foreach (get_sub_field('differences') as $category) : ?>
    <tr class="row-category category-1">
      <td><?php echo $category['category']; ?></td>
      <td></td>
      <td></td>
    </tr>
    <?php foreach ($category['difference'] as $difference) : ?>
    <tr class="category-1">
      <td class="td-name"><?php echo $difference['name']; ?></td>
      <td class="td-check">
        <?php if($difference['solution_1_has-it']) : ?>
        <span class="icon-checkmark"><?php pll_e("Yes"); ?></span>
        <?php else : ?>
        <span class="icon-minus"><?php pll_e("No"); ?></span>
        <?php endif; ?>
      </td>
      <td class="td-check">
        <?php if($difference['solution_2_has-it']) : ?>
        <span class="icon-checkmark"><?php pll_e("Yes"); ?></span>
        <?php else : ?>
        <span class="icon-minus"><?php pll_e("No"); ?></span>
        <?php endif; ?>
      </td>
    </tr>
    <?php endforeach ;?>
    <?php endforeach; ?>
  </table>
</div>
<?php break;

        case 'full_width_row' : ?>
<?php the_sub_field('content'); ?>
<?php break;

        case 'accordion_panel' : ?>
<div class="container get-gatling">
  <h2 class="h2 h2-bar"><?php the_sub_field('title'); ?></h2>
  <?php the_sub_field('subtitle'); ?>
  <?php foreach (get_sub_field('panel') as $panel) : ?>
  <div class="tool-instruction">
    <div class="title"><?php echo $panel['title']; ?></div>
    <div class="instruction--content">
      <?php echo $panel['content']; ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php break;

        case 'simple_block' : ?>
<div class="container simple-block
          <?php if (get_sub_field('image_position') == 'left') echo '-inversed'; ?>">
  <div class="block-content">
    <?php if (get_sub_field('icon')): 
      $image = get_sub_field('icon');?>
      <img src="<?php echo $image['url']; ?>" alt="" class="icon">      
    <?php endif; ?>
    <h2 class="h2"><?php the_sub_field('title'); ?></h2>
        <?php if (get_field('subtitle')): ?>
      <h4><?php the_sub_field('subtitle'); ?></h4>
        <?php endif; ?>
      <div class="text">
        <?php the_sub_field('text'); ?>
      </div>

      <?php 
      if (get_sub_field('cta')):
      $link = get_sub_field('cta'); ?>
      <a href="<?php echo $link['url']; ?>"
        class="btn <?php the_sub_field('cta_color'); ?>"><?php echo $link['title']; ?></a>
      <?php endif; ?>

      <?php 
      if (get_sub_field('link')):
      $link = get_sub_field('link'); ?>
      <a href="<?php echo $link['url']; ?>"
        class="link mobile-link"><?php echo $link['title']; ?><span
      class="arrow-char">→</span></a>
      <?php endif; ?>
  </div>
  <div class="image-content">
    <?php $img = get_sub_field('image'); ?>
    <img src="<?php echo $img['url']; ?>" alt="">
  </div>
</div>
<?php break;

        case 'testimonial_block' : ?>
<div class="testimonials-block container">
  <h2 class="text-center h2"><?php the_sub_field('title'); ?></h2>
  <?php
            $args = array(
                'post_type'=> 'user-stories',
                'numberposts' => -1,
                'meta_key'  => 'is_visible',
                'meta_value' => true,
                );

            $posts = get_posts($args);
          ?>

  <?php foreach ($posts as $post) : ?>
  <div class="testimonial">
    <div class="content">
      <img src="<?php echo get_the_post_thumbnail_url($post->ID,'medium'); ?>" alt="" class="testi_img">

      <?php $quote = get_field('quote', $post->ID); ?>
      <div class="testimonial-content">
        <div class="text">
          <?php echo $quote['text']; ?>

        </div>
        <div class="bottom-testimonial">

          <span class="author">
            <?php echo $quote['author']['name']; ?>
          </span>
          - <?php echo $quote['job_title']; ?>
        </div>
      </div>
      <a href="<?php echo get_permalink($post); ?>" class="readmore-btn"><?php pll_e("Read more"); ?></a>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php break;

case 'useful_resources' : ?>
<div class="useful-resources-block container">
  <?php if (get_field('title')): ?>
  <h2 class="text-center h2"><?php the_sub_field('title'); ?></h2>
  <?php endif; ?>

  <?php if (get_sub_field('show_see_more')): 
    $see_more = get_sub_field('see_more'); ?>
  <div class="see-more text-center">
    <div class="text"><?php echo $see_more['text']; ?></div>
    <a class="btn <?php echo $see_more['cta_color']; ?>"
      href="<?php echo $see_more["cta"]["url"]; ?>"><?php echo $see_more["cta"]["title"]; ?></a>
  </div>
  <?php endif; ?>

  <?php if (get_sub_field('show_academy')): ?>
  <?php $academy = get_sub_field('gatling_academy'); ?>
  <div class="gatling-academy" style="background-image:url(<?php echo $academy['background']['url']; ?>)">
    <div class="title"><?php echo $academy['title']; ?></div>
    <div class="text"><?php echo $academy['text']; ?></div>
    <div class="badge"><?php echo $academy['badge']; ?></div>
    <div class="icon"><img src="<?php echo $academy['image']['url']; ?>"></div>

    <a class="btn <?php echo $academy['cta_color']; ?>"
      href="<?php echo $academy["cta"]["url"]; ?>"><?php echo $academy["cta"]["title"]; ?></a>
  </div>
  <?php endif; ?>

  <?php if (get_sub_field('show_resources')): ?>
  <div class="resources-grid">
    <?php 
      $resources = get_sub_field('resources');
      foreach($resources as $resource):  ?>

    <?php 
                      $_postFields = get_fields($resource->ID);
                      $terms = get_the_terms($resource->ID, 'resources_cat');
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
          <?php if ($resource->post_title !== '') { echo $resource->post_title; } else { echo $terms[0]->name; } ?>
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
    <?php endforeach; ?>

  </div>
  <?php endif; ?>

  <?php if (get_sub_field('link')):
                $link = get_sub_field('link'); ?>
  <a href="<?php echo $link['url']; ?>" class="mobile-link link text-center"><?php echo $link['title']; ?> <span
      class="arrow-char">→</span></a>

  <?php endif; ?>
</div>
<?php break;

case 'get_started' : ?>
<div class="get-started-block container">
  <?php while (have_rows('blocks')): the_row(); ?>
  <div class="block">
    <div class="icon">
      <?php $img = get_sub_field('icon'); ?>
      <img src="<?php echo $img['url']; ?>" alt="">
    </div>
    <div class="title -accent-<?php the_sub_field('accent_color'); ?>"><?php the_sub_field('title'); ?></div>
    <div class="text"><?php the_sub_field('text'); ?></div>
  </div>
  <?php endwhile; ?>
</div>
<?php break;

case 'protips' : ?>
<div class="protips-block container">
  <h2 class="h2 text-center"><?php the_sub_field('title'); ?></h2>
  <div class="tips">
    <?php 
      $i = 1;
      while (have_rows('tips')): the_row(); ?>
    <div class="tip">
      <div class="number"><?php echo $i; ?></div>
      <div class="tip-content">
        <div class="tip-title"><?php the_sub_field('title'); ?></div>
        <div class="tip-text"><?php the_sub_field('text'); ?></div>
      </div>
      <?php $link = get_sub_field('cta'); ?>
      <a class="btn <?php the_sub_field('cta_color'); ?>" href="<?php echo $link['url']; ?>">
        <?php echo $link['title']; ?></a>
    </div>
    <?php $i++; endwhile; ?>
  </div>
</div>
<?php break;

      default:
        echo "Flexible content not defined ".get_row_layout();
    endswitch;
  }
?>