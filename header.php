<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // Google Chrome Frame for IE ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body <?php body_class(); ?>>

		<div id="container">

			<header class="header" role="banner">

				<div id="inner-header" class="wrap clearfix">

					<?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?>
					<p id="logo"><a href="<?php echo home_url(); ?>" rel="nofollow" id="site-title"><img src="<?php echo get_template_directory_uri(); ?>/library/images/logo.svg" alt="My Creative Life" /></a><a href="<?php echo home_url(); ?>" rel="nofollow" id="tagline"><span><?php bloginfo('description'); ?></span></a></p>

					<!--social networks and buttons -->
					<div class="networks">
						<?php $social_networks = get_option('social_networks'); ?>

						<?php if($social_networks['company_flickr']) { ?>
							<a href="<?php echo $social_networks['company_flickr']; ?>" title="<?php echo $company_details['company_name'];?> Flickr Page" class="social-icon flickr-icon" target="_blank">Flickr</a>
						<?php } ?>
					
						<?php if($social_networks['company_instagram']) { ?>
							<a href="<?php echo $social_networks['company_instagram']; ?>" title="<?php echo $company_details['company_name'];?> Instagram Profile" class="social-icon instagram-icon" target="_blank">Instagram</a>
						<?php } ?>
						
						<?php if($social_networks['company_linkedin']) { ?>
							<a href="<?php echo $social_networks['company_linkedin']; ?>" title="<?php echo $company_details['company_name'];?> Linked In Profile" class="social-icon linkedin-icon" target="_blank">Instagram</a>
						<?php } ?>
						
						<?php if($social_networks['company_pinterest']) { ?>
							<a href="<?php echo $social_networks['company_pinterest']; ?>" title="<?php echo $company_details['company_name'];?> on Pinterest" class="social-icon pinterest-icon" target="_blank">Pinterest</a>
						<?php } ?>
					
						<?php if($social_networks['company_facebook']) { ?>
							<a href="<?php echo $social_networks['company_facebook']; ?>" title="<?php echo $company_details['company_name'];?> Facebook Page" class="social-icon facebook-icon" target="_blank">Facebook</a>
						<?php } ?>

					</div>
					<!-- /networks-->
					
					<nav role="navigation">
						<?php bones_main_nav(); ?>
					</nav>

				</div>

			</header>
