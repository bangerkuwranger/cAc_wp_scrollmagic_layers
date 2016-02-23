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

jQuery(function($) {
	
	controller = new ScrollMagic.Controller();
	$('.cAc_wpsml-pageSection').each( function() {
	
		
		var thisId = $(this).attr('id'),
		$bg = $(this).find('.cAc_wpsml-bg'),
		$mg = $(this).find('.cAc_wpsml-mg'),
		$content = $(this).find('.cAc_wpsml-content'),
		$media = $(this).find('.cAc_wpsml-media'),
		$trim = $(this).find('.cAc_wpsml-trim');
		
		if( $bg.length() > 0 ) {
			var bg = $bg;
		}
		else {
			var bg = false;
		}
		
		if( $mg.length() > 0 ) {
			var mg = $mg;
		}
		else {
			var mg = false;
		}
		
		if( $content.length() > 0 ) {
			var content = $content;
		}
		else {
			var content = false;
		}
		
		if( $media.length() > 0 ) {
			var media = $media;
		}
		else {
			var media = false;
		}
		
		if( $trim.length() > 0 ) {
			var trim = $trim;
		}
		else {
			var trim = false;
		}
		
		loadSectionScene( thisId, bg, mg, content, media, trim );
		
		//tweens & scenes (tweens currently commented out)
	
		if( bg != false ) {
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
		
	});	//end $('.cAc_wpsml-pageSection').each( function()

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
		toFetch.bg = false;
	}
	else {
		bg.append(faLoader);
	}
	
	//only fetch midground if exists and above small breakpoint
	if (mg != false && cAc_wpsmlViewport.width > breakpoints.sm) {
		toFetch.mg = true;
		mg.append(faLoader);
	}
	
	//don't fetch empty content
	if (content == false) {
		toFetch.content = false;
	}
	else {
		content.append(faLoader);
	}
	
	//only fetch media if exists and above medium breakpoint
	if (media != false && cAc_wpsmlViewport.width > breakpoints.md) {
		toFetch.media = true;
		media.append(faLoader);
	}
	
	//only fetch trim if exists and above large breakpoint
	if (trim != false && cAc_wpsmlViewport.width > breakpoints.lg) {
		toFetch.trim = true;
		trim.append(faLoader);
	}
	
	if (typeof 'cAc_wpsml_vars' != 'undefined') {
	
		if (cac_wpsml_vars.handler == false) {
			$('.loading-content').remove();
			return false;
		}
		else {
		
			$.ajax({
			
				url:		cac_wpsml_vars.handler,
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
				
					console.log( JSON.parse( response ) );
					$('#' + id + ' .loading-content').fadeOut();
					$('#' + id + ' .loading-content').remove();
				}
			
			});
		
		}
		
	}
	else {
		return false;
	}
	
	return true; 

}	//end loadSectionScene( id )