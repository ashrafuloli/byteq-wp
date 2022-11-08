<?php

/**
 * favicon logo
 */
function byteq_favicon() {
	$byteq_favicon     = get_template_directory_uri() . '/assets/img/logo/favicon.png';
	$byteq_favicon_url = get_theme_mod( 'favicon_url', $byteq_favicon );
	?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php print esc_url( $byteq_favicon_url ); ?>">
	<?php
}

add_action( 'wp_head', 'byteq_favicon' );

/**
 * header logo
 */
function byteq_header_logo() {
	?>
	<?php
	$byteq_logo_on    = function_exists( 'get_field' ) ? get_field( 'is_enable_sec_logo' ) : null;
	$byteq_logo       = get_template_directory_uri() . '/assets/img/logo/logo.png';
	$byteq_logo_white = get_template_directory_uri() . '/assets/img/logo/logo.png';

	$byteq_customizer_logo = get_theme_mod( 'logo', $byteq_logo );
	$byteq_secondary_logo  = get_theme_mod( 'secondary_logo', $byteq_logo_white );

	$byteq_page_logo = function_exists( 'get_field' ) ? get_field( 'byteq_page_logo' ) : '';
	$byteq_site_logo = ! empty( $byteq_page_logo['url'] ) ? $byteq_page_logo['url'] : $byteq_customizer_logo;
	?>

	<?php
	if ( has_custom_logo() ) {
		the_custom_logo();
	} else {

		if ( ! empty( $byteq_logo_on ) ) { ?>
            <a class="standard-logo-white" href="<?php print esc_url( home_url( '/' ) ); ?>">
                <img src="<?php print esc_url( $byteq_secondary_logo ); ?>"
                     alt="<?php print esc_attr( 'logo', 'byteq' ); ?>"/>
            </a>
			<?php
		} else { ?>
            <a class="standard-logo" href="<?php print esc_url( home_url( '/' ) ); ?>">
                <img src="<?php print esc_url( $byteq_site_logo ); ?>"
                     alt="<?php print esc_attr( 'logo', 'byteq' ); ?>"/>
            </a>
			<?php
		}
	}
	?>
	<?php
}

/**
 * pagination
 */
if ( ! function_exists( 'byteq_pagination' ) ) {

	function _byteq_pagi_callback( $pagination ) {
		return $pagination;
	}

	//page navigation
	function byteq_pagination( $prev, $next, $pages, $args ) {
		global $wp_query, $wp_rewrite;
		$menu = '';
		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

		if ( $pages == '' ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;

			if ( ! $pages ) {
				$pages = 1;
			}
		}

		$pagination = array(
			'base'      => add_query_arg( 'paged', '%#%' ),
			'format'    => '',
			'total'     => $pages,
			'current'   => $current,
			'prev_text' => $prev,
			'next_text' => $next,
			'type'      => 'array'
		);

		//rewrite permalinks
		if ( $wp_rewrite->using_permalinks() ) {
			$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
		}

		if ( ! empty( $wp_query->query_vars['s'] ) ) {
			$pagination['add_args'] = array( 's' => get_query_var( 's' ) );
		}

		$pagi = '';
		if ( paginate_links( $pagination ) != '' ) {
			$paginations = paginate_links( $pagination );
			$pagi        .= '<ul>';
			foreach ( $paginations as $key => $pg ) {
				$pagi .= '<li>' . $pg . '</li>';
			}
			$pagi .= '</ul>';
		}

		print _byteq_pagi_callback( $pagi );
	}
}


function byteq_check_header() {
	byteq_header_style();
}

add_action( 'byteq_header_style', 'byteq_check_header', 10 );

/**
 * header style
 */

