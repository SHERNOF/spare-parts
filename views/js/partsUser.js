


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

            console.log("answer", answer);

            // $("#editpartsUser").val(answer["name"]);
            // $("#editIdDocument").val(answer["user"]);
            // $("#editMail").html(answer["profile"]);
            // $("#editPhone").val(answer["profile"]);
            // $("#editAddress").val(answer["password"]);
            // $("#editBirthdate").val(answer["photo"]);
        }
    });

})



