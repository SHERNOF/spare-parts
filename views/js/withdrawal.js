/*=============================================
Variable local storage
=============================================*/

if (localStorage.getItem("captureRange") != null){

    $("#daterange-btn span").html(localStorage.getItem("captureRange"));

}else {

    $("#daterange-btn span").html('<i class="fa fa-calendar"></i> Date Range');

} 



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

             // GROUP PartS IN JSON FORMAT

            listParts();
            
            // Adding Tax
            // addTax();

            // Adding Disc
            addDisc();

            // Part Price format
             $(".newPartPrice").number(true, 2);


        }
    })
});


/*=============================================
FUNCTION TO DEACTIVATE "ADD" BUTTONS WHEN THE Part HAS BEEN SELECTED IN THE FOLDER
=============================================*/

function removeAddPartSale(){

	//We capture all the Parts' id that were selected in the sale
	var idParts = $(".removePart");

	//We capture all the buttons to add that appear in the table
	var tableButtons = $(".tableWithdrawal tbody button.addPartsButton");

	//We navigate the cycle to get the different idParts that were added to the sale
	for(var i = 0; i < idParts.length; i++){

		//We capture the IDs of the Parts added to the sale
		var button = $(idParts[i]).attr("idPart");
		
		//We go over the table that appears to deactivate the "add" buttons
		for(var j = 0; j < tableButtons.length; j ++){

			if($(tableButtons[j]).attr("idPart") == button){

				$(tableButtons[j]).removeClass("btn-primary addPartsButton");
				$(tableButtons[j]).addClass("btn-default");

			}
		}

	}
	
}

/*=============================================
EVERY TIME THAT THE TABLE IS LOADED WHEN WE NAVIGATE THROUGH IT EXECUTES A FUNCTION
=============================================*/

$('.tableWithdrawal').on( 'draw.dt', function(){

	removeAddPartSale();

})

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
        $("#totalSale").val(0);
        $("#newPartsTotalSell").attr("totalSale",0);


    } else {

        /*=============================================
        Adding total Prices
        =============================================*/

        addingTotalPrices();

        /*=============================================
        Adding Tax
        =============================================*/
        // addTax();


        addDisc();

        // GROUP PartS IN JSON FORMAT

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

                '<!-- Part description -->'+
                
                '<div class="col-xs-6" style="padding-right:0px">'+
                
                  '<div class="input-group">'+
                    
                    '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removePart" idPart><i class="fa fa-times"></i></button></span>'+

                    '<select class="form-control newPartDescription" id="part'+numPart+'" idPart name="newPartDescription" required>'+

                    '<option>Select Part</option>'+

                    '</select>'+  

                  '</div>'+

                '</div>'+

                '<!-- Part quantity -->'+

                '<div class="col-xs-3 enterQuantity">'+
                  
                   '<input type="number" class="form-control newPartQty" name="newPartQty" min="1" value="1" newStock required>'+

                '</div>' +

                '<!-- Part price -->'+

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
            // addTax();

              // Adding Disc
            addDisc();

            $(".newPartPrice").number(true, 2);

        }
    })
})

/*=============================================
Selecting Parts
=============================================*/


$(".formWithdrawal").on("change", "select.newPartDescription", function(){

    var partName = $(this).val();

    var newPartDescription = $(this).parent().parent().parent().children().children().children(".newPartDescription");

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

            // GROUP PartS IN JSON FORMAT

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
        // addTax();

          // Adding Disc
            addDisc();

        // GROUP PartS IN JSON FORMAT

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

// function addTax(){

// 	var tax = $("#newTaxSale").val();

// 	var totalPrice = $("#newPartsTotalSell").attr("totalSale");

// 	var taxPrice = Number(totalPrice * tax/100);

// 	var totalwithTax = Number(taxPrice) + Number(totalPrice);
	
// 	$("#newPartsTotalSell").val(totalwithTax);

// 	$("#saleTotal").val(totalwithTax);

// 	$("#newTaxPrice").val(taxPrice);

// 	$("#newNetPrice").val(totalPrice);

// }

/*=============================================
ADD DISCOUNT
=============================================*/

function addDisc(){

	var disc = $("#newDiscSale").val();

	var totalPrice = $("#newPartsTotalSell").attr("totalSale");

	var discPrice = Math.round(Number(totalPrice * disc/100));

	var totalwithDisc = Number(totalPrice) - Number(discPrice);
	
	$("#newPartsTotalSell").val(totalwithDisc);

	// $("#saleTotal").val(totalwithDisc);
  $("#saleTotal").val(totalPrice);

	$("#newDiscPrice").val(discPrice);

	// $("#newNetPrice").val(totalPrice);
  $("#newNetPrice").val(totalwithDisc);

}

/*=============================================
WHEN TAX CHANGES
=============================================*/

// $("#newTaxSale").change(function(){

// 	addTax();

// });

//    // Part Price format
//    $("#newPartsTotalSell").number(true, 2);


/*=============================================
WHEN DISCOUNT CHANGES
=============================================*/

$("#newDiscSale").change(function(){

	addDisc();

});

/*=============================================
FINAL PRICE FORMAT
=============================================*/

$("#newPartsTotalSell").number(true, 2);

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
      	listMethods()

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

  var totalPrice = $("#newPartsTotalSell").attr("totalSale"); //sherwin

	var change =  Number(cash) - Number($('#saleTotal').val());
  var change =  Number(cash) - Number($(totalPrice).val());

  var newCashChange = $(this).parent().parent().parent().children('#getCashChange').children().children('#newCashChange');

	newCashChange.val(change);

})


