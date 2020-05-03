/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Controller;

import Model.Cliente;
import Model.ClienteDAO;
import Model.Empleado;
import Model.EmpleadoDAO;
import View.LoginUserGI;
import View.Main;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.JOptionPane;

/**
 *
 * @author mauri
 */
public class ControladorLogin implements ActionListener{
    
    private LoginUserGI login;
    private ClienteDAO cliente;
    private EmpleadoDAO emp;
    private Main ppal;
    
    public ControladorLogin(LoginUserGI login, ClienteDAO cliente, EmpleadoDAO emp, Main ppal){
        this.login= login;
        this.cliente= cliente;
        this.emp= emp;
        this.ppal= ppal;
        
        login.AddListenerBtIngresar(this);
    }
    

    @Override
    public void actionPerformed(ActionEvent ae) {
        if(ae.getActionCommand().equalsIgnoreCase("Ingresar")){
           String user= login.getUsuario();
           String password= login.getContrasena();
           Empleado e= emp.getEmpleado(user);
               if(e!=null&&password.equals(e.getPassword())){
                   JOptionPane.showMessageDialog(null, "Bienvenido "+e.getNombres());
                   ppal.activarFactura();
               }else{
                   JOptionPane.showMessageDialog(null, "Usuario o contraseña incorrecta");  
               }
        }
        
    }
    
}
