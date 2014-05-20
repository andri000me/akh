<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Login</h3>
            </div>
            <?php echo $message; ?>
            <div class="panel-body">
                <?= form_open("auth/login"); ?>
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="Identity" name="identity" type="identity" autofocus>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                        </label>
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                    <button type="submit" class="btn btn-outline btn-success btn-lg btn-block">Login</button>
                    <hr />
                    <p class="pull-right"><a href="<?= site_url('auth/registrasi_popup'); ?>">Registrasi</a></p>
                    <p class="pull-left"><a href="<?= site_url('auth/forgot_pass');?>">Forgot your password?</a></p>
                </fieldset>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>