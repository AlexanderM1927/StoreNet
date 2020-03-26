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
public class Empleado {
    
    private int id;
    private String nombre;
    private String apellido;
    private String correo;
    private String usuario;
    private String contrasena;
    private String telefono;
    private String rango;
    
    public Empleado(){
        
    }
    

    public Empleado(int id, String nombre, String apellido, String correo, String usuario, String contraseña, String telefono, String rango) {
        this.id = id;
        this.nombre = nombre;
        this.apellido = apellido;
        this.correo = correo;
        this.usuario = usuario;
        this.contrasena = contraseña;
        this.telefono = telefono;
        this.rango = rango;
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

    public String getUsuario() {
        return usuario;
    }

    public String getContraseña() {
        return contrasena;
    }

    public String getTelefono() {
        return telefono;
    }

    public String getRango() {
        return rango;
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

    public void setUsuario(String usuario) {
        this.usuario = usuario;
    }

    public void setContraseña(String contraseña) {
        this.contrasena = contraseña;
    }

    public void setTelefono(String telefono) {
        this.telefono = telefono;
    }

    public void setRango(String rango) {
        this.rango = rango;
    }
    
    
    
}