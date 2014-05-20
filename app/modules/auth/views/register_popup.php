<script>
   var datetime = new Date();
var INDEX_URL = 'http://127.0.0.1:4444/JohnDoe/index.php/';

Ext.onReady(function() {
    Ext.QuickTips.init();

    Ext.form.Field.prototype.msgTarget = 'side';

    var bd = Ext.getBody();

    var registrasi = new Ext.FormPanel({
        labelWidth: 100,
        url: INDEX_URL + 'auth/registrasi',
        frame: false,
        renderTo: 'registrasi',
        title: 'Registrasi Anggota Baru',
        bodyStyle: 'padding:5px 5px 0',
        width: 300,
        defaults: {width: 230},
        defaultType: 'textfield',
        items: [{
                fieldLabel: 'Username',
                name: 'username',
                anchor: '80%',
                allowBlank: false},
            {
                fieldLabel: 'Password',
                name: 'password',
                anchor: '80%',
                inputType: 'password',
                allowBlank: false},
            {
               fieldLabel: 'password_confirm',
                name: 'password_confirm',
                anchor: '80%',
                inputType: 'password_confirm',
                allowBlank: false},  
            
            {
                fieldLabel: 'email',
                name: 'email',
                anchor: '80%',
                inputType: 'email',
                allowBlank: false
            },
            {
               fieldLabel: 'first_name',
                name: 'first_name',
                anchor: '80%',
                inputType: 'first_name',
                allowBlank: false 
            },
            {
                fieldLabel: 'last_name',
                name: 'last_name',
                anchor: '80%',
                inputType: 'last_name',
                allowBlank: false
            },
            {
                fieldLabel: 'phone',
                name: 'phone',
                anchor: '80%',
                inputType: 'phone',
                allowBlank: false
            },
            {
                fieldLabel: 'company',
                name: 'company',
                anchor: '80%',
                inputType: 'company',
                allowBlank: false
            }],
        
        buttons: [{
                text: 'registrasi',
                handler: function(){
                    if(register.getForm().isValid()){
                        register.getForm().submit({
                            method: 'POST',
                            waitMsg: 'Registrasi Process',
                            success: function(registrasi, o){
                                Ext.MessageBox.alert('Warning','Registrasi Berhasil! ');
                                window.location = INDEX_URL + 'user';
                            },
                            
                            failure: function(registrasi, o){
                                Ext.MessageBox.alert('Warning', 'Regsitrasi Gagal! ');
                            }
                        });
                    }
                }
        },{
            text: 'Reset',
                    handler: function() {
                        login.getForm().reset();
                    }
        }]
    });
});

</script>   
<div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Sign Up</p>
            <?php echo $message; ?>
            <div class="block-body">
                <div id="registrasi">
                </div>
            </div>
        </div>
        <p><a href="<?= site_url('auth/login'); ?>">Login!</a></p>
    </div>
</div>