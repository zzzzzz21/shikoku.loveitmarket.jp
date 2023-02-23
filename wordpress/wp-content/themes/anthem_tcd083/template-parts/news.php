<?php
      //  お知らせ一覧--------------------------------------------------------------------
        $args = array( 'post_type' => 'news', 'posts_per_page' => 3 );
        $news_query = new wp_query($args);
        if ($news_query->have_posts()) :
 ?>
 <section class="m-news-list">
  <h3 class="m-news-list_title">お知らせ</h3>
  <div class="m-news-list_inner">
    <?php while($news_query->have_posts()): $news_query->the_post(); ?>
    <article class="m-news-list_item">
     <a href="<?php the_permalink() ?>" class="m-news-list_link">
      <p class="m-news-list_date" ><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.j'); ?></time></p>
      <h4 class="m-news-list_title"><span><?php the_title_attribute(); ?></span></h4>
     </a>
    </article>
    <?php endwhile;  ?>
   </div>
   <div class="c-button-primary animate_item inview_mobile animate">
    <a class="c-button-primary_link" href="/info/"><span>お知らせ一覧</span></a>
   </div>
</section>
 <?php
          endif;
          wp_reset_query();
 ?>