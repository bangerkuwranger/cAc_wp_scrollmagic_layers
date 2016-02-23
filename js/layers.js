var controller,
tweens = {},
scenes = {};

jQuery(function($) {
	
	controller = new ScrollMagic.Controller();
	$('.cAc_wpsml-pageSection').each( function() {
	
		var thisId = $(this).attr('id'),
		$bg = $(this).find('.cAc_wpsml-bg'),
		$mg = $(this).find('.cAc_wpsml-mg'),
		$content = $(this).find('.cAc_wpsml-content'),
		$media = $(this).find('.cAc_wpsml-media'),
		$trim = $(this).find('.cAc_wpsml-trim');
		
		tweens[thisId] = new TimelineMax().add([
	
			TweenMax.to("#section-" + thisId + " .cAc_wpsml-bg", 1000, {top: "-40%", ease: Linear.easeNone}),
			TweenMax.to("#section-" + thisId + " .cAc_wpsml-mg", 1200, {top: "-50%", ease: Linear.easeNone}),
			TweenMax.to("#section-" + thisId + " .cAc_wpsml-content", 768, {top: "-25%", ease: Linear.easeNone}),
			TweenMax.to("#section-" + thisId + " .cAc_wpsml-media", 300, {top: "-60%", ease: Linear.easeNone}),
			TweenMax.to("#section-" + thisId + " .cAc_wpsml-trim", 250, {top: "-80%", ease: Linear.easeNone})
	
		]);	//end new TimelineMax ()
		
		scenes[thisId + "bg"] = new ScrollMagic.Scene({triggerElement: "#" + thisId + " .cAc_wpsml-bg", duration: 1000, offset: 0})
						// .setTween(tweens[thisId])
						.setPin("#" + thisId + " .cAc_wpsml-bg")
						.addTo(controller);
		scenes[thisId + "mg"] = new ScrollMagic.Scene({triggerElement: "#" + thisId + " .cAc_wpsml-mg", duration: 2000, offset: 50})
						// .setTween(tweens[thisId])
						.setPin("#" + thisId + " .cAc_wpsml-mg")
						.addTo(controller);
		scenes[thisId + "content"] = new ScrollMagic.Scene({triggerElement: "#" + thisId + " .cAc_wpsml-content", duration: 768, offset: 760})
						// .setTween(tweens[thisId])
						.setPin("#" + thisId + " .cAc_wpsml-content")
						.addTo(controller);
		scenes[thisId + "media"] = new ScrollMagic.Scene({triggerElement: "#" + thisId + " .cAc_wpsml-media", duration: 200, offset: 0})
						// .setTween(tweens[thisId])
						.setPin("#" + thisId + " .cAc_wpsml-media")
						.addTo(controller);

		// show indicators (requires debug extension)
		scenes[thisId + "bg"].addIndicators();
		scenes[thisId + "mg"].addIndicators();
		scenes[thisId + "content"].addIndicators();
		scenes[thisId + "media"].addIndicators();
		
	});	//end $('.cAc_wpsml-pageSection').each( function()

});	//end jQuery(function($)

function sectionScene( id ) {

	if (!id) {
		return false;
	}
	
	
	return true; 

}	//end sectionController( id )