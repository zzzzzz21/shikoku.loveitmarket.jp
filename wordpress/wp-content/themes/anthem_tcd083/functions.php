<?php

// 言語ファイル --------------------------------------------------------------------------------
load_textdomain('tcd-w', dirname(__FILE__).'/languages/' . get_locale() . '.mo');

// style.cssのDescriptionをPoedit等に認識させる
__( '"ANTHEM" is a WordPress theme that allows you to create great sales pages. It beautifully expresses the features of products and includes a review function. Smart ranking pages also supports product sales.', 'tcd-anthem' );

// hook wp_head --------------------------------------------------------------------------------
require get_template_directory() . '/functions/head.php';


// テーマオプション --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/admin/theme-options.php' );


// 更新通知 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/update_notifier.php' );


// Javascriptの読み込み -----------------------------------------------------------------------
function my_admin_scripts() {
  wp_enqueue_script( 'wp-color-picker');
  wp_enqueue_script('thickbox');
  wp_enqueue_script('media-upload');
  wp_enqueue_script('jquery-ui-resizable');//トップページのロゴで使用
  wp_enqueue_script('ml-widget-js', get_template_directory_uri().'/widget/js/script.js', '', '1.0.0', true);
  wp_enqueue_script('jquery.cookieTab', get_template_directory_uri().'/admin/js/jquery.cookieTab.js', '', '1.0.0', true);
  wp_enqueue_script('my_script', get_template_directory_uri().'/admin/js/my_script.js', '', '1.1.4', true);
  wp_enqueue_script('ml-rebox-js', get_template_directory_uri().'/admin/js/rebox/jquery-rebox.js', '', '1.0.0', true);
  wp_localize_script( 'my_script', 'TCD_MESSAGES', array(
    'ajaxSubmitSuccess' => __( 'Settings Saved Successfully', 'tcd-w' ),
    'ajaxSubmitError' => __( 'Can not save data. Please try again', 'tcd-w' ),
    'tabChangeWithoutSave' => __( "Your changes on the current tab have not been saved.\nTo stay on the current tab so that you can save your changes, click Cancel.", 'tcd-w' ),
    'contentBuilderDelete' => __( 'Are you sure you want to delete this content?', 'tcd-w' ),
    'imageContentWidthMessage' => __( '<span>You can display image by content width when you displaying border around the content on LP page.</span>', 'tcd-w' ),
  ) );
  wp_enqueue_media();//画像アップロード用
  wp_enqueue_script('cf-media-field', get_template_directory_uri().'/admin/js/cf-media-field.js', '', '1.0.0', true); //画像アップロード用
  wp_localize_script( 'cf-media-field', 'cfmf_text', array(
    'image_title' => __( 'Please select image', 'tcd-w' ),
    'image_button' => __( 'Use this image', 'tcd-w' ),
    'video_title' => __( 'Please select MP4 file', 'tcd-w' ),
    'video_button' => __( 'Use this MP4 file', 'tcd-w' )
  ) );


  // レビュー用
  if ($GLOBALS['typenow'] === 'product') {
    wp_enqueue_script( 'jquery-ui-datepicker' );
    if ( 'ja' === get_locale() ) {
      wp_enqueue_script( 'jquery-ui-datepicker-ja', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js', array(), '1.11.4', true );
    }
  }
}
add_action('admin_print_scripts', 'my_admin_scripts');


// スタイルシートの読み込み -----------------------------------------------------------------------
function my_admin_styles() {
  wp_enqueue_style('imgareaselect');
  wp_enqueue_style('jquery-ui-draggable');
  wp_enqueue_style('wp-color-picker');
  wp_enqueue_style('thickbox');
  wp_enqueue_style('my_widget_css', get_template_directory_uri() . '/widget/css/style.css','','1.0.0');
  wp_enqueue_style('my_admin_css', get_template_directory_uri() .'/admin/css/my_admin.css','','1.0.5');
  wp_enqueue_style('ml-rebox-style', get_template_directory_uri() . '/admin/js/rebox/jquery-rebox.css','','1.0.0');


  // レビュー用
  if ($GLOBALS['typenow'] === 'product') {
    wp_enqueue_style( 'jquery-ui-smoothness', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css', array(), '1.11.4' );
  }
}
add_action('admin_print_styles', 'my_admin_styles');

// ビジュアルエディタ用スタイルシートの読み込み
function wpdocs_theme_add_editor_styles() {
  add_theme_support('editor-styles');
  add_editor_style('admin/css/editor-style-06.css');//管理画面用のスタイルシートを変更した場合は、ファイルの名前と番号を変える （キャッシュ対策）
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );


// ページビルダー --------------------------------------------------------------------------------
require get_template_directory() . '/pagebuilder/pagebuilder.php';


// カードリンクパーツ --------------------------------------------------------------------------------
require get_template_directory() . '/functions/clink.php';


// おすすめ記事 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/recommend.php';


// meta title meta description  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/seo.php' );


// 管理画面の記事一覧、クイック編集 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/admin_column.php';
require get_template_directory() . '/functions/quick_edit.php';


// カスタムフィールド --------------------------------------------------------------------------------
require get_template_directory() . '/functions/page_cf.php';
require get_template_directory() . '/functions/page_design1.php';
require get_template_directory() . '/functions/page_ranking.php';
require get_template_directory() . '/functions/blog_cf.php';
require get_template_directory() . '/functions/product_cf.php';
require get_template_directory() . '/functions/product_category.php';
require get_template_directory() . '/functions/category_cf.php';
require get_template_directory() . '/functions/support_cf.php';


// レビュー投票 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/review_vote.php';


// 並び替え --------------------------------------------------------------------------------
require get_template_directory() . '/functions/post_order.php';


// アクセス数 --------------------------------------------------------------------------------
//require get_template_directory() . '/functions/views.php';


// カスタムCSS --------------------------------------------------------------------------------
require get_template_directory() . '/functions/custom_css.php';


// カスタムスクリプト --------------------------------------------------------------------------------
require get_template_directory() . '/functions/custom_script.php';


// ビジュアルエディタにクイックタグを追加 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/custom_editor.php';


// ショートコード --------------------------------------------------------------------------------
require get_template_directory() . '/functions/short_code.php';


// ウィジェット ------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/widget/ad.php' );
require_once ( dirname(__FILE__) . '/widget/styled_post_list1.php' );
require_once ( dirname(__FILE__) . '/widget/google_search.php' );
require_once ( dirname(__FILE__) . '/widget/archive_list.php' );
require_once ( dirname(__FILE__) . '/widget/category_list.php' );
require_once ( dirname(__FILE__) . '/widget/post_slider.php' );
require_once ( dirname(__FILE__) . '/widget/product_slider.php' );
require_once ( dirname(__FILE__) . '/widget/product_ranking.php' );
require_once ( dirname(__FILE__) . '/widget/tab_post_list.php' );
require_once ( dirname(__FILE__) . '/widget/banner.php' );

$options = get_design_plus_option();
$news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );
$product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-w' );

register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => __('Blog page', 'tcd-w'),
  'id' => 'blog_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => __('Blog page (smartphone)', 'tcd-w'),
  'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
  'id' => 'blog_widget_mobile'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => sprintf(__('%s page', 'tcd-w'),$news_label),
  'id' => 'news_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => sprintf(__('%s page (smartphone)', 'tcd-w'),$news_label),
  'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
  'id' => 'news_widget_mobile'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => sprintf(__('%s page', 'tcd-w'),$product_label),
  'id' => 'product_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => sprintf(__('%s page (smartphone)', 'tcd-w'),$product_label),
  'id' => 'product_widget_mobile'
));


