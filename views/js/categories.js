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
        // dataType: "json",
        success: function(answer) {
            if(answer){

                $("#newCategory").parent().after('<div class="alert alert-warning">This category is already been used</div>')
                $("#newCategory").val("");
            }
        }
    })
})