window.addEventListener('load', function () {
	"use strict";

 	const URL_ANIMALS = 'getAnimals.php';
    const URL_ANIMALS_JSON = URL_ANIMALS + '?useJSON';
    const URL_ANIMALS_XML = URL_ANIMALS + '?useXML';

 // const fetchAnimalsHTML = function(){

	//  fetch(URL_ANIMALS)
	//    .then(
	//      function (response) {
	//        return(response.text());
	//    })
	//    .then(
	//    		function(text){
	//    			//console.log(text);
	//    			document.getElementById("img1").innerHTML = text;
	//    		}
	//    	)
	//    .catch(
	//      function (err) {
	//        console.log("Something went wrong!", err);
	//    });
 // }
 //   //What setInterval takes
 //   //setInterval(func, number)

 //    fetchAnimalsHTML();

 //   //setInterval(fetchAnimalsHTML,6000);



	// const fetchAnimalJSON = function() {
	//   fetch(URL_ANIMALS_JSON)
	//     .then(
	//       function(response) {
 //        	const contentType = response.headers.get('content-type');
	//         if (contentType.includes('application/json')) {
	//           return response.json();
	//         }
 //        	return response.text();
 //    	}).then(
 //    		function(json){
 //    			let html = "<img src='img/" + json.filename + "' alt='" + json.description + "'>";
 //    			html += "<p><span class='creator'>Created by: " + json.creator.firstname + " " + json.creator.lastname + "</span></p>";
 //    			html += "<p><span class='source'>Source: " + json.source + "</span></p>";
 //    			html += "<p><span class='description'>Description: " + json.description + "</span></p>";
 //    			document.getElementById("img2").innerHTML = html;
 //    		}
 //    	)
	//     .catch(
	//       function(err) {
	//         console.log("Something went wrong!", err);
	//     });
	//  }

	// fetchAnimalJSON();

	

	// const fetchAnimalXML = function() {
	//   fetch(URL_ANIMALS_XML)
	//     .then(
	//       function(response) {
	//       	 const contentType = response.headers.get('content-type');
	//         if (contentType.includes('application/json')) {
	//           return response.json();
	//         }
	//         return response.text();
	//     })
	//     .then(
	//       function(text) {
	//     	  let parser = new DOMParser();
	//     	  let xmlDoc = parser.parseFromString(text,"text/xml");

	//     	  let filename = xmlDoc.getElementsByTagName("filename")[0].innerHTML;
	//     	  let description = xmlDoc.getElementsByTagName("description")[0].innerHTML;
	//     	  let creator = xmlDoc.getElementsByTagName("creator")[0].innerHTML;
	//     	  let firstname = xmlDoc.getElementsByTagName("firstname")[0].innerHTML;
	//     	  let lastname = xmlDoc.getElementsByTagName("lastname")[0].innerHTML;
	//     	  let source = xmlDoc.getElementsByTagName("source")[0].innerHTML;

	//     	  let html = "<img src='img/" + filename + "' alt='" + description + "'>";
	//     	  html += "<p><span class='creator'>Created by: " + firstname + " " + lastname + "</span></p>";
 //    		  html += "<p><span class='source'>Source: " + source + "</span></p>";
 //    		  html += "<p><span class='description'>Description: " + description + "</span></p>";

	//     	  document.getElementById("img3").innerHTML = html;
	//     })
	//     .catch(
	//       function(err) {
	//         console.log("Something went wrong!", err);
	//     });
	//  }

	// fetchAnimalXML();

	//Condensing everything into one function

	const htmlCallback = function(data){
		document.getElementById("img1").innerHTML = data;	
	}

	const jsonCallback = function(data){
		let html = "<img src='img/" + data.filename + "' alt='" + data.description + "'>";
    	html += "<p><span class='creator'>Created by: " + data.creator.firstname + " " + data.creator.lastname + "</span></p>";
    	html += "<p><span class='source'>Source: " + data.source + "</span></p>";
    	html += "<p><span class='description'>Description: " + data.description + "</span></p>";
    	document.getElementById("img2").innerHTML = html;
	}

	const xmlCallback = function(data){
		let parser = new DOMParser();
	    let xmlDoc = parser.parseFromString(data,"text/xml");

	   	let filename = xmlDoc.getElementsByTagName("filename")[0].innerHTML;
	    let description = xmlDoc.getElementsByTagName("description")[0].innerHTML;
	    let creator = xmlDoc.getElementsByTagName("creator")[0].innerHTML;
	    let firstname = xmlDoc.getElementsByTagName("firstname")[0].innerHTML;
	    let lastname = xmlDoc.getElementsByTagName("lastname")[0].innerHTML;
	    let source = xmlDoc.getElementsByTagName("source")[0].innerHTML;

	    let html = "<img src='img/" + filename + "' alt='" + description + "'>";
	    html += "<p><span class='creator'>Created by: " + firstname + " " + lastname + "</span></p>";
    	html += "<p><span class='source'>Source: " + source + "</span></p>";
    	html += "<p><span class='description'>Description: " + description + "</span></p>";

	    document.getElementById("img3").innerHTML = html;
	}

	//Checking what data type is being sent
	const fetchAnimal = function(URL, callback) {
	  fetch(URL)
	    .then(
	      function(response) {
	      	 const contentType = response.headers.get('content-type');
	        if (contentType.includes('application/json')) {
	          return response.json();
	        }
	        return response.text();
	    })
	    .then(
	      function(data) {
	      	 callback(data);
	    })
	    .catch(
	      function(err) {
	        console.log("Something went wrong!", err);
	    });
	}

	const mainHTML = function(){
		fetchAnimal(URL_ANIMALS, htmlCallback);
	}
	const mainJSON = function(){
	 	fetchAnimal(URL_ANIMALS_JSON, jsonCallback);
	}
	const mainXML = function(){
	 	fetchAnimal(URL_ANIMALS_XML, xmlCallback);
	}

		
	
	mainHTML();
	setInterval(mainHTML,3000);
	mainJSON();
	setInterval(mainJSON,4000);
	mainXML();
	setInterval(mainXML,5000);
});