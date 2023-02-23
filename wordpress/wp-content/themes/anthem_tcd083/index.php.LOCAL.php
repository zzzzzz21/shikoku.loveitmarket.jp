<?php
     get_header();
     $options = get_design_plus_option();
     $title = $options['blog_title'];
     $title_font_type = $options['blog_title_font_type'];
     $desc = $options['blog_desc'];
     $desc_mobile = $options['blog_desc_mobile'];
     $desc_font_type = $options['blog_desc_font_type'];
     $bg_image = $options['blog_bg_image'] ? wp_get_attachment_image_src( $options['blog_bg_image'], 'full' ) : '';
     $bg_image_mobile = $options['blog_bg_image_mobile'] ? wp_get_attachment_image_src( $options['blog_bg_image_mobile'], 'full' ) : '';
     $use_overlay = $options['blog_use_overlay'];
     if($use_overlay) {
       $overlay_color = $options['blog_overlay_color'];
       $overlay_color = hex2rgb($overlay_color);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['blog_overlay_opacity'];
     }
     // overwrite the data if category data exist
     $current_cat_id = '';
     if (is_category()) {
       $query_obj = get_queried_object();
       $current_cat_id = $query_obj->term_id;
       $title = $query_obj->name;
       if (!empty($query_obj->description)){
         $desc = $query_obj->description;
       }
       $term_meta = get_option( 'taxonomy_' . $current_cat_id, array() );
       if (!empty($term_meta['image'])){
         $bg_image = $term_meta['image'];
         $bg_image = wp_get_attachment_image_src( $bg_image, 'full' );
       }
       if (!empty($term_meta['use_overlay'])){
         if (!empty($term_meta['overlay_color'])){
           $overlay_color = hex2rgb($term_meta['overlay_color']);
           $overlay_color = implode(",",$overlay_color);
           if (!empty($term_meta['overlay_opacity'])){
             $overlay_opacity = $term_meta['overlay_opacity'];
           } else {
             $overlay_opacity = '0.3';
           }
         }
       }
     } elseif(is_tag()) {
       $query_obj = get_queried_object();
       $title = $query_obj->name;
       if (!empty($query_obj->description)){
         $desc = $query_obj->description;
       }
     }
     if (!is_author()) {
?>
<section class="m-article-list partners" style="background:<?php echo esc_attr($options['archive_blog_bg_color']); ?>;">
 <?php if($options['blog_show_header']){ ?>
    <?php if($title){ ?>
    <h2 class="m-article-list_title"><?php echo wp_kses_post(nl2br($title)); ?></h2>
    <?php }; ?>
    <?php if($desc){ ?>
    <p class="m-article-list_lead"><span<?php if($desc_mobile){ echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($desc)); ?></span><?php if($desc_mobile){ ?><span class="mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></span><?php }; ?></p>
    <?php }; ?>
 <?php }; ?>
<?php }; ?>
  <?php if ( have_posts() ) : ?>
  <div class="m-article-list_inner">
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
   ?>
    <article class="m-article-box partner">
     <a href="<?php the_permalink(); ?>" class="m-article-box_link">
      <div class="m-article-box_thumb">
       <div class="thumb" role="img" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      </div>
      <h3 class="m-article-box_title"><span><?php the_title(); ?></span></h3>
      <?php if ( $options['show_archive_blog_desc']){ ?>
        <!--<p class="m-article-box_text"><span><?php echo trim_excerpt(70); ?></span></p>-->
      <?php }; ?>
    </a>
    </article>
   <?php endwhile; ?>
  </div><!-- END #blog_list -->

  

  <?php else: ?>

  <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>

  <?php endif; ?>
  <?php get_template_part('template-parts/navigation'); ?>
  </section><!-- END .m-article-list -->
<?php get_footer(); ?>