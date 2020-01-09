
/*=============================================
LOAD DYNAMIC PartS TABLE
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-parts.ajax.php",
// 	success:function(answer){
		
// 		console.log("answer", answer);

// 	}

// })

// $('.productsTable').DataTable( {
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

/*====================================
=   Uploading Parts Photo           =
====================================*/


$(".newPicParts").change(function(){

    var newImage = this.files[0];

    /*====================================
    =        Validate file format        =
    ====================================*/

    if (newImage["type"] != "image/jpeg" && newImage["type"] != "image/png"){
        $(".newPicParts").val("");

        swal ({
            type: "error",
			title: "Error uploading image",
			text: "¡Image has to be JPEG or PNG!",
			showConfirmButton: true,
			confirmButtonText: "Close"
        });

    } else if (newImage["size"] > 2000000){
        $(".newPicParts").val("");
        swal ({
            type: "error",
			title: "Error uploading image",
			text: "¡Image too big. It has to be less than 2Mb!",
			showConfirmButton: true,
			confirmButtonText: "Close"
        });
    } else {
        var dataImage = new FileReader;
        dataImage.readAsDataURL(newImage);
        $(dataImage).on("load", function(event){
            var routeImage = event.target.result;
            $(".preview").attr("src", routeImage)
        });
    }

})


 
/*=============================================
Edit Parts
=============================================*/

$(".partsTable tbody").on("click", "button.btnEditPart", function(){

	var idPart = $(this).attr("idPart");
	
	var data = new FormData();
    data.append("idPart", idPart);

     $.ajax({

      url:"ajax/parts.ajax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(answer){
        
        console.log("answer", answer);
          
        var categoryData = new FormData();
        categoryData.append("idCategory",answer["idCategory"]);

         $.ajax({

            url:"ajax/categories.ajax.php",
            method: "POST",
            data: categoryData,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success:function(answer){
                
                $("#editCategory").val(answer["id"]);
                $("#editCategory").html(answer["Category"]);

            }
        })

         $("#editCode").val(answer["code"]);

         $("#editDescription").val(answer["description"]);

         $("#editStock").val(answer["stock"]);

         $("#editBuyingPrice").val(answer["buyingPrice"]);

         $("#editSellingPrice").val(answer["sellingPrice"]);

         if(answer["image"] != ""){

       	    $("#currentImage").val(answer["image"]);

       	    $(".preview").attr("src",  answer["image"]);

         }

      }

  })

})