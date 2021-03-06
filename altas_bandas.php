<?php
require_once 'funciones.php';
require_once './clases/DB.php';
require_once './clases/banda.php';
//Me conecto a la base de datos
$link = DB::getConnection();
if(!$link){
    header('Location: ' . NOMBRE_PAGINA_ERROR . '?codigo_error=1');
    die;
}

//se inicializa variables para evitar error
$nomBanda = '';
$integrantes = '';
$fechaFundacion = '';
$nacionalidades_id_nacionalidad = '';

$folderImgBanda = '';
$img_name = '';
$img_size = '';
$img_file_path = '';
$img_error = 0;
$img_size_max = 125000;
$img_extension_lcase = '';
$img_valid_extensions = ["jpg", "jpeg", "png"];

$errores = '';

//si hubo un request por POST...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    #VALIDACIONES
    //pregunta si el input esta seteado.
    if (isset($_POST['nomBanda'])) {
        $nomBanda = strtolower(trim($_POST['nomBanda']));
    }
    $nombreLargoMinimo = 3;
    $nombreLargoMaximo = 45;
    $nombreLargo =  strlen($_POST['nomBanda']);

    if (isset($_POST['integrantes'])) {
        $integrantes = strtolower(trim($_POST['integrantes']));
    }
    $integrantesLargo =  strlen($_POST['integrantes']);

    //falta validar si la fecha esta entre X fecha y X fecha
    $fechaFundacion = $_POST['fechaFundacion'];
    ##############################################
    #validar imagen
    if (isset($_FILES['imgBanda'])) {
        $img_name = $_FILES['imgBanda']['name'];
        $img_file_path = $_FILES['imgBanda']['tmp_name'];
        $img_size =  $_FILES['imgBanda']['size'];
        $img_error =  $_FILES['imgBanda']['error'];
        $img_extension_lcase = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
    }
    ################################################
    if (isset($_POST['nacionalidad'])) {
        $nacionalidades_id_nacionalidad = (trim($_POST['nacionalidad']));
    }

    # SE VALIDAN LOS DATOS y si hay errores
    if ($nomBanda === '') {
        $errores .=  'El nombre no puede estar vacío.<br>';
    } elseif ($nombreLargo < $nombreLargoMinimo) {
        $errores .=  "El nombre debe contener al menos $nombreLargoMinimo caracteres.<br>";
    } elseif($nombreLargo > $nombreLargoMaximo) {
        $errores .=  "El nombre debe contener $nombreLargoMaximo caracteres como máximo.<br>";
    }

    if ($integrantes === '') {
        $errores .=  'Los integrantes no pueden estar vacíos.<br>';
    } elseif ($integrantesLargo < $nombreLargoMinimo) {
        $errores .=  "Los integrantes debe contener al menos $nombreLargoMinimo caracteres.<br>";
    } elseif($integrantesLargo > $nombreLargoMaximo) {
        $errores .=  "Los integrantes debe contener $nombreLargoMaximo caracteres como máximo.<br>";
    }

    ################################################

    if($img_name == ''){
        $errores .=  'No se selecciono ninguna imagen.<br>';
    } elseif ($img_error === 1) {
    $errores .=  'No se pudo cargar la imagen.<br>';
    } elseif ($img_size > $img_size_max) {
        $errores .= "La imagen es muy pesada, no debe superar los $img_size_max bytes.<br>";
    } elseif(!in_array($img_extension_lcase, $img_valid_extensions)){
        $errores .=  'Solo se admite los siguientes formatos: jpg, jpeg, png.<br>';
    }

    ################################################

    function validarNacionalidad($varnacionalidad){
        $id_nac = "SELECT id_nacionalidad FROM nacionalidades WHERE id_nacionalidad = '$varnacionalidad'";
        $row_count = ($id_nac);

        if ($row_count == '1'){
            return true;
        }
        else{
            return false;
        }
    }
    if ($nacionalidades_id_nacionalidad === '') {
        $errores .= 'La nacionalidad no puede estar vacía.<br>';
    } else if (validarNacionalidad($nacionalidades_id_nacionalidad)){
        $errores .= 'El valor de la nacionalidad no es válido.<br>';
    }

 // Si hubo errores en la validacion
    if ($errores !== '') {
        $alertParaUsuario = getHtmlAlert($errores, 'alert-danger');
    }
    else {
        # Si no hubo errores de validación
        $folderImgBanda = "img/".$img_name;
        move_uploaded_file($img_file_path,$folderImgBanda);
        # Creo un objeto de la clase Genero y paso los valores
        $nueva_banda = new Banda();
        $nueva_banda->nomBanda = $nomBanda;
        $nueva_banda->integrantes = $integrantes;
        $nueva_banda->fechaFundacion = $fechaFundacion;
        $nueva_banda->imgBanda = $folderImgBanda;
        $nueva_banda->nacionalidades_id_nacionalidad = $nacionalidades_id_nacionalidad;
        //Realizo el metodo insert
        $nueva_banda->insert();

        # Alerta despues de insertar.
        $alertParaUsuario = getHtmlAlert('La banda: <strong>' . $nomBanda . '</strong> fue dada de alta con éxito.', 'alert-success');

        // Se resetean la variable para que el formulario aparezca vacío para seguir cargando otros productos
        $nomBanda = '';
        $integrantes = '';
        $fechaFundacion = '';
        $nacionalidades_id_nacionalidad = '';

        $folderImgBanda = '';
        $img_name = '';
        $img_size = '';
        $img_file_path = '';
        $img_error = 0;
        $img_extension_lcase = '';
    }
}


require 'header.php';
?>
    <h1>Alta de Bandas</h1>
<?php
echo $alertParaUsuario ?? '';

include 'form_banda.php';
/*mysqli_close($link);*/
include 'footer.php';