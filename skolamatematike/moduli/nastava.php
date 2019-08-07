
<!DOCTYPE html>
<html lang="sr">
<head>

	<meta charset=utf-8>
	
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="keywords" content="Matematika, Škola, Časovi, Učenici, Gaja" />
	<meta name=description content=" Vesela matematika je tu da vasem detetu pomogne da savlada gradivo iz matematike, bilo da se radi o osnovnoj ili srednjoj skoli.">
	
	<title>Gajina vesela škola matematike</title>

	<link rel="stylesheet" href="moduli/css/main.css">
	

	<script src="https://code.jquery.com/jquery-3.1.1.js"></script>

</head>
<body>

<section class="wrapper">
	

	<div id="main-content-holder">

		<h1 class="main-heading">Javite se na 3 × (27 - 19) / 2 × 700</h1>


		<div class="contact-wrapper">
			
			<div class="contact-form">
				<?php
        
                    // povecava broj ljudi u grupi i zabranjuje ponovu prijavu
                    include('moduli/ucenik_class.php');
					$ucenik = new Ucenik();
					$ucenik->konekcija();
                    if($ucenik->grupaUcenika() && !isset($_SESSION['prijavaNastava'])){
                        if($ucenik->dodajUGrupu($_SESSION['username'])){
                            $_SESSION['prijavaNastava'] = true;
                        }
                    } 
                    

                    
                ?>
			</div>
		</div>


		
	</div>
		
</section>

</body>
</html>
