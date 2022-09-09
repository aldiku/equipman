<?php 
    $db = \Config\Database::connect();
    $data = $db->query("SELECT s.id,s.lokasi, s.kode, s.nama_section, a.area, e.nama AS equipment FROM data_section s JOIN data_area a ON s.id_area = a.id JOIN data_equipment e ON s.id_equipment = e.id")->getResultArray();
    $result = [];
    foreach ($data as $row){
        $result[$row['lokasi']][$row['area']][$row['equipment']][$row['kode']][] = $row;
    }    
    $auth = service('authentication');
    helper('auth')
?>

<style>
    .pl-6{
        padding-left: 3.5rem;
    }
    .pl-45{
        padding-left: 2.4rem;
    }
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= base_url() ?>" class="brand-link">
        <span class="brand-text font-weight-light"><?= $_ENV['APP_SHORTNAME']; ?></span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets'); ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= ($auth->user()) ? $auth->user()->email : "" ?></a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>

                </li>
                <?php foreach($result as $key => $row){ ?>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="pilih(1,'<?= $key ?>')">
                        <i class="nav-icon fas fa-folder-tree"></i>
                        <p>
                            <?= $key == "d" ? "OnShore" : "OffShore" ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php foreach($row as $k2 => $r2){ ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link pl-4" onclick="pilih(2,'<?= $key ?>','<?= $k2 ?>')">
                                <i class="fa-solid fa-location-pin nav-icon"></i>
                                <p><?= $k2 ?> <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php foreach($r2 as $k3 => $r3){ ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link pl-45" onclick="pilih(3,'<?= $key ?>','<?= $k2 ?>','<?= $k3 ?>')">
                                    <i class="fa-solid fa-toolbox nav-icon"></i>
                                        <p><?= $k3 ?> <i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                    <?php foreach($r3 as $k4 => $r4){ ?>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link pl-5" onclick="pilih(4,'<?= $key ?>','<?= $k2 ?>','<?= $k3 ?>','<?= $k4 ?>')">
                                                <i class="fa-solid fa-sitemap nav-icon"></i>
                                                <p><?= $k4 ?> <i class="right fas fa-angle-left"></i></p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <?php foreach($r4 as $k5 => $r5){ ?>
                                                <li class="nav-item">
                                                    <a href="<?= base_url('dashboard/section/'.$r5['id'])?>" class="nav-link pl-6">
                                                        <i class="far fa-dot-circle nav-icon"></i>
                                                        <p><?= $r5['nama_section'] ?></p>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <?php if(has_permission('equipment')){ ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Master
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('equipment')?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Master Data</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <?php } ?>
                <?php if(has_permission('user')){ ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('users') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <?php if(has_permission('roles')){ ?>
                        <li class="nav-item">
                            <a href="<?= base_url('roles') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Role</p>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>

            </ul>
        </nav>
    </div>
</aside>
<script>
    var loading = `<div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                </div>`;
    function pilih(depth,id1 = 0,id2 = 0,id3 = 0,id4 = 0,id5 = 0,lastname=0){
        var res = {
            position: depth,
            id1: id1,
            id2: id2,
            id3: id3,
            id4: id4,
            id5: id5
        }
        var breadcrumb = '';
        if(id1 != 0){
            p1 = (id1 == 'd') ? "Darat" : "Laut";
            breadcrumb += '<li class="breadcrumb-item">'+p1+'</li>'
            if(id2 != 0){
                breadcrumb += '<li class="breadcrumb-item">'+id2+'</li>'
                if(id3 != 0){
                    breadcrumb += '<li class="breadcrumb-item">'+id3+'</li>'
                    if(id4 != 0){
                        breadcrumb += '<li class="breadcrumb-item">'+id4+'</li>'
                        if(id5 != 0){
                            breadcrumb += '<li class="breadcrumb-item">'+lastname+'</li>'
                            lihat(depth,id5);
                        }
                    }
                }
            }
        }
        $('#breadcrumb').html(breadcrumb);
    }



    function set_active(id,tab){
        $('.nav-link').removeClass('active');
        $('#'+id).addClass('active');
        $('.tab-pane').removeClass('show').removeClass('active');
        $('#'+tab).addClass('show active');
    }
</script>