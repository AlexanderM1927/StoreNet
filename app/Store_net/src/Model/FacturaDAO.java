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
public class FacturaDAO {
    
    
    public int registrarFactura(Factura f){      
        Connection con = null;
        PreparedStatement pstm;
        pstm = null;
        int rtdo;
        rtdo = 0;
        try{
            con = Fachada.getConnection();
            String sql = "INSERT INTO factura values (?,?,?,?,?,?)";
            pstm = con.prepareStatement(sql);
            pstm.setInt(1, f.getId());
            pstm.setInt(2, f.getIdafilidado());
            pstm.setInt(3, f.getIdcliente());
            pstm.setInt(4, f.getIdempleado());
            pstm.setInt(5, f.getAnulada());
            pstm.setDate(6, f.getFecha());
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
    
    
    public int getLastID(int idAfiliado){
        Connection con = null;
        PreparedStatement pstm = null;
        ResultSet rs = null;
        int id = 0;
        try{
            con = Fachada.getConnection();
            String sql="";
            sql = "SELECT MAX(id) as id FROM factura WHERE idafiliado = ?";
                        
            pstm = con.prepareStatement(sql);
            pstm.setInt(1, idAfiliado);
            rs= pstm.executeQuery();
            
            while(rs.next()){
               id= rs.getInt("id");
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
  
        return id;
    }
}
