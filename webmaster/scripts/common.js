function chkaddform(){
	if(document.frmadd.categoryName.value == "")
	{
		alert("Please enter a category name");
		document.frmadd.categoryName.focus();
		return false;
	}
	if(document.frmadd.pId.value == 0)
	{
		if(confirm("Is this a parent category?")==true){
			return true;
		}else{
			alert("Please select a parent category name from the list");
			document.frmadd.pId.focus();
			return false;
		}
	}
	return true;
}
function chkeditform(){
	if(document.frmedit.categoryName.value == "")
	{
		alert("Please enter a category name");
		document.frmedit.categoryName.focus();
		return false;
	}
	if(document.frmedit.pId.value == 0)
	{
		if(confirm("Is this a parent category?")==true){
			return true;
		}else{
			alert("Please select a parent category name from the list");
			document.frmedit.pId.focus();
			return false;
		}
	}
	return true;
}
function chkAddProduct(){
	if(document.frmadd.imgTitle.value == "")
	{
		alert("Please enter a product name");
		document.frmadd.imgTitle.focus();
		return false;
	}
	if(document.frmadd.imgPrice.value == "")
	{
		alert("Please enter a product price");
		document.frmadd.imgPrice.focus();
		return false;
	}
	if(isNaN(document.frmadd.imgPrice.value))
	{
		alert("Please enter a product price in only numeric");
		document.frmadd.imgPrice.focus();
		return false;
	}
	if(document.frmadd.imgPhotoAdd.value == "")
	{
		alert("Please browse an image for your product");
		document.frmadd.imgPhotoAdd.focus();
		return false;
	}
	if(document.frmadd.categoryId.value == 0)
	{
		alert("Please select a category");
		document.frmadd.categoryId.focus();
		return false;
	}
	return true;
}
function chkEditProduct(){
	if(document.frmedit.imgTitle.value == "")
	{
		alert("Please enter a product name");
		document.frmedit.imgTitle.focus();
		return false;
	}
	if(document.frmedit.imgPrice.value == "")
	{
		alert("Please enter your product price");
		document.frmedit.imgPrice.focus();
		return false;
	}
	if(isNaN(document.frmedit.imgPrice.value))
	{
		alert("Please enter a product price in only numeric");
		document.frmedit.imgPrice.focus();
		return false;
	}
	if(document.frmedit.categoryId.value == 0)
	{
		alert("Please select a category");
		document.frmedit.categoryId.focus();
		return false;
	}
	return true;
}
function chk_date()
{
	if(document.frmsale.frmdate.value == "")
	{
		alert("Please select a date from where you want to get the report");
		document.frmsale.frmdate.focus();
		return false;
	}
	if(document.frmsale.todate.value != "")
	{
		if(document.frmsale.frmdate.value == document.frmsale.todate.value || document.frmsale.frmdate.value > document.frmsale.todate.value){
		alert('"From Date" must be less than "To Date"');
		document.frmsale.todate.focus();
		return false;
		}
	}
	return true;
}
function validateLink()
{
	if((document.frm_link.link_url.value.indexOf("http://",0) == -1 ) && (document.frm_link.link_url.value.indexOf("https://",0) == -1 ))
	{
		alert("Please provide a valid URL");
		document.frm_link.link_url.focus();
		return false;
	}
	
}
function validate_forget_password()
{
	if(document.forget_password.user_email.value == "")
	{
		alert("Please Enter Email Address");
		document.forget_password.user_email.focus();
		return false;
	}
	var remail=/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
	if(!remail.test(document.forget_password.user_email.value))
	{
		alert("Please enter your correct Email address.");
		document.forget_password.user_email.focus();
		return false;
	}
}
function submitonce(theform){
//if IE 4+ or NS 6+
if (document.all||document.getElementById){
//screen thru every element in the form, and hunt down "submit" and "reset"
for (i=0;i<theform.length;i++){
var tempobj=theform.elements[i]
if(tempobj.type.toLowerCase()=="submit"||tempobj.type.toLowerCase()=="reset")
//disable em
tempobj.disabled=true
}// end for
}// end if
}

