    				<?php echo $message;?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-group"></i> Daftar Kelompok</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Group</th>
                                <th>Keterangan</th>
                                <th style="width: 80px;"><a href="<?=site_url('group/add')?>"> <button class="btn btn-primary btn-xs" type="button" ><i class="fa fa-plus-circle"></i> Tambah </button> </a></th>
                            </tr>
                        </thead>
                        <?php $i = 0; ?>
                        <?php foreach ($groups as $group): ?>
                            <tbody>
                                <tr class="gradeA">
                                    <td><?= ++$i; ?></td>
                                    <td><?= ucfirst($group['name']) ?></td>
                                    <td><?= ucfirst($group['description']) ?></td>
                                    <td>
                                        <a href="<?=site_url("group/detail/#")?>"><i class="fa fa-eye fa-fw"></i></a>
                                        <a href="<?=site_url("group/edit/{$group['id']}")?>"><i class="fa fa-edit fa-fw"></i></a>
                                        <a href="<?=site_url("group/delete/{$group['id']}")?>"><i class="fa fa-trash-o fa-fw"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div> 
            <div class="panel-footer">
                PAGINATION..
            </div>
        </div>
    </div>
</div>