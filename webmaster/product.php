<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
//include('../includes/template.php');

if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
if($_REQUEST['m']==3) { $msg='Record Deleted';}
if($_REQUEST['m']==4) { $msg='Order Updated';}
if($_REQUEST['m']==9) { $msg='Content should not be blank';}

page_header($cfg['ADMIN_TITLE']." - Product Management");
$category=($_REQUEST['category']!="")?$_REQUEST['category']:'';
$pageno =($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0';
$show=$_REQUEST['show'];
?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts/common.js"></script>
<script language="javascript" src="scripts/product.js"></script>
<script language="javascript" src="scripts/ajax.js"></script>
<script language="javascript" src="scripts/ajax1.js"></script>

<script language="javascript" type="text/javascript">

</script>
<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/ddaccordion.js"></script>
<style type="text/css">

	.style3 {
		color: #FFFFFF
	}
	
</style>
<td vAlign=top align="center" width="99%"><!-- Start Body Here -->
	<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
		<tr height="34">
			<td width="25%" rowspan="2" colspan="3" align="center" valign="top"><br />
				<br />
				<?php include_once("left_bar.php");?></td>
			</tr>
			<tr>
				<td align="center" valign="middle"><img src="images/spacer.gif" width="1" height="550" /></td>
				<td align="left" valign="top" width="99%">      
					<table width="698" align="center" border="0" cellspacing="0" cellpadding="0" style="background:url(images/welcome_head.jpg) center top no-repeat;">
						<tr height="35" >
							<td align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome
								<?=$_SESSION['admin_user_name']?>
							</span>               
						</td>
						<td align="right" valign="middle" class="style5">
							<?
							$sql="SELECT * FROM ".$cfg['DB_SITE']."";
							$res=$heart->sql_query($sql);				
							?>
							<select name="" id="" onchange="getSes1(this.value);" class="forminputelement">
								<? while($row=$heart->sql_fetchrow($res)){?>
									<option value="<?=$row['s_id']?>" <? if($cfg['SESSION_SITE']==$row['s_id']){?> selected="selected"<? }?>>
										<?=$row['s_name']?>
									</option>
								<? }?>
							</select>
							&nbsp;&nbsp;&nbsp;
							<a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" height="24" width="24" border="0" style="vertical-align: middle;" /></a>&nbsp;&nbsp;
						</td>

					</tr>
					<tr height="16">
						<td colspan="2" align="left" valign="middle" style="background-color:#eee8e8;">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2" style="background-color:#eee8e8;" align="center">
			<? //show all record
			if($_REQUEST['show']==''){
				?>
				<table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
					<thead>
						<tr>
							<td colspan="4" align="left">&nbsp;<span class="style2">Product Section</span>&nbsp;</td>
							<td colspan="9" align="right">
								<form name="frmsearch" id="frmsearch" action="product.php" method="post">
									<input type="hidden" name="category" id="category" value="<?=$_REQUEST['category']?>" />
									<input type="hidden" name="searchname" id="searchname" value="search" />
									<input type="text" name="search_val" id="search_val" class="forminputelement" value="<?=$_REQUEST['search_val']?>" />
									&nbsp;
									<input type="submit" name="prodsearch"  class="loginbttn" value="Go" />
									&nbsp;
									<? if($_REQUEST['main']=='')
									{ ?>
										<select name="status" class="forminputelement" id="status" onchange="getsec_category5(this.value);">
											<option value="0" <?=($_REQUEST['category']=='' || $_REQUEST['category']=='all' )?'selected="selected"':''?> onclick="window.location.href='product.php?category='">Select Parent Categories</option>
											<?php 
											$sql1="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_parent_id`=0 AND `siteId`= '".$cfg['SESSION_SITE']."' ORDER BY `name`";
											$res1=$heart->sql_query($sql1);
											while($row1=$heart->sql_fetchrow($res1))
											{
											//Parent Category
												?>
												<option value="<?=$row1['id']?>" <?=(getcatid(getcatid($_REQUEST['category']))==$row1['id'])?'selected="selected"':''?>>
													<?=ucfirst($row1['name'])?>
												</option>
											<?php } ?>
										</select>
										&nbsp;
										<div id="sec_parent" style="display:inline;">
											<? 
											if($_REQUEST['category']!=""){
												$sql_cat="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_parent_id`='".getcatid(getcatid($_REQUEST['category']))."' AND `status` ='A' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
												$res_cat=$heart->sql_query($sql_cat);
												$maxrow=$heart->sql_numrows($res_cat);

			
												?>
												<select name="secpid" class="forminputelement" id="secpid" onchange="get_product(this.value);">
													<option value="0" selected="selected">Select Category</option>
													<? 

													if($maxrow >0)
													{
														while($row_cat=$heart->sql_fetchrow($res_cat)){
															$sql_cat1="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `cat_parent_id`='".$row_cat['id']."' AND `status` ='A' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
															$res_cat1=$heart->sql_query($sql_cat1);
															$maxrow_1=$heart->sql_numrows($res_cat1);
															if($maxrow_1 >0){ ?>
																<option value="<?=$row_cat['id']?>" style="font-weight:bold;"><?=$row_cat['name']?></option>
																<?
																while($row_cat1=$heart->sql_fetchrow($res_cat1)){
																	?>
																	<option value="<?=$row_cat1['id']?>" <? if($_REQUEST['category']==$row_cat1['id']){?> selected="selected" <? } ?> >
																		<?=$row_cat1['name']?>
																	</option>
																<? }?>

															<? } } }  } ?>
														</select>
													</div>
												<? } ?>
											</form></td>
										</tr>
									</thead>
									<form name="frm1" id="frm1" action="product_process.php" method="post">
										<input type="hidden" name="act" id="act" value="order" />
										<input type="hidden" name="cat_returnid" id="cat_returnid" value="<?=$_REQUEST['category']?>" />
										<? $pageno=($_REQUEST['pageno']!='')?$_REQUEST['pageno']:'0'; ?>
										<input type="hidden" name="pageno" id="pageno" value="<?=$pageno?>" />
										<tbody>
											<? if($_REQUEST['m']){ ?>
												<tr class="row1">
													<td colspan="17" align="right" class="redbuttonelements"><?=@$msg?></td>
												</tr>
											<? } ?>
											<tr class="headercontent">
												<td width="5%" align="center" class="leftBarText_new1">
													<input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall();"/></td>
													<td width="8%" align="center" class="leftBarText_new1">Sl No </td>
													<td width="8%" align="center" class="leftBarText_new1">Db Id </td>
													<td align="left" class="leftBarText_new1" colspan="2">Product Name [#ID]</td>
													<td align="center" class="leftBarText_new1" colspan="3">Product Image</td>
													<td width="13%" align="center" class="leftBarText_new1">Order &nbsp;
														<input type="image" src="images/1308660287_order.png"  name="save" value="Save" title="Save" align="absmiddle" />
													</td>
													<td width="10%" align="center" class="leftBarText_new1">Price</td>
													<td width="10%" align="center" class="leftBarText_new1">Earliest Delivery</td>
													<td width="9%" align="center" class="leftBarText_new1">Status</td>
													<td width="14%" align="center" class="leftBarText_new1">Action</td>
												</tr>
												<?  if($_REQUEST['category']!='')
												{
													$search_query="AND `category`=".$_REQUEST['category']."";
												}
												else
												{

													$search_query='';

												}
												if(isset($_REQUEST['prodsearch']))
												{
													if($_REQUEST['searchname']=='search')
													{
														$sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE  (`pd_name` LIKE '%".$_REQUEST['search_val']."%' OR `location` LIKE '%".$_REQUEST['search_val']."%' OR `pd_code` LIKE '%".$_REQUEST['search_val']."%')  AND `siteId`= '".$cfg['SESSION_SITE']."' ".$search_query;
													}
												}
												else
												{
													if($_REQUEST['main']!='')
													{
														$sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `siteId`= '".$cfg['SESSION_SITE']."' AND `mainaddon` =".$_REQUEST['main']."";
													}

													else
													{ 

														if($_REQUEST['category']=='' || $_REQUEST['category']=='0')
														{
															$sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `mainaddon` ='0' AND `isAddon`='N' AND `siteId`= '".$cfg['SESSION_SITE']."' ORDER BY `order` ASC";
														}
														if($_REQUEST['category']=='all' || $_REQUEST['location']=='all' || $_REQUEST['occasion']=='all' || $_REQUEST['color']=='all')
														{
															$sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `mainaddon` ='0' AND `siteId`= '".$cfg['SESSION_SITE']."' ORDER BY `order` ASC";
														}
														if($_REQUEST['category']!='' && $_REQUEST['category']!='all')
														{

						//echo
					//	 $sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `pd_id` IN( CASE ".getProductId($_REQUEST['category'])." WHEN '' THEN 0 ELSE '".getProductId($_REQUEST['category'])."' END ) AND `mainaddon` ='0' AND `siteId`= '".$cfg['SESSION_SITE']."' ORDER BY `order` ASC";


						 //echo
															$sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `pd_id` IN(".getProductId($_REQUEST['category']).") AND `mainaddon` ='0' AND `siteId`= '".$cfg['SESSION_SITE']."' ORDER BY `order` ASC";
														}

													}
												}
												$res=$heart->sql_query($sql);
												$maxrow=$heart->sql_numrows($res);
												if(!isset($_REQUEST['prodsearch']))
												{
													$sql = $sql. " LIMIT $offset,$limit";
													$res = $heart->sql_query($sql);
												}
												if($maxrow >0)
												{
													while($row=$heart->sql_fetchrow($res)){
														@$i++;

														$sqlTime = "SELECT * FROM ".$cfg['DB_EARLIEST_DELIVERYBY']."
														WHERE `id` = '".$row['earliest_deliveryId']."' ";
														$resTime=$heart->sql_query($sqlTime);
 		
														?>
														<tr class="<?=($i%2==0)?'row1':'row2'?>">
															<td align="center" valign="top"><input  name="checkvalue" id="checkvalue"  value="<?=$row['pd_id']?>" type="checkbox" /></td>
															<td align="center" valign="top"><?=$i+$offset?></td>
															<td align="center" valign="top"><?=$row['pd_id']?></td>
															<td colspan="2" align="left" valign="top" >&nbsp;
																<?=$row['pd_name']?>&nbsp;&nbsp;[#<?=$row['pd_id']?>
															]</td>
															<td colspan="3" align="center" valign="top" ><img src="../<?=$cfg['PRODUCT_IMAGES'].$row['pd_image']?>"  width="70" align="top"/></td>
															<td align="center" valign="top" class="leftBarText"><input name="catorder[<?=$row['pd_id'];?>]" type="text" class="forminputelement" id="catorder[<?=$row['pd_id'];?>]"  size="2" value="<?=$row['order'];?>" style="text-align:center;"/></td>
															<td align="center" valign="top"><?=$row['pd_price']?></td>
													
															<?
															while($rowTime=$heart->sql_fetchrow($resTime))
															{
																?>
																<td align="center" valign="top"><?=$rowTime['name']?></td>
																<?
															}
															?>

															<td align="center" valign="top">&nbsp;<a href="product_process.php?act=<?=($row['status']=='A')?'Inactive':'Active'?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['pd_id']?>" class="<?=($row['status']=='A')?'greenbuttonelementsNew':'redbuttonelementsNew'?>">
																<?=($row['status']=='A')?'Active':'Inactive'?>
															</a></td>
															<td align="center" valign="top"><? if($row['mainaddon']!=0){ ?>
																<a href="product.php?show=view_addon&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['pd_id']?>"><img src="images/view.gif" title="View" width="16" height="16" border="0" /></a>
															<? }else{?>
																<a href="product.php?show=view&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['pd_id']?>"><img src="images/view.gif" title="View" width="16" height="16" border="0" /></a>
															<? }?>
															<? if($row['mainaddon']!=0){ ?>
																<a href="product.php?show=edit_addon&id=<?=$row['pd_id']?>&pageno=<?=$pageno?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a>
															<? } else {?>
																<a href="product.php?show=edit&id=<?=$row['pd_id']?>&pageno=<?=$pageno?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0" /></a>
															<? }?>
															<a href="product_process.php?act=del&category=<?=$category?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&id=<?=$row['pd_id']?>"><img src="images/drop.gif" title="Delete" width="16" height="16" border="0" onClick="return confirm('Do you really want to delete this record');" /></a><br />
															<? if(addonval($row['pd_id'])!=0){ ?>
																<br />
																<a href="product.php?main=<?=$row['pd_id']?>&page=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>&category=<?=$_REQUEST['category']?>">Add-On</a>
																<? } ?></td>
															</tr>
														<? }
													} 
													else 
														{?>
															<tr class="row1">
																<td colspan="17" align="center" class="msg">No Record.</td>
															</tr>
														<? } ?>
														<tr >
															<td colspan="17" align="left" class="redbuttonelements"><? if($_REQUEST['main']!='')
															{
																?>
																<a style="color:#FFFFFF;" href="product.php?category=<?=$_REQUEST['category']?>&pageno=<?=$_REQUEST['page']?>" class="back">&lt;&lt;back</a>
															<? } ?>
															&nbsp;
															<?  if($maxrow >0){ ?>
																<select name="dropdown1" class="forminputelement">
																	<option value="">Choose an action... </option>
																	<option value="delete">Delete</option>
																	<option value="Active">Active</option>
																	<option value="Inactive">Inactive</option>
																</select>
																<input value="Apply to selected"  name="submit" type="button" onclick="return validation1('<?=$category?>','<?=$pageno?>');" class="loginbttn"/>
															<? } ?>
															<td colspan="1" align="right" class="redbuttonelements"></td>
														</tr>
													</tbody>
												</form>
											</table>
											<div class="bottomsecc">
												<div class="pagisecc">
													<? if(!isset($_REQUEST['prodsearch'])){ ?>
														<?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?>
													<? } ?>

													<? if($_REQUEST['main']=='')
													{ ?>
														<div class="clearfix"></div>
													</div>
													<a class="brownbttn" href="product.php?show=add&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>">Add New Product</a>
												<? } ?>

												<div class="clearfix"></div>
											</div>
										<? }



		// add new customer



										/* Stary Brand */


										if($show=='add') { ?>
											<script type="text/javascript">	
												function check_key(){					
													var ids=0;					
													var ck=0;					
													$.each($('input:checkbox[target=catkey]'),function(){						
														if($(this).is(':checked')){							
															ck++;							
															id=$(this).val();								
															if(ck>0){									
																if(ck==1){										
																	str1=id;									
																	ids=str1;									
																}else{										
																	str1=','+id;									   
																	ids=ids+str1;									
																}																	
															}															
														}												
													});					
													/*alert(ids);*/					
													dataquery='act=catkeylist&catid='+ids;					
													console.log('product_process.php?'+dataquery);					
													$.ajax({						
														type:'POST',						
														url:'product_process.php',						
														data:dataquery,						
														async:false,						
														success:function(msg){									
															$('input:checkbox[target=key]').attr('checked', false);									
															$keylist=msg.split(',');									 
															$.each($keylist, function() {            							
																$('#key_id_'+this).attr('checked', true);        							
															});															
														}													
													});										
												}		
											</script>
											<form name="frmadd" method="post" action="product_process.php" id="frmadd" enctype="multipart/form-data" onsubmit="return product_add(this)">
												<p>
													<input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
													<input type="hidden" name="act" value="insert" />
													<input type="hidden" name="prod_add_valid" value=""  id="prod_add_valid"/>
													<input type="hidden" name="type_check" value=""  id="type_check"/>
												</p>
												<table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
													<thead>
														<tr>
															<td colspan="5" align="left" class="style2">&nbsp;Add Product Section </td>
														</tr>
													</thead>
													<tbody>
														<? if($_REQUEST['m']){ ?>
															<tr class="row2">
																<td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
															</tr>
														<? } ?>


														<tr class="row1">
															<td colspan="6" align="left" valign="top"><span class="leftBarText_new"> Category</span> <span class="redstar">*</span></td>
														</tr>
														<? 
														$sql="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `status`='A' AND `cat_parent_id`=0 ORDER BY `order` ASC ";
														$res=$heart->sql_query($sql);
														while($row=$heart->sql_fetchrow($res))
														{

															if($row['id']!='202'){
																?>
																<tr class="row2">
																	<td colspan="3" align="left" valign="top"><span class="leftBarText_new"><?=$row['name'];?></span> <span class="redstar">*</span> 
																		<? if($row['id']=='225'){?>
																			<input name="check_all1" id="check_all1" class="check-all" type="checkbox" onclick="checkall_MidnightDelivery(this);"/>

																			<?	}?></td>
																		</tr>

																		<tr class="row2">

																			<?
																			$n = 0;

																			$sqlcat="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `status`='A' AND `cat_parent_id`=".$row['id']." ORDER BY `name` ASC ";
																			$rescat=$heart->sql_query($sqlcat);
																			$numrows=$heart->sql_numrows($rescat);
																			while($rowcat=$heart->sql_fetchrow($rescat))
																			{
																				$n++;


																				?>
																				<td align="left" valign="top">
																					<input type="checkbox" name="cate_id[]"  id="cate_id_<?=$rowcat['id']?>" value="<?=$rowcat['id']?>"  />
																					<? 
																					if($rowcat['cat_parent_id']=='225'){
																						?>
																						<script language="javascript" type="text/javascript">
																							collectMidnightDeliveryObs(document.getElementById('cate_id_<?=$rowcat['id']?>'));
																						</script>
																						<?
																					}
																					?>
																					<?=stripslashes($rowcat['name'])?>
																				</td>
																				<? if($n%3==0 && $n>0)
																				{
																					echo '</tr>'.(($n<$numrows)?'<tr class="row2">':'');
																				}

																			}

																			if($n%3>0)
																			{
																				?>
																				<td colspan="<?=($n%3)+1 ?>">&nbsp;</td>
																				<?
																			} 

																		}//if	

																	}
																	?>

																</tr>


																<tr class="row1">
																	<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> <span class="redstar">*</span></td>
																	<td width="70%" colspan="4" align="left"><table>
																		<tr>
																			<td><input name="prod_pname_add" type="text" class="forminputelement" id="prod_pname_add"  value="" />
																			&nbsp;&nbsp;&nbsp; </td>
																			<td><input type="checkbox" name="fp" id="fp" value="1" />
																				&nbsp;<span class="leftBarText_new">Featured Product</span> </td>
																		</tr>
																		<tr>
																			<td>&nbsp;</td>
																			<td><input type="checkbox" name="today_Spcial_product" id="today_Sp" value="1" />
																				&nbsp;<span class="leftBarText_new">To-Day Spcial Product</span> </td>
																		</tr>
																		<tr>
																			<td>&nbsp;</td>
																			<td><input type="checkbox" name="new_arrival_pro" id="new_arrival_pro" value="1" />
																				&nbsp;<span class="leftBarText_new">New Arrival</span> </td>
																		</tr>
																			<!-- <tr>
																				<td>&nbsp;</td>
																				<td><?// if(countRightbar() < 8){?>
																					<input type="checkbox" name="rp" id="rp" value="1" />
																					&nbsp;<span class="leftBarText_new">Show in rightbar</span>
																					<?// }?></td>
																				</tr> -->

																				<tr>
																					<td>&nbsp;</td>
																					<td><input type="checkbox" name="bp" id="bp" value="1" />
																						&nbsp;<span class="leftBarText_new">Best Seller</span></td>
																				</tr>
																				</table></td>
																			</tr>
																			<tr class="row2">
																				<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> <span class="redstar">*</span></td>
																				<td width="70%" colspan="4" align="left"><input name="prod_price_add" type="text" class="forminputelement" id="prod_price_add" value=""/></td>
																			</tr>
																			<!-- <tr class="row1">
																				<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Unit Price</span> <span class="redstar" style="font-size: 9px;">*Fill Up This In Case The Product Is Cake</span></td>
																				<td width="70%" colspan="4" align="left"><input name="prod_unit_price_add" type="text" class="forminputelement" id="prod_unit_price_add" value=""/></td>
																			</tr> -->
																			<!-- <tr class="row1">
																				<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Cost of Double Flowers</span> <span class="redstar" style="font-size: 9px;">*Fill Up This In Case The Product Is Flower</span></td>
																				<td width="70%" colspan="4" align="left"><input name="prod_double_flower_price" type="text" class="forminputelement" id="prod_double_flower_price" value=""/></td>
																			</tr> -->
																			<tr class="row2">
																				<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Strik Through Price</span> </td>
																				<td width="70%" colspan="4" align="left"><input name="sprod_price_add" type="text" class="forminputelement" id="sprod_price_add" value=""/></td>
																			</tr>
																			<tr class="row1">
																				<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Discount</span> </td>
																				<td width="70%" colspan="4" align="left"><input name="discount" type="text" class="forminputelement" id="discount" value=""/></td>
																			</tr>
																			<!-- <tr class="row2">
																				<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Disclaimer</span> <span class="redstar">*</span></td>
																				<td width="70%" colspan="4" align="left"><select name="prod_dis" id="prod_dis" class="forminputelement" >
																					<option value="0" >Select Disclaimer</option>
																					<?
																					/*$sqlloc2="SELECT * FROM ".$cfg['DB_DISCLAIMER']." WHERE  `status`='A' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
																					$resloc2=$heart->sql_query($sqlloc2);
																					while($rowloc2=$heart->sql_fetchrow($resloc2))
																						{ */ ?>
																							<option value=<?//=$rowloc2['d_id']?> >
																								<?//=stripslashes($rowloc2['title'])?>
																							</option>
																						<? //} ?>
																					</select>
																				</td>
																			</tr> -->
																			<!-- <tr class="row2">
																				<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Notes</span> <span class="redstar">*</span></td>
																				<td width="70%" colspan="4" align="left">
																					<select name="prod_note" id="prod_note" class="forminputelement" >
																						<option value="0" >Select Notes</option>
																						<?
																						/*$sqlloc1="SELECT * FROM ".$cfg['DB_NOTES']." WHERE  `status`='A' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
																						$resloc1=$heart->sql_query($sqlloc1);
																						while($rowloc1=$heart->sql_fetchrow($resloc1))
																							{ */ ?>
																								<option value=<?//=$rowloc1['n_id']?> >
																									<?//=stripslashes($rowloc1['title'])?>
																								</option>
																							<?// } ?>
																						</select>
																					</td>
																			</tr> -->
																			<tr class="row1">
																					<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Location</span> <span class="redstar">*</span></td>
																					<td width="70%" colspan="4" align="left"><select name="prod_loc" id="prod_loc" class="forminputelement">
																						<option value="">Select Location</option>
																						<?
																						$sqlloc="SELECT * FROM ".$cfg['DB_CITY']." WHERE  `parent_id`='0'  ";
																						$resloc=$heart->sql_query($sqlloc);
																						while($rowloc=$heart->sql_fetchrow($resloc))
																							{  ?>
																								<option value=<?=$rowloc['id']?> >
																									<?=stripslashes($rowloc['name'])?>
																								</option>
																							<? } ?>
																						</select>
																					</td>
																				</tr>
																				<tr class="row2">
																					<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> <span class="redstar">*</span></td>
																					<td width="70%" colspan="4" align="left"><input name="prod_code" type="text" class="forminputelement" id="prod_code" value=""/></td>
																				</tr>
																				<tr class="row2">
																					<td  align="left" class="leftBarText"><span class="leftBarText_new">Description</span></td>
																					<td  width="70%" colspan="4" align="left"><textarea name="prod_desc_add" ></textarea></td>
																				</tr>
																				<tr class="row1">
																					<td  align="left" class="leftBarText"><span class="leftBarText_new">Delivery Information</span><span class="redstar"> Fill This In Case Of Special Product</span></td>
																					<td  width="70%" colspan="4" align="left"><textarea name="prod_del_info" ></textarea></td>
																				</tr>
																				<tr class="row2">
																					<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Image </span> <span class="redstar">*</span> </td>
																					<td width="70%" colspan="4" align="left"><input name="image_add" id="image_add" type="file" class="forminputelement"/></td>
																				</tr>
																				<tr class="row2">
																					<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Image 2</span> </td>
																					<td width="70%" colspan="4" align="left"><input name="image_add2" id="image_add2" type="file" class="forminputelement"/></td>
																				</tr>
																				<tr class="row2">
																					<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Image 3 </span> <span class="redstar"></td>
																					<td width="70%" colspan="4" align="left"><input name="image_add3" id="image_add3" type="file" class="forminputelement"/></td>
																				</tr>
																				

																			<!-- 	<tr class="row1"><td colspan="6" align="left" valign="top"><span class="leftBarText_new">Keywords Category List</span></td></tr> -->
																				<!-- <tr class="row2">
																					<?
																					/*$n = 0;	$sqlcatkey="SELECT * FROM ".$cfg['DB_KEYWORD_CATEGORY']." WHERE `status`='A'";	
																					$rescatkey=$heart->sql_query($sqlcatkey);												
																					$numrowskey=$heart->sql_numrows($rescatkey);								                
																					while($rowcatkey=$heart->sql_fetchrow($rescatkey))												
																						{*/ //$n++;																															?>						<td align="left" valign="top">								
																						<input type="checkbox" name="catkey_id[]" target='catkey'  id="catkey_id_<?//=$rowcatkey['id']?>" value="<?//=$rowcatkey['id']?>" onclick="check_key()"  />											<?//=stripslashes($rowcatkey['name'])?>											</td>											<?// if($n%3==0 && $n>0)												{													echo '</tr>'.(($n<$numrowskey)?'<tr class="row2">':'');												}																						}																					if($n%3>0)											{										 ?>											 <td colspan="<?//=($n%3)+1 ?>">&nbsp;</td>										<?											//} 																			?>                    </tr>
																					<tr class="row1">
                      <td colspan="5" align="left" class="leftBarText"><span class="leftBarText_new">Add on Product</span>
                     	<input type="checkbox" name="addon" id="addon" value="yes" onclick="addopen();" /></td>-->

                     	<!--<td colspan="6" align="left" valign="top"><span class="leftBarText_new">Keywords <input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall_add();"/>(Select All)</span></td>
                     </tr> -->

                     <!-- <tr class="row2">
                     	<td colspan="3" align="left" valign="top">
                     		<input class="brownbttn" type="button" name="create key" id="create key" value="generate key" onclick="create_key()" />
                     	</td>
                     </tr> -->	
<!-- 
                     <tr class="row2">

                     	<?
                     	/*$n = 0;

                     	$sqlcat="SELECT * FROM ".$cfg['DB_KEYWORD']." WHERE `status`='A'";
                     	$rescat=$heart->sql_query($sqlcat);
                     	$numrows=$heart->sql_numrows($rescat);
                     	while($rowcat=$heart->sql_fetchrow($rescat))
                     	{
                     		$n++;*/


                     		?>
                     		<td align="left" valign="top">
                     			<input type="checkbox" name="key_id[]"  id="key_id_<?//=$rowcat['id']?>" target="key" value="<?//=$rowcat['id']?>"  />
                     			<?//=stripslashes($rowcat['key_name'])?>
                     		</td>
                     		<? /*if($n%3==0 && $n>0)
                     		{
                     			echo '</tr>'.(($n<$numrows)?'<tr class="row2">':'');
                     		}

                     	}

                     	if($n%3>0)
                     	{*/
                     		?>
                     		<td colspan="<?//=($n%3)+1 ?>">&nbsp;</td>
                     		<?
                     	//} 

                     	?>

                     </tr> -->
                  <!--<td colspan="5" align="left" class="leftBarText"><div id="addon_prod" style="display:none;">
                        <div id="newlink" style="margin:-7px;">
                          <table width="100%" align="center" cellpadding="6" cellspacing="1" class="tborder_new" border="0">
                            <tr class="row2">
                              <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> <span class="style3">*</span></td>
                              <td width="70%" colspan="4" align="left"><input name="prod_pcode_addon[]" type="text" class="forminputelement" id="prod_pcode_addon[]"  value="" /></td>
                            </tr>
                            <tr class="row1">
                              <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> <span class="style3">*</span></td>
                              <td width="70%" colspan="4" align="left"><input name="prod_pname_addon[]" type="text" class="forminputelement" id="prod_pname_addon[]"  value="" /></td>
                            </tr>
                            <tr class="row2">
                              <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> <span class="style3">*</span></td>
                              <td width="70%" colspan="4" align="left"><input name="prod_price_addon[]" type="text" class="forminputelement" id="prod_price_addon[]" value=""/></td>
                            </tr>
                            <tr class="row1">
                              <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Image </span> <span class="style3">*</span> </td>
                              <td width="70%" colspan="4" align="left"><input name="image_addon[]" id="image_addon[]" type="file" class="forminputelement"/></td>
                            </tr>
                          </table>
                        </div>
                        <br />
                        <table align="center" cellpadding="0" cellspacing="0" border="0">
                          <tr class="row1">
                            <td colspan="5" align="right" class="leftBarText"><a href="javascript:new_link()">Add New </a> </td>
                          </tr>
                        </table>
                        <div id="newlinktpl" style="display:none;margin:-7px; width:100%;">
                          <table width="100%" align="center" cellpadding="6" cellspacing="1" class="tborder_new" border="0">
                            <tr class="row2">
                              <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> <span class="style3">*</span></td>
                              <td width="70%" colspan="4" align="left"><input name="prod_pcode_addon[]" type="text" class="forminputelement" id="prod_pcode_addon[]"  value="" /></td>
                            </tr>
                            <tr class="row1">
                              <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> <span class="style3">*</span></td>
                              <td width="70%" colspan="4" align="left"><input name="prod_pname_addon[]" type="text" class="forminputelement" id="prod_pname_addon[]"  value="" /></td>
                            </tr>
                            <tr class="row2">
                              <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> <span class="style3">*</span></td>
                              <td width="70%" colspan="4" align="left"><input name="prod_price_addon[]" type="text" class="forminputelement" id="prod_price_addon[]" value=""/></td>
                            </tr>
                            <tr class="row1">
                              <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Image </span> <span class="style3">*</span> </td>
                              <td width="70%" colspan="4" align="left"><input name="image_addon[]" id="image_addon[]" type="file" class="forminputelement"/></td>
                            </tr>
                          </table>
                        </div>
                      </div></td>
                      <tr>-->
                      	<tr>

                      		<td colspan="3" align="center">
                      			<a class="brownbttn" href="product.php?category=<?=$_REQUEST['category']?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>" class="back">&lt;&lt;back</a>
                      			<input type="submit" name="Save" id="Save" value="Save" class="loginbttn">
                      		</td>
                      	</tr>
                      </tbody>

                  </table>
              </form>
          <? }

          /* end brand */


	  // edit customer details
          if($show=='edit'){

          	$sql1="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE  `pd_id` =".$_REQUEST['id']." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
          	$res1=$heart->sql_query($sql1);
          	$row1=$heart->sql_fetchrow($res1);
          	if($row1['category']!=0)
          	{
          		$cat = explode(',',$row1['category']);

          	}
          	if($row1['category']==0)
          	{
          		$catA = getcategoryname2($_REQUEST['id']);				
          		$cat = explode(',',$catA);
          	}
          	if($row1['keyword']!='')
          	{
          		$key = explode(',',$row1['keyword']);

          	}
			/*if($row1['keyword']=='')
			{
				$keyA = getcategoryname2($_REQUEST['id']);				
				$key = explode(',',$keyA);
			}*/
			
			//$loc = explode(',',$row1['location']);
			?>	<script type="text/javascript">
				function check_key(){					
					var ids=0;					
					var ck=0;					
					$.each($('input:checkbox[target=catkey]'),function(){						
						if($(this).is(':checked')){							
							ck++;							
							id=$(this).val();								
							if(ck>0){									
								if(ck==1){										
									str1=id;									
									ids=str1;									
								}else{										
									str1=','+id;									   
									ids=ids+str1;									
								}																	
							}															
						}												
					});					
					/*alert(ids);*/
					dataquery='act=catkeylist&catid='+ids;				
					console.log('product_process.php?'+dataquery);					
					$.ajax({						
						type:'POST',						
						url:'product_process.php',						
						data:dataquery,						
						async:false,						
						success:function(msg){									
							$('input:checkbox[target=key]').attr('checked', false);									
							$keylist=msg.split(',');									 
							$.each($keylist, function() {            							
								$('#key_id_'+this).attr('checked', true);        							
							});															
						}													
					});										
				}					
				function display_catkey(){						
					var check=$('#check_div').val();						
					if(check=='display'){							
						$('#show_keycat').css('display','block');							
						$('#check_div').val('hide');						
					}
					else{							
						$('#show_keycat').css('display','none');							
						$('#check_div').val('display');						
					}					
				}						
			</script>
			<form name="frmedit" method="post" action="product_process.php" id="frmedit" enctype="multipart/form-data" onsubmit="return product_edit(this)">
				<p>
					<input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
					<input type="hidden" name="act" value="update" />
					<input type="hidden" name="pd_id" value="<?=$row1['pd_id']?>" />
					<input type="hidden" name="prod_edit_valid" value=""  id="prod_edit_valid"/>
					<input type="hidden" name="type_check_edit" value=""  id="type_check_edit"/>
				</p>
				<table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">

					<thead>
						<tr>
							<td colspan="5" align="left" class="style2">&nbsp;Edit Product Section </td>
						</tr>
					</thead>
					<tbody>
						<? if($_REQUEST['m']){ ?>
							<tr class="row2">
								<td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
							</tr>
						<? } ?>
						<? if($row1['mainaddon']=='0'){ ?>
							<tr class="row2">
								<td width="30%" align="left" class="leftBarText" colspan="3"><span class="leftBarText_new">Category</span> </td>

							</tr>
							<? 
							$sql="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `status`='A' AND `cat_parent_id`=0 ORDER BY `order` ASC ";
							$res=$heart->sql_query($sql);
							while($row=$heart->sql_fetchrow($res))
							{


								?>
								<tr class="row2">
									<td colspan="3" align="left" valign="top"><span class="leftBarText_new"><?=$row['name'];?></span> <span class="redstar">*</span>
										<? if($row['id']=='225'){?>
											<input name="check_all1" id="check_all1" class="check-all" type="checkbox" onclick="checkall_edit(this.id,'cate_id');"/>

										<?	}?>

									</td>
								</tr>

								<tr class="row2">

									<?
									$n = 0;

									$sqlcat="SELECT * FROM ".$cfg['DB_CATEGORY']." WHERE `status`='A' AND `cat_parent_id`=".$row['id']." ORDER BY `name` ASC ";
									$rescat=$heart->sql_query($sqlcat);
									$numrows=$heart->sql_numrows($rescat);
									while($rowcat=$heart->sql_fetchrow($rescat))
									{
										$n++;

										?>
										<td align="left" valign="top">
											<input type="checkbox" name="cate_id[]"  id="cate_id" value="<?=$rowcat['id']?>"  <? if(in_array($rowcat['id'],$cat)){?> checked="checked"<? }?>/>
											<?=stripslashes($rowcat['name'])?>
										</td>
										<? if($n%3==0 && $n>0)
										{
											echo '</tr>'.(($n<$numrows)?'<tr class="row2">':'');
										}

									}

									if(($n)%3>0)
									{
										?>
										<td colspan="<?=($n%3)+1 ?>">&nbsp;</td>
										<?
									} 
								}
								?>

							</tr>
						<? }else{?>
							<input type="hidden" name="cate_id" id="cate_id" value="<?=getcatid(getcatid($row1['category']))?>" />
							<input type="hidden" name="secpid" id="secpid" value="<?=$row1['category']?>" />
						<? } ?>
						<tr class="row1">
							<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> <span class="redstar">*</span></td>
							<td width="70%" colspan="4" align="left"><table>
								<tr>
									<td><input name="prod_pname_add" type="text" class="forminputelement" id="prod_pname_add"  value="<?=stripslashes($row1['pd_name'])?>" />
									&nbsp;&nbsp;&nbsp; </td>
									<td><input type="checkbox" name="fp" id="fp" value="1" <? if($row1['pd_featured']=='A'){?> checked="checked" <? } ?> />
										&nbsp;<span class="leftBarText_new">Featured Product</span> </td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td><input type="checkbox" name="today_Spcial_product" id="today_Spcial_product" value="1" <? if($row1['today_Spcial_product']=='Y'){?> checked="checked" <? } ?> />
										&nbsp;<span class="leftBarText_new">Today's Spcial Product</span> </td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td><input type="checkbox" name="new_arrival_pro" id="new_arrival_pro" value="1" <? if($row1['new_arrival_pro']=='A'){?> checked="checked" <? } ?> />
										&nbsp;<span class="leftBarText_new">New Arrival Product</span> </td>
									</tr>
									
								<tr>
									<td>&nbsp;</td>
									<td><input type="checkbox" name="bp" id="bp" value="1" <? if($row1['pd_bestseller']=='Y'){?> checked="checked" <? } ?>/>
										&nbsp;<span class="leftBarText_new">Best Seller</span></td>
									</tr>
								</table></td>
							</tr>
							<tr class="row2">
								<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> <span class="redstar">*</span></td>
								<td width="70%" colspan="4" align="left"><input name="prod_price_add" type="text" class="forminputelement" id="prod_price_add" value="<?=$row1['pd_price']?>"/></td>
							</tr>
							<!-- <tr class="row2">
								<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Unit Price</span> <span class="redstar">*</span></td>
								<td width="70%" colspan="4" align="left"><input name="prod_unitprice_add" type="text" class="forminputelement" id="prod_unitprice_add" value="<?=$row1['pd_unit_price']?>"/></td>
							</tr> -->
							<!-- <tr class="row2">
								<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Double Flower Cost</span> <span class="redstar">*</span></td>
								<td width="70%" colspan="4" align="left"><input name="double_flower_cost" type="text" class="forminputelement" id="double_flower_cost" value="<?=$row1['prod_double_flower_price']?>"/></td>
							</tr> -->
							<tr class="row1">
								<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Strike Through Price</span> <span class="redstar">*</span></td>
								<td width="70%" colspan="4" align="left"><input name="sprod_price_add" type="text" class="forminputelement" id="sprod_price_add" value="<?=$row1['strike_price']?>"/></td>
							</tr>
							<tr class="row2">
								<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Discount</span> <span class="redstar">*</span></td>
								<td width="70%" colspan="4" align="left"><input name="discount" type="text" class="forminputelement" id="discount" value="<?=$row1['discount']?>"/></td>
							</tr>
							<!--  <tr class="row1">
								<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Disclaimer</span> <span class="redstar">*</span></td>
								<td width="70%" colspan="4" align="left"><?php /*?><input name="prod_loc" type="text" class="forminputelement" id="prod_loc" value="<?=$row1['location']?>"/><?php */?>
								<select name="prod_dis" id="prod_dis" class="forminputelement">
									<option value="0">Select Any</option> -->
									<?
									/*$sqlloc2="SELECT * FROM ".$cfg['DB_DISCLAIMER']." WHERE  `status`='A' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
									$resloc2=$heart->sql_query($sqlloc2);
									while($rowloc2=$heart->sql_fetchrow($resloc2))
										{*/ ?>
											<!--  <option value=<?//=$rowloc2['d_id']?> <? //if($row1['disclaimer']==$rowloc2['d_id']){?> selected="selected" <? //} ?>>
												<?//=stripslashes($rowloc2['title'])?>
											</option> -->
										<?// } ?>
									<!-- </select>
								</td>
							</tr>  -->

							<tr class="row1">
								<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Delivery By</span> <span class="redstar">*</span></td>
								<td width="70%" colspan="4" align="left"><?php /*?><input name="prod_loc" type="text" class="forminputelement" id="prod_loc" value="<?=$row1['location']?>"/><?php */?>
								<select name="prod_deliv" id="prod_deliv" class="forminputelement">
									<option value="0">Select Any</option>
									<?
									$sqldeliv="SELECT * FROM ".$cfg['DB_EARLIEST_DELIVERYBY']." WHERE  `status`='A' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
									$resdeliv=$heart->sql_query($sqldeliv);
									while($rowdeliv=$heart->sql_fetchrow($resdeliv))
										{  ?>
											<option value=<?=$rowdeliv['id']?> <? if($row1['earliest_deliveryId']==$rowdeliv['id']){?> selected="selected" <? } ?>>
												<?=stripslashes($rowdeliv['name'])?>
											</option>
										<? } ?>
									</select>
								</td>
							</tr>
							<!-- <tr class="row1">
								<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Notes</span> <span class="redstar">*</span></td>
								<td width="70%" colspan="4" align="left"><?php /*?><input name="prod_loc" type="text" class="forminputelement" id="prod_loc" value="<?=$row1['location']?>"/><?php */?>
								<select name="prod_note" id="prod_note" class="forminputelement">
									<option value="0">Select Any</option>
									<?
									/*$sqlloc1="SELECT * FROM ".$cfg['DB_NOTES']." WHERE  `status`='A' AND `siteId`= '".$cfg['SESSION_SITE']."' ";
									$resloc1=$heart->sql_query($sqlloc1);
									while($rowloc1=$heart->sql_fetchrow($resloc1))
										{*/  ?>
											<option value=<?//=$rowloc1['n_id']?> <? //if($row1['notes']==$rowloc1['n_id']){?> selected="selected" <? //} ?>>
												<?//=stripslashes($rowloc1['title'])?>
											</option>
										<? //} ?>
									</select>
								</td>
							</tr> -->

							<tr class="row2">
								<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Location</span> <span class="redstar">*</span></td>
								<td width="70%" colspan="4" align="left"><?php /*?><input name="prod_loc" type="text" class="forminputelement" id="prod_loc" value="<?=$row1['location']?>"/><?php */?>
								<select name="prod_loc" id="prod_loc" class="forminputelement">
									<?
									$sqlloc="SELECT * FROM ".$cfg['DB_CITY']." WHERE  `parent_id`='0'  ";
									$resloc=$heart->sql_query($sqlloc);
									while($rowloc=$heart->sql_fetchrow($resloc))
										{  ?>
											<option value=<?=$rowloc['id']?> <? if($row1['location']==$rowloc['id']){?> selected="selected" <? } ?>>
												<?=stripslashes($rowloc['name'])?>
											</option>
										<? } ?>
									</select>
								</td>
							</tr>
							<tr class="row1">
								<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> <span class="redstar">*</span></td>
								<td width="70%" colspan="4" align="left"><input name="prod_code" type="text" class="forminputelement" id="prod_code" value="<?=stripslashes($row1['pd_code'])?>"/></td>
							</tr>
							<tr class="row2">
								<td colspan="5" align="left" class="leftBarText"><span class="leftBarText_new">Description</span></td>
							</tr>
							<tr class="row1">
								<td colspan=5 width="35%" align="left" class="leftBarText">
									<textarea name="prod_desc_add" style="margin-left: 14px; margin-right: 0px;width: 94%; height: auto"><?=stripslashes($row1['pd_description'])?></textarea>
								</td>
							</tr>
							<tr class="row2">
								<td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Change Image </span> </td>
								<td width="70%" colspan="4" align="left" valign="top"><input name="image_add[]" id="image_add" type="file" class="forminputelement"/>
									&nbsp;&nbsp; <img src="../<?=$cfg['PRODUCT_IMAGES'].$row1['pd_image']?>"  width="70" align="top"/></td>
								</tr>
								<tr class="row2">
									<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Image 2</span> </td>
									<td width="70%" colspan="4" align="left"><input name="image_add2" id="image_add2" type="file" class="forminputelement"/>
										&nbsp;&nbsp; <img src="../<?=$cfg['PRODUCT_IMAGES'].$row1['pd_image1']?>"  width="70" align="top"/>
									</td>
								</tr>
								<tr class="row2">
									<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Image 3 </span> </td>
									<td width="70%" colspan="4" align="left"><input name="image_add3" id="image_add3" type="file" class="forminputelement"/>
										&nbsp;&nbsp; <img src="../<?=$cfg['PRODUCT_IMAGES'].$row1['pd_image2']?>"  width="70" align="top"/>
									</td>
								</tr>
								
								
								
								<!-- <tr class="row1">			 
									<td colspan="6" align="left" valign="top"><span class="leftBarText_new">Keywords Category List</span>			    			
									<a onclick="display_catkey()" style="color:#ce0e0e; margin-left:10px; font-size:11px; font-weight:bold;">Show Category for change</a>			    			
									<input type="hidden" name="check_div" id="check_div" value="display">
								</td>
								</tr> -->										
								<!-- <tr class="row2">						
									<td colspan="6" align="left" valign="top">							
									<div id="show_keycat" style="display: none;">							
									<table width="100%">
										<tr class="row2">						
											<?php 
											/*$n = 0;
											$keycatselect=getcatgory_from_key($row1['keyword']);	
											$sqlcatkey="SELECT * FROM ".$cfg['DB_KEYWORD_CATEGORY']." WHERE `status`='A'";								  
											$rescatkey=$heart->sql_query($sqlcatkey);			
											    $numrowskey=$heart->sql_numrows($rescatkey);		
											    while($rowcatkey=$heart->sql_fetchrow($rescatkey)){	*/												
											    //$n++;									$slt='';									
											    //if(in_array($rowcatkey['id'],$keycatselect)){										
											    //$slt='checked=checked';									
											    //}																		?>								
											    <td align="left" valign="top">										
											    <input type="checkbox" name="catkey_id[]" target='catkey'  id="catkey_id_<?//=$rowcatkey['id']?>" value="<?//=$rowcatkey['id']?>" onclick="check_key()" <?//=$slt?> />											
											    <?//=stripslashes($rowcatkey['name'])?>													
											    </td>													
											    <?// if($n%3==0 && $n>0){															
											    //echo '</tr>'.(($n<$numrowskey)?'<tr class="row2">':'');														
											    //}																										
											    //}																									
											    //if($n%3>0)													
											    //{	?>													 
											    <td colspan="<?//=($n%3)+1 ?>">&nbsp;</td>												
											    <?//} 																							
											    ?>		                    	
											    </tr>                    
											    </table>                  
											    </div>                 
											    </td>               
											     </tr>
											<tr class="row2">
												<td width="30%" align="left" class="leftBarText" colspan="3"><span class="leftBarText_new">Keywords <input name="check_all" id="check_all" class="check-all" type="checkbox" onclick="checkall_edit(this.id,'key_id');"/>(Select All)</span></td>

											</tr>
											<tr class="row2">

												<?
												/*$n = 0;

												$sqlcat="SELECT * FROM ".$cfg['DB_KEYWORD']." WHERE `status`='A'";
												$rescat=$heart->sql_query($sqlcat);
												$numrows=$heart->sql_numrows($rescat);
												while($rowcat=$heart->sql_fetchrow($rescat))
												{*/
													//$n++;

													?>
													<td align="left" valign="top">
														<input type="checkbox" name="key_id[]"  id="key_id_<?//=$rowcat['id']?>" target="key" value="<?//=$rowcat['id']?>"  <? //if(in_array($rowcat['id'],$key)){?> checked="checked"<? //}?>/>
														<?//=stripslashes($rowcat['key_name'])?>
													</td>
													<? //if($n%3==0 && $n>0)
													/*{
														echo '</tr>'.(($n<$numrows)?'<tr class="row2">':'');
													}*/

												//}

												/*if(($n)%3>0)
												{
													?>
													<td colspan="<?=($n%3)+1 ?>">&nbsp;</td>
													<?
												}*/ 

												?>

											</tr> -->


                  <? /* if($row1['mainaddon']==0){ ?>
                 <!-- <tr class="row1">
                    <td colspan="5" align="left" class="leftBarText"><span class="leftBarText_new">Add on Product</span>
                      <input type="checkbox" name="addon" id="addon" value="yes" onclick="addopen();" /></td>
                  </tr>-->
                  </tbody>
                  
                </table>
				
                <div id="addon_prod" style="display:none;">
                  <div id="newlink">
                    <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                      <thead>
                        <tr class="row2">
                          <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> <span class="style3">*</span></td>
                          <td width="70%" colspan="4" align="left"><input name="prod_pcode_addon[]" type="text" class="forminputelement" id="prod_pcode_addon[]"  value="" /></td>
                        </tr>
                        <tr class="row1">
                          <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> <span class="style3">*</span></td>
                          <td width="70%" colspan="4" align="left"><input name="prod_pname_addon[]" type="text" class="forminputelement" id="prod_pname_addon[]"  value="" /></td>
                        </tr>
                        <tr class="row2">
                          <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> <span class="style3">*</span></td>
                          <td width="70%" colspan="4" align="left"><input name="prod_price_addon[]" type="text" class="forminputelement" id="prod_price_addon[]" value=""/></td>
                        </tr>
                        <tr class="row2">
                          <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Image </span> <span class="style3">*</span> </td>
                          <td width="70%" colspan="4" align="left"><input name="image_addon[]" id="image_addon[]" type="file" class="forminputelement"/></td>
                        </tr>
                        </tbody>
                        
                    </table>
                  </div>
                  <!--<table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                    <thead>
                      <tr class="row1">
                        <td colspan="5" align="left" class="leftBarText"><a href="javascript:new_link()">Add New </a> </td>
                      </tr>
					  
                      </thead>
                      
                  </table>-->
                  <div id="newlinktpl"  style="display:none;" >
                    <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                      <thead>
                        <tr class="row2">
                          <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> <span class="style3">*</span></td>
                          <td width="70%" colspan="4" align="left"><input name="prod_pcode_addon[]" type="text" class="forminputelement" id="prod_pcode_addon[]"  value="" /></td>
                        </tr>
                        <tr class="row1">
                          <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> <span class="style3">*</span></td>
                          <td width="70%" colspan="4" align="left"><input name="prod_pname_addon[]" type="text" class="forminputelement" id="prod_pname_addon[]"  value="" /></td>
                        </tr>
                        <tr class="row2">
                          <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> <span class="style3">*</span></td>
                          <td width="70%" colspan="4" align="left"><input name="prod_price_addon[]" type="text" class="forminputelement" id="prod_price_addon[]" value=""/></td>
                        </tr>
                        <tr class="row1">
                          <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Image </span> <span class="style3">*</span> </td>
                          <td width="70%" colspan="4" align="left"><input name="image_addon[]" id="image_addon[]" type="file" class="forminputelement"/></td>
                        </tr>
                        </tbody>
                        
                    </table>
                  </div>
                </div>
				
                <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                  <thead>
              <? } */ ?>
              <tr>
              	<td colspan="3" align="center">
              		<a class="brownbttn" href="product.php?category=<?=$_REQUEST['category']?>&page=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?><? if($row1['mainaddon']!=0){?>&main=<?=$row1['mainaddon']?><? } ?>" class="back">&lt;&lt;back</a>
              		<input type="submit" name="Save" id="Save" value="Save" class="loginbttn">
              	</td>
              </tr>
          </thead>

      </table>
  </form>
  <? 
} 
	  //edit addon
if($show=='edit_addon'){

	 //  echo "555555555555555555";

	$sql1="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE  `pd_id` =".$_REQUEST['id']." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
	$res1=$heart->sql_query($sql1);
	$row1=$heart->sql_fetchrow($res1);

	$cat = explode(',',$row1['category']);
	$loc = explode(',',$row1['location']);
	?>
	<form name="frmedit" method="post" action="product_process.php" id="frmedit" enctype="multipart/form-data" onsubmit="">
		<p>
			<input type="hidden" name="pageno" value="<?=$_REQUEST['pageno']?>" />
			<input type="hidden" name="act" value="update_addon" />
			<input type="hidden" name="pd_id" value="<?=$row1['pd_id']?>" />
			<input type="hidden" name="prod_edit_valid" value=""  id="prod_edit_valid"/>
			<input type="hidden" name="type_check_edit" value=""  id="type_check_edit"/>
		</p>
		<table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
			<thead>
				<tr>
					<td colspan="5" align="left" class="style2">&nbsp;Edit Addon Product Section </td>
				</tr>
			</thead>
			<tbody>
				<? if($_REQUEST['m']){ ?>
					<tr class="row2">
						<td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
					</tr>
				<? } ?>
				<tr class="row1">
					<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> <span class="redstar">*</span></td>
					<td width="70%" colspan="4" align="left"><input name="prod_pname_addon" type="text" class="forminputelement" id="prod_pname_addon"  value="<?=stripslashes($row1['pd_name'])?>" /></td>
				</tr>
				<tr class="row2">
					<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> <span class="redstar">*</span></td>
					<td width="70%" colspan="4" align="left"><input name="prod_price_addon" type="text" class="forminputelement" id="prod_price_addon" value="<?=$row1['pd_price']?>"/></td>
				</tr>
				<tr class="row1">
					<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> <span class="redstar">*</span></td>
					<td width="70%" colspan="4" align="left"><input name="prod_pcode_addon" type="text" class="forminputelement" id="prod_pcode_addon" value="<?=stripslashes($row1['pd_code'])?>"/></td>
				</tr>
				<tr class="row2">
					<td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Change Image </span> </td>
					<td width="70%" colspan="4" align="left" valign="top"><input name="image_addon" id="image_addon" type="file" class="forminputelement"/>
						&nbsp;&nbsp; <img src="../<?=$cfg['PRODUCT_IMAGES'].$row1['pd_image']?>"  width="70" align="top"/></td>
					</tr>
					<tr>
						<td align="right"><a href="product.php?category=<?=$_REQUEST['category']?>&page=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?><? if($row1['mainaddon']!=0){?>&main=<?=$row1['mainaddon']?><? } ?>" class="back">&lt;&lt;back</a></td>
						<td colspan="4" align="left"><input type="submit" name="Save" id="Save" value="Save" class="loginbttn">
						&nbsp;</td>
					</tr>
				</tbody>
			</table>
		</form>
		<? 

	} 



	  //view customer details
	if($show=='view'){

		$sql_name="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE  `pd_id` =".$_REQUEST['id']." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
		$res_name=$heart->sql_query($sql_name);
		$row1=$heart->sql_fetchrow($res_name);
			
		$sql_Delivery="SELECT * FROM ".$cfg['DB_EARLIEST_DELIVERYBY']." WHERE  `id` =".$row1['earliest_deliveryId']." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
		$res_Delivery=$heart->sql_query($sql_Delivery);
		$row_Delivery=$heart->sql_fetchrow($res_Delivery);
		?>
		<table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
			<thead>
				<tr>
					<td colspan="4" align="left" class="style2">&nbsp;View Product Section </td>
					<td width="14%" align="right" class="style2"><a class="brownbttn" href="product.php?show=edit&id=<?=$_REQUEST['id']?>&pageno=<?=$pageno?>"><strong>Edit</strong></a></td>
				</tr>
			</thead>
			<tbody>
				<? if($_REQUEST['m']){ ?>
					<tr class="row2">
						<td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
					</tr>
				<? } ?>
				<tr class="row1">
					<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Category</span> </td>
					<td colspan="4" align="left"><? if($row1['category']!=0){?>
						<?=getcategoryname($row1['category'])?>
					<? }else{?>
						<?=getcategoryname(getcategoryname2($row1['pd_id']))?>
					<? }?>
				</td>
			</tr>
			<tr class="row2">
				<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> </td>
				<td colspan="4" align="left"><?=stripslashes($row1['pd_name'])?>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<? if($row1['pd_featured']=='A'){?>
					( Set as homepage product )
					<? } ?></td>
				</tr>
				<tr class="row1">
					<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Category Type</span> </td>
					<td colspan="4" align="left">
						<?php 
						$productTypes =array();
							if($row1['pd_featured']=='A'){ 
								array_push($productTypes, 'Feacture Product');
							}if($row1['pd_bestseller']=='Y'){
								array_push($productTypes, 'Best Selling Product');
							} if($row1['today_Spcial_product']=='Y'){
								array_push($productTypes, 'Todays Special Product');
							} if($row1['new_arrival_pro']=='A'){
								array_push($productTypes, 'New Arrival Product');
							}
							if(!empty($productTypes)) {
								echo implode(",",$productTypes);
							}
						?>
					</td>
				</tr>
				<tr class="row1">
					<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new"></span>Price</td>
					<td colspan="4" align="left"><?=$row1['pd_price']?></td>
				</tr>
				<tr class="row2">
					<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Delivery By</span> </td>
					<td colspan="4" align="left"><?=$row_Delivery['name']?></td>
				</tr>
				<? if($row1['strike_price']){?>
					<tr class="row2">
						<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Strike Price</span> </td>
						<td colspan="4" align="left"><?=$row1['strike_price']?></td>
					</tr>
					<tr class="row1">
					<? }else{?>
						<tr class="row2">
						<? }?>
						<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> </td>
						<td colspan="4" align="left"><?=stripslashes($row1['pd_code'])?></td>
					</tr>
					 <tr class="row1">
						<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Location</span> </td> 
						<?
						$sql_l="SELECT * FROM ".$cfg['DB_CITY']." WHERE  `id` =".$row1['location']."  ";
						$res_l=$heart->sql_query($sql_l);
						$row_l=$heart->sql_fetchrow($res_l);


						?>
						<td colspan="4" align="left"><?=getlocationname($row_l['city_id'])?></td>
					</tr>
					<!-- <tr class="row2">
						<td width="30%" valign="top" align="left" class="leftBarText"><span class="leftBarText_new">Product Disclaimer</span></td>
						<td colspan="4" align="left"><? //if($row1['disclaimer']!='') { ?>
							<?//=getdisclaimer($row1['disclaimer'])?>
						<? //} else { ?>
							None
						<? //} ?>
					</td>
				</tr> -->
				<!-- <tr class="row1">
					<td width="30%" valign="top" align="left" class="leftBarText"><span class="leftBarText_new">Product Notes</span></td>
					<td colspan="4" align="left"><?// if($row1['notes']!='') { ?>
						<?//=getnotes($row1['notes'])?>
					<? //} else { ?>
						None
					<? //} ?>
				</td> -->
			</tr>
			<tr class="row2">
				<td colspan="5" align="left" class="leftBarText"><span class="leftBarText_new">Description</span></td>
			</tr>
			<tr class="row1">
				<td colspan=5 align="left" class="leftBarText"><?php
				if($row1['pd_description']!='') { echo  stripslashes($row1['pd_description']); } else { echo 'None'; }
				?>
			</td>
		</tr>
		<tr class="row2">
			<td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Image </span> </td>
			<td colspan="4" align="left" valign="top"><img src="../<?=$cfg['PRODUCT_IMAGES'].$row1['pd_image']?>"  width="70" align="top"/></td>
		</tr>

		<tr class="row2">
			<td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Product Image1 </span> </td>
			<td colspan="4" align="left" valign="top"><img src="../<?=$cfg['PRODUCT_IMAGES'].$row1['pd_image1']?>"  width="70" align="top"/></td>
		</tr>

		<tr class="row2">
			<td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Product Image2 </span> </td>
			<td colspan="4" align="left" valign="top"><img src="../<?=$cfg['PRODUCT_IMAGES'].$row1['pd_image2']?>"  width="70" align="top"/></td>
		</tr>

		<? $sql_addon="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE  `status`='A' AND `mainaddon` =".$_REQUEST['id']." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
		$res_addon=$heart->sql_query($sql_addon);
		$maxrow=$heart->sql_numrows($res_addon);
			//$row_addon=$heart->sql_fetchrow($res_addon);
		$k=0;
		if($maxrow >0)
		{
			while($row_addon=$heart->sql_fetchrow($res_addon)){
				$k++;
				?>
				<tr class="">
					<td colspan="5" align="left" class="style2">Add On Product
						<?=$k?></td>
					</tr>
					<tr class="row2">
						<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> </td>
						<td colspan="4" align="left"><?=stripslashes($row_addon['pd_name'])?>
						<?php /*?>&nbsp;&nbsp;&nbsp;&nbsp;<? if($row1['pd_featured']=='A'){?> ( Set as homepage product ) <? } ?><?php */?></td>
					</tr>
					<tr class="row1">
						<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> </td>
						<td colspan="4" align="left"><?=$row_addon['pd_price']?></td>
					</tr>
					<tr class="row2">
						<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> </td>
						<td colspan="4" align="left"><?=stripslashes($row_addon['pd_code'])?>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<? if($row_addon['pd_featured']=='A'){?>
							( Set as homepage product )
						<? } ?>
					</td>
				</tr>
				<tr class="row2">
					<td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Image </span> </td>
					<td colspan="4" align="left" valign="top"><img src="../<?=$cfg['PRODUCT_IMAGES'].$row_addon['pd_image']?>"  width="70" align="top"/></td>
				</tr>

				
			<? }
		}
		?>
		<tr>
			<td align="center" colspan="5" style="padding-top:10px; padding-bottom:10px;">
				<a class="brownbttn" href="product.php?category=<?=$_REQUEST['category']?>&pageno=<?=($_REQUEST['pageno']!="")?$_REQUEST['pageno']:'0'?>" class="back">&lt;&lt;back</a>
			</td>
		</tr>
	</tbody>
</table>
<? 
} 

if($show=='view_addon'){

	$sql_name_addon="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE  `pd_id` =".$_REQUEST['id']." AND `siteId`= '".$cfg['SESSION_SITE']."' ";
	$res_name_addon=$heart->sql_query($sql_name_addon);
	$row_addon=$heart->sql_fetchrow($res_name_addon);
	?>
	<table width="98%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
		<thead>
			<tr>
				<td colspan="4" align="left" class="style2">&nbsp;View Product Section </td>
				<td width="14%" align="right" class="style2"><a class="brownbttn" href="product.php?show=edit&id=<?=$_REQUEST['id']?>&pageno=<?=$pageno?>"><strong>Edit</strong></a></td>
			</tr>
		</thead>
		<tbody>
			<tr class="row1">
				<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Name</span> </td>
				<td colspan="4" align="left"><?=stripslashes($row_addon['pd_name'])?>
			</td>
		</tr>
		<tr class="row2">
			<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Price</span> </td>
			<td colspan="4" align="left"><?=$row_addon['pd_price']?></td>
		</tr>
		<tr class="row1">
			<td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Product Code</span> </td>
			<td colspan="4" align="left"><?=stripslashes($row_addon['pd_code'])?></td>
		</tr>
		<tr class="row2">
			<td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Image </span> </td>
			<td colspan="4" align="left" valign="top"><img src="../<?=$cfg['PRODUCT_IMAGES'].$row_addon['pd_image']?>"  width="70" align="top"/></td>
		</tr>
	</tbody>
</table>
<?	}

?>
</td>
</tr>
<tr height="16">
	<td height="16" colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat;">&nbsp;</td>
</tr>
</table></td>
</tr>
<tr>
	<td colspan="3" align="right"></td>
</tr>
</table>
<?
/*	
function countRightbar()
{
	global $cfg,$heart;
	//$sql="SELECT * FROM ".$cfg['DB_PRODUCT']." WHERE `pd_rightbar`='A' ";
	//$res=$heart->sql_query($sql);
	//$num=$heart->sql_numrows($res);	
	return $num;	
	
}
*/
?>