<?php

class ControllerCategory {
	
	/*=============================================
						Add Category
    =============================================*/

    static public function ctrCreateCategory (){

        if(isset($_POST["newCategory"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newCategory"])){

                $table = 'categories';

				$data = $_POST['newCategory'];

                $answer = CategoriesModel::mdlAddCategory($table, $data);
                
                if($answer == 'ok'){

					echo '<script>
						
						swal({
							type: "success",
							title: "Category has been successfully saved ",
							showConfirmButton: true,
							confirmButtonText: "Close"

							}).then(function(result){
								if (result.value) {

									window.location = "categories";

								}
							});
						
					</script>';
				}

        } else {

            echo '<script>
						
            swal({
                type: "error",
                title: "No special characters or blank fields for categories",
                showConfirmButton: true,
                confirmButtonText: "Close"
    
                 }).then(function(result){

                    if (result.value) {
                        window.location = "categories";
                    }
                });
            
             </script>';
        }

    }
    
}

    /*=============================================
						SHow Category
    =============================================*/

    static public function ctrShowCategories($item, $value){

        
		$table = "categories";

		$answer = CategoriesModel::MdlShowCategories($table, $item, $value);

        return $answer;
        
    


}
}