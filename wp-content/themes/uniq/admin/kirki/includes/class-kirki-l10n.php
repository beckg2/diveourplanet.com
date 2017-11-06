<?php
/**
 * Internationalization helper.
 *
 * @package     Kirki
 * @category    Core
 * @author      Aristeides Stathopoulos
 * @copyright   Copyright (c) 2016, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0
 */

if ( ! class_exists( 'Kirki_l10n' ) ) {

	/**
	 * Handles translations
	 */
	class Kirki_l10n {

		/**
		 * The plugin textdomain
		 *
		 * @access protected
		 * @var string
		 */
		protected $textdomain = 'uniq';

		/**
		 * The class constructor.
		 * Adds actions & filters to handle the rest of the methods.
		 *
		 * @access public
		 */
		public function __construct() {

			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		}

		/**
		 * Load the plugin textdomain
		 *
		 * @access public
		 */
		public function load_textdomain() {

			if ( null !== $this->get_path() ) {
				load_textdomain( $this->textdomain, $this->get_path() );
			}
			load_plugin_textdomain( $this->textdomain, false, Kirki::$path . '/languages' );

		}

		/**
		 * Gets the path to a translation file.
		 *
		 * @access protected
		 * @return string Absolute path to the translation file.
		 */
		protected function get_path() {
			$path_found = false;
			$found_path = null;
			foreach ( $this->get_paths() as $path ) {
				if ( $path_found ) {
					continue;
				}
				$path = wp_normalize_path( $path );
				if ( file_exists( $path ) ) {
					$path_found = true;
					$found_path = $path;
				}
			}

			return $found_path;

		}

		/**
		 * Returns an array of paths where translation files may be located.
		 *
		 * @access protected
		 * @return array
		 */
		protected function get_paths() {

			return array(
				WP_LANG_DIR . '/' . $this->textdomain . '-' . get_locale() . '.mo',
				Kirki::$path . '/languages/' . $this->textdomain . '-' . get_locale() . '.mo',
			);

		}

		/**
		 * Shortcut method to get the translation strings
		 *
		 * @static
		 * @access public
		 * @param string $config_id The config ID. See Kirki_Config.
		 * @return array
		 */
		public static function get_strings( $config_id = 'global' ) {

			$translation_strings = array(
				'background-color'      => esc_attr__( 'Background Color', 'uniq' ),
				'background-image'      => esc_attr__( 'Background Image', 'uniq' ),
				'no-repeat'             => esc_attr__( 'No Repeat', 'uniq' ),
				'repeat-all'            => esc_attr__( 'Repeat All', 'uniq' ),
				'repeat-x'              => esc_attr__( 'Repeat Horizontally', 'uniq' ),
				'repeat-y'              => esc_attr__( 'Repeat Vertically', 'uniq' ),
				'inherit'               => esc_attr__( 'Inherit', 'uniq' ),
				'background-repeat'     => esc_attr__( 'Background Repeat', 'uniq' ),
				'cover'                 => esc_attr__( 'Cover', 'uniq' ),
				'contain'               => esc_attr__( 'Contain', 'uniq' ),
				'background-size'       => esc_attr__( 'Background Size', 'uniq' ),
				'fixed'                 => esc_attr__( 'Fixed', 'uniq' ),
				'scroll'                => esc_attr__( 'Scroll', 'uniq' ),
				'background-attachment' => esc_attr__( 'Background Attachment', 'uniq' ),
				'left-top'              => esc_attr__( 'Left Top', 'uniq' ),
				'left-center'           => esc_attr__( 'Left Center', 'uniq' ),
				'left-bottom'           => esc_attr__( 'Left Bottom', 'uniq' ),
				'right-top'             => esc_attr__( 'Right Top', 'uniq' ),
				'right-center'          => esc_attr__( 'Right Center', 'uniq' ),
				'right-bottom'          => esc_attr__( 'Right Bottom', 'uniq' ),
				'center-top'            => esc_attr__( 'Center Top', 'uniq' ),
				'center-center'         => esc_attr__( 'Center Center', 'uniq' ),
				'center-bottom'         => esc_attr__( 'Center Bottom', 'uniq' ),
				'background-position'   => esc_attr__( 'Background Position', 'uniq' ),
				'background-opacity'    => esc_attr__( 'Background Opacity', 'uniq' ),
				'on'                    => esc_attr__( 'ON', 'uniq' ),
				'off'                   => esc_attr__( 'OFF', 'uniq' ),
				'all'                   => esc_attr__( 'All', 'uniq' ),
				'cyrillic'              => esc_attr__( 'Cyrillic', 'uniq' ),
				'cyrillic-ext'          => esc_attr__( 'Cyrillic Extended', 'uniq' ),
				'devanagari'            => esc_attr__( 'Devanagari', 'uniq' ),
				'greek'                 => esc_attr__( 'Greek', 'uniq' ),
				'greek-ext'             => esc_attr__( 'Greek Extended', 'uniq' ),
				'khmer'                 => esc_attr__( 'Khmer', 'uniq' ),
				'latin'                 => esc_attr__( 'Latin', 'uniq' ),
				'latin-ext'             => esc_attr__( 'Latin Extended', 'uniq' ),
				'vietnamese'            => esc_attr__( 'Vietnamese', 'uniq' ),
				'hebrew'                => esc_attr__( 'Hebrew', 'uniq' ),
				'arabic'                => esc_attr__( 'Arabic', 'uniq' ),
				'bengali'               => esc_attr__( 'Bengali', 'uniq' ),
				'gujarati'              => esc_attr__( 'Gujarati', 'uniq' ),
				'tamil'                 => esc_attr__( 'Tamil', 'uniq' ),
				'telugu'                => esc_attr__( 'Telugu', 'uniq' ),
				'thai'                  => esc_attr__( 'Thai', 'uniq' ),
				'serif'                 => _x( 'Serif', 'font style', 'uniq' ),
				'sans-serif'            => _x( 'Sans Serif', 'font style', 'uniq' ),
				'monospace'             => _x( 'Monospace', 'font style', 'uniq' ),
				'font-family'           => esc_attr__( 'Font Family', 'uniq' ),
				'font-size'             => esc_attr__( 'Font Size', 'uniq' ),
				'font-weight'           => esc_attr__( 'Font Weight', 'uniq' ),
				'line-height'           => esc_attr__( 'Line Height', 'uniq' ),
				'font-style'            => esc_attr__( 'Font Style', 'uniq' ),
				'letter-spacing'        => esc_attr__( 'Letter Spacing', 'uniq' ),
				'top'                   => esc_attr__( 'Top', 'uniq' ),
				'bottom'                => esc_attr__( 'Bottom', 'uniq' ),
				'left'                  => esc_attr__( 'Left', 'uniq' ),
				'right'                 => esc_attr__( 'Right', 'uniq' ),
				'center'                => esc_attr__( 'Center', 'uniq' ),
				'justify'               => esc_attr__( 'Justify', 'uniq' ),
				'color'                 => esc_attr__( 'Color', 'uniq' ),
				'add-image'             => esc_attr__( 'Add Image', 'uniq' ),
				'change-image'          => esc_attr__( 'Change Image', 'uniq' ),
				'no-image-selected'     => esc_attr__( 'No Image Selected', 'uniq' ),
				'add-file'              => esc_attr__( 'Add File', 'uniq' ),
				'change-file'           => esc_attr__( 'Change File', 'uniq' ),
				'no-file-selected'      => esc_attr__( 'No File Selected', 'uniq' ),
				'remove'                => esc_attr__( 'Remove', 'uniq' ),
				'select-font-family'    => esc_attr__( 'Select a font-family', 'uniq' ),
				'variant'               => esc_attr__( 'Variant', 'uniq' ),
				'subsets'               => esc_attr__( 'Subset', 'uniq' ),
				'size'                  => esc_attr__( 'Size', 'uniq' ),
				'height'                => esc_attr__( 'Height', 'uniq' ),
				'spacing'               => esc_attr__( 'Spacing', 'uniq' ),
				'ultra-light'           => esc_attr__( 'Ultra-Light 100', 'uniq' ),
				'ultra-light-italic'    => esc_attr__( 'Ultra-Light 100 Italic', 'uniq' ),
				'light'                 => esc_attr__( 'Light 200', 'uniq' ),
				'light-italic'          => esc_attr__( 'Light 200 Italic', 'uniq' ),
				'book'                  => esc_attr__( 'Book 300', 'uniq' ),
				'book-italic'           => esc_attr__( 'Book 300 Italic', 'uniq' ),
				'regular'               => esc_attr__( 'Normal 400', 'uniq' ),
				'italic'                => esc_attr__( 'Normal 400 Italic', 'uniq' ),
				'medium'                => esc_attr__( 'Medium 500', 'uniq' ),
				'medium-italic'         => esc_attr__( 'Medium 500 Italic', 'uniq' ),
				'semi-bold'             => esc_attr__( 'Semi-Bold 600', 'uniq' ),
				'semi-bold-italic'      => esc_attr__( 'Semi-Bold 600 Italic', 'uniq' ),
				'bold'                  => esc_attr__( 'Bold 700', 'uniq' ),
				'bold-italic'           => esc_attr__( 'Bold 700 Italic', 'uniq' ),
				'extra-bold'            => esc_attr__( 'Extra-Bold 800', 'uniq' ),
				'extra-bold-italic'     => esc_attr__( 'Extra-Bold 800 Italic', 'uniq' ),
				'ultra-bold'            => esc_attr__( 'Ultra-Bold 900', 'uniq' ),
				'ultra-bold-italic'     => esc_attr__( 'Ultra-Bold 900 Italic', 'uniq' ),
				'invalid-value'         => esc_attr__( 'Invalid Value', 'uniq' ),
				'add-new'           	=> esc_attr__( 'Add new', 'uniq' ),
				'row'           		=> esc_attr__( 'row', 'uniq' ),
				'limit-rows'            => esc_attr__( 'Limit: %s rows', 'uniq' ),
				'open-section'          => esc_attr__( 'Press return or enter to open this section', 'uniq' ),
				'back'                  => esc_attr__( 'Back', 'uniq' ),
				'reset-with-icon'       => sprintf( esc_attr__( '%s Reset', 'uniq' ), '<span class="dashicons dashicons-image-rotate"></span>' ),
				'text-align'            => esc_attr__( 'Text Align', 'uniq' ),
				'text-transform'        => esc_attr__( 'Text Transform', 'uniq' ),
				'none'                  => esc_attr__( 'None', 'uniq' ),
				'capitalize'            => esc_attr__( 'Capitalize', 'uniq' ),
				'uppercase'             => esc_attr__( 'Uppercase', 'uniq' ),
				'lowercase'             => esc_attr__( 'Lowercase', 'uniq' ),
				'initial'               => esc_attr__( 'Initial', 'uniq' ),
				'select-page'           => esc_attr__( 'Select a Page', 'uniq' ),
				'open-editor'           => esc_attr__( 'Open Editor', 'uniq' ),
				'close-editor'          => esc_attr__( 'Close Editor', 'uniq' ),
				'switch-editor'         => esc_attr__( 'Switch Editor', 'uniq' ),
				'hex-value'             => esc_attr__( 'Hex Value', 'uniq' ),
			);

			$config = apply_filters( 'kirki/config', array() );

			if ( isset( $config['i18n'] ) ) {
				$translation_strings = wp_parse_args( $config['i18n'], $translation_strings );
			}

			return apply_filters( 'kirki/' . $config_id . '/l10n', $translation_strings );

		}
	}
}
