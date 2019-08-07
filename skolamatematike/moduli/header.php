<header>


			<div>

					<div class='register_line'><ul style="margin-bottom: 0px;">
			
                        <?php
                   
                    if(isset($_SESSION['username'])){
                        echo "<li><a href='index.php?stranica=logout'>Logout</a></li>";
                        echo "<li><a href='#'>Username: ".$_SESSION['username']."</a></li>"; 
                    }
                    
                    if (isset($_SESSION['admin_username'])){
                        echo "<li><a href='index.php?stranica=logout'>Logout</a></li>";
                        echo "<li><a href='index.php?stranica=masaivanjacarevi'>Raspored</a></li>";
						echo "<li><a href='index.php?stranica=placanje'>Placanje</a></li>";
						echo "<li><a href='index.php?stranica=statistika'>Statistika</a></li>";
                        echo "<li><a href='#'>Username: ".$_SESSION['admin_username']."</a></li>";
                    }
                    
                    if (!isset($_SESSION['username']) && !isset($_SESSION['admin_username'])) {
                        echo "<li><a href='index.php?stranica=login'>Login</a></li>";
                        echo "<li><a href='index.php?stranica=registracija'>Registracija</a></li>";
                    }

                   
                    ?>
                    
                        </ul>
						</div>
                    </div>
					<div class="logo">
						<a href ="index.php?stranica="><img src="moduli/img/vog-logo.png"></a>
						<p>Pozovite nas: 063/157-37-11</p>
                
					</div>
</nav>
					
 
			
			
            
</header>