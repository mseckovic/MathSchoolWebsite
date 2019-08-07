<?php 
/*********************************************************
provera za ajax upit.....
*********************************************************/
include_once 'ucenik_class.php';
if($_POST){
    switch ( $_POST['akcija'] ){
		case 'izmenaPlacanja':		
			$arrMeseci = array("januar", "februar" , "mart" ,"april", "maj", "jun" , "septembar","oktobar", "novembar", "decembar");
			if ( in_array($_POST['mesecIzmene'], $arrMeseci) && ($_POST['status'] == 0 ||  $_POST['status'] == 1) && preg_match("/\w{1,30}/", $_POST['username']) ){ // provera da li su podaci primnjeni u valjanom obliku
			
			$object = new Ucenik();
			$object->izmeni_uplatu($_POST['mesecIzmene'], $_POST['status'], $_POST['username']);
			} else {
				
			}
            break;
		case 'grafikZarada':	
			$object = new Ucenik();
			echo $object->statistika1();
		break;
		
		case 'grafikRazred':	
			$object = new Ucenik();
			echo $object->statistika2();
		break;

		case 'grafikRazred2':	
			$object = new Ucenik();
			echo $object->statistika3();
		break;		
		
		
    }
    exit;
}?>