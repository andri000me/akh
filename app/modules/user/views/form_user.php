<?= form_open( uri_string() ); ?>
<?php echo $message; ?>
<div class="row">

    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label>Nama Depan</label>
                    <?= form_input($first_name); ?>
                </div>
                <div class="form-group">
                    <label>Nama Belakang</label>
                    <?= form_input($last_name); ?>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <?= form_input($email); ?>
                </div>
                <div class="form-group">
                    <label>Divisi</label>
                    <?= form_input($company); ?>
                </div>
                <div class="form-group">
                    <label>Telpone</label>
                    <?= form_input($phone); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label>Password</label>
                    <?= form_input($password); ?>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <?= form_input($password_confirm); ?>
                </div>
                <div class="form-group">
                    <label>Level Group</label>
                    <h3><?php echo lang('edit_user_groups_heading'); ?></h3>
                    <?php foreach ($groups as $group): ?>
                        <label class="checkbox">
                            <?php
                            $gID = $group['id'];
                            $checked = null;
                            $item = null;
                            foreach ($currentGroups as $grp) {
                                if ($gID == $grp->id)
                                {
                                    $checked = ' checked="checked"';
                                    break;
                                }
                            }
                            ?>
                            <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>"<?php echo $checked; ?>>
                            <?php echo $group['name']; ?>
                        </label>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        

<?php echo form_hidden('id', $users->id); ?>
<?php echo form_hidden($csrf); ?>
<button type="submit" class="btn btn-default">Submit</button>
<a href="<?= base_url('user'); ?>"> cancel</a>
    </div>
</div>
<!--
<div class="form-group">
    <label>Password</label>
form_input($password);
    <p class="help-block">Password</p>
</div>
<div class="form-group">
    <label>Konfirmasi Password</label>
form_input($password_confirm); 

    <p class="help-block">Konfirmasi Password</p>
</div>
-->

<?= form_close(); ?>