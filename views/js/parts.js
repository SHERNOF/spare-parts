
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
Add Category and increment the code
=============================================*/

$("#newCategory").change(function(){

    var idCategory = $(this).val();
    
    var data = new FormData();
    
    data.append("idCategory", idCategory);

    $.ajax({

        url:"ajax/parts.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(answer){

            if(!answer){
                var newCode = idCategory + "01";
                $("#newCode").val(newCode);
            } else {
                var newCode = Number(answer["code"]) + 1;
                $("#newCode").val(newCode);
            }

           

            // if(answer){

                // $("#newCategory").parent().after('<div class="alert alert-warning">This category is already been used</div>')
                // $("#newCategory").val("");
            // }
        }
    })
})

/*=============================================
Selling Price
=============================================*/

$("#newPriceBuy").change(function(){

    if($(".percentage").prop("checked")){

    var percentageValue = $(".newPercentage").val();
    
    var percentage = Number(($("#newPriceBuy").val()*percentageValue/100))+Number($("#newPriceBuy").val());

    $("#newPriceSell").val(percentage);
    $("#newPriceSell").prop("readonly", true);

    }
})

/*=============================================
New Percentage Change
=============================================*/

$(".newPercentage").change(function(){

    if($(".percentage").prop("checked")){

        var percentageValue = $(".newPercentage").val();
        
        var percentage = Number(($("#newPriceBuy").val()*percentageValue/100))+Number($("#newPriceBuy").val());
    
        $("#newPriceSell").val(percentage);
        $("#newPriceSell").prop("readonly", true);

    }
})

$(".percentage").on("ifUnchecked", function(){
    $("#newPriceSell").prop("readonly", false);
})

$(".percentage").on("ifChecked", function(){
    $("#newPriceSell").prop("readonly", true);
})
 


