<!-- start: header -->
<?php  setlocale(LC_TIME, 'id_ID.utf8');?>
<header class="header">
    <div class="logo-container">
        <a href="<?= base_url() ?>" class="logo">
            <?=$this->config->item('apps_logo_text')?>
        </a>
        <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <!-- start: search & user box -->
    <div class="header-right">
    <div class="text-right">
            <strong id="clock" style="font-size: 15px;"></strong>&nbsp&nbsp&nbsp&nbsp <br>
            <span style="font-size: 15px;"> <?= hariIndo(date('l')). ' '.indo_dates( date("Y-m-d")) ?></span>&nbsp&nbsp&nbsp&nbsp
        </div>
        <span class="separator"></span>

       

        <div id="userbox" class="userbox">
            <span class="profile-picture profile-picture-as-text"><?= $firstCharacter = substr(sessNama(), 0, 1); ?></span>
            <div class="profile-info profile-info-no-role" data-lock-name="John Doe">
                <span class="name">Assalamualaikum, <br><strong class="font-weight-semibold"><?= $this->session->userdata('nama'); ?></strong></span>
            </div>
        </div>
        
        
    <!-- end: search & user box -->
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      
        
        startTime()
      
        
        function startTime() {
            const today = new Date();
            let h = today.getHours();
            let m = today.getMinutes();
            let s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('clock').innerHTML = h + ":" + m + ":" + s;
            setTimeout(startTime, 1000);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            };
            return i;
        }
        
        $('#btn-notif').click(function(e) {
            //alert('test')
            $('#notif').removeClass("hover");
            e.preventDefault();
        })
        
    })
</script>