/*====================================
=            User's Photo           =
====================================*/


$(".newPics").change(function(){

    var newImage = this.files[0];

    /*====================================
    =        Validate file format        =
    ====================================*/

    if (newImage["type"] != "image/jpeg" && newImage["type"] != "image/png"){
        $(".newPics").val("");

        swal ({
            type: "error",
			title: "Error uploading image",
			text: "¡Image has to be JPEG or PNG!",
			showConfirmButton: true,
			confirmButtonText: "Close"
        });

    } else if (newImage["size"] > 2000000){
        $(".newPics").val("");
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


/*====================================
=        Edit user                   =
====================================*/

$(".btnEditUser").click(function(){

    var idUser = $(this).attr("idUser");
    // console.log("idUser", idUser);

    var data = new FormData();
    data.append("idUser", idUser);

    $.ajax ({
        url:"ajax/users.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(answer) {

            // console.log("answer", answer);

            $("#editName").val(answer["name"]);
            $("#EditUser").val(answer["user"]);
            $("#editProfile").html(answer["profile"]);
            $("#editProfile").val(answer["profile"]);
            $("#currentPasswd").val(answer["password"]);
            $("#currentPhoto").val(answer["photo"]);


            if(answer["photo"] != ""){
                $(".preview").attr("src", answer["photo"]);

            }

        }

    });
    
})


