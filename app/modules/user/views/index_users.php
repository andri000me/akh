<?php echo $message; ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Daftar Pengguna
                </h3>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Group</th>
                                <th style="width: 80px;"><a href="<?=site_url('user/add')?>"> <button class="btn btn-primary btn-xs" type="button" ><i class="fa fa-plus-circle"></i> Tambah </button> </a></th>
                            </tr>
                        </thead>
                        <?php $i = 0; ?>
                        <?php foreach ($users as $user): ?>
                            <tbody>
                                <tr class="odd gradeX">
                                    <td><?= ++$i; ?></td>
                                    <td><?= ucfirst($user->username) ?></td>
                                    <td><?= ucfirst($user->email) ?></td>
                                    <td><?= $user->active ? 'Aktif' : 'Tidak Aktif' ?></td>
                                    <td><?php foreach ($user->groups as $group): ?> <?php echo ucfirst($group->name); ?><br />
                                        <?php endforeach ?>
                                    </td>
                                    <td>
                                        <a href="<?=site_url("user/detail/#")?>"><i class="fa fa-eye fa-fw"></i></a>
                                        <a href="<?=site_url("user/edit/{$user->id}")?>"><i class="fa fa-edit fa-fw"></i></a>
                                        <a href="<?=site_url("user/delete/{$user->id}")?>"><i class="fa fa-trash-o fa-fw"></i></a>
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