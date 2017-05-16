<?php
/**
 * @package clean-copy
 * @version 0.1
 */
/*
Plugin Name: clean copy
Plugin URI: http://wordpress.org/plugins/clean-copy/
Description: cleans the copied content tags.
Author: nabtron
Version: 0.1
Author URI: http://nabtron.com/
*/

add_filter('tiny_mce_before_init', 'customize_tinymce');

function customize_tinymce($in) {
  $in['paste_preprocess'] = "function(pl,o){ 
    o.content = o.content.replace(/<\/*span[^>]*>/gi,''); 
    o.content = o.content.replace(/<(div|table|tbody|tr|td|p|b|font|strong|i|em|h1|h2|h3|h4|h5|h6|hr|ul|li|ol) [^>]*>/gi,'<$1>'); 
    if (o.content.match(/<br[\/\s]*>/gi)) {
      o.content = o.content.replace(/<br[\s\/]*>/gi,'</p><p>'); 
    }
    o.content = o.content.replace(/<(\/)*div[^>]*>/gi,'<$1p>');
    // repeating it twice as in PHP version, don't know why! and broke the logic into individual steps for clarity
    o.content = o.content.replace(/<\/p>[\s\\r\\n]+<\/p>/gi,'</p></p>');
    o.content = o.content.replace(/<\<p>[\s\\r\\n]+<p>/gi,'<p><p>');
    o.content = o.content.replace(/<\/p>[\s\\r\\n]+<\/p>/gi,'</p></p>');
    o.content = o.content.replace(/<\<p>[\s\\r\\n]+<p>/gi,'<p><p>');
    o.content = o.content.replace(/(<\/p>)+/gi,'</p>');
    o.content = o.content.replace(/(<p>)+/gi,'<p>');
  }";
  return $in;
}