// メガメニュー --------------------------------------------------------------------------------
require get_template_directory() . '/functions/menu.php';
if ( ! function_exists( 'wp_get_nav_menu_name' ) ) {
  function wp_get_nav_menu_name( $location ) {
    $menu_name = '';
    $locations = get_nav_menu_locations();
    if ( isset( $locations[ $location ] ) ) {
      $menu = wp_get_nav_menu_object( $locations[ $location ] );
      if ( $menu && $menu->name ) {
        $menu_name = $menu->name;
      }
    }
    return apply_filters( 'wp_get_nav_menu_name', $menu_name, $location );
  }
}


// カスタムページリンク  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/custom_page_link.php' );


// OGP tag  -------------------------------------------------------------------------------------------
require get_template_directory() . '/functions/ogp.php';


// 次のページリンク  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/next_prev.php' );


//ロゴ用関数 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/logo.php' );


// プロフィール追加情報 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/user-profile.php';


// ロードアイコン -----------------------------------------------------------------------------
require get_template_directory() . '/functions/load_icon.php';
require get_template_directory() . '/functions/loading_script.php';


// パスワード保護 -----------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/password_form.php' );


// 高速化 --------------------------------------------------------------------------------
require ( dirname(__FILE__) . '/functions/acceleration.php' );


// ビジュアルエディタに表(テーブル)の機能を追加 -----------------------------------------------
function mce_external_plugins_table($plugins) {
    $plugins['table'] = 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.4/plugins/table/plugin.min.js';
    return $plugins;
}
add_filter( 'mce_external_plugins', 'mce_external_plugins_table' );

// tinymceのtableボタンにclass属性プルダウンメニューを追加
function mce_buttons_table($buttons) {
    $buttons[] = 'table';
    return $buttons;
}
add_filter( 'mce_buttons', 'mce_buttons_table' );

