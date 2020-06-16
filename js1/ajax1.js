// JavaScript Document

 function createRequestObject(){

var req;

if(window.XMLHttpRequest){
//For Firefox, Safari, Opera
req = new XMLHttpRequest();
}
else if(window.ActiveXObject){
//For IE 5+
req = new ActiveXObject("Microsoft.XMLHTTP");
}
else{
//Error for an old browser
alert('Your browser is not IE 5 or higher, or Firefox or Safari or Opera');
}

return req;
}

//Make the XMLHttpRequest Object
var http = createRequestObject();

function sendRequest(method, url){

// document.getElementById('loader_image').style.display='inline';
//document.getElementById('moviename').style.display='none';

if(method == 'get' || method == 'GET'){
http.open(method,url);
http.onreadystatechange = handleResponse;

http.send(null);

}
}

function handleResponse(){

	if(http.readyState == 4 && http.status == 200){
var response = http.responseText;

if(response){

//document.getElementById('loader_image').style.display='none';
//document.getElementById("contactme").style.display="none";
//document.getElementById("ajax_res").style.display="block";
document.getElementById("ajax_res").innerHTML ='';
document.getElementById("ajax_res").innerHTML = response;

}
}
}

//**********************************get state by ajax ********************************************************

function sendRequest_country(method, url){

// document.getElementById('loader_image').style.display='inline';
//document.getElementById('moviename').style.display='none';

if(method == 'get' || method == 'GET'){
http.open(method,url);
http.onreadystatechange = handleResponse_country;
http.send(null);
}
}

function handleResponse_country(){

if(http.readyState == 4 && http.status == 200){
var response = http.responseText;

if(response){
//alert(response);
var str = response.split("**");
var state = str[0];
var cCode = str[1];

//alert(state);
//alert(cCode);

//document.getElementById('loader_image').style.display='none';
//document.getElementById("contactme").style.display="none";
//document.getElementById("ajax_res").style.display="block";
document.getElementById("ajax_res").style.display ='block';
document.getElementById("ajax_res").innerHTML ='';
document.getElementById("ajax_res").innerHTML = state;

/*document.getElementById("area_code").style.display ='block';
document.getElementById("area_code").innerHTML ='';*/
document.getElementById("area_code").readOnly = false;
document.getElementById("area_code").value = trim(cCode);


}
}
}

function trim(inputString) {
// Removes leading and trailing spaces from the passed string. Also removes
// consecutive spaces and replaces it with one space. If something besides
// a string is passed in (null, custom object, etc.) then return the input.
if (typeof inputString != "string") { return inputString; }
var retValue = inputString;
var ch = retValue.substring(0, 1);
while (ch == " ") { // Check for spaces at the beginning of the string
retValue = retValue.substring(1, retValue.length);
ch = retValue.substring(0, 1);
}
ch = retValue.substring(retValue.length-1, retValue.length);
while (ch == " ") { // Check for spaces at the end of the string
retValue = retValue.substring(0, retValue.length-1);
ch = retValue.substring(retValue.length-1, retValue.length);
}
while (retValue.indexOf(" ") != -1) { // Note that there are two spaces in the string - look for multiple spaces within the string
retValue = retValue.substring(0, retValue.indexOf(" ")) + retValue.substring(retValue.indexOf(" ")+1, retValue.length); // Again, there are two spaces in each of the strings
}
return retValue; // Return the trimmed string back to the user
} // Ends the "trim" function

//**********************************get cities name by ajax ********************************************************

function sendRequest_state(method, url){

if(method == 'get' || method == 'GET'){
http.open(method,url);
http.onreadystatechange = handleResponse_state;
http.send(null);
}
}

function handleResponse_state(){

if(http.readyState == 4 && http.status == 200){
var response = http.responseText;

if(response){

document.getElementById("ajax_res2").style.display ='block';
document.getElementById("ajax_res2").innerHTML ='';
document.getElementById("ajax_res2").innerHTML = response;

}
}
}
//*************************************************************************************************************

function sendRequest_refID(method, url){

if(method == 'get' || method == 'GET'){
http.open(method,url);
http.onreadystatechange = handleResponse_refID;
http.send(null);
}
}
