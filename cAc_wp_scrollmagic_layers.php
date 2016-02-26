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
	wp_localize_script( 'cAc_wpsml_scrollmagic_layers', 'cAc_wpsml_vars', array( 'baseUrl' => get_site_url() . '/', 'pluginUrl' => plugins_url( '/', __FILE__ ), 'handler' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_script( 'cAc_wpsml_scrollmagic_layers' );
	wp_enqueue_style( 'cAc_wpsml_scrollmagic_layers', plugins_url( 'css/layers.css', __FILE__ ) );


}	//end cAc_wpsml_frontend_queue()

function cAc_wpsml_admin_queue() {

	wp_enqueue_script( 'cAc_wpsml_admin', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' ) );

}
add_action( 'admin_enqueue_scripts', 'cAc_wpsml_admin_queue' );

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
			'set_featured_image'    => __( 'Set Media Layer', 'cAc_wpsml' ),
			'remove_featured_image' => __( 'Remove Media Layer', 'cAc_wpsml' ),
			'use_featured_image'    => __( 'Use as Media Layer', 'cAc_wpsml' ),
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
			'supports'              => array( 'editor', 'thumbnail', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 20,
			'menu_icon'             => 'dashicons-admin-page',
			'register_meta_box_cb'	=> 'cAc_wpsml_section_meta_box',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,		
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'cacsmlsection', $args );

	}	//end cAc_wpsml_section()
	add_action( 'init', 'cAc_wpsml_section', 0 );

}	//end if( ! function_exists('cAc_wpsml_section') )


//section primary editor titles
add_action( 'edit_form_after_title', 'cAc_wpsml_section_edit_form_after_title' );
add_action( 'edit_form_after_editor', 'cAc_wpsml_section_edit_form_after_editor' );

function cAc_wpsml_section_edit_form_after_title() {

	$screen = get_current_screen();
	
	if( $screen->post_type == 'cacsmlsection' ) {
	
		echo '<div class="postbox" style="margin-top: 20px;"><h2>Content Layer</h2><div class="inside">';
	
	}	//end if( $screen->post_type == 'cacsmlsection' )
	
}	//end cAc_wpsml_section_edit_form_after_title()

function cAc_wpsml_section_edit_form_after_editor() {

	$screen = get_current_screen();
	
	if( $screen->post_type == 'cacsmlsection' ) {
	
		echo '</div></div>';
	
	}	//end if( $screen->post_type == 'cacsmlsection' )
	
}	//end cAc_wpsml_section_edit_form_after_editor()


//metabox for custom fields

function cAc_wpsml_section_meta_box() {

	add_meta_box( 'cAc_wpsml_section_layer_data', 'Additional Layers', 'cAc_wpsml_section_meta_box_fields', array( 'cacsmlsection' ), 'normal', 'core' );

}	//end cAc_wpsml_section_meta_box()


