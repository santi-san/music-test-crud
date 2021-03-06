<?php
/**
 * @var int $id_nacionalidad
 * @var string $nomBanda
 * @var string $integrantes
 * @var string $fechaFundacion
 * @var string $nacionalidades_id_nacionalidad
 */
/*session_start();
if (!isset($_SESSION['usuario_logueado'])) {
    header('Location: index.php');
    die;
}*/

$titulo = 'Update de banda';

require_once 'init.php';
require_once 'funciones.php';
require_once './clases/DB.php';
require_once './clases/album.php';


//se inicializa variables para evitar error
$id_album = '';
$nomAlbum = '';
$fechaLanzamiento = '';
$catalogo = '';
$tracklist = '';
$bandas_id_bandas = '';
$discograficas_id_discografica = '';
$generos_id_genero = '';
$formatos_id_formato = '';

$folderImgAlbum = '';
$img_name = '';
$img_size = '';
$img_file_path = '';
$img_error = 0;
$img_size_max = 125000;
$img_extension_lcase = '';
$img_valid_extensions = ["jpg", "jpeg", "png"];

$errores = '';

if (isset($_GET['id_album'])){
    $id_album = $_GET['id_album'];
    $editarAlbum = new Album();

    $stmt = $editarAlbum->getEditPorId($id_album);

    $cantidad_de_filas = $stmt->rowCount();
    while ($fila = $stmt->fetch()){
        $nomAlbum = $fila['nomAlbum'];
        $fechaLanzamiento = $fila['fechaLanzamiento'];
        $catalogo = $fila['catalogo'];
        $tracklist = $fila['tracklist'];
        $bandas_id_bandas = $fila['bandas_id_bandas'];
        $discograficas_id_discografica = $fila['discograficas_id_discografica'];
        $generos_id_genero = $fila['generos_id_genero'];
        $formatos_id_formato = $fila['formatos_id_formato'];
    }
}

