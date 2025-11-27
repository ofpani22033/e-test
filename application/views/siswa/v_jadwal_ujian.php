<?php
$this->load->view('siswa/head');
?>
<style>
/* CSS Styling */
.box.box-success {
    border-top-color: #0073b7 !important;
}

.box-success > .box-header {
    background-color: #0073b7 !important;
    color: #fff !important;
}

/* New CSS for clearer statuses */
.status-not-started { color: #f39c12; font-weight: bold; } /* Orange/Yellow */
.status-completed { color: #00a65a; font-weight: bold; } /* Green */
.status-pending { color: #3c8dbc; font-weight: bold; } /* Blue */
.status-expired { color: #d9534f; font-weight: bold; } /* Red/Danger */
</style>
<?php
$this->load->view('siswa/topbar');
$this->load->view('siswa/sidebar');
date_default_timezone_set('Asia/Jakarta');
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-success box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php print Date('d F Y'); ?> | <span id="time"></span> </h3>
                </div>
                <center><h4 class="box-title">Jadwal Ujian</h4></center>

                <div class="box-body" style="overflow-x: scroll;">

                    <table id="data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Kode</th>
                                <th>Mata Pelajaran</th>
                                <th>Waktu Ujian</th>
                                <th>Durasi</th>
                                <th>Jenis Ujian</th>
                                <th>Status</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            // Time in server (Asia/Jakarta) for comparison
                            $current_datetime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
                            $current_timestamp = $current_datetime->getTimestamp();
                            
                            foreach ($peserta as $d) {
                                // Prepare data attributes for JavaScript
                                $exam_datetime_str = $d->tanggal_ujian . ' ' . $d->jam_ujian;
                                $exam_datetime = DateTime::createFromFormat('Y-m-d H:i:s', $exam_datetime_str, new DateTimeZone('Asia/Jakarta'));
                                $exam_timestamp = $exam_datetime ? $exam_datetime->getTimestamp() : 0;
                                
                                // Calculate exam end time
                                // Note: This calculation is for display and initial status, the final comparison will be in JS.
                                $exam_end_timestamp = $exam_timestamp + ($d->durasi_ujian * 60);

                                // Initial Status Display based on backend data (status_ujian)
                                $status_html = '';
                                $data_exam_id = $d->id_peserta;
                                $data_start_time = $exam_timestamp;
                                $data_duration = $d->durasi_ujian;
                                $data_status_ujian = $d->status_ujian;
                                $data_start_link = site_url('ruang_ujian/soal/' . $data_exam_id); // Assuming CodeIgniter's site_url is available

                                if ($d->status_ujian == 0) {
                                    $status_html = "<span class='status-not-started'>Belum Mulai Ujian</span>";
                                } else if ($d->status_ujian == 2) {
                                    $status_html = "<span class='status-completed'>Sudah Mengikuti Ujian</span>";
                                } else if ($d->status_ujian == 1) {
                                    // Initial state for status 1, will be updated by JS
                                    $status_html = "<span class='status-pending'>Tunggu Waktu Ujian...</span>";
                                }
                            ?>
                                <tr
                                    data-exam-id="<?php echo $data_exam_id; ?>"
                                    data-start-time="<?php echo $data_start_time; ?>"
                                    data-duration="<?php echo $data_duration; ?>"
                                    data-status-ujian="<?php echo $data_status_ujian; ?>"
                                    data-start-link="<?php echo $data_start_link; ?>"
                                >
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $d->kode_matapelajaran; ?></td>
                                    <td><?php echo $d->nama_matapelajaran; ?></td>
                                    <td><?php echo date('d-m-Y', $exam_timestamp); ?> | <?php echo date('H:i:s', $exam_timestamp); ?></td>
                                    <td><?php echo $d->durasi_ujian; ?> Menit</td>
                                    <td><?php echo $d->jenis_ujian; ?></td>
                                    <td class="exam-status-cell">
                                        <?php echo $status_html; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </section><?php
$this->load->view('siswa/js');
?>
<script type="text/javascript">
    $('.alert-message').alert().delay(3000).slideUp('slow');
</script>

<script>
    // --- Clock Function (Kept Original) ---
    window.setTimeout("waktu()", 1000);

    function showTime() {
        var a_p = "";
        var today = new Date();
        var curr_hour = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();
        if (curr_hour < 12) {
            a_p = "AM";
        } else {
            a_p = "PM";
        }
        if (curr_hour == 0) {
            curr_hour = 12;
        }
        if (curr_hour > 12) {
            curr_hour = curr_hour - 12;
        }
        curr_hour = checkTime(curr_hour);
        curr_minute = checkTime(curr_minute);
        curr_second = checkTime(curr_second);
        document.getElementById('time').innerHTML = curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
        
        // ** Call the status update function here **
        updateExamStatus(); 
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    
    // --- Real-time Exam Status Update Function (New) ---
    function updateExamStatus() {
        var currentTime = new Date().getTime() / 1000; // Current timestamp in seconds

        $('#data tbody tr').each(function() {
            var row = $(this);
            var statusCell = row.find('.exam-status-cell');
            var statusUjian = parseInt(row.data('status-ujian'));

            // Only check if the exam status is 1 (Active/Pending)
            if (statusUjian === 1) {
                var startTime = parseInt(row.data('start-time')); // Exam start timestamp (server time)
                var durationMinutes = parseInt(row.data('duration'));
                var durationSeconds = durationMinutes * 60;
                var endTime = startTime + durationSeconds;
                var startLink = row.data('start-link');

                if (currentTime >= startTime && currentTime < endTime) {
                    // Time to start the exam
                    var button = "<a href='" + startLink + "' class='btn btn-xs btn-success'>Mulai Ujian</a>";
                    statusCell.html(button);
                } else if (currentTime >= endTime) {
                    // Exam time has passed (The backend should ultimately handle marking it as finished/expired,
                    // but for display, we show it's over if the start time + duration is passed)
                    // Note: This relies on the server's time for the start/end time.
                    statusCell.html("<span class='status-expired'>Waktu Ujian Selesai/Kedaluwarsa</span>");
                } else {
                    // Waiting for start time
                    statusCell.html("<span class='status-pending'>Tunggu Waktu Ujian</span>");
                }
            }
        });
    }

    // Set interval for clock and status update
    setInterval(showTime, 500); // Call showTime every 500ms
    // No need to set another interval, as showTime now calls updateExamStatus
</script>
<?php
$this->load->view('admin/foot');
?>