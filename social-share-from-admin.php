<?php
/*
Plugin Name: Social Share from Admin
Plugin URI: http://hgbeyer.com
Description: Gives the ability to share a post by clicking on a simple link in the posts overview. Facebook g+ and Xing is supported. You need to have an active session open (need to be logged in to these social platforms) in order to share something.
Version: 1.1
Author: hikari
*/

// add another column to the post management table
add_filter('manage_posts_columns', 'ssfa_share_post_column', 5);
add_filter('manage_pages_columns', 'ssfa_share_post_column', 5);

// configure the newly added column
function ssfa_share_post_column($cols){
  $cols['share_post'] = __('Share');
  return $cols;
}


function ssfa_share_post_action($col, $id){
  switch($col){
      case 'share_post':
        $permalink = get_permalink($id);
        echo '<a href="https://twitter.com/intent/tweet?text=' . get_post($id)->post_title . '. ' . $permalink . '" target="_blank">Share on Twitter</a>' . '<br />'
          . '<a href="http://www.facebook.com/sharer/sharer.php?u=' . $permalink . '" target="_blank">Share on Facebook</a><br/>'
          . '<a href="https://www.xing.com/spi/shares/new?url=' . $permalink . '" target="_blank">Share on Xing</a><br/>'
          . '<a href="https://plus.google.com/share?url=' . $permalink . '" target="_blank">Share on g+</a>'
          . '<a href="https://www.linkedin.com/cws/share?url=' . $permalink . '" target="_blank">Share on LinkedIn</a>';
        break;
    }
}

add_action('manage_posts_custom_column', 'ssfa_share_post_action', 5, 2);
add_action('manage_pages_custom_column', 'ssfa_share_post_action', 5, 2);