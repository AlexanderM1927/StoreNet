/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Model;

import Services.Fachada;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import javax.swing.JOptionPane;

/**
 *
 * @author mauri
 */
public class TarjetaDAO {
    
    public Tarjeta getTarjetaByClienteId(int id){
         Connection con = null;
        PreparedStatement pstm = null;
        ResultSet rs = null;
        Tarjeta tarjeta= null;
        try{
            con = Fachada.getConnection();
            String sql="";
            sql = "SELECT * FROM tarjeta WHERE idcliente = ?";
                         
            pstm = con.prepareStatement(sql);
            pstm.setInt(1, id);
            rs= pstm.executeQuery();
            
            while(rs.next()){
               tarjeta= new Tarjeta();
               tarjeta.setId(rs.getInt("id"));
               tarjeta.setIdcliente(id);
               tarjeta.setSaldo(rs.getDouble("saldo"));
               tarjeta.setPuntos(rs.getInt("puntos"));
           
            }
           
        }
        catch(SQLException ex){
            JOptionPane.showMessageDialog(null,"Código : " + 
                        ex.getErrorCode() + "\nError :" + ex.getMessage());
        }
        finally{
            try{
                if(rs!=null) rs.close();
                if(pstm!=null) pstm.close();                
            }
            catch(SQLException ex){
                JOptionPane.showMessageDialog(null,"Código : " + 
                        ex.getErrorCode() + "\nError :" + ex.getMessage());
            }
        }
  
        return tarjeta;
    
    }
    
    public int updateTarjeta(int clienteid, double saldo){      
        Connection con = null;
        PreparedStatement pstm;
        pstm = null;
        int rtdo;
        rtdo = 0;
        try{
            con = Fachada.getConnection();
            String sql = "UPDATE tarjeta " +
                         "SET saldo = ? "
                    +    "WHERE idcliente=?";
            pstm = con.prepareStatement(sql);            
           
            pstm.setDouble(1, saldo);
            pstm.setInt(2, clienteid);
            rtdo = pstm.executeUpdate();  
        }
        catch(SQLException ex){
            JOptionPane.showMessageDialog(null,"Código : " + 
                        ex.getErrorCode() + "\nError :" + ex.getMessage());
        }
        finally{
            try{
                if(pstm!=null) pstm.close();                
            }
            catch(SQLException ex){
                JOptionPane.showMessageDialog(null,"Código : " + 
                        ex.getErrorCode() + "\nError :" + ex.getMessage());
            }
        }
        return rtdo;
    }
    
}