function bootstrap_classes_tinymce($settings) {
  $styles = array(
    array('title' => __('Default style', 'tcd-w'), 'value' => ''),
    array('title' => __('No border', 'tcd-w'), 'value' => 'table_no_border'),
    array('title' => __('Display only horizontal border', 'tcd-w'), 'value' => 'table_border_horizontal')
  );
  $settings['table_class_list'] = json_encode($styles);
  return $settings;
}
add_filter('tiny_mce_before_init', 'bootstrap_classes_tinymce');


// ビジュアルエディタに書体を追加 ---------------------------------------------------------------------
add_filter('mce_buttons', function($buttons){
  array_unshift($buttons, 'fontselect');
  return $buttons;
});
add_filter('tiny_mce_before_init', function($settings){
  $settings['font_formats'] =
    "メイリオ=Arial, 'Hiragino Kaku Gothic ProN', 'ヒラギノ角ゴ ProN W3', 'メイリオ', Meiryo, sans-serif;" .
    "游ゴシック='Hiragino Sans', 'ヒラギノ角ゴ ProN', 'Hiragino Kaku Gothic ProN', '游ゴシック', YuGothic, 'メイリオ', Meiryo, sans-serif;" .
    "游明朝='Times New Roman' , '游明朝' , 'Yu Mincho' , '游明朝体' , 'YuMincho' , 'ヒラギノ明朝 Pro W3' , 'Hiragino Mincho Pro' , 'HiraMinProN-W3' , 'HGS明朝E' , 'ＭＳ Ｐ明朝' , 'MS PMincho' , serif;" .
    "Andale Mono=andale mono,times;" .
    "Arial=arial,helvetica,sans-serif;" .
    "Arial Black=arial black,avant garde;" .
    "Book Antiqua=book antiqua,palatino;" .
    "Comic Sans MS=comic sans ms,sans-serif;" .
    "Courier New=courier new,courier;" .
    "Georgia=georgia,palatino;" .
    "Helvetica=helvetica;" .
    "Impact=impact,chicago;" .
    "Symbol=symbol;" .
    "Tahoma=tahoma,arial,helvetica,sans-serif;" .
    "Terminal=terminal,monaco;" .
    "Times New Roman=times new roman,times;" .
    "Trebuchet MS=trebuchet ms,geneva;" .
    "Verdana=verdana,geneva;" .
    "Webdings=webdings;" .
    "Wingdings=wingdings,zapf dingbats";
  ;
  return $settings;
});


// ビジュアルエディタに文字サイズを追加 ---------------------------------------------------------------------
function add_font_size_to_tinymce( $buttons ) {
  array_unshift( $buttons, 'fontsizeselect' );
  return $buttons;
}
add_filter( 'mce_buttons_2', 'add_font_size_to_tinymce' );

function change_font_size_of_tinymce( $initArray ){
  $initArray['fontsize_formats'] = "10px 11px 12px 14px 16px 18px 20px 24px 28px 32px 38px";
  return $initArray;
}
add_filter( 'tiny_mce_before_init', 'change_font_size_of_tinymce' );


// ico形式のファイルをアップロードできるようにする（ファビコンに利用）---------------------------------------------------------------------
function my_myme_types($mime_types){
  $existing_mimes['ico'] = 'images/ico';
  return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);


// ユーザーエージェントを判定するための関数---------------------------------------------------------------------
function is_mobile() {

  //タブレットも含める場合はwp_is_mobile()

  $match = 0;

  $ua = array(
   'iPhone', // iPhone
   'iPod', // iPod touch
   'Android.*Mobile', // 1.5+ Android *** Only mobile
   'Windows.*Phone', // *** Windows Phone
   'dream', // Pre 1.5 Android
   'CUPCAKE', // 1.5+ Android
   'BlackBerry', // BlackBerry
   'BB10', // BlackBerry10
   'webOS', // Palm Pre Experimental
   'incognito', // Other iPhone browser
   'webmate' // Other iPhone browser
  );

  $pattern = '/' . implode( '|', $ua ) . '/i';
  $match   = preg_match( $pattern, $_SERVER['HTTP_USER_AGENT'] );

  if ( $match === 1 ) {
    return TRUE;
  } else {
    return FALSE;
  }

}


// videoタグやyoutubeの自動再生に対応しているか判定 ----------------------------------------------
// Android 標準ブラウザは不可、Android版 Chrome ver53以下は不可、iOS ver10以下は不可、それ以外は再生を許可
function auto_play_movie() {
  $ua = mb_strtolower($_SERVER['HTTP_USER_AGENT']);
  // Android -----------------------------------
  if( preg_match('/android/ui', $ua) ) {
    //echo 'Android<br />';
    // 標準ブラウザ
    if (strpos($ua, 'android') !== false && strpos($ua, 'linux; u;') !== false && strpos($ua, 'chrome') === false) {
      return FALSE;
    // Chrome
    } elseif ( preg_match('/(chrome)\/([0-9\.]+)/', $ua , $matches) ){
      $match = (float) $matches[2];
      $version = floor($match);
      if($version < 53){
        return FALSE;
      } else {
        return TRUE;
      }
    } else {
      return TRUE;
    }
  // iOS ---------------------------------------
  } elseif(preg_match('/iphone|ipod|ipad/ui', $ua)) {
    //echo 'iOS<br />';
    if ( preg_match('/(iphone|ipod|ipad) os ([0-9_]+)/', $ua, $matches) ) {
      $matches[2] = (float) str_replace('_', '.', $matches[2]);
      $version = floor($matches[2]);
      if($version < 10){
        return FALSE;
      } else {
        return TRUE;
      }
    } else {
      return TRUE;
    }
  // PC等、その他のOS ---------------------------------------
  } else {
    //echo 'OTHER OS<br />';
    return TRUE;
  }
}



