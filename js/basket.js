$(".buy-item .add-button").click(function(){
	var id = $("img", this).data("id");

	$.ajax({
	  method: "POST",
	  url: "ajax/basket-add.php",
	  dataType: 'json',
	  data: { lot: id }

	}).done(function( data ) {

		if(data.success == "ok"){
			$("#basket-quantity").text(data.quantity);
			$("#basket-total").text(data.total);
		}

	});
});


$("a.btn-danger").click(function(e){
	e.preventDefault();
	$.ajax({
	  method: "POST",
	  url: "ajax/basket-remove.php",
	  dataType: 'json'

	}).done(function( data ) {
		if(data.success == "ok"){
			$("tr[data-id]").remove();
			$("#basket-quantity").text(data.quantity);
			$("#basket-total").text(data.total);
		}
	});
});

$(".basket-table .glyphicon-trash").click(function(){
	var tr = $(this).parents("tr");
	var id = tr.data("id");

	$.ajax({
	  method: "POST",
	  url: "ajax/basket-remove.php",
	  dataType: 'json',
	  data: { lot: id }

	}).done(function( data ) {
		if(data.success == "ok"){
			tr.remove();
			$("#basket-quantity").text(data.quantity);
			$("#basket-total").text(data.total);
		}

	});
});