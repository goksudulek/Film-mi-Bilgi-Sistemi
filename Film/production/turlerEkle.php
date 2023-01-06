<?php
session_start();
ob_start();
require "settings.php"; // require, include gibi belirtilen dosyayı kodun yazıldığı dosya içerisine eklemek için kullanılır. Ama include gibi uyarı vermek yerine hata verir ve kodun çalışmasını durdurur. require fonksiyonunun da kullanımı include fonksiyonu ile aynıdır.
require "sidebar.php";
require "navbar.php";
require "footer.php";
include_once 'connection.php'; // Bu fonksiyon include fonksiyonu ile aynı şekilde çalışarak dışarıdan dosya dahil etme olanağı sağlar. Tek farkı bir dosya içerisinde aynı dosyanın birden fazla çağrılmasını engeller.

$userID = $_SESSION["kullaniciID"];

if(!isset($_SESSION["kullaniciID"])) {
	header('Location: login.php');
}

if($_SESSION["kullaniciTipi"] != 2):
    header('Location: login.php');
endif;

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
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
			
			adminSidebar();
			
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
          <!-- top tiles -->

          <!-- /top tiles -->

          <div class="row">
			
			<div class="col-md-8 col-sm-8  ">
			  
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Film Türü Ekle <br><small>Film Tür verileri anlık olarak veritabanından güncellenmektedir. </small></h2>
                    <div class="clearfix"></div>
                  </div>
					<div class="x_content">
					
					<?php
					
					$turID = $_GET["turID"]; #get ile sirketID değerini sirketler.php sayfasından aldık.
					
					// POST ile formdan aldığımızı yeni değerlerimizi bu kısımda tutuyoruz.
					
					$yeniturAdi = $_POST['yeniturAdi'];				
					
									
					#eğer bir güncelleme işlemi olmayacaksa mevcut değerlerin ilgili alanlarda yazması lazım
					#get ile gelen sirketID'sine sahip değerlerin textbox ve selectbox'lar içinde
					#yazılmasını sağlıyoruz.
					
					

					if($_POST['newtur']){ #updatesirket butonuna basılırsa aşağıdaki işlemleri yap
												
						if(!$yeniturAdi){
							echo "Lütfen boş alan bırakmayınız!<br>";
							
							#yukarıdaki hata alındığında boş değer girilip girilmediğini anlamak için değişkenleri bastırıyoruz.
							echo "$yeniturAdi<br>";
							
							
							
						}else{
																											
							$updateturInfo = mysqli_query($baglan, "INSERT INTO `turler`(`turAd`) VALUES ('$yeniturAdi')");
							
							
							if($updateturInfo){
								
								echo "Yeni Tür bilgisi Eklendi!";
								header("Refresh:1"); 
								
								#update işleminden sonra güncel verilerin görülebilmesi amacıyla yenileme yapıyoruz.																
								
							}else{
								
								echo "Bilgiler güncellenirken bir hata oluştu!";
								
							}
							
						}
						
					}else{ #butona basılmadıysa şirketin güncel değerlerini alıp onları yazdırıyoruz.
												
						$turAdi = $readturInfo["turAd"];
						
					}
					
					?>
					
						<br />
						<form method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

							<div class="item form-group">
								<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Tür Adı
								</label>
								<div class="col-md-6 col-sm-6 ">
									<input type="text" name="yeniturAdi" required="required" class="form-control" value="<?php echo $turAdi; ?>">
								</div>
							</div>
																																																															
							<div class="ln_solid"></div>
							<div class="item form-group">
								<div class="col-md-6 col-sm-6 offset-md-3">	
									<button class="btn btn-danger"><a href="turler.php" style="color:white;">Geri</a></button>
									<input type="submit" name="newtur" class="btn btn-success" value="Ekle"> 
								</div>
							</div>

						</form>
					</div>
                </div>
              </div>
			  
			  <div class="col-md-4 col-sm-4  ">

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
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>

    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
	<script type="text/javascript" src="https://fastly.jsdelivr.net/npm/echarts@5.4.0/dist/echarts.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	
	<script>
		$(document).ready(function() {
		$('#turEkle').select2();
		});
	</script>
	
  </body>
</html>
<?php
ob_end_flush();
?>
