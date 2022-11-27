<?php
     $options = get_design_plus_option();
     get_header();
?>
<div id="index_content_builder">
<?php
     // コンテンツビルダー
     if ($options['contents_builder'] || $options['mobile_contents_builder']) :
       $content_count = 1;
       if(is_mobile() && $options['mobile_show_contents_builder']) {
         $contents_builder = $options['mobile_contents_builder'];
       } else {
         $contents_builder = $options['contents_builder'];
       }
       foreach($contents_builder as $content) :

         // レイヤー画像コンテンツ --------------------------------------------------------------------------------
         if ( $content['cb_content_select'] == 'layer_content' && $content['show_content'] ) {
           $image = $content['image'] ? wp_get_attachment_image_src( $content['image'], 'full' ) : '';
           $image_mobile = $content['image_mobile'] ? wp_get_attachment_image_src( $content['image_mobile'], 'full' ) : '';
           if(is_mobile()) {
             $image_layout = 'type1';
             $image_layout2 = 'type2';
             $text_layout = 'type1';
           } else {
             $image_layout = $content['image_layout'];
             $image_layout2 = $content['image_layout2'];
             $text_layout = $content['text_layout'];
           }
?>
<div class="index_layer_content cb_contents inview num<?php echo $content_count; ?> image_layout_<?php echo esc_attr($image_layout); ?> image_layout2_<?php echo esc_attr($image_layout2); ?> image_layout_mobile_<?php echo esc_attr($content['image_layout_mobile']); ?> text_layout_<?php echo esc_attr($text_layout); ?> text_layout_mobile_<?php echo esc_attr($content['text_layout_mobile']); ?> animation_<?php echo esc_attr($content['animation_type']); ?> <?php if(empty($image)){ echo 'no_layer_image'; }; ?>" id="cb_content_<?php echo $content_count; ?>">

 <div class="cb_contents_inner clearfix">

  <div class="content">

   <?php if(!empty($content['catch'])) { ?>
   <h4 class="catch animate_item inview_mobile rich_font_<?php echo esc_attr($content['catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['catch'])); ?></h4>
   <?php }; ?>

   <?php if(!empty($content['desc'])) { ?>
   <p class="desc animate_item inview_mobile"><?php echo wp_kses_post(nl2br($content['desc'])); ?></p>
   <?php }; ?>

   <?php if($content['show_button']){ ?>
   <div class="link_button animate_item inview_mobile">
    <a class="button_animation_<?php echo esc_attr($content['button_animation_type']); ?>" href="<?php echo esc_attr($content['button_url']); ?>" <?php if($content['button_target']){ echo 'target="_blank"'; }; ?>><span><?php echo esc_html($content['button_label']); ?></span></a>
   </div>
   <?php }; ?>

  </div>

 </div><!-- END .cb_contents_inner -->

 <?php if($image) { ?>
 <div class="layer_image animate_item inview_mobile">
  <img <?php if($image_mobile) { echo 'class="pc"'; }; ?> src="<?php echo esc_attr($image[0]); ?>" alt="" title="">
  <?php if($image_mobile) { ?><img class="mobile" src="<?php echo esc_attr($image_mobile[0]); ?>" alt="" title=""><?php }; ?>
 </div>
 <?php }; ?>

 <?php
      if($content['bg_use_overlay']){
        $bg_overlay_color = $content['bg_overlay_color'] ? $content['bg_overlay_color'] : '#000000';
        $bg_overlay_color = hex2rgb($bg_overlay_color);
        $bg_overlay_color = implode(",",$bg_overlay_color);
        $bg_overlay_opacity = $content['bg_overlay_opacity'] ? $content['bg_overlay_opacity'] : '0.3';
 ?>
 <div class="overlay" style="background:rgba(<?php echo $bg_overlay_color; ?>,<?php echo $bg_overlay_opacity; ?>)"></div>
 <?php }; ?>

 <?php
      $bg_image = $content['bg_image'] ? wp_get_attachment_image_src( $content['bg_image'], 'full' ) : '';
      $bg_image_mobile = $content['bg_image_mobile'] ? wp_get_attachment_image_src( $content['bg_image_mobile'], 'full' ) : '';
      if($bg_image) {
 ?>
 <div class="bg_image <?php if($bg_image_mobile) { echo 'pc'; }; ?>" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center center; background-size:cover;"></div>
 <?php if($bg_image_mobile) { ?><div class="bg_image mobile" style="background:url(<?php echo esc_attr($bg_image_mobile[0]); ?>) no-repeat center center; background-size:cover;"></div><?php }; ?>
 <?php }; ?>

</div><!-- END .index_layer_content -->


<?php
     // 商品一覧 --------------------------------------------------------------------------------
     } elseif ( $content['cb_content_select'] == 'product_list' && $content['show_content'] ) {
?>
<div class="index_product_list cb_contents inview num<?php echo $content_count; ?>" id="cb_content_<?php echo $content_count; ?>">

 <div class="cb_contents_inner">

  <?php if(!empty($content['catch'])) { ?>
  <h4 class="cb_catch animate_item rich_font_<?php echo esc_attr($content['catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['catch'])); ?></h4>
  <?php }; ?>

  <?php if(!empty($content['desc'])) { ?>
  <p class="cb_desc animate_item"><?php echo wp_kses_post(nl2br($content['desc'])); ?></p>
  <?php }; ?>

  <?php
       $post_num = $content['post_num'];
       $args = array( 'post_type' => 'product', 'posts_per_page' => $post_num, 'orderby' => array( 'menu_order' => 'ASC', 'date' => 'DESC' ) );
       $post_list_query = new wp_query($args);
       if($post_list_query->have_posts()):
  ?>
  <div class="product_list clearfix animate_item">
   <?php
        while($post_list_query->have_posts()): $post_list_query->the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
         } elseif($options['no_image1']) {
           $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
         } else {
           $image = array();
           $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
         }
         $main_color = get_post_meta($post->ID, 'main_color', true) ?  get_post_meta($post->ID, 'main_color', true) : '#008a98';
         $short_desc = get_post_meta($post->ID, 'short_desc', true);
   ?>
   <article class="item">
    <a class="animate_background" href="<?php the_permalink(); ?>">
     <?php if($image) { ?>
     <div class="image_wrap">
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </div>
     <?php }; ?>
     <h3 class="title rich_font_<?php echo esc_attr($content['title_font_type']); ?>" style="background:<?php echo esc_attr($main_color); ?>;"><span><?php the_title(); ?></span></h3>
     <div class="desc_area">
      <?php if($short_desc) { ?>
      <p class="desc"><span><?php echo esc_html($short_desc); ?></span></p>
      <?php }; ?>
     </div>
    </a>
   </article>
   <?php endwhile; ?>
  </div><!-- END .product_list -->
  <?php endif; ?>

  <?php if($content['show_button']){ ?>
  <div class="link_button inview">
   <a class="button_animation_<?php echo esc_attr($content['button_animation_type']); ?>" href="<?php echo esc_url(get_post_type_archive_link('product')); ?>"><?php echo esc_html($content['button_label']); ?></a>
  </div>
  <?php }; ?>

 </div><!-- END .cb_contents_inner -->

