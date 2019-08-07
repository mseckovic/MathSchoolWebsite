/********************************************************************************************************************
posalji_ajax_cekiranje_polja
******************************************************************************************************************* */

function posalji_ajax_cekiranje_polja(naziv_kolone, uid, stat){
		$.ajax({
           type: "POST",  // tip POST ili GET
           url: "moduli/obrada_ajax.php", // koju skriptu da ajax kontaktira
           data: {akcija: "izmenaPlacanja", mesecIzmene: naziv_kolone, username: uid, status : stat }, //kako da salje podatke : $_POST['akcija'] ...
           timeout:3000, //kolko da ceka
           dataType: "text", // sta ocekuje da vrati skripta ukoliko je uspesno text, json ...
           complete: function(odgovor){ // ako se vratila poruka sa kodom/statusom 200, da je sve proslo dobro
           	console.log(odgovor['responseText']); // odgovor - promenjiva koju smo stavili da primi vracenu vrednost
          }, //success end;
          error: function(data){
            //greska ukoliko se ne vrati dobar dataType ili dodje do ikakve druge greske ....
            console.log(data);
          } // error end;
        });
}

/********************************************************************************************************************
Provera cekiranja checkbox-a i menjanje u bazi podataka
******************************************************************************************************************* */
$(":checkbox").click(function() {
	var username_korisnika 	= $(this).closest("tr").attr('id'); //id od trenutnog reda
	var naziv_kolone 		= $(this).attr('id'); // uzimamo id od kliknutog checkbox-a
	var trenutna_vrednost_platio = $(this).closest("tr").find('.platio').html();


	switch(naziv_kolone) { // za laksi upis u bazu radimo switch
		  case '1':
		    naziv_kolone = "januar";
		    break;
		  case '2':
		    naziv_kolone = "februar";
		    break;
		  case '3':
		    naziv_kolone = "mart";
		    break;
		  case '4':
		    naziv_kolone = "april";
		    break;
		  case '5':
		    naziv_kolone = "maj";
		    break;
		  case '6':
		    naziv_kolone = "jun";
		    break;
		  case '9':
		    naziv_kolone = "septembar";
		    break;
		  case '10':
		    naziv_kolone = "oktobar";
		    break;
		  case '11':
		    naziv_kolone = "novembar";
		    break;
		  case '12':
		  	naziv_kolone = "decembar";
		  	break;
	} // switch end

	var status = ""; //sta u bazi da upisemo za mesec
	if(this.checked){ // proveravamo da li je checkbox kod koga je registrovan .click event cekiran ili ne
		status = 1;
		//promena vrednosti platio
		trenutna_vrednost_platio =parseInt(trenutna_vrednost_platio) + 1000;
		$(this).closest("tr").find('.platio').html(trenutna_vrednost_platio);

		posalji_ajax_cekiranje_polja(naziv_kolone, username_korisnika, status);

	} else {
		status = 0;
		//promena vrednosti platio
		trenutna_vrednost_platio =parseInt(trenutna_vrednost_platio) - 1000;
		$(this).closest("tr").find('.platio').html(trenutna_vrednost_platio);

		posalji_ajax_cekiranje_polja(naziv_kolone, username_korisnika, status);
	}
});
