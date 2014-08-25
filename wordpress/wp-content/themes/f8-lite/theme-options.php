<?php

add_action( 'admin_init', 'f8_theme_options_init' );
add_action( 'admin_menu', 'f8_theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function f8_theme_options_init(){
	register_setting( 'f8_options', 'f8_theme_options', 'f8_theme_options_validate' );
}

/**
 * Load up the menu page
 */
function f8_theme_options_add_page() {
	add_theme_page( __( 'Theme Options' ), __( 'Theme Options' ), 'edit_theme_options', 'theme_options', 'f8_theme_options_do_page' );
}

/**
 * Create arrays for our select and radio options
 */
$select_options = array(
	'0' => array(
		'value' =>	'0',
		'label' => __( 'None' )
	),
	'1' => array(
		'value' =>	'1',
		'label' => __( 'Single Header Image' )
	),
	'2' => array(
		'value' => '2',
		'label' => __( 'Minimalist Slideshow' )
	),
	'3' => array(
		'value' => '3',
		'label' => __( 'Overlay Text on Slideshow' )
	)
);

/**
 * Create the options page
 */
function f8_theme_options_do_page() {
	global $select_options, $radio_options;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false;

	?>
	<div class="wrap">
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<?php screen_icon(); echo "<h2>" . $theme_name . __( ' Theme Options' ) . "</h2>"; ?>
		
		<p>Please read the <a href="<?php bloginfo( 'template_directory' ); ?>/instructions.html" target="_blank">theme instructions</a> if you have questions using this theme.  If you need additional help, <a href="http://graphpaperpress.com/support/" target="_blank" title="visit the Graph Paper Press support forums">visit Graph Paper Press support</a>.</p>

		<?php if ( false !== $_REQUEST['updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'f8_options' ); ?>
			<?php $options = get_option( 'f8_theme_options' ); ?>

			<table class="form-table">

				<?php
				/**
				 * A sample text input option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Phone number' ); ?></th>
					<td>
						<input id="f8_theme_options[phone]" class="regular-text" type="text" name="f8_theme_options[phone]" value="<?php esc_attr_e( $options['phone'] ); ?>" />
						<label class="description" for="f8_theme_options[phone]"><?php _e( 'Add your phone number' ); ?></label>
					</td>
				</tr>
				
				<tr valign="top"><th scope="row"><?php _e( 'Email' ); ?></th>
					<td>
						<input id="f8_theme_options[email]" class="regular-text" type="text" name="f8_theme_options[email]" value="<?php esc_attr_e( $options['email'] ); ?>" />
						<label class="description" for="f8_theme_options[email]"><?php _e( 'Add your email address' ); ?></label>
					</td>
				</tr>
				
				<?php
				/**
				 * A sample select input option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Slideshow Options' ); ?></th>
					<td>
						<select name="f8_theme_options[selectinput]">
							<?php
								$selected = $options['selectinput'];
								$p = '';
								$r = '';

								foreach ( $select_options as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="f8_theme_options[selectinput]"><?php _e( 'If you select Single Header Image, you need to upload your image on the Appearance -> Header page.  If you select either Minimalist Slideshow or Overlay Text on Slideshow, the images will cycle through the Featured Image for each of your most recent 5 posts.' ); ?></label>
					</td>
				</tr>
				

				<tr valign="top"><th scope="row"><?php _e( 'Slideshow Categories' ); ?></th>
					<td>
						<input id="f8_theme_options[cats]" class="regular-text" type="text" name="f8_theme_options[cats]" value="<?php esc_attr_e( $options['cats'] ); ?>" />
						<label class="description" for="f8_theme_options[cats]"><?php _e( 'Add comma separated category ID\'s here.  Example: 1,3,10.  Here is how you find them: On the Categories panel, hover the mouse over the category name link and you will see the link address in your browser\'s status bar (turn it on under View) or click the link. The last numbers in the link address is your category ID number.' ); ?></label>
					</td>
				</tr>

			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function f8_theme_options_validate( $input ) {
	global $select_options, $radio_options;

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

	// Say our text option must be safe text with no HTML tags
	$input['phone'] = wp_filter_nohtml_kses( $input['phone'] );
	$input['email'] = wp_filter_nohtml_kses( $input['email'] );
	$input['cats'] = wp_filter_nohtml_kses( $input['cats'] );
	
	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['selectinput'], $select_options ) )
		$input['selectinput'] = null;

	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/