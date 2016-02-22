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
// 	wp_enqueue_script( 'cAc_wpsml_gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js' );
// 	wp_enqueue_script( 'cAc_wpsml_gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TimelineMax.min.js' );
// 	wp_enqueue_script( 'cAc_wpsml_scrollmagic', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js', array( 'cAc_wpsml_gsap' );
	
	//debug
	wp_enqueue_script( 'cAc_wpsml_gsap_tweenmax', plugins_url( 'lib/gsap/TweenMax.js', __FILE__ ) );
	wp_enqueue_script( 'cAc_wpsml_gsap_timelinemax', plugins_url( 'lib/gsap/TimelineMax.js', __FILE__ ) );
	wp_enqueue_script( 'cAc_wpsml_scrollmagic', plugins_url( 'lib/scrollmagic/ScrollMagic.js', __FILE__ ), array( 'jquery', 'cAc_wpsml_gsap_tweenmax', 'cAc_wpsml_gsap_timelinemax' );
	wp_enqueue_script( 'cAc_wpsml_scrollmagic_debug', plugins_url( 'lib/scrollmagic/plugins/debug.addIndicators.min.js', __FILE__ ), array( 'cAc_wpsml_scrollmagic' ) );


}	//end cAc_wpsml_frontend_queue()
