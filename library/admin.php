<?php
/*
This file handles the admin area and functions.
You can use this file to make changes to the
dashboard. Updates to this page are coming soon.
It's turned off by default, but you can call it
via the functions file.

Developed by: Eddie Machado
URL: http://themble.com/bones/

Special Thanks for code & inspiration to:
@jackmcconnell - http://www.voltronik.co.uk/
Digging into WP - http://digwp.com/2010/10/customize-wordpress-dashboard/

*/

/************* DASHBOARD WIDGETS *****************/

// disable default dashboard widgets
function disable_default_dashboard_widgets() {
	// remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' );    // Right Now Widget
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' ); // Comments Widget
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );  // Incoming Links Widget
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );         // Plugins Widget

	// remove_meta_box('dashboard_quick_press', 'dashboard', 'core' );   // Quick Press Widget
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );   // Recent Drafts Widget
	remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );         //
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );       //

	// removing plugin dashboard boxes
	remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal' );         // Yoast's SEO Plugin Widget

	/*
	have more plugin widgets you'd like to remove?
	share them with us so we can get a list of
	the most commonly used. :D
	https://github.com/eddiemachado/bones/issues
	*/
}

/*
Now let's talk about adding your own custom Dashboard widget.
Sometimes you want to show clients feeds relative to their
site's content. For example, the NBA.com feed for a sports
site. Here is an example Dashboard Widget that displays recent
entries from an RSS Feed.

For more information on creating Dashboard Widgets, view:
http://digwp.com/2010/10/customize-wordpress-dashboard/
*/

// RSS Dashboard Widget
function bones_rss_dashboard_widget() {
	if ( function_exists( 'fetch_feed' ) ) {
		include_once( ABSPATH . WPINC . '/feed.php' );               // include the required file
		$feed = fetch_feed( 'http://themble.com/feed/rss/' );        // specify the source feed
		$limit = $feed->get_item_quantity(7);                        // specify number of items
		$items = $feed->get_items(0, $limit);                        // create an array of items
	}
	if ($limit == 0) echo '<div>The RSS Feed is either empty or unavailable.</div>';   // fallback message
	else foreach ($items as $item) { ?>

	<h4 style="margin-bottom: 0;">
		<a href="<?php echo $item->get_permalink(); ?>" title="<?php echo mysql2date( __( 'j F Y @ g:i a', 'creativetheme' ), $item->get_date( 'Y-m-d H:i:s' ) ); ?>" target="_blank">
			<?php echo $item->get_title(); ?>
		</a>
	</h4>
	<p style="margin-top: 0.5em;">
		<?php echo substr($item->get_description(), 0, 200); ?>
	</p>
	<?php }
}

// calling all custom dashboard widgets
function bones_custom_dashboard_widgets() {
	wp_add_dashboard_widget( 'bones_rss_dashboard_widget', __( 'Recently on Themble (Customize on admin.php)', 'creativetheme' ), 'bones_rss_dashboard_widget' );
	/*
	Be sure to drop any other created Dashboard Widgets
	in this function and they will all load.
	*/
}


// removing the dashboard widgets
add_action( 'admin_menu', 'disable_default_dashboard_widgets' );
// adding any custom widgets
add_action( 'wp_dashboard_setup', 'bones_custom_dashboard_widgets' );


/************* CUSTOM LOGIN PAGE *****************/

// calling your own login css so you can style it

//Updated to proper 'enqueue' method
//http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
function bones_login_css() {
	wp_enqueue_style( 'bones_login_css', get_template_directory_uri() . '/library/css/login.css', false );
}

// changing the logo link from wordpress.org to your site
function bones_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function bones_login_title() { return get_option( 'blogname' ); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'bones_login_css', 10 );
add_filter( 'login_headerurl', 'bones_login_url' );
add_filter( 'login_headertitle', 'bones_login_title' );


/************* CUSTOMIZE ADMIN *******************/

/*
I don't really recommend editing the admin too much
as things may get funky if WordPress updates. Here
are a few funtions which you can choose to use if
you like.
*/

// Custom Backend Footer
function bones_custom_admin_footer() {
	_e( '<span id="footer-thankyou">Developed by <a href="http://yoursite.com" target="_blank">Your Site Name</a></span>. Built using <a href="http://themble.com/bones" target="_blank">Bones</a>.', 'creativetheme' );
}

// adding it to the admin area
add_filter( 'admin_footer_text', 'bones_custom_admin_footer' );

/************* RICH EDITOR ***********************/

// Add styles to theme editor
function my_theme_add_editor_styles() {
    add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );
    add_editor_style( 'http://fonts.googleapis.com/css?family=Amatic+SC:400,700');
    
}
add_action( 'init', 'my_theme_add_editor_styles' ); //add styles to editor

//Add styles to TinyMCE editor. Insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
    $buttons[] = 'fontsizeselect';
    $buttons[] = 'styleselect';
    return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');//Add buttons to the TinyMCE editor

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {  
    // Define the style_formats array
    $style_formats = array(  
        // Each array child is a format with it's own settings
        array(  
            'title' => 'Amatic',  
            'inline' => 'span',  
            'classes' => 'amatic',
            'wrapper' => false,
        ),
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
    
    return $init_array;  
  
}
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); // add styles to styleselect dropdown in the TinyMCE editor

