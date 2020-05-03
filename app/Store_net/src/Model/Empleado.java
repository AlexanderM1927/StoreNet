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
    private int idafilidado;
    private String mail;
    private String password;
    private String direccion;
    private int telefono;
    private int rango;
    private double sueldo;
    private String nombres;
    private String apellidos;

    
    
    
    public Empleado(){
        
    }

    public Empleado(int id, int idafilidado, String mail, String password, String direccion, int telefono, int rango, double sueldo, String nombres, String apellidos) {
        this.id = id;
        this.idafilidado = idafilidado;
        this.mail = mail;
        this.password = password;
        this.direccion = direccion;
        this.telefono = telefono;
        this.rango = rango;
        this.sueldo = sueldo;
        this.nombres = nombres;
        this.apellidos = apellidos;
    }

    public int getId() {
        return id;
    }

    public int getIdafilidado() {
        return idafilidado;
    }

    public String getMail() {
        return mail;
    }

    public String getPassword() {
        return password;
    }

    public String getDireccion() {
        return direccion;
    }

    public int getTelefono() {
        return telefono;
    }

    public int getRango() {
        return rango;
    }

    public double getSueldo() {
        return sueldo;
    }

    public String getNombres() {
        return nombres;
    }

    public String getApellidos() {
        return apellidos;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setIdafilidado(int idafilidado) {
        this.idafilidado = idafilidado;
    }

    public void setMail(String mail) {
        this.mail = mail;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public void setDireccion(String direccion) {
        this.direccion = direccion;
    }

    public void setTelefono(int telefono) {
        this.telefono = telefono;
    }

    public void setRango(int rango) {
        this.rango = rango;
    }

    public void setSueldo(double sueldo) {
        this.sueldo = sueldo;
    }

    public void setNombres(String nombres) {
        this.nombres = nombres;
    }

    public void setApellidos(String apellidos) {
        this.apellidos = apellidos;
    }
    
    
    

}