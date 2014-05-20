<div class="row">

    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-tasks"></i> Daftar Kuesioner</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Keterangan</th>
                                <th>Created</th>
                                <th style="width: 80px;"><a href="#"> <button class="btn btn-primary btn-xs" type="button" ><i class="fa fa-plus-circle"></i> Tambah </button> </a></th>
                            </tr>
                        </thead>
                        <?php $i = 0; ?>
                        <?php foreach ($kuesioners as $kuesioner): ?>
                            <tbody>
                                <tr class="gradeA">
                                    <td><?= ++$i; ?></td>
                                    <td><?= $kuesioner->ket ?></td>
                                    <td><?= $kuesioner->created ?></td>

                                    <td width ="2" colspan="2">
                                        <a href="<?= site_url('kuis/detail') ?>"><i class="fa fa-eye fa-fw"></i></a>
                                        <a href="<?= site_url('kuis/ubah') ?>"><i class="fa fa-edit fa-fw"></i></a>
                                        <a href="<?= site_url('kuis/hapus') ?>"><i class="fa fa-trash-o fa-fw"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="panel-footer">
                    PAGINATION..
                </div>
            </div>
        </div>
    </div>