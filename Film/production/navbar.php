<?php

function navbar(){
	
	$navbar = '
	    <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    İşlemler
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="profil.php">Profil</a>
                      <a class="dropdown-item"  href="javascript:;">
                     
                        <span>Ayarlar</span>
                      </a>
                  <a class="dropdown-item"  href="javascript:;">Yardım</a>
                    <a class="dropdown-item"  href="login.php"><i class="fa fa-sign-out pull-right"></i> Çıkış</a>
                  </div>
                </li>

              </ul>
            </nav>
          </div>
        </div>
	';
	
	echo $navbar;	
}

?>