function SymError()
{
  return true;
}
//window.onerror = SymError;
// Rev. 19/12/2005
function popupwin(url,w,h) { 
     var winl = (screen.width - w) / 2;
     var wint = (screen.height - h) / 2;
     winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+'resizable=0'
  	 win=window.open(url,'name', winprops);
	 win.focus();
  }
// Rev. 09/07/2005
function closeMenus(url) {
	Toggle('adminindex',url);
	Toggle('serversettings',url);
	Toggle('newsleter',url);
	Toggle('contentMng',url);
	Toggle('product',url);
	Toggle('tax',url);
	Toggle('user',url);
	Toggle('performence',url);
	Toggle('other',url);
}
function Toggle(item,url) {
	var obj;
	if ( document.getElementById ) 
   	{
		obj=document.getElementById(item);
	} else {
		obj = document.all[item];
	}
	var key;
   	if ( document.getElementById ) 
   	{
		key=document.getElementById("x" + item);
	} else {
		key = document.all['x' +item];
	}	

	if (obj != undefined) {
		var visible = ( obj.style.display != 'none');
		if (visible) {
			obj.style.display="none";
			key.innerHTML="<img src='"+url+"plus_new.gif' width='11' height='11' hspace='0' vspace='0' border='0'>";
		} else {
			obj.style.display="block";
			key.innerHTML="<img src='"+url+"neg_new.gif' width='11' height='11' hspace='0' vspace='0' border='0'>";
		}
	}
}

function Expand(url) {
   if (document.getElementById) {
	    divs=document.getElementsByTagName("DIV");
	} else {		
		divs = document.all['DIV'];
	}

   for (i=0;i<divs.length;i++) {
     divs[i].style.display="block";
     key=document.getElementById("x" + divs[i].id);
     key.innerHTML="<img src='"+url+"neg_new.gif' width='11' height='11' hspace='0' vspace='0' border='0'>";
   }
}

function Collapse(url) {
	if (document.getElementById) {
	    divs=document.getElementsByTagName("DIV");
	} else {		
		divs = document.all['DIV'];
	}
   
   for (i=0;i<divs.length;i++) {
     divs[i].style.display="none";
     key=document.getElementById("x" + divs[i].id);
     key.innerHTML="<img src='"+url+"plus_new.gif' width='11' height='11' hspace='0' vspace='0' border='0'>";
   }
}
// Validation Setting

function addpage()
{
var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(!regBlank.test(document.frmadd.pageheading.value)){
alert("Please Insert Branch Name");
document.frmadd.pageheading.focus();
return false;
}
}
function newsvalidation()
{

var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(!regBlank.test(document.frmadd.pageheading.value)){
alert("Please Insert News Heading");
document.frmadd.pageheading.focus();
return false;
}
//////////////////////

}

function searchproduct()
{
	
var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
if(!regBlank.test(document.frmadd.searchtext.value)){
alert("Please Insert Search Text");
document.frmadd.searchtext.focus();
return false;
}
}

function product()
{

var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(document.frmadd.categoryId.value==0){
alert("Please Select Category");
document.frmadd.categoryId.focus();
return false;
}
if(!regBlank.test(document.frmadd.productName.value)){
alert("Please Insert Product Name");
document.frmadd.productName.focus();
return false;
}
if(!regBlank.test(document.frmadd.productWeight.value)){
alert("Please Insert Product Weight");
document.frmadd.productWeight.focus();
return false;
}
alert('-------------------------');
if(!regBlank.test(document.frmadd.productPrice.value)){
alert("Please Insert Product Price");
document.frmadd.productPrice.focus();
return false;
}
if(!regBlank.test(document.frmadd.productItemNo.value)){
alert("Please Insert Product Item No.");
document.frmadd.productItemNo.focus();
return false;
}
}


