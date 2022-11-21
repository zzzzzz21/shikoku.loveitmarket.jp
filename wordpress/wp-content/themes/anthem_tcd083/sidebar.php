<?php
     global $post;
     $options = get_design_plus_option();

     $sidebar = '';

     if ( is_post_type_archive('news') || is_singular('news') || $_SERVER['REQUEST_URI'] === '/info/news/' || $_SERVER['REQUEST_URI'] === '/info/schedule/') {
       $sidebar = 'news_widget';
     } else {
       $sidebar = 'blog_widget';
     }

     if ( is_mobile() ) {
       $sidebar .= '_mobile';
     }

     if ( is_active_sidebar( $sidebar ) ) {
?>
<div id="side_col">
 <?php dynamic_sidebar( $sidebar ); ?>
</div>
<?php } ?>