<?php
/*
Template Name: Author List Page
*/

get_header(); 

?>
<section class="content">
				<h2>Collaboratori attivi</h2>
				<div style="display:block; float:left; clear:both; width:100%;">
<?php

	/*
	[user_url] => http://www.facebook.com/RikyUnreal
	[display_name] => Riccardo Rossi
	[user_email] => riccardo.rossi@isaa.it 
	* 
	* 
	[ID] => 3 
	[user_login] => albyz85 
	[user_pass] => $P$Bi4pKhXLheldy.5wYeNc/AfbAcHNJq. 
	[user_nicename] => albyz85 
	[user_email] => albyz85@gmail.com
	[user_url] => http://www.forumastronautico.it 
	[user_registered] => 2010-03-07 12:09:51 
	[user_activation_key] => 
	[user_status] => 0 
	[display_name] => Alberto Zampieron ) 
	 
	[ID] => 3 
	[caps] => Array ( [administrator] => 1 ) 
	[cap_key] => wp_capabilities [roles] => Array ( [0] => administrator ) [allcaps] => Array ( [switch_themes] => 1 [edit_themes] => 1 [activate_plugins] => 1 [edit_plugins] => 1 [edit_users] => 1 [edit_files] => 1 [manage_options] => 1 [moderate_comments] => 1 [manage_categories] => 1 [manage_links] => 1 [upload_files] => 1 [import] => 1 [unfiltered_html] => 1 [edit_posts] => 1 [edit_others_posts] => 1 [edit_published_posts] => 1 [publish_posts] => 1 [edit_pages] => 1 [read] => 1 [level_10] => 1 [level_9] => 1 [level_8] => 1 [level_7] => 1 [level_6] => 1 [level_5] => 1 [level_4] => 1 [level_3] => 1 [level_2] => 1 [level_1] => 1 [level_0] => 1 [edit_others_pages] => 1 [edit_published_pages] => 1 [publish_pages] => 1 [delete_pages] => 1 [delete_others_pages] => 1 [delete_published_pages] => 1 [delete_posts] => 1 [delete_others_posts] => 1 [delete_published_posts] => 1 [delete_private_posts] => 1 [edit_private_posts] => 1 [read_private_posts] => 1 [delete_private_pages] => 1 [edit_private_pages] => 1 [read_private_pages] => 1 [delete_users] => 1 [create_users] => 1 [unfiltered_upload] => 1 [edit_dashboard] => 1 [update_plugins] => 1 [delete_plugins] => 1 [install_plugins] => 1 [update_themes] => 1 [install_themes] => 1 [update_core] => 1 [list_users] => 1 [remove_users] => 1 [add_users] => 1 [promote_users] => 1 [edit_theme_options] => 1 [delete_themes] => 1 [export] => 1 [NextGEN Gallery overview] => 1 [NextGEN Use TinyMCE] => 1 [NextGEN Upload images] => 1 [NextGEN Manage gallery] => 1 [NextGEN Manage tags] => 1 [NextGEN Manage others gallery] => 1 [NextGEN Edit album] => 1 [NextGEN Change style] => 1 [NextGEN Change options] => 1 [wpt_twitter_oauth] => 1 [wpt_twitter_custom] => 1 [wpt_twitter_switch] => 1 [wpt_can_tweet] => 1 [NextGEN Attach Interface] => 1 [administrator] => 1 ) [filter] => )
	* 
	 */ 
	 
	$args = array(
		'blog_id'      => $GLOBALS['blog_id'],
		'role'         => '',
		'meta_key'     => '',
		'meta_value'   => '',
		'meta_compare' => '',
		'meta_query'   => array(),
		'include'      => array(),
		'exclude'      => array(),
		'orderby'      => 'post_count',
		'order'        => 'DESC',
		'offset'       => '',
		'search'       => '',
		'number'       => '',
		'count_total'  => false,
		//'fields'       => array( 'id','display_name','user_email','user_url','user_nicename' ),
		'fields'	   => 'all',
		'who'          => ''
	);	
    $blogusers = get_users($args);
    //print_r($blogusers);
    
    foreach ($blogusers as $user) {
	$box = '';
        $box .= '<div style="width:95%; padding-left:10px; margin:10px 0px 30px 0px; float:left; border-bottom: 1px dotted #ccc;">';
        $box .= '<div style="float:left; vertical-align:top; margin-right:10px;">' . get_avatar( $user->id ). '</div>';
        $box .= '<div style="font-family: \'Droid Sans\', sans-serif;">';
        $box .= '<div>';
        $box .= '<h3 style="text-transform: uppercase; padding: 0 0 5px 0;">' . $user->display_name. '</h3>';
        $box .= '</div>';
        $description = trim(get_the_author_meta( 'description', $user->id  ));
        if ($description != '') {
		$box .= '<div style="text-align:justify;">' . $description . '</div>';
	} else {
		$box .= '<div style="text-align:justify;">&nbsp;</div>';
	}
        $box .= '</div>';

        $box .= '<div style="float:left; clear:both;"><a href="http://www.astronautinews.it/author/' . $user->user_nicename . '" target="_blank">' . count_user_posts($user->id) . ' articoli (leggi)</a>';
        if (trim($user->user_url)!='') $box .= ' - <a href="' . $user->user_url. '" target="_blank">Sito web personale</a>';
        $box .= '</div>';
        $box .= '</div>';
        
		if (($user->roles[0] == 'editor') || ($user->roles[0] == 'administrator')) $current[] = $box;
		if ($user->roles[0] == 'subscriber') $past[] = $box;

    }
    
    foreach ($current as $c) {
		echo $c;
	}
?>
</div>
	

	<h2>Collaboratori storici</h2>
	<div style="display:block; float:left; clear:both; width:100%;">
<?php
foreach ($past as $c) {
		echo $c;
	}
?>
</div>
</section>
<?php get_sidebar(); ?>

<?php get_footer(); ?>
