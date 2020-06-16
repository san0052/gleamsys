<?
//Meta Tags & Favicons
function setMetaTags($title,$description,$keywords)
{
	global $cfg , $mycms, $mycommoncms;
	$pagename	=	basename($_SERVER['PHP_SELF']);
?>
	<title><?=TITLE?> - <?=$title?> ::</title>
	<meta charset="UTF-8">
	<?
	if($pagename=='searchContent.php' || $pagename=='verify.php' || $pagename=='coming-soon.php')
	{
		?>
		<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"/>
		<?
	}
	else if($pagename=='page-content.php')
	{
		$cmsId	=	$mycommoncms->getFieldValue($_GET['cmsId']);
		if($cmsId=='11' || $cmsId=='13' || $cmsId=='12' || $cmsId=='20' || $cmsId=='24')
		{
			?>
			<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"/>
			<?
		}
	}
	?>
	<meta name="description" content="<?=$description?>">
	<meta name="keywords" content="<?=$keywords?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	
	<link rel="icon" type="image/ico" href="<?=BASE_URL?>Assets/images/fav.png"/>
<?
}

//Include Files
function pageHeader()
{
	global $cfg,$mycms;
?>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="<?=BASE_URL?>Assets/css/bootstrap.css" type="text/css">
	<link rel="stylesheet" href="<?=BASE_URL?>Assets/css/style.css" type="text/css">
	<link rel="stylesheet" href="<?=BASE_URL?>Assets/css/responsive.css" type="text/css">
	<link rel="stylesheet" href="<?=BASE_URL?>Assets/css/font-awesome.min.css" type="text/css">
	
	<script type="text/javascript" src="<?=BASE_URL?>Assets/js/jquery-1.11.3.min.js"></script>
<?
}

