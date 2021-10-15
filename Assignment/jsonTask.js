//Anonymous function that activated when the page is loaded
window.addEventListener('load', function () {
	//Preventing the use of undeclared variabled 
	"use strict";

	//Setting up the URLs for each method of displaying the data
	const URL_OFFERS = 'getOffers.php';
    const URL_OFFERS_JSON = URL_OFFERS + '?useJSON';

    //An anonymous function to assign the "offers" aside in index.php with
    //data fetched through html
    const htmlCallback = function(data){
		document.getElementById("offers").innerHTML = data;	
	}

	//An anonymous function to assign the "JSONoffers" aside in index.php with
	//data fetched through json
	const jsonCallback = function(data){
    	let html = "<p>&#8220;" + data.bookTitle + "&#8221;<br>";
    	html += "<span class='category'>Category: " + data.catDesc + "</span><br>";
    	html += "<span class='price'>Price: £" + data.bookPrice + "</span></p>";
    	document.getElementById("JSONoffers").innerHTML = html;
	}
	
	//Anonymous function to fetch the offers using the correct URL and method of callback
	const fetchOffers = function(URL, callback){
		//Fetches the data fro mthe URL provided
		fetch(URL).then(function(response){
			//Storing the content type of the website into a variable
	      	const contentType = response.headers.get('content-type');

	      	//If the content type is json...
	        if(contentType.includes('application/json')){
	        	//output the json data
	          	return response.json();
	        }
	        //output the html/xml data
	        return response.text();

	        //Then callback the appropriate data format
		    }).then(function(data){
		      	callback(data);
		    //Print an error is one was tripped
		    }).catch(function(error){
		        console.log("There was an error", error);

		    });
		}

	//Placing fetchOffers for HTML function into a dedicated function
	const mainHTML = function(){
		fetchOffers(URL_OFFERS, htmlCallback);
	}
	//Placing fetchOffers for JSON function into a dedicated function
	const mainJSON = function(){
	 	fetchOffers(URL_OFFERS_JSON, jsonCallback);
	}

	//Displaying the initial data for HTML
	mainHTML();
	//Randomly generating the data for HTML after 5 seconds
	setInterval(mainHTML,5000);
	//Displaying the data for JSON
	mainJSON();
});