<?php

require "settings.php";
include_once 'connection.php';
ob_start();

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
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img style="position:relative; left:17px; top:15px; width: 66%;" src="images/add-user.png" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Kayıt Ol</h4>
							
							<?php
							
							$kullaniciAdi = $_POST["kullaniciAdi"];
							$kullaniciSoyadi = $_POST["kullaniciSoyadi"];
							$nickname = $_POST["nickName"];
							$email = $_POST["email"];
							$sifre = $_POST["sifre"];
							$kullaniciTipi = $_POST["kullaniciTipi"];
							$sifre_md5 = md5($sifre);
							$sifre2 = $_POST["sifre2"];
							$dogumTarihi = $_POST["dogumTarihi"];							
							$cinsiyet = $_POST["cinsiyet"];
							$katilimTarihi = date("Y-m-d");
							
							/*echo "$kullaniciAdi <br>";
							echo "$kullaniciSoyadi <br>";
							echo "$nickname <br>";
							echo "$email <br>";
							echo "$sifre <br>";
							echo "$sifre2 <br>";
							echo "$dogumTarihi <br>";							
							echo "$cinsiyet <br>";*/

							
							if($_POST){
								
								if(!$kullaniciAdi || !$kullaniciSoyadi || !$nickname || !$email || !$sifre || !$sifre2 || !$dogumTarihi || !$cinsiyet ){
									echo "Lütfen boş alan bırakmayınız.";
								}else{
									if($sifre != $sifre2){
										echo "Girdiğiniz şifreler uyuşmuyor.";
									}else{
										
										$uyeEkle = mysqli_query($baglan, "
										INSERT INTO kullanicilar (kullaniciTipi, kullaniciAdi, kullaniciSoyadi, email, nickName, password, dogumTarihi, cinsiyet, katilimTarihi) 
										VALUES ('1','$kullaniciAdi','$kullaniciSoyadi','$email','$nickname','$sifre_md5','$dogumTarihi','$cinsiyet','$katilimTarihi')");
										
										if($uyeEkle){
											echo "Üyeliğiniz oluşturuldu";
											header('Location:login.php');
										}else{
											echo "Üyeliğiniz oluşturulamadı";
										}
									}
									
								}
								
							}
							
							?>
							
							
							<form method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="name">İsim</label>
									<input type="text" class="form-control" name="kullaniciAdi" required autofocus>
								</div>
								
								<div class="form-group">
									<label for="name">Soyisim</label>
									<input type="text" class="form-control" name="kullaniciSoyadi" required autofocus>
								</div>
								
								<div class="form-group">
									<label for="name">Kullanıcı Adı</label>
									<input type="text" class="form-control" name="nickName" required autofocus>
								</div>

								<div class="form-group">
									<label for="email">E-Mail</label>
									<input type="email" class="form-control" name="email" required>
									<div class="invalid-feedback">
										Mail adresi geçersiz
									</div>
								</div>

								<div class="form-group">
									<label for="password">Şifre</label>
									<input type="password" class="form-control" name="sifre" required data-eye>
									<div class="invalid-feedback">
										Şifre Gereklidir
									</div>
								</div>
								
								<div class="form-group">
									<label for="password">Şifre (Tekrar)</label>
									<input type="password" class="form-control" name="sifre2" required data-eye>
									<div class="invalid-feedback">
										Şifre Gereklidir
									</div>
								</div>
								
								<div class="form-group">
									<label for="name">Doğum Tarihi</label>
									<input type="date" class="form-control" name="dogumTarihi" required autofocus>
								</div>																								
								
								<div class="form-group">
									<label for="name">Cinsiyet</label>
									<select class="form-control" name="cinsiyet">
										<option>Seçiniz..</option>													
										<?php

										$genderName='cinsiyetAdi';
										$genderID='cinsiyetID';

										$genderQuery = mysqli_query($baglan, "SELECT * FROM cinsiyet");
										if(mysqli_num_rows($genderQuery)!=0)	{

											while($readGender = mysqli_fetch_array($genderQuery))	{
												echo "<option value='$readGender[$genderID]'>$readGender[$genderName]</option>";
											}
										}

										?>
									</select>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Kayıt Ol
									</button>
								</div>
								<div class="mt-4 text-center">
									<a href="index.php">Giriş Sayfası</a>
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
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	
	
</body>
</html>