function feedbackSection()
{
	global $cfg,$mycms;
	
	//Send Feedback
	if($_GET['show']=='')
	{
	?>
	<script>
		function validateFeedback()
		{
			if($('#subject').val()=='')
			{
				$('#feedbackSubjectDiv').show();
				$('#subject').focus();
				$('#subject').css('border-color', 'red');
				return false;
			}
			if($('#message').val()=='')
			{
				$('#feedbackMessageDiv').show();
				$('#message').focus();
				$('#message').css('border-color', 'red');
				return false;
			}
		}
	</script>
	<div class="account_details_body">
		<form method="POST" action="<?=$cfg['section_url']?>feedback-process.php" onsubmit="return validateFeedback();">
			<input type="hidden" name="act" value="<?=md5('sendFeedback')?>" />
			<h5>Send Feedback</h5>
			<div class="fld_row">
				<label>Subject :</label>
				<div class="fld_body">
				<select name="subject" id="subject" value="" class="fld account_fld">
					<?
						$sqlSubject	=	array();
						$sqlSubject['QUERY']	=	"SELECT * 
													   FROM ".DB_FEEDBACK_SUBJECT."
													  WHERE `status`	=?";
													  
						$sqlSubject['PARAM'][] 	=	array('FILD' => 'status', 	'DATA'=>'A', 'TYP'=>'s');	
												  
						$resSubject	=	$mycms->sql_select($sqlSubject);
						foreach($resSubject as $k=>$rowSubject)
						{
						?>
							<option value="<?=$rowSubject['subject']?>"><?=$rowSubject['subject']?></option>
						<?
						}
					?>
				</select>
				<div class="placeholder_tooltip"  id="feedbackSubjectDiv">Please Enter Subject.</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="fld_row">
				<label>Message :</label>
				<div class="fld_body">
				<textarea name="message" id="message" class="fld account_fld"></textarea>
				<div class="placeholder_tooltip"  id="feedbackMessageDiv">Please Enter Message.</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<div class="btn_body">
				<input type="submit" name="" value="Submit" class="btn1 slow account_btn">
			</div>
		</form>				
	</div>
	<?
	}
	
	//Feedback List
	if($_GET['show']=='list')
	{
	?>
	<button id="" onClick="printContentSend('feedback_list_body','Borrower Feedback List','removeFieldId');"  style="float:right;"><img src="<?=BASE_URL?>Assets/images/print_icon.png"></button>
	<div class="table_list_body" id="feedback_list_body">
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr align="center" valign="middle">
			<td colspan="6" align="right" id="removeFieldId"><a href="<?=$cfg['section_url']?>my-feedback/"><b>Send Feedback</b></a></td>
			</tr>
			<tr align="center" valign="middle">
				<th width="15%">Posted On</th>
				<th width="20%">Subject</th>
				<th width="35%">Message</th>
				<th width="10%">Comment(s)</th>
				<th width="10%">Status</th>
				<th width="10%" id="removeFieldId">Action</th>
			</tr>
			<?
			$i	=	0;
			$sqlFeedback	=	array();			
			$sqlFeedback['QUERY']	=	"SELECT * 
										   FROM ".DB_FEEDBACK."
										  WHERE `userId`	=	?
										    AND `userType`	=	?";
												
			$sqlFeedback['PARAM'][] 	=	array('FILD' => 'userId', 		'DATA'=>$_SESSION['userId'], 	'TYP'=>'s');
			$sqlFeedback['PARAM'][] 	=	array('FILD' => 'userType', 	'DATA'=>$_SESSION['userType'], 	'TYP'=>'s');
												
			$resFeedback	=	$mycms->sql_select($sqlFeedback);
			$numFeedback	=	$mycms->sql_numrows($resFeedback);
			if($numFeedback>0)
			{
				foreach($resFeedback as $k=>$rowFeedback)
				{
					$i++;
					$sqlComments			=	array();	
					$sqlComments['QUERY']	=	"SELECT `id` 
												   FROM ".DB_FEEDBACK_REPLY."
												  WHERE `feedbackId`	=	?";
												  
					$sqlComments['PARAM'][] =	array('FILD' => 'feedbackId', 		'DATA'=>$rowFeedback['id'], 	'TYP'=>'s');
												  
					$resComments	=	$mycms->sql_select($sqlComments);
					$numComments	=	$mycms->sql_numrows($resComments);
			?>
			<tr class="<?=($i%2==0)?'row1':''?>" align="center" valign="middle">
				<td align="left"><?=formatDate($rowFeedback['createdDate'])?></td>
				<td align="left"><?=$rowFeedback['subject']?></td>
				<td align="right"><?=substr($rowFeedback['message'],0,100)?>..</td>
				<td><?=$numComments?></td>
				<td><?=($rowFeedback['status']=='A')?'Read':'Unread'?></td>
				<td class="last" id="removeFiledId">
					<input type="button" name="" value="View Details" class="btn1 slow approved_btn" onclick="window.location.href='<?=$cfg['section_url']?>my-feedback/details/<?=$mycommoncms->encoded($rowFeedback['id'])?>';">							
				</td>
			</tr>
			<?	}
			}
			else
			{
			?>
			<tr align="center" valign="middle" class="row1">
				<td colspan="6" class="last">
					No Feedback(s)
				</td>
			</tr>
			<?	
			}
			?>
		</table>			
	</div>
	<?
	}

	//Feedback Details
	if($_GET['show']=='details')
	{
		$id				=	$mycommoncms->decoded($_GET['id']);
		$sqlFeedback	=	array();
		$sqlFeedback['QUERY']	=	"SELECT * 
									   FROM ".DB_FEEDBACK."
									  WHERE `userId`	=	?
										AND `userType`	=	?
										AND `id`		=	?";
										
		$sqlFeedback['PARAM'][] =	array('FILD' => 'userId', 		'DATA'=>$_SESSION['userId'], 	'TYP'=>'s');
		$sqlFeedback['PARAM'][] =	array('FILD' => 'userType', 	'DATA'=>$_SESSION['userType'], 	'TYP'=>'s');
		$sqlFeedback['PARAM'][] =	array('FILD' => 'id', 			'DATA'=>$id, 					'TYP'=>'s');
										
		$resFeedback	=	$mycms->sql_select($sqlFeedback);
		$numFeedback	=	$mycms->sql_numrows($resFeedback);
		if($numFeedback>0)
		{
			$rowFeedback=$resFeedback[0];
	?>
	<button id="" onClick="printContentSend('feedback_details_body','Borrower Feedback List','removeFieldId');"  style="float:right;"><img src="<?=BASE_URL?>images/print_icon.png"></button>
	<div class="account_details_body" id="feedback_details_body">
		<h5>Feedback Details</h5>
			
		<div class="loan_full_details_body">
			<div class="loan_name">
				<?=$rowFeedback['subject']?>
			</div>
			<p><?=nl2br($rowFeedback['message'])?></p>	
			
			<div class="contributr">
				Posted On :
				<span class="total"><?=formatDate($rowFeedback['createdDate'])?></span><br/>				
				IP Address :
				<span class="total"><?=$rowFeedback['createdIP']?></span>							
			</div>	
			
			
			<div class="feedback_reply_body">
				<div class="feedback_list">
					<ul>
						<?
						$sqlComments			=	array();	
						$sqlComments['QUERY']	=	"SELECT `id` 
													   FROM ".DB_FEEDBACK_REPLY."
													  WHERE `feedbackId`	=	?";
													  
						$sqlComments['PARAM'][] =	array('FILD' => 'feedbackId', 		'DATA'=>$rowFeedback['id'], 	'TYP'=>'s');
													  
						$resComments	=	$mycms->sql_select($sqlComments);
						$numComments	=	$mycms->sql_numrows($resComments);
						if($numComments>0)
						{
							foreach($resComments as $k=>$rowComments)
							{
								if($rowComments['postedByType']!='Admin')
									$user	=	getFieldsFromTable($rowComments['postedBy'],'name',DB_USER,'id');
								else
									$user	=	'Admin';
								
						?>
						<li class="<?=($rowComments['postedByType']!='Admin')?'send_feedback':'received_feedback'?>">
							<div class="name"><?=$user?></div>
							<div class="txt"><?=nl2br($rowComments['reply'])?></div>
							<div class="date">Posted On : <?=date('M j, Y h:i A',strtotime($rowComments['postedDate']))?></div>
						</li>
						<?	}
						}
						?>
					</ul>
				</div>
				
				<div class="send_feedback_body" id="removeFieldId">
					<form action="<?=$cfg['section_url']?>feedback-process.php" name="feedbackFrm" method="POST" onsubmit="return validateReply();">
						<input type="hidden" name="feedbackId" value="<?=$_GET['id']?>">
						<input type="hidden" name="act" value="<?=md5('PostReply')?>" />
						<h5>Post Reply</h5>
						<div class="fld_row">
							<label>Message :</label>
							<div class="fld_body">
								<textarea name="message" id="message" class="fld account_fld"></textarea>
								<div class="placeholder_tooltip"  id="feedbackReplyMessageDiv">Please Enter Message.</div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
						<div class="btn_body" id="removeFieldId">
							<input type="submit" name="" value="Submit" class="btn1 slow account_btn">
						</div>
					</form>				
				</div>
				<script>
				function validateReply()
				{
					if($('#message').val()=='')
					{
						//alert('Please write your reply');
						$('#feedbackReplyMessageDiv').show();
						$('#message').css('border-color', 'red');
						$('#message').focus();
						return false;
					}
				}
				</script>
				
			</div>
		</div>
	</div>
	<?	}
	}
}
?>