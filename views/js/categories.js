/*====================================
=        Check User Duplication      =
====================================*/

$("#newCategory").change(function(){

    $(".alert").remove();

    var category= $(this).val();
    var data = new FormData;
    
    data.append("validateCategory", category);
    $.ajax({
        url:"ajax/categories.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(answer) {
            if(answer){

                $("#newCategory").parent().after('<div class="alert alert-warning">This category is already been used</div>')
                $("#newCategory").val("");
            }
        }
    })
})

/*=============================================
EDIT CATEGORY
=============================================*/

$(".tables").on("click", ".btnEditCategory", function(){
    // $(".btnEditCategory").click(function(){

	var idCategory = $(this).attr("idCategory");

	var data = new FormData();
	data.append("idCategory", idCategory);

	$.ajax({
		url: "ajax/categories.ajax.php",
		method: "POST",
      	data: data,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(answer){
     		
     		console.log("answer", answer);

     		$("#editCategory").val(answer["category"]);
     		$("#idCategory").val(answer["id"]);

     	}

	})

})

/*=============================================
DELETE CATEGORY
=============================================*/

// $(".btnDeleteCategory").click(function(){
    $(".tables").on("click", ".btnDeleteCategory", function(){

    var idCategory = $(this).attr("idCategory");

    swal({
        title: '¿Are you sure you want to delete the category?',
       text: "¡if you're not sure you can cancel!",
       type: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       cancelButtonText: 'Cancel',
       confirmButtonText: 'Yes, delete category!'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?route=categories&idCategory="+idCategory;

        }

    })
})