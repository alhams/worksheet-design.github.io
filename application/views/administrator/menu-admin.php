



        <section class="sidebar">

          <!-- Sidebar user panel -->

          <div class="user-panel">
            <div class="pull-left image">
            <?php $usr = $this->model_app->view_where('users', array('username'=> $this->session->username))->row_array();
                  if (trim($usr['foto'])==''){ $foto = 'blank.png'; }else{ $foto = $usr['foto']; } ?>
            <img src="<?php echo base_url(); ?>/assets/foto_user/<?php echo $foto; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <?php echo "<p>$usr[nama_lengkap]</p>"; ?>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->

          <ul class="sidebar-menu">
            <li class="header" style='color:#fff; text-transform:uppercase; border-bottom:2px solid #00c0ef'>MENU <span class='uppercase'><?php echo $this->session->level; ?></span></li>
            <li><a href="<?php echo base_url(); ?>administrator/home"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="treeview">
              <a href="#"><i class="glyphicon glyphicon-th-list"></i> <span>Menu Utama</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                  echo "<li><a href='".base_url()."administrator/identitaswebsite'><i class='fa fa-circle-o'></i> Identitas Website </a></li>";
              ?>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-database"></i> <span>Referensi</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
              echo "<li><a href='".base_url()."administrator/kab'><i class='fa fa-circle-o'></i>Kabupaten</a></li>";
              echo "<li><a href='".base_url()."administrator/kec'><i class='fa fa-circle-o'></i>Kecamatan</a></li>";
              echo "<li><a href='".base_url()."administrator/desa'><i class='fa fa-circle-o'></i>Desa</a></li>";
              echo "<li><a href='".base_url()."administrator/sumber_dana'><i class='fa fa-circle-o'></i>Sumber Dana</a></li>";
              echo "<li><a href='".base_url()."administrator/kawasan_strategis'><i class='fa fa-circle-o'></i>Kawasan Strategis</a></li>";
              echo "<li><a href='".base_url()."administrator/kawasan_hutan'><i class='fa fa-circle-o'></i>Kawasan Hutan</a></li>";
              echo "<li><a href='".base_url()."administrator/kondisi_jalan'><i class='fa fa-circle-o'></i>Kondisi Jalan</a></li>";
              echo "<li><a href='".base_url()."administrator/koneksi_desa'><i class='fa fa-circle-o'></i>Koneksi Desa</a></li>";
              echo "<li><a href='".base_url()."administrator/status_jalan'><i class='fa fa-circle-o'></i>Status Jalan</a></li>";
              echo "<li><a href='".base_url()."administrator/sumber_usulan'><i class='fa fa-circle-o'></i>Sumber Usulan</a></li>";
              echo "<li><a href='".base_url()."administrator/satuan'><i class='fa fa-circle-o'></i>Satuan</a></li>";
              echo "<li><a href='".base_url()."administrator/prio'><i class='fa fa-circle-o'></i>Prioritas</a></li>";

              ?>

              </ul>

            </li>

            <li class="treeview">

              <a href="#"><i class="fa fa-hand-o-right"></i> <span>Usulan</span><i class="fa fa-angle-left pull-right"></i></a>

              <ul class="treeview-menu">

              <?php
                  echo "<li><a href='".base_url()."administrator/usulan'><i class='fa fa-circle-o'></i>Usulan Kegiatan</a></li>";


              ?>

              </ul>

            </li>

            <li class="treeview">

              <a href="#"><i class="fa fa-pencil-square-o"></i> <span>Verifikasi</span><i class="fa fa-angle-left pull-right"></i></a>

              <ul class="treeview-menu">

              <?php

                  echo "<li><a href='".base_url()."administrator/v_usulan'><i class='fa fa-circle-o'></i>Usulan Kegiatan</a></li>";

                  // echo "<li><a href='#'><i class='fa fa-circle-o'></i> Verifikasi Tera Ulang </a></li>";


              ?>

              </ul>

            </li>


             <li class="treeview">

              <a href="#"><i class="fa fa-print"></i> <span>Cetak</span><i class="fa fa-angle-left pull-right"></i></a>

              <ul class="treeview-menu">

              <?php

                  echo "<li><a href='".base_url()."administrator/lihat_cetak_usulan'><i class='fa fa-circle-o'></i> Usulan Kegiatan </a></li>";
              ?>

              </ul>

            </li>

           

            <!-- <li class="treeview">

              <a href="#"><i class="fa fa-users"></i> <span>Users</span><i class="fa fa-angle-left pull-right"></i></a>

              <ul class="treeview-menu">
                <?php

                 echo "<li><a href='".base_url()."administrator/manajemenuser'><i class='fa fa-circle-o'></i> Data User </a></li>";
                 ?>
              </ul>

            </li> -->

            <!-- <li><a href="<?php echo base_url(); ?>administrator/edit_manajemenuser/<?php echo $this->session->username; ?>"><i class="fa fa-edit"></i> <span>Edit Profile</span></a></li> -->

            <li><a href="<?php echo base_url(); ?>administrator/logout"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>

          </ul>

        </section>

