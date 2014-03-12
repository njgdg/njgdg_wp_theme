jQuery(document).ready(function() {
	
	if( radiateScriptParam.radiate_image_link == ''){
		var divheight = jQuery('.header-wrap').height()+'px';
		jQuery('body').css({ "margin-top": divheight });
	}

	jQuery(".header-search-icon").click(function(){
		jQuery("#masthead .search-form").toggle('slow');
	});
		
	jQuery(window).bind('scroll', function(e) {
		header_image_effect();
	});

});
  	
    	
function header_image_effect() {
	var scrollPosition = jQuery(window).scrollTop();
	jQuery('#parallax-bg').css('top', (0 - (scrollPosition * .2)) + 'px');
}	