/*=============================================
CHANGE TRANSACTION CODE
=============================================*/
$(".formWithdrawal").on("change", "input#newTransactionCode", function(){

	// List method in the entry
     listMethods()


})

/*=============================================
LIST ALL THE PARTS
=============================================*/

function listParts(){

	var partsList = [];

	var description = $(".newPartDescription");

	var quantity = $(".newPartQty");

	var price = $(".newPartPrice");

	for(var i = 0; i < description.length; i++){

		partsList.push({ "id" : $(description[i]).attr("idPart"), 
							  "description" : $(description[i]).val(),
							  "quantity" : $(quantity[i]).val(),
							  "stock" : $(quantity[i]).attr("newStock"),
							  "price" : $(price[i]).attr("realPrice"),
							  "totalPrice" : $(price[i]).val()})
	}

    // console.log("partsList", partsList)
	$("#partsList").val(JSON.stringify(partsList)); 

}

/*=============================================
LIST OF METHOD PAYMENT
=============================================*/

function listMethods(){

	var listMethods = "";

	if($("#newPaymentMethod").val() == "cash"){

		$("#listPaymentMethod").val("cash");

	}else{

		$("#listPaymentMethod").val($("#newPaymentMethod").val()+"-"+$("#newTransactionCode").val());
	}
}


/*=============================================
EDIT WITHDRAWAL BUTTON
=============================================*/
$(".tables").on("click", ".btnEditWithdrawal", function(){

    // $(".btnEditWithdrawal").click(function(){

	var idWithdrawal = $(this).attr("idWithdrawal");

	window.location = "index.php?route=editWithdrawal&idWithdrawal="+idWithdrawal;

})

/*=============================================
DELETE SALE
=============================================*/
$(".tables").on("click", ".btnDeleteWithdrawal", function(){

    // $(".btnDeleteWithdrawal").click(function(){

    var idWithdrawal = $(this).attr("idWithdrawal");
  
    swal({
          title: '¿Are you sure you want to delete?',
          text: "If you're not you can cancel!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancel',
          confirmButtonText: 'Yes delete!'
        }).then((result) => {
          if (result.value) {
            
              window.location = "index.php?route=withdrawn&idWithdrawal="+idWithdrawal;
              
          }
  
    })
  
  })


/*=============================================
Print Bill
=============================================*/

$(".tables").on("click", ".btnPrintBill", function(){

// $(".btnPrintBill").click(function(){
    var withdrawalCode = $(this).attr("withdrawalCode");
    window.open("extensions/tcpdf/pdf/bill.php?code="+withdrawalCode, "_blank");
    
})


/*=============================================
Date Range Button
=============================================*/

$('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(31, 'days'),
      // startDate: moment(),
      endDate  : moment()
    },
    function (start, end) {

      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))

      var initialDate = start.format('YYYY-MM-DD');

      var finalDate = end.format('YYYY-MM-DD');

      var captureRange = $("#daterange-btn span").html();
     
         localStorage.setItem("captureRange", captureRange);
         console.log("localStorage", localStorage);
  
         window.location = "index.php?route=withdrawn&initialDate="+initialDate+"&finalDate="+finalDate;

    }
  )

/*=============================================
Cancel Date Range 
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("captureRange");
	localStorage.clear();
	window.location = "withdrawn";
})

/*=============================================
CAPTURE TODAY'S BUTTON
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function(){

	var todayButton = $(this).attr("data-range-key");

	if(todayButton == "Today"){

		var d = new Date();
		
		var day = d.getDate();
		var month= d.getMonth()+1;
		var year = d.getFullYear();

		if(month < 10){

			var initialDate = year+"-0"+month+"-"+day;
			var finalDate = year+"-0"+month+"-"+day;

		}else if(day < 10){

			var initialDate = year+"-"+month+"-0"+day;
			var finalDate = year+"-"+month+"-0"+day;

		}else if(month < 10 && day < 10){

			var initialDate = year+"-0"+month+"-0"+day;
			var finalDate = year+"-0"+month+"-0"+day;

		}else{

			var initialDate = year+"-"+month+"-"+day;
	    var finalDate = year+"-"+month+"-"+day;

		}	

    	localStorage.setItem("captureRange", "Today");

    	window.location = "index.php?route=withdrawn&initialDate="+initialDate+"&finalDate="+finalDate;

	}

})