function product_price()
{

var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;


	if(document.frm_addproduct.productSpecialPrice.value!=''){
	
		alert(document.frm_addproduct.productPrice.value);
		alert(document.frm_addproduct.productSpecialPrice.value);
	
		if(document.frm_addproduct.productSpecialPrice.value > document.frm_addproduct.productPrice.value){
			alert("Product Special Price should be always less than Product Price");
			document.frm_addproduct.productSpecialPrice.focus();
			return false;
		}
	}
}
/*if(!regBlank.test(document.frmaddpro.productSpecialPrice.value)>(!regBlank.test(document.frmaddpro.productPrice.value)){
alert("product SpecialPrice alwayes less from Product Price");
document.frm_addproduct.productSpecialPrice.focus();
return false;
}
 }*/



function product111()
{


var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(document.frmaddpro.categoryId.value==0){
alert("Please Select Category");
document.frmaddpro.categoryId.focus();
return false;
}
if(!regBlank.test(document.frmaddpro.productName.value)){
alert("Please Insert Product Name");
document.frmaddpro.productName.focus();
return false;
}
if(!regBlank.test(document.frmaddpro.productWeight.value)){
alert("Please Insert Product Weight");
document.frmaddpro.productWeight.focus();
return false;
}

if(!regBlank.test(document.frmaddpro.productPrice.value)){
alert("Please Insert Product Price");
document.frmaddpro.productPrice.focus();
return false;
}
if(!regBlank.test(document.frmaddpro.productItemNo.value)){
alert("Please Insert Product Item No.");
document.frmaddpro.productItemNo.focus();
return false;
}
if(document.frmaddpro.productSpecialPrice.value!=''){
	a=parseInt(document.frmaddpro.productPrice.value);
	b=parseInt(document.frmaddpro.productSpecialPrice.value);
		alert(a);
		alert(b);
	
		if(a < b){
			alert("Product Special Price should be always less than Product Price");
			//document.frmaddpro.productSpecialPrice.focus();
			return false;
		}
	}
}



function announce()
{

var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(!regBlank.test(document.frmadd.announcement.value)){
alert("Please Insert Announcement Heading");
document.frmadd.announcement.focus();
return false;
}
}


function conferencehall()
{
var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(!regBlank.test(document.frmadd.pageheading.value)){
alert("Please insert Conferencehall Name");
document.frmadd.pageheading.focus();
return false;
}
}

function publication()
{
var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(!regBlank.test(document.frmadd.pageheading.value)){
alert("Please insert Publication Heading");
document.frmadd.pageheading.focus();
return false;
}
}

function speech()
{
var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(!regBlank.test(document.frmadd.pageheading.value)){
alert("Please insert Speech Heading");
document.frmadd.pageheading.focus();
return false;
}
}

function addreleases()
{
var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(!regBlank.test(document.frmadd.pageheading.value)){
alert("Please insert Press Releases Heading");
document.frmadd.pageheading.focus();
return false;
}
}

function site_map()
{
var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(!regBlank.test(document.frmadd.pageheading.value)){
alert("Please insert Site Map Link");
document.frmadd.pageheading.focus();
return false;
}
if(!regBlank.test(document.frmadd.link.value)){
alert("Please insert Link");
document.frmadd.link.focus();
return false;
}
}

function user_add()
{
var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(!regBlank.test(document.frmadd.username.value)){
alert("Please insert User Name");
document.frmadd.username.focus();
return false;
}
if(!regBlank.test(document.frmadd.password.value)){
alert("Please insert Password");
document.frmadd.password.focus();
return false;
}
if(!regBlank.test(document.frmadd.firstname.value)){
alert("Please insert Name");
document.frmadd.firstname.focus();
return false;
}
if(!regBlank.test(document.frmadd.address.value)){
alert("Please insert Address");
document.frmadd.address.focus();
return false;
}
if(!regBlank.test(document.frmadd.zip.value)){
alert("Please insert Zip");
document.frmadd.zip.focus();
return false;
}
if(!regBlank.test(document.frmadd.email.value)){
alert("Please insert E-Mail");
document.frmadd.email.focus();
return false;
}
if(the_mail(document.frmadd.email.value))
{
document.frmadd.email.focus();
return false;
}
}

