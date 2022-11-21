<?php
     // redirect to Support archive page
     get_header();
     $options = get_design_plus_option();
     $title = $options['news_title'];
     $news_archive_page = get_post_type_archive_link('news');
     // wp_safe_redirect( $news_archive_page );
     // exit;
?>

<?php get_footer(); ?>