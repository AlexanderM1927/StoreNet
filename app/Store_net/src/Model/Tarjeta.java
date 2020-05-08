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
public class Tarjeta {
    
    private int id, idcliente, puntos;
    private double saldo;
    
    public Tarjeta(){
        
    }

    public Tarjeta(int id, int idcliente, int puntos, double saldo) {
        this.id = id;
        this.idcliente = idcliente;
        this.puntos = puntos;
        this.saldo = saldo;
    }

    public int getId() {
        return id;
    }

    public int getIdcliente() {
        return idcliente;
    }

    public int getPuntos() {
        return puntos;
    }

    public double getSaldo() {
        return saldo;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setIdcliente(int idcliente) {
        this.idcliente = idcliente;
    }

    public void setPuntos(int puntos) {
        this.puntos = puntos;
    }

    public void setSaldo(double saldo) {
        this.saldo = saldo;
    }
    
    
    
    
}