function user_edit()
{
var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(!regBlank.test(document.frmadd.password.value)){
alert("Please insert Password");
document.frmadd.password.focus();
return false;
}
if(!regBlank.test(document.frmadd.firstname.value)){
alert("Please insert Name");
document.frmadd.firstname.focus();
return false;
}
if(!regBlank.test(document.frmadd.address.value)){
alert("Please insert Address");
document.frmadd.address.focus();
return false;
}
if(!regBlank.test(document.frmadd.zip.value)){
alert("Please insert Zip");
document.frmadd.zip.focus();
return false;
}
if(!regBlank.test(document.frmadd.email.value)){
alert("Please insert E-Mail");
document.frmadd.email.focus();
return false;
}
}

function eventlink()
{
var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(!regBlank.test(document.frmadd.pageheading.value)){
alert("Please insert Event Link");
document.frmadd.pageheading.focus();
return false;
}
}
function page()
{
var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(!regBlank.test(document.frmadd.pageheading.value)){
alert("Please insert Page Heading");
document.frmadd.pageheading.focus();
return false;
}
}

function addnews()
{
var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(!regBlank.test(document.frmadd.news_heading.value)){
alert("Please insert news heading");
document.frmadd.news_heading.focus();
return false;
}
if(!regBlank.test(document.frmadd.news_date.value)){
alert("Please insert news date");
document.frmadd.news_date.focus();
return false;
}
}
//////////////////////////////
function addadmission()
{
var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(!regBlank.test(document.frmadd.admission_heading.value)){
alert("Please insert admission heading");
document.frmadd.admission_heading.focus();
return false;
}
if(!regBlank.test(document.frmadd.admission_date.value)){
alert("Please insert admission date");
document.frmadd.admission_date.focus();
return false;
}
}
//////////////////////////////////////////////////////////
function addsportsevent()
{
var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(!regBlank.test(document.frmadd.event_heading.value)){
alert("Please insert event heading");
document.frmadd.event_heading.focus();
return false;
}
if(!regBlank.test(document.frmadd.event_date.value)){
alert("Please insert event date");
document.frmadd.event_date.focus();
return false;
}
}
////////////////////

function addsports()
{
var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
	
if(!regBlank.test(document.frmadd.sportsheading.value)){
alert("Please insert sports heading");
document.frmadd.sportsheading.focus();
return false; 
}
if(!regBlank1.test(document.frmadd.description.value)){
alert("Please insert sports description");
document.frmadd.description.focus();
return false; 
}
}
/////////
function addregis()
{
var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
var regBlank2=/[^\s]/;
	
if(!regBlank.test(document.frmadd.e_mail.value)){
alert("Please insert e-mail");
document.frmadd.e_mail.focus();
return false; 
}
if(!regBlank1.test(document.frmadd.nick_name.value)){
alert("Please insert nick name");
document.frmadd.nick_name.focus();
return false; 
}
if(!regBlank2.test(document.frmadd.password.value)){
alert("Please insert password");
document.frmadd.password.focus();
return false; 
}
}
////////////////////////////////////////////
function addnews_letter()
{
var regBlank = /[^\s]/;
	
if(!regBlank.test(document.frmadd.subject.value)){
alert("Please insert Subject");
document.frmadd.subject.focus();
return false; 
}
}
////////////////////////////////////////////////

function addbanner()
{
var regBlank = /[^\s]/;
	
if(!regBlank.test(document.frm_banner.bannerName.value)){
alert("Please insert banner name");
document.frm_banner.bannerName.focus();
return false; 
}
}

