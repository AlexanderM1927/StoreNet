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
public class Venta {
    
    private int id, idfactura, idproducto, idafiliado, cantidad;
    
    public Venta(){
        
    }

    public Venta(int id, int idfactura, int idproducto, int idafiliado, int cantidad) {
        this.id = id;
        this.idfactura = idfactura;
        this.idproducto = idproducto;
        this.idafiliado = idafiliado;
        this.cantidad = cantidad;
    }

    public int getId() {
        return id;
    }

    public int getIdfactura() {
        return idfactura;
    }

    public int getIdproducto() {
        return idproducto;
    }

    public int getIdafiliado() {
        return idafiliado;
    }

    public int getCantidad() {
        return cantidad;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setIdfactura(int idfactura) {
        this.idfactura = idfactura;
    }

    public void setIdproducto(int idproducto) {
        this.idproducto = idproducto;
    }

    public void setIdafiliado(int idafiliado) {
        this.idafiliado = idafiliado;
    }

    public void setCantidad(int cantidad) {
        this.cantidad = cantidad;
    }
    
     
    
    
}
