<?php
     global $post;
     $options = get_design_plus_option();

     $sidebar = '';
     $sidebar = 'product_widget';
     if ( is_mobile() ) {
       $sidebar .= '_mobile';
     }

     $side_catch = get_post_meta($post->ID, 'side_catch', true);
     $side_desc_top = get_post_meta($post->ID, 'side_desc_top', true);
     $side_price_label = get_post_meta($post->ID, 'side_price_label', true);
     $side_price = get_post_meta($post->ID, 'side_price', true);
     $side_desc_bottom = get_post_meta($post->ID, 'side_desc_bottom', true);
     $side_button_list = get_post_meta($post->ID, 'side_button_list', true);
     $side_price_tax_type = get_post_meta($post->ID, 'side_price_tax_type', true) ?  get_post_meta($post->ID, 'side_price_tax_type', true) : 'type1';

?>
<div id="side_col">
 <?php if ( is_active_sidebar( $sidebar ) ) { ?>
 <div id="product_side_top">
  <?php dynamic_sidebar( $sidebar ); ?>
 </div>
 <?php }; ?>
 <div id="product_side_content">
  <div class="top_area">
   <?php if(!empty($side_catch)) { ?>
   <h3 class="catch rich_font"><?php echo wp_kses_post(nl2br($side_catch)); ?></h3>
   <?php }; ?>
  </div>
  <?php if(!empty($side_desc_top)) { ?>
  <div class="middle_area">
   <p class="desc"><?php echo wp_kses_post(nl2br($side_desc_top)); ?></p>
  </div>
  <?php }; ?>
  <div class="bottom_area">
   <?php if(!empty($side_price_label)) { ?>
   <p class="price_label"><?php echo wp_kses_post(nl2br($side_price_label)); ?></p>
   <?php }; ?>
   <?php if(!empty($side_price)) { ?>
   <p class="price"><?php echo wp_kses_post(nl2br($side_price)); ?><?php if($side_price_tax_type == 'type2') { _e('<span class="tax">(including tax)</span>', 'tcd-w'); } elseif($side_price_tax_type == 'type3') { _e('<span class="tax">(excluding tax)</span>', 'tcd-w'); }; ?></p>
   <?php }; ?>
   <?php if(!empty($side_button_list)) { ?>
   <ul class="button_list">
    <?php
         foreach ( $side_button_list as $key => $value ) :
           $animation_type = isset($value['animation_type']) ?  $value['animation_type'] : 'type1';
    ?>
    <li class="num<?php echo esc_attr($key); ?>"><a class="button_animation_<?php echo esc_attr($animation_type); ?>" href="<?php if($value['url']) { echo esc_url($value['url']); }; ?>" <?php if($value['target']) { echo ' target="_blank"'; }; ?>><?php if($value['label']) { echo esc_html($value['label']); }; ?></a></li>
    <?php endforeach; ?>
   </ul>
   <?php }; ?>
   <?php if(!empty($side_desc_bottom)) { ?>
   <p class="desc"><?php echo wp_kses_post(nl2br($side_desc_bottom)); ?></p>
   <?php }; ?>
  </div>
 </div>
</div>