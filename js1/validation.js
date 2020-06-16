function chk_reg(){
var regexNum = /\d/;
var regexLetter = /[a-zA-z]/;	

if(document.frmreg.email.value==""){
alert('Please insert your email address');
document.frmreg.email.value="";
document.frmreg.email.focus();
return false;
}
if (echeck(document.frmreg.email.value)==false){
document.frmreg.email.value="";
document.frmreg.email.focus();
return false;
}
if(document.frmreg.pw.value==""){
alert('Please insert your password');
document.frmreg.pw.value="";
document.frmreg.pw.focus();
return false;
}
if(document.frmreg.cpw.value==""){
alert('Please retype your password to confirm');
document.frmreg.cpw.value="";
document.frmreg.cpw.focus();
return false;
}
if(document.frmreg.pw.value!=document.frmreg.cpw.value){
alert('Please confirm your password correctly');
document.frmreg.cpw.value="";
document.frmreg.cpw.focus();
return false;
}
if(document.frmreg.fName.value==""){
alert('Please insert your first name');
document.frmreg.fName.focus();
return false;
}
if(!regexLetter.test(document.frmreg.fName.value)){
alert('Type alphabet for your first name');
document.frmreg.fName.value="";
document.frmreg.fName.focus();
return false;
}
if(document.frmreg.lName.value==""){
alert('Please insert your last name');
document.frmreg.lName.focus();
return false;
}
if(!regexLetter.test(document.frmreg.lName.value)){
alert('Type alphabet for your last name');
document.frmreg.lName.value="";
document.frmreg.lName.focus();
return false;
}
if(document.frmreg.shippingAddress1.value==""){
alert('Please insert your shipping address');
document.frmreg.shippingAddress1.focus();
return false;
}
if(document.frmreg.countryId.value==0){
alert('Please select your country');
document.frmreg.countryId.focus();
return false;
}
if(document.frmreg.state.value==""){
alert('Please insert your state');
document.frmreg.state.focus();
return false;
}
if(document.frmreg.city.value==""){
alert('Please insert your city');
document.frmreg.city.focus();
return false;
}
if(document.frmreg.zip.value==""){
alert('Please insert your zip code');
document.frmreg.zip.focus();
return false;
}
if(document.frmreg.phone.value==""){
alert('Please insert your contact number');
document.frmreg.phone.focus();
return false;
}
if(isNaN(document.frmreg.phone.value)){
alert('Contact No Must Be Numeric');
document.frmreg.phone.value="";
document.frmreg.phone.focus();
return false;
}
document.frmreg.submit();
return true;
}

function chk_log(){
	if(document.formlog.userName.value==""){
	alert('Please insert your username');
	document.formlog.userName.value="";
	document.formlog.userName.focus();
	return false;
	}
	if (echeck(document.formlog.userName.value)==false){
	document.formlog.userName.value="";
	document.formlog.userName.focus();
	return false;
	}
	if(document.formlog.userPassword.value==""){
	alert('Please insert your password');
	document.formlog.userPassword.value="";
	document.formlog.userPassword.focus();
	return false;
	}
	return true;
}
function chk_editProfile(){
var regexNum = /\d/;
var regexLetter = /[a-zA-z]/;	

if(document.frmedit.npw.value!=""){
	if(document.frmedit.cpw.value==""){
	alert('Please retype your password to confirm');
	document.frmedit.cpw.value="";
	document.frmedit.cpw.focus();
	return false;
	}
}
if(document.frmedit.npw.value!=document.frmedit.cpw.value){
alert('Please confirm your password correctly');
document.frmedit.cpw.value="";
document.frmedit.cpw.focus();
return false;
}
if(document.frmedit.fName.value==""){
alert('Please insert your first name');
document.frmedit.fName.focus();
return false;
}
if(!regexLetter.test(document.frmedit.fName.value)){
alert('Type alphabet for your first name');
document.frmedit.fName.value="";
document.frmedit.fName.focus();
return false;
}
if(document.frmedit.lName.value==""){
alert('Please insert your last name');
document.frmedit.lName.focus();
return false;
}
if(!regexLetter.test(document.frmedit.lName.value)){
alert('Type alphabet for your last name');
document.frmedit.lName.value="";
document.frmedit.lName.focus();
return false;
}
if(document.frmedit.shippingAddress1.value==""){
alert('Please insert your shipping address');
document.frmedit.shippingAddress1.focus();
return false;
}
if(document.frmedit.countryId.value==0){
alert('Please select your country');
document.frmedit.countryId.focus();
return false;
}
if(document.frmedit.state.value==""){
alert('Please insert your state');
document.frmedit.state.focus();
return false;
}
if(document.frmedit.city.value==""){
alert('Please insert your city');
document.frmedit.city.focus();
return false;
}
if(document.frmedit.zip.value==""){
alert('Please insert your zip code');
document.frmedit.zip.focus();
return false;
}
if(document.frmedit.phone.value==""){
alert('Please insert your contact number');
document.frmedit.phone.focus();
return false;
}
if(isNaN(document.frmedit.phone.value)){
alert('Contact No Must Be Numeric');
document.frmedit.phone.value="";
document.frmedit.phone.focus();
return false;
}
document.frmedit.submit();
return true;
}