function cAc_wpsml_section_meta_box_fields( $section ) {

	$bg_side = get_post_meta( $section->ID, 'cAc_wpsml_section_bg_side', true );
	$bg_color = get_post_meta( $section->ID, 'cAc_wpsml_section_bg_color', true );
	$mg_image_id = get_post_meta( $section->ID, 'cAc_wpsml_section_mg', true );
	$mg_image_src = wp_get_attachment_url( $mg_image_id );
	$trim_image_id = get_post_meta( $section->ID, 'cAc_wpsml_section_trim', true );
	$trim_image_src = wp_get_attachment_url( $trim_image_id );
	$trim_side = get_post_meta( $section->ID, 'cAc_wpsml_section_trim_side', true );
	echo '<script>var cAcPageSectionId = "' . $section->ID . '";</script>';
	wp_nonce_field( 'cAc_wpsml_section_save_meta_box_fields', 'cAc_wpsml_section_save_meta_box_nonce' );
	?>
	<h2>Copy the code below and paste into page where you want this section to appear:<br/>
		<code>[smpagesection id="<?php echo intval( $section->ID ); ?>"]</code>
	</h2>
	<table>
		<tbody>
			<tr>
				<td>
					<h3><?php echo __( 'Background Layer', 'cAc_wpsml' ) ?></h3>
				</td>
			</tr>
			<tr>
				<td>
					<label for="cAc_wpsml_section_bg_color">Which color should the background be?</label><br/>
					<select name="cAc_wpsml_section_bg_color">
						<option value="gray" <?php selected( 'gray', $bg_color ); ?> >Gray</option>
						<option value="lilac" <?php selected( 'lilac', $bg_color ); ?> >Lilac</option>
						<option value="pink" <?php selected( 'pink', $bg_color ); ?> >Pink</option>
						<option value="teal" <?php selected( 'teal', $bg_color ); ?> >Teal</option>
						<option value="yellow" <?php selected( 'yellow', $bg_color ); ?> >Yellow</option>
					</select>
					<label for="cAc_wpsml_section_bg_side">Which side of the background should be shorter?</label><br/>
					<input name="cAc_wpsml_section_bg_side" id="cAc_wpsml_section_bg_side_left" value="left" type="radio" <?php checked( 'left', $bg_side ); ?> /> Left<br/>
					<input name="cAc_wpsml_section_bg_side" id="cAc_wpsml_section_bg_side_right" value="right" type="radio" <?php checked( 'right', $bg_side ); ?> /> Right
				</td>
			</tr>
			<tr>
				<td>
					<hr/>
				</td>
			</tr>
			<tr>
				<td>
					<h3><?php echo __( 'Midground Layer', 'cAc_wpsml' ) ?></h3>
				</td>
			</tr>
			<tr>
				<td>
					<img style="width: 100%; height: auto;" class="cAc_wpsml_section_mg" src="<?php echo $mg_image_src; ?>"/>
					<input type="hidden" id="cAc_wpsml_section_mg" name="cAc_wpsml_section_mg" value="<?php echo $mg_image_id; ?>" />
					<br/>
					<a class="set-cAc_wpsml-svg-field" id="set-cAc_wpsml_section_mg" title="Set Midground Layer SVG file" href="set-mg-image">Set Midground Image</a>
					<br/>
					<a class="remove-cAc_wpsml-svg-field" id="remove-cAc_wpsml_section_mg" <?php echo empty( $mg_image_id ) ? 'style="display: none;"' : '' ?> title="Remove Midground Layer SVG file" href="remove-mg-image">Remove Midground Image</a>
				</td>
			</tr>
			<tr>
				<td>
					<hr/>
				</td>
			</tr>
			<tr>
				<td>
					<h3><?php echo __( 'Trim Layer', 'cAc_wpsml' ) ?></h3>
				</td>
			</tr>
			<tr>
				<td>
					<img style="width: 100%; height: auto;" class="cAc_wpsml_section_trim" src="<?php echo $trim_image_src; ?>"/>
					<input type="hidden" id="cAc_wpsml_section_trim" name="cAc_wpsml_section_trim" value="<?php echo $trim_image_id; ?>" />
					<br/>
					<a class="set-cAc_wpsml-svg-field" id="set-cAc_wpsml_section_trim" title="Set Trim Layer SVG file" href="set-mg-image">Set Trim Image</a>
					<br/>
					<a class="remove-cAc_wpsml-svg-field" id="remove-cAc_wpsml_section_trim" <?php echo empty( $trim_image_id ) ? 'style="display: none;"' : '' ?> title="Remove Trim Layer image file" href="remove-trim-image">Remove Trim Image</a>
				</td>
			</tr>
			<tr>
				<td>
					<label for="cAc_wpsml_section_trim_side">Which side does the trim appear on?</label><br/>
					<input name="cAc_wpsml_section_trim_side" id="cAc_wpsml_section_trim_side_left" value="left" type="radio" <?php checked( 'left', $trim_side ); ?> /> Left<br/>
					<input name="cAc_wpsml_section_trim_side" id="cAc_wpsml_section_trim_side_right" value="right" type="radio" <?php checked( 'right', $trim_side ); ?> /> Right
				</td>
			</tr>
			<tr>
				<td>
					<hr/>
				</td>
			</tr>
		</tbody>
	</table>
	<?php

}	//end cAc_wpsml_section_meta_box_fields



