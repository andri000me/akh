<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Progress Aplikasi
                </h3>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tasks</th>
                                <th>Result</th>
                                <th>Menu</th>
                                <th>Status</th>
                                <th>Modul</th>
                                <th style="width: 80px;"><a href="#"> <button class="btn btn-primary btn-xs" type="button" ><i class="fa fa-plus-circle"></i> Tambah </button> </a></th>
                            </tr>
                        </thead>
                        <?php $i = 0; ?>
                        <?php
                        if ( $aplikasis->num_rows() > 0 ) {
                            foreach ($aplikasis->result() as $aplikasi):
                                ?>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td><?= ++$i; ?></td>
                                        <td><?= $aplikasi->tasks ?></td>
                                        <td><?= $aplikasi->result ?></td>
                                        <td><?= $aplikasi->menu ?></td>
                                        <td>
                                            <button <?= $aplikasi->html; ?>> <?= ucfirst($aplikasi->ket) ?></button>
                                        </td>
                                        <td><?= $aplikasi->nama ?></td>

                                        <td>
                                            <a href="<?= site_url('aplikasi/detail/#') ?>"><i class="fa fa-eye fa-fw"></i></a>
                                            <a href="<?= site_url('aplikasi/edit/#') ?>"><i class="fa fa-edit fa-fw"></i></a>
                                            <a href="<?= site_url("aplikasi/delete/$aplikasi->id_aplikasi","Delete",array("onclick" => "javascript:return confirm('Anda yakin akan menghapus data ini ?')"))?>"><i class="fa fa-trash-o fa-fw"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php endforeach; ?>
                                
                        <?php }else{
                            echo "<tr><td colspan='7' align='center'>Data Record Aplikasi Masih Kosong!</td></tr>";
                        } ?>
                    </table>
                </div>
            </div>
            <div class="panel-footer"></div>

        </div>
        <ul class="pagination">
            <li class="disabled"><a href="#">&laquo;</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">&raquo;</a></li>
        </ul>
    </div>
</div>