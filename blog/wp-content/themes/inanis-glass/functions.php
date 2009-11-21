<?php
//Custom Header Stuph
define('HEADER_TEXTCOLOR', '009193');
define('HEADER_IMAGE', '%s/images/blogphoto.png'); // %s is theme dir uri
define('HEADER_IMAGE_WIDTH', 110);
define('HEADER_IMAGE_HEIGHT', 110);

function header_style() {
?>
<style type="text/css">
#bp{
	background: url(<?php header_image() ?>) no-repeat;
}
<?php if ( 'blank' == get_header_textcolor() ) { ?>
#bp h1, #bp #desc {
	display: none;
}
<?php } else { ?>
#bp h1 a, #desc {
	color:#<?php header_textcolor() ?>;
}
#desc {
	margin-right: 30px;
}
<?php } ?>
</style>
<?php
}

function blix_admin_header_style() {
?>
<style type="text/css">
#headimg{
	background: url(<?php header_image() ?>) no-repeat;
	height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
	width:<?php echo HEADER_IMAGE_WIDTH; ?>px;
  padding:0 0 0 18px;
}

#headimg h1{
	padding-top:40px;
	margin: 0;
	display: none;
}
#headimg h1 a{
	color:#<?php header_textcolor() ?>;
	text-decoration: none;
	border-bottom: none;
}
#headimg #desc{
	color:#<?php header_textcolor() ?>;
	font-size:1em;
	margin-top:-0.5em;
}

#desc {
	display: none;
}

<?php if ( 'blank' == get_header_textcolor() ) { ?>
#headimg h1, #headimg #desc {
	display: none;
}
#headimg h1 a, #headimg #desc {
	color:#<?php echo HEADER_TEXTCOLOR ?>;
}
<?php } ?>

</style>
<?php
}

add_custom_image_header('header_style', 'blix_admin_header_style');


// Widget Settings
if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Sidebar',
'before_widget' => '<div class="sidebar-top"><img src="'.get_bloginfo('template_directory').'/images/1pxtrans.gif" alt=" " /></div><div class="sidebar-mid"><ul>', 
'after_widget' => '</li></ul></div><div class="sidebar-bottom"><img src="'.get_bloginfo('template_directory').'/images/1pxtrans.gif" alt=" " /></div>', 
'before_title' => '<li><h3>',
'after_title' => '</h3>',
));

// now have a look for all available additional widgets and activate them
$widgets_dir = @ dir(ABSPATH . '/wp-content/themes/' . get_template() . '/widgets');
if ($widgets_dir)
{
while(($file = $widgets_dir->read()) !== false)
{
if (!preg_match('|^\.+$|', $file) && preg_match('|\.php$|', $file))
//$scheme_files[] = preg_replace('|\.php$|', '', $file);
include(ABSPATH . '/wp-content/themes/' . get_template() . '/widgets/' . $file);
}
}

function menu_ids($input) {
  global $baby, $matches;

  //Get the IDs from the $input
  preg_match_all('/m-(.+?)">/', $input, $matches, PREG_PATTERN_ORDER);
  $matches = $matches[1];
  
  // remove " current_page_item" from id listing
  reset($matches);
  foreach ($matches as $key => $value){
    $matches[$key] = str_replace ("current_page_item"  , ""  , $matches[$key]);
    $matches[$key] = str_replace ("current_page_ancestor"  , ""  , $matches[$key]);
    $matches[$key] = str_replace ("current_page_parent"  , ""  , $matches[$key]);
    $matches[$key] = str_replace (" "  , ""  , $matches[$key]);
  }

  //split the $input into an array
  $inputar = explode ( '<li' , $input );
  
  //insert the IDs and put the array back together
  //also, create arrays for each sub page.
  $count = 0;
  foreach ($inputar as $key => $value){
    if ($value <> "") {
      $inputar[$key] = '<li onmouseover="mhov('.$matches[$count].')" onmouseout="munhov()"'.$inputar[$key];
      $baby[$count] = wp_list_pages('child_of='.$matches[$count].'&sort_column=menu_order&title_li=&echo=0');
      $count = $count+1;
    }
  }

  //put array back into string and spew output
  $output = implode('', $inputar);
  echo $output;
  //return $baby;
}

?>
