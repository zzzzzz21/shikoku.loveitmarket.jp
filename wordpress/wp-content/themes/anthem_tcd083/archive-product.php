<?php
     get_header();
     $options = get_design_plus_option();
     $title = $options['product_title'];
     $title_font_type = $options['product_title_font_type'];
     $desc = $options['product_desc'];
     $desc_mobile = $options['product_desc_mobile'];
     $desc_font_type = $options['product_desc_font_type'];
     $bg_image = $options['product_bg_image'] ? wp_get_attachment_image_src( $options['product_bg_image'], 'full' ) : '';
     $bg_image_mobile = $options['product_bg_image_mobile'] ? wp_get_attachment_image_src( $options['product_bg_image_mobile'], 'full' ) : '';
     $use_overlay = $options['product_use_overlay'];
     if($use_overlay) {
       $overlay_color = $options['product_overlay_color'];
       $overlay_color = hex2rgb($overlay_color);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['product_overlay_opacity'];
     }
?>
<div class="m-product-list">

  <?php if($options['archive_product_catch'] || $options['archive_product_desc']) { ?>

   <?php if($options['archive_product_catch']) { ?>
   <h3 class="m-product-list_title"><span<?php if($options['archive_product_catch_mobile']) { echo ' class="pc"'; }; ?>><?php echo esc_html($options['archive_product_catch']); ?></span><?php if($options['archive_product_catch_mobile']) { ?><span class="mobile"><?php echo esc_html($options['archive_product_catch_mobile']); ?></span><?php }; ?></h3>
   <?php }; ?>
   <?php if($options['archive_product_desc']) { ?>
   <p class="m-product-list_lead"><span<?php if($options['archive_product_desc_mobile']) { echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($options['archive_product_desc'])); ?></span><?php if($options['archive_product_desc_mobile']) { ?><span class="mobile"><?php echo esc_html($options['archive_product_desc_mobile']); ?></span><?php }; ?></p>
   <?php }; ?>
  <?php }; ?>

  <?php if ( have_posts() ) : ?>

  <div class="m-product-list_inner animation_<?php echo esc_attr($options['archive_product_list_animation_type']); ?>" id="archive_product_list">
   <?php
        while ( have_posts() ) : the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
         } elseif($options['no_image1']) {
           $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
         } else {
           $image = array();
           $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
         }
         $main_color = get_post_meta($post->ID, 'main_color', true) ?  get_post_meta($post->ID, 'main_color', true) : '#008a98';
         // $short_desc = get_post_meta($post->ID, 'short_desc', true);
         $partners_title = get_post_meta($post->ID, 'header_sub_title', true);
         $product_category = get_the_terms( $post->ID, 'product_category' );
         $category_ids = array();
         if ( $product_category && ! is_wp_error($product_category) ) {
           foreach ( $product_category as $cat ) :
             $cat_id = $cat->term_id;
             $category_ids[] = 'product_cat_' . $cat_id;
           endforeach;
           $category_ids = implode(" ", $category_ids);
         }
   ?>
   <article class="m-product-box" data-category="<?php if($category_ids){ echo $category_ids; }; ?>">
    <a class="m-product-box_link animate_background" href="<?php the_permalink(); ?>">
     <?php if($image) { ?>
     <div class="m-product-box_image_wrap">
      <div class="m-product-box_image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:contain;"></div>
     </div>
     <?php }; ?>
     <h3 class="m-product-box_title"><span><?php the_title(); ?></span></h3>
      <?php if($product_category) { ?>
      <p class="m-product-box_text"><span><?php echo esc_html($partners_title); ?></span></p>
      <?php }; ?>
    </a>
   </article>
   <?php endwhile; ?>
  </div><!-- END .product_list -->

  <?php else: ?>

  <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>

  <?php endif; ?>

</div><!-- END #product_archive -->
<?php get_template_part('template-parts/news'); ?>
<?php get_footer(); ?>