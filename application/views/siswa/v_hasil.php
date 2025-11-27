<?php 
$this->load->view('siswa/head');
?>
<style>
    .box.box-primary {
    border-top-color: #0073b7 !important;  
}
.btn-custom-blue {
    background-color: #0073b7 !important;
    color: white !important;
    border-color: #006aa8 !important;
}

.btn-custom-blue:hover {
    background-color: #005f96 !important;
    border-color: #005f96 !important;
}
 /* Dropdown datatables */
    .dataTables_length select {
        border: 1px solid #000 !important;
        color: #000 !important;
    }

    .dataTables_info {
        color: #000 !important;
    }

    /* Pagination aktif */
    .dataTables_wrapper .dataTables_paginate .paginate_button.active a,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background-color: #0073b7 !important;
        border-color: #0073b7 !important;
        color: #fff !important;
        box-shadow: none !important;
        background-image: none !important;
        background: #0073b7 !important;
    }

    /* Pagination hover */
    .dataTables_wrapper .dataTables_paginate .paginate_button:not(.disabled):hover {
        background-color: #0073b7 !important;
        border-color: #0073b7 !important;
        color: #fff !important;
        background-image: none !important;
        box-shadow: none !important;
        background: #0073b7 !important;
    }

    /* Pagination default */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: #333 !important;
        background: #fff !important;
        border: 1px solid #ddd !important;
    }

</style>

<?php
$this->load->view('siswa/topbar');
$this->load->view('siswa/sidebar');
?>

<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            

            <!-- Default box -->
            <div class="box box-primary" style="overflow-x: scroll;">
                <div class="box box-header" >
                    <center><h3 class="box-title">Hasil Ujian</h3></center>
                </div>
              <div class="box-body">
                <table id="data" class="table table-bordered table-striped">                    
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th> Pelajaran</th>                            
                            <th> Tanggal Ujian</th>                            
                            <th> Jam </th>                            
                            <th> Benar</th>                            
                            <th> Salah</th>                            
                            <th> Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        foreach($hasil as $d) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>                              
                                <td><?php echo $d->nama_matapelajaran; ?></td>                                
                                <td><?php echo date('d-m-Y',strtotime($d->tanggal_ujian)); ?></td>                               
                                <td><?php echo date('H:i:s',strtotime($d->jam_ujian)); ?></td>                                
                                <td>
                                    <?php
                                    if($d->benar == ''){
                                        echo "<span class='btn btn-xs btn-warning'>Belum Ujian</span>";
                                    }else {
                                        echo $d->benar;
                                    }
                                    ?>
                                </td>                                
                                <td>
                                    <?php
                                    if($d->salah == ''){
                                        echo "<span class='btn btn-xs btn-warning'>Belum Ujian</span>";
                                    }else {
                                        echo $d->salah;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($d->nilai == ''){
                                        echo "<span class='btn btn-xs btn-warning'>Belum Ujian</span>";
                                    }else {
                                        echo $d->nilai;
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>                  
                    </tbody> 
                </table>
            </div>
        </div>
        <!-- /.col-->
</div>
<!-- ./row -->
</section><!-- /.content -->

<?php 
$this->load->view('siswa/js');
?>

<!--tambahkan custom js disini-->

<script type="text/javascript">

	$(function(){
		$('#data').dataTable();
	});

	$('.alert-message').alert().delay(3000).slideUp('slow');

</script>

<?php
$this->load->view('siswa/foot');
?>