$errores = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    #VALIDACIONES
    //pregunta si el input esta seteado.
    if (isset($_POST['nomAlbum'])) {
        $nomAlbum = strtolower(trim($_POST['nomAlbum']));
    }
    $nombreLargoMinimo = 3;
    $nombreLargoMaximo = 45;
    $nombreLargo =  strlen($_POST['nomAlbum']);

    if (isset($_POST['catologo'])) {
        $catalogo = $_POST['catologo'];
    }
    $catalogoLargoMinimo = 3;
    $catalogoLargoMaximo = 20;
    $catalogoLargo =  strlen($_POST['catologo']);

    if (isset($_POST['fechaLanzamiento'])) {
        $fechaLanzamiento = $_POST['fechaLanzamiento'];
    }
    //Falta validar la fecha (de Fecha X a Fecha X)

    if (isset($_POST['tracklist'])) {
        $tracklist = $_POST['tracklist'];
    }
    $tracklistLargoMinimo = 10;
    $tracklistLargoMaximo = 1000;
    $tracklistLargo =  strlen($_POST['tracklist']);


    if (isset($_FILES['imgAlbum'])) {
        $img_name = $_FILES['imgAlbum']['name'];
        $img_file_path = $_FILES['imgAlbum']['tmp_name'];
        $img_size =  $_FILES['imgAlbum']['size'];
        $img_error =  $_FILES['imgAlbum']['error'];
        $img_extension_lcase = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
    }

    if (isset($_POST['bandas'])) {
        $bandas_id_bandas = (trim($_POST['bandas']));
    }

    if (isset($_POST['discograficas'])) {
        $discograficas_id_discografica = (trim($_POST['discograficas']));
    }

    if (isset($_POST['genero'])) {
        $generos_id_genero = (trim($_POST['genero']));
    }
    if (isset($_POST['nacionalidad'])) {
        $nacionalidades_id_nacionalidad = (trim($_POST['nacionalidad']));
    }

    if (isset($_POST['formato'])) {
        $formatos_id_formato = (trim($_POST['formato']));
    }

    # SE VALIDAN LOS DATOS y si hay errores
    if ($nomAlbum === '') {
        $errores .=  'El album no puede estar vacío.<br>';
    } elseif ($nombreLargo < $nombreLargoMinimo) {
        $errores .=  "El album debe contener al menos $nombreLargoMinimo caracteres.<br>";
    } elseif($nombreLargo > $nombreLargoMaximo) {
        $errores .=  "El album debe contener $nombreLargoMaximo caracteres como máximo.<br>";
    }

    if ($catalogo === '') {
        $errores .=  'El catalogo no puede estar vacío.<br>';
    } elseif ($catalogoLargo < $catalogoLargoMinimo) {
        $errores .=  "El catalogo debe contener al menos $nombreLargoMinimo caracteres.<br>";
    } elseif($catalogoLargo > $catalogoLargoMaximo) {
        $errores .=  "El catalogo debe contener $nombreLargoMaximo caracteres como máximo.<br>";
    }

    if ($tracklist === '') {
        $errores .=  'El tracklist no puede estar vacío.<br>';
    } elseif ($tracklistLargo < $tracklistLargoMinimo) {
        $errores .=  "El tracklist debe contener al menos $tracklistLargoMinimo caracteres.<br>";
    } elseif($tracklistLargo > $tracklistLargoMaximo) {
        $errores .=  "El tracklist debe contener $tracklistLargoMaximo caracteres como máximo.<br>";
    }

    if ($fechaLanzamiento === '') {
        $errores .=  'La fecha no puede estar vacía.<br>';
    }
    #falta validar la fecha

    function validarBanda($varbanda){
        $id_band = "SELECT id_bandas FROM bandas WHERE id_bandas = '$varbanda'";
        $row_count = ($id_band);

        if ($row_count == '1'){
            return true;
        }
        else{
            return false;
        }
    }
    if ($bandas_id_bandas === '') {
        $errores .= 'La banda no puede estar vacío.<br>';
    } else if (validarBanda($bandas_id_bandas))
    {
        $errores .= 'El valor de la banda no es válido.<br>';
    }

    function validarDiscografica($vardiscografica){
        $id_discog = "SELECT id_discografica FROM discograficas WHERE id_discografica = '$vardiscografica'";
        $row_count = ($id_discog);
        if ($row_count == '1'){
            return true;
        }
        else{
            return false;
        }
    }
    if ($discograficas_id_discografica === '') {
        $errores .= 'La discografica no puede estar vacía.<br>';
    } else if (validarDiscografica($discograficas_id_discografica)){
        $errores .= 'El valor de la discografica no es válido.<br>';
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

    function validarFormato($varformato){
        $id_format = "SELECT id_formato FROM formatos WHERE id_formato = '$varformato'";
        $row_count = ($id_format);
        if ($row_count == '1'){
            return true;
        }
        else{
            return false;
        }
    }
    if ($formatos_id_formato === '') {
        $errores .= 'El formato no puede estar vacío.<br>';
    } else if (validarFormato($formatos_id_formato))
    {
        $errores .= 'El valor del formato no es válido.<br>';
    }


    ################################################
    #validar imagen
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

    // Si hubo errores en la validacion
    if ($errores !== '') {
        $alertParaUsuario = getHtmlAlert($errores, 'alert-danger');
    }

    else {
        # Si no hubo errores de validación
        $folderImgDiscog = "img/".$img_name;
        move_uploaded_file($img_file_path,$folderImgDiscog);
        # Creo un objeto de la clase Genero y paso los valores


        # Si no hubo errores de validación
        # Creo un objeto de la clase Producto y paso los valores
        $update = new Album();
        $update->nomAlbum = $nomAlbum;
        $update->fechaLanzamiento = $fechaLanzamiento;
        $update->catalogo = $catalogo;
        $update->tracklist = $tracklist;
        $update->imgAlbum = $folderImgDiscog;
        $update->bandas_id_bandas = $bandas_id_bandas;
        $update->discograficas_id_discografica = $discograficas_id_discografica;
        $update->generos_id_genero = $generos_id_genero;
        $update->formatos_id_formato = $formatos_id_formato;
        //Realizo el metodo update
        $update->update($id_album);

        # Alerta despues de insertar.
        $alertParaUsuario = getHtmlAlert('El album:  <strong>'. $nomAlbum .'</strong> fue actualizada con éxito.', 'alert-success');

        # Se resetean las variables para que el formulario aparezca vacío
        $id_album = '';
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

include 'header.php';
?>
    <h1>Editar Banda</h1>
<?php
echo $alertParaUsuario ?? '';

include 'form_album.php';

/*mysqli_close($link);*/

include 'footer.php';