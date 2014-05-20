

<div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Sign Up</p>
            <?php echo $message; ?>
            <div class="block-body">
                
                <?= form_open("auth/registrasi"); ?>
                <label for="email">Email</label>
                <input type="text" name="email" value="" id="email" tabindex="1" placeholder="email@example.com" class="span12"/>	
                <label for="username">Username</label>
                <input type="text" name="username" value="" id="username" tabindex="1" placeholder="Username" class="span12"/>
                <label for="first_name">Nama Depan</label>
                <input type="text" name="first_name" value="" id="first_name" tabindex="1" placeholder="Nama Depan" class="span12"/>	
                <label for="last_name">Nama Belakang</label>
                <input type="text" name="last_name" value="" id="last_name" tabindex="1" placeholder="Nama Belakang" class="span12"/>	
                <label for="phone">Telepone</label>
                <input type="text" name="phone" value="" id="phone" tabindex="1" placeholder="phone" class="span12"/>
                <label for="company">Divisi</label>
                <input type="text" name="company" value="" id="company" tabindex="1" placeholder="Divisi" class="span12"/>	
                <label for="password">Password</label>
                <input type="password" name="password" value="" id="password" tabindex="2" placeholder="password" class="span12"/>	
                <label for="password_confirm">Konfirmasi Password</label>
                <input type="password" name="password_confirm" value="" id="password_confirm" tabindex="2" placeholder="Konfirmasi Password" class="span12"/>	
                <button type="submit" class="btn btn-primary pull-right">Sign Up!</button>
                <label class="remember-me"><input type="checkbox"> I agree with the <a href="terms-and-conditions.html">Terms and Conditions</a></label>
                <div class="clearfix"></div>
                <?= form_close(); ?>
            </div>
        </div>
        <p><a href="<?=site_url('auth/login');?>">Login!</a></p>
    </div>
</div>