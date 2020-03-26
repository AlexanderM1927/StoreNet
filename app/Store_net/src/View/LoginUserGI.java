package View;


import java.awt.Image;
import java.awt.Toolkit;
import java.awt.event.ActionListener;
import java.awt.event.KeyListener;
import javax.swing.JOptionPane;

public class LoginUserGI extends javax.swing.JFrame {

    public LoginUserGI() {
         initComponents();

        setLocationRelativeTo(null);
        
        //Toolkit miPantalla = Toolkit.getDefaultToolkit();
       // Image logo = miPantalla.getImage("src/imagenes/Discos/LogoDisc.png");
        //setIconImage(logo);
     
        setDefaultCloseOperation(LoginUserGI.EXIT_ON_CLOSE);
    }
    
    public void AddListenerBtIngresar(ActionListener al){
        btIngresar.setActionCommand("Ingresar");
        btIngresar.addActionListener(al);  
    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jLabel1 = new javax.swing.JLabel();
        jPanel1 = new javax.swing.JPanel();
        tfUsuario = new javax.swing.JTextField();
        tfContrasena = new javax.swing.JPasswordField();
        btIngresar = new javax.swing.JButton();
        jSeparator1 = new javax.swing.JSeparator();
        jSeparator2 = new javax.swing.JSeparator();
        jLabel4 = new javax.swing.JLabel();
        jlbRegistar = new javax.swing.JLabel();
        jLabel7 = new javax.swing.JLabel();
        jLabel2 = new javax.swing.JLabel();
        jLabel8 = new javax.swing.JLabel();
        jLabel5 = new javax.swing.JLabel();
        jLabel3 = new javax.swing.JLabel();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);
        setUndecorated(true);
        setResizable(false);

        jLabel1.setHorizontalAlignment(javax.swing.SwingConstants.CENTER);
        jLabel1.setIcon(new javax.swing.ImageIcon(getClass().getResource("/Images/estesi.png"))); // NOI18N

        jPanel1.setBackground(new java.awt.Color(255, 255, 255));
        jPanel1.setForeground(new java.awt.Color(51, 51, 51));