function enable_more_buttons($buttons) {
  
 
  return $buttons;
}
add_filter("mce_buttons_3", "enable_more_buttons");

/*********************
THEME OPTIONS ADMIN PAGE
*********************/
add_action( 'admin_menu', 'setup_theme_admin_menus' ); // Create the theme admin menu
add_action( 'admin_init', 'register_mysettings' ); // Register the theme settings

// Add theme admin menu
function setup_theme_admin_menus() {  
    add_submenu_page('options-general.php',   
        'Company Details', 'Company Details', 'manage_options',   
        'company-detail', 'theme_company_detail_settings');
} 

// Add theme options
function register_mysettings() { // whitelist options
    register_setting( 'company_details', 'company_details', 'company_details_validate' );
    add_settings_section('company_contact', 'Company Contact Details', 'company_section_text', 'company_details');
    
    add_settings_field('company_name', 'Company Name', 'company_name', 'company_details', 'company_contact');
    add_settings_field('company_address', 'Company Postal Address', 'company_address', 'company_details', 'company_contact');
    add_settings_field('company_phone', 'Contact Phone Number', 'company_phone', 'company_details', 'company_contact');
    add_settings_field('company_phone2', 'Secondary Phone Number', 'company_phone2', 'company_details', 'company_contact');
    
    register_setting( 'company_details', 'social_networks', 'social_networks_validate' );
    add_settings_section('social_networks', 'Social Network Links', 'company_section_text', 'company_details');
    
    add_settings_field('company_facebook', 'Facebook Page URL', 'company_facebook',  'company_details', 'social_networks');
    add_settings_field('company_pinterest', 'Pinterest Profile URL', 'company_pinterest',  'company_details', 'social_networks');
    add_settings_field('company_flickr', 'Flickr Profile URL', 'company_flickr',  'company_details', 'social_networks');
    add_settings_field('company_instagram', 'Instagram Profile URL', 'company_instagram',  'company_details', 'social_networks');
    add_settings_field('company_linkedin', 'Linkedin Profile URL', 'company_linkedin',  'company_details', 'social_networks');
    
}

// Option input boxes for the admin page
function company_name()
{
$options = get_option('company_details');
echo "<input id='company_name' name='company_details[company_name]' size='40' type='text' value='{$options['company_name']}' />";
}

function company_address()
{
$options = get_option('company_details');
echo "<input id='company_address' name='company_details[company_address]' size='40' type='text' value='{$options['company_address']}' />";
}

function company_phone() 
{
$options = get_option('company_details');
echo "<input id='company_phone' name='company_details[company_phone]' size='40' type='text' value='{$options['company_phone']}' />";
}

function company_phone2() 
{
$options = get_option('company_details');
echo "<input id='company_phone2' name='company_details[company_phone2]' size='40' type='text' value='{$options['company_phone2']}' />";
}

function company_facebook() 
{
$options = get_option('social_networks');
echo "<input id='company_facebook' name='social_networks[company_facebook]' size='40' type='text' value='{$options['company_facebook']}' />";
}

function company_pinterest() 
{
$options = get_option('social_networks');
echo "<input id='company_pinterest' name='social_networks[company_pinterest]' size='40' type='text' value='{$options['company_pinterest']}' />";
}

function company_flickr() 
{
$options = get_option('social_networks');
echo "<input id='company_flickr' name='social_networks[company_flickr]' size='40' type='text' value='{$options['company_flickr']}' />";
}

function company_instagram() 
{
$options = get_option('social_networks');
echo "<input id='company_instagram' name='social_networks[company_instagram]' size='40' type='text' value='{$options['company_instagram']}' />";
}

function company_linkedin() 
{
$options = get_option('social_networks');
echo "<input id='company_linkedin' name='social_networks[company_linkedin]' size='40' type='text' value='{$options['company_linkedin']}' />";
}

// Validate our options
function company_details_validate($input) 
{
    $newinput['company_name'] = trim($input['company_name']);
    $newinput['company_address'] = trim($input['company_address']);
    $newinput['company_phone'] = trim($input['company_phone']);
    $newinput['company_phone2'] = trim($input['company_phone2']);
    $newinput['company_fax'] = trim($input['company_fax']);
        
    return $newinput;
}

function social_networks_validate($input) 
{    
    $newinput['company_facebook'] = trim($input['company_facebook']);
    $newinput['company_pinterest'] = trim($input['company_pinterest']);
    $newinput['company_flickr'] = trim($input['company_flickr']);
    $newinput['company_instagram'] = trim($input['company_instagram']);
    $newinput['company_linkedin'] = trim($input['company_linkedin']);
    
    return $newinput;
}

function company_section_text() {
    
}

// Add company details admin page
function theme_company_detail_settings() 
{
    echo '<div class="wrap">';
    screen_icon();
    echo '<h2>Company Details</h2>';

    echo '<form method="post" action="options.php">';
    settings_fields('company_details');
    echo '<fieldset>';
    do_settings_sections('company_details');
    echo '</fieldset><fieldset>';
    do_settings_sections('social_networks');
    echo '</fieldset>';
    
    submit_button();

    echo '</form></div>';
}
?>
