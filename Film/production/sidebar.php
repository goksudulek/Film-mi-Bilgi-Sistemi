<?php

function sidebar(){
	
	$sidebar = '
	            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Kullanıcı Paneli</h3>
                <ul class="nav side-menu">
                  <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa </a></li>
                  <li><a href="filmler.php"><i class="fa fa-desktop"></i> Filmler </a></li>                    
                  <li><a href="turler.php"><i class="fa fa-tags"></i>Film Türleri</a></li>
                  <li><a href="oyuncular.php"><i class="fa fa-users"></i>Oyuncular</a></li>                                                     
                  <li><a href="logout.php"><i class="fa fa-power-off"></i> Çıkış </a></li>
                </ul>
              </div>
            </div>
	';
	
	echo $sidebar;
	
}

function adminSidebar(){
	
	$adminSidebar = '
	            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Admin Paneli</h3>
                <ul class="nav side-menu">
                  <li><a href="adminIndex.php"><i class="fa fa-home"></i> Anasayfa </a></li>
                  <li><a href="filmler.php"><i class="fa fa-edit"></i> Film Tablosunu Düzenle </a></li>                   
                  <li><a href="turler.php"><i class="fa fa-edit"></i>Film Tür Tablosunu Düzenle</a></li>
                  <li><a href="oyuncular.php"><i class="fa fa-edit"></i>Oyuncu Tablosunu Düzenle</a></li>                                    
                  <li><a><i class="fa fa-gear"></i> Kullanıcı İşlemleri </a></li>
                  <li><a><i class="fa fa-legal"></i> Log Kayıtları </a></li>
                  <li><a href="logout.php"><i class="fa fa-power-off"></i> Çıkış </a></li>
                </ul>
              </div>
            </div>
	';
	
	echo $adminSidebar;
	
}


?>