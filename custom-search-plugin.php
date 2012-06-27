<?php
/*
Plugin Name: Custom Search
Plugin URI: http://bestwebsoft.com/plugin/
Description: Custom Search Plugin designed to search for site custom types.
Author: BestWebSoft
Version: 1.04
Author URI: http://bestwebsoft.com/
License: GPLv2 or later
*/
 
/*  © Copyright 2011  BestWebSoft  ( dimka.simonov@gmail.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if( ! function_exists( 'bws_add_menu_render' ) ) {
	function bws_add_menu_render() {
		global $title;
		$active_plugins = get_option('active_plugins');
		$all_plugins		= get_plugins();

		$array_activate = array();
		$array_install	= array();
		$array_recomend = array();
		$count_activate = $count_install = $count_recomend = 0;
		$array_plugins	= array(
			array( 'captcha\/captcha.php', 'Captcha', 'http://wordpress.org/extend/plugins/captcha/', 'http://bestwebsoft.com/plugin/captcha-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Captcha+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=captcha.php' ), 
			array( 'contact-form-plugin\/contact_form.php', 'Contact Form', 'http://wordpress.org/extend/plugins/contact-form-plugin/', 'http://bestwebsoft.com/plugin/contact-form/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Contact+Form+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=contact_form.php' ), 
			array( 'facebook-button-plugin\/facebook-button-plugin.php', 'Facebook Like Button Plugin', 'http://wordpress.org/extend/plugins/facebook-button-plugin/', 'http://bestwebsoft.com/plugin/facebook-like-button-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Facebook+Like+Button+Plugin+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=facebook-button-plugin.php' ), 
			array( 'twitter-plugin\/twitter.php', 'Twitter Plugin', 'http://wordpress.org/extend/plugins/twitter-plugin/', 'http://bestwebsoft.com/plugin/twitter-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Twitter+Plugin+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=twitter.php' ), 
			array( 'portfolio\/portfolio.php', 'Portfolio', 'http://wordpress.org/extend/plugins/portfolio/', 'http://bestwebsoft.com/plugin/portfolio-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Portfolio+bestwebsoft&plugin-search-input=Search+Plugins', '' ),
			array( 'gallery-plugin\/gallery-plugin.php', 'Gallery', 'http://wordpress.org/extend/plugins/gallery-plugin/', 'http://bestwebsoft.com/plugin/gallery-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Gallery+Plugin+bestwebsoft&plugin-search-input=Search+Plugins', '' ),
			array( 'adsense-plugin\/adsense-plugin.php', 'Google AdSense Plugin', 'http://wordpress.org/extend/plugins/adsense-plugin/', 'http://bestwebsoft.com/plugin/google-adsense-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Adsense+Plugin+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=adsense-plugin.php' ),
			array( 'custom-search-plugin\/custom-search-plugin.php', 'Custom Search Plugin', 'http://wordpress.org/extend/plugins/custom-search-plugin/', 'http://bestwebsoft.com/plugin/custom-search-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Custom+Search+plugin+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=custom_search.php' ),
			array( 'quotes_and_tips\/quotes-and-tips.php', 'Quotes and Tips', 'http://wordpress.org/extend/plugins/quotes-and-tips/', 'http://bestwebsoft.com/plugin/quotes-and-tips/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Quotes+and+Tips+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=quotes-and-tips.php' )
		);
		foreach($array_plugins as $plugins) {
			if( 0 < count( preg_grep( "/".$plugins[0]."/", $active_plugins ) ) ) {
				$array_activate[$count_activate]['title'] = $plugins[1];
				$array_activate[$count_activate]['link']	= $plugins[2];
				$array_activate[$count_activate]['href']	= $plugins[3];
				$array_activate[$count_activate]['url']	= $plugins[5];
				$count_activate++;
			}
			else if( array_key_exists(str_replace("\\", "", $plugins[0]), $all_plugins) ) {
				$array_install[$count_install]['title'] = $plugins[1];
				$array_install[$count_install]['link']	= $plugins[2];
				$array_install[$count_install]['href']	= $plugins[3];
				$count_install++;
			}
			else {
				$array_recomend[$count_recomend]['title'] = $plugins[1];
				$array_recomend[$count_recomend]['link']	= $plugins[2];
				$array_recomend[$count_recomend]['href']	= $plugins[3];
				$array_recomend[$count_recomend]['slug']	= $plugins[4];
				$count_recomend++;
			}
		}
		?>
		<div class="wrap">
			<div class="icon32 icon32-bws" id="icon-options-general"></div>
			<h2><?php echo $title;?></h2>
			<?php if( 0 < $count_activate ) { ?>
			<div>
				<h3><?php _e( 'Activated plugins', 'captcha' ); ?></h3>
				<?php foreach( $array_activate as $activate_plugin ) { ?>
				<div style="float:left; width:200px;"><?php echo $activate_plugin['title']; ?></div> <p><a href="<?php echo $activate_plugin['link']; ?>" target="_blank"><?php echo __( "Read more", 'captcha'); ?></a> <a href="<?php echo $activate_plugin['url']; ?>"><?php echo __( "Settings", 'captcha'); ?></a></p>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if( 0 < $count_install ) { ?>
			<div>
				<h3><?php _e( 'Installed plugins', 'captcha' ); ?></h3>
				<?php foreach($array_install as $install_plugin) { ?>
				<div style="float:left; width:200px;"><?php echo $install_plugin['title']; ?></div> <p><a href="<?php echo $install_plugin['link']; ?>" target="_blank"><?php echo __( "Read more", 'captcha'); ?></a></p>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if( 0 < $count_recomend ) { ?>
			<div>
				<h3><?php _e( 'Recommended plugins', 'captcha' ); ?></h3>
				<?php foreach( $array_recomend as $recomend_plugin ) { ?>
				<div style="float:left; width:200px;"><?php echo $recomend_plugin['title']; ?></div> <p><a href="<?php echo $recomend_plugin['link']; ?>" target="_blank"><?php echo __( "Read more", 'captcha'); ?></a> <a href="<?php echo $recomend_plugin['href']; ?>" target="_blank"><?php echo __( "Download", 'captcha'); ?></a> <a class="install-now" href="<?php echo get_bloginfo( "url" ) . $recomend_plugin['slug']; ?>" title="<?php esc_attr( sprintf( __( 'Install %s' ), $recomend_plugin['title'] ) ) ?>" target="_blank"><?php echo __( 'Install now from wordpress.org', 'captcha' ) ?></a></p>
				<?php } ?>
				<span style="color: rgb(136, 136, 136); font-size: 10px;"><?php _e( 'If you have any questions, please contact us via plugin@bestwebsoft.com or fill in our contact form on our site', 'captcha' ); ?> <a href="http://bestwebsoft.com/contact/">http://bestwebsoft.com/contact/</a></span>
			</div>
			<?php } ?>
		</div>
		<?php
	}
}

if( ! function_exists( 'add_cstmsrch_admin_menu' ) ) {
	function add_cstmsrch_admin_menu() {
		add_menu_page( 'BWS Plugins', 'BWS Plugins', 'manage_options', 'bws_plugins', 'bws_add_menu_render', plugins_url("images/px.png", __FILE__), 1001); 
		add_submenu_page( 'bws_plugins', __( 'Custom Search Options', 'custom-search' ), __( 'Custom search', 'custom-search' ), 'manage_options', "custom_search.php", 'cstmsrch_settings_page' );
	}
}

if ( ! function_exists ( 'cstmsrch_admin_head' ) ) {
	function cstmsrch_admin_head() {
		wp_register_style( 'cstmsrchStylesheet', plugins_url( 'css/style.css', __FILE__ ) );
		wp_enqueue_style( 'cstmsrchStylesheet' );
	}
}

if( ! function_exists( 'register_cstmsrch_settings' ) ) {
	function register_cstmsrch_settings() {
		global $wpmu;
		global $cstmsrch_options;

		$cstmsrch_option_defaults = array();

		if ( 1 == $wpmu ) {
			if( ! get_site_option( 'bws_custom_search' ) ) {
				add_site_option( 'bws_custom_search', $cstmsrch_option_defaults );
			}
		} 
		else {
			if( ! get_option( 'bws_custom_search' ) )
				add_option( 'bws_custom_search', $cstmsrch_option_defaults );
		}
			
		if ( 1 == $wpmu )
			$cstmsrch_options = get_site_option( 'bws_custom_search' ); 
		else
			$cstmsrch_options = get_option( 'bws_custom_search' );
	}	
}

if( ! function_exists( 'delete_cstmsrch_settings' ) ) {
	function delete_cstmsrch_settings() {
		delete_option( 'bws_custom_search' );
	}
}   

if( ! function_exists( 'cstmsrch_options_global' ) ) {
	function cstmsrch_options_global() {
		global $wpmu, $cstmsrch_options;
		if ( 1 == $wpmu )
			$cstmsrch_options = get_site_option( 'bws_custom_search' ); 
		else
			$cstmsrch_options = get_option( 'bws_custom_search' );
	}
}   

if( ! function_exists( 'cstmsrch_searchfilter' ) ) {
	function cstmsrch_searchfilter( $query ) {
		global $cstmsrch_options;
		if ( $query->is_search ){
			$cstmsrch_post_standart_types = array( 'post', 'page', 'revision', 'attachment', 'nav_menu_item' );
			$cstmsrch_result_merge = array_merge( $cstmsrch_post_standart_types, $cstmsrch_options );	
			$query->set( 'post_type', $cstmsrch_result_merge );				
		}
		return $query;
	}
}   

if( ! function_exists( 'cstmsrch_settings_page' ) ){	
	function  cstmsrch_settings_page(){
	global $wpdb, $cstmsrch_options;
	$cstmsrch_necessary_variables = array();
	if( isset( $_REQUEST['cstmsrch_submit'] ) ) {
		$cstmsrch_options = isset( $_REQUEST['cstmsrch_options'] ) ? $_REQUEST['cstmsrch_options'] : array() ;
		update_option( 'bws_custom_search', $cstmsrch_options );
		$message = __( "Options saved." , 'custom-searc' );	
	}
	$cstmsrch_result = $wpdb->get_results( "SELECT post_type FROM ". $wpdb->posts ." WHERE post_type NOT IN ('revision', 'page', 'post', 'attachment', 'nav_menu_item') GROUP BY post_type" );	
	?>
	<div class="wrap">
		<div class="icon32 icon32-bws" id="icon-options-general"></div>
		<h2><?php _e( 'Custom Search Options', 'custom-search' ); ?></h2>
		<div class="updated fade" <?php if( ! isset( $_REQUEST['cstmsrch_submit'] ) || $error != "" ) echo "style=\"display:none\""; ?>><p><strong><?php echo $message; ?></strong></p></div>
		<?php if( count( $cstmsrch_result ) > 0 ) { ?>
			<form method="post" action="">
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php _e( 'Enable Custom search on the:', 'custom-search' ); ?> </th>
						<td>
							<?php 
							foreach ( $cstmsrch_result as $key => $value ) { ?>
								<input type="checkbox" <?php echo ( in_array( $value->post_type, $cstmsrch_options ) ?  'checked="checked"' : "" ); ?> name="cstmsrch_options[]" value="<?php echo $value->post_type; ?>"/><span style="text-transform: capitalize; padding-left: 5px;"><?php echo $value->post_type; ?></span><br />
							<?php } ?>
						</td>
					</tr>	
				</table>	
				<input type="hidden" name="cstmsrch_submit" value="submit" />
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
				</p>
			</form>
		<?php } else { ?>
			<?php _e( 'Did not match any custom post type.', 'custom-search' ); ?>
		<?php } ?>
		</div>
	<?php
	}
}

if ( ! function_exists ( 'cstmsrch_init' ) ) {
	function cstmsrch_init(){
		load_plugin_textdomain( 'custom-search', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
	}
}

register_activation_hook( __FILE__, 'register_cstmsrch_settings'); // activate plugin
register_uninstall_hook( __FILE__, 'delete_cstmsrch_settings'); // uninstall plugin
	
add_action( 'admin_menu', 'add_cstmsrch_admin_menu' );
add_action( 'admin_init', 'cstmsrch_init' );
add_action( 'admin_enqueue_scripts', 'cstmsrch_admin_head' );
add_action( 'init', 'cstmsrch_options_global' );
add_filter( 'pre_get_posts', 'cstmsrch_searchfilter' );
?>