function add_advertisement()
{
var regBlank = /[^\s]/;
	
if(!regBlank.test(document.frm_banner.bannerName.value)){
alert("Please insert Advertisement name");
document.frm_banner.bannerName.focus();
return false; 
}
}


function addvideo()
{
var regBlank = /[^\s]/;
	
if(!regBlank.test(document.frm_video.photoName.value)){
alert("Please Insert Video Name");
document.frm_video.photoName.focus();
return false; 
}
}

function photo_name()
{
var regBlank = /[^\s]/;
	
if(!regBlank.test(document.frm_gallary.photoName.value)){
alert("Please Insert Photo Name");
document.frm_gallary.photoName.focus();
return false; 
}
}

/////////////////////////////////////
function addbanner_name()
{
var regBlank = /[^\s]/;

if(!regBlank.test(document.frm_banner.bannerName.value)){
alert("Please insert banner name");
document.frm_banner.bannerName.focus();
return false; 
}
}
///////////////////////
function delskin()
{
var regBlank = /[^\s]/;

if(!regBlank.test(document.frm_skin.value)){
alert("Please insert banner name");
document.frm_banner.focus();
return false; 
}
}
///////////////////////
function addfaq()
{
var regBlank = /[^\s]/;
var regBlank1=/[^\s]/;
if(!regBlank.test(document.frmadd.ques.value)){
alert("Please insert faq question");
document.frmadd.ques.focus();
return false; 
}
if(!regBlank1.test(document.frmadd.ans.value)){
alert("Please insert faq answer");
document.frmadd.ans.focus();
return false; 
}
}
/////////////////////////////////////
function popupwin(url,w,h) { 
     var winl = (screen.width - w) / 2;
     var wint = (screen.height - h) / 2;
     winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+'resizable=0'
  	 win=window.open(url,'name', winprops);
	 win.focus();
  }
  
//////////////////////////////////////
function the_mail(control_value)
{
		var emailStr = control_value;
		var emailPat=/^(.+)@(.+)$/
		var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
		var validChars="\[^\\s" + specialChars + "\]"
		var quotedUser="(\"[^\"]*\")"
		var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
		var atom=validChars + '+'
		var word="(" + atom + "|" + quotedUser + ")"
		var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
		var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")
		var matchArray=emailStr.match(emailPat)
		if (matchArray==null) 
		{
			alert("Email address seems incorrect ");
			//eval("document."+form_name+"."+control_name).focus();
			return true;
		}
		var user=matchArray[1]
		var domain=matchArray[2]
		if (user.match(userPat)==null)
		{
			alert("The Email address doesn't seem to be valid.");
			//eval("document."+form_name+"."+control_name).focus();
			return true;
		}
		var IPArray=domain.match(ipDomainPat)
		if (IPArray!=null) 
		{
			for (var i=1;i<=4;i++) 
			{
				if (IPArray[i]>255) 
				{
					alert("Destination IP address is invalid!");
					//eval("document."+form_name+"."+control_name).focus();
					return true;
				}
			}
				 
		}
		var domainArray=domain.match(domainPat)
		if (domainArray==null) 
		{
			alert("The domain name doesn't seem to be valid.");
			//eval("document."+form_name+"."+control_name).focus();
			return true;
		}
		var atomPat=new RegExp(atom,"g")
		var domArr=domain.match(atomPat)
		var len=domArr.length
		if (domArr[domArr.length-1].length<2 || domArr[domArr.length-1].length>3) 
		{
			alert("The address must end in a three-letter domain, or two letter country.");
			//eval("document."+form_name+"."+control_name).focus();
			return true;
		}
		if (len<2) 
		{
			alert("This address is missing a hostname!");
			//eval("document."+form_name+"."+control_name).focus();
			return true;
		}
		return false;
	
}
