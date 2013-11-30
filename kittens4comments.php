<?php
/*
Plugin Name: Kittens for comments
Plugin URI: http://www.willthewebmechanic.com/kittens-for-comments.html
Description: Encourages comments by offering cute kitten pictures as a reward.  You can add more pictures by uploading them to wp-content/plugins/kittens4comments/images/kittens
Version: 1.0
Author: Will Brubaker
Author URI: http://www.willthewebmechanic.com
License: GPLv3
*/
/*
    Kittens for Comments WordPress plugin
    Copyright (C) 2013 Will Brubaker (Will the Web Mechanic)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
class KittensForComments {

 public function KittensForComments()
 {

  add_action( 'wp_enqueue_scripts', array(&$this,'my_enqueue_scripts' ) );
  add_action( 'comment_form', array( &$this,'kitten_comment_addons' ) );
  add_filter( 'comment_form_defaults', array( &$this,'comment_form_addons' ) );

  if ( is_admin() ) {

   add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( &$this, 'plugin_manage_link' ), 10, 4 );
  }
 }

 //this is a placeholder for future method of grabbing the id of the commentform
 public function comment_form_addons( $form )
 {

  return $form;
 }

 public function kitten_comment_addons($form)
 {

  $kittenpic = $this->random_pic();
  echo '<script type="text/javascript"> var kittenPic = "' . plugins_url( 'images/kittens/' . $kittenpic, __FILE__ ) . '"</script>';
  ?>
   <div class="kittenpanel">
   <p>Your comments make us happy.</p>  <p>Leave a comment, get a kitten!</p>
   </div>

  <?php
 }

 public function my_enqueue_scripts()
 {

  if( is_single() ) {

   wp_register_script( 'waypoints', plugins_url( 'js/waypoints.min.js', __FILE__ ), array( 'jquery', ), '2.0.2', true );
   //wp_enqueue_script( 'jquery_tools_overlay', plugins_url( 'js/jquery.tools.overlay.min.js', __FILE__ ), array( 'jquery', ), '1.4.4', true );
   wp_register_script( 'colorbox', plugins_url( 'js/jquery.colorbox-min.js', __FILE__ ), array( 'jquery' ), '1.4.33', true );
   wp_enqueue_script( 'kittens4comments', plugins_url( 'js/kittens4comments.js', __FILE__ ), array( 'waypoints', 'colorbox', ), '1.0', true );
   wp_enqueue_style( 'colorbox', plugins_url( 'css/colorbox.css', __FILE__ ) );
   wp_enqueue_style( 'kittens4commentsstyle', plugins_url( 'css/kittens4comments.css', __FILE__ ) );
  }
 }

 public function random_pic()
 {

  $dir = plugin_dir_path( __FILE__ ) . 'images/kittens';

  if ($dh = opendir($dir) ) {

   while ( ($file = readdir( $dh ) ) !== false) {

    if( getimagesize( $dir . '/' . $file ) ) {

     $files[] = $file;
    }
   }
  }

  $file = array_rand($files);
  return $files[$file];
 }

 public function plugin_manage_link( $actions, $plugin_file, $plugin_data, $context)
 {

  //add a link to the front of the actions list for this plugin
  return array_merge(

   array( 'Hire Me' => '<a href="http://www.willthewebmechanic.com">Hire Me</a>', ),
    $actions
    );
 }
}

$kittens4comments = new KittensForComments;