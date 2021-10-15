"use strict";
//Variables that are needed later on in the code

//"form" acts as a selector for the DOM structure of Java, allowing me to refer 
//to all of the contents inside the order form more easily
const form = document.getElementById("orderForm");

//"books" gets the array of books and stores it
const books = document.getElementsByName('book[]');

//----------------------------------------------------------------------------
/*

PART A and B 
------------
Changing the colour and enabling the 
submit button when the check box is checked
the "form" variable contains all the names under it

*/
//----------------------------------------------------------------------------

//Getting the element with the Id "termsText" so I can change its style attributes
const termsText = document.getElementById("termsText");

//When the checkbox is clicked
form.termsChkbx.onclick = function(){
	//If it is clicked and detects it is checked
	if (form.termsChkbx.checked) {
		//Turn the colour of the text to black
		termsText.style.color = "#000000";
		//Set the font weight to normal
		termsText.style.fontWeight = "normal";
		//And Enable the button
		form.submit.disabled = false;
	}
	//Since the other only state for the check box to be in is
	//unchecked, I only need to use and else here
	else{
		//Turn the colour of the text to red
		termsText.style.color = "#FF0000";
		//Bolden the font weight
		termsText.style.fontWeight = "bold";
		//Disabled the button
		form.submit.disabled = true;
	}
};
//----------------------------------------------------------------------------





//----------------------------------------------------------------------------
//Part C | Disabled submit button if stuff is empty
//----------------------------------------------------------------------------

/*

Alright so I'll be honest I tried for a while to get this to work but, I cannot for
the life of me get this part of the code to work. I've either used a wrong method
for targetting data or just completely shat the bed on the logic here. I, unforunately,
I had to give up, but I wanted to leave the code here just to show the types of ways
I tried to complete this part of the assignment. In the credits as well, there are
videos I credit that go more in depth to how the querySelector methods work but,
I just couldn't get them to target the data I needed.

Furthermore, when I did manage to target the content I needed, it wouldn't update
as I was testing it? I would input something into forename and force the console
to update and tell me what it had inside it but it would still say there was no data
e.g. null. Like okay, totally makes sense. I just couldn't solve this on my own and
gave up after a days of frustration. 

Also typed up this rant to justify me skipping it.
Sorry.

*/

//----------------------------------------------------------------------------
//Unused code here
//----------------------------------------------------------------------------

// const forename = form.forename.value;

// form.onsubmit = function(){
// 	if (forename == ""){
// 		alert("error");
// 		return false;
// 	}
// }

//  const retCustDetailsForename = document.querySelector("input[name=forname]");
//  const retCustDetailsSurname = document.querySelector("input[name=surname]");

//  const tradeCustDetails = document.querySelector("tradeCustDetails");
	
//  }

// document.onchange = function(){
// 	console.log(forename);
// 	console.log(document.querySelector("input[name=surname]").value);
// }
//----------------------------------------------------------------------------





//----------------------------------------------------------------------------
//Part D | Calculating the total of selected books as well as delivery type
//----------------------------------------------------------------------------


//Variables for the next sections

//Checking which is checked 
const deliveryType = document.getElementsByName("deliveryType");
//Prepping a priec variable for calculating the total
var price = 0;

//When the form detects a click, run the function
form.onclick = function(){
	//If statement to check which delivery type is selected
	if (deliveryType[0].checked){
		//Add the first deliveryType choice to price total
		price = parseFloat(deliveryType[0].dataset.price);
	}	
	else{
		//Add the other deliveryType choice to price total
		price = parseFloat(deliveryType[1].dataset.price);
	}

	//Goes through the books array until it is at the end
	for(let i=0; i<books.length; i++){
		//If a book it is scrolling through is checked...
		if(books[i].checked){
			/*
			Take the price that has already been calculated so far (the delivery type)
			and make sure it is a float. Then add the book's price that is attributed to
			it within the dataset of "price" (dataset.price). Lastly, I affix a toFixed() 
			method in order to keep the total in 2 decimal places in order to stop any weird
			java addition problems from showing up to the user.
			*/
			price = (parseFloat(price) + parseFloat(books[i].dataset.price)).toFixed(2);
		}
	}
	//Set the total to display the price that has been calculated
	form.total.value = "£"+price;
};
//----------------------------------------------------------------------------





//----------------------------------------------------------------------------
//Part E | Hiding customer type
//----------------------------------------------------------------------------

//Variables containing elements needed to change for the task
const ret = document.getElementById("retCustDetails");
const trade = document.getElementById("tradeCustDetails");

//Settings the default tyle of both the retCustDetails and tradeCustDetails
// to hidden so that the user has to choose an option first
ret.style.visibility = "hidden";
trade.style.visibility = "hidden";

//When the form detects a click...
form.customerType.onclick = function(){
	//If the "ret" customerType is selected...
	if (form.customerType.value === "ret") {
		//Set the visibility of the ret textbox to visible
		ret.style.visibility = "visible";
		//Set the visibility of the trade textbox to invisible
		trade.style.visibility = "hidden";
	}
	//If the "trd" customerType is selected...
	else if (form.customerType.value === "trd") {
		//Set the visibility of the trade textbox to visible
		trade.style.visibility = "visible";
		//Set the visibility of the ret textbox to invisible
		ret.style.visibility = "hidden";
	}
	//If no customerType is selected...
	else if (form.customerType.value === "") {
		//Set the visibility of the trade textbox to invisible
		trade.style.visibility = "hidden";
		//Set the visibility of the ret textbox to invisible
		ret.style.visibility = "hidden";
	}
};
//----------------------------------------------------------------------------