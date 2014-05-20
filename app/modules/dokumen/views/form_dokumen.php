<?= form_open( uri_string() );?>
 
    <?php echo $message; ?>

    <div class="form-group">
        <label>Level</label>
        <?= form_upload($file_name);?>
        <p class="help-block">Nama Group/ Level</p>
    </div>
    
<button type="submit" class="btn btn-default">Submit</button>
    <a href="<?= base_url('group'); ?>"> cancel</a>
    
<?= form_close();?>