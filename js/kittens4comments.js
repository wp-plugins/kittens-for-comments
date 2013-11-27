jQuery(document).ready(function($) {
var kittenShown = false;

    $('#commentform').submit( function(e) {
        if ( !(kittenShown) ) {
            e.preventDefault();
            $.fancybox({
                href: kittenPic,
                title: "Thanks for your comment! Here's your kitten.",
                closeClick: true,
                type: "image",
                afterClose: function(){
                    kittenShown = true;
                    HTMLFormElement.prototype.submit.call($('#commentform')[0]);
                }
            });
            return false;
        }
    });

    //waypoint stuff
	$('#commentform').waypoint(function() {
 	$('.kittenpanel').show(400);
	}, { offset: '110%' })


});