<?php
require_once 'funciones.php';
require_once './clases/DB.php';
require_once './clases/discografica.php';
//Me conecto a la base de datos
$link = DB::getConnection();
if(!$link){
    header('Location: ' . NOMBRE_PAGINA_ERROR . '?codigo_error=1');
    die;
}


//se inicializa variables para evitar error
$nomDiscografica = '';
$fechaFundacion = '';
$generos_id_genero = '';
$nacionalidades_id_nacionalidad = '';

$folderImgDiscog = '';
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

    //pregunta si el input esta seteado.
    if (isset($_POST['nomDiscografica'])) {
        $nomDiscografica = strtolower(trim($_POST['nomDiscografica']));
    }
    $nombreLargoMinimo = 3;
    $nombreLargoMaximo = 50;
    $nombreLargo =  strlen($_POST['nomDiscografica']);

    if (isset($_POST['fechaFundacion'])) {
        $fechaFundacion = $_POST['fechaFundacion'];
    }
    $fechaMinimo = 1900;
    $fechaMaximo = 2020;

    if (isset($_POST['genero'])) {
        $generos_id_genero = (trim($_POST['genero']));
    }
    if (isset($_POST['nacionalidad'])) {
        $nacionalidades_id_nacionalidad = (trim($_POST['nacionalidad']));
    }
    if (isset($_FILES['imgAlbum'])) {
        $img_name = $_FILES['imgAlbum']['name'];
        $img_file_path = $_FILES['imgAlbum']['tmp_name'];
        $img_size =  $_FILES['imgAlbum']['size'];
        $img_error =  $_FILES['imgAlbum']['error'];
        $img_extension_lcase = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
    }
    # SE VALIDAN LOS DATOS y si hay errores
    if ($nomDiscografica === '') {
        $errores .=  'La discografica no puede estar vacía.<br>';
    } elseif ($nombreLargo < $nombreLargoMinimo) {
        $errores .=  "La discografica debe contener al menos $nombreLargoMinimo caracteres.<br>";
    } elseif($nombreLargo > $nombreLargoMaximo) {
        $errores .=  "La discografica debe contener $nombreLargoMaximo caracteres como máximo.<br>";
    }

    if ($fechaFundacion === '') {
        $errores .=  'La fecha no puede estar vacía.<br>';
    } elseif ($fechaFundacion < $fechaMinimo) {
        $errores .=  "La fecha debe ser superior al año $fechaMinimo.<br>";
    } elseif($fechaFundacion > $fechaMaximo) {
        $errores .=  "La fecha debe ser inferior al año $fechaMaximo .<br>";
    }

    function validarGenero($vargenero){
        $id_gen = "SELECT id_genero FROM generos WHERE id_genero = '$vargenero'";
        $row_count = ($id_gen);
        if ($row_count == '1'){
            return true;
        }
        else{
            return false;
        }
    }

    if ($generos_id_genero === '') {
        $errores .= 'El genero no puede estar vacío.<br>';
    } else if (validarGenero($generos_id_genero))
    {
        $errores .= 'El valor del genero no es válido.<br>';
    }

    ########### Validar imagen ################
    if($img_name == ''){
        $errores .=  'No se selecciono ninguna imagen.<br>';
    }
    elseif ($img_error === 1) {
        $errores .=  'No se pudo cargar la imagen.<br>';
    }
    elseif ($img_size > $img_size_max) {
        $errores .= "La imagen es muy pesada, no debe superar los $img_size_max bytes.<br>";
    }
    elseif(!in_array($img_extension_lcase, $img_valid_extensions)){
        $errores .=  'Solo se admite los siguientes formatos: jpg, jpeg, png.<br>';
    }

    ################################################
    //////////////////////////////////////////////////
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
    //////////////////////////////////////////////////


    // Si hubo errores en la validacion
    if ($errores !== '') {
        $alertParaUsuario = getHtmlAlert($errores, 'alert-danger');
    }
    else {
        # Si no hubo errores de validación
        $folderImgDiscog = "img/".$img_name;
        move_uploaded_file($img_file_path,$folderImgDiscog);
        # Creo un objeto de la clase Genero y paso los valores

        $nueva_discografica = new Discografica();
        $nueva_discografica->nomDiscografica = $nomDiscografica;
        $nueva_discografica->fechaFundacion = $fechaFundacion;
        $nueva_discografica->imgDiscografica = $folderImgDiscog;
        $nueva_discografica->generos_id_genero = $generos_id_genero;
        $nueva_discografica->nacionalidades_id_nacionalidad = $nacionalidades_id_nacionalidad;
        //Realizo el metodo insert
        $nueva_discografica->insert();

        # Alerta despues de insertar.
        $alertParaUsuario = getHtmlAlert('La discografica: <strong>' . $nomDiscografica . '</strong> fue dada de alta con éxito.', 'alert-success');

        // Se resetean la variable para que el formulario aparezca vacío para seguir cargando otros productos
        $nomDiscografica = '';
        $fechaFundacion = '';
        $generos_id_genero = '';
        $nacionalidades_id_nacionalidad = '';

        $folderImgDiscog = '';
        $img_name = '';
        $img_size = '';
        $img_file_path = '';
        $img_error = 0;
        $img_extension_lcase = '';
    }
}


require 'header.php';
?>
    <h1>Alta de Discográficas</h1>
<?php
echo $alertParaUsuario ?? '';

include 'form_discografica.php';
/*mysqli_close($link);*/
include 'footer.php';