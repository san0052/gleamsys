<div class="clear"></div>
<a name="message"></a>
<div style=" height:6px;"></div>
<div class="heading">Contact Us</div>
<div class="clear"></div>
<div class="prod_div_new_2">
<center><? if($_REQUEST['m']=='sent'){ ?> <span style="color:#ae6c78; font-size:11px;"><strong>Your comments/query/suggesion is sucessfully submitted.</strong></span><? } ?></center><br>
<form name="contacts" id="contacts" method="post" action="contact-us-process.php" onSubmit="return valid_contact();">
<div class="text">Type of Query : </div>

<select name="contact_type" class="input_area" id="contact_type">
  <option>Support</option>
  <option>Security</option>
  <option>Sales</option>
  <option>Feedback</option>
  <option>Entertainment</option>
  <option>Copyrights</option>
</select>
<div class="clear"></div>

<div class="text">Full Name <font color="#FF0000">*</font> : </div>
<input type="text" class="input_area" name="contact_name" id="contact_name" onKeyUp="check_name(this.value);" onBlur="check_name(this.value);" /><span class="contact-err-msg" id="name-span">&nbsp;<img align="absmiddle" src="images/12-em-cross.png">&nbsp;Please Enter Name</span>

<div class="clear"></div>

<div class="text">Telephone Number : </div>
<input type="text" class="input_area" name="contact_ph" id="contact_ph"  onKeyUp="check_ph(this.value);" onBlur="check_ph(this.value);"/><span class="contact-err-msg" id="ph-span">&nbsp;<img align="absmiddle" src="images/12-em-cross.png">&nbsp;Enter No</span><span class="contact-err-msg" id="ph-no-span">&nbsp;<img align="absmiddle" src="images/12-em-cross.png">&nbsp;No Should be Numeric</span>

<div class="clear"></div>

<div class="text">Email Address <font color="#FF0000">*</font> : </div>
<input type="text" class="input_area" name="contact_email" id="contact_email" onKeyUp="check_email(this.value);" onBlur="check_email(this.value);" /><span class="contact-err-msg" id="email-span">&nbsp;<img align="absmiddle" src="images/12-em-cross.png">&nbsp;Enter Email</span><span class="contact-err-msg" id="email-no-span">&nbsp;<img align="absmiddle" src="images/12-em-cross.png">&nbsp;Enter Valid Email</span>

<div class="clear"></div>

<div class="text">Subject <font color="#FF0000">*</font> : </div>
<input type="text" class="input_area" name="contact_sub" id="contact_sub" onKeyUp="check_subject(this.value);" onBlur="check_subject(this.value);" /><span class="contact-err-msg" id="subject-span">&nbsp;<img align="absmiddle" src="images/12-em-cross.png">&nbsp;Enter Subject</span>

<div class="clear"></div>

<div class="text">Comments/Queries/ Suggesions <font color="#FF0000">*</font> : </div>
<textarea class="comment_box" cols="45" rows="5" name="contact_comment" id="contact_comment" onKeyUp="check_comment(this.value);" onBlur="check_comment(this.value);"></textarea><span class="contact-err-msg" id="comment-span">&nbsp;<img align="absmiddle" src="images/12-em-cross.png">&nbsp;Enter Comment</span>

<div class="clear"></div>

<input type="image" value="submit" src="images/submit.png"  class="submit"/>
</form>


</div>
<div class="lower_part_new"></div>