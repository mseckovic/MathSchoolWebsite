<?php

class Ucenik {
	public $ime;
	public $prezime;
	public $prosek;
  public $stepenObrazovanja;
	public $razred;
  public $email;
  public $username;
  public $password;
	public $poruka;
	public $greske;

  public $konekcija;


	function __construct(){
		$this->konekcija();
    }
	//------------ Placanje pocetak ---------------//
	function if1checked($input1, &$platio){
		if( (int)$input1 == 1){
            $platio +=1000;
			return " checked";
		} else {
			return "";
		}
	}

	function placanje_tabela(){
		$redniBroj = 0;
		$tabString = "<table id='tablica'>
		<tr>
		  <th>Redni Broj </th>
          <th>Ime i Prezime</th>
          <th>Razred</th>
		  <th>9</th>
          <th>10</th>
          <th>11</th>
          <th>12</th>
          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>
          <th>6</th>
		  <th>Platio</th>
          <th>Ukupno</th>
        </tr>";

		$select_placanje_r=$this->konekcija->query('select ucenik.ime , ucenik.prezime , placanje.* from placanje INNER JOIN ucenik ON ucenik.username = placanje.username;');


      if($select_placanje_r->num_rows > 0){
				while($rows = $select_placanje_r->fetch_assoc()){
                    $platio = 0;
					$redniBroj++;
					$tabString .= "<tr id='".$rows['username']."'>
					<td>".$redniBroj."</td>
					<td>".$rows['ime'] . " ".$rows['prezime']."</td>
                    <td>".$rows['nazivGrupa']."</td>
					<td> <input type=\"checkbox\" name=\"meseci\" id='9'". $this->if1checked($rows['septembar'] , $platio)."></td>
					<td> <input type=\"checkbox\" name=\"meseci\" id='10'".$this->if1checked($rows['oktobar'] , $platio)."></td>
					<td> <input type=\"checkbox\" name=\"meseci\" id='11'".$this->if1checked($rows['novembar'] , $platio)."></td>
					<td> <input type=\"checkbox\" name=\"meseci\" id='12'".$this->if1checked($rows['decembar'] , $platio)."></td>
					<td> <input type=\"checkbox\" name=\"meseci\" id='1'".$this->if1checked($rows['januar'] , $platio)."></td>
					<td> <input type=\"checkbox\" name=\"meseci\" id='2'".$this->if1checked($rows['februar'] , $platio)."></td>
					<td> <input type=\"checkbox\" name=\"meseci\" id='3'".$this->if1checked($rows['mart'] , $platio)."></td>
					<td> <input type=\"checkbox\" name=\"meseci\" id='4'".$this->if1checked($rows['april'] , $platio)."></td>
					<td> <input type=\"checkbox\" name=\"meseci\" id='5'".$this->if1checked($rows['maj'] , $platio)."></td>
					<td> <input type=\"checkbox\" name=\"meseci\" id='6'".$this->if1checked($rows['jun'] , $platio)."></td>
                    <td class=\"platio\">".$platio."</td>
                    <td>". 10000 ."</td>
					</tr>";
				}
			}
			$tabString .= "</table>";
		return $tabString;


	}
	function izmeni_uplatu($mesecIzmene, $status, $username){
		$sql = "UPDATE `placanje` SET `".$mesecIzmene."` = ".$status." WHERE `username` = '".$username."';";
		if (!$this->konekcija->query($sql)) {
		    printf("Errormessage: %s\n", $this->konekcija->error);
		}else {
				echo "Uspešno promenjeno polje u bazi!";
			}
	}
    //------------ Placanje kraj ---------------//

