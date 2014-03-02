<?php
/**
 * Creates theme settings
 *
 * @package Neutro
 * @subpackage Functions
 * @link http://themehybrid.com/hybrid-core/features/theme-settings
 * @since 1.0
 */

add_action( 'admin_menu', 'neutro_admin_setup' );

function neutro_admin_setup() {
	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();
	$settings_page = hybrid_get_settings_page_name();

	/* Load theme settings meta boxes. */
	add_action( "load-{$settings_page}", 'neutro_create_settings_meta_boxes' );

	/* Validate theme settings. */
	add_filter( "sanitize_option_{$prefix}_theme_settings", 'neutro_validate_theme_settings' );
}

/**
 * Validates the theme settings.
 *
 * @since 1.0
 */
function neutro_validate_theme_settings( $settings ) {

	$settings['featured_slider_categories'] = ( ( isset( $settings['featured_slider_categories'] ) && is_array( $settings['featured_slider_categories'] ) ) ? array_map( 'absint', $settings['featured_slider_categories'] ) : array() );
	$settings['featured_slider_display'] = ( isset( $settings['featured_slider_display'] ) ? 1 : 0 );
	$settings['custom_css'] = ( isset( $settings['custom_css'] ) ? trim(esc_textarea( neutro_sanitize($settings['custom_css']) ) ) : '' );

	return $settings;
}

/**
 * Add meta boxes to the theme settings page.
 *
 * @since 1.0
 */
function neutro_create_settings_meta_boxes() {
	add_meta_box( "neutro-featured-slider-meta-box", __( 'Featured Slider Settings', 'neutro' ), 'neutro_featured_slider_meta_box', 'appearance_page_theme-settings', 'normal', 'low' );

	add_meta_box( "neutro-custom-css-meta-box", __( 'Custom CSS', 'neutro' ), 'neutro_custom_css_meta_box', 'appearance_page_theme-settings', 'normal', 'low' );
 }

 /**
 * Display the Featured slider meta box.
 *
 * @since 1.0
 */
function neutro_featured_slider_meta_box() {
	$prefix = hybrid_get_prefix();

	/* Settings used. */
	$display_slider = hybrid_get_setting( 'featured_slider_display' );
	$categories_slider = hybrid_get_setting( 'featured_slider_categories' );
	
	/* Get categories. */
	$categories = get_categories(); ?>

	<table class="form-table">

		<tr>
			<th><?php _e( 'About:', 'neutro' ); ?></th>
			<td>
				<?php _e( 'Settings used for displaying Featured slider on homepage. Add content to slider by assigning sticky post or by selecting categories to assign content by category. You can also disable featured slider altogether if you do not need one.', 'neutro' ); ?>
			</td>
		</tr>
		<tr>
			<th><label for="<?php echo hybrid_settings_field_id( 'featured_slider_display' ); ?>"><?php _e( 'Disable slider?', 'neutro' ); ?></label></th>
			<td>
				<input id="featured_slider_display" name="<?php echo hybrid_settings_field_name( 'featured_slider_display' ); ?>" type="checkbox" value="0" <?php checked( hybrid_get_setting( 'featured_slider_display' ), 1 ); ?> /> <?php _e( 'Check this box to disable Featured slider', 'neutro' ); ?>	
			</td>
		</tr>
		<tr>
			<th><label for="<?php echo hybrid_settings_field_id( 'featured_slider_categories' ); ?>"><?php _e( 'Featured Categories:', 'neutro' ); ?></label></th>
			<td>
				<label for="<?php echo hybrid_settings_field_id( 'featured_slider_categories' ); ?>"><?php _e( 'Categories to show blog posts from in the Featured slider.  Multiple categories may be chosen by holding the <code>Ctrl</code> key and selecting.', 'neutro' ); ?></label>
				<br />
				<select id="<?php echo hybrid_settings_field_id( 'featured_slider_categories' ); ?>" name="<?php echo hybrid_settings_field_name( 'featured_slider_categories' ); ?>[]" multiple="multiple" style="height:150px;">
				<?php foreach( $categories as $cat ) { ?>
					<option value="<?php echo $cat->term_id; ?>" <?php if ( is_array( $categories_slider ) && in_array( $cat->term_id, $categories_slider ) ) echo ' selected="selected"'; ?>><?php echo esc_html( $cat->name ); ?></option>
				<?php } ?>
				</select>
			</td>
		</tr>

	</table><?php
}

 /**
 * Display the custom css meta box.
 *
 * @since 1.0
 */
function neutro_custom_css_meta_box(){
	$prefix = hybrid_get_prefix();

	/* Settings used. */
	$custom_css = hybrid_get_setting('custom_css'); ?>

	<?php if(current_user_can('unfiltered_html' ) ): ?>

	<table class="form-table">
		<tr>
			
			<td>
				<?php _e( 'Add your Custom css here. Make sure to use correct css selector in order for custom css to take effect.', 'neutro' ); ?>
			</td>
		</tr>
		<tr>
			<td>
				<textarea id="custom_css" name="<?php echo hybrid_settings_field_name( 'custom_css' ); ?>"  cols="30" rows="10" style="background: #f9f9f9;"><?php echo hybrid_get_setting( 'custom_css' ); ?></textarea>
			</td>
		</tr>
	</table>
	
	<?php endif; ?>

<?php
}

?>