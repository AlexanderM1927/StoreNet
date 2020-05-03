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
    
    
    
    public int ingresarCliente(Cliente c){      
        Connection con = null;
        PreparedStatement pstm;
        pstm = null;
        int rtdo;
        rtdo = 0;
        try{
            con = Fachada.getConnection();
            
            String sql = "INSERT INTO cliente values (?,?,?,?,?,?,?)";
            
            pstm = con.prepareStatement(sql);
            pstm.setInt(1, c.getId());
            pstm.setString(2, c.getNombre());
            pstm.setString(3,c.getApellido());
            pstm.setString(4,c.getCorreo());
            pstm.setString(5,c.getUsuario());
            pstm.setString(6,c.getContraseña());
            pstm.setString(7,c.getTelefono());
            
            
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
    
    
    public Cliente getClienteByEmail(String email){
         Connection con = null;
        PreparedStatement pstm = null;
        ResultSet rs = null;
        Cliente cliente= null;
        try{
            con = Fachada.getConnection();
            String sql="";
            sql = "SELECT * FROM cliente WHERE usuario = ?";
                         
            pstm = con.prepareStatement(sql);
            pstm.setString(1, email);
            rs= pstm.executeQuery();
            
            while(rs.next()){
               cliente= new Cliente();
               cliente.setId(rs.getInt("id"));
               cliente.setNombre(rs.getString("nombre"));
               cliente.setApellido(rs.getString("apellido"));
               cliente.setCorreo(rs.getString("correo"));
               cliente.setUsuario(rs.getString("usuario"));
               cliente.setContraseña(rs.getString("contrasena"));
               cliente.setTelefono(rs.getString("telefono"));
           
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
               cliente.setNombre(rs.getString("nombre"));
               cliente.setApellido(rs.getString("apellido"));
               cliente.setCorreo(rs.getString("correo"));
               cliente.setUsuario(rs.getString("usuario"));
               cliente.setContraseña(rs.getString("contrasena"));
               cliente.setTelefono(rs.getString("telefono"));
           
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
    
    
    public int modificarCliente(Cliente c){      
        Connection con = null;
        PreparedStatement pstm;
        pstm = null;
        int rtdo;
        rtdo = 0;
        try{
            con = Fachada.getConnection();
            String sql = "UPDATE cliente " +
                         "SET name = ?, apellido = ?, correo = ?, usuario = ?, contrasena = ? "
                    +    "telefono = ? "
                    +    "WHERE id=?";
            pstm = con.prepareStatement(sql);            
            pstm.setString(1, c.getNombre());
            pstm.setString(2, c.getApellido());
            pstm.setString(3, c.getCorreo());
            pstm.setString(4, c.getUsuario());
            pstm.setString(5, c.getContraseña());
            pstm.setString(6, c.getTelefono());
            pstm.setInt(7, c.getId());
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
                cliente=new Cliente();
                cliente.setId(rs.getInt("id"));
                cliente.setNombre(rs.getString("nombre"));
                cliente.setApellido(rs.getString("apellido"));
                cliente.setCorreo(rs.getString("correo"));
                cliente.setUsuario(rs.getString("usuario"));
                cliente.setContraseña(rs.getString("contrasena"));
                cliente.setTelefono(rs.getString("telefono"));            
                
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
