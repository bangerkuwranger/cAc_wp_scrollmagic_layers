var controller,
tweens = {},
scenes = {};

jQuery(function($) {
	
	$('.cAc_wpsml-pageSection').each( function() {
	
		var thisId = $(this).attr('id'),
		$bg = $(this).find('.cAc_wpsml-bg'),
		$mg = $(this).find('.cAc_wpsml-mg'),
		$content = $(this).find('.cAc_wpsml-content'),
		$media = $(this).find('.cAc_wpsml-media'),
		$trim = $(this).find('.cAc_wpsml-trim');
		
		tweens[thisId] = new TimelineMax().add([
	
			TweenMax.to("#section-" + thisId + ".cAc_wpsml-bg", 1, {top: "-40%", ease: Linear.easeNone}),
			TweenMax.to("#section-" + thisId + ".cAc_wpsml-mg", 1, {top: "-500%", ease: Linear.easeNone}),
			TweenMax.to("#section-" + thisId + ".cAc_wpsml-content", 1, {top: "-225%", ease: Linear.easeNone}),
			TweenMax.to("#section-" + thisId + ".cAc_wpsml-media", 1, {top: "-600%", ease: Linear.easeNone}),
			TweenMax.to("#section-" + thisId + ".cAc_wpsml-trim", 1, {top: "-800%", ease: Linear.easeNone})
	
		]);	//end new TimelineMax ()
		
		scene[thisId] = new ScrollScene({triggerElement: "#" + thisId, duration: 2000, offset: 450})
						.setTween(tweens[thisId])
						.setPin("#" + thisId)
						.addTo(controller);

		// show indicators (requires debug extension)
		scene[thisId].addIndicators();
		
	
	});	//end $('.cAc_wpsml-pageSection').each( function()
	
	controller = new ScrollMagic();

});	//end jQuery(function($)

function sectionScene( id ) {

	if (!id) {
		return false;
	}
	
	
	return true; 

}	//end sectionController( id )