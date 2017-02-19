<?php 
	global $woocommerce;

	$site_mode = vu_get_option('site-mode');
	$site_mode_page = vu_get_option('site-mode-page');

	if( $site_mode == 'under_construction' and get_the_ID() != $site_mode_page and !is_user_logged_in() ){
		wp_redirect( get_permalink( absint($site_mode_page) ) ); exit;
	}

?>
<!DOCTYPE html>
<!--[if IE 7 ]><html <?php language_attributes(); ?> class="isie ie7 oldie no-js"><![endif]-->
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="isie ie8 oldie no-js"><![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="isie ie9 no-js"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
	<title><?php wp_title(''); ?></title>
	
	<!-- meta -->
	<meta charset="<?php bloginfo("charset"); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo("rss2_url"); ?>" />
	<link rel="pingback" href="<?php bloginfo("pingback_url"); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php if( vu_get_option('preloader') ) : ?>
		<div id="vu_preloader"></div>
	<?php endif; ?>

	<div id="all"<?php echo ( vu_get_option('boxed-layout') ) ? ' class="boxed"' : ''; ?>>
		<?php if( !is_page_template('template-blank.php') ) : ?>
			<header id="vu_main-header" class="vu_main-header" role="banner" itemscope="itemscope" itemtype="https://schema.org/WPHeader">
				<?php if( vu_get_option('top-bar') ) : ?>
					<div class="vu_top-bar">
						<div class="container">
							<div class="row">
								<div class="vu_tp-left col-md-6">
									<?php echo do_shortcode( vu_get_option('top-bar-left') ); ?>
								</div>
								<div class="vu_tp-right col-md-6">
									<?php echo do_shortcode( vu_get_option('top-bar-right') ); ?>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
					
				<div class="container">
					<div id="vu_menu-affix"<?php echo (vu_get_option('fixed-header')) ? ' data-spy="affix" data-offset-top="'. absint(vu_get_option('fixed-header-offset')) .'"' : ''; ?>>
						<?php if( vu_get_option('header-type') == 'logo-middle' ) { ?>
							<div class="vu_main-menu-container" data-type="logo-middle">
								<div class="vu_d-tr">
									<nav class="vu_main-menu vu_mm-left vu_d-td" role="navigation" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
										<?php 
											// Main Menu Left
											wp_nav_menu(array(
												'theme_location'  => 'main-menu-left',
												'container'       => false,
												'container_id'    => false,
												'container_class' => false,
												'menu_id'         => 'vu_mm-left',
												'menu_class'      => 'vu_mm-list vu_mm-left list-unstyled',
												'items_wrap' => vu_main_menu_wrap(false)
											));
										?>
									</nav>

									<div class="vu_logo-container vu_d-td"> 
										<div class="vu_logo">
											<a href="<?php echo get_home_url(); ?>">
												<img class="vu_logo-primary" alt="logo-primary" width="<?php echo esc_attr(vu_get_option( array('logo', 'width') )); ?>" height="<?php echo esc_attr(vu_get_option( array('logo', 'height') )); ?>" src="<?php echo esc_url(vu_get_option( array('logo', 'url') )); ?>">
												<img class="vu_logo-secondary" alt="logo-secondary" width="<?php echo esc_attr(vu_get_option( array('logo-secondary', 'width') )); ?>" height="<?php echo esc_attr(vu_get_option( array('logo-secondary', 'height') )); ?>" src="<?php echo esc_url(vu_get_option( array('logo-secondary', 'url') )); ?>">
											</a>
										</div>
										<a href="#" class="vu_mm-toggle vu_mm-open"><i class="fa fa-bars"></i></a>

										<?php if( in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) and vu_get_option('shop-show-basket-icon', true) ) : ?>
											<div class="vu_wc-menu-item vu_wc-responsive">
												<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="vu_wc-cart-link"><span><i class="fa fa-shopping-cart"></i><span class="vu_wc-count"><?php echo $woocommerce->cart->get_cart_contents_count(); ?></span></span></a>
												
												<div class="vu_wc-menu-container">
													<div class="vu_wc-cart-notification"><span class="vu_wc-item-name"></span><?php echo __("was successfully added to your cart.", 'bakery'); ?></div>
													<div class="vu_wc-cart widget woocommerce widget_shopping_cart"><div class="widget_shopping_cart_content"></div></div>
												</div>
											</div>
										<?php endif; ?>
									</div>

									<nav class="vu_main-menu vu_mm-right vu_d-td" role="navigation" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
										<?php 
											// Main Menu Right
											wp_nav_menu(array(
												'theme_location'  => 'main-menu-right',
												'container'       => false,
												'container_id'    => false,
												'container_class' => false,
												'menu_id'         => 'vu_mm-right',
												'menu_class'      => 'vu_mm-list vu_mm-right list-unstyled',
												'items_wrap' => vu_main_menu_wrap()
											));
										?>
									</nav>
								</div>
							</div>
						<?php } else if ( vu_get_option('header-type') == 'logo-top' ) { ?>
							<div class="vu_main-menu-container" data-type="logo-top">
								<div class="vu_d-tr">
									<div class="vu_logo-container vu_d-td p-b-30"> 
										<div class="vu_logo">
											<a href="<?php echo get_home_url(); ?>">
												<img class="vu_logo-primary" alt="logo-primary" width="<?php echo esc_attr(vu_get_option( array('logo', 'width') )); ?>" height="<?php echo esc_attr(vu_get_option( array('logo', 'height') )); ?>" src="<?php echo esc_url(vu_get_option( array('logo', 'url') )); ?>">
												<img class="vu_logo-secondary" alt="logo-secondary" width="<?php echo esc_attr(vu_get_option( array('logo-secondary', 'width') )); ?>" height="<?php echo esc_attr(vu_get_option( array('logo-secondary', 'height') )); ?>" src="<?php echo esc_url(vu_get_option( array('logo-secondary', 'url') )); ?>">
											</a>
										</div>
										<a href="#" class="vu_mm-toggle vu_mm-open"><i class="fa fa-bars"></i></a>

										<?php if( in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) and vu_get_option('shop-show-basket-icon', true) ) : ?>
											<div class="vu_wc-menu-item vu_wc-responsive">
												<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="vu_wc-cart-link"><span><i class="fa fa-shopping-cart"></i><span class="vu_wc-count"><?php echo $woocommerce->cart->get_cart_contents_count(); ?></span></span></a>
												
												<div class="vu_wc-menu-container">
													<div class="vu_wc-cart-notification"><span class="vu_wc-item-name"></span><?php echo __("was successfully added to your cart.", 'bakery'); ?></div>
													<div class="vu_wc-cart widget woocommerce widget_shopping_cart"><div class="widget_shopping_cart_content"></div></div>
												</div>
											</div>
										<?php endif; ?>
									</div>
								</div>

								<div class="vu_d-tr text-center">
									<nav class="vu_main-menu vu_mm-full vu_d-td" role="navigation" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
										<?php 
											// Main Menu Right
											wp_nav_menu(array(
												'theme_location'  => 'main-menu-full',
												'container'       => false,
												'container_id'    => false,
												'container_class' => false,
												'menu_id'         => 'vu_mm-full',
												'menu_class'      => 'vu_mm-list vu_mm-full list-unstyled',
												'items_wrap' => vu_main_menu_wrap()
											));
										?>
									</nav>
								</div>
							</div>
						<?php } else if ( vu_get_option('header-type') == 'logo-left' ) { ?>
							<div class="vu_main-menu-container" data-type="logo-left">
								<div class="vu_d-tr">
									<div class="vu_logo-container vu_d-td p-l-0"> 
										<div class="vu_logo">
											<a href="<?php echo get_home_url(); ?>">
												<img class="vu_logo-primary" alt="logo-primary" width="<?php echo esc_attr(vu_get_option( array('logo', 'width') )); ?>" height="<?php echo esc_attr(vu_get_option( array('logo', 'height') )); ?>" src="<?php echo esc_url(vu_get_option( array('logo', 'url') )); ?>">
												<img class="vu_logo-secondary" alt="logo-secondary" width="<?php echo esc_attr(vu_get_option( array('logo-secondary', 'width') )); ?>" height="<?php echo esc_attr(vu_get_option( array('logo-secondary', 'height') )); ?>" src="<?php echo esc_url(vu_get_option( array('logo-secondary', 'url') )); ?>">
											</a>
										</div>
										<a href="#" class="vu_mm-toggle vu_mm-open"><i class="fa fa-bars"></i></a>

										<?php if( in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) and vu_get_option('shop-show-basket-icon', true) ) : ?>
											<div class="vu_wc-menu-item vu_wc-responsive">
												<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="vu_wc-cart-link"><span><i class="fa fa-shopping-cart"></i><span class="vu_wc-count"><?php echo $woocommerce->cart->get_cart_contents_count(); ?></span></span></a>
												
												<div class="vu_wc-menu-container">
													<div class="vu_wc-cart-notification"><span class="vu_wc-item-name"></span><?php echo __("was successfully added to your cart.", 'bakery'); ?></div>
													<div class="vu_wc-cart widget woocommerce widget_shopping_cart"><div class="widget_shopping_cart_content"></div></div>
												</div>
											</div>
										<?php endif; ?>
									</div>

									<nav class="vu_main-menu vu_mm-full vu_d-td text-right" role="navigation" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
										<?php 
											// Main Menu Right
											wp_nav_menu(array(
												'theme_location'  => 'main-menu-full',
												'container'       => false,
												'container_id'    => false,
												'container_class' => false,
												'menu_id'         => 'vu_mm-full',
												'menu_class'      => 'vu_mm-list vu_mm-full list-unstyled',
												'items_wrap' => vu_main_menu_wrap()
											));
										?>
									</nav>
								</div>
							</div>
						<?php } else { ?>
							<div class="vu_main-menu-container" data-type="logo-right">
								<div class="vu_d-tr">
									<nav class="vu_main-menu vu_mm-full vu_d-td text-left" role="navigation" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
										<?php 
											// Main Menu Right
											wp_nav_menu(array(
												'theme_location'  => 'main-menu-full',
												'container'       => false,
												'container_id'    => false,
												'container_class' => false,
												'menu_id'         => 'vu_mm-full',
												'menu_class'      => 'vu_mm-list vu_mm-full list-unstyled',
												'items_wrap' => vu_main_menu_wrap()
											));
										?>
									</nav>

									<div class="vu_logo-container vu_d-td p-r-0"> 
										<div class="vu_logo">
											<a href="<?php echo get_home_url(); ?>">
												<img class="vu_logo-primary" alt="logo-primary" width="<?php echo esc_attr(vu_get_option( array('logo', 'width') )); ?>" height="<?php echo esc_attr(vu_get_option( array('logo', 'height') )); ?>" src="<?php echo esc_url(vu_get_option( array('logo', 'url') )); ?>">
												<img class="vu_logo-secondary" alt="logo-secondary" width="<?php echo esc_attr(vu_get_option( array('logo-secondary', 'width') )); ?>" height="<?php echo esc_attr(vu_get_option( array('logo-secondary', 'height') )); ?>" src="<?php echo esc_url(vu_get_option( array('logo-secondary', 'url') )); ?>">
											</a>
										</div>
										<a href="#" class="vu_mm-toggle vu_mm-open"><i class="fa fa-bars"></i></a>

										<?php if( in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) and vu_get_option('shop-show-basket-icon', true) ) : ?>
											<div class="vu_wc-menu-item vu_wc-responsive">
												<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="vu_wc-cart-link"><span><i class="fa fa-shopping-cart"></i><span class="vu_wc-count"><?php echo $woocommerce->cart->get_cart_contents_count(); ?></span></span></a>
												
												<div class="vu_wc-menu-container">
													<div class="vu_wc-cart-notification"><span class="vu_wc-item-name"></span><?php echo __("was successfully added to your cart.", 'bakery'); ?></div>
													<div class="vu_wc-cart widget woocommerce widget_shopping_cart"><div class="widget_shopping_cart_content"></div></div>
												</div>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>

					<div class="vu_menu-affix-height"></div>
				</div>
			</header>

			<div class="clearfix"></div>

		<?php 
			$header_title = $header_subtitle = $header_bg = null;

			if( is_home() or is_page() or is_single() and get_post_type() != 'product' ){
				$post_id = (get_post_type() == 'post') ? get_option( 'page_for_posts' ) : $post->ID;
		
				$header_bg = vu_get_page_header_bg( $post_id, $header_title, $header_subtitle );
			} else if( is_tax() ){
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

				$header_title = $term->name;

				// WooCommerce
				if( $term->taxonomy == 'product_cat' ){
					$header_subtitle = sprintf(__("All products from '%s' category", 'bakery'), $term->name);

					if( vu_get_option('wc-cat-header-bg') == 'cat-thumbnail' and function_exists('get_woocommerce_term_meta') ) {
						$header_bg = vu_get_attachment_image_src( absint( get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ) ), 'full' );
					} else {
						$header_bg = vu_get_page_header_bg( get_option( 'woocommerce_shop_page_id' ) );
					}
				} else if( $term->taxonomy == 'product_tag' ){
					$header_subtitle = sprintf(__("All products tagged with '%s'", 'bakery'), $term->name);
					$header_bg = vu_get_page_header_bg( get_option( 'woocommerce_shop_page_id' ) );
				}

				// Portfolio
				if( $term->taxonomy == 'portfolio-category' ){
					$header_subtitle = sprintf(__("All portfolio items from '%s' category", 'bakery'), $term->name);
				} else if( $term->taxonomy == 'portfolio-tag' ){
					$header_subtitle = sprintf(__("All portfolio items tagged with '%s'", 'bakery'), $term->name);
				}

				if( $term->taxonomy == 'portfolio-category' or $term->taxonomy == 'portfolio-tag' ){
					$header_bg = vu_get_option( array('portfolio-header-bg', 'url') );
				}
			} else if( is_tag() ){
				$header_title = single_tag_title('', false);
				$header_subtitle = sprintf(__("All posts tagged with '%s'", 'bakery'), single_tag_title('', false));
				$header_bg = vu_get_page_header_bg( get_option( 'page_for_posts' ) );
			} else if( is_category() ){
				$header_title = single_cat_title('', false);
				$header_subtitle = sprintf(__("All posts from '%s' category", 'bakery'), single_cat_title('', false));
				$header_bg = vu_get_page_header_bg( get_option( 'page_for_posts' ) );
			} else if( is_author() ){
				$current_author = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));

				$header_title = $current_author->nickname;
				$header_subtitle = sprintf(__("Posts by '%s'", 'bakery'), $current_author->nickname);
				$header_bg = vu_get_page_header_bg( get_option( 'page_for_posts' ) );
			} else if( is_archive() ){
				if( is_day() ){
					$header_title = get_the_date();
				} else if( is_month() ){
					$header_title = get_the_date('F Y');
				} else {
					$header_title = get_the_date('Y');
				}

				$header_subtitle = sprintf(__("Archives from '%s'", 'bakery'), $header_title);
				$header_bg = vu_get_page_header_bg( get_option( 'page_for_posts' ) );

				if( function_exists('is_shop') and is_shop() ) {
					$header_bg = vu_get_page_header_bg( get_option( 'woocommerce_shop_page_id' ), $header_title, $header_subtitle );
				}
			} else if( is_search() ){
				$header_title = __('Search', 'bakery');
				$header_subtitle = sprintf(__("Search results for: '%s'", 'bakery'), get_search_query());

				if( get_query_var('post_type') == 'product' ){
					$header_bg = vu_get_option( array('product-header-bg', 'url') );
				} else {
					$header_bg = vu_get_page_header_bg( get_option( 'page_for_posts' ) );
				}
			} else if( is_404() ) {
				$header_title = __('Page not found', 'bakery');
				$header_subtitle = __('Oppss something went wrong', 'bakery');
				$header_bg = vu_get_page_header_bg( get_option( 'page_for_posts' ) );
			} else if( function_exists('is_cart') and is_cart() ) {
				$header_bg = vu_get_page_header_bg( get_option( 'woocommerce_cart_page_id' ), $header_title, $header_subtitle );
			} else if( function_exists('is_product') and is_product() ){
				$header_bg = vu_get_page_header_bg( get_option( 'woocommerce_shop_page_id' ), $header_title, $header_subtitle );
			} else {
				$header_title = $header_subtitle = $header_bg = null;
			}

			if( !empty($header_title) or !empty($header_subtitle) or !empty($header_bg) ){
				vu_header_section($header_title, $header_subtitle, $header_bg);
			} else {
				if( is_page() ) {
					$vu_page_header_settings = vu_get_post_meta( get_the_ID(), 'vu_page_header_settings' );
					
					if( isset($vu_page_header_settings['style']) and $vu_page_header_settings['style'] == 'default' ) {
						echo '<h1 class="vu_page-title text-center m-b-35">'. get_the_title() .'</h1>';
					}
				} else {
					if( is_single() and get_post_type() != 'portfolio-item' ) {
						echo '<h1 class="vu_page-title text-center m-b-35">'. get_the_title() .'</h1>';
					}
				}
			}
		?>
		<?php endif; ?>