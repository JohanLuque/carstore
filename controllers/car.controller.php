<?php
//CONTROLADOR APROVECHA LAS FUNCIONALIDADES DEFINIDAS/CONSTRUIDAS
//EN EL MODELO (pero el MODELO necesita TABLAS y los SPU)
require_once '../models/car.model.php';

if (isset($_POST['operacion'])){

  $car = new Car();

  if ($_POST['operacion'] == 'listar'){

    $datosObtenidos =  $car->listar();
    if($datosObtenidos){
      echo json_encode($datosObtenidos);
    }

  }

  if ($_POST['operacion'] == 'registrar'){
    
    $datosGuardar = [
      "marca"               => $_POST['marca'],
      "modelo"              => $_POST['modelo'],
      "precio"              => $_POST['precio'],
      "tipoCombustible"     => $_POST['tipoCombustible'],
      "color"               => $_POST['color']
    ];

    $respuesta = $car->registrar($datosGuardar);
    echo json_encode($respuesta);
  }

  if($_POST['operacion'] == 'eliminar'){
    $respuesta = $car->eliminar($_POST['idautomovil']);
    echo json_encode($respuesta);
  }

  if($_POST['operacion'] == 'obtener'){
    $respuesta = $car->obtener($_POST['idautomovil']);
    echo json_encode($respuesta);
  }

  if ($_POST['operacion'] == 'editar'){
    
    $datosActualizados = [
      "idautomovil"         => $_POST['idautomovil'],
      "marca"               => $_POST['marca'],
      "modelo"              => $_POST['modelo'],
      "precio"              => $_POST['precio'],
      "tipoCombustible"     => $_POST['tipoCombustible'],
      "color"               => $_POST['color']
    ];

    $respuesta = $car->editar($datosActualizados);
    echo json_encode($respuesta);
  }
}