function byteq_header_style() {
	$byteq_header_button      = get_theme_mod( 'byteq_header_button', true );
	$byteq_header_button_text = get_theme_mod( 'byteq_header_button_text', 'Start Free Trial' );
	$byteq_header_button_link = get_theme_mod( 'byteq_header_button_link', '#' );
	?>
    <header class="header-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-9 col-lg-6 col-md-4 col-8 d-flex align-items-center">
                    <div class="logo">
						<?php byteq_header_logo(); ?>
                    </div>
					<?php byteq_header_menu(); ?>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-8 col-4 d-flex align-items-center justify-content-end">
                    <div class="search-btn">
                        <a href="#">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                      stroke="#061532" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20.9984 21.0004L16.6484 16.6504" stroke="#061532" stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
					<?php if ( ! empty( $byteq_header_button ) ): ?>
                        <div class="header-btn d-md-inline-block d-none">
                            <a href="<?php echo esc_url( $byteq_header_button_link ); ?>">
                            <span class="icon">
                                <i class="fa-solid fa-arrow-right"></i>
                            </span>
								<?php echo $byteq_header_button_text; ?>
                            </a>
                        </div>
					<?php endif; ?>
                    <div class="menu-bar d-inline-block d-xl-none">
                        <a href="#">
                            <i class="fa-regular fa-bars"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="mobile-menu-wrapper">
        <div class="menu-overlay"></div>
        <div class="agenia-mobile-menu">
            <div class="menu-close">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <div class="mobile-menu"></div>
        </div>
    </div>

    <div class="search_wrapper">
        <div class="search-close"><i class="fa-regular fa-xmark"></i></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="search-from-wrap">
                        <form action="/" method="get" autocomplete="off">
                            <input type="text" name="s" placeholder="Search Code..." id="keyword" class="input_search" onkeyup="fetch()">
                            <button><i class="fa-regular fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                    <div class="search_result" id="datafetch">
                        <ul>
                            <li>Please wait..</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<?php
}


/**
 * byteq_header_menu description
 */
function byteq_header_menu() {
	$byteq_menu = wp_nav_menu( array(
		'theme_location'  => 'main-menu',
		'menu_class'      => '',
		'container'       => 'div',
		'container_class' => 'main-menu d-none d-xl-block',
		'fallback_cb'     => 'Navwalker_Class::fallback',
		'walker'          => new Navwalker_Class,
		'depth'           => 2,
		'echo'            => false
	) );

//	$byteq_menu = str_replace("menu-item-has-children", "menu-item-has-children", $byteq_menu);

	echo wp_kses_post( $byteq_menu );
}

/**
 * byteq_mobile_menu description
 */
function byteq_mobile_menu() {
	$byteq_menu = wp_nav_menu( array(
		'theme_location'  => 'main-menu',
		'menu_id'         => 'mobile-menu-active',
		'container'       => 'nav',
		'container_class' => 'side-mobile-menu',
		'fallback_cb'     => 'Navwalker_Class::fallback',
		'walker'          => new Navwalker_Class,
		'depth'           => 2,
		'echo'            => false
	) );

//	$byteq_menu = str_replace("menu-item-has-children", "menu-item-has-children", $byteq_menu);

	echo wp_kses_post( $byteq_menu );
}


/**
 * byteq_breadcrumb_callback
 * @return string
 */
function byteq_breadcrumb_callback() {
	$args       = array(
		'show_browse'   => false,
		'post_taxonomy' => array( 'product' => 'product_cat' )
	);
	$breadcrumb = new Breadcrumb_Class( $args );

	return $breadcrumb->trail();
}


/**
 * byteq_breadcrumb_func
 */
function byteq_breadcrumb_func() {

	$breadcrumb_class = '';
	$breadcrumb_show  = 1;

	if ( is_front_page() && is_home() ) {
		$title            = get_theme_mod( 'breadcrumb_blog_title', esc_html__( 'Blog', 'byteq' ) );
		$breadcrumb_class = 'home_front_page';

	} elseif ( is_front_page() ) {
		$title = get_theme_mod( 'breadcrumb_blog_title', esc_html__( 'Blog', 'byteq' ) );
//		$breadcrumb_show = 0;
	} elseif ( is_home() ) {
		if ( get_option( 'page_for_posts' ) ) {
			$title = get_the_title( get_option( 'page_for_posts' ) );
		}
	} elseif ( is_single() && 'post' == get_post_type() ) {
		$title = get_the_title();
	} elseif ( is_single() && 'product' == get_post_type() ) {
		$title = get_theme_mod( 'breadcrumb_product_details', esc_html__( 'Shop', 'byteq' ) );
	} elseif ( is_single() && 'byteq-department' == get_post_type() ) {
		if ( rtl_enable() ) {
			$title = get_theme_mod( 'breadcrumb_department_details_rtl', esc_html__( 'Department', 'byteq' ) );
		} else {
			$title = get_theme_mod( 'breadcrumb_department_details', esc_html__( 'Department', 'byteq' ) );
		}

	} elseif ( is_single() && 'byteq-doctor' == get_post_type() ) {
		if ( rtl_enable() ) {
			$title = get_theme_mod( 'breadcrumb_doctor_details_rtl', esc_html__( 'Doctor', 'byteq' ) );
		} else {
			$title = get_theme_mod( 'breadcrumb_doctor_details', esc_html__( 'Doctor', 'byteq' ) );
		}

	} elseif ( is_single() && 'byteq-case_study' == get_post_type() ) {
		if ( rtl_enable() ) {
			$title = get_theme_mod( 'breadcrumb_case_study_details_rtl', esc_html__( 'Gallery', 'byteq' ) );
		} else {
			$title = get_theme_mod( 'breadcrumb_case_study_details', esc_html__( 'Gallery', 'byteq' ) );
		}

	} elseif ( is_search() ) {
		$title = esc_html__( 'Search Results for : ', 'byteq' ) . get_search_query();
	} elseif ( is_404() ) {
		$title = esc_html__( 'Page not Found', 'byteq' );
	} elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
		$title = get_theme_mod( 'breadcrumb_shop', esc_html__( 'Shop', 'byteq' ) );
	} elseif ( is_archive() ) {
		$title = get_the_archive_title();
	} else {
		$title = get_the_title();
	}

