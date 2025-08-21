<!-- Web Fonts  -->
<link href="https://fonts.googleapis.com/css?family=Poppins:100,300,400,600,700,800,900" rel="stylesheet" type="text/css">

<!-- Vendor CSS -->
<link rel="stylesheet" href="<?=base_url('assets/')?>vendor/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="<?=base_url('assets/')?>vendor/animate/animate.compat.css">

<link rel="stylesheet" href="<?=base_url('assets/')?>vendor/font-awesome/css/all.min.css" />
<link rel="stylesheet" href="<?=base_url('assets/')?>vendor/boxicons/css/boxicons.min.css" />
<link rel="stylesheet" href="<?=base_url('assets/')?>vendor/magnific-popup/magnific-popup.css" />
<link rel="stylesheet" href="<?=base_url('assets/')?>vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />


<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="<?=base_url('assets/')?>vendor/jquery-ui/jquery-ui.css" />
<link rel="stylesheet" href="<?=base_url('assets/')?>vendor/jquery-ui/jquery-ui.theme.css" />
<link rel="stylesheet" href="<?=base_url('assets/')?>vendor/select2/css/select2.css" />
<link rel="stylesheet" href="<?=base_url('assets/')?>vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
<link rel="stylesheet" href="<?=base_url('assets/')?>vendor/dropzone/basic.css" />
<link rel="stylesheet" href="<?=base_url('assets/')?>vendor/dropzone/dropzone.css" />
<link rel="stylesheet" href="<?=base_url('assets/')?>vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
<link rel="stylesheet" href="<?=base_url('assets/')?>vendor/pnotify/pnotify.custom.css" />
<link rel="stylesheet" href="<?=base_url('assets/')?>vendor/datatables/media/css/dataTables.bootstrap4.css" />
<link rel="stylesheet" href="<?=base_url('assets/')?>vendor/simple-line-icons/css/simple-line-icons.css" />
<link rel="stylesheet" href="<?=base_url('assets/')?>js/sweetalert2/sweetalert2.min.css" />
<link rel="stylesheet" href="<?=base_url('assets/')?>js/croppie/croppie.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.js" integrity="sha512-AQMSn1qO6KN85GOfvH6BWJk46LhlvepblftLHzAv1cdIyTWPBKHX+r+NOXVVw6+XQpeW4LJk/GTmoP48FLvblQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!--(remove-empty-lines-end)-->

<!-- Theme CSS -->
<link rel="stylesheet" href="<?=base_url('assets/')?>css/theme.css" />



<!-- Theme Layout -->
<link rel="stylesheet" href="<?=base_url('assets/')?>css/layouts/modern.css" />
<!--(remove-empty-lines-end)-->



<!-- Theme Custom CSS -->
<link rel="stylesheet" href="<?=base_url('assets/')?>css/custom.css">
<link rel="shortcut icon" href="<?=base_url('assets/')?>img/favicon.png" />
<!-- Head Libs -->

