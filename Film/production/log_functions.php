<?php
    session_start();
    ob_start(); // ob_start(); olmazsa header yönlendirmeleri çalışmıyor, ob_start ile içeriğin görüntülenmeye hazır olana kadar sunucu tarafında arabellekte tutmasını sağlıyor.

    require "connection.php";	

    function getIP(){
      if (!empty($_SERVER['HTTP_CLIENT_IP']))
      {
          $ip=$_SERVER['HTTP_CLIENT_IP'];
      }
      elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //Proxy den bağlanıyorsa gerçek IP yi alır.

      {
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
      }
      else
      {
          $ip=$_SERVER['REMOTE_ADDR'];
      }
      return $ip;
    }

    function addLog(){
        $date = date("Y-m-d H:i:s");
        $IPAddress = getIP();
        $userID = $_SESSION["kullaniciID"];
        require "connection.php";

        if($userID){
          $query = mysqli_query($baglan,"INSERT INTO logkaydi (logKaydiID, kullaniciID, IPAdresi, oturumBaslangic, oturumBitiris)
          VALUES(NULL, '$userID', '$IPAddress', '$date', NULL )");

        }else {
          $query = mysqli_query($baglan,"INSERT INTO logkaydi (logKaydiID, kullaniciID, IPAdresi, oturumBaslangic, oturumBitiris)
          VALUES(NULL, NULL, '$IPAddress', '$date', NULL )");
        }

        if ($query){
          return true;
        }else {
          return false;
        }
    }
	
	addLog();

    function readStart(){
        require "connection.php";
        $sql = mysqli_query($baglan,"SELECT oturumBaslangic FROM logkaydi");
        $read_sql = mysqli_fetch_array($sql);
        $session_date = $read_sql["oturumBaslangic"];
        return $session_date;
    }

    function readFinish(){
        require "connection.php";
        $sql = mysqli_query($baglan,"SELECT oturumBitiris FROM logkaydi");
        $read_sql = mysqli_fetch_array($sql);
        $session_date = $read_sql["oturumBitiris"];
        return $session_date;
    }

    function updateFinish()
    {
      require "connection.php";
      $date = date("Y-m-d H:i:s");
      $userID = $_SESSION["kullaniciID"];
      $max= mysqli_query($baglan,"SELECT MAX(logKaydiID) AS max_id FROM logkaydi WHERE kullaniciID='$userID'");
      $read_max = mysqli_fetch_array($max);
      $max_id = $read_max["max_id"];
      

      $query = mysqli_query($baglan,"UPDATE logkaydi SET oturumBitiris='$date' WHERE kullaniciID='$userID' AND logKaydiID='$max_id'");
        if($query){
        
          return true;
        }else {
          return false;
        }

    }

?>
