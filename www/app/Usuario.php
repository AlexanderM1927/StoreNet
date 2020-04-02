<?php

namespace App;

class Usuario
{
    private $id;
    private $nombres;
    private $apellidos;
    private $mail;
    private $password;
    private $direccion;
    private $telefono;
    private $idafiliado;
    private $rango;
    private $sueldo;

    public function setCliente($array)
    {
        $this->id=$array->id;
        $this->nombres=$array->nombres;
        $this->apellidos=$array->apellidos;
        $this->mail=$array->mail;
        $this->password=$array->password;
        $this->direccion=$array->direccion;
        $this->telefono=$array->telefono;
        $this->idafiliado=0;
        $this->rango=0;
        $this->sueldo=0;
    }

    public function setEmpleado($array)
    {
        $this->id=$array->id;
        $this->nombres=$array->nombres;
        $this->apellidos=$array->apellidos;
        $this->mail=$array->mail;
        $this->password=$array->password;
        $this->direccion=$array->direccion;
        $this->telefono=$array->telefono;
        $this->idafiliado=$array->idafiliado;
        $this->rango=$array->rango;
        $this->sueldo=$array->sueldo;
    }

    public function getId(){ return $this->id; }
    public function getNombres(){ return $this->nombres; }
    public function getApellidos(){ return $this->apellidos; }
    public function getMail(){ return $this->mail; }
    public function getPassword(){ return $this->password; }
    public function getDireccion(){ return $this->direccion; }
    public function getTelefono(){ return $this->telefono; }
    public function getIdAfiliado(){ return $this->idafiliado; }
    public function getRango(){ return $this->rango; }
    public function getSueldo(){ return $this->sueldo; }



    public function getNombreRango(){
        $rango='';
        if($this->rango == 0){
            $rango='Cliente';
        }else if($this->rango == 1){
            $rango='Vendedor';
        }else if($this->rango == 2){
            $rango='Supervisor';
        }else if($this->rango == 3){
            $rango='Administrador';
        }else if($this->rango == 4){
            $rango='Super administrador';
        }
        return $rango;
    }

}
