<?php

require_once 'Conexion.php';

class Car extends Conexion{

  private $conexion;

  //Constructor
  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function listar(){
    try{
      $consulta = $this->conexion->prepare("CALL spu_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  //Este método deberá retornar un arreglo conteniendo la información
  //además del estado (status)
  public function registrar($datos = []){
    $respuesta = [
      "status" => false,
      "message" => ""
    ];
    try{
      $consulta = $this->conexion->prepare("CALL spu_registrar(?,?,?,?,?)");
      $respuesta["status"] = $consulta->execute(
        array(
          $datos["marca"],
          $datos["modelo"],
          $datos["precio"],
          $datos["tipoCombustible"],
          $datos["color"]
        )
      );
    }
    catch(Exception $e){
      $respuesta["message"] = "No se completo el proceso, codigo de error: ".$e->getCode();
      //die($e->getMessage());
    }
    return $respuesta;
  }

  public function eliminar($idautomovil = 0){
    $respuesta = [
      "status" => false,
      "message" => ""
    ];
    try{
      $consulta = $this->conexion->prepare("CALL spu_eliminar(?)");
      $respuesta["status"] = $consulta->execute(array($idautomovil));
    }
    catch(Exception $e){
      $respuesta["message"] = "No se completo el proceso, codigo de error: ".$e->getCode();
      //die($e->getMessage());
    }
    return $respuesta;
  }

  public function obtener($idautomovil = 0){
    try{
      $consulta = $this->conexion->prepare("CALL spu_obtener(?)");
      $consulta->execute(array($idautomovil));
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function editar($datos = []){
    $respuesta = [
      "status" => false,
      "message" => ""
    ];
    try{
      $consulta = $this->conexion->prepare("CALL spu_editar(?,?,?,?,?,?)");
      $respuesta["status"] = $consulta->execute(
        array(
          $datos["idautomovil"],
          $datos["marca"],
          $datos["modelo"],
          $datos["precio"],
          $datos["tipoCombustible"],
          $datos["color"]
        )
      );
    }
    catch(Exception $e){
      $respuesta["message"] = "No se completo el proceso, codigo de error: ".$e->getCode();
      
    }
    return $respuesta;
  }
}