        tfUsuario.setFont(new java.awt.Font("Segoe UI Light", 0, 20)); // NOI18N
        tfUsuario.setText("Ingrese un usuario...");
        tfUsuario.setBorder(null);
        tfUsuario.setOpaque(false);
        tfUsuario.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusGained(java.awt.event.FocusEvent evt) {
                tfUsuarioFocusGained(evt);
            }
            public void focusLost(java.awt.event.FocusEvent evt) {
                tfUsuarioFocusLost(evt);
            }
        });

        tfContrasena.setFont(new java.awt.Font("Dialog", 0, 20)); // NOI18N
        tfContrasena.setText("holacomoestas");
        tfContrasena.setBorder(null);
        tfContrasena.addFocusListener(new java.awt.event.FocusAdapter() {
            public void focusGained(java.awt.event.FocusEvent evt) {
                tfContrasenaFocusGained(evt);
            }
            public void focusLost(java.awt.event.FocusEvent evt) {
                tfContrasenaFocusLost(evt);
            }
        });

        btIngresar.setIcon(new javax.swing.ImageIcon(getClass().getResource("/Images/BotonIngresar.gif"))); // NOI18N
        btIngresar.setBorderPainted(false);
        btIngresar.setContentAreaFilled(false);
        btIngresar.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        btIngresar.setDefaultCapable(false);
        btIngresar.setFocusPainted(false);
        btIngresar.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btIngresarActionPerformed(evt);
            }
        });

        jSeparator1.setForeground(new java.awt.Color(0, 0, 0));

        jSeparator2.setForeground(new java.awt.Color(0, 0, 0));

        jLabel4.setBackground(new java.awt.Color(60, 63, 65));
        jLabel4.setFont(new java.awt.Font("Segoe UI Light", 0, 60)); // NOI18N
        jLabel4.setForeground(new java.awt.Color(153, 153, 153));
        jLabel4.setText("BIENVENIDO");

        jlbRegistar.setFont(new java.awt.Font("Segoe UI Light", 1, 14)); // NOI18N
        jlbRegistar.setForeground(new java.awt.Color(0, 0, 51));
        jlbRegistar.setHorizontalAlignment(javax.swing.SwingConstants.CENTER);
        jlbRegistar.setText("Registrate");
        jlbRegistar.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jlbRegistar.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                jlbRegistarMouseClicked(evt);
            }
        });

        jLabel7.setHorizontalAlignment(javax.swing.SwingConstants.CENTER);
        jLabel7.setIcon(new javax.swing.ImageIcon(getClass().getResource("/Images/Usuario.png"))); // NOI18N

        jLabel2.setHorizontalAlignment(javax.swing.SwingConstants.CENTER);
        jLabel2.setIcon(new javax.swing.ImageIcon(getClass().getResource("/Images/Contraseña.png"))); // NOI18N

        jLabel8.setFont(new java.awt.Font("Segoe UI Light", 0, 14)); // NOI18N
        jLabel8.setForeground(new java.awt.Color(0, 0, 51));
        jLabel8.setHorizontalAlignment(javax.swing.SwingConstants.CENTER);
        jLabel8.setText("¿No tienes una cuenta?");

        jLabel5.setBackground(new java.awt.Color(187, 187, 187));
        jLabel5.setFont(new java.awt.Font("Segoe UI Symbol", 0, 18)); // NOI18N
        jLabel5.setForeground(new java.awt.Color(187, 187, 187));
        jLabel5.setHorizontalAlignment(javax.swing.SwingConstants.CENTER);
        jLabel5.setText("V");
        jLabel5.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jLabel5.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                jLabel5MouseClicked(evt);
            }
        });

        jLabel3.setBackground(new java.awt.Color(187, 187, 187));
        jLabel3.setFont(new java.awt.Font("Segoe UI Symbol", 0, 18)); // NOI18N
        jLabel3.setForeground(new java.awt.Color(187, 187, 187));
        jLabel3.setHorizontalAlignment(javax.swing.SwingConstants.CENTER);
        jLabel3.setText("X");
        jLabel3.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        jLabel3.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                jLabel3MouseClicked(evt);
            }
        });

        javax.swing.GroupLayout jPanel1Layout = new javax.swing.GroupLayout(jPanel1);
        jPanel1.setLayout(jPanel1Layout);
        jPanel1Layout.setHorizontalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel1Layout.createSequentialGroup()
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(jPanel1Layout.createSequentialGroup()
                        .addGap(20, 20, 20)
                        .addComponent(jLabel4, javax.swing.GroupLayout.PREFERRED_SIZE, 331, javax.swing.GroupLayout.PREFERRED_SIZE))
                    .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, jPanel1Layout.createSequentialGroup()
                        .addGap(52, 52, 52)
                        .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, jPanel1Layout.createSequentialGroup()
                                .addComponent(jLabel7, javax.swing.GroupLayout.PREFERRED_SIZE, 44, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                .addComponent(tfUsuario, javax.swing.GroupLayout.PREFERRED_SIZE, 280, javax.swing.GroupLayout.PREFERRED_SIZE))
                            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, jPanel1Layout.createSequentialGroup()
                                .addComponent(jLabel2, javax.swing.GroupLayout.PREFERRED_SIZE, 38, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                                .addComponent(tfContrasena, javax.swing.GroupLayout.PREFERRED_SIZE, 280, javax.swing.GroupLayout.PREFERRED_SIZE))))
                    .addGroup(jPanel1Layout.createSequentialGroup()
                        .addGap(53, 53, 53)
                        .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                            .addComponent(jSeparator1, javax.swing.GroupLayout.DEFAULT_SIZE, 331, Short.MAX_VALUE)
                            .addComponent(jSeparator2))))
                .addContainerGap(50, Short.MAX_VALUE))
            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, jPanel1Layout.createSequentialGroup()
                .addGap(0, 0, Short.MAX_VALUE)
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, jPanel1Layout.createSequentialGroup()
                        .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                            .addComponent(btIngresar, javax.swing.GroupLayout.PREFERRED_SIZE, 219, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addGroup(jPanel1Layout.createSequentialGroup()
                                .addComponent(jLabel8)
                                .addGap(1, 1, 1)
                                .addComponent(jlbRegistar)))
                        .addGap(112, 112, 112))
                    .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, jPanel1Layout.createSequentialGroup()
                        .addComponent(jLabel5, javax.swing.GroupLayout.PREFERRED_SIZE, 32, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                        .addComponent(jLabel3, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE))))
        );
        jPanel1Layout.setVerticalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel1Layout.createSequentialGroup()
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jLabel3, javax.swing.GroupLayout.PREFERRED_SIZE, 33, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel5, javax.swing.GroupLayout.PREFERRED_SIZE, 33, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(27, 27, 27)
                .addComponent(jLabel4, javax.swing.GroupLayout.PREFERRED_SIZE, 53, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(77, 77, 77)
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(tfUsuario, javax.swing.GroupLayout.PREFERRED_SIZE, 50, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel7, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
                .addGap(0, 0, 0)
                .addComponent(jSeparator1, javax.swing.GroupLayout.PREFERRED_SIZE, 56, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(24, 24, 24)
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(tfContrasena, javax.swing.GroupLayout.PREFERRED_SIZE, 50, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel2, javax.swing.GroupLayout.PREFERRED_SIZE, 41, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addComponent(jSeparator2, javax.swing.GroupLayout.PREFERRED_SIZE, 71, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(btIngresar, javax.swing.GroupLayout.PREFERRED_SIZE, 59, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jlbRegistar, javax.swing.GroupLayout.PREFERRED_SIZE, 23, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel8, javax.swing.GroupLayout.PREFERRED_SIZE, 23, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(65, 65, 65))
        );

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addComponent(jLabel1)
                .addGap(0, 0, 0)
                .addComponent(jPanel1, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                .addGap(0, 0, 0))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                .addGap(0, 0, Short.MAX_VALUE)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                    .addComponent(jLabel1, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                    .addComponent(jPanel1, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
                .addGap(0, 0, 0))
        );

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void tfUsuarioFocusGained(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_tfUsuarioFocusGained
        if(tfUsuario.getText().equalsIgnoreCase("Ingrese un usuario...")){
            tfUsuario.setText("");
        }
    }//GEN-LAST:event_tfUsuarioFocusGained

    private void tfUsuarioFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_tfUsuarioFocusLost
        if(tfUsuario.getText().equalsIgnoreCase(""))
        {
            tfUsuario.setText("Ingrese un usuario...");
        }
    }//GEN-LAST:event_tfUsuarioFocusLost

    private void tfContrasenaFocusGained(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_tfContrasenaFocusGained
        if(tfContrasena.getText().equalsIgnoreCase("holacomoestas"))
        {
            tfContrasena.setText("");
        }
    }//GEN-LAST:event_tfContrasenaFocusGained

    private void tfContrasenaFocusLost(java.awt.event.FocusEvent evt) {//GEN-FIRST:event_tfContrasenaFocusLost
        if(tfContrasena.getText().equalsIgnoreCase(""))
        {
            tfContrasena.setText("holacomoestas");
        }
    }//GEN-LAST:event_tfContrasenaFocusLost
    
    /*public void gestionMensajes(String mensaje, String titulo, int icono){
         JOptionPane.showMessageDialog(this,mensaje, titulo, icono);
    }
*/ //ESTO QUIZA NOS SIRVA LUEGO, POR EL MOMENTO NO

    
    
     
    private void jlbRegistarMouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_jlbRegistarMouseClicked

    }//GEN-LAST:event_jlbRegistarMouseClicked

    private void jLabel5MouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_jLabel5MouseClicked
        this.setState(LoginUserGI.ICONIFIED);
    }//GEN-LAST:event_jLabel5MouseClicked

    private void jLabel3MouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_jLabel3MouseClicked
        Exit YesNo = new Exit();
        YesNo.setVisible(true);
        
    }//GEN-LAST:event_jLabel3MouseClicked

    private void btIngresarActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btIngresarActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_btIngresarActionPerformed

    public String getUsuario(){
        return tfUsuario.getText().trim();
    }
    
    public String getContrasena(){
        return tfContrasena.getText().trim();
    }
    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton btIngresar;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JLabel jLabel3;
    private javax.swing.JLabel jLabel4;
    private javax.swing.JLabel jLabel5;
    private javax.swing.JLabel jLabel7;
    private javax.swing.JLabel jLabel8;
    private javax.swing.JPanel jPanel1;
    private javax.swing.JSeparator jSeparator1;
    private javax.swing.JSeparator jSeparator2;
    private javax.swing.JLabel jlbRegistar;
    private javax.swing.JPasswordField tfContrasena;
    private javax.swing.JTextField tfUsuario;
    // End of variables declaration//GEN-END:variables
}
