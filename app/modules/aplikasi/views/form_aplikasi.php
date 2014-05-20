<div class="block span6">
    <p class="block-heading">Details</p>
    <div class="block-body">
        <?= form_open('aplikasi/tambah') ?>
        <label>Created</label>
        <input type="text" name="created" value="" class="input-xlarge">
        <label>Modified</label>
        <input type="text" name="modified" value="" class="input-xlarge">
        <label>Tasks</label>
        <input type="text" name="" value="" class="input-xlarge">
        <label>Result</label>
        <textarea type="text" value="" rows="3" class="input-xlarge"></textarea>
        <label>Option</label>
        <?php
        $pilihan_warna = $this->wm->dropdown('id', 'ket');
        $id = 'class="input-xlarge"';
        echo form_dropdown('option', $pilihan_warna, '4', $id);
        ?>
        <label>Modul</label>
        <?php
        $pilihan_modul = array(
            'pilih' => '-PILIH-',
            'seller' => 'Seller',
            'admin' => 'Admin',
            'buyer' => 'Buyer',
            'vendor' => 'Vendor');
        $id = 'class="input-xlarge"';
        echo form_dropdown('modul', $pilihan_modul, 'pilih', $id);
        ?>
        <br>
        <br>
        <div>
            <button class="btn btn-primary">Tambah</button>
        </div>
        <?= form_close() ?>
    </div>
</div>
<!--
<div class="block span6">
    <p class="block-heading">Gambar</p>
    <div class="block-body">
        <div>
            <button class="btn btn-primary">Tambah</button>
        </div>
    </div>
</div>
-->