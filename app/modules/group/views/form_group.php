
<!-- <form id="tambahGroup" action="<?= site_url('group/add/'); ?>" method="post"  name="newproject" enctype="multipart/form-data">-->
<?= form_open( uri_string() );?>
    <!--
    <table>
        <tr>
            <td>Level</td>
            <td><input class="validate[required]" id="name"  name="name" type="text" placeholder="Group/ Level"/></td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td><input type="text" name="description" value="" id="description" tabindex="1" placeholder="Keterangan" /></td>
        </tr>

        <tr>
            <td>
                <button class="btn btn-small" onclick="save()" value="submit">Simpan</button>
            </td>

            <td> | <a href="<?= base_url('index.php/group/'); ?>"> cancel</a></td>
        </tr>
    </table>
    -->
    <?php echo $message; ?>

    <div class="form-group">
        <label>Level</label>
        <?= form_input($group_name);?>
        <p class="help-block">Nama Group/ Level</p>
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <?= form_input($group_description);?>
        <p class="help-block">Penjelasan Group/ Level</p>
    </div>
    
    <?php echo form_hidden('id', $groups->id);?>
    <button type="submit" class="btn btn-default">Submit</button>
    <a href="<?= base_url('group'); ?>"> cancel</a>
    
<?= form_close();?>