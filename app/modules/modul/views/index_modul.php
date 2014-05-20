<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Daftar Modul
                    | <a href="#"><i class="fa fa-plus-circle"></i></a>
                </h3>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th style="width: 80px;">Action</th>
                            </tr>
                        </thead>
                        <?php $i = 0; ?>
                        <?php foreach ($moduls as $modul): ?>
                            <tbody>
                                <tr class="odd gradeX">
                                    <td><?= ++$i; ?></td>
                                    <td><?= ucfirst($modul->nama) ?></td>
                                    <td><?= ucfirst($modul->keterangan) ?></td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye fa-fw"></i></a>
                                        <a href="#"><i class="fa fa-edit fa-fw"></i></a>
                                        <a href="#"><i class="fa fa-trash-o fa-fw"></i></a>
                                    </td>
                                </tr>
                            </tbody>

                        <?php endforeach; ?>
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