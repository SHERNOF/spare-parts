
/*=============================================
LOAD DYNAMIC PRODUCTS TABLE
=============================================*/

$.ajax({

	url: "ajax/datatable-parts.ajax.php",
	success:function(answer){
		
		console.log("answer", answer);

	}

})

$('.tableProducts').DataTable( {
	"ajax": "ajax/datatable-parts.ajax.php"
} );
