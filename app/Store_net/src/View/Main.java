package View;

import Controller.ControladorLogin;
import Controller.ControladorVenta;
import Model.ClienteDAO;
import Model.Empleado;
import Model.EmpleadoDAO;
import Model.FacturaDAO;
import Model.Producto;
import Model.ProductoDAO;
import Model.TarjetaDAO;
import Model.VentaDAO;
import Services.Fachada;

public class Main {
    
    private ControladorLogin controllogin;
    private ControladorVenta controlventa;
    private LoginUserGI login;
    private ClienteDAO clientedao;
    private EmpleadoDAO empleadodao;
    private ProductoDAO productodao;
    private FacturaDAO facturadao;
    private VentaDAO ventadao;
    private TarjetaDAO tarjetadao;
    private Invoice invoice;
    private VentaView venta;
    private Empleado empleado;
    
    public Main(){
        
        login= new  LoginUserGI();
        clientedao = new ClienteDAO();
        empleadodao= new EmpleadoDAO();
        productodao= new ProductoDAO();
        facturadao= new FacturaDAO();
        ventadao= new VentaDAO();
        tarjetadao= new TarjetaDAO();
        empleado= null;
        
        controllogin= new ControladorLogin(login, empleadodao, this);  
        login.setVisible(true);
        venta= new VentaView();
        
     
        controlventa= new ControladorVenta(this, venta, productodao, clientedao, facturadao, ventadao, tarjetadao); 
        
        invoice= new Invoice(venta);
        
    }
    
    public void activarFactura(){
        login.setVisible(false);
        invoice.setVisible(true);
    }
     
    public void setEmpleado(Empleado empleado){
        this.empleado = empleado;
    }
    
    public Empleado getEmpleado(){
        return empleado;
    }

    public static void main(String[] args) {
        
        Main main= new Main();
       
        }
    
}
