<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Pedido
{

    public function getEstado($estado)
    {
        if($estado==0)
        {
            return 'Pendiente';
        }else if($estado==1){
            return 'En camino';
        }else if($estado==2){
            return 'Cancelado';
        }else if($estado==3){
            return 'Recibido';
        }
    }

    public function listarPedidos($idcliente)
    {
        $listaPedidos = array();
        $arrayPedidos = DB::select("SELECT * FROM pedido WHERE idcliente = $idcliente  ORDER BY id DESC");
        foreach($arrayPedidos as $pedido)
        {
            $id = $pedido->id;
            $idafiliado = $pedido->idafiliado;
            $idfactura = $pedido->idfactura;
            $fecha = $pedido->fecha;
            $estado = $this->getEstado($pedido->estado);
            $afiliadoQ = DB::select("SELECT nombre FROM afiliado WHERE id = $idafiliado");
            $afiliado = $afiliadoQ[0]->nombre;
            array_push($listaPedidos, ['id' => $id, 'idafiliado' => $idafiliado, 'afiliado' => $afiliado, 'fecha' => $fecha, 'idfactura' => $idfactura, 'estado' => $estado]);
        }
        return $listaPedidos;
    }

    public function listarPedidos_estado($idcliente,$estado,$idafiliado)
    {
        $listaPedidos = array();
        if($idafiliado==0)
        {
            if($estado==4)
            {
                $arrayPedidos = DB::select("SELECT * FROM pedido ORDER BY id DESC");
            }else{
                if($idcliente == 0)
                {
                    $arrayPedidos = DB::select("SELECT * FROM pedido WHERE estado = $estado ORDER BY id DESC");
                }else{
                    $arrayPedidos = DB::select("SELECT * FROM pedido WHERE estado = $estado AND idcliente = $idcliente ORDER BY id DESC");
                }
            } 
        }else{
            if($estado==4)
            {
                $arrayPedidos = DB::select("SELECT * FROM pedido WHERE idafiliado = $idafiliado ORDER BY id DESC");
            }else{
                if($idcliente == 0)
                {
                    $arrayPedidos = DB::select("SELECT * FROM pedido WHERE estado = $estado AND idafiliado = $idafiliado ORDER BY id DESC");
                }else{
                    $arrayPedidos = DB::select("SELECT * FROM pedido WHERE estado = $estado AND idcliente = $idcliente AND idafiliado = $idafiliado ORDER BY id DESC");
                }
            } 
        }
        

        foreach($arrayPedidos as $pedido)
        {
            $id = $pedido->id;
            $idafiliado = $pedido->idafiliado;
            $idfactura = $pedido->idfactura;
            $fecha = $pedido->fecha;
            $estado = $this->getEstado($pedido->estado);
            $afiliadoQ = DB::select("SELECT nombre FROM afiliado WHERE id = $idafiliado");
            $afiliado = $afiliadoQ[0]->nombre;
            array_push($listaPedidos, ['id' => $id, 'idafiliado' => $idafiliado, 'afiliado' => $afiliado, 'fecha' => $fecha, 'idfactura' => $idfactura, 'estado' => $estado]);
        }
        return $listaPedidos;
    }

    public function listarPedidos_fecha($idcliente,$fechas,$estado,$idafiliado)
    {
        $fechas = json_decode($fechas);
        if($fechas->desde != null && $fechas->hasta != null)
        {
        $desde = date("Y-m-d",strtotime($fechas->desde));
        $hasta = date("Y-m-d",strtotime($fechas->hasta));
        $listaPedidos = array();
        if($idafiliado == 0)
        {
            if($idcliente==0)
            {
                if($estado==4)
                {
                    $arrayPedidos = DB::select("SELECT * FROM pedido WHERE (fecha BETWEEN CAST('$desde' AS DATE) AND CAST('$hasta' AS DATE)) ORDER BY id DESC");
                }else{
                    $arrayPedidos = DB::select("SELECT * FROM pedido WHERE estado = $estado AND (fecha BETWEEN CAST('$desde' AS DATE) AND CAST('$hasta' AS DATE)) ORDER BY id DESC");
                }
            }else{
                if($estado==4)
                {
                    $arrayPedidos = DB::select("SELECT * FROM pedido WHERE idcliente = $idcliente AND (fecha BETWEEN CAST('$desde' AS DATE) AND CAST('$hasta' AS DATE)) ORDER BY id DESC");
                }else{
                    $arrayPedidos = DB::select("SELECT * FROM pedido WHERE idcliente = $idcliente AND estado = $estado AND (fecha BETWEEN CAST('$desde' AS DATE) AND CAST('$hasta' AS DATE)) ORDER BY id DESC");
                }
            }
        }else{
            if($idcliente==0)
            {
                if($estado==4)
                {
                    $arrayPedidos = DB::select("SELECT * FROM pedido WHERE (fecha BETWEEN CAST('$desde' AS DATE) AND CAST('$hasta' AS DATE)) AND idafiliado = $idafiliado ORDER BY id DESC");
                }else{
                    $arrayPedidos = DB::select("SELECT * FROM pedido WHERE estado = $estado AND (fecha BETWEEN CAST('$desde' AS DATE) AND CAST('$hasta' AS DATE)) AND idafiliado = $idafiliado ORDER BY id DESC");
                }
            }else{
                if($estado==4)
                {
                    $arrayPedidos = DB::select("SELECT * FROM pedido WHERE idcliente = $idcliente AND (fecha BETWEEN CAST('$desde' AS DATE) AND CAST('$hasta' AS DATE)) AND idafiliado = $idafiliado ORDER BY id DESC");
                }else{
                    $arrayPedidos = DB::select("SELECT * FROM pedido WHERE idcliente = $idcliente AND estado = $estado AND (fecha BETWEEN CAST('$desde' AS DATE) AND CAST('$hasta' AS DATE)) AND idafiliado = $idafiliado ORDER BY id DESC");
                }
            }
        }
        
        foreach($arrayPedidos as $pedido)
        {
            $id = $pedido->id;
            $idafiliado = $pedido->idafiliado;
            $idfactura = $pedido->idfactura;
            $fecha = $pedido->fecha;
            $estado = $this->getEstado($pedido->estado);
            $afiliadoQ = DB::select("SELECT nombre FROM afiliado WHERE id = $idafiliado");
            $afiliado = $afiliadoQ[0]->nombre;
            array_push($listaPedidos, ['id' => $id, 'idafiliado' => $idafiliado, 'afiliado' => $afiliado, 'fecha' => $fecha, 'idfactura' => $idfactura, 'estado' => $estado]);
        }
        return $listaPedidos;
        }else{
            return $this->listarPedidos($idcliente);
        }

    }

    public function modificarEstado($id,$idafiliado,$estado)
    {
        DB::update('UPDATE pedido SET estado = ?  WHERE id = ? AND idafiliado = ?', [ $estado,$id, $idafiliado ]);
    }
    
}

?>