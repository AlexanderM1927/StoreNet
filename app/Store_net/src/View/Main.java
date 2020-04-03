package View;

import Controller.ControladorLogin;
import Model.ClienteDAO;
import Model.EmpleadoDAO;
import Model.Producto;
import Model.ProductoDAO;
import Services.Fachada;

public class Main {
    
    private ControladorLogin controllogin;
    private LoginUserGI login;
    private ClienteDAO cliente;
    private EmpleadoDAO emp;
    
    public Main(){
        
        /*login= new  LoginUserGI();
        cliente = new ClienteDAO();
        emp= new EmpleadoDAO();
        controllogin= new ControladorLogin(login, cliente, emp, this);
        
        login.setVisible(true);*/
        Invoice factura = new Invoice();
        factura.setVisible(true);
    }

    public static void main(String[] args) {
        
        Main main= new Main();
       
        }
    
}
