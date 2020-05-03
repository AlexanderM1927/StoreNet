/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package View;

import javax.swing.JFrame;
import javax.swing.JTabbedPane;

/**
 *
 * @author mauri
 */
public class Invoice extends JFrame{
    
    private JTabbedPane tabbs;
    private Venta venta;
    private Busqueda busqueda;
    
    public Invoice(Venta venta, Busqueda busqueda){
        
                 
         tabbs= new JTabbedPane();
         this.venta= venta;
         this.busqueda= busqueda;
         
         tabbs.addTab("Venta", venta);
         tabbs.addTab("Busqueda", busqueda);
         
         add(tabbs);
         pack();
         setLocationRelativeTo(null);
         setDefaultCloseOperation(EXIT_ON_CLOSE);
         
         
                  
    }
    
}
