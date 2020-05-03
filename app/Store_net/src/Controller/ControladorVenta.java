/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Controller;

import Model.Producto;
import Model.ProductoDAO;
import View.Venta;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.util.ArrayList;
import javax.swing.JOptionPane;

/**
 *
 * @author mauri
 */
public class ControladorVenta implements  KeyListener, MouseListener, ActionListener{
    
    private Venta venta;
    private ProductoDAO productodao;
    int seleccion;
    private ArrayList<Object[]> productos;
    
    public ControladorVenta(Venta venta, ProductoDAO productodao){
        this.venta=venta;
        this.productodao= productodao;      
        venta.AddListenerBtAgregar(this);
        venta.AddListenerBtEliminar(this);
        venta.AddListenerBtCancelar(this);
        venta.AddKeyPressedtxtNombreProducto(this);
        venta.addTableVentaMouseClicked(this);
        productos= new ArrayList<Object[]>();
        seleccion=-1;
    }
    

    @Override
    public void mouseClicked(MouseEvent me) {
        seleccion= venta.getTableVenta().getSelectedRow();
        venta.setEnablebtEliminar(true);
    }

    @Override
    public void mousePressed(MouseEvent me) {
        //throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }

    @Override
    public void mouseReleased(MouseEvent me) {
        //throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }

    @Override
    public void mouseEntered(MouseEvent me) {
        //throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }

    @Override
    public void mouseExited(MouseEvent me) {
        //throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }  

    @Override
    public void actionPerformed(ActionEvent ae) {
         if(ae.getActionCommand().equalsIgnoreCase("Agregar")){
           Producto p= null;
           try{
              int id=Integer.parseInt(venta.getTxtIdProducto());
              int cantidad= Integer.parseInt(venta.getTxtCantidadProducto());
              p= productodao.getProductoById(id);
              
              if(cantidad<=p.getCantidad()){
                 Object[] valores= new Object[5];
                 valores[0]= id;
                 valores[1]= p.getNombre();
                 valores[2]= cantidad;
                 valores[3]= (p.getPrecioventa()*cantidad);
                 
                 productos.add(valores);
                 caluclarTotalesAbsolutos();
                 venta.agregarProductoTablaVenta(productos);
                 productodao.updateExistencias(id, p.getCantidad()-cantidad);
                 venta.setTxtCantidadProducto("");
                 venta.setTxtIdProducto(""); 
              }else{
                  JOptionPane.showMessageDialog(null, "Del producto "+ p.getNombre()+" quedan "+ p.getCantidad()+" existencias");
              }   
           }catch(Exception e){
               JOptionPane.showMessageDialog(null, "Campos ingresados incorrectamente");
           } 
       }
         
         if(ae.getActionCommand().equalsIgnoreCase("Eliminar")){
            
             Producto p= productodao.getProductoById((int)productos.get(seleccion)[0]);
             productodao.updateExistencias((int)productos.get(seleccion)[0],p.getCantidad()+(int)productos.get(seleccion)[2]);
             productos.remove(seleccion);
             caluclarTotalesAbsolutos();
             venta.agregarProductoTablaVenta(productos);
         }
         
          if(ae.getActionCommand().equalsIgnoreCase("Cancelar")){
              
              for(int i=0; i<productos.size(); i++){
                  Producto p= productodao.getProductoById((int)productos.get(i)[0]);
                  productodao.updateExistencias((int)productos.get(i)[0],p.getCantidad()+(int)productos.get(i)[2]);
              }
              productos= new ArrayList<Object[]>();
              venta.agregarProductoTablaVenta(productos);
              venta.setEnablebtEliminar(false);
          }
    }
    
    
    
    public void caluclarTotalesAbsolutos(){
        Producto p= null;
        if(productos.size()==1){
            p= productodao.getProductoById((int)productos.get(0)[0]);
            productos.get(0)[4]= ((int)productos.get(0)[2])*p.getPrecioventa();  
        }
        
        for(int i=1; i<productos.size(); i++){
        p= productodao.getProductoById((int)productos.get(i)[0]);
        productos.get(i)[4]= ((int)productos.get(i)[2])*p.getPrecioventa()+(double)productos.get(i-1)[4]; 
              
        }    
    }

    @Override
    public void keyTyped(KeyEvent ke) {
        
    }

    @Override
    public void keyPressed(KeyEvent ke) {
       
    }

    @Override
    public void keyReleased(KeyEvent ke) {
        ArrayList<Object[]> objetosprodcs=  new ArrayList<Object[]>();
        String name=venta.getTxtnombreProducto(); 
        ArrayList<Producto> prodcs=productodao.listaProductos(name);
        if(prodcs.size()==0){
            venta.limpiarTablaInventario();
        }
        for(int i=0; i<prodcs.size(); i++){
           Object[] valores= new Object[5];
           Producto p=prodcs.get(i);
           valores[0]= p.getId();
           valores[1]= p.getNombre();
           valores[2]= p.getCantidad();
           valores[3]= p.getPrecioventa();
           objetosprodcs.add(valores);
           venta.agregarProductoTablaInventario(objetosprodcs);
        } 
    }
    
}
