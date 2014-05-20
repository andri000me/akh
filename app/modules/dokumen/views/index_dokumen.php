<?php echo $message; ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-group"></i> Daftar Dokumen</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Created</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th style="width: 80px;"><a href="<?= site_url('group/add') ?>"> <button class="btn btn-primary btn-xs" type="button" ><i class="fa fa-plus-circle"></i> Tambah </button> </a></th>
                            </tr>
                        </thead>
                        <?php $i = 0; ?>
                        <?php
                        if ($dokumens->num_rows() > 0)
                        {
                            foreach ($dokumens->result() as $dokumen):
                                ?>
                                <tbody>
                                    <tr class="gradeA">
                                        <td><?= ++$i; ?></td>
                                        <td><?= ucfirst($dokumen->created) ?></td>
                                        <td><?= ucfirst($dokumen->title) ?></td>
                                        <td><?= $dokumen->type?></td>
                                        <td>
                                            <a href="<?= site_url("dokumen/detail/{$dokumen->id}")?>"><i class="fa fa-eye fa-fw"></i></a>
                                            <a href="<?= site_url("dokumen/edit/{$dokumen->id}")?>"><i class="fa fa-edit fa-fw"></i></a>
                                            <a href="<?= site_url("dokumen/delete/{$dokumen->id}")?>"><i class="fa fa-trash-o fa-fw"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php endforeach; ?>
                            <?php
                        }else
                        {
                            echo "<tr><td colspan='7' align='center'>Data Record Dokumen Masih Kosong!</td></tr>";
                        }
                        ?>
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