<style>
    html.modern html, html.modern body {background: none !important;}
    .page-header {background: #1D2127 !important;}
    .header .logo-container {
        background-image: none;
        background-color: #1D2127;
        border-bottom-color: #161a1e;
        border-top-color:#1D2127;
        /* background-color: #1D2127; */

    }
    .modal-header {
        padding:5px 5px 5px 20px;
    }
    @media only screen and (min-width: 768px) {
        html.modern .header:not(.header-nav-menu) .logo {
            line-height:20px;
            padding: 5px 20px 0 15px;
            font-size:18px

        }
        
        .notifications:hover{
            position: sticky;
            top: 0;
            z-index: 999;
        }
    }
    @media (max-width: 767px) {
	    html.modern .header .logo-container .logo {
            margin-top: 10px;
            line-height:20px;
            font-size:18px

        }
        
        .notifications:hover{
            position: sticky;
            top: 0;
            z-index: 999;
        }
    }

.unnotifications {
        width:35px;
        height:35px;
        margin-right: 15px;
        background:#fff;
        border-radius:30px;
        box-sizing:border-box;
        text-align:center;
        box-shadow:0 2px 5px rgba(0,0,0,.2);
    }
    

.unnotifications .fa {
    position: relative;
    color:#cecece;
    line-height:30px;
    font-size:20px;
}

    
.notifications {
        width:35px;
        height:35px;
        margin-right: 15px;
        background:#fff;
        border-radius:30px;
        box-sizing:border-box;
        text-align:center;
        box-shadow:0 2px 5px rgba(0,0,0,.2);
    }
.notifications:hover {
    width:350px;
    height:50px;
    text-align:center;
    padding:0 15px;
    margin-top: 120px;
    margin-right: 5px;
    background:#0088CC;
    transform:translateY(-100%);
    border-bottom-left-radius:0;
    border-bottom-right-radius:0;
    border-top-left-radius:0.5;
    border-top-right-radius:0.5;
}

.closenotifikasi {
    display: none;
}

.notifications:hover .closenotifikasi{
    display: block;
    position: relative;
    font-size: x-small;
    text-align: right;
}

.notifications:hover .fa {
    color:#fff;
}
.notifications .icon {
    position: relative; 
    top: -11px; 
    right: 0px
}
.notifications:hover .icon {
    display: none;
}

.notifications .fa {
    color:#cecece;
    line-height:60px;
    font-size:20px;
}

.notifications:hover .fa {
    position: relative;
}

.notifications .num {
    position:absolute;
    top:-5;
    right:3px;
    width:20px;
    height:20px;
    border-radius:50%;
    background:#ff2c74;
    color:#fff;
    line-height:25px;
    font-family:sans-serif;
    text-align:center;
}
.notifications:hover .num {
    position:relative;
    background:transparent;
    color:#fff;
    font-size:24px;
    top: 4px;
}
.notifications:hover .num:after {
    content: ' Notifikasi Masuk ';
}


.notifications:hover ul {
    display:block;
    height: 600px;
    overflow-y: scroll;
    text-align:left;
}


.notifications ul {
    position:absolute;
    left:0;
    top:50px;
    margin:0;
    width:100%;
    background:#fff;
    box-shadow:0 5px 15px rgba(0,0,0,.5);
    padding:20px;
    box-sizing:border-box;
    border-bottom-left-radius:30px;
    border-bottom-right-radius:30px;
    display:none;
}

.notifications ul li {
    list-style:none;
    border-bottom:1px solid rgba(0,0,0,.1);
    padding:8px 0;
    display:flex;
}
.notifications ul li:last-child {
    border-bottom:none;
}
.notifications ul li .icon {
    width:24px;
    height:24px; 
    background:#ccc;
    border-radius:50%;
    text-align:center;
    line-height:24px;
    margin-right:15px;
    top:1px;
}
.notifications ul li .icon .fa {
    color:#fff;
    font-size:16px;
    line-height:24px;
}
.notifications ul li .text {
    position:relative;
    font-family:sans-serif;
    top:3px;
    cursor:pointer;
}
.notifications ul li:hover .text {
    font-weight:bold;
    color:#ff2c74;
}

.user-thumb {
  background: none repeat scroll 0 0 #ffffff;
  float: left;
  height: 40px;
  margin-right: 10px;
  margin-top: 5px;
  padding: 2px;
  width: 40px;
}
.recent-posts,
.recent-comments,
.recent-users {
  margin: 0;
  padding: 0;
}
.recent-posts li,
.recent-comments li,
.article-post li,
.recent-users li {
  border-bottom: 1px dotted #aebdc8;
  list-style: none outside none;
  padding: 10px;
}
.recent-posts li.viewall,
.recent-comments li.viewall,
.recent-users li.viewall {
  padding: 0;
}
.recent-posts li.viewall a,
.recent-comments li.viewall a,
.recent-users li.viewall a {
  padding: 5px;
  text-align: center;
  display: block;
  color: #888888;
}
.recent-posts li.viewall a:hover,
.recent-comments li.viewall a:hover,
.recent-users li.viewall a:hover {
  background-color: #eeeeee;
}
.recent-posts li:last-child,
.recent-comments li:last-child,
.recent-users li:last-child {
  border-bottom: none !important;
}
</style>