//	$is_breadcrumb  = function_exists( 'get_field' ) ? get_field( 'is_it_invisible_breadcrumb' ) : '';
	$is_breadcrumb = get_post_meta( get_the_ID(), '_breadcrumb_option', true );

	if ( $is_breadcrumb != 'yes' ) {
		$bg_img_from_page = function_exists( 'get_field' ) ? get_field( 'breadcrumb_background_image' ) : '';
		$hide_bg_img      = function_exists( 'get_field' ) ? get_field( 'hide_breadcrumb_background_image' ) : '';
		$back_title       = function_exists( 'get_field' ) ? get_field( 'breadcrumb_back_title' ) : '';

		// get_theme_mod
		$bg_img = get_theme_mod( 'breadcrumb_bg_img' );


		if ( $hide_bg_img ) {
			$bg_img = '';
		} else {
			$bg_img = ! empty( $bg_img_from_page ) ? $bg_img_from_page['url'] : $bg_img;
		}
		if ( ! empty( $bg_img ) ) {
			$breadcrumb_class .= ' page-title-overlay';
		}
		?>

        <div class="page-title-area breadcrumb-bg breadcrumb-spacings <?php print esc_attr( $breadcrumb_class ); ?>"
             data-background="<?php print esc_attr( $bg_img ); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="page-title-content">
                            <h3 class="title" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
								<?php echo wp_kses_post( $title ); ?>
                            </h3>
                            <div class="breadcrumb-menu">
								<?php // byteq_breadcrumb_callback(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shape">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/shape-4.png" alt="shape">
            </div>
        </div>
		<?php
	}
}

//add_action( 'byteq_before_main_content', 'byteq_breadcrumb_func' );


/**
 * byteq_check_footer
 */
function byteq_check_footer() {
//	$footer_option = get_post_meta( get_the_ID(), '_footer_option', true );
	byteq_footer_style();
//	if ( $footer_option == 'footer_2' ) {
//		byteq_footer_style_2();
//	} else {
//		byteq_footer_style();
//	}

}

add_action( 'byteq_footer_style', 'byteq_check_footer', 10 );

/**
 * footer  style 1
 */