// スクリプトのバージョン管理 ----------------------------------------------------------------------------------------------
function version_num() {

 if (function_exists('wp_get_theme')) {
   $theme_data = wp_get_theme();
 } else {
   $theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
 };

 $current_version = $theme_data['Version'];

 return $current_version;

};


// オリジナルの抜粋記事 --------------------------------------------------------------------------------
function trim_excerpt($a) {

 if(has_excerpt()) {

   $base_content = get_the_excerpt();
   $base_content = str_replace(array("\r\n", "\r", "\n"), "", $base_content);
   $trim_content = mb_substr($base_content, 0, $a ,"utf-8");

 } else {

   $base_content = get_the_content();
   $base_content = preg_replace('!<style.*?>.*?</style.*?>!is', '', $base_content);
   $base_content = preg_replace('!<script.*?>.*?</script.*?>!is', '', $base_content);
   $base_content = preg_replace('/\[.+\]/','', $base_content);
   $base_content = strip_tags($base_content);
   $trim_content = mb_substr($base_content, 0, $a,"utf-8");
   $trim_content = str_replace(']]>', ']]&gt;', $trim_content);
   $trim_content = str_replace(array("\r\n", "\r", "\n" , "&nbsp;"), "", $trim_content);
   $trim_content = htmlspecialchars($trim_content);

 };

 return $trim_content;

};
function trim_desc($desc,$num) {

  $trim_desc = mb_substr($desc, 0, $num ,"utf-8");
  $count_word = mb_strlen($trim_desc,"utf-8");
  return $trim_desc;

};

//抜粋からPタグを取り除く
remove_filter( 'the_excerpt', 'wpautop' );


// 記事タイトルの文字数制限 --------------------------------------------------------------------------------
function trim_title($num) {
 $base_title = strip_tags(get_the_title());
 $trim_title = mb_substr($base_title, 0, $num ,"utf-8");
 $count_title = mb_strlen($trim_title,"utf-8");
 if($count_title > $num-1) {
  echo $trim_title . '…';
 } else {
  echo $trim_title;
 };
};

function trim_title2($num) {
 $base_title = strip_tags(get_the_title());
 $trim_title = mb_substr($base_title, 0, $num ,"utf-8");
 $count_title = mb_strlen($trim_title,"utf-8");
 if($count_title > $num-1) {
  return $trim_title . '…';
 } else {
  return $trim_title;
 };
};

/* ショートコード用 */
function trim_title_sc($num) {
 $base_title = get_the_title();
 $trim_title = mb_substr($base_title, 0, $num ,"utf-8");
 $count_title = mb_strwidth($trim_title,"utf-8");
 if($count_title > $num-1) {
  return $trim_title . '…';
 } else {
  return $trim_title;
 };
};


// タイトルをエンコード --------------------------------------------------------------------------------
function get_encoded_title($title){
  return urlencode(mb_convert_encoding($title, "UTF-8"));
}


// セルフピンバックを禁止する -------------------------------------------------------------------------------------
function no_self_ping( &$links ) {
  $home = home_url();
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );


// RSS用のフィードを追加 ---------------------------------------------------------------------------------------------------
add_theme_support( 'automatic-feed-links' );


//　ヘッダーから余分なMETA情報を削除 --------------------------------------------------------------------
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );


// インラインスタイルを取り除く --------------------------------------------------------------------------------
function remove_recent_comments_style() {
  global $wp_widget_factory;
  remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'remove_recent_comments_style' );

function remove_adminbar_inline_style() {
  remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_adminbar_inline_style');


// ウィジェットブロックエディターを無効化 --------------------------------------------------------------------------------
function exclude_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'exclude_theme_support' );


//　サムネイルの設定 --------------------------------------------------------------------------------
//require get_template_directory() . '/functions/blur_image.php';
if ( function_exists('add_theme_support') ) {
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'size1', 250, 250, true );
  add_image_size( 'size2', 800, 520, true ); // theme list, single page
  add_image_size( 'size3', 470, 290, true ); // footer carousel
  add_image_size( 'size4', 1000, 450, true ); // single page large size
  add_image_size( 'size5', 1450, 500, true ); // product single page
  add_image_size( 'slider_size', 1180, 680, true ); //画像スライダー用
}

