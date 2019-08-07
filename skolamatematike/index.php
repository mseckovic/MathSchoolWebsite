<?php

function samo_admin(){
	if (isset($_SESSION['admin_username'])){
		
	} else {
		header('Location: index.php');
	}
}

$stranica = $_GET['stranica'] ?? '';

session_start();		
if($stranica == 'logout'){
    session_unset();
}

include('moduli/header.php');
include('moduli/navigacija.php');


switch ($stranica) {
	case '' :
    case 'logout':
		include('moduli/pocetna.php');
        break;
	case 'program' :
		include('moduli/program.php');
		break;
	case 'o-nama' :
		include('moduli/o-nama.php');
		break;
	case 'kontakt' :
		include('moduli/kontakt.php');
		break;
    case 'login' :
		include('moduli/login.php');
		break;
    case 'registracija' :
		include('moduli/registracija.php');
		break;
	case 'masaivanjacarevi' :
		samo_admin();
		include('moduli/masaivanjacarevi.php');
		break;
	case 'placanje' :
	    samo_admin();
		include('moduli/placanje.php');
		break;
	case 'nastava' :
		include('moduli/nastava.php');
		break;
	case 'statistika' :
		samo_admin();
		include('moduli/statistika.php');
		break;
	default :
		echo 'Greška 404! Nemam takvu stranicu.';
		break;
}

include('moduli/footer.php'); 
?>



