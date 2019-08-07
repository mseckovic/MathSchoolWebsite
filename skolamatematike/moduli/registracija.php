<?php
$greske = "";

if (!empty($_POST)) {

    $greske = array();                   
                            

    if (!isset($_POST['razred']) ){
        $greske[] = "<h5>Niste uneli razred !</h5>";
    } else {
        $razred = $_POST['razred'];
    }

							$ime = $_POST['ime'];
							$prezime = $_POST['prezime'];
							$email = $_POST['email'];
							$username = $_POST['username'];
							$password = $_POST['password'];
							$potvrdi_password = $_POST['pass_chk'];
							
							$stepenObrazovanja = $_POST['stepenObrazovanja'];

							
                
							if(!preg_match("/^[a-zA-Z']+$/", $ime)){
								$greske[] = "<h5>Ime nije validno !</h5>";
							}
                
							if(!preg_match("/^[a-zA-Z']+$/", $prezime)){
								$greske[] = "<h5>Prezime nije validno !</h5>";
                            }
                            
                            if(!preg_match("/^[a-zA-Z']+[0-9]*$/", $username)){
								$greske[] = "<h5>Username nije validan !</h5>";
							}
                
							if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
								$greske[] = "<h5>Email nije validan !</h5>";
							}
                               
							if(!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $password)){
								$greske[] = "<h5>Lozinka nije validna !</h5>";
							} else {
								if($password !== $potvrdi_password){
								    $greske[] = "<h5>Nije uspesno potvrdjena lozinka !</h5>";
								}
                            }
                            


                            if(empty($stepenObrazovanja)){
                                $greske[] = "<h5>Niste uneli stepen obrazovanja!</h5>";
                            }

							if(count($greske)){
                                $greske = implode("", $greske);
                             }else{
                                 include("moduli/ucenik_class.php");
                                 $ucenik = new Ucenik();
                                 $ucenik->konekcija();
                                 if($ucenik->registracija($ime,$prezime,$username,$password,$stepenObrazovanja,$razred,$email)){
                                    $_SESSION['username'] = $username;
                                    header("Location: index.php?stranica=program");
                                     
                                 } else {
                                     $greske = "<h2>Vec imate nalog, ulogujte se sa svojim korisnickim imenom i lozinkom</h2>";
                                 }
                                
                                 
                                }
								 
							 
                        
}
                        
						
						
                      
                        
                    
?>


<!DOCTYPE html>
<html lang="sr">

<head>

    <meta charset=utf-16>
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Matematika, Škola, Časovi, Učenici, Gaja" />
    <meta name=description content=" Vesela matematika je tu da vasem detetu pomogne da savlada gradivo iz matematike, bilo da se radi o osnovnoj ili srednjoj skoli.">

    <title>Gajina vesela škola matematike</title>

    <link rel="stylesheet" href="moduli/css/main.css">

    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

</head>

<body>

    <section class="wrapper">
   

        <div id="main-content-holder">

            <h1 class="main-heading">Javite se na 3 × (27 - 19) / 2 × 700</h1>


            <div class="contact-wrapper">

                <div class="contact-form">
                    <form method="post">
						<label for="ime" >Ime * &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
							<input class="inputCSS" type="text" name="ime" id="ime" value="<?php echo $_POST['ime'] ?? '';?>" required  />
                        </label>
                        <label for="prezime">Prezime *  &nbsp; &nbsp; &nbsp; 
							<input class="inputCSS" type="text" name="prezime" id="prezime" value="<?php echo $_POST['prezime'] ?? '';?>" required  />
                        </label>
                        <label for="mail">Email * &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (xxx@xxx.xxx)
							<input class="inputCSS" type="email" name="email" id="email" value="<?php echo $_POST['email'] ?? '';?>" required />
                        </label>
                        <label for="username">Username *  &nbsp; &nbsp; 
							<input class="inputCSS" type="text" name="username" id="username" value="<?php echo $_POST['username'] ?? '';?>" required  />
                        </label>
                        <label for="password">Password *  (min 8 karaktera,veliko,malo slovo i br)
							<input class="inputCSS" type="password" name="password" id="password" value="<?php echo $_POST['password'] ?? '';?>" required  />
                        </label>
                        <label for="password">Potvrdite password *
							<input class="inputCSS" type="password" name="pass_chk" id="password_conf" value="<?php echo $_POST['pass_chk'] ?? '';?>" required  />
                        </label>
                        
                        
                        <label>Uzrast *</label>
                        <select name="stepenObrazovanja" id="stepen_obrazovanja" onchange="promeni_tip_obrazovanja_opcije(this.selectedIndex)">
                            <option value ="">Izaberi</option>
                            <option value="osnovna">Osnovna skola</option>
							<option value="srednja">Srednja skola</option>
					    </select>
                        <div id="tip_obrazovanja_godina"></div>
                        <br/>
                        <br/>
                        <p><input class="inputCSS" type="submit" class="newsletter-button" value="Pošalji" id="posalji" /></p>
                        <p ><span style="color:#b21171;">* Obavezna polja</span></p>
                    </form>
					
					</br>
					</br>
					
					<div class="form-group">
					<?php echo $greske; ?>
					</div>
			
                </div>
            </div>


        </div>
		
    </section>
	 <script type="text/javascript">
        var to0 = '<select name="razred"><option value="Prvi razred">Prvi razred</option><option value="Drugi razred">Drugi razred</option><option value="Treci razred">Treci razred</option><option value="Cetvrti razred">Cetvrti razred</option><option value="Peti razred">Peti razred</option><option value="Sesti razred">Sesti razred</option><option value="Sedmi razred">Sedmi razred</option><option value="Osmi razred">Osmi razred</option></select>';

        var to1 = '<select name="razred"><option value="Prva godina">Prva godina</option><option value="Druga godina">Druga godina</option><option value="Treca godina">Treca godina</option><option value="Cetvrta godina">Cetvrta godina</option></select>';

        function promeni_tip_obrazovanja_opcije(v) {
           
           var stepen_obrazovanja = "";

            if(v == "1"){
                stepen_obrazovanja = to0;
            } else if (v == "2"){
                stepen_obrazovanja = to1;
            }

            document.getElementById('tip_obrazovanja_godina').innerHTML = stepen_obrazovanja;

        }
    </script>

    
    
</body>

</html>
