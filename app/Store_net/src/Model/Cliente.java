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
public class Cliente {
    
    private int id;
    private String nombre;
    private String apellido;
    private String correo;
    private String direccion;
    private String contrasena;
    private int telefono;
    private int estado;
    
    public Cliente(){
        
    }

    public Cliente(int id, String nombre, String apellido, String correo, String direccion, String contrasena, int telefono, int estado) {
        this.id = id;
        this.nombre = nombre;
        this.apellido = apellido;
        this.correo = correo;
        this.direccion = direccion;
        this.contrasena = contrasena;
        this.telefono = telefono;
        this.estado = estado;
    }
    

    public int getId() {
        return id;
    }

    public String getNombre() {
        return nombre;
    }

    public String getApellido() {
        return apellido;
    }

    public String getCorreo() {
        return correo;
    }

    public String getDireccion() {
        return direccion;
    }

    public String getContrasena() {
        return contrasena;
    }

    public int getTelefono() {
        return telefono;
    }

    public int getEstado() {
        return estado;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public void setApellido(String apellido) {
        this.apellido = apellido;
    }

    public void setCorreo(String correo) {
        this.correo = correo;
    }

    public void setDireccion(String direccion) {
        this.direccion = direccion;
    }

    public void setContrasena(String contrasena) {
        this.contrasena = contrasena;
    }

    public void setTelefono(int telefono) {
        this.telefono = telefono;
    }

    public void setEstado(int estado) {
        this.estado = estado;
    }
    
    

}