function chk_contact(){
var regexNum = /\d/;
var regexLetter = /[a-zA-z]/;	

if(document.frmcontact.subject.value==""){
alert('Please insert a subject of your query');
document.frmcontact.subject.value="";
document.frmcontact.subject.focus();
return false;
}
if(document.frmcontact.name.value==""){
alert('Please insert your full name');
document.frmcontact.name.focus();
return false;
}
if(!regexLetter.test(document.frmcontact.name.value)){
alert('Type alphabet for your name');
document.frmcontact.name.value="";
document.frmcontact.name.focus();
return false;
}
if(document.frmcontact.address1.value==""){
alert('Please insert your address');
document.frmcontact.address1.focus();
return false;
}
if(document.frmcontact.countryId.value==0){
alert('Please select your country');
document.frmcontact.countryId.focus();
return false;
}
if(document.frmcontact.state.value==""){
alert('Please insert your state');
document.frmcontact.state.focus();
return false;
}
if(document.frmcontact.city.value==""){
alert('Please insert your city');
document.frmcontact.city.focus();
return false;
}
if(document.frmcontact.zip.value==""){
alert('Please insert your zip code');
document.frmcontact.zip.focus();
return false;
}
if(document.frmcontact.email.value==""){
alert('Please insert your email address');
document.frmcontact.email.value="";
document.frmcontact.email.focus();
return false;
}
if (echeck(document.frmcontact.email.value)==false){
document.frmcontact.email.value="";
document.frmcontact.email.focus();
return false;
}
if(document.frmcontact.phone.value==""){
alert('Please insert your contact number');
document.frmcontact.phone.focus();
return false;
}
if(isNaN(document.frmcontact.phone.value)){
alert('Contact No Must Be Numeric');
document.frmcontact.phone.value="";
document.frmcontact.phone.focus();
return false;
}
if(document.frmcontact.comments.value==""){
alert('Please insert your comments');
document.frmcontact.comments.focus();
return false;
}
document.frmcontact.submit();
return true;
}


function echeck(str) {

		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   alert("Invalid E-mail ID")
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert("Invalid E-mail ID")
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert("Invalid E-mail ID")
		    return false
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("Invalid E-mail ID")
		    return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("Invalid E-mail ID")
		    return false
		 }
		
		 if (str.indexOf(" ")!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }

 		 return true					
}

function samevalue()
{
	if(document.frmqckshop.happy.checked == true)
	{
		//alert('Hellow');
		copyBilling();
	}
	else
	{
		blankshipping();
	}
}

function copyBilling()
{
	document.frmqckshop.hidPaymentFirstName.value=document.frmqckshop.hidShippingFirstName.value; 
	document.frmqckshop.hidPaymentLastName.value=document.frmqckshop.hidShippingLastName.value;
	document.frmqckshop.hidPaymentAddress1.value=document.frmqckshop.hidShippingAddress1.value;
	document.frmqckshop.hidPaymentLandMark.value=document.frmqckshop.hidShippingLandMark.value;
	document.frmqckshop.hidPaymentCountry.value=document.frmqckshop.hidShippingCountry.value;
	document.frmqckshop.hidPaymentState.value=document.frmqckshop.hidShippingState.value;
	document.frmqckshop.hidPaymentCity.value=document.frmqckshop.hidShippingCity.value;
	document.frmqckshop.hidPaymentPostalCode.value=document.frmqckshop.hidShippingPostalCode.value;
	document.frmqckshop.hidPaymentPhone.value=document.frmqckshop.hidShippingPhone.value;
}
function blankshipping()
{
	document.frmqckshop.hidPaymentFirstName.value="";
	document.frmqckshop.hidPaymentLastName.value="";
	document.frmqckshop.hidPaymentAddress1.value="";
	document.frmqckshop.hidPaymentLandMark.value="";
	document.frmqckshop.hidPaymentCountry.value="";
	document.frmqckshop.hidPaymentState.value="";
	document.frmqckshop.hidPaymentCity.value="";
	document.frmqckshop.hidPaymentPostalCode.value="";
	document.frmqckshop.hidPaymentPhone.value="";
}