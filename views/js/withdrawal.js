
/*=============================================
LOAD DYNAMIC PartS TABLE
=============================================*/

// $.ajax({

//     url: "ajax/datatable-withdrawal.ajax.php",
    
// 	success:function(answer){
		
// 		console.log("answer", answer);

// 	}

// })

$('.tableWithdrawal').DataTable( {

    "ajax": "ajax/datatable-withdrawal.ajax.php",
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
    
});

/*=============================================
Adding Parts
=============================================*/

$(".tableWithdrawal tbody").on("click", "button.addPartsButton", function(){

    var idPart = $(this).attr("idPart");

    // console.log("idPart", idPart);
    
    $(this).removeClass("btn-primary addPartsButton");
    $(this).addClass("btn-default");

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
            // console.log("answer", answer)

            var description = answer["description"];
          	var stock = answer["stock"];
            var price = answer["sellingPrice"];

            /*=============================================
          	If stock = 0
              =============================================*/
              
              if(stock == 0){

                swal({
                    title: "There's no stock available",
                    type: "error",
                    confirmButtonText: "¡Close!"
                  });
  
                  
                  $("button[idPart='"+idPart+"']").addClass("btn-primary addPartsButton");
  
                  return;
              }

            $(".newPart").append(

            '<div class="row" style="padding:5px 15px">'+

                    '<!-- Parts Description -->'+

                    '<div class="col-xs-6" style="padding-right:0px">'+

                        '<div class="input-group">'+

                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removePart" idPart="'+idPart+'"><i class="fa fa-times"></i></button></span>'+              

                            '<input type="text" class="form-control newPartDescription" idPart="'+idPart+'" name="addPartsButton" value="'+description+'" readonly required>'+

                        '</div>'+

                    '</div>'+

                    '<!-- Parts Quantity -->  '+

                    '<div class="col-xs-3">'+
                        '<input type="number" class="form-control newPartQty" name="newPartQty" min="1" value="1" stock="'+stock+'" required>'+
                    '</div>'+

                    '<!-- Parts Price -->  '+
                    '<div class="col-xs-3" style="padding-left:0px">'+
                        '<div class="input-group" >'+
                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                            '<input type="text" class="form-control newPartPrice" name="newPartPrice" value="'+price+'" readonly required>'+
                        '</div>'+
                    '</div>'+

            '</div>')
        }
    })
});

/*=============================================
Load table at all time during tab surf
=============================================*/

$(".tableWithdrawal").on("draw.dt", function(){

    if(localStorage.getItem("removePart") != null){ 

        var listIdParts = JSON.parse(localStorage.getItem("removePart"));

        for(var i = 0; i < listIdParts.length; i++){

			$("button.recoverButton[idPart='"+listIdParts[i]["idPart"]+"']").removeClass('btn-default');
			$("button.recoverButton[idPart='"+listIdParts[i]["idPart"]+"']").addClass('btn-primary addPartsButton');

        }

    }
})

/*=============================================
Removing Parts
=============================================*/

var idRemovePart = [];

localStorage.removeItem("removePart");

$(".formWithdrawal").on("click", "button.removePart", function(){
    
    $(this).parent().parent().parent().parent().remove();

    var idPart = $(this).attr("idPart");
    
    /*======================================================
    Store the id of the item to be deleted in local storage
    =======================================================*/

    if(localStorage.getItem("removePart") == null){

        idRemovePart = [];

    } else {
        idRemovePart.concat(localStorage.getItem("removePart"))
    }

    idRemovePart.push({"idPart":idPart})

    localStorage.setItem("removePart", JSON.stringify(idRemovePart));

    $("button.recoverButton[idPart='"+idPart+"']").removeClass('btn-default');

    $("button.recoverButton[idPart='"+idPart+"']").addClass('btn-primary addPartsButton');

});

/*===================================================
Add Parts Using the Hidden Button during tablet mode
===================================================*/

$(".btnAddPart").click(function(){

    var data = new FormData();
    data.append("getParts", "ok");


    $.ajax({

        url:"ajax/parts.ajax.php",
      	method: "POST",
      	data: data,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(answer){

            // console.log("answer", answer)

            $(".newPart").append(

                '<div class="row" style="padding:5px 15px">'+
    
                        '<!-- Parts Description -->'+
    
                        '<div class="col-xs-6" style="padding-right:0px">'+
    
                            '<div class="input-group">'+
    
                                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removePart"><i class="fa fa-times"></i></button></span>'+              
    
                                '<select class="form-control newPartDescription" idPart name="newPartDescription" required>'+

                                '<option>Select Part</option>'+

                                '</select>'+
    
                            '</div>'+
    
                        '</div>'+
    
                        '<!-- Parts Quantity -->  '+
    
                        '<div class="col-xs-3 enterQuantity">'+
                            '<input type="number" class="form-control newPartQty" name="newPartQty" min="1" value="1" required>'+
                        '</div>'+
    
                        '<!-- Parts Price -->  '+
                        '<div class="col-xs-3 enterPrice" style="padding-left:0px">'+
                            '<div class="input-group" >'+
                                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                                '<input type="text" class="form-control newPartPrice" name="newPartPrice" value="" readonly required>'+
                            '</div>'+
                        '</div>'+
                '</div>')

                answer.forEach(functionforEach);

                function functionforEach(item, index){

                    $(".newPartDescription").append(

						'<option idProduct="'+item.id+'" value="'+item.description+'">'+item.description+'</option>'
		         	)

                }

        }
    })
})

/*=============================================
Selecting Parts
=============================================*/


$(".formWithdrawal").on("change", "select.newPartDescription", function(){

    var partName = $(this).val();

    // var newProductDescription = $(this).parent().parent().parent().children().children().children(".newProductDescription");

	var newPartPrice = $(this).parent().parent().parent().children(".enterPrice").children().children(".newPartPrice");

	// var newPartQty = $(this).parent().parent().parent().children(".enterQuantity").children(".newPartQty");

    var data = new FormData;

    
    data.append("partName", partName);

	  $.ajax({

     	url:"ajax/parts.ajax.php",
      	method: "POST",
      	data: data,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(answer){
              
            // $(".newPartDescription").attr("idPart", answer["id"]);
            // $(".newPartQty").attr("stock", answer["stock"]);
            // $(".newPartQty").attr("newStock", Number(answer["stock"])-1);
            $(".newPartPrice").val(answer["sellingPrice"]);
            // $(".newPartPrice").attr("realPrice", answer["sellingPrice"]);
            // $(newPartPrice).attr("realPrice", answer["sellingPrice"]);
            $(newPartPrice).val(answer["sellingPrice"]);


      	}

      })

})