</div><!-- END .index_product_list -->


<?php
     // 記事カルーセル --------------------------------------------------------------------------------
     } elseif ( $content['cb_content_select'] == 'post_slider' && $content['show_content'] ) {
?>
<div class="index_post_slider cb_contents num<?php echo $content_count; ?>" style="background:<?php echo esc_attr($content['background_color']); ?>;" id="cb_content_<?php echo $content_count; ?>">

 <div class="cb_contents_inner">

  <?php if($content['catch'] || $content['desc']) { ?>
  <div class="cb_header">
   <?php if(!empty($content['catch'])) { ?>
   <h4 class="cb_catch inview rich_font_<?php echo esc_attr($content['catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['catch'])); ?></h4>
   <?php }; ?>
   <?php if(!empty($content['desc'])) { ?>
   <p class="cb_desc inview"><?php echo wp_kses_post(nl2br($content['desc'])); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>

  <?php
       $post_num = $content['post_num'];
       $post_type = $content['post_type'];
       $post_order = $content['post_order'];
       if($post_order == 'rand') {
         $args = array( 'post_type' => $post_type, 'orderby' => 'rand', 'posts_per_page' => $post_num );
       } else {
         $args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num );
       }
       $post_list_query = new wp_query($args);
       $total_post_num = $post_list_query->post_count;
       if($post_list_query->have_posts()):
  ?>
  <div class="post_list_slider_wrap inview">
   <div class="post_list clearfix">
    <?php
         while($post_list_query->have_posts()): $post_list_query->the_post();
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
           } elseif($options['no_image1']) {
             $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
           } else {
             $image = array();
             $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
           }
    ?>
    <article class="item">
     <a class="image_link animate_background clearfix" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      </div>
     </a>
     <div class="title_area">
      <h3 class="title rich_font_<?php echo esc_attr($content['title_font_type']); ?>"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h3>
      <p class="desc"><span><?php echo trim_excerpt(60); ?></span></p>
      <?php if ( $content['show_date'] || $content['show_category']){ ?>
      <ul class="meta clearfix">
       <?php if ( $content['show_date']){ ?>
       <li class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li>
       <?php }; ?>
       <?php if ($post_type == 'post'&& $content['show_category'] ) { ?>
       <li class="category"><?php the_category(' '); ?></li>
       <?php }; ?>
      </ul>
      <?php }; ?>
     </div>
    </article>
    <?php endwhile; ?>
   </div><!-- END .post_list -->
   <?php if($total_post_num > 3){ ?>
   <div class="nav_area">
    <div class="carousel_arrow prev_item"></div>
    <div class="carousel_arrow next_item"></div>
   </div>
   <?php }; ?>
  </div><!-- END .post_list_slider_wrap -->
  <?php endif; wp_reset_query(); ?>

  <?php
       if($content['show_button']) {
         if($post_type == 'post') {
  ?>
  <div class="link_button inview">
   <a class="button_animation_<?php echo esc_attr($content['button_animation_type']); ?>" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php echo esc_html($content['button_label']); ?></a>
  </div>
  <?php } else { ?>
  <div class="link_button inview">
   <a class="button_animation_<?php echo esc_attr($content['button_animation_type']); ?>" href="<?php echo esc_url(get_post_type_archive_link($post_type)); ?>"><?php echo esc_html($content['button_label']); ?></a>
  </div>
  <?php }; }; ?>

 </div><!-- END .cb_contents_inner -->

</div><!-- END .index_post_slider -->


<?php
     // フリースペース -----------------------------------------------------
     } elseif ( $content['cb_content_select'] == 'free_space' && $content['show_content'] ) {
       if (!empty($content['free_space'])) {
         $content_width = $content['content_width'];
?>
<div class="index_free_space cb_contents num<?php echo $content_count; ?> cb_free_space <?php echo esc_attr($content_width); ?>" id="cb_content_<?php echo $content_count; ?>">

 <div class="cb_contents_inner">

  <?php if(!empty($content['catch'])) { ?>
  <h4 class="cb_catch inview rich_font_<?php echo esc_attr($content['catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['catch'])); ?></h4>
  <?php }; ?>

  <div class="post_content clearfix rich_font_type2">
   <?php echo apply_filters('the_content', $content['free_space'] ); ?>
  </div>

 </div><!-- END .cb_contents_inner -->

</div><!-- END .index_free_space -->
<?php
           };
         };
       $content_count++;
       endforeach;
     endif;
