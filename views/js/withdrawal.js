
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
                        '<input type="number" class="form-control newPartQty" name="newPartQty" min="1" value="1" stock="'+stock+'" newStock="'+Number(stock-1)+'" required>'+
                    '</div>'+

                    '<!-- Parts Price -->  '+
                    '<div class="col-xs-3 enterPrice" style="padding-left:0px">'+
                        '<div class="input-group" >'+
                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                            '<input type="text" class="form-control newPartPrice" name="newPartPrice" realPrice="'+price+'" value="'+price+'" readonly required>'+
                        '</div>'+
                    '</div>'+
            '</div>')

            
            // Adding total Prices
            addingTotalPrices();

             // GROUP PRODUCTS IN JSON FORMAT

            listParts();
            
            // Adding Tax
            addTax();

            // Product Price format
             $(".newPartPrice").number(true, 2);


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

    if($(".newPart").children().length == 0){


        $("#newTaxSale").val(0);
        $("#newPartsTotalSell").val(0);
        $("#newPartsTotalSell").attr("totalSale",0);

    } else {

        /*=============================================
        Adding total Prices
        =============================================*/

        addingTotalPrices();

        /*=============================================
        Adding Tax
        =============================================*/
        addTax();

        // GROUP PRODUCTS IN JSON FORMAT

        listParts()

    }
});

/*===================================================
Add Parts Using the Hidden Button during tablet mode
===================================================*/
var numPart = 0;

$(".btnAddPart").click(function(){

    numPart ++;

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

                '<!-- Product description -->'+
                
                '<div class="col-xs-6" style="padding-right:0px">'+
                
                  '<div class="input-group">'+
                    
                    '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removePart" idPart><i class="fa fa-times"></i></button></span>'+

                    '<select class="form-control newPartDescription" id="part'+numPart+'" idPart name="newPartDescription" required>'+

                    '<option>Select Part</option>'+

                    '</select>'+  

                  '</div>'+

                '</div>'+

                '<!-- Product quantity -->'+

                '<div class="col-xs-3 enterQuantity">'+
                  
                   '<input type="number" class="form-control newPartQty" name="newPartQty" min="1" value="1" newStock required>'+

                '</div>' +

                '<!-- Product price -->'+

                '<div class="col-xs-3 enterPrice" style="padding-left:0px">'+

                  '<div class="input-group">'+

                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                       
                    '<input type="text" class="form-control newPartPrice" realPrice="" min="1" name="newPartPrice" readonly required>'+
       
                  '</div>'+
                   
                '</div>'+

              '</div>');

                answer.forEach(functionforEach);

                function functionforEach(item, index){

                    if(item.stock != 0){

                        $("#part"+numPart).append(

                            '<option idPart="'+item.id+'" value="'+item.description+'">'+item.description+'</option>'
                         )
                    }
                }

            /*=============================================
            Adding total Prices
            =============================================*/

            addingTotalPrices();

            /*=============================================
            Adding Tax
            =============================================*/
            addTax();

            $(".newPartPrice").number(true, 2);

        }
    })
})

/*=============================================
Selecting Parts
=============================================*/


$(".formWithdrawal").on("change", "select.newPartDescription", function(){

    var partName = $(this).val();

    var newPartDescription = $(this).parent().parent().parent().children().children().children(".newProductDescription");

    var newPartPrice = $(this).parent().parent().parent().children(".enterPrice").children().children(".newPartPrice");

	var newPartQty = $(this).parent().parent().parent().children(".enterQuantity").children(".newPartQty");

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
              
            $(newPartDescription).attr("idPart", answer["id"]);
            $(newPartQty).attr("stock", answer["stock"]);
            $(newPartQty).attr("newStock", Number(answer["stock"])-1);
            $(newPartPrice).val(answer["sellingPrice"]);
            $(newPartPrice).attr("realPrice", answer["sellingPrice"]);

            // GROUP PRODUCTS IN JSON FORMAT

            listParts();


      	}

      })

})

/*=============================================
Modify the quanrtity and auto adjust price
=============================================*/

$(".formWithdrawal").on("change", "input.newPartQty", function(){

   var price = $(this).parent().parent().children(".enterPrice").children().children(".newPartPrice");
//    console.log("newPartPrice", newPartPrice)

    var finalPrice = $(this).val() * price.attr("realPrice");
        
    price.val(finalPrice);

    var newStock = Number($(this).attr("stock")) - $(this).val();

    $(this).attr("newStock", newStock);

    if(Number($(this).val()) >  Number($(this).attr("stock"))){

        /*==========================================================
		IF QUANTITY IS MORE THAN THE STOCK VALUE SET INITIAL VALUES
		===========================================================*/

        $(this).val(1);

        var finalPrice = $(this).val() * price.attr("realPrice");

        price.val(finalPrice);

     // ADDING TOTAL PRICES
        addingTotalPrices();

        swal({
            title: "The quantity is more than your stock",
            text: "¡There's only"+$(this).attr("stock")+" units!",
            type: "error",
            confirmButtonText: "Close!"
          });
  
          return;
    }


      // ADDING TOTAL PRICES
        addingTotalPrices();

      // Add Tax
        addTax();

        // GROUP PRODUCTS IN JSON FORMAT

        listParts();

})

