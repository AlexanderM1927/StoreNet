<?php


class Lector{
    public $archivo;
    public $imagenes;
    public $nombres;
    public $precios;
    public $tipo;


function retornaLink($contenido)
{
    $newContenido = str_replace('data-src="/',"",$contenido);
    return "https://www.alkomprar.com/".str_replace('"',"",$newContenido);
}

function desglosar($linea){
    $atributos = explode(" ",$linea);
    // var_dump($atributos);
    for($i=0;$i<count($atributos);$i++)
    {
        if($atributos[$i] == 'alt="'.$this->tipo.'')
        {
            array_push($this->imagenes, $this->retornaLink($atributos[$i-1]));
            array_push($this->nombres, $this->tipo." ".$atributos[$i+1]." ".$atributos[$i+2]." ".$atributos[$i+3]);
        }else{
            $newContenido = str_replace('<spanclass="price">','<spanclass="price"> ',$atributos[$i]);
            $newContenido2 = str_replace('</span>',' </span>',$newContenido);
            if(strpos($newContenido2,'</span>'))
            {
                $contenidoN = str_replace('class="price">$','',$atributos[$i]);
                $contenidoN = str_replace('</span>','',$contenidoN);
                $contenidoN = str_replace('.','',$contenidoN);
                array_push($this->precios, $contenidoN);
            }
        }
    }
}

function ejecutar($tipo)
{
    $this->archivo = fopen("result.txt","rb");
    $this->imagenes = array();
    $this->nombres = array();
    $this->precios = array();
    $this->tipo = $tipo;
    if($this->archivo == false)
    {
        echo "No se encontró el archivo, primero ejecute el .bat";
    }else{
        while($linea = fgets($this->archivo)) {
            $atributos_img = strpos($linea,"<img");
            $atributos_title = strpos($linea,'title="Alkomprar"');
            $atributos_price = strpos($linea,'class="price"');
            if($atributos_img !== false && $atributos_title === false)
            {
                $this->desglosar($linea);
            }else if($atributos_price !== false)
            {
                $this->desglosar($linea);
            }
        }
        fclose($this->archivo);
    }
}

}

$conexion = mysqli_connect("localhost","root","rootadmin","storenet") or die('Conexion DB fallo');
$tipo = $argv[1];
$empresa = $argv[2];
$lector = new Lector;
$lector->ejecutar($tipo);
for($i=0;$i<count($lector->imagenes);$i++)
{
    $imgurl = $lector->imagenes[$i];
    $nombre = $lector->nombres[$i];
    $preciov = $lector->precios[$i];
    $insert = mysqli_query($conexion,"INSERT INTO producto(imgurl,nombre,precioventa,precioproveedor,cantidad,idafiliado) VALUES ('$imgurl','$nombre',$preciov,($preciov*0.8),50,$empresa)");
    if($insert==false) echo "No se interto en la base de datos\n";
    else echo "Producto guardado correctamente\n";
}
?>