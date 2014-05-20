<div class="grid-24">

    <div class="widget widget-table">

        <div class="widget-header">
            <span class="icon-list"></span>
            <h3 class="icon chart">

                <div class="widget-content">

                <label for="registrasi"><small><a href="#" id="popupSoal">Tambah</a></small></label>

                </div> <!-- .widget-content -->
            </h3>		
        </div>

        <div class="widget-content">

            <table class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Soal</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
        <?php $i = 0;?>
	<?php foreach ($soals as $soal):?>
                <tbody>
                    <tr class="gradeA">
                        <td><?= ++$i;?></td>
                        <td><?= $soal['kode']?></td>
                        <td><?= $soal['soal']?></td>
                        <td><?= $soal['status'] ? 'Aktif' : 'Tidak Aktif'?></td>
                        <td>
                            dfdf
                        </td>
                    </tr>
                </tbody>
	<?php endforeach;?>
            </table>
        </div> <!-- .widget-content -->

    </div> <!-- .widget -->
</div>

<script>
    $(function (){
        $('#popupSoal').live('click', function (e){
            e.preventDefault();
            
            $.modal({
                title:  'Tambah Data Soal',
                ajax:   'soal/add'
            });
        });
    });
</script>