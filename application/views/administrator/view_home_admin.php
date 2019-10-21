<a style='color:#000' href='<?php echo base_url(); ?>administrator/usulan'>

  <div class="col-md-3 col-sm-6 col-xs-12">

    <div class="info-box">

      <span class="info-box-icon bg-blue"><i class="fa fa-hand-o-right"></i></span>

      <div class="info-box-content">

        <span class="info-box-text">Usulan</span>

        <?php $jmld = $this->model_app->view('tbl_usulan')->num_rows(); ?>

        <span class="info-box-number"><?php echo $jmld; ?></span>

      </div><!-- /.info-box-content -->

    </div><!-- /.info-box -->

  </div><!-- /.col -->

  </a>


<a style='color:#000' href='<?php echo base_url(); ?>administrator/v_usulan'>

  <div class="col-md-3 col-sm-6 col-xs-12">

    <div class="info-box">

      <span class="info-box-icon bg-black"><i class="fa fa-pencil-square-o"></i></span>

      <div class="info-box-content">

        <span class="info-box-text">Verifikasi Usulan</span>

        <?php $jmld = $this->model_app->view('tbl_ver_usulan')->num_rows(); ?>

        <span class="info-box-number"><?php echo $jmld; ?></span>

      </div><!-- /.info-box-content -->

    </div><!-- /.info-box -->

  </div><!-- /.col -->

  </a>

<a style='color:#000' href='<?php echo base_url(); ?>administrator/manajemenuser'>

  <div class="col-md-3 col-sm-6 col-xs-12">

    <div class="info-box">

      <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

      <div class="info-box-content">

        <span class="info-box-text">Users</span>

        <?php $jmld = $this->model_app->view('users')->num_rows(); ?>

        <span class="info-box-number"><?php echo $jmld; ?></span>

      </div><!-- /.info-box-content -->

    </div><!-- /.info-box -->

  </div><!-- /.col -->

  </a>