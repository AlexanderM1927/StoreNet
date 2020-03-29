<?php

namespace App;

class Producto
{

    private $id;
    private $nombre;
    private $precioproveedor;
    private $precioventa;
    private $idprov;
    private $cantidad;
    private $idafiliado;

    public function setProducto($array){
        $this->id=$array->id;
        $this->nombre=$array->nombre;
        $this->precioproveedor=$array->precioproveedor;
        $this->precioventa=$array->precioventa;
        $this->idprov=$array->idprov;
        $this->cantidad=$array->cantidad;
        $this->idafiliado=$array->idafiliado;
    }

    public function getId(){ return $this->id; }
    public function getNombre(){ return $this->nombre; }
    public function getPrecioVenta(){ return $this->precioventa; }
    public function getPrecioProveedor(){ return $this->precioproveedor; }
    public function getIdProv(){ return $this->idprov; }
    public function getCantidad(){ return $this->cantidad; }
    public function getIdAfiliado(){ return $this->idafiliado; }

}

?>