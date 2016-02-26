var controller,
tweens = {},
scenes = {},
breakpoints = { 
	'xs':	480,
	'sm':	768,
	'md':	1030,
	'lg':	1240,
	'xl':	1400
};


///now with no retriangling, need to pull addtl. elements in if viewport is upsized. maybe set a body class?


function triangle( w, side, pos ) {

	var h = Math.round((5*w)/24);
	var which = side + pos;
	var elem = '<div class="triangle ' + pos + '" style="min-height: ' + h + 'px; background-image: url(data:image/svg+xml;utf8,';
	var svg = '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="' + h + '" width="' + w + '">';
	
	switch (which) {
	
		case 'righttop':
			svg += '<polygon points="0,0 ' + w + ',0 ' + w + ',' + h + '" style="fill:lime;" />';
			break;
		case 'rightbottom':
			svg += '<polygon points="' + w + ',0 ' + w + ',' + h + ' 0,' + h + '" style="fill:lime;" />';
			break;
		case 'lefttop':
			svg += '<polygon points="0,0 0,' + h + ' ' + w + ',0" style="fill:lime;" />';
			break;
		case 'leftbottom':
			svg += '<polygon points="0,0 0,' + h + ' ' + w + ',' + h + '" style="fill:lime;" />';
			break;
		default:
			return false;
	
	}
	svg += '</svg>';
	elem += encodeURIComponent(svg);
	elem += ')"></div>';
	
	return elem;

}

