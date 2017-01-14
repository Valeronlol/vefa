<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 * @package    imagelinks
 * @subpackage imagelinks/public
 */
class ImageLinks_Public {
	/**
	 * The ID of this plugin.
	 *
	 * @since 1.0.0
	 */
	private $plugin_name;


	/**
	 * The version of this plugin.
	 *
	 * @since 1.0.0
	 */
	private $version;


	/**
	 * The post type of this plugin.
	 *
	 * @since 1.0.0
	 */
	private $post_type;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param      string    $plugin_name  The name of the plugin.
	 * @param      string    $version      The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $post_type ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->post_type = $post_type;
	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles() {
		$plugin_url = plugin_dir_url( dirname(__FILE__) );
		
		wp_enqueue_style( $this->plugin_name . '_imagelinks',    $plugin_url . 'lib/imagelinks.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '_imagelinks_wp', $plugin_url . 'lib/imagelinks.wp.css', array(), $this->version, 'all' );
	}


	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since 1.3.0
	 */
	public function register_scripts() {
		wp_register_script($this->plugin_name . '-imagelinks', plugin_dir_url( dirname(__FILE__) ) . 'lib/jquery.imagelinks.min.js', array( 'jquery' ), $this->version, true);
	}
	
	/**
	 * Print the JavaScript for the public-facing side of the site.
	 *
	 * @since 1.3.0
	 */
	public function print_scripts() {
		global $imagelink_plugin_shortcode_used;

		if ( ! $imagelink_plugin_shortcode_used )
			return;

		wp_print_scripts($this->plugin_name . '-imagelinks');
	}


	/**
	 * Init the edit screen of the plugin post type item
	 *
	 * @since 1.0.0
	 */
	public function public_init() {
		add_shortcode( $this->plugin_name, array( $this , 'shortcode') );
	}
	
	/**
	 * Shortcode output for the plugin
	 *
	 * @since 1.0.0
	 */
	public function shortcode( $atts ) {
		extract(
			shortcode_atts(
				array(
					'id'     => 0,
					'slug'   => '',
					'url'    => NULL,
					'alt'    => NULL,
					'width'  => NULL,
					'height' => NULL,
					'class'  => NULL
				), $atts
			)
		);
		
		if ( !$id && !$slug ) {
			return __('Invalid imagelinks shortcode attributes', $this->plugin_name);
		}
		
		if ( !$id ) {
			$obj = get_page_by_path( $slug, OBJECT, $this->post_type );
			if ( $obj ) {
				$id = $obj->ID;
			} else {
				return __('Invalid imagelinks slug attribute', $this->plugin_name);
			}
		}

		// global was set during the rendering of the page
		global $imagelink_plugin_shortcode_used;
		$imagelink_plugin_shortcode_used = true;


		$upload_dir = wp_upload_dir();
		$baseurl = $upload_dir['baseurl'];

		$cfg = html_entity_decode(get_post_meta( $id, 'imgl-meta-imagelinks-cfg', true ), ENT_QUOTES);

		// make parameters
		$json = json_decode($cfg);
		$imageUrl    = ($json->imageUrl && $json->imageUrlLocal ? $baseurl . $json->imageUrl : $json->imageUrl);
		$imageSize   = $json->imageSize;
		$imageWidth  = $json->imageWidth;
		$imageHeight = $json->imageHeight;

		$imageWidthStyle  = ($width  != NULL ? 'width:'  . $width  . ';' : (($imageSize == 'fixed' && $imageWidth  > 0) ? 'width:'  . $imageWidth  . 'px;' : NULL));
		$imageHeightStyle = ($height != NULL ? 'height:' . $height . ';' : (($imageSize == 'fixed' && $imageHeight > 0) ? 'height:' . $imageHeight . 'px;' : NULL));


		// generate unique prefix for $id to avoid clashes with multiple same shortcode use
		$prefix  = strtolower(wp_generate_password( 5, false ));
		$id_data = 'imgl-data-' . $prefix . '-' . $id;
		$id      = 'imgl-' . $prefix . '-' . $id;

		// turn on buffering 
		ob_start();
		?>
<?php
	echo '<style>' . PHP_EOL;

	if(preg_match('/^imgl-theme-(.*)?/', $json->theme, $matches)) {
		$theme = $matches[1];
		echo '@import url("' . plugin_dir_url( dirname(__FILE__) ) . 'lib/imagelinks.theme.' . $theme . '.css?ver=' . $this->plugin_name . '");' . PHP_EOL;
	} else {
		$json->theme = 'imgl-theme-default';
		echo '@import url("' . plugin_dir_url( dirname(__FILE__) ) . 'lib/imagelinks.theme.default.css?ver=' . $this->plugin_name . '");' . PHP_EOL;
	}
	
	if($json->popoverShowClass || $json->popoverHideClass) {
		echo '@import url("' . plugin_dir_url( dirname(__FILE__) ) . 'lib/effect.css?ver=' . $this->plugin_name .  '");' . PHP_EOL;
	}

	echo '</style>' . PHP_EOL;
?>
<?php
	if($json->customCSS) { 
		echo '<style>' . PHP_EOL;
		echo $json->customCSSContent . PHP_EOL;
		echo '</style>' . PHP_EOL;
	}
?>

<?php // make section with our popover content ?>

<div id='<?php echo $id_data; ?>' style='display:none;'>
<?php $index = 0; ?>
<?php foreach($json->hotSpots as $hotspot) { ?>

<?php if( property_exists($hotspot, 'popoverContent') ) { ?>
<div id='<?php echo 'imgl-data-' . $prefix . '-popover-' . $index; ?>'>
<?php echo do_shortcode($hotspot->popoverContent); ?>
</div>
<?php } ?>

<?php $index = $index + 1; ?>
<?php } ?>
</div>

<?php echo ($class != NULL ? '<div class=\'' . $class . '\'/>' : ''); ?>
<?php if( $imageWidthStyle || $imageHeightStyle ) { ?>
	<img id='<?php echo $id; ?>' src='<?php echo $imageUrl; ?>' alt='<?php echo $alt; ?>' style='<?php echo $imageWidthStyle . $imageHeightStyle; ?>'>
<?php } else { ?>
	<img id='<?php echo $id; ?>' src='<?php echo $imageUrl; ?>' alt='<?php echo $alt; ?>'>
<?php } ?>
<?php echo ($class != NULL ? '</div>' : ''); ?>


<script type="text/javascript">
jQuery( document ).ready(function( jQuery ) {
	jQuery( '#<?php echo $id; ?>' ).imagelinks({
		theme: '<?php echo $json->theme; ?>',
		popover: <?php echo ($json->popover ? 'true' : 'false'); ?>,
<?php if( $json->popover ) { ?>
<?php if( property_exists($json, 'popoverTemplate') ) { ?>
		popoverTemplate: '<?php echo $json->popoverTemplate; ?>',
<?php } ?>
		popoverPlacement: '<?php echo $json->popoverPlacement; ?>',
		popoverShowTrigger: '<?php echo $json->popoverShowTrigger; ?>',
		popoverHideTrigger: '<?php echo $json->popoverHideTrigger; ?>',
<?php if( property_exists($json, 'popoverShowClass') ) { ?>
		popoverShowClass: '<?php echo $json->popoverShowClass; ?>',
<?php } ?>
<?php if( property_exists($json, 'popoverHideClass') ) { ?>
		popoverHideClass: '<?php echo $json->popoverHideClass; ?>',
<?php } ?>
<?php } ?>
		hotSpotBelowPopover: <?php echo ($json->hotSpotBelowPopover ? 'true' : 'false'); ?>,
		mobile: <?php echo ($json->mobile ? 'true' : 'false'); ?>,
<?php if( property_exists($json, 'hotSpots') ) { ?>
		hotSpots: [
<?php $index = 0; ?>
<?php foreach($json->hotSpots as $hotspot) { ?>
			{
				x: <?php echo $hotspot->x; ?>,
				y: <?php echo $hotspot->y; ?>,
<?php if( property_exists($hotspot, 'className') ) { ?>
				className: '<?php echo $hotspot->className; ?>',
<?php } ?>
<?php if( property_exists($hotspot, 'content') ) { ?>
<?php $content = $hotspot->content; ?>
<?php $content = addcslashes($content, "\'"); ?>
<?php $content = str_replace(array("\n", "\t", "\r"),'', $content); ?>
				content: '<?php echo $content; ?>',
<?php } ?>
				link: <?php echo ($hotspot->link ? "'" . $hotspot->link . "'" : 'null'); ?>,
				linkNewWindow: <?php echo ($hotspot->linkNewWindow ? 'true' : 'false'); ?>,
				imageUrl: '<?php echo ($hotspot->imageUrl ? $baseurl . $hotspot->imageUrl : ""); ?>',
				imageWidth: <?php echo ($hotspot->imageWidth ? $hotspot->imageWidth : 'null'); ?>,
				imageHeight: <?php echo ($hotspot->imageHeight ? $hotspot->imageHeight : 'null'); ?>,
				popover: <?php echo ($hotspot->popover ? 'true' : 'false'); ?>,
				popoverHtml: <?php echo ($hotspot->popoverHtml ? 'true' : 'false'); ?>,
				popoverLazyload: false,
				popoverShow: <?php echo ($hotspot->popoverShow ? 'true' : 'false'); ?>,
				popoverSelector: '<?php echo '#imgl-data-' . $prefix . '-popover-' . $index; ?>',
<?php if( property_exists($hotspot, 'popoverPlacement') ) { ?>
				popoverPlacement: '<?php echo $hotspot->popoverPlacement; ?>',
<?php } ?>
<?php if( property_exists($hotspot, 'popoverWidth') ) { ?>
				popoverWidth: <?php echo $hotspot->popoverWidth; ?>,
<?php } ?>
			},
<?php $index = $index + 1; ?>
<?php } ?>
		]
<?php } ?>
	});
	
	function setInfoLabel() {
		var $el = jQuery( '#<?php echo $id; ?>' ).closest('.imgl');
		if($el.length) {
			$el.find('.imgl-view').append('<a class="imgl-btn-info" href="https://wordpress.org/plugins/imagelinks-interactive-image-builder-lite/" target="_blank" rel="nofollow"></a>');
			return true;
		}
		return false;
	};
	
	var timerId = setInterval(function(){
		if(setInfoLabel()) {
			clearInterval( timerId );
		}
	}, 3000);
});
</script>
<?php
		// get the buffered content into a var
		$output = ob_get_contents();

		// clean buffer
		ob_end_clean();

		return $output;
	}
}
