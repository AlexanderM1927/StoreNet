/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Controller;

import Model.Cliente;
import Model.ClienteDAO;
import Model.Factura;
import Model.FacturaDAO;
import Model.Producto;
import Model.ProductoDAO;
import Model.TarjetaDAO;
import Model.Venta;
import Model.VentaDAO;
import View.Main;
import View.VentaView;
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
import java.sql.Date;


/**
 *
 * @author mauri
 */
public class ControladorVenta implements  KeyListener, MouseListener, ActionListener{
    
    private VentaView venta;
    private ProductoDAO productodao;
    private ClienteDAO clientedao;
    private FacturaDAO facturadao;
    private VentaDAO ventadao;
    private TarjetaDAO tarjetadao;
    int seleccion;
    double total;
    double saldo;
    private ArrayList<Object[]> productos;
    private Cliente cliente;
    private Main ppal;
    
    public ControladorVenta(Main ppal, VentaView venta, ProductoDAO productodao, ClienteDAO clientedao, 
                            FacturaDAO facturadao, VentaDAO ventadao, TarjetaDAO tarjetadao){
        this.venta=venta;
        this.productodao= productodao;
        this.clientedao= clientedao;
        this.facturadao= facturadao;
        this.ventadao= ventadao;
        this.tarjetadao= tarjetadao;
        this.ppal=ppal;
        cliente = null;
        venta.AddListenerBtAgregar(this);
        venta.AddListenerBtEliminar(this);
        venta.AddListenerBtCancelar(this);
        venta.AddListenerBtAceptar(this);
        venta.AddListenerBtVenta(this); 
        venta.AddKeyPressedtxtNombreProducto(this);
        venta.addTableVentaMouseClicked(this);
        productos= new ArrayList<Object[]>();
        seleccion=-1;
        saldo=0;
        total=0;
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
                 total= (double)productos.get(productos.size()-1)[4]-saldo;
                 if(total<0){
                     venta.setTxtTotalConDescuento(0+"");
                 }else{
                     venta.setTxtTotalConDescuento(total+"");
                 }
                 
                 venta.setTxtCantidadProducto("");
                 venta.setTxtIdProducto("");
                 if(cliente!=null){
                     venta.setEnabledVenta(true);
                 }
              }else{
                  JOptionPane.showMessageDialog(null, "Del producto "+ p.getNombre()+" quedan "+ p.getCantidad()
                                               +" existencias");
              }   
           }catch(Exception e){
               JOptionPane.showMessageDialog(null, "Campos ingresados incorrectamente");
           } 
       }
         
         if(ae.getActionCommand().equalsIgnoreCase("Eliminar")){
            
             productos.remove(seleccion);
             caluclarTotalesAbsolutos();
             total= (double)productos.get(productos.size()-1)[4]-saldo;
             if(total<0){
                     venta.setTxtTotalConDescuento(0+"");
                 }else{
                     venta.setTxtTotalConDescuento(total+"");
                 }
             venta.agregarProductoTablaVenta(productos);
         }
         
          if(ae.getActionCommand().equalsIgnoreCase("Cancelar")){
              limpiarCampos();
          }
          
          if(ae.getActionCommand().equalsIgnoreCase("Aceptar")){
              String correo= venta.getTxtCorreo();
              Cliente c= clientedao.getClienteByEmail(correo);
              if(c == null){
                  JOptionPane.showMessageDialog(null, "Cliente no encontrado");
              }else{
                  venta.setTxtId(c.getId()+"");
                  venta.setTxtNombres(c.getNombre());
                  venta.setTxtApellidos(c.getApellido());
                  venta.setTxtDireccion(c.getDireccion());
                  venta.setTxtTelefono(c.getTelefono()+"");
                  saldo=tarjetadao.getTarjetaByClienteId(c.getId()).getSaldo();
                  venta.setTxtSaldo("$"+saldo);
                  
                  cliente = c;
                  if(productos.size()>0){
                      total= (double)productos.get(productos.size()-1)[4]-saldo;
                      if(total<0){
                        venta.setTxtTotalConDescuento(0+""); 
                      }else{
                         venta.setTxtTotalConDescuento(total+"");
                      }
                      venta.setEnabledVenta(true);
                  }
              }
          }
          
          if(ae.getActionCommand().equalsIgnoreCase("Venta")){
              Date date= new Date(System.currentTimeMillis());
              Factura factura= new Factura(0, ppal.getEmpleado().getIdafilidado(), cliente.getId(), 
                                           ppal.getEmpleado().getId(), 0, date);
              facturadao.registrarFactura(factura);
              for(int i=0; i< productos.size();i++){
                  int idfac= facturadao.getLastID(factura.getIdafilidado());
                  int idprod= (int)productos.get(i)[0];
                  int idafi= factura.getIdafilidado();
                  int cant= (int)productos.get(i)[2];
                  int existencias=productodao.getProductoById(idprod).getCantidad();
                  productodao.updateExistencias(idprod, existencias-cant);
                  Venta ven= new Venta(0, idfac, idprod, idafi, cant);
                  ventadao.registrarVenta(ven);
                  
              }
                  
                  double descontado =(double)productos.get(productos.size()-1)[4];
                  if(saldo<descontado){
                      descontado=0;
                  }else{
                      descontado= saldo-descontado;
                  }
                  tarjetadao.updateTarjeta(cliente.getId(), descontado);
                  JOptionPane.showMessageDialog(null, "VENTA REALIZADA CON EXITO");
                  limpiarCampos();
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
    
    public void limpiarCampos(){
        venta.setTxtId("");
        venta.setTxtIdProducto("");
        venta.setTxtNombres("");
        venta.setTxtCantidadProducto("");
        venta.setTxtApellidos("");
        venta.setTxtSaldo("");
        venta.setTxtCorreo("");
        venta.setTxtTelefono("");
        venta.setTxtTotalConDescuento("");
        venta.setTxtDireccion("");
        venta.setTxtId("");
        
        productos= new ArrayList<Object[]>();
        venta.agregarProductoTablaVenta(productos);
        venta.setEnablebtEliminar(false);
        venta.setEnabledVenta(false);
        cliente= null;
        saldo=0;
        total=0;
        
    }
    
    @Override
    public void keyTyped(KeyEvent ke) {
        
    }

    @Override
    public void keyPressed(KeyEvent ke) {
       
    }

    @Override
    public void keyReleased(KeyEvent e) {
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