function message_featured_image_meta_box($content, $post_id, $thumbnail_id) {
  $post = get_post($post_id);
  $options = get_design_plus_option();
  if ( $post->post_type == 'post') {
    if($options['single_blog_layout'] != 'type3'){
      $content .= '<p>' . sprintf(__('Recommend image size. Width:<span class="featured_image_width">%1$s</span>px, Height:%2$spx.', 'tcd-w'), '700', '440') . '</p>';
    } else {
      $content .= '<p>' . sprintf(__('Recommend image size. Width:<span class="featured_image_width">%1$s</span>px, Height:%2$spx.', 'tcd-w'), '1000', '440') . '</p>';
    }
    return $content;
  }
  if ( $post->post_type == 'news') {
    if($options['single_news_layout'] != 'type3'){
      $content .= '<p>' . sprintf(__('Recommend image size. Width:<span class="featured_image_width">%1$s</span>px, Height:%2$spx.', 'tcd-w'), '700', '440') . '</p>';
    } else {
      $content .= '<p>' . sprintf(__('Recommend image size. Width:<span class="featured_image_width">%1$s</span>px, Height:%2$spx.', 'tcd-w'), '1000', '440') . '</p>';
    }
    return $content;
  }
  if ( $post->post_type == 'product') {
    $content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '500') . '</p>';
    return $content;
  }
  if ( $post->post_type == 'page') {
    $content .= '<p>' . __('Recommend image size. Width:500px, Height:500px.<br>This image will be used in search result and OGP tag.', 'tcd-w') . '</p>';
    return $content;
  }
  return $content;
}
add_filter('admin_post_thumbnail_html', 'message_featured_image_meta_box', 10, 3);


// カスタムメニューの設定 --------------------------------------------------------------------------------
if(function_exists('register_nav_menu')) {
  register_nav_menu( 'global-menu', __( 'Global menu', 'tcd-w' ) );
  register_nav_menu( 'footer-menu', __( 'Footer menu', 'tcd-w' ) );
}
// current-menu-itemを付ける
function custom_active_item_classes($classes = array(), $menu_item = false) {
  global $post;
  $id = ( isset( $post->ID ) ? get_the_ID() : NULL );
  if (isset( $id )){
   $classes[] = ($menu_item->url == get_post_type_archive_link($post->post_type)) ? 'current-menu-item' : '';
  }
  return $classes;
}
add_filter( 'nav_menu_css_class', 'custom_active_item_classes', 10, 2 );


// 絵文字を消す ------------------------------------------------------------------
function disable_emoji() {
    $options = get_design_plus_option();
    if ( $options['use_emoji'] == 0 ) {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    } elseif ( $options['use_css_optimization'] ) {
        // 絵文字styleが先頭にある関係でCSS最適化+common.css未生成時に不具合起こる対策
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        add_action( 'wp_head', 'print_emoji_styles', 10 );
    }
}
add_action( 'init', 'disable_emoji' );


// bodyタグにclassを追加 --------------------------------------------------------------------------------
function tcd_body_classes($classes) {
    global $wp_query, $post;
    $options = get_design_plus_option();

    if( is_page() && get_post_meta($post->ID, 'page_hide_header', true) ) { $classes[] = 'hide_header'; };
    if( is_page() && get_post_meta($post->ID, 'page_hide_header_image', true)) { $classes[] = 'hide_header_image'; };
    if( is_page() && get_post_meta($post->ID, 'page_hide_content_link', true)) { $classes[] = 'hide_content_link'; };
    if( is_page() && get_post_meta($post->ID, 'change_content_width', true) ) { $classes[] = 'change_width'; };
    if( is_page() && get_post_meta($post->ID, 'fixed_content_link', true) ) { $classes[] = 'use_fixed_content_link'; };
    if( is_singular('product')) { $classes[] = 'use_fixed_content_link'; };
    if( is_404() && $options['hide_header_404'] ) { $classes[] = 'hide_header'; };
    if( is_404() && $options['hide_footer_404'] ) { $classes[] = 'hide_footer'; };
    if(is_archive()) {
      global $wp_query;
      if($wp_query->max_num_pages == 1) {
        $classes[] = 'no_page_nav';
      }
    }
    if( is_singular('post') && $options['single_blog_layout'] ) {
      $side_content_layout = get_post_meta($post->ID, 'side_content_layout', true) ?  get_post_meta($post->ID, 'side_content_layout', true) : 'type0';
      if($side_content_layout == 'type0'){
        $classes[] = 'layout_' . esc_attr($options['single_blog_layout']);
      } else {
        $classes[] = 'layout_' . esc_attr($side_content_layout);
      }
    };
    if( is_singular('news') && $options['single_news_layout'] ) {
      $side_content_layout = get_post_meta($post->ID, 'side_content_layout', true) ?  get_post_meta($post->ID, 'side_content_layout', true) : 'type0';
      if($side_content_layout == 'type0'){
        $classes[] = 'layout_' . esc_attr($options['single_news_layout']);
      } else {
        $classes[] = 'layout_' . esc_attr($side_content_layout);
      }
    };
    if( is_singular('product') && $options['single_product_layout'] ) {
      $side_content_layout = get_post_meta($post->ID, 'side_content_layout', true) ?  get_post_meta($post->ID, 'side_content_layout', true) : 'type0';
      if($side_content_layout == 'type0'){
        $classes[] = 'layout_' . esc_attr($options['single_product_layout']);
      } else {
        $classes[] = 'layout_' . esc_attr($side_content_layout);
      }
    };
    if( is_post_type_archive('news') && $options['archive_news_layout'] ) { $classes[] = 'layout_' . esc_attr($options['archive_news_layout']); };
    if (wp_is_mobile()) { $classes[] = 'mobile_device'; };
    if ($options['header_fix'] != 'type1') { $classes[] = 'use_header_fix'; };
    if ($options['mobile_header_fix'] == 'type2') { $classes[] = 'use_mobile_header_fix'; };
    if ( is_mobile() && ($options['footer_bar_display'] == 'type1') ) { $classes[] = 'show_footer_bar dp-footer-bar-type1'; };
    if ( is_mobile() && ($options['footer_bar_display'] == 'type2') ) { $classes[] = 'show_footer_bar dp-footer-bar-type2'; };

    return array_unique($classes);
};
add_filter('body_class','tcd_body_classes');


