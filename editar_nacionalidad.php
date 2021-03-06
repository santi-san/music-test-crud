<?php
/**
 * @var int $id_nacionalidad
 * @var string $nomNacionalidad
 */
/*session_start();
if (!isset($_SESSION['usuario_logueado'])) {
    header('Location: index.php');
    die;
}*/
$titulo = 'Update de Nacionalidad';

require_once 'init.php';
require_once 'funciones.php';
require_once './clases/DB.php';
require_once './clases/nacionalidad.php';


// Se inicializan las variables que se utilizarán en el formulario de edit
$nomNacionalidad = '';
$errores = '';


if (isset($_GET['id_nacionalidad'])){
    $id_nacionalidad = $_GET['id_nacionalidad'];
    $editarNacionalidad = new Nacionalidad();

    $stmt = $editarNacionalidad->getEditPorId($id_nacionalidad);
    /*    var_dump($stmt);*/
    $cantidad_de_filas = $stmt->rowCount();
    while ($fila = $stmt->fetch()){
        $id_nacionalidad = $fila['id_nacionalidad'];
        $nomNacionalidad = $fila['nomNacionalidad'];
    }
}

$errores = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //pregunta si el input esta seteado.
    if (isset($_POST['nomNacionalidad'])) {
        $nomNacionalidad = strtolower(trim($_POST['nomNacionalidad']));
    }
    $nombreLargoMinimo = 3;
    $nombreLargoMaximo = 45;
    $nombreLargo =  strlen($_POST['nomNacionalidad']);

    //se verifica si hay errores
    if ($nomNacionalidad === '') {
        $errores .=  'El nombre de la nacionalidad no puede estar vacío.<br>';
    } elseif ($nombreLargo < $nombreLargoMinimo) {
        $errores .=  "El nombre de la nacionalidad debe contener al menos $nombreLargoMinimo caracteres.<br>";
    } elseif($nombreLargo > $nombreLargoMaximo) {
        $errores .= "El nombre de la nacionalidad debe contener $nombreLargoMaximo caracteres como máximo.<br>";
    }

    # Verifica si hubo errores en la validación
    if ($errores !== '') {
        $alertParaUsuario = getHtmlAlert($errores, 'alert-danger');
    }

    else {
        # Si no hubo errores de validación
        # Creo un objeto de la clase Producto y paso los valores
        $update = new Nacionalidad();
        $update->id_nacionalidad = $id_nacionalidad;
        $update->nomNacionalidad = $nomNacionalidad;
        //Realizo el metodo update
        $update->update($id_nacionalidad);

        # Alerta despues de insertar.
        $alertParaUsuario = getHtmlAlert('La nacionalidad  <strong>'. $nomNacionalidad .'</strong> fue actualizada con éxito.', 'alert-success');

        # Se resetean las variables para que el formulario aparezca vacío
        $nomNacionalidad = '';
    }
}

include 'header.php';
?>
    <h1>Editar productos</h1>
<?php
echo $alertParaUsuario ?? '';

include 'form_nacionalidad.php';

/*mysqli_close($link);*/

include 'footer.php';