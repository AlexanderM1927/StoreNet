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
    String nombre;
    int precio;
    String fechaVencimineto;

    public Producto(int id, String nombre, int precio, String fechaVencimineto) {
        this.id = id;
        this.nombre = nombre;
        this.precio = precio;
        this.fechaVencimineto = fechaVencimineto;
    }

    public int getId() {
        return id;
    }

    public String getNombre() {
        return nombre;
    }

    public int getPrecio() {
        return precio;
    }

    public String getFechaVencimineto() {
        return fechaVencimineto;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public void setPrecio(int precio) {
        this.precio = precio;
    }

    public void setFechaVencimineto(String fechaVencimineto) {
        this.fechaVencimineto = fechaVencimineto;
    }
    
    
        
    
}
