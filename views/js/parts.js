
/*=============================================
LOAD DYNAMIC PRODUCTS TABLE
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-parts.ajax.php",
// 	success:function(answer){
		
// 		console.log("answer", answer);

// 	}

// })

$('.tableProducts').DataTable( {
    "ajax": "ajax/datatable-parts.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {
        "sEmptyTable":     "No data available in table",
        "sInfo":           "Showing _START_ to _END_ of _TOTAL_ entries",
        "sInfoEmpty":      "Showing 0 to 0 of 0 entries",
        "sInfoFiltered":   "(filtered from _MAX_ total entries)",
        "sInfoPostFix":    "",
        "sInfoThousands":  ",",
        "sLengthMenu":     "Show _MENU_ entries",
        "sLoadingRecords": "Loading...",
        "sProcessing":     "Processing...",
        "sSearch":         "Search:",
        "sZeroRecords":    "No matching records found",
        "oPaginate": {
            "sFirst":    "First",
            "sLast":     "Last",
            "sNext":     "Next",
            "sPrevious": "Previous"
        },
        "oAria": {
            "sSortAscending":  ": activate to sort column ascending",
            "sSortDescending": ": activate to sort column descending"
        }
    }
    
} );

/*=============================================
LOAD DYNAMIC PRODUCTS TABLE
=============================================*/

$("#newCategory").change(function(){
    var idCategory = $(this).val()
    DataCue.append("idCategory", idCategory);

    $.ajax({
        url:"ajax/parts.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(answer) {

            console.log("answer", answer);
            // if(answer){

                // $("#newCategory").parent().after('<div class="alert alert-warning">This category is already been used</div>')
                // $("#newCategory").val("");
            // }
        }
    })
})