// HEXをRGBに変換 ------------------------------------------------------------------
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb;
}


// archive_title() 関数をカスタマイズ --------------------------------------------------------------------------------
function monolith_archive_title( $title ) {
	global $author, $post, $wp_query;
	if ( is_author() ) {
		$title = get_the_author_meta( 'display_name', $author );
	} elseif ( is_category() || is_tag() ) {
		$title = single_term_title( '', false );
	} elseif ( is_day() ) {
		$title = get_the_time( __( 'F jS, Y', 'tcd-w' ), $post );
	} elseif ( is_month() ) {
		$title = get_the_time( __( 'F, Y', 'tcd-w' ), $post );
	} elseif ( is_year() ) {
		$title = get_the_time( __( 'Y', 'tcd-w' ), $post );
	} elseif ( is_search() ) {
		if ( $wp_query->found_posts ) {
			//$title = sprintf( __( 'Search results for - ', 'tcd-w' ) . get_search_query()
		} else {
			$title = __( 'Search result', 'tcd-w' );
		}
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'monolith_archive_title', 10 );


// カスタムコメント --------------------------------------------------------------------------------------

if (function_exists('wp_list_comments')) {
	// comment count
	add_filter('get_comments_number', 'comment_count', 0);
	function comment_count( $commentcount ) {
		global $id;
		$_commnets = get_comments('post_id=' . $id);
		$comments_by_type = separate_comments($_commnets);
		return count($comments_by_type['comment']);
	}
}


function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$commentcount = 0;
	}
?>

 <li class="comment <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-comment';} else {echo 'guest-comment';} ?>" id="comment-<?php comment_ID() ?>">
  <div class="comment-meta clearfix">
   <div class="comment-meta-left">
  <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 35); } ?>

    <ul class="comment-name-date">
     <li class="comment-name">
<?php if (get_comment_author_url()) : ?>
<a id="commentauthor-<?php comment_ID() ?>" class="url <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-url';} else {echo 'guest-url';} ?>" href="<?php comment_author_url() ?>" rel="nofollow">
<?php else : ?>
<span id="commentauthor-<?php comment_ID() ?>">
<?php endif; ?>

<?php comment_author(); ?>

<?php if(get_comment_author_url()) : ?>
</a>
<?php else : ?>
</span>
<?php endif;  $options = get_option('tcd-w_options'); ?>
     <li class="comment-date"><?php echo get_comment_time('Y.m.d'); echo get_comment_time(' g:ia'); ?></li>
    </ul>
   </div>

   <ul class="comment-act">
<?php if (function_exists('comment_reply_link')) {
        if ( get_option('thread_comments') == '1' ) { ?>
    <li class="comment-reply"><?php comment_reply_link(array_merge( $args, array('add_below' => 'comment-content', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<span><span>'.__('REPLY','tcd-w').'</span></span>'))) ?></li>
<?php   } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'tcd-w'); ?></a></li>
<?php   }
      } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'tcd-w'); ?></a></li>
