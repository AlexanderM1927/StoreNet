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
public class ProductoDAO {
    
     public ProductoDAO(){
         
     }
     
     
     public Producto getProductoById(int id){
         Connection con = null;
        PreparedStatement pstm = null;
        ResultSet rs = null;
        Producto producto= null;
        try{
            con = Fachada.getConnection();
            String sql="";
            sql = "SELECT * FROM producto WHERE id = ?";
                         
            pstm = con.prepareStatement(sql);
            pstm.setInt(1, id);
            rs= pstm.executeQuery();
            
            while(rs.next()){
               producto= new Producto();
               producto.setCantidad(rs.getInt("cantidad"));
               producto.setId(rs.getInt("id"));
               producto.setIdafiliado(rs.getInt("idafiliado"));
               producto.setImgurl(rs.getString("imgurl"));
               producto.setNombre(rs.getString("nombre"));
               producto.setPrecioproveedor(rs.getDouble("precioproveedor"));
               producto.setPrecioventa(rs.getDouble("precioventa"));
           
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
  
        return producto;
    
    }
     
     
    public ArrayList<Producto> listaProductos(String name){      
        Connection con = null;
        PreparedStatement pstm = null;
        ResultSet rs = null;
        ArrayList<Producto> productos = new ArrayList<Producto>();
        try{
            con = Fachada.getConnection();
            String sql="SELECT * FROM producto WHERE nombre LIKE ? "
                        + "ORDER BY id";
            
            pstm = con.prepareStatement(sql);
            pstm.setString(1, "%"+name+"%");
            
            rs = pstm.executeQuery();

            Producto producto= null;
            while(rs.next()){
               producto= new Producto();
               producto.setCantidad(rs.getInt("cantidad"));
               producto.setId(rs.getInt("id"));
               producto.setIdafiliado(rs.getInt("idafiliado"));
               producto.setImgurl(rs.getString("imgurl"));
               producto.setNombre(rs.getString("nombre"));
               producto.setPrecioproveedor(rs.getDouble("precioproveedor"));
               producto.setPrecioventa(rs.getDouble("precioventa"));
               productos.add(producto);
                
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
        return productos;
    }
     
     public int updateExistencias(int id, int existencias){
          Connection con = null;
        PreparedStatement pstm;
        pstm = null;
        int rtdo;
        rtdo = 0;
        try{
            con = Fachada.getConnection();
            String sql = "UPDATE producto " +
                         "SET cantidad = ? "
                    +    "WHERE id=?";
            pstm = con.prepareStatement(sql);            
            
            pstm.setInt(1, existencias);
            pstm.setDouble(2, id);
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
