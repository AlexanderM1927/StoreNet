package View;

import Controller.ControladorLogin;
import Controller.ControladorVenta;
import Model.ClienteDAO;
import Model.EmpleadoDAO;
import Model.Producto;
import Model.ProductoDAO;
import Services.Fachada;

public class Main {
    
    private ControladorLogin controllogin;
    private ControladorVenta controlventa;
    private LoginUserGI login;
    private ClienteDAO cliente;
    private EmpleadoDAO emp;
    private ProductoDAO pro;
    private Invoice invoice;
    private Venta venta;
    private Busqueda busqueda;
    
    public Main(){
        
        login= new  LoginUserGI();
        cliente = new ClienteDAO();
        emp= new EmpleadoDAO();
        
        controllogin= new ControladorLogin(login, cliente, emp, this);  
        login.setVisible(true);
        venta= new Venta();
        busqueda= new Busqueda();
        pro= new ProductoDAO();
        controlventa= new ControladorVenta(venta, pro); 
        
        invoice= new Invoice(venta, busqueda);
        
    }
    
    public void activarFactura(){
        login.setVisible(false);
        invoice.setVisible(true);
    }

    public static void main(String[] args) {
        
        Main main= new Main();
       
        }
    
}
