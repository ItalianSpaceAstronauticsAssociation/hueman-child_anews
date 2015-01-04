<?php

add_action( 'wp_enqueue_scripts', 'enqueue_parent_theme_style' );
function enqueue_parent_theme_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}


/* ==  MARCOZAMBI ==============================*/
//Function to add featured image in RSS feeds
function featured_image_in_rss($content)
{
	// Global $post variable
	global $post;
	// Check if the post has a featured image
	if (has_post_thumbnail($post->ID))
	{
		// $content = '<div class="featured_image_post_rss">' . get_the_post_thumbnail($post->ID, 'thumbnail') . '</div>' . $content;
                $content =  '<div style="display:block; float:left;">' . get_the_post_thumbnail($post->ID, 'medium') . '</div>' . $content;
	}
	return $content;
}
//Add the filter for RSS feeds Excerpt
add_filter('the_excerpt_rss', 'featured_image_in_rss');
//Add the filter for RSS feed content
add_filter('the_content_feed', 'featured_image_in_rss');


add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {
    if( $args->theme_location == 'primary-menu' )
	//Stile copiato e adattato dalla classe DT_Search presente in style.css e inserito tra i css personalizzati
        return $items."<li class='menu-item menu-item-type-custom'><form action='http://www.astronautinews.it' id='customsearchform' method='get'><div class='ISAA_Search'><input type='text' name='s' id='s' placeholder='Cerca...'></form></div></li>";
	
    return $items;
}

// Nuovo avatari di default (logo Anews)
/*
add_filter( 'avatar_defaults', 'newgravatar' );
function newgravatar ($avatar_defaults) {
    $myavatar = '/isaa-gravatar.png';
    $avatar_defaults[$myavatar] = "Own";
    return $avatar_defaults;
}
*/

// Mostra il campo personalizzato rss:comments in calce al contenuto
function insertFAITBackLink($content) 
{
	global $post;
	//$content .= "*** " . $post->ID . " ***";
	if (!is_feed() && !is_home()) 
	{
		$linkback = get_post_meta($post->ID, 'rss:comments', true);
		if ($linkback) { 
			$content .= '<div style="display:block; margin-bottom:20px;"><h3>Segui la discussione su ForumAstronautico.it</h3>';
			$content .= '<a href="' . $linkback . '" target="_blank">' . $linkback . '</a>';
			$content .= '</div>';
		}
	}
    return $content;
}
add_filter ('the_content', 'insertFAITBackLink');

// Aggiunge nota sul copyright
function insertLicenseAgreement($content) 
{
        global $post;
        if (!is_home()) 
        {
                $content .= '<br><div style="display:block; margin-bottom:20px;">';
                $content .= '<a href="http://www.astronautinews.it/licenza/" target="_blank">(C) Associazione ISAA - Licenza CC BY-NC Plus Italia</a>';
                $content .= '</div>';
        }
    return $content;
}
add_filter ('the_content', 'insertLicenseAgreement');

/* ==  MARCOZAMBI END ============================*/
