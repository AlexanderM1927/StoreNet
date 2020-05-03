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
public class EmpleadoDAO {
    
    public Empleado getEmpleado(String mail){
        Connection con = null;
        PreparedStatement pstm = null;
        ResultSet rs = null;
        Empleado empleado= null;
        try{
            con = Fachada.getConnection();
            String sql="";
            sql = "SELECT * FROM empleado WHERE mail = ?";
                         
            pstm = con.prepareStatement(sql);
            pstm.setString(1, mail);
            rs= pstm.executeQuery();
            
            while(rs.next()){
               empleado= new Empleado();
               empleado.setId(rs.getInt("id"));
               empleado.setIdafilidado(rs.getInt("idafiliado"));
               empleado.setNombres(rs.getString("nombres"));
               empleado.setApellidos(rs.getString("apellidos"));
               empleado.setMail(rs.getString("mail"));
               empleado.setDireccion(rs.getString("direccion"));
               empleado.setSueldo(rs.getInt("sueldo"));
               empleado.setPassword(rs.getString("password"));
               empleado.setTelefono(rs.getInt("telefono"));
               empleado.setRango(rs.getInt("rango"));  
           
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
  
        return empleado;
    
    }   
   
}