<?php } ?>
    <li class="comment-quote"><a href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment-content-<?php comment_ID() ?>', 'comment');"><?php _e('QUOTE', 'tcd-w'); ?></a></li>
    <?php edit_comment_link(__('EDIT', 'tcd-w'), '<li class="comment-edit">', '</li>'); ?>
   </ul>

  </div>
  <div class="comment-content post_content" id="comment-content-<?php comment_ID() ?>">
  <?php if ($comment->comment_approved == '0') : ?>
   <span class="comment-note"><?php _e('Your comment is awaiting moderation.', 'tcd-w'); ?></span>
  <?php endif; ?>
  <?php comment_text(); ?>
  </div>

<?php

}


/* 記事編集画面のカテゴリー階層を保つ */
function lig_wp_category_terms_checklist_no_top( $args, $post_id = null ) {
  $args['checked_ontop'] = false;
  return $args;
}
add_action( 'wp_terms_checklist_args', 'lig_wp_category_terms_checklist_no_top' );


// カスタム投稿「商品」 --------------------------------------------------------------------------------
$product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-w' );
$product_slug = $options['product_slug'] ? sanitize_title( $options['product_slug'] ) : 'product';
$product_labels = array(
  'name' => $product_label,
  'add_new' => __( 'Add New', 'tcd-w' ),
  'add_new_item' => __( 'Add New Item', 'tcd-w' ),
  'edit_item' => __( 'Edit', 'tcd-w' ),
  'new_item' => __( 'New item', 'tcd-w' ),
  'view_item' => __( 'View Item', 'tcd-w' ),
  'search_items' => __( 'Search Items', 'tcd-w' ),
  'not_found' => __( 'Not Found', 'tcd-w' ),
  'not_found_in_trash' => __( 'Not found in trash', 'tcd-w' ),
  'parent_item_colon' => ''
);

register_post_type( 'product', array(
  'label' => $product_label,
  'labels' => $product_labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => $product_slug ),
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array( 'title', 'thumbnail' ),
  'show_in_rest' => false	// ブロックエディターを使用しない、REST APIで表示しない
));


// 「商品」カテゴリー
$product_category_label = $options['product_category_label'] ? esc_html( $options['product_category_label'] ) : __( 'Product category', 'tcd-w' );
$product_category_slug = $options['product_category_slug'] ? sanitize_title( $options['product_category_slug'] ) : 'product_category';
$product_category_labels = array(
  'name' => $product_category_label,
  'singular_name' => $product_category_label
);
register_taxonomy( 'product_category', 'product', array(
  'labels' => $product_category_labels,
  'hierarchical' => true,
  'rewrite' => array( 'slug' => $product_category_slug )
));


/* アーカイブ・カテゴリーページの記事数を変更 */
function change_product_num( $query ) {
  $options = get_design_plus_option();
  $post_num = -1;
  if( !is_admin() && is_post_type_archive('product') ) {
    if($query->is_main_query()) {
      $query->set('posts_per_page', $post_num);
      return;
    };
  }
}
add_action( 'pre_get_posts', 'change_product_num' );


// カスタム投稿「サポート」 --------------------------------------------------------------------------------
$support_label = $options['support_label'] ? esc_html( $options['support_label'] ) : __( 'Support', 'tcd-w' );
$support_slug = $options['support_slug'] ? sanitize_title( $options['support_slug'] ) : 'support';
$support_labels = array(
  'name' => $support_label,
  'add_new' => __( 'Add New', 'tcd-w' ),
  'add_new_item' => __( 'Add New Item', 'tcd-w' ),
  'edit_item' => __( 'Edit', 'tcd-w' ),
  'new_item' => __( 'New item', 'tcd-w' ),
  'view_item' => __( 'View Item', 'tcd-w' ),
  'search_items' => __( 'Search Items', 'tcd-w' ),
  'not_found' => __( 'Not Found', 'tcd-w' ),
  'not_found_in_trash' => __( 'Not found in trash', 'tcd-w' ),
  'parent_item_colon' => ''
);

register_post_type( 'support', array(
  'label' => $support_label,
  'labels' => $support_labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => $support_slug ),
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array( 'title','editor' ),
  'show_in_rest' => false	// ブロックエディターを使用しない、REST APIで表示しない
));


// 「サポート」カテゴリー
$support_category_label = __( 'Support category', 'tcd-w' );
$support_category_slug = 'support_category';
$support_category_labels = array(
  'name' => $support_category_label,
  'singular_name' => $support_category_label
);
register_taxonomy( 'support_category', 'support', array(
  'labels' => $support_category_labels,
  'hierarchical' => true,
  'rewrite' => array( 'slug' => $support_category_slug )
));


