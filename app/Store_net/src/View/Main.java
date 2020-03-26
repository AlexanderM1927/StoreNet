package View;

import Model.Producto;
import Model.ProductoDAO;

public class Main {

    public static void main(String[] args) {
        
        LoginUserGI usuarioView = new LoginUserGI();
     
        usuarioView.setVisible(true);
        ProductoDAO pd= new ProductoDAO();
        Producto p= new Producto(1, "leche", 5000, "algun dia");
        pd.insertarProducto(p);
       
        }
    
}
