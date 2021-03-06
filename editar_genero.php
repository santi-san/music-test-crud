<?php
/**
 * @var int $id_genero
 * @var string $nomGenero
 */
/*session_start();
if (!isset($_SESSION['usuario_logueado'])) {
    header('Location: index.php');
    die;
}*/
$titulo = 'Update de genero';

require_once 'init.php';
require_once 'funciones.php';
require_once './clases/DB.php';
require_once './clases/genero.php';


// Se inicializan las variables que se utilizarán en el formulario de edit
$nomGenero = '';
$errores = '';


if (isset($_GET['id_genero'])){
    $id_producto = $_GET['id_genero'];
    $editarGenero = new Genero();

    $stmt = $editarGenero->getEditPorId($id_producto);
    /*    var_dump($stmt);*/
    $cantidad_de_filas = $stmt->rowCount();
    while ($fila = $stmt->fetch()){
        $id_genero = $fila['id_genero'];
        $nomGenero = $fila['nomGenero'];
    }
}

$errores = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //pregunta si el input esta seteado.
    if (isset($_POST['nomGenero'])) {
        $nomGenero = strtolower(trim($_POST['nomGenero']));
    }
    $nombreLargoMinimo = 3;
    $nombreLargoMaximo = 30;
    $nombreLargo =  strlen($_POST['nomGenero']);

    //se verifica si hay errores
    if ($nomGenero === '') {
        $errores .=  'El nombre del genero no puede estar vacío.<br>';
    } elseif ($nombreLargo < $nombreLargoMinimo) {
        $errores .=  "El nombre del genero debe contener al menos $nombreLargoMinimo caracteres.<br>";
    } elseif($nombreLargo > $nombreLargoMaximo) {
        $errores .= "El nombre del genero debe contener $nombreLargoMaximo caracteres como máximo.<br>";
    }

    # Verifica si hubo errores en la validación

    if ($errores !== '') {
        $alertParaUsuario = getHtmlAlert($errores, 'alert-danger');
    }

    else {
        # Si no hubo errores de validación
        # Creo un objeto de la clase Producto y paso los valores
        $update = new Genero();
        $update->id_genero = $id_genero;
        $update->nomGenero = $nomGenero;
        //Realizo el metodo update
        $update->update($id_genero);

        # Alerta despues de insertar.
        $alertParaUsuario = getHtmlAlert('El genero  <strong>'. $nomGenero .'</strong> fue actualizado con éxito.', 'alert-success');

        # Se resetean las variables para que el formulario aparezca vacío
        $nomGenero = '';
    }
}

include 'header.php';
?>
    <h1>Editar productos</h1>
<?php
echo $alertParaUsuario ?? '';

include 'form_genero.php';

/*mysqli_close($link);*/

include 'footer.php';