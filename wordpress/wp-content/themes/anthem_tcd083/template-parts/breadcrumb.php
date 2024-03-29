<?php
     $options = get_design_plus_option();
     global $post;
?>
<div id="bread_crumb">
 <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList">
<?php
     // news archive -----------------------
     if(is_post_type_archive('news')) {
?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['news_label']); ?></span><meta itemprop="position" content="2"></li>

<?php
     // info news -----------------------
     } elseif($_SERVER['REQUEST_URI'] === '/info/news/') {
?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="/info/"><span itemprop="name">お知らせ</span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
   <span itemprop="name" itemprop="item">お知らせ</span><meta itemprop="position" content="3">
 </li>
<?php
     // info schedule -----------------------
     } elseif($_SERVER['REQUEST_URI'] === '/info/schedule/') {
?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="/info/"><span itemprop="name">お知らせ</span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
   <span itemprop="name" itemprop="item">スケジュール</span><meta itemprop="position" content="3">
 </li>
<?php
     // news single -----------------------
     } elseif(is_singular('news')) {
?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><span itemprop="name"><?php echo esc_html($options['news_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
<?php
     // Search -----------------------
     } elseif(is_search()) {
?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php _e('Search result','tcd-w'); ?></span><meta itemprop="position" content="2"></li>
<?php
     // Blog page -----------------------
     } elseif(is_home()) {
?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['blog_label']); ?></span><meta itemprop="position" content="2"></li>
<?php
     // Category, Tag , Archive page -----------------------
     } elseif(is_category() || is_tag() || is_day() || is_month() || is_year()) {
       if (is_category()) {
         $title = single_cat_title('', false);
       } elseif( is_tag() ) {
         $title = single_tag_title('', false);
       } elseif (is_day()) {
         $title = sprintf(__('Archive for %s', 'tcd-w'), get_the_time(__('F jS, Y', 'tcd-w')) );
       } elseif (is_month()) {
         $title = sprintf(__('Archive for %s', 'tcd-w'), get_the_time(__('F, Y', 'tcd-w')) );
       } elseif (is_year()) {
         $title = sprintf(__('Archive for %s', 'tcd-w'), get_the_time(__('Y', 'tcd-w')) );
       };
?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($options['blog_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($title); ?></span><meta itemprop="position" content="3"></li>
<?php
     //  Page -----------------------
     } elseif(is_page()) {
?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
<?php
     // Other page -----------------------
     } else {
     $category = get_the_category();
?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($options['blog_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
<?php }; ?>
 </ul>
</div>