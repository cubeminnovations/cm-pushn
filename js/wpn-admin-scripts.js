jQuery(document).ready(function(){

	jQuery('.wpn-count-up').each(function( index, item ){
		jQuery(item).keyup(function(){
			var countspan = jQuery(item).parent().find('.countUP');
			var caracter_count = jQuery(item).val().length;
			countspan.text(caracter_count);
		});
	});

	jQuery('#submit-notification').click(function( evt ){

		$validated = false;

		if ( jQuery('#wpn-notification-title').val() == '' ) { 
			$validated = true;
			jQuery('#wpn-notification-title').addClass('wpn-error');
		}

		if ( jQuery('#wpn-notification-body').val() == '' ) { 
			$validated = true;
			jQuery('#wpn-notification-body').addClass('wpn-error');
		}

		if ( !validateURL(jQuery('#wpn-notification-url').val()) ) { 
			$validated = true;
			jQuery('#wpn-notification-url').addClass('wpn-error');
		}

		if ( $validated ) { return false; };

	});

	jQuery('#form-push-notification').on( 'click', '.wpn-error', function(){
		jQuery(this).removeClass('wpn-error');
	});
	

});

function validateURL(textval) {
    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
    return regexp.test(textval);
}