	function upisi_pohadja_nastavu($broj, $usernameID){
		 $this->konekcija->query('UPDATE ucenik
									SET pohadja_nastavu = "'.$broj.'"
									WHERE username = "'.$usernameID.'";');
	}
    function konekcija(){
        $this->konekcija = new mysqli('localhost','root','','informacioni_sistem');

        if(mysqli_connect_errno()){
            throw new exception("Nemoguce je povezati se sa bazom",1);
            return false;
        }

        return true;
    }

     //------------ Prikazi ucenika pocetak ---------------//
	public function prikaziUcenika($ime,$prezime){
		return $ime . " " . $prezime;
	}


    //------------ Registracija pocetak ---------------//
    function registracija($ime,$prezime,$username,$password,$stepenObrazovanja,$razred,$email){

        $rezultatR = $this->konekcija->query('select * from ucenik where username = "'.$username.'" and password = "'.$password.'";');
        if(!$rezultatR){
            throw new exception("Ne moze da se izvrsi upit");
        }

        if($rezultatR->num_rows < 1){
			$naziv_grupe = "Grupa ".$razred;
            $rezultatRR = $this->konekcija->query(
            'INSERT INTO ucenik(ime,prezime,stepenObrazovanja,razred,password,email,username,naziv_grupa)
            VALUES("'.$ime.'","'.$prezime.'","'.$stepenObrazovanja.'","'.$razred.'","'.sha1($password).'","'.$email.'","'.$username.'", "'.$naziv_grupe.'");');
            if(!$rezultatRR){
                 echo "Error: " . $sql . "<br>" . $this->konekcija->error;
            }
            return true;
        }

       return false;

    }
    //------------ Registracija kraj ---------------//

    //------------ logovanje pocetak ---------------//
    function login($username,$password){

        $loginQuery = 'SELECT * FROM ucenik WHERE username = "'.$username.'" and password = "'.sha1($password).'";';
        $rezultat = $this->konekcija->query($loginQuery);
        $this->konekcija->close();
        if($rezultat->num_rows<1){
            return false;
        }

        return true;


    }
    //------------------ logovanje kraj ------------------//
    function grupaUcenika(){
        $username= $_SESSION['username'];
        $Grupa_razred;
        $naziGrupe;
        $trenutanBrojUcenika;
        $tablica_predavanja;

        $select_grupa = "SELECT * from grupa where trenutniBrUcenika <= 8";
        $select_grupa_rezultat = $this->konekcija->query($select_grupa) or die("DIE DIE DIE");
        if($select_grupa_rezultat->num_rows > 0){
            $select_ucenik = "SELECT * FROM ucenik where username like '$username'";
            $select_ucenik_rezultat = $this->konekcija->query($select_ucenik) or die("D I E");
            if($select_ucenik_rezultat->num_rows > 0){

                while($rows = $select_ucenik_rezultat->fetch_assoc()){
                    if($rows['naziv_grupa'] == "Grupa prvi razred"){

                        $Grupa_razred = "Grupa Prvi razred";
                        $tablica_predavanja =
                                "<p class='raspored' >
                                Raspored časova:
								<br/>

                                <br/> Ponedeljak: 08:30 - 10:00
                                <br/> Četvrtak: 08:30 - 10:00
                                </p>";
						$this->upisi_pohadja_nastavu(1, $rows['username']);
                    }
                    if($rows['naziv_grupa'] == "Grupa Drugi razred"){
                         $Grupa_razred = "Grupa drugi razred";
                         $tablica_predavanja =
                               "<p class='raspored' >
                                Raspored časova:
								<br/>

                                <br/> Ponedeljak: 10:00 - 11:30
                                <br/> Četvrtak: 10:00 - 11:30
                                </p>";
						$this->upisi_pohadja_nastavu(1, $rows['username']);
                    }
                    if($rows['naziv_grupa'] == "Grupa Treci razred"){
                         $Grupa_razred = "Grupa treci razred";
                         $tablica_predavanja =
                                "<p class='raspored' >
                                Raspored časova:
								<br/>

                                <br/> Ponedeljak: 11:30 - 13:00
                                <br/> Četvrtak: 11:30 - 13:00
                                </p>";
						$this->upisi_pohadja_nastavu(1, $rows['username']);
                    }
                    if($rows['naziv_grupa'] == "Grupa Cetvrti razred"){
                         $Grupa_razred = "Grupa cetvrti razred";
                         $tablica_predavanja =
                                "<p class='raspored'>
                               Raspored časova:
								<br/>
                                <br/> Utorak: 08:30 - 10:00
                                <br/> Petak: 08:30 - 10:00
                                </p>";
						$this->upisi_pohadja_nastavu(1, $rows['username']);
                    }
                    if($rows['naziv_grupa'] == "Grupa Peti razred"){
                         $Grupa_razred = "Grupa peti razred";
                         $tablica_predavanja =
                                "<p class='raspored' >
                               Raspored časova:
								<br/>

                                <br/> Utorak: 10:00 - 11:30
                                <br/> Petak: 10:00 - 11:30
                                </p>";
						$this->upisi_pohadja_nastavu(1, $username);
                    }
                    elseif($rows['naziv_grupa'] == "Grupa Sesti razred"){
                         $Grupa_razred = "Grupa sesti razred";
                         $tablica_predavanja =
                                "<p class='raspored' >
                               Raspored časova:
								<br/>

                                <br/> Utorak: 11:30 - 13:00
                                <br/> Petak: 11:30 - 13:00
                                </p>";
						$this->upisi_pohadja_nastavu(1, $rows['username']);
                    }
                    if($rows['naziv_grupa'] == "Grupa Sedmi razred"){
                         $Grupa_razred = "Grupa sedmi razred";
                         $tablica_predavanja =
                                "<p class='raspored' >
                                Raspored časova:
								<br/>

                                <br/> Sreda: 08:30 - 10:00
                                <br/> Subota: 08:30 - 10:00
                                </p>";
						$this->upisi_pohadja_nastavu(1, $rows['username']);
                    }
                    if($rows['naziv_grupa'] == "Grupa Osmi razred"){
                         $Grupa_razred = "Grupa osmi razred";
                         $tablica_predavanja =
                                "<p class='raspored' >
								Raspored časova:
								<br/>

                                <br/> Sreda: 10:00 - 11:30
                                <br/> Subota: 10:00 - 11:30
                                </p>";

						$this->upisi_pohadja_nastavu(1, $rows['username']);
                    }
                    if($rows['naziv_grupa'] == "Grupa Prva godina"){
                         $Grupa_razred = "Grupa prva godina";
                         $tablica_predavanja =
                                "<p class='raspored' >
                                Raspored časova:
								<br/>

                                <br/> Ponedeljak: 16:00 - 17:00
                                <br/> Četvrtak: 16:00 - 17:00
                                </p>";
						$this->upisi_pohadja_nastavu(1, $rows['username']);
                    }
                    elseif($rows['naziv_grupa'] == "Grupa Druga godina"){
                         $Grupa_razred = "Grupa druga godina";
                         $tablica_predavanja =
                                "<p class='raspored' >
                                Raspored časova:
								<br/>

                                <br/> Ponedeljak: 17:30 - 19:00
                                <br/> Četvrtak: 17:30 - 19:00
                                </p>";
						$this->upisi_pohadja_nastavu(1, $rows['username']);
                    }
                    if($rows['naziv_grupa'] == "Grupa Treca godina"){
                         $Grupa_razred = "Grupa treca godina";
                         $tablica_predavanja =
                                "<p class='raspored' >
                                Raspored časova:
								<br/>

                                <br/> Utorak: 16:00 - 17:30
                                <br/> Petak: 16:00 - 17:30
                                </p>";
						$this->upisi_pohadja_nastavu(1, $rows['username']);
                    }
                    if($rows['naziv_grupa'] == "Grupa Cetvrta godina"){
                         $Grupa_razred = "Grupa cetvrta godina";
                         $tablica_predavanja =
                                "<p class='raspored' >
                                Raspored časova:
								<br/>

                                <br/> Utorak: 17:30 - 19:00
                                <br/> Petak: 17:30 - 19:00
                                </p>";
						$this->upisi_pohadja_nastavu(1, $rows['username']);
                    }
                }
                $trenutanBrojUcenika =0;
                while($row = $select_grupa_rezultat->fetch_assoc()){
                    if($Grupa_razred == $row['nazivGrupa']) {
                        $naziGrupe = $row['nazivGrupa'];
                        $trenutanBrojUcenika = $row['trenutniBrUcenika'];
                    }

                }
                if($trenutanBrojUcenika == 8){
                    echo "<p><font color=black size='5px'> Grupa je vec popunjena.<br/><br/> Hvala na interesovanju! <br/> Prijavite se sledece godine. </font></p>";
					upisi_pohadja_nastavu(0, $rows['username']);
                    return false;

                }else if($trenutanBrojUcenika < 8){
                    echo $tablica_predavanja;
                    return true;
                }

            }
        }

    }



    function dodajUGrupu($username){

		$nazivGrupe = "";
        $izvuciUcenika = 'SELECT razred , naziv_grupa FROM ucenik WHERE username LIKE "'.$username.'";';
        $rezultat = $this->konekcija->query($izvuciUcenika)->fetch_assoc();
        $rezultat['razred'] = strtolower($rezultat['razred']);
		$nazivGrupe = $rezultat['naziv_grupa'];
        $update_grupa = 'UPDATE grupa set trenutniBrUcenika = trenutniBrUcenika + 1 where nazivGrupa LIKE "Grupa '.$rezultat['razred'].'";';
        if($this->konekcija->query($update_grupa)){
        } else {return false;}
		
		$update_placanje = "INSERT INTO placanje (username, nazivGrupa, septembar, oktobar, novembar, decembar, januar, februar, mart, april, maj, jun) VALUES ( '".$username."', '".$nazivGrupe."', 0 , 0 ,0 , 0 , 0, 0 , 0 , 0 ,0, 0);";
				if($this->konekcija->query($update_placanje)){
					return true;
				} else {;return  false;}

    }
	/********************************************** statistika *****************************************************************/
	function statistika1(){
		$nizMesecZarade = array();
		$arrMeseci = array( "septembar","oktobar", "novembar", "decembar" , "januar", "februar" , "mart" ,"april", "maj", "jun");
		foreach($arrMeseci as $value){
			$mesecZarada_query = 'Select count('.$value.') AS '.$value.' FROM placanje WHERE '.$value.'=1;';
			$mesecZarada = $this->konekcija->query($mesecZarada_query);
			if($mesecZarada->num_rows > 0){
				while($rows = $mesecZarada->fetch_assoc()){
					$nizMesecZarade [] = $rows[$value] * 1000;
				}
			}
		}
		return json_encode($nizMesecZarade);
		
	}
	
	function statistika2(){
		$ispis = array();
		$arrGrupe = array( "Grupa Prvi razred", "Grupa Drugi razred", "Grupa Treci razred", "Grupa Cetvrti razred", "Grupa Peti razred", "Grupa Sesti razred", "Grupa Sedmi razred", "Grupa Osmi razred", "Grupa Osmi razred", "Grupa Prva godina" , "Grupa Druga godina", "Grupa Treca godina", "Grupa Cetvrta godina");
			$arrGrupe_query = 'Select nazivGrupa, trenutniBrUcenika FROM grupa;';
			$mesecStat = $this->konekcija->query($arrGrupe_query);
			if($mesecStat->num_rows > 0){
				while($rows = $mesecStat->fetch_assoc()){
					$ispis [] = $rows['trenutniBrUcenika'];
				}
			}
		return json_encode($ispis);
		
	}
	
	function statistika3(){
		$ispis = array();
		$osnovnaSkola = 0;
		$srednjaSkola = 0;
		$arrGrupe = array( "Grupa Prvi razred", "Grupa Drugi razred", "Grupa Treci razred", "Grupa Cetvrti razred", "Grupa Peti razred", "Grupa Sesti razred", "Grupa Sedmi razred", "Grupa Osmi razred", "Grupa Osmi razred", "Grupa Prva godina" , "Grupa Druga godina", "Grupa Treca godina", "Grupa Cetvrta godina");
			$arrGrupe_query = 'Select nazivGrupa, trenutniBrUcenika FROM grupa;';
			$mesecStat = $this->konekcija->query($arrGrupe_query);
			if($mesecStat->num_rows > 0){
				while($rows = $mesecStat->fetch_assoc()){
					if (strpos($rows['nazivGrupa'], 'razred') !== false) {
							$osnovnaSkola +=1;
					} else if (strpos($rows['nazivGrupa'], 'godina') !== false) {
							$srednjaSkola +=1;
				}
			}
			}
			
		$ispis [] = $osnovnaSkola;
		$ispis [] = $srednjaSkola;
		return json_encode($ispis);
		
	}
	/********************************************** statistika kraj************************************************/
    
    
/*********************************xml cuvanje******************************/

function cuvanjeXML(){

$filename = "placanje".date("Y-m-d_H-i",time()).".xml";


$sqlQuery = 'SELECT * FROM placanje';
if (!$result = $this->konekcija->query($sqlQuery)) {
    throw new Exception(sprintf('Mysqli: (%d): %s',  $this->konekcija->errno,  $this->konekcija->error));
}

$placanje = array();

if ($result = $this->konekcija->query($sqlQuery)) {

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {

       array_push($placanje, $row);
    }   
    if(count($placanje)){
         $this->createXMLfile($placanje);
     }
    /* free result set */
    $result->free();
}
/* close connection */
$this->konekcija->close();
}
function createXMLfile($placanje){
  
    $filePath = 'placanje.xml';
 
    $dom     = new DOMDocument('1.0', 'utf-8'); 
 
    $root = $dom->createElement('placanje'); 
 
    for($i=0; $i<count($placanje); $i++){
      
      $placanjeID        =  $placanje[$i]['id_placanje'];  
 
      $username      =   htmlspecialchars($placanje[$i]['username']);
 
      $nazivGrupa    =  $placanje[$i]['nazivGrupa']; 
 
      $septembar     =  $placanje[$i]['septembar']; 
 
      $oktobar      =  $placanje[$i]['oktobar']; 
 
      $novembar  =  $placanje[$i]['novembar'];	

      $decembar  =  $placanje[$i]['decembar'];
      
      $januar  =  $placanje[$i]['januar'];
      
      $februar  =  $placanje[$i]['februar'];
      
      $mart  =  $placanje[$i]['mart'];
      
      $april  =  $placanje[$i]['april'];
      
      $maj  =  $placanje[$i]['maj'];

      $jun  =  $placanje[$i]['jun'];	
 
      $placanjeID_r = $dom->createElement('placanjeIDr');
 
      $placanjeID_r->setAttribute('id', $placanjeID);
 
      $username1 = $dom->createElement('username');
 
      $placanjeID_r->setAttribute('username', $username);

      $nazivGrupa1 = $dom->createElement('nazivGrupa');
 
      $placanjeID_r->setAttribute('nazivGrupa', $nazivGrupa);
 
      $septembar1 = $dom->createElement('septembar');
 
      $placanjeID_r->setAttribute('septembar', $septembar);

      $oktobar1 = $dom->createElement('oktobar');
 
      $placanjeID_r->setAttribute('oktobar', $oktobar);

      $novembar1 = $dom->createElement('novembar');
 
      $placanjeID_r->setAttribute('novembar', $novembar);

      $decembar1 = $dom->createElement('decembar');
 
      $placanjeID_r->setAttribute('decembar', $decembar);

      $januar1 = $dom->createElement('januar');
 
      $placanjeID_r->setAttribute('januar', $januar);

      $februar1 = $dom->createElement('februar');
 
      $placanjeID_r->setAttribute('februar', $februar);

      $mart1 = $dom->createElement('mart');
 
      $placanjeID_r->setAttribute('mart', $mart);

      $april1 = $dom->createElement('april');
 
      $placanjeID_r->setAttribute('april', $april);

      $maj1 = $dom->createElement('maj');
 
      $placanjeID_r->setAttribute('maj', $maj);

      $jun1 = $dom->createElement('jun');
 
      $placanjeID_r->setAttribute('jun', $jun);

      $root->appendChild($placanjeID_r);
 
    }
 
    $dom->appendChild($root); 
 
    $dom->save($filePath); 
 
  } 
}// kraj klase ucenik

?>
