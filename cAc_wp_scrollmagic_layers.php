<?php
/**
 * Plugin Name: WP Scrollmagic Layer
 * Plugin URI: https://github.com/bangerkuwranger/cAc_wp_scrollmagic_layers
 * Description: Integrated support for scrollmagic layering
 * Version: 1.0a
 * Author: Chad A. Carino
 * Author URI: http://www.chadacarino.com
 * License: MIT
 */
/*
The MIT License (MIT)
Copyright (c) 2016 Chad A. Carino
 
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

add_action( 'wp_enqueue_scripts', 'cAc_wpsml_frontend_queue' );

function cAc_wpsml_frontend_queue() {
	
	//minified
// 	wp_enqueue_script( 'cAc_wpsml_gsap_tweenmax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js' );
// 	wp_enqueue_script( 'cAc_wpsml_gsap_timelinemax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TimelineMax.min.js' );
// 	wp_enqueue_script( 'cAc_wpsml_scrollmagic', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js', array( 'jquery', 'cAc_wpsml_gsap_tweenmax', 'cAc_wpsml_gsap_timelinemax' ) );
	
	//debug
	wp_enqueue_script( 'cAc_wpsml_gsap_tweenmax', plugins_url( 'lib/gsap/TweenMax.js', __FILE__ ) );
	wp_enqueue_script( 'cAc_wpsml_gsap_timelinemax', plugins_url( 'lib/gsap/TimelineMax.js', __FILE__ ) );
	wp_enqueue_script( 'cAc_wpsml_scrollmagic_gsap', plugins_url( 'lib/scrollmagic/plugins/animation.gsap.js', __FILE__ ), array( 'jquery', 'cAc_wpsml_scrollmagic' ) );
	wp_enqueue_script( 'cAc_wpsml_scrollmagic', plugins_url( 'lib/scrollmagic/ScrollMagic.js', __FILE__ ), array( 'jquery', 'cAc_wpsml_gsap_tweenmax', 'cAc_wpsml_gsap_timelinemax' ) );
	wp_enqueue_script( 'cAc_wpsml_scrollmagic_debug', plugins_url( 'lib/scrollmagic/plugins/debug.addIndicators.js', __FILE__ ), array( 'cAc_wpsml_scrollmagic' ) );
	wp_register_script( 'cAc_wpsml_scrollmagic_layers', plugins_url( 'js/layers.js', __FILE__ ), array( 'cAc_wpsml_scrollmagic' ) );
	wp_localize_script( 'cAc_wpsml_scrollmagic_layers', 'cAc_wpsml_vars', array( 'baseUrl' => get_site_url() . '/', 'pluginUrl' => plugins_url( '/', __FILE__ ), 'handler' => get_site_url() . '/admin-ajax.php';
	wp_enqueue_script( 'cAc_wpsml_scrollmagic_layers' );
	wp_enqueue_style( 'cAc_wpsml_scrollmagic_layers', plugins_url( 'css/layers.css', __FILE__ ) );


}	//end cAc_wpsml_frontend_queue()


if( ! function_exists('cAc_wpsml_section') ) {

	// Register Custom Post Type
	function cAc_wpsml_section() {

		$labels = array(
			'name'                  => _x( 'Layered Page Sections', 'Post Type General Name', 'cAc_wpsml' ),
			'singular_name'         => _x( 'Layered Page Section', 'Post Type Singular Name', 'cAc_wpsml' ),
			'menu_name'             => __( 'Layered Page Sections', 'cAc_wpsml' ),
			'name_admin_bar'        => __( 'Layered Page Sections', 'cAc_wpsml' ),
			'archives'              => __( 'Layered Page Section Archives', 'cAc_wpsml' ),
			'parent_item_colon'     => __( 'Parent Section:', 'cAc_wpsml' ),
			'all_items'             => __( 'All Layered Page Sections', 'cAc_wpsml' ),
			'add_new_item'          => __( 'Add New Layered Page Section', 'cAc_wpsml' ),
			'add_new'               => __( 'Add New', 'cAc_wpsml' ),
			'new_item'              => __( 'New Layered Page Section', 'cAc_wpsml' ),
			'edit_item'             => __( 'Edit Layered Page Section', 'cAc_wpsml' ),
			'update_item'           => __( 'Update Layered Page Section', 'cAc_wpsml' ),
			'view_item'             => __( 'View Layered Page Section', 'cAc_wpsml' ),
			'search_items'          => __( 'Search Layered Page Sections', 'cAc_wpsml' ),
			'not_found'             => __( 'Not found', 'cAc_wpsml' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'cAc_wpsml' ),
			'featured_image'        => __( 'Featured Image', 'cAc_wpsml' ),
			'set_featured_image'    => __( 'Set featured image', 'cAc_wpsml' ),
			'remove_featured_image' => __( 'Remove featured image', 'cAc_wpsml' ),
			'use_featured_image'    => __( 'Use as featured image', 'cAc_wpsml' ),
			'insert_into_item'      => __( 'Insert into Layered Page Section', 'cAc_wpsml' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Layered Page Section', 'cAc_wpsml' ),
			'items_list'            => __( 'Layered Page Section list', 'cAc_wpsml' ),
			'items_list_navigation' => __( 'Layered Page Section list navigation', 'cAc_wpsml' ),
			'filter_items_list'     => __( 'Filter Layered Page Section list', 'cAc_wpsml' ),
		);
		$args = array(
			'label'                 => __( 'Layered Page Section', 'cAc_wpsml' ),
			'description'           => __( 'A layered section to be added to a page via shortcode', 'cAc_wpsml' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 20,
			'menu_icon'             => 'dashicons-admin-page',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,		
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'cAcsmlsection', $args );

	}	//end cAc_wpsml_section()
	add_action( 'init', 'cAc_wpsml_section', 0 );

}	//end if( ! function_exists('cAc_wpsml_section') )



// Add Shortcode
function cAc_wpsml_section_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'id' => 'null',
		), $atts )
	);

	// Code
	if( $id == null ) {

		return '';

	}	//end if( $id == null )

	$section = get_post( $id );

	if( !$section ) {

		return '';

	}	//end if( !$section )

	$html = '<div class="cAc_wpsml-pageSection" id="section-' . $id .'">';

	$html .= '<div class="cAc_wpsml-bg">';
	$html .= '<div style="background: blue; height:768px; width: 100%;"></div>';
	$html .= '</div>';

	$html .= '<div class="cAc_wpsml-mg">';

	$html .= '</div>';

	$html .= '<div class="cAc_wpsml-content">';
	$html .= apply_filters( 'the_content', $section->post_content  );
	$html .= '</div>';

	$html .= '<div class="cAc_wpsml-media">';
	$html .= get_the_post_thumbnail( $section );
	$html .= '</div>';

	$html .= '<div class="cAc_wpsml-trim">';

	$html .= '</div>';

	$html .= '</div>';
	apply_filters( 'cAc_wpsml_render_page_section', $html );
	return $html;

}	//end cAc_wpsml_section_shortcode( $atts )
add_shortcode( 'smpagesection', 'cAc_wpsml_section_shortcode' );

add_action( 'wp_ajax_nopriv_cAc_wpsml_load_section', 'cAc_wpsml_load_section' );
add_action( 'wp_ajax_cAc_wpsml_load_section', 'cAc_wpsml_load_section' );

function cAc_wpsml_load_section() {

	$response = array();
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
	
		$metas = get_post_meta( invtal( $_POST['id'] ) );
		$mediaurl = wp_get_attachment_url( get_post_thumbnail_id( intval( $_POST['id'] ), 'thumbnail') );
		
		if( $_POST['bg'] ) {
		
			$response['bg'] = $metas['cAc_wpsml_section_bg'];
		
		}
		if( $_POST['mg'] ) {
		
			$response['mg'] = $metas['cAc_wpsml_section_mg'];
		
		}
		if( $_POST['content'] ) {
		
			$response['content'] = apply_filters( 'the_content', get_post( intval( $_POST['id'] ) )->post_content );
		
		}
		if( $_POST['media'] ) {
		
			$response['media'] = '<img src="' . $mediaurl . '" />';
		
		}
		if( $_POST['trim'] ) {
		
			$response['trim'] = $metas['cAc_wpsml_section_trim'];
		
		}
	
	}
	echo json_encode( $response );
	die();
}