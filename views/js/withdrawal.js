
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

$(".tableWithdrawal").on("click", "button.addPartsButton", function(){

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

            $(".newPart").append(

            '<div class="row" style="padding:5px 15px">'+

                    '<!-- Parts Description -->'+

                    '<div class="col-xs-6" style="padding-right:0px">'+
                        '<div class="input-group">'+
                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removePartButton" idPart="'+idPart+'"><i class="fa fa-times"></i></button></span>'+              
                            '<input type="text" class="form-control newPartDescription" idPart="addPart" name="addPart" value="'+description+'" readonly required>'+
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

// $(".tableWithdrawal").on("draw.dt", function(){
//     if(localStorage.getItem("removePartButton")!= null){ 

//         var (listIdPart = JSON.parse(localStorage.getItem("removePartButton")));

//         for(var i = 0; i < listIdPart.length; i++){
//             $("button.recoverButton[idPart='"+listIdPart[i]["idPart"]+"']").removeClass('btn-default');
//             $("button.recoverButton[idPart='"+listIdPart[i]["idPart"]+"']").addClass('btn-primary addPart');
//         }

//     }
// })

/*=============================================
Removing Parts
=============================================*/

$(".formulaWithdrawal").on("click", "button.removePartButton", function(){
    
    $(this).parent().parent().parent().parent().remove();

    var idPart = $(this).attr("idPart");
    
    /*======================================================
    Store the id of the item to be deleted in local storage
    =======================================================*/

    if(localStorage.getItem("removePartButton") == null){

        idremovePartButton = [];

    } else {
        idremovePartButton.concat(localStorage.getItem("removePartButton"))
    }

    idremovePartButton.push({"idPart":idPart})

    localStorage.setItem("removePartButton", JSON.stringify(idremovePartButton));

    $("button.recoverButton[idPart='"+idPart+"']").removeClass('btn-default');

    $("button.recoverButton[idPart='"+idPart+"']").addClass('btn-primary addPart');

});

