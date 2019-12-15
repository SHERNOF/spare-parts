/*====================================
=            User's Photo           =
====================================*/

$(".newPhoto").change(function(){

    var imagen = this.files[0];

    /*====================================
    =            Validate file format    =
    ====================================*/

    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
        $(".newPhoto").val("");

        swal ({
            title: "Upload Image Error",
            text: "Error file uploaded is not an image",
            type: "error",
            Confirmateion: "clear"
        });

    } else if (imagen["size"] > 3000000){
        $(".newPhoto").val("");
        swal ({
            title: "Upload Image Error",
            text: "The image should not exceed 2MB",
            type: "error",
            Confirmateion: "clear"
        });
    } else {
        var dataImagen = new FileReader;
        dataImagen.readAsDataURL(imagen);
        $(dataImagen).on("load", function(event){
            var routeImagen = event.target.result;
            $(".preview").attr("src", routeImagen)
        })
    }

})