function byteq_footer_style() {
	$byteq_privacy_policy_text    = get_theme_mod( 'byteq_privacy_policy_text', 'Privacy Policy' );
	$byteq_privacy_policy_url     = get_theme_mod( 'byteq_privacy_policy_url', '#' );
	$byteq_cookies_text           = get_theme_mod( 'byteq_cookies_text', 'Cookies' );
	$byteq_cookies_url            = get_theme_mod( 'byteq_cookies_url', '#' );
	$byteq_subscription_text      = get_theme_mod( 'byteq_subscription_text', 'Receive free resources and webinar invitation on byteq management.' );
	$byteq_subscription_shortcode = get_theme_mod( 'byteq_subscription_shortcode', '' );
	?>
    <div class="footer-area">
        <div class="footer-top pt-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="footer-subscribe-wrapper">
                            <div class="footer-logo">
								<?php byteq_footer_logo(); ?>
                            </div>
                            <div class="footer-subscribe">
								<?php if ( ! empty( $byteq_subscription_text ) ): ?>
                                    <div class="text">
                                        <p>
											<?php echo $byteq_subscription_text; ?>
                                        </p>
                                    </div>
								<?php endif; ?>

								<?php if ( ! empty( $byteq_subscription_shortcode ) ): ?>
									<?php echo do_shortcode( $byteq_subscription_shortcode ) ?>
								<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-middle pt-60 pb-30">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-6 footer-col-1">
						<?php
						if ( is_active_sidebar( 'footer-1' ) ) {
							dynamic_sidebar( 'footer-1' );
						}
						?>
                    </div>
                    <div class="col-xl-3 col-md-6 footer-col-2">
						<?php
						if ( is_active_sidebar( 'footer-2' ) ) {
							dynamic_sidebar( 'footer-2' );
						}
						?>
                    </div>
                    <div class="col-xl-3 col-md-6 footer-col-3">
						<?php
						if ( is_active_sidebar( 'footer-3' ) ) {
							dynamic_sidebar( 'footer-3' );
						}
						?>
                    </div>
                    <div class="col-xl-3 col-md-6 footer-col-4">
						<?php
						if ( is_active_sidebar( 'footer-4' ) ) {
							dynamic_sidebar( 'footer-4' );
						}
						?>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-4 col-lg-4">
						<?php footer_social(); ?>
                    </div>
                    <div class="col-xl-8 col-lg-8">
                        <div class="footer-text">
							<?php if ( ! empty( $byteq_privacy_policy_text ) ): ?>
                                <a href="<?php echo esc_url( $byteq_privacy_policy_url ); ?>">
									<?php echo $byteq_privacy_policy_text; ?>
                                </a>
                                <span class="text-separator">|</span>
							<?php endif; ?>
							<?php if ( ! empty( $byteq_cookies_text ) ): ?>
                                <a href="<?php echo esc_url( $byteq_cookies_url ); ?>">
									<?php echo $byteq_cookies_text; ?>
                                </a>
                                <span class="text-separator">|</span>
							<?php endif; ?>
                            <p><?php byteq_copyright_text(); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php
}

/**
 * footer  style 1
 */
function byteq_footer_style_2() {
	$byteq_footer_menu_text    = get_theme_mod( 'byteq_footer_menu_text', 'Navigation' );
	$byteq_footer_menu         = get_theme_mod( 'byteq_footer_menu', true );
	$byteq_footer_info_title   = get_theme_mod( 'byteq_footer_info_title', 'Get In Touch' );
	$info_array                       = [
		[ 'info_text' => '<span>T:</span> +1 510.859.8084</a>', 'info_link' => '#' ],
		[ 'info_text' => '<span>E:</span> support@byteq.com</a>', 'info_link' => '#' ],
	];
	$byteq_footer_contact_info = get_theme_mod( 'byteq_footer_contact_info', $info_array );
	$byteq_footer_social_title = get_theme_mod( 'byteq_footer_social_title', 'follow us' );
	$byteq_footer_social       = get_theme_mod( 'byteq_footer_social', true );
	$byteq_footer_info_list    = get_theme_mod( 'byteq_footer_info_list', true );
	?>
    <footer class="footer-area">
        <div class="widget-wrapper pt-90 pb-180 pb-md-50 pb-xs-50">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="footer-logo mb-50" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
							<?php byteq_footer_logo(); ?>
                        </div>
                    </div>
					<?php if ( ! empty( $byteq_footer_menu ) ): ?>
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="widget-wrap mb-50" data-aos="fade-up" data-aos-delay="400"
                                 data-aos-duration="1000">
                                <h4 class="title"><?php echo $byteq_footer_menu_text; ?></h4>
								<?php byteq_footer_menu(); ?>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( ! empty( $byteq_footer_info_list ) ): ?>
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="widget-wrap mb-50" data-aos="fade-up" data-aos-delay="700"
                                 data-aos-duration="1000">
                                <h4 class="title"><?php echo $byteq_footer_info_title; ?></h4>
                                <ul>
									<?php
									foreach ( $byteq_footer_contact_info as $contat_info ) {
										?>
                                        <li>
                                            <a href="<?php echo $contat_info["info_link"] ?>">
												<?php echo $contat_info["info_text"] ?>
                                            </a>
                                        </li>
										<?php
									}
									?>
                                </ul>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( ! empty( $byteq_footer_social ) ): ?>
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="widget-wrap mb-50" data-aos="fade-up" data-aos-delay="1100"
                                 data-aos-duration="1000">
                                <h4 class="title"><?php echo $byteq_footer_social_title; ?></h4>
								<?php footer_social(); ?>
                            </div>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>
        <div class="footer-bottom pb-85 pb-md-30 pb-xs-30">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="footer-separator mb-60 mb-md-30 mb-xs-30"></div>
                        <div class="copyright-text">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

	<?php
}

