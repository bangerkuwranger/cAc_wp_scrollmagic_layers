var controller,
tweens = {},
scenes = {};

$(function() {
	
	$('.cAc_wpsml-pageSection').each( function() {
	
		var thisId = $(this).attr('id'),
		$bg = $(this).find('.cAc_wpsml-bg'),
		$mg = $(this).find('.cAc_wpsml-mg'),
		$content = $(this).find('.cAc_wpsml-content'),
		$media = $(this).find('.cAc_wpsml-media'),
		$trim = $(this).find('.cAc_wpsml-trim');
		
		tweens[id] = new TimelineMax().add([
	
			TweenMax.to("#section-" + id + ".cAc_wpsml-bg", 1, {top: "-40%", ease: Linear.easeNone}),
			TweenMax.to("#section-" + id + ".cAc_wpsml-mg", 1, {top: "-500%", ease: Linear.easeNone}),
			TweenMax.to("#section-" + id + ".cAc_wpsml-content", 1, {top: "-225%", ease: Linear.easeNone}),
			TweenMax.to("#section-" + id + ".cAc_wpsml-media", 1, {top: "-600%", ease: Linear.easeNone}),
			TweenMax.to("#section-" + id + ".cAc_wpsml-trim", 1, {top: "-800%", ease: Linear.easeNone})
	
		]);	//end new TimelineMax ()
		
		scene[id] = new ScrollScene({triggerElement: "#" + thisId, duration: 2000, offset: 450})
						.setTween(tweens[id])
						.setPin("#" + thisId)
						.addTo(controller);

		// show indicators (requires debug extension)
		scene[id].addIndicators();
		
	
	});	//end $('.cAc_wpsml-pageSection').each( function()
	
	controller = new ScrollMagic();

});	//end $(function()

function sectionScene( id ) {

	if (!id) {
		return false;
	}
	
	
	return true; 

}	//end sectionController( id )