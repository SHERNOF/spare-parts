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

/*====================================
=        Activating user             =
====================================*/

$(".btnActivate").click(function(){
    var userId = $(this).attr("userId")
    var userStatus = $(this).attr("userStatus")

    var data = new FormData();
    data.append("activateId", userId);
    data.append("activateUser", userStatus);

    $.ajax({
        url:"ajax/users.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(answer) {
            
        }
    })

    if(userStatus == 0){

        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Deactivate');
        $(this).attr('userStatus', 1);

    } else {
        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activated');
        $(this).attr('userStatus', 0);
    }
});


/*====================================
=        Check User Duplication      =
====================================*/

$("#newUser").change(function(){

    $(".alert").remove();

    var user= $(this).val();
    var data = new FormData;
    data.append("validateUser", user);
    $.ajax({
        url:"ajax/users.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(answer) {
            if(answer){

                $("#newUser").parent().after('<div class="alert alert-warning">This user is already been used</div>')
                $("#newuser").val("");
            }
        }
    })
})


/*====================================
=        Delete user                 =
====================================*/

$(".btnDeleteUser").click(function(){

    var userId = $(this).attr("userId");
    var userPhoto = $(this).attr("userPhoto");
    var username = $(this).attr("username");

    swal({
        title: 'Are you sure you want to delete the user?',
		text: "if you're not sure you can cancel!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Cancel',
		  confirmButtonText: 'Yes, delete user!'
        }).then((result)=>{

		if(result.value){

		  window.location = "index.php?route=users&userId="+userId+"&username="+username+"&userPhoto="+userPhoto;

		}
})
});




