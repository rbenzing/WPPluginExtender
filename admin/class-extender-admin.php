<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       russellbenzing.com
 * @since      1.0.0
 *
 * @package    Extender
 * @subpackage Extender/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Extender
 * @subpackage Extender/admin
 * @author     Russell Benzing <me@russellbenzing.com>
 */
class Extender_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}
	
	/**
	 * Add Admin submenu page
	 *
	 * @since 1.0.0
	 *
	 * @uses "admin_menu"
	 */
	public function extender_add_page() {
		
		add_menu_page(__( 'Extender Admin', 'extender' ), __( 'Extender Area', 'extender' ), 'manage_options', 'extender', array( $this, 'render_admin' ) );
	}
	
	/**
	 * Add Admin submenu settings fields & sections
	 *
	 * @since 1.0.0
	 *
	 * @uses "admin_menu"
	 */
	function extender_settings_init() { 
		register_setting( 'extender', 'extender_settings' );
		add_settings_section(
			'extender_admin_section', 
			__( 'My Admin Section Title', 'extender' ), 
			array($this, 'extender_settings_section_callback'), 
			'extender'
		);
	
		add_settings_field( 
			'extender_text_field_1', 
			__( 'Settings Field', 'extender' ), 
			array($this, 'extender_text_field_1_render'), 
			'extender', 
			'extender_admin_section' 
		);
	
		add_settings_field( 
			'extender_textarea_field_2', 
			__( 'Settings Field', 'extender' ), 
			array($this, 'extender_textarea_field_2_render'), 
			'extender', 
			'extender_admin_section' 
		);
	
		add_settings_field( 
			'extender_select_field_3', 
			__( 'Settings Field', 'extender' ), 
			array($this, 'extender_select_field_3_render'), 
			'extender', 
			'extender_admin_section' 
		);
	
		add_settings_field( 
			'extender_radio_field_4', 
			__( 'Settings field description', 'extender' ), 
			array($this, 'extender_radio_field_4_render'), 
			'extender', 
			'extender_admin_section'
		);
	}
	
	function extender_text_field_1_render() { 
	
		$options = get_option( 'extender_settings' );
		?>
		<input type='text' name='extender_settings[extender_text_field_1]' value='<?php echo esc_attr( $options['extender_text_field_1'] ); ?>'>
		<?php
	}
	
	function extender_textarea_field_2_render() { 
	
		$options = get_option( 'extender_settings' );
		?>
		<textarea cols='40' rows='5' name='extender_settings[extender_textarea_field_2]'> 
			<?php echo esc_textarea( $options['extender_textarea_field_2'] ); ?>
	 	</textarea>
		<?php
	}
	
	function extender_select_field_3_render() { 
	
		$options = get_option( 'extender_settings' );
		?>
		<select name='extender_settings[extender_select_field_3]'>
			<option value='1' <?php selected( $options['extender_select_field_3'], 1 ); ?>>Option 1</option>
			<option value='2' <?php selected( $options['extender_select_field_3'], 2 ); ?>>Option 2</option>
			<option value='3' <?php selected( $options['extender_select_field_3'], 3 ); ?>>Option 3</option>
			<option value='4' <?php selected( $options['extender_select_field_3'], 4 ); ?>>Option 4</option>
		</select>
		<?php
	}
	
	function extender_radio_field_4_render() { 
	
		$options = get_option( 'extender_settings' );
		?>
		<input type='radio' name='extender_settings[extender_radio_field_4]' <?php checked( $options['extender_radio_field_4'], 1 ); ?> value='1'> Yes
		<input type='radio' name='extender_settings[extender_radio_field_4]' <?php checked( $options['extender_radio_field_4'], 0 ); ?> value='0'> No
		<?php
	}
	
	function extender_settings_section_callback() { 
	
		echo __( 'This is the section description', 'extender' );
	}
	
	/**
	 * Render plugin admin page
	 *
	 * @since    1.0.0
	 */
	public function render_admin() {
		
		?>
		<form action='options.php' method='post' class="extender-admin">
	
			<h2>Extender</h2>
	
			<?php
			settings_fields( 'extender' );
			do_settings_sections( 'extender' );
			submit_button();
			?>
	
		</form>
		<?php
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Extender_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Extender_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/extender-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Extender_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Extender_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/extender-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Register a custom post type for Video/Photo Gallery
	 *
	 * @since    1.0.0
	 */
	public function extender_create_gallery() {
 
	    register_post_type( 'gallery',
	        array(
	            'labels' => array(
	                'name' => __( 'Gallery' ),
	                'singular_name' => __( 'Gallery' )
	            ),
	            'public' => true,
	            'has_archive' => false,
	            'rewrite' => array('slug' => 'gallery'),
	        )
	    );
	}

}
