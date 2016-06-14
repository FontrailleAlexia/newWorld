$("#postalcode").autocomplete({
  source: function( request, response ) {
    		$.ajax({
    			url : 'ajax/zonage.php',
    			dataType: "json",
    			method: 'get',
    			data: {
    				term: request.term
    			},
    			success: function( data ) {
    				response($.map(data, function(item){
    					return {
    						value: item.postalcode,
    						label: item.label,
    						data: item
    					}
    				}));
    			}
    		});
    	},
  minLength: 1,
	select: function( event, ui ) {
		$(this).val(ui.item.data.postalcode);
		$("#city").val(ui.item.data.city);
	}	
});