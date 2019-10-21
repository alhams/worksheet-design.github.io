<?php 
if ($this->session->level==''){
    redirect(base_url());
}else{
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Selamat Datang di Aplikasi Usulan Kegiatan</title>
    <meta name="author" content="phpmu.com">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/daterangepicker/daterangepicker-bs3.css">
    <style type="text/css"> .files{ position:absolute; z-index:2; top:0; left:0; filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; opacity:0; background-color:transparent; color:transparent; } </style>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/plugins/jQuery/jquery-1.12.3.min.js"></script>
    <style type="text/css">.checkbox-scroll { border:1px solid #ccc; width:100%; height: 114px; padding-left:8px; overflow-y: scroll; }</style>
      <script src="<?php echo base_url(); ?>assets/admin/plugins/pace/pace.js"></script>
    <script type="text/javascript">
    function nospaces(t){
        if(t.value.match(/\s/g)){
            alert('Maaf, Tidak Boleh Menggunakan Spasi,..');
            t.value=t.value.replace(/\s/g,'');
        }
    }
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
     $(document).ready(function() {
 $("#btnExport").click(function(e) {
 e.preventDefault();

//getting data from our table
 var data_type = 'data:application/vnd.ms-excel';
 var table_div = document.getElementById('table_wrapper');
 var table_html = table_div.outerHTML.replace(/ /g, '%20');

var a = document.createElement('a');
 a.href = data_type + ', ' + table_html;
 a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
 a.click();
 });
});
</script>

<script >
$(document).ready(function(){
    var next = 1;
    $(".add-more").click(function(e){
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="field' + next + '" type="text">';
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    });
    

    
});
</script>

<script type="text/javascript">
        $(document).ready(function(){
             $('#kab').click(function(){ 
                var kd_kab=$(this).val();
                $.ajax({
                    url : "<?php echo base_url(); ?>Administrator/combo_kec",
                    method : "POST",
                    data : {kd_kab: kd_kab},
                    dataType : 'json',
                    success: function(response){
                         
                        var html = '';
                        var i;
                        for(i=0; i<response.length; i++){
                            html += '<option value='+response[i].kd_kec+'>'+response[i].nm_kec+'</option>';
                        }
                        $('#kec').html(html);
 
                    }
                });

            }); 
             
        });
    </script>




<script type="text/javascript">
        $(document).ready(function(){
             $('#kec').click(function(){ 
                var kd_kec=$(this).val();
                $.ajax({
                    url : "<?php echo base_url(); ?>Administrator/combo_desa",
                    method : "POST",
                    data : {kd_kec: kd_kec},
                    async : true,
                    dataType : 'json',
                    success: function(response){
                         
                        var html = '';
                        var i;
                        for(i=0; i<response.length; i++){
                            html += '<option value='+response[i].kd_desa+'>'+response[i].nm_desa+'</option>';
                        }
                        $('#desa').html(html);
                    }
                });

            }); 
             
        });
    </script>

   <script type="text/javascript">
        $(document).ready(function(){
             $('#stra').click(function(){ 
                var kd_kawasan=$(this).val();
                $.ajax({
                    url : "<?php echo base_url(); ?>Administrator/combo_stra",
                    method : "POST",
                    data : {kd_kawasan: kd_kawasan},
                    async : true,
                    dataType : 'json',
                    success: function(response){
      var len =  response.length;
if(len > 0){

  var skor = response[0].skor;
       $('#skor1').val(skor);
       }else{
       $('#skor1').val('');
      }
     }
                });
            });          
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
             $('#hutan').click(function(){ 
                var kd_kawasan_hutan=$(this).val();
                $.ajax({
                    url : "<?php echo base_url(); ?>Administrator/combo_hutan",
                    method : "POST",
                    data : {kd_kawasan_hutan: kd_kawasan_hutan},
                    async : true,
                    dataType : 'json',
                    success: function(response){
      var len =  response.length;
if(len > 0){

  var skor = response[0].skor;
       $('#skor2').val(skor);
       }else{
       $('#skor2').val('');
      }
     }
                });
            });          
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
             $('#jln').click(function(){ 
                var kd_kondisi_jln=$(this).val();
                $.ajax({
                    url : "<?php echo base_url(); ?>Administrator/combo_jln",
                    method : "POST",
                    data : {kd_kondisi_jln: kd_kondisi_jln},
                    async : true,
                    dataType : 'json',
                    success: function(response){
      var len =  response.length;
if(len > 0){

  var skor = response[0].skor;
       $('#skor3').val(skor);
       }else{
       $('#skor3').val('');
      }
     }
                });
            });          
        });
    </script>


<script type="text/javascript">
        $(document).ready(function(){
             $('#koneksi').click(function(){ 
                var kd_koneksi_desa=$(this).val();
                $.ajax({
                    url : "<?php echo base_url(); ?>Administrator/combo_koneksi",
                    method : "POST",
                    data : {kd_koneksi_desa: kd_koneksi_desa},
                    async : true,
                    dataType : 'json',
                    success: function(response){
      var len =  response.length;
if(len > 0){

  var skor = response[0].skor;
       $('#skor4').val(skor);
       }else{
       $('#skor4').val('');
      }
     }
                });
            });          
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
             $('#stts').click(function(){ 
                var kd_stts_jln=$(this).val();
                $.ajax({
                    url : "<?php echo base_url(); ?>Administrator/combo_stts",
                    method : "POST",
                    data : {kd_stts_jln: kd_stts_jln},
                    async : true,
                    dataType : 'json',
                    success: function(response){
      var len =  response.length;
if(len > 0){

  var skor = response[0].skor;
       $('#skor5').val(skor);
       }else{
       $('#skor5').val('');
      }
     }
                });
            });          
        });
    </script>

<script type="text/javascript">
        function sum() {
            var txtFirstNumberValue = document.getElementById('skor1').value;
            var txtSecondNumberValue = document.getElementById('skor2').value;
            var txtThridNumberValue = document.getElementById('skor3').value;
            var txtFourthNumberValue = document.getElementById('skor4').value;
            var txtFiveNumberValue = document.getElementById('skor5').value;

            if (txtFirstNumberValue == "")
                txtFirstNumberValue = 0;

            if (txtSecondNumberValue == "")
                txtSecondNumberValue = 0;

            if (txtThridNumberValue == "")
                txtThridNumberValue = 0;

            if (txtFourthNumberValue == "")
                txtFourthNumberValue = 0;

            if (txtFiveNumberValue == "")
                txtFiveNumberValue = 0;

            var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue) + parseInt(txtThridNumberValue) + parseInt(txtFourthNumberValue) + parseInt(txtFiveNumberValue);
            if (!isNaN(result)) {
                document.getElementById('total').value = result;

            }
        }
    </script>

     <script type="text/javascript">
                        function GetSelectedValue(){
                         var e = document.getElementById("drop");
                          var result = e.options[e.selectedIndex].value;
                          document.getElementById("result").innerHTML = result;
                        }
                       </script>

<script type="text/javascript">

          function prio() {
            var txtprioritas = document.getElementById('total').value;
            if (txtprioritas >= 0 && txtprioritas < 50){
              document.getElementById('prioritas').value = ("Tidak Prioritas")
            } else if (txtprioritas >= 50 && txtprioritas < 80){
              document.getElementById('prioritas').value = ("Prioritas III")
            } else if (txtprioritas >= 80 && txtprioritas < 90){
              document.getElementById('prioritas').value = ("Prioritas II")
            } else if (txtprioritas >= 90 && txtprioritas <= 100){
              document.getElementById('prioritas').value = ("Prioritas I")
            }
          }

    </script>

 <!-- modal combobox dengan ajax -->
  <!--   <script type="text/javascript">
      $(function () {
        $('#btn').click(function(){ 
             var kd_sumber_usulan=$('#drop').val();
         // var kd_sumber_usulan = $('#sbr_usulan option:selected').val()
  
        $.ajax({
                    url : "<?php echo base_url(); ?>Administrator/combo_cetak",
                    method : "POST",
                    data : {kd_sumber_usulan: kd_sumber_usulan},
                    
                    dataType : 'json',
                    success: function(response){
                      console.log(response);               
     }
                });
    });
      });
      
    </script>
 -->

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
          <?php include "main-header.php"; ?>
      </header>

      <aside class="main-sidebar">
          <?php include "menu-admin.php"; ?>
      </aside>

      <div class="content-wrapper">

        <?php if ($this->uri->segment(2)=='home'){ ?>
        <div class='alert alert-warning alert-dismissible fade in' role='alert' style='border-radius:0px; margin-bottom:0px'>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <a href="" style="margin-right:10px; text-decoration:none;">Haloo Selamat datang di halaman administrator</a>
          <a target='_BLANK' class="btn btn-default btn-sm" href="" style="color: rgb(243, 156, 18);">Pebri Harto</a>
        </div>
      <?php } ?>

        <section class="content-header">
          <h1> Dashboard <small>Control panel </small> </h1>
        </section>

        <section class="content">
            <?php echo $contents; ?>
        </section>
        <div style='clear:both'></div>
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
          <?php include "footer.php"; ?>
      </footer>
    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>$.widget.bridge('uibutton', $.ui.button);</script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/plugins/pace/pace.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/admin/dist/js/app.min.js"></script>

    <script>
    $('#rangepicker').daterangepicker();
    $('.datepicker').datepicker();
      $(function () { 
        $("#example1").DataTable();
        // $('#example2').DataTable({
        //   "paging": true,
        //   "lengthChange": false,
        //   "searching": false,
        //   "ordering": true,
        //   "info": true,
        //   "autoWidth": false
        // });
      });
    </script>

  <script type="text/javascript">
  // To make Pace works on Ajax calls
  $(document).ajaxStart(function() { Pace.restart(); });
    $('.ajax').click(function(){
        $.ajax({url: '#', success: function(result){
            $('.ajax-content').html('<hr>Ajax Request Completed !');
        }});
    });


    var url = window.location;
    // for sidebar menu entirely but not cover treeview
    $('ul.sidebar-menu a').filter(function() {
      return this.href == url;
    }).parent().addClass('active');

    // for treeview
    $('ul.treeview-menu a').filter(function() {
      return this.href == url;
    }).closest('.treeview').addClass('active');
  </script>
  </body>
</html>
<?php } ?>
