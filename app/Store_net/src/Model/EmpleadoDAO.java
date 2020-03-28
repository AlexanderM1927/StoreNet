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
    
    public Empleado getEmpleado(String username){
        Connection con = null;
        PreparedStatement pstm = null;
        ResultSet rs = null;
        Empleado empleado= null;
        try{
            con = Fachada.getConnection();
            String sql="";
            sql = "SELECT * FROM empleado WHERE usuario = ?";
                         
            pstm = con.prepareStatement(sql);
            pstm.setString(1, username);
            rs= pstm.executeQuery();
            
            while(rs.next()){
               empleado= new Empleado();
               empleado.setId(rs.getInt("id"));
               empleado.setNombre(rs.getString("nombre"));
               empleado.setApellido(rs.getString("apellido"));
               empleado.setCorreo(rs.getString("correo"));
               empleado.setUsuario(rs.getString("usuario"));
               empleado.setContraseña(rs.getString("contrasena"));
               empleado.setTelefono(rs.getString("telefono"));
               empleado.setRango(rs.getString("rango"));  
           
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
    
    
    public int ingresarEmpleado(Empleado e){      
        Connection con = null;
        PreparedStatement pstm;
        pstm = null;
        int rtdo;
        rtdo = 0;
        try{
            con = Fachada.getConnection();
            
            String sql = "INSERT INTO cliente values (?,?,?,?,?,?,?,?)";
            
            pstm = con.prepareStatement(sql);
            pstm.setInt(1, e.getId());
            pstm.setString(2, e.getNombre());
            pstm.setString(3,e.getApellido());
            pstm.setString(4,e.getCorreo());
            pstm.setString(5,e.getUsuario());
            pstm.setString(6,e.getContraseña());
            pstm.setString(7,e.getTelefono());
            pstm.setString(8,e.getRango());
            
            
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
