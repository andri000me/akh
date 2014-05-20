<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- THIS TEMPLATE GET FREE FROM SB TEMPLATE V2 -->
    <title>Aplikasi Kegiatan Harian</title>

    <!-- Core CSS - Include with every page -->
    <?= css('bootstrap.css');?>
    <?= css('font-awesome.css');?>
    <link rel="stylesheet" type="text/css" href="<?=asset_url();?>extjs/resources/css/ext-all.css">

    <!-- Apps CSS - Include with every page -->
    <?= css('apps.css');?>

</head>

<body>

    <div class="container">
       <?php
        $this->load->view($module . '/' . $view);
        ?>
        <p><a href="http://localhost:4444/bootstraps/sb-admin-v2/">TEMPLATE</a></p>
        <p><a href="http://localhost:4444/lab/JohnDoe/laporan/produk/">NAMA PRODUK DALAM EKSEL</a></p>
    </div>

    <!-- Core Scripts - Include with every page -->
    <?= js('jquery-1.10.2.js');?>
    <?= js('bootstrap.js');?>
    <?= js('apps.js');?>
    <!-- ExtJS Scripts -->
    <script type="text/javascript" src="<?= asset_url();?>extjs/ext-all.js"></script>
</body>

</html>