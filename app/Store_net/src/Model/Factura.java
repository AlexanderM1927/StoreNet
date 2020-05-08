/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Model;

import java.sql.Date;

/**
 *
 * @author mauri
 */
public class Factura {
    
    private int id, idafilidado, idcliente, idempleado, anulada;
    private Date fecha;
    
    public Factura(){
        
    }

    public Factura(int id, int idafilidado, int idcliente, int idempleado, int anulada, Date fecha) {
        this.id = id;
        this.idafilidado = idafilidado;
        this.idcliente = idcliente;
        this.idempleado = idempleado;
        this.anulada = anulada;
        this.fecha = fecha;
    }

    public int getId() {
        return id;
    }

    public int getIdafilidado() {
        return idafilidado;
    }

    public int getIdcliente() {
        return idcliente;
    }

    public int getIdempleado() {
        return idempleado;
    }

    public int getAnulada() {
        return anulada;
    }

    public Date getFecha() {
        return fecha;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setIdafilidado(int idafilidado) {
        this.idafilidado = idafilidado;
    }

    public void setIdcliente(int idcliente) {
        this.idcliente = idcliente;
    }

    public void setIdempleado(int idempleado) {
        this.idempleado = idempleado;
    }

    public void setAnulada(int anulada) {
        this.anulada = anulada;
    }

    public void setFecha(Date fecha) {
        this.fecha = fecha;
    }
    
    
}
