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
    
    private VentaView venta;
    
    public Invoice(VentaView venta){
        
         this.venta= venta;
         
         add(venta);
         
         pack();
         setLocationRelativeTo(null);
         setDefaultCloseOperation(EXIT_ON_CLOSE);
         
         
                  
    }
    
}
