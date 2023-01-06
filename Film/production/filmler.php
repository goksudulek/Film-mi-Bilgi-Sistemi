<?php
session_start();
ob_start();
require "settings.php"; // require, include gibi belirtilen dosyayı kodun yazıldığı dosya içerisine eklemek için kullanılır. Ama include gibi uyarı vermek yerine hata verir ve kodun çalışmasını durdurur. require fonksiyonunun da kullanımı include fonksiyonu ile aynıdır.
require "sidebar.php";
require "navbar.php";
require "footer.php";
include_once 'connection.php'; // Bu fonksiyon include fonksiyonu ile aynı şekilde çalışarak dışarıdan dosya dahil etme olanağı sağlar. Tek farkı bir dosya içerisinde aynı dosyanın birden fazla çağrılmasını engeller.

$userID = $_SESSION["kullaniciID"];
$userType = $_SESSION["kullaniciTipi"];

if(!isset($_SESSION["kullaniciID"])) {
	header('Location: login.php');
}

if($userType != 1 and $userType != 2){
    header('Location: login.php');
}

if($userType == 1){ #kullanıcı tipi 1 ise yani normal kullanıcı işe işlemler sütununu gizliyoruz.
	$tableStyle = "display:none;";	
}else{
	$tableStyle = "text-align:center;"; #admin kullanıcısındaki yazıları ortalamak için kullandık
}

ob_end_flush();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo $favicon; ?>" type="image/ico" />

    <title><?php echo $siteBasligi; ?></title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <?php
			
			Sidebar2();
			
			?>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->

            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
			<?php
			
			if($userType == 1){
				sidebar();	
			}else{
				adminSidebar();
			}
			?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->

            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
		
		<?php
		
		navbar();
		
		?>
		
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

          <div class="row">
			
			<div class="col-md-12 col-sm-12  ">
			  
                <div class="x_panel">
                  <div class="x_title">
                    <h2> Filmler Listesi <br><small>Veriler güncellenmektedir. </small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
		
                    <table class="table table-striped jambo_table bulk_action" id="dinamik">
					  <thead>
						<tr>
						  <th>ID</th>
						  <th>Film Adı</th>
						  <th>Tür</th>
						  <th>IMDB Puanı</th>
						  <th>Yayınlanma Tarihi</th>						  
						  <th style="<?php echo $tableStyle; ?>">İşlemler</th>
						</tr>
					  </thead>
					  				  
					  <tbody>
					  
					  <?php
					  
					  $filmQuery = mysqli_query($baglan,"
						SELECT filmID, Ad, Tur , IMDB_Puan, Tarih 
						FROM filmler 						
						ORDER BY filmID
					  ");
					  
					  if(mysqli_num_rows($filmQuery) != 0){
						  
						  while($readfilmler = mysqli_fetch_array($filmQuery)){
							  
							  $filmID = $readfilmler['filmID'];
							  $filmAdi = $readfilmler['Ad'];
							  $filmTur = $readfilmler['Tur'];
							  $imdbPuan = $readfilmler['IMDB_Puan'];
							  $tarih = $readfilmler['Tarih'];							  
							  							  					  
					  ?>
					  
						<tr>
						  <td><?php echo $filmID; ?></td>
						  <td><?php echo $filmAdi; ?></td>
						  <td><?php echo $filmTur; ?></td>
						  <td><?php echo $imdbPuan; ?></td>
						  <td><?php echo $tarih; ?></td>
						  
						  
						  <!-- işlemsel ayarlarımızı bu kısımda gerçekleştiriyoruz -->
						  <td style="<?php echo $tableStyle; ?>">
              <a href='filmEkle.php?filmID=<?php echo $filmID; ?>&user_id=<?php echo $userID; ?>' style='width:100px; font-size:12px;' class='btn btn-dark btn-xs'><i class='fa fa-plus-circle'></i> Ekle </a>
							<a href='filmGuncelle.php?filmID=<?php echo $filmID; ?>&user_id=<?php echo $userID; ?>' style='width:100px; font-size:12px;' class='btn btn-primary btn-xs'><i class='fa fa-search'></i> Düzenle </a>
							<a href='filmSil.php?filmID=<?php echo $filmID; ?>&user_id=<?php echo $userID; ?>' style='width:100px; font-size:12px;' class='btn btn-danger btn-xs'><i class='fa fa-pencil'></i> Sil </a>
						  </td>
						  
						  <!-- get ile sirketID adında bir değer gönderiyoruz. hangi sayfaya göndereceğimizi belirtmemiz lazım
							bu örnekte sirketGuncelle.php ve sirketSil.php sayfalarına gönderdik.
							Çünkü hangi id'ye şirket değerinin silinmesi güncellemesinin bilinebilmesi için
							buna ihtiyaç var.
						  -->

						</tr>
					<?php

						}
						  
					  }
					?>					
									
					  </tbody>
					</table>
                  </div>
                </div>
              </div>

          </div>
		  
		  <br />

        </div>
        <!-- /page content -->

        <!-- footer content -->
		
		<?php
		
		footer();
		
		?>
		
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>



    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
	<script>

	$(document).ready( function () {
    $('#dinamik').DataTable();
} );

  </script>
	
  </body>
</html>
