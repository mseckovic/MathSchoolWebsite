<?php
 
					
					if (!empty($_POST)) {

						$username = $_POST['username'];
						$password = $_POST['password'];

						$greske = array();

						if(!preg_match("/^[a-zA-Z']+[0-9]*$/", $username)){
                            $greske[] = "<h5>Username nije validan !</h5>";
                        }
						if(!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $password)){
							$greske[] = "<h5>Lozinka nije validna !</h5>";
						}
						
						 if(count($greske)){
							$greske = implode("", $greske);
						}else{
                             if($username === "Admin" && sha1($password) == "2b12e1a2252d642c09f640b63ed35dcc5690464a"){
								 echo "aaa";end;
                                $_SESSION['admin_username'] = $username;
                                header("Location: index.php?stranica=masaivanjacarevi");
                            
                            } else {
                                 include("moduli/ucenik_class.php");
							     $ucenik = new Ucenik();
                                 $ucenik->konekcija();
                                 
                                 if($ucenik->login($username,$password)){
                                    setcookie("usernameC",$username,time()+(84600*30),"/");
                                    $_SESSION['username'] = $username;
                                    header("Location: index.php?stranica=program");
                                 } else {
                                     $greske = "<p>Nemate nalog. Prvo se registrujte! </p>";
                                 }
                                 
                             }
							
						}

							
					}	
					
						
						       
                    ?>
<!DOCTYPE html>
<html lang="sr">

<head>

    <meta charset=utf-8>
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
				    <label>Username</label>
						<input class="inputCSS" type="text" name="username" id="username" required value="<?php echo $_POST['username'] ?? '';?>">
				    <label>Password</label>
						<input class="inputCSS" type="password" name="password" id="password" required value="<?php echo $_POST['password'] ?? '';?>"/>	
					<p><input class="inputCSS" type="submit" name='login' class="newsletter-button" value="Login" /></p>
				   
                    
                    
					</form>
					 
				    <div class="form-group">
					<?php echo $greske ?? '';?>
					</div>
					
                </div>
            </div>
        </div>
    </section>
    
</body>
<script type="text/javascript">
    function prebaci(){
        window.location.href = "moduli/nastava.php";
    }
</script>
</html>
