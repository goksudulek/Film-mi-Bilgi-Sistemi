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

if($_SESSION["kullaniciTipi"] != 1):
    header('Location: login.php');
endif;

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
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <?php
			
			Sidebar2();
			
			//echo $userID;
			
			?>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
			<?php
			
			sidebar();
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
          <div class="row">
          
            <div class="col-md-4 col-md-3  tile_stats_count">
			<div class="x_panel">
              <span class="count_top"><i class="fa fa-user"></i> <b>Toplam Kullanıcı Sayısı </b></span>
              <div class="count">10</div>
              
            </div>
            </div><div class="col-md-4 col-md-3  tile_stats_count">
			<div class="x_panel">
              <span class="count_top"><i class="fa fa-user"></i> <b>Sitedeki Film Sayisi</b></span>
              <div class="count">100</div>
              
            </div>
            </div><div class="col-md-4 col-md-3  tile_stats_count">
			<div class="x_panel">
              <span class="count_top"><i class="fa fa-user"></i> <b>Sitedeki Oyuncu Sayısı </b></span>
              <div class="count">50</div>
              
            </div>
            </div>


 

          
        </div>
          <!-- /top tiles -->

          <div class="row">
			
			<div class="col-md-12 col-sm-12  ">
			  
                <div class="x_panel">
                  <div class="x_title">
                    <h2>IMDB İlk 100 Film Türleri Ortalamaları <br><small>Veriler anlık olarak güncellenmektedir. </small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    

                    <div id="bar" style="height:500px"></div>

                  </div>
                </div>
              </div>

          </div>
		  
		  <br />
		  
		  <div class="row">
            <div class="col-md-6 col-sm-4 ">
              <div class="dashboard_graph">
			  
			 <?php
			 
			$queryKadin = mysqli_query($baglan,"SELECT COUNT(kullanicilar.kullaniciID) AS kadin_sayisi FROM kullanicilar WHERE kullanicilar.cinsiyet =1");
			$readQueryKadin = mysqli_fetch_array($queryKadin);
			$kadinSayisi = $readQueryKadin['kadin_sayisi'];
			
			$queryErkek = mysqli_query($baglan,"SELECT COUNT(kullanicilar.kullaniciID) AS erkek_sayisi FROM kullanicilar WHERE kullanicilar.cinsiyet =2");
			$readQueryErkek = mysqli_fetch_array($queryErkek);
			$erkekSayisi = $readQueryErkek['erkek_sayisi'];
			
			$queryBelirsiz = mysqli_query($baglan,"SELECT COUNT(kullanicilar.kullaniciID) AS belirsiz_sayisi FROM kullanicilar WHERE kullanicilar.cinsiyet =3");
			$readQueryBelirsiz = mysqli_fetch_array($queryBelirsiz);
			$belirsizSayisi = $readQueryBelirsiz['belirsiz_sayisi'];
			
			 			 
			 ?>

				<div id="pie" style="height:500px; width: 800px;"></div>
				
              </div>
            </div>
			<div class="col-md-6 col-sm-4 ">
              <div class="dashboard_graph">

				<div id="line" style="height:500px; width: 830px;"></div>
				
              </div>
            </div>
			
			

          </div>
          <br />

          
              

                <!-- Start to do list -->
                
                <!-- End to do list -->
                
                <!-- start of weather widget -->
                
                <!-- end of weather widget -->
              
            </div>
          </div>
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
  
	
	<script type="text/javascript">
    
//bar---------------------------------------------------------------------------------------------------

var dom = document.getElementById('bar');
var myChart = echarts.init(dom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};

var option;

option = {
  dataset: {
    source: [
      ['score', 'Film Sayısı', 'Türler'],
      [100, 21, 'Aksiyon'],
      [80, 9, 'Animasyon'],
      [10, 0, 'Anime'],
      [10, 0, 'Belgesel'],
      [50, 4, 'Bilim Kurgu'],
      [60, 5, 'Biyografi'],
      [90, 14, 'Dram'],
      [20, 1, 'Fantastik'],
      [50, 4, 'Gerilim'],
      [50, 4, 'Gizem'],
      [50, 4, 'Komedi'],
      [40, 3, 'Korku'],
      [60, 5, 'Macera'],
      [40, 3, 'Romantik'],
      [40, 3, 'Savaş'],
      [10, 0, 'Spor'],
      [90, 14, 'Suç'],
      [10, 0, 'Tarih'],
      [30, 2, 'Batı'],
      [30, 2, 'Aile'],
      [40, 3, 'Müzik'],
      
    ]
  },
  grid: { containLabel: true },
  xAxis: { name: 'amount' },
  yAxis: { type: 'category' },
  visualMap: {
    orient: 'horizontal',
    left: 'center',
    min: 10,
    max: 100,
    text: ['High Score', 'Low Score'],
    // Map the score column to color
    dimension: 0,
    inRange: {
      color: ['#65B581', '#FFCE34', '#FD665F']
    }
  },
  series: [
    {
      type: 'bar',
      encode: {
        // Map the "amount" column to X axis.
        x: 'Film Sayısı',
        // Map the "product" column to Y axis
        y: 'Türler'
      }
    }
  ]
};

if (option && typeof option === 'object') {
  myChart.setOption(option);
}

window.addEventListener('resize', myChart.resize);


//pie---------------------------------------------------------------------------------------------------
	

var dom = document.getElementById('pie');
var myChart = echarts.init(dom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};

var option;

option = {
  tooltip: {
    trigger: 'item'
  },
  legend: {
    top: '5%',
    left: 'center'
  },
  series: [
    {
      name: 'Cinsiyet',
      type: 'pie',
      radius: ['40%', '70%'],
      avoidLabelOverlap: false,
      itemStyle: {
        borderRadius: 10,
        borderColor: '#fff',
        borderWidth: 2
      },
      label: {
        show: false,
        position: 'center'
      },
      emphasis: {
        label: {
          show: true,
          fontSize: 30,
          fontWeight: 'bold'
        }
      },
      labelLine: {
        show: false
      },
      data: [
        { value: <?php echo $kadinSayisi; ?>, name: 'Kadın' },
        { value: <?php echo $erkekSayisi; ?>, name: 'Erkek' },
        { value: <?php echo $belirsizSayisi; ?>, name: 'Belirsiz' }
      ]
    }
  ]
};

if (option && typeof option === 'object') {
  myChart.setOption(option);
}

window.addEventListener('resize', myChart.resize);

//line-----------------------------------------------------------------------------------------------
 
var dom = document.getElementById('line');
var myChart = echarts.init(dom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};

var option;

option = {
  xAxis: {
    type: 'category',
    boundaryGap: false,
    data: ['The Shawshank Redemption(1.)', 'Rear Window(50.)', 'M(100.)']
  },
  yAxis: {
    type: 'value'
  },
  series: [
    {
      data: [9.3, 8.5, 8.3],
      type: 'line',
      areaStyle: {}
    }
  ]
};

if (option && typeof option === 'object') {
  myChart.setOption(option);
}

window.addEventListener('resize', myChart.resize);


    
  

//----------------------------------------------------------------------------------------------------

  </script>
	
  </body>
</html>
