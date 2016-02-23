jQuery(function() {

	
	if (jQuery('.set-cAc_wpsml-svg-field').length > 0) {
	
		window.send_to_editor_default = window.send_to_editor;
		var fieldID;
	
		jQuery('.set-cAc_wpsml-svg-field').click(function(e){
 
			e.preventDefault();
			fieldID = jQuery(this).attr('id');
			// replace the default send_to_editor handler function with our own
			window.send_to_editor = window.attach_image;
			var query = 'media-upload.php?post_id=' + cAcPageSectionId + '&amp;type=image&amp;TB_iframe=true';
			tb_show('', query);
			return false;
 
		});
		
		window.attach_image = function(html) {
 
			jQuery('body').append('<div id="temp_image">' + html + '</div>');

			var img = jQuery('#temp_image').find('img');

			imgSrc   = img.attr('src');
			imgClass = img.attr('class');
			imgIdClass = imgClass.split(" ").pop();
			imgId = parseInt(imgIdClass.replace('wp-image-', ''), 10);
			
			fieldID = fieldID.replace('set-', '');
			jQuery('#' + fieldID).val(imgId);
			jQuery('#remove-' + fieldID).show();

			jQuery('img.' + fieldID).html(imgSrc);

			try{tb_remove();}catch(e){};

			jQuery('#temp_image').remove();

			window.send_to_editor = window.send_to_editor_default;
		}
		
		jQuery('.remove-cAc_wpsml-svg-field').click(function(e){
 
			e.preventDefault();
			fieldID = jQuery(this).attr('id');
			fieldID = fieldID.replace('remove-', '');
			jQuery('#' + fieldID).val('');
			jQuery('img.' + fieldID).html('');
			jQuery(this).hide();
			return false;
 
		});
		
	}

});
