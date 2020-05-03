/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Model;

/**
 *
 * @author mauri
 */
public class Producto {
    
    int id;
    String nombre, imgurl;
    int cantidad, idafiliado;
    double precioproveedor, precioventa;

    public Producto(){
        
    }    

    public Producto(int id, String nombre, String imgurl, int cantidad, int idafiliado, double precioproveedor, double precioventa) {
        this.id = id;
        this.nombre = nombre;
        this.imgurl = imgurl;
        this.cantidad = cantidad;
        this.idafiliado = idafiliado;
        this.precioproveedor = precioproveedor;
        this.precioventa = precioventa;
    }

    public int getId() {
        return id;
    }

    public String getNombre() {
        return nombre;
    }

    public String getImgurl() {
        return imgurl;
    }

    public int getCantidad() {
        return cantidad;
    }

    public int getIdafiliado() {
        return idafiliado;
    }

    public double getPrecioproveedor() {
        return precioproveedor;
    }

    public double getPrecioventa() {
        return precioventa;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public void setImgurl(String imgurl) {
        this.imgurl = imgurl;
    }

    public void setCantidad(int cantidad) {
        this.cantidad = cantidad;
    }

    public void setIdafiliado(int idafiliado) {
        this.idafiliado = idafiliado;
    }

    public void setPrecioproveedor(double precioproveedor) {
        this.precioproveedor = precioproveedor;
    }

    public void setPrecioventa(double precioventa) {
        this.precioventa = precioventa;
    }
      
    
    
    
}