jQuery(function($) {
	
	controller = new ScrollMagic.Controller();
	$('.cAc_wpsml-pageSection').each( function() {
	
		
		var thisId = $(this).attr('id'),
		bg = $(this).hasClass('cAc_wpsml-bg'),
		$mg = $(this).find('.cAc_wpsml-mg'),
		$content = $(this).find('.cAc_wpsml-content'),
		$media = $(this).find('.cAc_wpsml-media'),
		$trim = $(this).find('.cAc_wpsml-trim');
		
		if (bg) {
			var $bg = $(this);
		}
		else {
			var $bg = false;
		}
		
		if( $mg.length > 0 ) {
			var mg = $mg;
		}
		else {
			var mg = false;
		}
		
		if( $content.length > 0 ) {
			var content = $content;
		}
		else {
			var content = false;
		}
		
		if( $media.length > 0 ) {
			var media = $media;
		}
		else {
			var media = false;
		}
		
		if( $trim.length > 0 ) {
			var trim = $trim;
		}
		else {
			var trim = false;
		}
		
		loadSectionScene( thisId, $bg, mg, content, media, trim );
		cac_wpsml_bodyClass(cAc_wpsmlViewport, breakpoints);
		
		//tweens & scenes (tweens currently commented out)
	
	/*	if( bg != false ) {
			tweens[thisId + "bg"] = new TimelineMax().add([ TweenMax.to("#section-" + thisId + " .cAc_wpsml-bg", 1000, {top: "-40px", ease: Linear.easeNone}) ]);
			scenes[thisId + "bg"] = new ScrollMagic.Scene({triggerElement: "#" + thisId + " .cAc_wpsml-bg", duration: 500, offset: 0})
						// .setTween(tweens[thisId])
						.setPin("#" + thisId + " .cAc_wpsml-bg")
						.addTo(controller);
			// show indicators (requires debug extension)
			scenes[thisId + "bg"].addIndicators();
		}
		
		if( mg != false ) {
			tweens[thisId + "mg"] = new TimelineMax().add([ TweenMax.to("#section-" + thisId + " .cAc_wpsml-mg", 1000, {top: "-40px", ease: Linear.easeNone}) ]);
			scenes[thisId + "mg"] = new ScrollMagic.Scene({triggerElement: "#" + thisId + " .cAc_wpsml-mg", duration: 500, offset: 0})
						// .setTween(tweens[thisId])
						.setPin("#" + thisId + " .cAc_wpsml-mg")
						.addTo(controller);
			// show indicators (requires debug extension)
			scenes[thisId + "mg"].addIndicators();
		}
		
		if( content != false ) {
			tweens[thisId + "content"] = new TimelineMax().add([ TweenMax.to("#section-" + thisId + " .cAc_wpsml-content", 1000, {top: "-40px", ease: Linear.easeNone}) ]);
			scenes[thisId + "content"] = new ScrollMagic.Scene({triggerElement: "#" + thisId + " .cAc_wpsml-content", duration: 500, offset: 0})
						// .setTween(tweens[thisId])
						.setPin("#" + thisId + " .cAc_wpsml-content")
						.addTo(controller);
			// show indicators (requires debug extension)
			scenes[thisId + "content"].addIndicators();
		}
		
		if( media != false ) {
			tweens[thisId + "media"] = new TimelineMax().add([ TweenMax.to("#section-" + thisId + " .cAc_wpsml-media", 1000, {top: "-40px", ease: Linear.easeNone}) ]);
			scenes[thisId + "media"] = new ScrollMagic.Scene({triggerElement: "#" + thisId + " .cAc_wpsml-media", duration: 500, offset: 0})
						// .setTween(tweens[thisId])
						.setPin("#" + thisId + " .cAc_wpsml-media")
						.addTo(controller);
			// show indicators (requires debug extension)
			scenes[thisId + "media"].addIndicators();
		}
		
		if( trim != false ) {
			tweens[thisId + "trim"] = new TimelineMax().add([ TweenMax.to("#section-" + thisId + " .cAc_wpsml-trim", 1000, {top: "-40%", ease: Linear.easeNone}) ]);
			scenes[thisId + "trim"] = new ScrollMagic.Scene({triggerElement: "#" + thisId + " .cAc_wpsml-trim", duration: 2000, offset: 0})
						// .setTween(tweens[thisId])
						.setPin("#" + thisId + " .cAc_wpsml-trim")
						.addTo(controller);
			// show indicators (requires debug extension)
			scenes[thisId + "trim"].addIndicators();
		}
		*/
	});	//end $('.cAc_wpsml-pageSection').each( function()
	
	$(window).resize(function () {
		
		var resize_action = cac_wpsml_bodyClass();
		
		if (resize_action) {

			if (typeof('waitForFinalEvent') == 'function') {
		
				waitForFinalEvent( function() {
					$('.cAc_wpsml-pageSection').each( function() {
		
						var thisId = $(this).attr('id'),
						$bg = false;
						$mg = ((resize_action % 11) ? (this).find('.cAc_wpsml-mg') : false),
						$content = false,
						$media = ((resize_action !== 31 && resize_action > 20) ? $(this).find('.cAc_wpsml-media') : false),
						$trim = ((resize_action > 30) ? $(this).find('.cAc_wpsml-trim') : false);
						loadSectionScene( thisId, $bg, mg, content, media, trim );
			
					});
		
				});
		
			}
		}
	});
	
	if ($('.cAc_wpsml-content').length > 0) {
	
		$('.cAc_wpsml-content').each( function() {
		
			$(this).find('h1').addClass('benefit');
			$(this).find('h2').addClass('ingredients');
			$(this).find('h3').addClass('need-state');
			$(this).find('a').addClass('btn');
		
		});
	
	}

});	//end jQuery(function($)

