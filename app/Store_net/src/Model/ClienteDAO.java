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
import java.util.ArrayList;
import javax.swing.JOptionPane;

/**
 *
 * @author mauri
 */
public class ClienteDAO {
     
    
    public Cliente getClienteByEmail(String email){
         Connection con = null;
        PreparedStatement pstm = null;
        ResultSet rs = null;
        Cliente cliente= null;
        try{
            con = Fachada.getConnection();
            String sql="";
            sql = "SELECT * FROM cliente WHERE mail = ?";
                         
            pstm = con.prepareStatement(sql);
            pstm.setString(1, email);
            rs= pstm.executeQuery();
            
            while(rs.next()){
               cliente= new Cliente();
               cliente.setId(rs.getInt("id"));
               cliente.setNombre(rs.getString("nombres"));
               cliente.setApellido(rs.getString("apellidos"));
               cliente.setCorreo(rs.getString("mail"));
               cliente.setTelefono(rs.getInt("telefono"));
               cliente.setDireccion(rs.getString("direccion"));
               cliente.setContrasena(rs.getString("password"));
               cliente.setEstado(rs.getInt("estado"));
           
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
  
        return cliente;
    
    }
    
    public Cliente getClienteById(int id){
         Connection con = null;
        PreparedStatement pstm = null;
        ResultSet rs = null;
        Cliente cliente= null;
        try{
            con = Fachada.getConnection();
            String sql="";
            sql = "SELECT * FROM cliente WHERE id = ?";
                         
            pstm = con.prepareStatement(sql);
            pstm.setInt(1, id);
            rs= pstm.executeQuery();
            
            while(rs.next()){
               cliente= new Cliente();
               cliente.setId(rs.getInt("id"));
               cliente.setNombre(rs.getString("nombres"));
               cliente.setApellido(rs.getString("apellidos"));
               cliente.setCorreo(rs.getString("mail"));
               cliente.setTelefono(rs.getInt("telefono"));
               cliente.setContrasena(rs.getString("password"));
               cliente.setEstado(rs.getInt("estado"));
           
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
  
        return cliente;
    
    }
   
    public ArrayList<Cliente> listaClientes(){      
        Connection con = null;
        PreparedStatement pstm = null;
        ResultSet rs = null;
        ArrayList<Cliente> listado = new ArrayList<>();
        try{
            con = Fachada.getConnection();
            String sql="";
            
            sql="SELECT * FROM cliente ORDER BY id";
                                 
            pstm = con.prepareStatement(sql);
            
            rs = pstm.executeQuery();

            Cliente cliente=null;
            while(rs.next()){
                cliente= new Cliente();
               cliente.setId(rs.getInt("id"));
               cliente.setNombre(rs.getString("nombres"));
               cliente.setApellido(rs.getString("apellidos"));
               cliente.setCorreo(rs.getString("mail"));
               cliente.setTelefono(rs.getInt("telefono"));
               cliente.setContrasena(rs.getString("password"));
               cliente.setEstado(rs.getInt("estado"));        
                
                listado.add(cliente);
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
        return listado;
    }
    
}