// カスタム投稿お知らせ --------------------------------------------------------------------------------
$options = get_design_plus_option();
$news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );
$news_slug = $options['news_slug'] ? sanitize_title( $options['news_slug'] ) : 'news';
$news_labels = array(
  'name' => $news_label,
  'add_new' => __( 'Add New', 'tcd-w' ),
  'add_new_item' => __( 'Add New Item', 'tcd-w' ),
  'edit_item' => __( 'Edit', 'tcd-w' ),
  'new_item' => __( 'New item', 'tcd-w' ),
  'view_item' => __( 'View Item', 'tcd-w' ),
  'search_items' => __( 'Search Items', 'tcd-w' ),
  'not_found' => __( 'Not Found', 'tcd-w' ),
  'not_found_in_trash' => __( 'Not found in trash', 'tcd-w' ),
  'parent_item_colon' => ''
);

register_post_type( 'news', array(
  'label' => $news_label,
  'labels' => $news_labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => $news_slug ),
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array( 'title', 'editor', 'thumbnail' ),
  'show_in_rest' => false	// ブロックエディターを使用しない、REST APIで表示しない
));

//「お知らせ」カテゴリー
$news_category_label = $options['news_category_label'] ? esc_html( $options['news_category_label'] ) : __( 'News category', 'tcd-w' );
$news_category_slug = $options['news_category_slug'] ? sanitize_title( $options['news_category_slug'] ) : 'news_category';
$news_category_labels = array(
  'name' => $news_category_label,
  'singular_name' => $news_category_label
);
register_taxonomy( 'news_category', 'news', array(
  'labels' => $news_category_labels,
  'hierarchical' => true,
  'rewrite' => array( 'slug' => 'info' )
));

/* アーカイブページの記事数を変更 */
function change_news_num( $query ) {
  $options = get_design_plus_option();
  if(!empty($options['archive_news_num'])) {
    $post_num = $options['archive_news_num'];
  } else {
    $post_num = 10;
  };
  if( !is_admin() && is_post_type_archive('news')) {
    if($query->is_main_query()) {
      $query->set('posts_per_page', $post_num);
      return;
    };
  }
}
add_action( 'pre_get_posts', 'change_news_num' );


// カスタム投稿の数が多い為、メディアメニューの位置を変更 ----------------------------------------------------------
function customize_menus(){
  global $menu;
  $menu[19] = $menu[10];
  unset($menu[10]);
}
add_action( 'admin_menu', 'customize_menus' );


// 全てのカスタムフィールドを検索対象に含める --------------------------------------------------------------------------------
function cf_search_join($join, $query) {
    global $wpdb;
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' AS tcd_pm_search ON '. $wpdb->posts . '.ID = tcd_pm_search.post_id ';
    }
    return $join;
}
add_filter('posts_join', 'cf_search_join', 10, 2);

function cf_search_where($where, $query) {
    global $wpdb;
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (tcd_pm_search.meta_value LIKE $1)", $where);
    }
    return $where;
}
add_filter('posts_where', 'cf_search_where', 10, 2);

function cf_search_distinct($distinct, $query) {
    global $wpdb;
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        return "DISTINCT";
    }
    return $distinct;
}
add_filter('posts_distinct', 'cf_search_distinct', 10, 2);


// 検索結果ページをブログとお知らせのみに限定する --------------------------------------------------------------------------------
function SearchFilter($query) {
  if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
    $query->set('post_type', array('post','product') );
  }
}
add_action( 'pre_get_posts','SearchFilter' );


// タイトルとurlをコピーのスクリプト --------------------------------------------------------------------------------
function copy_title_url_script() {
  global $options;
  if ( ! $options ) $options = get_design_plus_option();

  if ( ( is_singular( 'post' ) && ( $options['single_blog_show_copy_top'] || $options['single_blog_show_copy_btm'] ) ) || is_singular( 'news' ) && ($options['single_news_show_copy_top'] || $options['single_news_show_copy_btm']) ) {
    wp_enqueue_script( 'copy_title_url', get_template_directory_uri().'/js/copy_title_url.js', array(), version_num(), true );
  }
}
add_action( 'wp_enqueue_scripts', 'copy_title_url_script' );


// カテゴリー編集画面にIDを表示する ------------------------------------------------------------------------------------
function add_category_columns($columns) {
  unset($columns['description']);
  $index = 1;
  return array_merge(
    array_slice($columns, 0, $index),
    array('id' => 'ID'),
    array_slice($columns, $index)
  );
}
add_filter('manage_edit-category_columns', 'add_category_columns');
function add_category_custom_fields($deprecated, $column_name, $term_id) {
  if ($column_name == 'id') {
    echo $term_id;
  }
}
add_action('manage_category_custom_column', 'add_category_custom_fields', 10, 3);


function add_custom_rewrite_rules() {
  add_rewrite_rule('info/([^0-9]+)/?$', 'index.php?news_category=$matches[1]&taxonomy=news_category', 'top');
  add_rewrite_rule('info/([^0-9]+)/page/([^/]+)/?$', 'index.php?news_category=$matches[1]&taxonomy=news_category&paged=$matches[2]', 'top');
}
add_action('init', 'add_custom_rewrite_rules');
?>