function cAc_wpsml_section_save_meta_box_fields( $section_id ) {

	//check security
	if ( ! isset( $_POST['cAc_wpsml_section_save_meta_box_nonce'] ) ) {
	
    	return $section_id;
    
    }	//end if ( ! isset( $_POST['cAc_wpsml_section_save_meta_box_nonce'] ) )
    $nonce = $_POST['cAc_wpsml_section_save_meta_box_nonce'];
	if ( ! wp_verify_nonce( $nonce, 'cAc_wpsml_section_save_meta_box_fields' ) ) {
	
	  return $section_id;
	
	}	//end if ( ! wp_verify_nonce( $nonce, 'cAc_wpsml_section_save_meta_box_fields' ) )
	
	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
	
	  return $section_id;
	
	}	//end if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	
    	
	//verify and sanitize values	
	$bg_color = isset( $_POST['cAc_wpsml_section_bg_color'] ) ? $_POST['cAc_wpsml_section_bg_color'] : '';
	$bg_side = isset( $_POST['cAc_wpsml_section_bg_side'] ) ? $_POST['cAc_wpsml_section_bg_side'] : '';
	$mg = isset( $_POST['cAc_wpsml_section_mg'] ) ? $_POST['cAc_wpsml_section_mg'] : '';
	$trim = isset( $_POST['cAc_wpsml_section_trim'] ) ? $_POST['cAc_wpsml_section_trim'] : '';
	$trim_side = isset( $_POST['cAc_wpsml_section_trim_side'] ) ? $_POST['cAc_wpsml_section_trim_side'] : '';
	
	//save to db
	update_post_meta( $section_id, 'cAc_wpsml_section_bg_color', $bg_color );
	update_post_meta( $section_id, 'cAc_wpsml_section_bg_side', $bg_side );
	update_post_meta( $section_id, 'cAc_wpsml_section_mg', $mg );
	update_post_meta( $section_id, 'cAc_wpsml_section_trim', $trim );
	update_post_meta( $section_id, 'cAc_wpsml_section_trim_side', $trim_side );

}	//end cAc_wpsml_section_save_meta_box_fields
add_action( 'save_post_cacsmlsection', 'cAc_wpsml_section_save_meta_box_fields' );



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
	$meta = get_post_meta( $id );

	if( !$section ) {

		return '';

	}	//end if( !$section )

	
	$html = '<div id="section-' . $id .'" class="cAc_wpsml-pageSection';

	if( !empty( $meta['cAc_wpsml_section_bg_color'] ) && !empty( $meta['cAc_wpsml_section_bg_side'] )) {
		$html .= ' cAc_wpsml-bg ' . $meta['cAc_wpsml_section_bg_color'][0] . ' ' . $meta['cAc_wpsml_section_bg_side'][0] . '">';
	}
	else {
		$html .= '">';
	}
	
	if( !empty( $meta['cAc_wpsml_section_mg'] ) ) {
		$html .= '<div class="cAc_wpsml-mg">';
		$html .= '</div>';
	}

	if( !empty( $section->post_content ) ) {
		$html .= '<div class="cAc_wpsml-content">';
			$html .= apply_filters( 'the_content', $section->post_content );
		$html .= '</div>';
	}

	if( has_post_thumbnail( $section ) ) {
		$html .= '<div class="cAc_wpsml-media">';
		$html .= '</div>';
	}

	if( !empty( $meta['cAc_wpsml_section_trim'] ) ) {
		$html .= '<div class="cAc_wpsml-trim">';
		$html .= '</div>';
	}
	
	$html .= '</div>';
	apply_filters( 'cAc_wpsml_render_page_section', $html );
	
	return $html;

}	//end cAc_wpsml_section_shortcode( $atts )
add_shortcode( 'smpagesection', 'cAc_wpsml_section_shortcode' );

add_action( 'wp_ajax_nopriv_cAc_wpsml_load_section', 'cAc_wpsml_load_section' );
add_action( 'wp_ajax_cAc_wpsml_load_section', 'cAc_wpsml_load_section' );

function cAc_wpsml_load_section() {

	$response = array();
	if( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
	
		$metas = get_post_meta( intval( $_POST['id'] ) );
		$mediaurl = wp_get_attachment_url( get_post_thumbnail_id( intval( $_POST['id'] ), 'thumbnail') );
		
		
		if( $_POST['bg'] === "true" ) {
		
			$response['bg'] = $metas['cAc_wpsml_section_bg_side'];
		
		}
		if( $_POST['mg'] === "true" ) {
		
			$response['mg'] = file_get_contents( get_attached_file( $metas['cAc_wpsml_section_mg'][0] ) );
		
		}
		if( $_POST['media'] === "true" ) {
		
			$response['media'] = '<img src="' . $mediaurl . '" />';
		
		}
		if( $_POST['trim'] === "true" ) {
		
			$response['trim'] = '<div class="cAc_wpsml_trim-' . $metas['cAc_wpsml_section_trim_side'][0] . '">' . '<img src="' . wp_get_attachment_url( $metas['cAc_wpsml_section_trim'][0] ) . '" />' . '</div>';
		
		}
	
	}
	if( empty( $response ) ) {
	
		$response['error'] = 'No fields in POST';
		$response['post'] = $_POST;
		
	}
	echo json_encode( $response );
	die();
}	//end cAc_wpsml_load_section()


function cAc_wpsml_mime_types( $mimes ) {

	$mimes['svg'] = 'image/svg+xml';
	return $mimes;

}	//end cAc_wpsml_mime_types( $mimes )
add_filter( 'upload_mimes', 'cAc_wpsml_mime_types' );