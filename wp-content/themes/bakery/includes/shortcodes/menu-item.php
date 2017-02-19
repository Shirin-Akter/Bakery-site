<?php 
	/**
	 * Title Shortcode
	 *
	 * @param string $atts['image']
	 * @param string $atts['title']
	 * @param string $atts['description']
	 * @param string $atts['style']
	 * @param string $atts['ribbon']
	 * @param string $atts['price']
	 * @param string $atts['link']
	 * @param string $atts['class'] Add a class name and then refer to it in your css file.
	 */

	function vu_menu_item_shortcode( $atts, $content = null ) {
		$atts = shortcode_atts( array(
			'image' => '',
			'title' => '',
			'description' => '',
			'style' => '',
			'ribbon' => '',
			'image_display' => '',
			'price' => '',
			'link' => '',
			'class' => ''
		), $atts );

		$url = vc_build_link( $atts['link'] );

		$images = @explode(",", $atts['image']);

		ob_start();

		if( $atts['style'] === 'grid' ) :
			if( $atts['image_display'] == 'square' ){
				$image_display = 'ratio-1:1';
			} else if( $atts['image_display'] == 'landscape' ) {
				$image_display = 'ratio-4:3';
			} else {
				$image_display = 'ratio-3:4';
			}
	?>
			<article class="vu_product-item clearfix<?php echo vu_animation(true); ?><?php vu_extra_class($atts['class']); ?>">
				<div class="vu_pi-image">
					<?php if( !empty($atts['ribbon']) ) : ?>
						<div class="vu_pi-label-container"><div class="vu_pi-label"><?php echo esc_attr($atts['ribbon']) ?></div><div class="vu_pi-label-bottom"></div></div>
					<?php endif; ?>

					<?php 
						if( is_array($images) and isset($images[0]) and !empty($images[0]) ) {
							echo wp_get_attachment_image(absint($images[0]), $image_display);
						} else {
							echo '<div class="embed-responsive embed-responsive-'. esc_attr(str_replace('ratio-', '', str_replace(':', 'by', $image_display))) .'"></div>';
						}
					 ?>
				</div>

				<div class="vu_pi-container">
					<div class="vu_pi-icons vu_lightbox vu_gallery" data-delegate="a.vu_pi-lb-img">
						<?php if( !empty($images) ) : ?>
							<?php $num = 1; ?>
							<?php foreach ($images as $image) { ?>
								<?php if( $num <= 1 ) { ?>
									<a href="<?php echo !empty($image) ? vu_get_attachment_image_src( absint($image), 'full' ) : '#'; ?>" class="vu_pi-icon vu_pi-lb-img" title="<?php echo esc_attr($atts['title']); ?>"><i class="fa fa-expand"></i></a>
								<?php } else { ?>
									<a href="<?php echo vu_get_attachment_image_src( absint($image), 'full' ); ?>" title="<?php echo esc_attr($atts['title']); ?>" class="vu_pi-lb-img hide"></a>
								<?php } ?>
								<?php $num++; ?>
							<?php } ?>
						<?php endif; ?>

						<?php if ( strlen( $atts['link'] ) > 0 && strlen( $url['url'] ) > 0 ) {
							echo '<a href="'. esc_url( $url['url'] ) .'" class="vu_pi-icon" title="'. esc_attr( $url['title'] ) .'" target="'. ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '"><i class="fa fa-link"></i></a>';
						} ?>
					</div>

					<div class="vu_pi-content">
						<h3 class="vu_pi-name">
							<?php if ( strlen( $atts['link'] ) > 0 && strlen( $url['url'] ) > 0 ) {
								echo '<a href="'. esc_url( $url['url'] ) .'" title="'. esc_attr( $url['title'] ) .'" target="'. ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">'. $atts['title'] .'</a>';
							} else { 
								echo $atts['title'];
							} ?>
						</h3>

						<div class="vu_pi-category fs-13 p-r-15 p-l-15">
							<?php echo esc_html($atts['description']); ?>
						</div>

						<?php if( !empty($atts['price']) ) : ?>
							<div class="vu_pi-price"><span class="amount"><?php echo esc_attr($atts['price']); ?></span></div>
						<?php endif; ?>
					</div>
				</div>
			</article>
	<?php else : ?>
			<article class="vu_menu-item clearfix<?php echo vu_animation(true); ?><?php vu_extra_class($atts['class']); ?>">
				<?php if( !empty($images) ) : ?>
					<div class="vu_menu-item-img-container vu_lightbox vu_gallery" data-delegate="a.vu_pi-lb-img">
						<?php $num = 1; ?>
						<?php foreach ($images as $image) { ?>
							<?php if( $num <= 1 ) { ?>
								<a href="<?php echo vu_get_attachment_image_src( absint($image), 'full' ); ?>" title="<?php echo esc_attr($atts['title']); ?>" class="vu_pi-lb-img">
									<?php echo '<span class="vu_menu-item-img"><img src="'. vu_get_attachment_image_src( absint($image) ) .'" alt=""></span>'; ?>
								</a>
							<?php } else { ?>
								<a href="<?php echo vu_get_attachment_image_src( absint($image), 'full' ); ?>" title="<?php echo esc_attr($atts['title']); ?>" class="vu_pi-lb-img hide"></a>
							<?php } ?>
							<?php $num++; ?>
						<?php } ?>
					</div>
				<?php endif; ?>

				<div class="vu_menu-item-detail-container">
					<div class="vu_menu-item-detail">
						<h2 class="vu_menu-item-title">
							<?php 
								if ( strlen( $atts['link'] ) > 0 && strlen( $url['url'] ) > 0 ) {
									echo '<a href="'. esc_url( $url['url'] ) .'" title="'. esc_attr( $url['title'] ) .'" target="'. ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">'. $atts['title'] .'</a>';
								} else { 
									echo $atts['title'];
								}
							?>
						</h2>

						<?php if( !empty($atts['description']) ) : ?>
							<p class="vu_menu-item-description"><?php echo str_replace( array('``', '`'), array('"', "'"), wp_kses($atts['description'], array('br' => array())) ); ?></p>
						<?php endif; ?>
						
						<?php if( !empty($atts['price']) ) : ?>
							<h5 class="vu_menu-item-price"><?php echo esc_attr($atts['price']); ?></h5>
						<?php endif; ?>
					</div>
				</div><!-- .vu_menu-item-detail-container -->
			</article><!-- .vu_menu-item -->
	<?php 
		endif;
		$output = ob_get_contents();
		ob_end_clean();
		
		return $output;
	}

	add_shortcode('vu_menu_item', 'vu_menu_item_shortcode');

	/**
	 * Title VC Shortcode
	 */

	if( class_exists('WPBakeryShortCode') ) {
		class WPBakeryShortCode_vu_menu_item extends WPBakeryShortCode {
			public function content($atts, $content = null) {
				$atts = vc_map_get_attributes("vu_menu_item", $atts);

				return do_shortcode( vu_generate_shortcode('vu_menu_item', $atts, $content) );
			}
		}

		vc_map(
			array(
				"name"		=> __("Menu Item", 'bakery'),
				"description" => __('Add a single menu item', 'bakery'),
				"base"		=> "vu_menu_item",
				"class"		=> "vc_vu_menu_item",
				"icon"		=> "vu_element-icon vu_menu-item-icon",
				"controls"	=> "full",
				"category"  => __('Bakery', 'bakery'),
				"params"	=> array(
					array(
						"type" => "attach_images",
						"heading" => __("Image(s)", 'bakery'),
						"param_name" => "image",
						"value" => "",
						"save_always" => true,
						"description" => __("Select image(s) from media library.", 'bakery')
					),
					array(
						"type" => "textfield",
						"heading" => __("Title", 'bakery'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => "",
						"save_always" => true,
						"description" => __("Enter title of menu item.", 'bakery')
					),
					array(
						"type" => "textarea",
						"heading" => __("Description", 'bakery'),
						"param_name" => "description",
						"value" => "",
						"save_always" => true,
						"description" => __("Enter description of menu item.", 'bakery')
					),
					array(
						"type" => "dropdown",
						"heading" => __("Style", 'bakery'),
						"param_name" => "style",
						"value" => array(
							__('Grid', 'bakery') => 'grid',
							__('List', 'bakery') => 'list',
						),
						"save_always" => true,
						"description" => __("Select menu style.", 'bakery')
					),
					array(
						"type" => "textfield",
						"heading" => __("Ribbon", 'bakery'),
						"param_name" => "ribbon",
						"dependency" => array("element" => "style", "value" => "grid"),
						"value" => "",
						"save_always" => true,
						"description" => __("Enter ribbon text of menu item. Leave blank if no ribbon is needed.", 'bakery')
					),
					array(
						"type" => "dropdown",
						"heading" => __("Image Display", 'bakery'),
						"param_name" => "image_display",
						"dependency" => array("element" => "style", "value" => "grid"),
						"value" => array(
							__("Portrait", 'bakery') => 'portrait',
							__("Landscape", 'bakery') => 'landscape',
							__("Square", 'bakery') => 'square'
						),
						"std" => 'portrait',
						"save_always" => true,
						"description" => __("Select product view.", 'bakery'),
					),
					array(
						"type" => "textfield",
						"heading" => __("Price", 'bakery'),
						"param_name" => "price",
						"value" => "",
						"description" => __("Enter item price along with the desired currency.", 'bakery')
					),
					array(
						"type" => "vc_link",
						"heading" => __("URL (Link)", 'bakery'),
						"param_name" => "link",
						"value" => "",
						"save_always" => true,
						"description" => __("Add link to product.", 'bakery')
					),
					array(
						"type" => "textfield",
						"heading" => __("Extra class name", 'bakery'),
						"param_name" => "class",
						"value" => "",
						"save_always" => true,
						"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'bakery')
					)
				)
			)
		);
	}
?>