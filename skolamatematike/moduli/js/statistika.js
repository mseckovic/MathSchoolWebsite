/********************************************************************************************************************
bar ukupna zarada
******************************************************************************************************************* */
$(document).ready(function(){
			$.ajax({
           type: "POST",  // tip POST ili GET
           url: "moduli/obrada_ajax.php", // koju skriptu da ajax kontaktira
           data: {akcija: "grafikZarada"}, //kako da salje podatke : $_POST['akcija'] ...
           timeout:3000, //kolko da ceka
           dataType: "json", // sta ocekuje da vrati skripta ukoliko je uspesno text, json ...
           complete: function(odgovor){ // ako se vratila poruka sa kodom/statusom 200, da je sve proslo dobro
			   var ctx = document.getElementById("stat1").getContext('2d');
			   var arr_data = JSON.parse(odgovor['responseText']);
			   $('#stat1').html('');
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: ["Septembar", "Oktobar", "Novembar", "Decembar", "Januar", "Februar", "Mart", "April", "Maj", "Jun"],
						datasets: [{
							label: ' Zarada',
							data: arr_data,
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(255, 206, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(255, 159, 64, 0.2)',
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(255, 206, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)'
							],
							borderColor: [
								'rgba(255,99,132,1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)',
								'rgba(255,99,132,1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)'
							],
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true
								}
							}]
						},
						responsive: true,
						maintainAspectRatio: false
					}
			});
          }, //success end;
          error: function(data){
            //greska ukoliko se ne vrati dobar dataType ili dodje do ikakve druge greske ....
            console.log(data);
          } // error end;
        });	
});

/********************************************************************************************************************
bar 
******************************************************************************************************************* */
$(document).ready(function(){
			$.ajax({
           type: "POST",  // tip POST ili GET
           url: "moduli/obrada_ajax.php", // koju skriptu da ajax kontaktira
           data: {akcija: "grafikRazred"}, //kako da salje podatke : $_POST['akcija'] ...
           timeout:3000, //kolko da ceka
           dataType: "json", // sta ocekuje da vrati skripta ukoliko je uspesno text, json ...
           complete: function(odgovor){ // ako se vratila poruka sa kodom/statusom 200, da je sve proslo dobro
		   console.log(odgovor);
			   var ctx = document.getElementById("stat2").getContext('2d');
			   var arr_data = JSON.parse(odgovor['responseText']);
			   var tmp = arr_data[12];
			   arr_data[12] =  arr_data[11];
			   arr_data[11] = tmp;
			   $('#stat1').html('');
			   
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						datasets: [{
							label: 'Grupe',
							data: arr_data,
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(255, 206, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(255, 159, 64, 0.2)',
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(255, 206, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(255, 159, 64, 0.2)'
							],
							borderColor: [
								'rgba(255,99,132,1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)',
								'rgba(255,99,132,1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)'
							],
							borderWidth: 1
						}],
						labels: [" Prvi razred", " Drugi razred", " Treci razred", " Cetvrti razred", " Peti razred", " Sesti razred", " Sedmi razred", " Osmi razred", " Osmi razred", " Prva godina" , " Druga godina",  " Treca godina", " Cetvrta godina"],
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true
								}
							}],

						},
						responsive: true,
						maintainAspectRatio: false
					}
			});
          }, //success end;
          error: function(data){
            //greska ukoliko se ne vrati dobar dataType ili dodje do ikakve druge greske ....
            console.log(data);
          } // error end;
        });	
});

/********************************************************************************************************************
pie
******************************************************************************************************************* */
$(document).ready(function(){
			$.ajax({
           type: "POST",  // tip POST ili GET
           url: "moduli/obrada_ajax.php", // koju skriptu da ajax kontaktira
           data: {akcija: "grafikRazred2"}, //kako da salje podatke : $_POST['akcija'] ...
           timeout:3000, //kolko da ceka
           dataType: "json", // sta ocekuje da vrati skripta ukoliko je uspesno text, json ...
           complete: function(odgovor){ // ako se vratila poruka sa kodom/statusom 200, da je sve proslo dobro
		   console.log(odgovor);
			   var ctx = document.getElementById("stat3").getContext('2d');
			   var arr_data = JSON.parse(odgovor['responseText']);
			   console.log(arr_data);
			   var tmp = arr_data[12];
			   arr_data[12] =  arr_data[11];
			   arr_data[11] = tmp;
			   $('#stat1').html('');
			   
				var myChart = new Chart(ctx, {
					type: 'pie',
					data: {
						datasets: [{
							data: arr_data,
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)'
							],
							borderColor: [
								'rgba(255,99,132,1)',
								'rgba(54, 162, 235, 1)'
							],
							borderWidth: 1
						}],
						labels: ["Osnovna Škola" , "Srednja Šloka"],
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true
								}
							}],

						},
						responsive: true,
						maintainAspectRatio: false
					}
			});
          }, //success end;
          error: function(data){
            //greska ukoliko se ne vrati dobar dataType ili dodje do ikakve druge greske ....
            console.log(data);
          } // error end;
        });	
});

