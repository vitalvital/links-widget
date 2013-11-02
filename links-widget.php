<?php
/*
Plugin Name: Synced Link Widget
Plugin URI: http://www.fineonly.com
Description: List all links from Forum
Version: 0.5
Author: Vital
Author URI: http://www.fineonly.com
License: Free
*/

class SyncedLinkWidget extends WP_Widget
{
  function SyncedLinkWidget() {
    $widget_ops = array('classname' => 'websites', 'description' => 'Our Websites' );
    parent::WP_Widget(false, $name = 'Websites', $widget_ops);
  }
  
  function form($instance) {
    $defaults = array( 'title' => 'Our other websites');
    $instance = wp_parse_args( (array) $instance, $defaults );

    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
  
<?php
  }
  
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }

  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    echo $before_widget;
    if (!empty($title))
    echo $before_title . $title . $after_title;
    echo '<ul>'.file_get_contents('http://www.informationenergymedicine-academy.com/links.php').'</ul>';
    echo $after_widget;
  }
}

add_action('widgets_init', create_function('', 'return register_widget("SyncedLinkWidget");'));

?>
