<?

function sendMail($event, $to, $from, $fname, $lname, $email, $passwd)
{
	
	switch($event)
	{
		case "new_regn": $subject = "Welcome to madivers!";
						 $MSG_BODY = '<html>
										<head>
										<link href="http://www.madivers.com/style.css" rel="stylesheet" type="text/css">
										</head>
										<body>
										<table width="100%">
										<tr>
										<td align="center">
										
													<table>
														 <tr>
															<td >
															  <table>
															  
															  <tr>
														<td align="left"><a href="http://www.madivers.com"><img src="http://www.madivers.com/images/logo.gif" width="150" height="60" border="0"></a>
														</td>
													</tr>
													<tr>
																 <td>&nbsp;</td>
																</tr>
																 <tr>
																 <td>&nbsp;</td>
																 </tr>
																<tr>
																<td>Dear ' . $fname . ' ' . $lname . ',</td> 
																</tr>
																<tr>
																 <td>&nbsp;</td>
																</tr>
															   <tr>
																  <td >
																Congratulations, you have successfully registered and are now a valued member of <a href="http://www.madivers.com">Madivers.com</a>, the leading    </td>
															   </tr>
																<tr>
																 <td>online supplier for everything home, garden, DIY and much more! With over<b> 1,000 products available</b> - all at</td>
																</tr>
																<tr><td>
																the <b>best market prices,</b> you’re sure to find exactly what you need! </td></tr>
																<tr><td>
																hours.</td></tr>
																<tr>
																 <td>&nbsp;</td>
																</tr>
																 <tr>
																 <td>Your Details:</td>
																 </tr>
																 
																   <tr>
																 <td>&nbsp;</td>
																 </tr>
																 <tr>
																   <td colspan="2">
																	 <table width="306" >
																	  <tr>
																		<td width="298" >
																		 <b> Username:  '.$email.'</b> </td>
																	   </tr>
																	   <tr>
																		 <td align="left">
																		 <b>Password:    '.$passwd.'  </b>
																		 </td>
																	   </tr>
																 
																	  </table>
																	  </td>
																	  </tr>
																	  
																	   <tr>
																 <td>&nbsp;</td>
																 </tr>
																	 <tr>
																 <td >If you have any enquiries then please contact us at <a href="mailto:enquiries@madivers.com">enquiries@madivers.com</a>.</td>
																 </tr>  
																	  <tr>
																 <td>&nbsp;</td>
																 </tr>
																   <tr>
																 <td>Thank you for your trust, </td>
																 </tr>  
																	 <tr>
																 <td>&nbsp;</td>
																 </tr>
																 <tr>
																 <td><img src="http://www.madivers.com/images/Jane Collingham.bmp" width="111" height="30"></td>
																 </tr>
																  <tr>
																 <td><b>Jane Collingham</b></td>
																 </tr>
																  <tr>
																 <td>Customer Services Director</td>
																 </tr>
																  <tr>
																 <td ><a href="http://www.madivers.com">www.madivers.com</a></td>
																 </tr>
																   <tr>
																 <td>0845 337 3381</td>
																 </tr>
																<tr>
																 <td>&nbsp;</td>
																 </tr>
																 <tr><td >
																  Madivers.com: Low prices guaranteed – Exclusive offers and information – Permanent stock – Award winning </td></tr>
																  <tr>
																 <td>customer service </td>
																 </tr> 
																  <tr>
																 <td>&nbsp;</td>
																 </tr>
																 <tr>
																  <td height="2" background="http://www.madivers.com/images/line.gif"></td>
																 </tr> 
														</table>
														<table width="100%">
														 <tr>
														  <td colspan="2">
														   <table width="100%">
															<tr>
															  <td width="10%" class="mailfooter">Please note this email has been automatically generated and sent to <a href="mailto:'.$uemail.'" >'.$uemail.'<a> </td></tr>
															  <tr>
															  <td width="70%" class="mailfooter">You can easily change yours communication settings at anytime by visiting your account at <a href="http://www.madivers.com" >www.madivers.com</a></td></tr>
															  <tr><td class="mailfooter">
															  Madivers and the Madivers logo are registered trademarks. </td></tr>	
													</table>
														   <td width="10%"><a href="http://www.madivers.com"><img src="http://www.madivers.com/images/logo.gif" width="80" height="40" border="0" /></a></td>
													</tr>
													</table>
													</td>
													</tr>
													</table>
													</body>
													</html>';
											$MailBody ='<html>
										<head>
										<link href="http://www.madivers.com/style.css" rel="stylesheet" type="text/css">
										</head>
										<body>
										<table width="100%">
										<tr>
										  <td align="center"><table height="20">
											  <tr>
												<td></td>
											  </tr>
											</table>
											<table>
											  <tr>
												<td ><table>
													<tr>
													  <td>&nbsp;</td>
													</tr>
													<tr>
													  <td align="left"><a href="http://www.madivers.com"><img src="http://www.madivers.com/images/logo.gif" border="0"></a> </td>
													</tr>madivers
													<tr>
													  <td>&nbsp;</td>
													</tr>
													<tr>
													  <td>&nbsp;</td>
													</tr>
													<tr>
													  <td>Dear ' . $fname . ' ' . $lname . ',</td>
													</tr>
													<tr>
													  <td>&nbsp;</td>
													</tr>
													<tr>
													  <td> Congratulations, you have successfully registered and are now a valued <b>business member</b> of <a href="http://www.madivers.com">Madivers.com</a>,</td>
													</tr>
													<tr>
													  <td> the leading online supplier for everything home, garden, DIY and much more! </td>
													</tr>
													<tr>
													  <td>With over <b>1,000 products available</b> - all at the <b>best market prices,</b> you’re sure to find exactly what you need!</td>
													</tr>
													<tr>
													  <td>&nbsp;</td>
													</tr>
													<tr>
													  <td> As a registered business member you are now guaranteed<b> 2.5% discount </b> on all your future purchases with</td>
													</tr>
													<tr>
													  <td> us. In order to qualify for the maximum level of discount, we will be monitoring your spending each time you</td>
													</tr>
													<tr>
													  <td> order, and keeping you informed as to which discount bands best suit your business. Our fixed discount rates </td>
													</tr>
													<tr>
													  <td> go up to a maximum of<b> 10% OFF </b> on each order, <b>whatever you spend!</b> </td>
													</tr>
													<tr>
													  <td>&nbsp;</td>
													</tr>
													<tr>
													  <td>&nbsp;</td>
													</tr>
													<tr>
													  <td>Your Details:</td>
													</tr>
													<tr>
													  <td>&nbsp;</td>
													</tr>
													<tr>
													  <td colspan="2"><table width="306" >
														  <tr>
															<td width="298" ><b> Username:  '.$uemail.'</b> </td>
														  </tr>
														  <tr>
															<td align="left"><b>Password:   '.$pass.' </b> </td>
														  </tr>
														</table></td>
													</tr>
													<tr>
													  <td>&nbsp;</td>
													</tr>
													<tr>
													  <td >If you have any enquiries then please contact us at <a href="mailto:enquiries@madivers.com"> enquiries@madivers.com</a>.</td>
													</tr>
													<tr>
													  <td>&nbsp;</td>
													</tr>
													<tr>
													  <td ><a href="http://www.madivers.com">Madivers.com</a> - Business partners that you can rely on! </td>
													</tr>
													<tr>
													  <td>&nbsp;</td>
													</tr>
													<tr>
													  <td><img src="http://madivers.com/images/Jane Collingham.bmp" width="133" height="30"></td>
													</tr>
													<tr>
													  <td><b>Jane Collingham </b></td>
													</tr>
													<tr>
													  <td>Business Customer Services Director</td>
													</tr>
													<tr>
													  <td ><a href="http://madivers.com">www.madivers.com</a></td>
													</tr>
													<tr>
													  <td>0845 337 3381</td>
													</tr>
													<tr>
													  <td>&nbsp;</td>
													</tr>
													<tr>
													  <td> Madivers.com: Low prices guaranteed – Exclusive offers and information – Permanent stock – Award winning </td>
													</tr>
													<tr>
													  <td>customer service </td>
													</tr>
													<tr>
													  <td>&nbsp;</td>
													</tr>
													<tr>
													  <td height="2" background="http://www.madivers.com/images/line.gif"></td>
													</tr>
												  </table>
												  <table width="100%">
													<tr>
													  <td colspan="2"><table width="100%">
														  <tr>
															<td width="10%" class="mailfooter">Please note this email has been automatically generated and sent to <a href="mailto:'.$uemail.'" >'.$uemail.'.</a> </td>
														  </tr>
														  <tr>
															<td width="70%" class="mailfooter">You can easily change your communication settings at anytime by visiting your account at <a href="http://www.madivers.com">www.madivers.com</a> </td>
														  </tr>
														  <tr>
															<td class="mailfooter"> Madivers and the Madivers logo are registered trademarks. </td>
														  </tr>
														</table>
													  <td width="10%"><a href="http://www.madivers.com"><img src="http://www.madivers.com/images/logo.gif"  border="0" /></a></td>
													</tr>
												  </table></td>
											  </tr>
											</table>
										</body>
										</html>';
									break;
		default: $subject = "none";
				 $MSG_BODY = '';
				 break;
	}	//end of switch-case
	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .=	"From: ". $from ."\n";
	
	if(mail($to, $subject, $MSG_BODY, $headers))		// sending mail...
		return true;
	else
		return false;

}

?>