/*============================================
PRICES ADDITION
=============================================*/

function addingTotalPrices(){

	var priceItem = $(".newPartPrice");
	var arrayAdditionPrice = [];  

	for(var i = 0; i < priceItem.length; i++){

		 arrayAdditionPrice.push(Number($(priceItem[i]).val()));
		 
    }
    
    // console.log("arrayAdditionPrice", arrayAdditionPrice)

	function additionArrayPrices(totalSale, numberArray){

		return totalSale + numberArray;

	}

    var addingTotalPrice = arrayAdditionPrice.reduce(additionArrayPrices);
    
    $("#newPartsTotalSell").val(addingTotalPrice);
    $("#saleTotal").val(addingTotalPrice);
	$("#newPartsTotalSell").attr("totalSale",addingTotalPrice);


}

/*=============================================
ADD TAX
=============================================*/

function addTax(){

	var tax = $("#newTaxSale").val();

	var totalPrice = $("#newPartsTotalSell").attr("totalSale");

	var taxPrice = Number(totalPrice * tax/100);

	var totalwithTax = Number(taxPrice) + Number(totalPrice);
	
	$("#newPartsTotalSell").val(totalwithTax);

	$("#saleTotal").val(totalwithTax);

	$("#newTaxPrice").val(taxPrice);

	$("#newNetPrice").val(totalPrice);

}

/*=============================================
WHEN TAX CHANGES
=============================================*/

$("#newTaxSale").change(function(){

	addTax();

});

   // Product Price format
   $("#newPartsTotalSell").number(true, 2);


   /*=============================================
WHEN TAX CHANGES
=============================================*/

$("#newTaxSale").change(function(){

	addTax();

});

/*=============================================
FINAL PRICE FORMAT
=============================================*/

$("#newSaleTotal").number(true, 2);

/*=============================================
SELECT PAYMENT METHOD
=============================================*/

$("#newPaymentMethod").change(function(){

	var method = $(this).val();

	if(method == "cash"){

		$(this).parent().parent().removeClass("col-xs-6");

		$(this).parent().parent().addClass("col-xs-4");

		$(this).parent().parent().parent().children(".paymentMethodBoxes").html(

			 '<div class="col-xs-4">'+ 

			 	'<div class="input-group">'+ 

			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

			 		'<input type="text" class="form-control" id="newCashValue" placeholder="000000" required>'+

			 	'</div>'+

			 '</div>'+

			 '<div class="col-xs-4" id="getCashChange" style="padding-left:0px">'+

			 	'<div class="input-group">'+

			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

			 		'<input type="text" class="form-control" id="newCashChange" placeholder="000000" readonly required>'+

			 	'</div>'+

			 '</div>'

		 )

		// Adding format to the price

		$('#newCashValue').number( true, 2);
      	$('#newCashChange').number( true, 2);


      	// List method in the entry
    //   	listMethods()

	}else{

		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.paymentMethodBoxes').html(

		 	'<div class="col-xs-6" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="number" min="0" class="form-control" id="newTransactionCode" placeholder="Transaction code"  required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

              '</div>')

	}
})


/*=============================================
CASH CHANGE
=============================================*/
$(".formWithdrawal").on("change", "input#newCashValue", function(){
	
	var cash = $(this).val();

	var change =  Number(cash) - Number($('#newPartsTotalSell').val());

	var newCashChange = $(this).parent().parent().parent().children('#getCashChange').children().children('#newCashChange');

	newCashChange.val(change);

})

/*=============================================
LIST ALL THE PARTS
=============================================*/

function listParts(){

	var listParts = [];

	var description = $(".newPartDescription");

	var quantity = $(".newPartQty");

	var price = $(".newPartPrice");

	for(var i = 0; i < description.length; i++){

		listParts.push({ "id" : $(description[i]).attr("idPart"), 
							  "description" : $(description[i]).val(),
							  "quantity" : $(quantity[i]).val(),
							  "stock" : $(quantity[i]).attr("newStock"),
							  "price" : $(price[i]).attr("realPrice"),
							  "totalPrice" : $(price[i]).val()})
	}

    // console.log("listParts", listParts)
	$("#partsList").val(JSON.stringify(partsList)); 

}