// コンテンツビルダーここまで
?>
</div><!-- END #index_content_builder -->

<section class="m-article-list">
  <h3 class="m-article-list_title">販売拠点紹介</h3>
  <p class="m-article-list_lead">四国という島国ブランドの下、<br>常設型と移動型でハイブリッド展開します。</p>
  <div class="m-article-list_inner">
  <article class="m-article-box">
    <a href="/base/">
      <img src="<?php echo get_template_directory_uri(); ?>/img/top-sales-base01.jpg?ver=<?php echo version_num(); ?>" alt="十五万石">
      <h4 class="m-article-box_title">十五万石</h4>
      <p class="m-article-box_text">
        道後湯の街の思い出を大切な方へのギフトに。道後、松山、愛媛に留まらず、四国各地・瀬戸内のお土産を一堂に取り揃えさせていただきました。<br>
  各地の銘菓、銘酒、銘品に加え、遊び心をくすぐるキュートなゆるキャラ商品もご用意しております！！</p>
    </a>
  </article>
  <article class="m-article-box">
    <a href="/base/">
      <img src="<?php echo get_template_directory_uri(); ?>/img/top-sales-base02.jpg?ver=<?php echo version_num(); ?>" alt="十五万石">
      <h4 class="m-article-box_title">十五万石</h4>
      <p class="m-article-box_text">
        道後湯の街の思い出を大切な方へのギフトに。道後、松山、愛媛に留まらず、四国各地・瀬戸内のお土産を一堂に取り揃えさせていただきました。<br>
  各地の銘菓、銘酒、銘品に加え、遊び心をくすぐるキュートなゆるキャラ商品もご用意しております！！</p>
    </a>
  </article>
  <article class="m-article-box">
    <a href="/base/">
      <img src="<?php echo get_template_directory_uri(); ?>/img/top-sales-base03.jpg?ver=<?php echo version_num(); ?>" alt="十五万石">
      <h4 class="m-article-box_title">十五万石</h4>
      <p class="m-article-box_text">
        道後湯の街の思い出を大切な方へのギフトに。道後、松山、愛媛に留まらず、四国各地・瀬戸内のお土産を一堂に取り揃えさせていただきました。<br>
  各地の銘菓、銘酒、銘品に加え、遊び心をくすぐるキュートなゆるキャラ商品もご用意しております！！</p>
    </a>
  </article>
  </div>

</section>

<?php get_template_part('template-parts/news'); ?>
<?php get_footer(); ?>