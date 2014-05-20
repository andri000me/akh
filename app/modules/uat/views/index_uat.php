<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Daftar UAT
                </h3>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Crated</th>
                                <th>Modified</th>
                                <th>Status</th>
                                <th>Users</th>
                                <th style="width: 80px;"><a href="#"> <button class="btn btn-primary btn-xs" type="button" ><i class="fa fa-plus-circle"></i> Tambah </button> </a></th>
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
            <div class="panel-footer">
               PAGINATION....
            </div>
        </div>
        
    </div>
</div>