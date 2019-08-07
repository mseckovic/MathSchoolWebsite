<!DOCTYPE html>
<html lang="sr">
<head>

	<meta charset=utf-8>
	<meta name=description content="">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="keywords" content="Matematika, Škola, Časovi, Učenici, Gaja" />
	<meta name=description content="Uz Veselu matematiku sve ce vam ici veoma lako. Kao igra. Korak po korak.">

	<title>Gajina vesela škola matematike</title>

	<link rel="stylesheet" href="moduli/css/main.css">

	<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    
</head>
<body>
<section class="wrapper">
	<div id="main-content-holder">

		<h1 class="main-heading">Učenje ne mora da bude naporno</h1>
		<p>MATEMATIKA je igra za ceo život. Mi ćemo se igrati, a ti?</p>
		
		<div class="newsletter">
			<header>
				<i class="icon icon-megaphone"></i>
				<h1>Gajina vesela škola matematike</h1>
			</header>
			 <a href="<?php if(isset($_SESSION['username']) && !isset($_SESSION['prijavaNastava']) ){ 
                    echo "index.php?stranica=nastava"; 
    
            } else if(isset($_SESSION['admin_username'])){
                $greska = "<h4>Admin ne moze da se prijavi za cas!</h4>";
    
            }else if($_SESSION['prijavaNastava']){
                $greska = "<h4>Vec ste se prijavili za grupu!</h4>";
            } else {
                $greska = "<h4>Morate imati nalog za prijavu casa!</h4>";
                
                }?>" class="newsletter-button" id="dugmeNastava">Prijavi me za nastavu</a>
				<br/>
				<br/>
             <div><?php echo $greska ?? '';?></div>
			 
		</div>

		<div class="feature"> 
			<img src="moduli/img/ucionica.jpg" alt="">
			<h2>Osnovna škola</h2>
			<p>Dva puta dvočas nedeljno, grupna nastava. Program prati gradivo škole. Časovi obuhvataju celu 
			školsku godinu. Cilj: Funkcionalno razumevanje oblasti
			sa praktičnim znanjem,iz čega će se izroditi kratkoročni ali i dugoročni
			odgovarajući rezultati. Nastavni resursi: knjige, radni listovi ili
			zbirke zadataka propisane od škole, dodatni materijali.</p>
		</div>

		<div class="feature">
			<img src="moduli/img/ucenik-na-tabli.jpg" alt="">
			<h2>Special - priprema za prijemni </h2>
			<p>Program obuhvata pripremu osnovaca za prijemni ispit za srednju skolu. 
			Znajući da svako može da nauči matematiku, to ćemo vam i dokazati. 
			Čak i ukoliko ste imali problema sa učenjem matematike, imali lošu ocenu iz ovog predmeta. Časovi se održavaju dva puta nedeljno dvočas. 
			</p>
		</div>

		<div class="feature">
			<img src="moduli/img/domaci.jpg" alt="" width="400">
			<h2>Srednja škola</h2>
			<p>Krenite sa nama u avanturu zvanu srednja škola. Tu vas čekaju novi izazovi,
			nova znanja i neka nova matematika. Pomoći cemo vam da lako i na zabavan način
			naučite matematiku svih razreda srednje škole i poboljšate svoje ocene, garantovano.
			Dva puta dvočas nedeljno grupna nastava. Program prati gradivo škole.
			Časovi obuhvataju celu školsku godinu.</p>
		</div>

		

	</div>

</section>

</body>
</html>