//load the content for each scene based on viewport width and whether content exists (existence determined in shortcode)
function loadSectionScene( id, bg, mg, content, media, trim ) {

	if (!id) {
		return false;
	}
	
	if (typeof 'cAc_wpsmlViewport' == 'undefined') {
		var cAc_wpsmlViewport;
	}

	
	if (cAc_wpsmlViewport == null || cAc_wpsmlViewport == '') {
		var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
		cAc_wpsmlViewport = { width:x, height:y };
	}
	
	cac_wpsml_bodyClass(cAc_wpsmlViewport, breakpoints);
	
	var toFetch = {
		'bg':		true,
		'mg':		false,
		'content':	true,
		'media':	false,
		'trim':		false
	};
	
	var faLoader = '<div class="loading-content"><i class="fa fa-circle-o-notch fa-spin"></i></div>';
	
	//don't fetch empty bg
	if (bg) {
		bg.append(faLoader);
	}
	else {
		toFetch.bg = false;
	}
	
	//only fetch midground if exists and above small breakpoint
	if (mg && cAc_wpsmlViewport.width > breakpoints.sm) {
		toFetch.mg = true;
		mg.append(faLoader);
	}
	
	//don't fetch empty content
	if (content) {
		content.append(faLoader);
	}
	else {
		toFetch.content = false;
	}
	
	//only fetch media if exists and above medium breakpoint
	if (media != false && cAc_wpsmlViewport.width > breakpoints.md) {
		toFetch.media = true;
		media.append(faLoader);
	}
	
	//only fetch trim if exists and above large breakpoint
	if (trim && cAc_wpsmlViewport.width > breakpoints.lg) {
		toFetch.trim = true;
		trim.append(faLoader);
	}
	
	if (typeof 'cAc_wpsml_vars' != undefined) {
	
		if (cAc_wpsml_vars.handler == false) {
			$('.loading-content').remove();
			return false;
		}
		else {
			
			jQuery.ajax({
			
				url:		cAc_wpsml_vars.handler,
				type: 		'post',
				data:		{
							'action':	'cAc_wpsml_load_section',
							'id':		id.replace('section-', ''),
							'bg':		toFetch.bg,
							'mg':		toFetch.mg,
							'content':	toFetch.content,
							'media':	toFetch.media,
							'trim':		toFetch.trim,
				},
				success: 	function(response) {
				
					var responseObj = JSON.parse( response );
					if( toFetch.bg ) {
// 						var cWidth = cAc_wpsmlViewport.width;
						// if (cWidth > breakpoints.lg) {
// 							cWidth = breakpoints.lg;
// 						}
						var cWidth = breakpoints.lg;//all triangles just need to be 1240; no need to retriangle
						bg.prepend( triangle( cWidth, responseObj.bg, 'top' ) );
						bg.append( triangle( cWidth, responseObj.bg, 'bottom' ) );
					}
					if( toFetch.mg ) {
						mg.append( responseObj.mg );
					}
					if( toFetch.content ) {
						content.append( responseObj.content );
					}
					if( toFetch.media ) {
						media.append( responseObj.media );
					}
					if( toFetch.trim ) {
						trim.append( responseObj.trim );
					}
					console.log( responseObj );
					jQuery('#' + id + ' .loading-content').fadeOut( 500, function() {
				
						jQuery('#' + id + ' .loading-content').remove();
					
					});
					
				}
			
			});
		
		}
		
	}
	else {
		return false;
	}
	
	return true; 

}	//end loadSectionScene( id )


function cac_wpsml_bodyClass( cAc_wpsmlViewport, breakpoints ) {

	var sizeWas = 3;
	var sizeIs = 0;
	$body = jQuery('body');
	
	if (!document.body.classList.contains('bkpt-lg')) {
		sizeWas = 2;
		if (!document.body.classList.contains('bkpt-md')) {
			sizeWas = 1;
			if (!document.body.classList.contains('bkpt-sm')) {
				sizeWas = 0;
			}
		}
	}
	
	if (cAc_wpsmlViewport.width >= breakpoints.sm) {
		$body.addClass('bkpt-sm');
		sizeIs = 1;
		if (cAc_wpsmlViewport.width >= breakpoints.md) {
			$body.addClass('bkpt-md');
			sizeIs = 2;
			if (cAc_wpsmlViewport.width >= breakpoints.lg) {
				$body.addClass('bkpt-lg');
				sizeIs = 3;
			}
		}
	}
	
	if ((sizeIs - sizeWas) < 1) {
		return false;
	}
	//returns two digit number representing what to load
	return( ((sizeIs).toString() + (sizeIs - sizeWas).toString()).valueOf() );

}