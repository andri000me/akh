<?= $messages;?>
<?= form_open(uri_string()) ?>
<div class="form-group">
    <label>Nama Gambar</label>
    <?= form_input($galeri_name); ?>
    <p class="help-block">Nama Group/ Level</p>
</div>
<div class="form-group">
    <label>Modul Gambar</label>
    <?= form_dropdown($galeri_modul); ?>
    <p class="help-block">Penjelasan Group/ Level</p>
</div>

<?php echo form_hidden('id', $groups->id); ?>
<button type="submit" class="btn btn-default">Submit</button> | 
<a href="<?= base_url('galeri'); ?>"> cancel</a>
<?=
form_close()?>