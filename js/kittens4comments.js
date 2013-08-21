
jQuery(document).ready(function($) {
	
	var kittenModal = false;
	$("#modal-content").overlay({onClose:
		function(){
		$('.kittenpanel').hide();
		kittenModal = true;
		//jQuery < 1.9 (i.e. the default version in WP ) has a problem with submit buttons whose name/id is 'submit', must use a workaround for it here.
		HTMLFormElement.prototype.submit.call($('#commentform')[0]);
		
		}
	});
  
    $('#commentform').submit(function(e){
	
	if( kittenModal === false ){
		$("#modal-content").overlay().load();
		return false;
		}
		else {
		return true;
		}
	});
	
//waypoint stuff

	$('#commentform').waypoint(function() {
 	$('.kittenpanel').show(400);
	}, { offset: '110%' })


});
