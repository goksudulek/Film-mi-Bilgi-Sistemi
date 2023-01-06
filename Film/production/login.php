<?php

require "settings.php"; // require, include gibi belirtilen dosyayı kodun yazıldığı dosya içerisine eklemek için kullanılır. Ama include gibi uyarı vermek yerine hata verir ve kodun çalışmasını durdurur. require fonksiyonunun da kullanımı include fonksiyonu ile aynıdır.
session_start(); // oturumu başlatıyoruz.
ob_start(); // yönlendirmelerde ihtiyacımız var. sayfa yönlendirmeleri
include_once 'connection.php'; // Bu fonksiyon include fonksiyonu ile aynı şekilde çalışarak dışarıdan dosya dahil etme olanağı sağlar. Tek farkı bir dosya içerisinde aynı dosyanın birden fazla çağrılmasını engeller.

//name ile text'lerden veri çekme

if(isset($_POST['girisButonu'])){ // isset, parametre olarak aldığı değişkenin tanımlı olup olmadığını kontrol eder.
		
	$email = $_POST['email'];
	$pass = $_POST['password'];
	$password = md5($pass);
	
	if($email && $password){

		$query = mysqli_query($baglan, "SELECT * FROM kullanicilar WHERE email='$email' AND password='$password'");
		$numrow = mysqli_num_rows($query);
		
		if($numrow > 0){

			$query = mysqli_query($baglan, "SELECT * FROM kullanicilar WHERE email='$email' AND password='$password'");
			$row = mysqli_fetch_array($query);

			$_SESSION["email"] = $row["email"]; // Sessionlar oturum bilgilerini saklamak için kullanılan yapılardır.
			$_SESSION["kullaniciID"] = $row["kullaniciID"];
			$_SESSION["kullaniciTipi"] = $row["kullaniciTipi"];
			$_SESSION["first_login"] = "first"; // log kaydı için kenarda dursun

			if ($row['kullaniciTipi'] == 1){
				header('Location:index.php');
			}elseif ($row['kullaniciTipi'] == 2){
				header('Location:adminIndex.php');
			}else{
				exit("User Group Id Bulunamadı");
			}

		}else{

			echo "<script type='text/javascript'>
			window.location='login.php?user=false';
			</script>";

		}
	}
	
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title><?php echo $siteBasligi; ?></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
	<link rel="icon" href="<?php echo $favicon; ?>" type="image/ico" />
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img style="position:relative; left:17px; top:15px; width: 66%;" src="images/user1.png" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h2 class="card-title" style="text-align:center; font-family: 'Montserrat', sans-serif; font-weight: 600;">Giriş Yap</h2>
							<form method="POST" class="my-login-validation" novalidate="" action="login.php">
								<div class="form-group">
									<label for="email">E-posta</label>
									<input type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Yazılan e-posta adresi geçersizdir.
									</div>
								</div>

								<div class="form-group">
									<label for="password">Şifre
										<a href="forgot.html" class="float-right">
											Şifrenizi mi unuttunuz?
										</a>
									</label>
									<input type="password" class="form-control" name="password" required data-eye>
								    <div class="invalid-feedback">
								    	Şifre kısmı gerekli bir alandır.
							    	</div>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember" id="remember" class="custom-control-input">
										<label for="remember" class="custom-control-label">Beni Hatırla</label>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" name="girisButonu" class="btn btn-primary btn-block">
										Giriş
									</button>
								</div>
								<div class="mt-4 text-center">
									<a href="register.php">Yeni Kayıt</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2022 &mdash; Çağrı & Göksu
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
</body>
</html>
