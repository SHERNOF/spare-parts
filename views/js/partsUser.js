


/*====================================
=        Edit Parts USer             =
====================================*/


$(".btnEditpartsUser").click(function(){

    var idpartsUser = $(this).attr("idpartsUser");
    // console.log("idUser", idUser);

    var data = new FormData();
    data.append("idpartsUser", idpartsUser);

    $.ajax ({
        url:"ajax/partsUser.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(answer) {

            // console.log("answer", answer);
            
            $("#idpartsUser").val(answer["id"]);
            $("#editpartsUser").val(answer["name"]);
            $("#editIdDocument").val(answer["idDocument"]);
            $("#editEmail").val(answer["email"]);
            $("#editPhone").val(answer["phone"]);
            $("#editAddress").val(answer["address"]);
            $("#editBirthdate").val(answer["birthdate"]);
        }
    });

})

/*=============================================
DELETE PARTS USER
=============================================*/

    $(".btnDeletepartsUser").click(function(){

        var idpartsUser = $(this).attr("idpartsUser");

        console.log("idpartsUser", idpartsUser)
	
	swal({
        title: 'Are you sure you want to delete this customer?',
        text: "If you're not you can cancel the action!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'cancel',
        confirmButtonText: 'Yes, delete Customer!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?route=partsUser&idpartsUser="+idpartsUser;
        }

  })

})