/**
 * copyright text
 */
function byteq_copyright_text() {
	print get_theme_mod( 'byteq_copyright', esc_html__( 'Copyright © 2022 Modern Byteq', 'byteq' ) );
}

/**
 * byteq_footer_menu_1
 */
function byteq_footer_menu() {
	$byteq_menu = wp_nav_menu( array(
		'theme_location'  => 'footer-menu',
		'menu_class'      => '',
		'container'       => '',
		'container_class' => 'footer-menu',
		'fallback_cb'     => 'Navwalker_Class::fallback',
		'walker'          => new Navwalker_Class,
		'depth'           => 1,
		'echo'            => false
	) );
	echo wp_kses_post( $byteq_menu );
}

/**
 * byteq_footer_menu_1
 */
function byteq_footer_menu_2() {
	$byteq_menu = wp_nav_menu( array(
		'theme_location'  => 'footer-menu-2',
		'menu_class'      => '',
		'container'       => 'div',
		'container_class' => 'footer-menu-2',
		'fallback_cb'     => 'Navwalker_Class::fallback',
		'walker'          => new Navwalker_Class,
		'depth'           => 1,
		'echo'            => false
	) );
	echo wp_kses_post( $byteq_menu );
}

/**
 * footer_social
 */
function footer_social() {
	$byteq_fb_url       = get_theme_mod( 'byteq_fb_url', '#' );
	$byteq_twitter_url  = get_theme_mod( 'byteq_twitter_url', '#' );
	$byteq_linkedin_url = get_theme_mod( 'byteq_linkedin_url', '#' );
	$byteq_youtube_url  = get_theme_mod( 'byteq_youtube_url', '#' );
	?>
    <div class="footer-social text-center text-lg-start">
		<?php if ( ! empty( $byteq_fb_url ) ): ?>
            <a href="<?php echo esc_url( $byteq_fb_url ); ?>">
                <i class="fa-brands fa-facebook-f"></i>
            </a>
		<?php endif; ?>
		<?php if ( ! empty( $byteq_linkedin_url ) ): ?>
            <a href="<?php echo esc_url( $byteq_linkedin_url ); ?>">
                <i class="fab fa-linkedin-in"></i>
            </a>
		<?php endif; ?>
		<?php if ( ! empty( $byteq_twitter_url ) ): ?>
            <a href="<?php echo esc_url( $byteq_twitter_url ); ?>">
                <i class="fa-brands fa-twitter"></i>
            </a>
		<?php endif; ?>
		<?php if ( ! empty( $byteq_youtube_url ) ): ?>
            <a href="<?php echo esc_url( $byteq_youtube_url ); ?>">
                <i class="fa-brands fa-youtube"></i>
            </a>
		<?php endif; ?>
    </div>
	<?php
}

/**
 * footer logo
 */
function byteq_footer_logo() {
	$byteq_logo        = get_template_directory_uri() . '/assets/img/logo/logo.png';
	$byteq_footer_logo = get_theme_mod( 'byteq_footer_logo', $byteq_logo );
	?>
    <a href="<?php print esc_url( home_url( '/' ) ); ?>">
        <img src="<?php print esc_url( $byteq_footer_logo ); ?>"
             alt="<?php print esc_attr( 'logo', 'byteq' ); ?>"/>
    </a>
	<?php
}

/**
 * byteq_get_tag
 */
function byteq_get_tag() {
	$html = '';
	if ( has_tag() ) {
		$html .= '<div class="blog-post-tag"><span>' . esc_html__( 'Post Tags', 'gocart' ) . '</span>';
		$html .= get_the_tag_list( '', ' ', '' );
		$html .= '</div>';
	}

	return $html;
}