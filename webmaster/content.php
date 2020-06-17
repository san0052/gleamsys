<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
if($_REQUEST['m']==1) { $msg='Record Added';}
if($_REQUEST['m']==2) { $msg='Record Updated';}
page_header($cfg['ADMIN_TITLE']." - Page Content Management");
$show=$_REQUEST['show'];
?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<script language="javascript1.1" type="text/javascript">
 function validate(){
  if(document.form[0].description.value=''){
    alert('Insert Content');
    return false;
  }
  return true;
}
</script>

<script language="javascript" src="scripts/common.js"></script>
<script language="javascript" src="scripts/ckeditor/ckeditor.js"></script>


<td vAlign=top align="center" width="99%"><!-- Start Body Here -->
  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">

    <tr height="34">
      <td width="25%" rowspan="2" colspan="3" align="center" valign="top"><br /><br />
        <?php include_once("left_bar.php");?></td>
      </tr>
      <tr>
        <td align="center" valign="middle"><img src="images/spacer.gif" width="1" height="550" /></td>
        <td align="left" valign="top" width="99%">

         <table width="698" align="center" border="0" cellspacing="0" cellpadding="0"bgcolor="#0F0F0F" style="background:url(images/welcome_head.jpg)center top no-repeat;background-size:100%; ">
           <tr height="35" >
            <td align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome
              <?=$_SESSION['admin_user_name']?>
            </span>               
          </td>
          <td align="right" valign="middle" class="style5">
           <?
           $sql="SELECT * FROM ".$cfg['DB_SITE']."   ";
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
          <a href="login.php?act=<?=md5("logout")?>" title="Logout"><img src="images/lock.png" height="24" width="24" border="0" style="vertical-align: middle;" /></a>&nbsp;&nbsp;
        </td>
	  <?php /*?><!--<td align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome 
  <?=$_SESSION['admin_user_name']?>
</span></td>
<td align="right" valign="middle" class="style5"><a href="login.php?act=<?=md5("logout")?>"><img src="images/lock.png" height="24" width="24" border="0" /></a>&nbsp;&nbsp;</td>--><?php */?>
</tr>
<tr height="16">
 <td colspan="2" align="left" valign="middle" style="background-color:#eee8e8;">&nbsp;</td>
</tr>
<tr>
  <td colspan="2" style="background-color:#eee8e8;">
	  <? //show all record
    if($_REQUEST['show']==''){?>
     <table width="98%" align="center" cellpadding="6" cellspacing="0" class="tborder_new">
      <thead>
        <tr>
          <td colspan="4" align="left">&nbsp;<span class="style2">Page Section</span> </td>
        </tr>
      </thead>
      <tbody>

        <tr>
          <td colspan="4" align="right" class="redbuttonelements"><?=@$msg?></td>
        </tr>
        <tr class="headercontent">
          <td width="6%" align="center" class="leftBarText_new1">Sl No </td>
          <td width="29%" align="left" class="leftBarText_new1">Page name  </td>
          <td width="13%" align="center" class="leftBarText_new1">Status</td>
          <td width="13%" align="center" class="leftBarText_new1">Action</td>
        </tr>
        <?php $sql="SELECT * FROM ".$cfg['DB_PAGECONTENT']."WHERE `siteId`='".$cfg['SESSION_SITE']."' and `cmsStatus`='A' OR `cmsStatus`='I'";
        $res=$heart->sql_query($sql);
        $maxrow=$heart->sql_numrows($res);
			/* $sql = $sql. " LIMIT $offset,$limit";
      $res = $heart->sql_query($sql);*/
      if($maxrow >0){
        while($row=$heart->sql_fetchrow($res)){
          @$i++;
          ?>
          <tr class="<?=($i%2==0)?'row1':'row2'?>">
            <td align="center"><?=$i+$offset?></td>
            <td align="left" ><?=stripslashes($row['cmsName'])?></td>
            <td align="center"><a href="content_process.php?act=<?=($row['cmsStatus']=='A')?'Inactive':'Active'?>&id=<?=$row['cmsId']?>" class="<?=($row['cmsStatus']=='A')?'greenbuttonelementsNew':'redbuttonelementsNew'?>"><?=($row['cmsStatus']=='A')?'Active':'Inactive'?></a></td>
            <td align="center"><a href="content_process.php?act=view&page=<?=$row['cmsName']?>&id=<?=$row['cmsId']?>"><img src="images/view.gif" alt="View" width="16" height="16" border="0" /></a>
              <a href="content_process.php?act=edit&page=<?=$row['cmsName']?>&id=<?=$row['cmsId']?>"><img src="images/edit.gif" alt="Edit" width="16" height="16" border="0" /></a><?php /*?><a href="ccontent_process.php?act=del&id=<?=$row['cmsId']?>"><img src="images/drop.gif" alt="Delete" width="16" height="16" border="0" /></a><?php */?></td>
            </tr>
          <? }
        }
        else {?>
          <tr>
            <td colspan="4" align="center" class="msg">No Record.</td>
            </tr>  <? }?>
            <tr>
<?php /*?>              <td colspan="3" align="right" class="media1"><a href="content_process.php?act=add">Add Page Section  </a></td>
<?php */?>            </tr>
<tr>
 <td colspan="4" align="right" class="media1"><?php /*?><?=$heart->paginate($maxrow, $limit, $pageno, "pageno", "link")?><?php */?></td>
</tr>
</tbody>
</table>
<? }?>
		<? // show insert window
		if($show=='add'){?>

     <form name="frmadd" method="post" action="content_process.php" id="frmadd" onsubmit="return page()">
      <p>
        <input type="hidden" name="act" value="insert" />
      </p>
      <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new"> 
        <thead> 
          <tr> 
            <td colspan="5" align="left" class="style2">&nbsp;Add Page Section </td> 
          </tr> 
        </thead> 
        <tbody> 
          <tr class="alt1"> 
            <td colspan="5" align="left" class="alt1"></td> 
          </tr> 
          <tr>
            <td colspan="5" align="left" class="redbuttonelements"><?=@$msg?></td>
          </tr>
          <tr> 
            <td width="30%" align="left" class="leftBarText"><span class="leftBarText_new">Page Heading</span> <span class="redstar">*</span></td> 
            <td width="70%" colspan="4" align="left"><input name="pageheading" type="text" class="forminputelement" id="pageheading" /></td>
          </tr> 
          <tr> 
            <td class="leftBarText_new" align="left">Content</td> 
            <td colspan="4" align="left">&nbsp;</td> 
          </tr>
          <tr>
            <td colspan="5" align="left" class="leftBarText" >
              <?php
				// FCKEDITOR
              $oFCKeditor = new FCKeditor('description1') ;
              $oFCKeditor->BasePath	= $sBasePath;
              $oFCKeditor->Width		= '100%';
              $oFCKeditor->Height		= '200';
              $oFCKeditor->ToolbarSet	= 'Default';
              $oFCKeditor->Value		= '';
              print $oFCKeditor->CreateHtml();
              ?></td>
            </tr>


            <tr> 

              <td colspan="4" align="center">
               <a class="brownbttn" href="content.php">&lt;&lt;back</a>
               <input type="submit" name="Save" id="Save" value="Save" class="loginbttn"> 
             </td> 
           </tr> 
         </tbody> 
       </table> 
     </form>
   <? } 

   if($show=='editTerms'){
    $sql="SELECT * FROM ".$cfg['DB_TERMS']." WHERE `siteId`='".$cfg['SESSION_SITE']."' and id =5";
    $res=$heart->sql_query($sql);
    $row=$heart->sql_fetchrow($res);
    
    ?>
    <form action="content_process.php" method="post" name="frm" id="frm" enctype="multipart/form-data">
      <p>
        <input type="hidden" name="act" value="updateTerms" />
        <input type="hidden" name="id" value="<?=$row['id']?>" />
      </p>
      <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
        <thead>
          <tr>
            <td colspan="2" align="left" class="style2">&nbsp;Edit Page Section </td>
          </tr>
        </thead>
        <tbody>
         <tr class="row1">
          <td colspan="2" align="left" class="redbuttonelements"><?=@$msg?></td>
        </tr>
        <tr class="row1">
          <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Page Heading</span> <span class="redstar">*</span></td>

          <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr class="row2">
         <td colspan="2" align="left">
          <textarea name="desc1"  class="forminputelement" cols="80" id="desc1" /><?=stripslashes($row['desc1'])?></textarea>
          <script>
            CKEDITOR.replace( 'desc1' );
          </script>
        </td>
      </tr>
      <tr class="row1">
        <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Description</span> <span class="redstar">*</span></td>

        <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
      </tr>
      <tr class="row2">
       <td colspan="2" align="left">
        <textarea name="desc2"  class="forminputelement" cols="80" id="desc2" /><?=stripslashes($row['desc2'])?></textarea>
        <script>
          CKEDITOR.replace( 'desc2' );
        </script>
      </td>
    </tr>

    <tr class="row1">
      <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Description1</span> <span class="redstar">*</span></td>

      <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
    </tr>
    <tr class="row2">
     <td colspan="2" align="left">
      <textarea name="desc3"  class="forminputelement" cols="80" id="desc3" /><?=stripslashes($row['desc3'])?></textarea>
      <script>
        CKEDITOR.replace( 'desc3' );
      </script>
    </td>
  </tr>

  <tr>
    <td align="center" colspan="2">
      <a class="brownbttn" href="content.php?show=viewTerms&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>
      <input type="submit" name="Save" id="Save" value="Save" class="loginbttn" />
    </td>
  </tr>
</tbody>
</table>
</form>
<?  }

if($show=='editRefund'){
  $sql="SELECT * FROM ".$cfg['DB_PRODUCT_REFUND']." WHERE `siteId`='".$cfg['SESSION_SITE']."' and id =4";
  $res=$heart->sql_query($sql);
  $row=$heart->sql_fetchrow($res);

  ?>
  <form action="content_process.php" method="post" name="frm" id="frm" enctype="multipart/form-data">
    <p>
      <input type="hidden" name="act" value="updateRefund" />
      <input type="hidden" name="id" value="<?=$row['id']?>" />
    </p>
    <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
      <thead>
        <tr>
          <td colspan="2" align="left" class="style2">&nbsp;Edit Page Section </td>
        </tr>
      </thead>
      <tbody>
       <tr class="row1">
        <td colspan="2" align="left" class="redbuttonelements"><?=@$msg?></td>
      </tr>
      <tr class="row1">
        <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Page Heading</span> <span class="redstar">*</span></td>

        <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
      </tr>
      <tr class="row2">
       <td colspan="2" align="left">
        <textarea name="desc1"  class="forminputelement" cols="80" id="desc1" /><?=stripslashes($row['desc1'])?></textarea>
        <script>
          CKEDITOR.replace( 'desc1' );
        </script>
      </td>
    </tr>
    <tr class="row1">
      <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Description</span> <span class="redstar">*</span></td>

      <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
    </tr>
    <tr class="row2">
     <td colspan="2" align="left">
      <textarea name="desc2"  class="forminputelement" cols="80" id="desc2" /><?=stripslashes($row['desc2'])?></textarea>
      <script>
        CKEDITOR.replace( 'desc2' );
      </script>
    </td>
  </tr>

  <tr class="row1">
    <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Description1</span> <span class="redstar">*</span></td>

    <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr class="row2">
   <td colspan="2" align="left">
    <textarea name="desc3"  class="forminputelement" cols="80" id="desc3" /><?=stripslashes($row['desc3'])?></textarea>
    <script>
      CKEDITOR.replace( 'desc3' );
    </script>
  </td>
</tr>

<tr>

  <td align="center" colspan="2">
    <a class="brownbttn" href="content.php?show=viewRefund&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>
    <input type="submit" name="Save" id="Save" value="Save" class="loginbttn" />
  </td>
</tr>
</tbody>
</table>
</form>
<?  }

if($show=='editPrivacy'){
  $sql="SELECT * FROM ".$cfg['DB_PRIVACY']." WHERE `siteId`='".$cfg['SESSION_SITE']."' and id =3";
  $res=$heart->sql_query($sql);
  $row=$heart->sql_fetchrow($res);

  ?>
  <form action="content_process.php" method="post" name="frm" id="frm" enctype="multipart/form-data">
    <p>
      <input type="hidden" name="act" value="updatePrivacy" />
      <input type="hidden" name="id" value="<?=$row['id']?>" />
    </p>
    <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
      <thead>
        <tr>
          <td colspan="2" align="left" class="style2">&nbsp;Edit Page Section </td>
        </tr>
      </thead>
      <tbody>
       <tr class="row1">
        <td colspan="2" align="left" class="redbuttonelements"><?=@$msg?></td>
      </tr>

      <tr class="row2">
        <td width="30%" align="left" class="leftBarText_new">Page Name</td>
        <td align="left"><input name="heading" type="text" class="forminputelement" id="heading" value="<?=stripslashes($row['heading'])?>" style="width:60%"
          Readonly/></td>
        </tr>

        <tr class="row1">
          <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Page Heading</span> <span class="redstar">*</span></td>

          <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr class="row2">
         <td colspan="2" align="left">
          <textarea name="desc1"  class="forminputelement" cols="80" id="desc1" /><?=stripslashes($row['desc1'])?></textarea>
          <script>
            CKEDITOR.replace( 'desc1' );
          </script>
        </td>
      </tr>
      <tr class="row1">
        <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Description</span> <span class="redstar">*</span></td>

        <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
      </tr>
      <tr class="row2">
       <td colspan="2" align="left">
        <textarea name="desc2"  class="forminputelement" cols="80" id="desc2" /><?=stripslashes($row['desc2'])?></textarea>
        <script>
          CKEDITOR.replace( 'desc2' );
        </script>
      </td>
    </tr>

    <tr class="row1">
      <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Description1</span> <span class="redstar">*</span></td>

      <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
    </tr>
    <tr class="row2">
     <td colspan="2" align="left">
      <textarea name="desc3"  class="forminputelement" cols="80" id="desc3" /><?=stripslashes($row['desc3'])?></textarea>
      <script>
        CKEDITOR.replace( 'desc3' );
      </script>
    </td>
  </tr>

  <tr>

    <td align="center" colspan="2">
      <a class="brownbttn" href="content.php?show=viewPrivacy&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>
      <input type="submit" name="Save" id="Save" value="Save" class="loginbttn" />
    </td>
  </tr>
</tbody>
</table>
</form>
<?  }

if($show=='editContact'){
  $sql="SELECT * FROM ".$cfg['DB_CONTACT_US']." WHERE `siteId`='".$cfg['SESSION_SITE']."' and id =2";
  $res=$heart->sql_query($sql);
  $row=$heart->sql_fetchrow($res);

  ?>
  <form action="content_process.php" method="post" name="frm" id="frm" enctype="multipart/form-data">
    <p>
      <input type="hidden" name="act" value="updateContact" />
      <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
    </p>
    <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
      <thead>
        <tr>
          <td colspan="2" align="left" class="style2">&nbsp;Edit Page Section </td>
        </tr>
      </thead>
      <tbody>
       <tr class="row1">
        <td colspan="2" align="left" class="redbuttonelements"><?=@$msg?></td>
      </tr>
      <tr class="row2">
        <td width="30%" align="left" class="leftBarText_new">Page Heading</td>
        <td align="left"><input name="pageheading" type="text" class="forminputelement" id="pageheading" value="<?=stripslashes($row['heading'])?>" style="width:60%"/></td>
      </tr>
      <tr class="row2">
        <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Banner Image</span> </td>
        <td width="70%" colspan="4" align="left" valign="top"><input name="image" id="image" type="file" class="forminputelement"/>
          &nbsp;&nbsp; <img src="../images/<?=$row['image']?>"  width="70" align="top"/></td>
        </tr> 
        <tr class="row2">
          <td width="30%" align="left" class="leftBarText_new">Image Alt Tag</td>
          <td align="left"><input name="imgAlt" type="text" class="forminputelement" id="imgAlt" value="<?=stripslashes($row['imgAlt'])?>" style="width:60%"/></td>
        </tr>
        <tr class="row1">
          <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Address</span> <span class="redstar">*</span></td>

          <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr class="row2">
         <td colspan="2" align="left">
          <textarea name="address"  class="forminputelement" cols="80" id="address" /><?=stripslashes($row['address'])?></textarea>
          <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'address' );
                  </script>
                </td>
              </tr>
              <tr class="row1">
                <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Address2</span> <span class="redstar">*</span></td>

                <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
              </tr>
              <tr class="row2">
               <td colspan="2" align="left">
                <textarea name="address2"  class="forminputelement" cols="80" id="address2" /><?=stripslashes($row['address2'])?></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'address2' );
                  </script>
                </td>
              </tr>

              <tr class="row1">
                <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Address3</span> <span class="redstar">*</span></td>

                <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
              </tr>
              <tr class="row2">
               <td colspan="2" align="left">
                <textarea name="address3"  class="forminputelement" cols="80" id="address3" /><?=stripslashes($row['address3'])?></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'address3' );
                  </script>
                </td>
              </tr>

              <tr class="row1">
                <td width="30%" align="left" class="leftBarText_new">Phone1</td>
                <td align="left"><input name="phone1" type="tel" class="forminputelement" id="phone1" value="<?=stripslashes($row['phone1'])?>" /></td>
              </tr> 
              <tr class="row1">
                <td width="30%" align="left" class="leftBarText_new">Phone1</td>
                <td align="left"><input name="phone2" type="tel" class="forminputelement" id="phone2" value="<?=stripslashes($row['phone2'])?>" /></td>
              </tr>
              <tr class="row2">
                <td width="30%" align="left" class="leftBarText_new">Tel</td>
                <td align="left"><input name="tel" type="tel" class="forminputelement" id="tel" value="<?=stripslashes($row['tel'])?>" /></td>
              </tr>
              <tr class="row1">
                <td width="30%" align="left" class="leftBarText_new">Email</td>
                <td align="left"><input name="email" type="tel" class="forminputelement" id="email" value="<?=stripslashes($row['email'])?>" /></td>
              </tr>
              <tr class="row2">
                <td width="30%" align="left" class="leftBarText_new">Order Email</td>
                <td align="left"><input name="order_email" type="tel" class="forminputelement" id="order_email" value="<?=stripslashes($row['order_email'])?>" /></td>
              </tr>
              <tr class="row1">
                <td width="30%" align="left" class="leftBarText_new">Manage Email</td>
                <td align="left"><input name="manager_email" type="tel" class="forminputelement" id="manager_email" value="<?=stripslashes($row['manager_email'])?>" /></td>
              </tr> 


              <tr>

                <td align="center" colspan="2">
                  <a class="brownbttn" href="content.php?show=viewContact&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>
                  <input type="submit" name="Save" id="Save" value="Save" class="loginbttn" />
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      <?  }
	  // show edit window
      if($show=='edit'){
       $sql="SELECT * FROM ".$cfg['DB_PRODUCT_ABOUTUS']." WHERE `siteId`='".$cfg['SESSION_SITE']."' and id =1";
       $res=$heart->sql_query($sql);
       $row=$heart->sql_fetchrow($res);

       ?>
       <form action="content_process.php" method="post" name="frm" id="frm" enctype="multipart/form-data">
        <p>
          <input type="hidden" name="act" value="update" />
          <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" />
        </p>
        <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="2" align="left" class="style2">&nbsp;Edit Page Section </td>
            </tr>
          </thead>
          <tbody>
           <tr class="row1">
            <td colspan="2" align="left" class="redbuttonelements"><?=@$msg?></td>
          </tr>
          <tr class="row2">
            <td width="30%" align="left" class="leftBarText_new">Page Heading</td>
            <td align="left"><input name="pageheading" type="text" class="forminputelement" id="pageheading" value="<?=stripslashes($row['title1'])?>" /></td>
          </tr>
          <tr class="row2">
            <td width="30%" align="left" class="leftBarText_new">Title</td>
            <td align="left"><input name="title" type="text" class="forminputelement" id="title" value="<?=stripslashes($row['title2'])?>" /></td>
          </tr>
          <tr class="row1">
            <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Content English</span> <span class="redstar">*</span></td>

            <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
          </tr>
          <tr class="row2">
           <td colspan="2" align="left">
            <textarea name="description1"  class="forminputelement" cols="80" id="description1" /><?=stripslashes($row['desc1'])?></textarea>
            <script>

                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description1' );
                  </script>
                </td>
              </tr>

              <tr class="row2">
               <td colspan="2" align="left">
                <textarea name="description2"  class="forminputelement" cols="80" id="description2" /><?=stripslashes($row['desc2'])?></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description2' );
                  </script>
                </td>
              </tr>

              <tr class="row2">
                <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Change Image1 </span> </td>
                <td width="70%" colspan="4" align="left" valign="top"><input name="image1_add" id="image1_add" type="file" class="forminputelement"/>
                  &nbsp;&nbsp; <img src="../images/<?=$row['image1']?>"  width="70" align="top"/></td>
                </tr> 
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Change Image2 </span> </td>
                  <td width="70%" colspan="4" align="left" valign="top"><input name="image2_add" id="image2_add" type="file" class="forminputelement"/>
                    &nbsp;&nbsp; <img src="../images/<?=$row['image2']?>"  width="70" align="top"/></td>
                  </tr> 


                  <tr>

                    <td align="center" colspan="2">
                      <a class="brownbttn" href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>
                      <input type="submit" name="Save" id="Save" value="Save" class="loginbttn" />
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          <?  } 

          if($show=='editClient'){
            $sql="SELECT * FROM ".$cfg['DB_CLIENT_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' and id =1";
            $res  = $heart->sql_query($sql);
            $row  = $heart->sql_fetchrow($res);

            ?>
            <form action="content_process.php" method="post" name="frm" id="frm" enctype="multipart/form-data">
              <p>
                <input type="hidden" name="act" value="updateClientBanner" />
                <input type="hidden" name="id" value="<?=$row['id']?>" />
                <input type="hidden" name="redirect_id" value="<?=$_GET['id']?>" />
              </p>
              <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="2" align="left" class="style2">&nbsp;Edit Page Section </td>
                  </tr>
                </thead>
                <tbody>
                 <tr class="row1">
                  <td colspan="2" align="left" class="redbuttonelements"><?=@$msg?></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Page Heading</td>
                  <td align="left"><input name="pageheading" type="text" class="forminputelement" id="pageheading" value="<?=stripslashes($row['pageHeading'])?>" readonly/></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Banner Title</td>
                  <td align="left"><input name="BannerTitle" type="text" class="forminputelement" id="BannerTitle" value="<?=stripslashes($row['BannerTitle'])?>" /></td>
                </tr>
        <!-- <tr class="row1">
          <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Content English</span> <span class="redstar">*</span></td>
          
          <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr class="row2">
         <td colspan="2" align="left">
          <textarea name="description1"  class="forminputelement" cols="80" id="description1" /><?=stripslashes($row['desc1'])?></textarea>
          <script>

                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description1' );
                  </script>
                </td>
              </tr>

              <tr class="row2">
               <td colspan="2" align="left">
                <textarea name="description2"  class="forminputelement" cols="80" id="description2" /><?=stripslashes($row['desc2'])?></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description2' );
                  </script>
                </td>
              </tr>
            -->
            <tr class="row2">
              <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Banner Image </span> </td>
              <td width="70%" colspan="4" align="left" valign="top"><input name="image" id="image" type="file" class="forminputelement"/>
                &nbsp;&nbsp; <img src="../images/<?=$row['bannerImg']?>"  width="70" align="top"/></td>
              </tr> 
              <tr class="row2">
                <td width="30%" align="left" class="leftBarText_new">Alt Tag</td>
                <td align="left"><input name="altTag" type="text" class="forminputelement" id="altTag" value="<?=stripslashes($row['altTag'])?>" /></td>
              </tr>
              <tr>

                <td align="center" colspan="2">
                  <a class="brownbttn" href="content.php">&lt;&lt;back</a>
                  <input type="submit" name="Save" id="Save" value="Save" class="loginbttn" />
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      <?php } 

      if($show=='editPortfollio'){
            $sql="SELECT * FROM ".$cfg['DB_PORTFOLIO_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' and id =1";
            $res  = $heart->sql_query($sql);
            $row  = $heart->sql_fetchrow($res);
            
            ?>
            <form action="content_process.php" method="post" name="frm" id="frm" enctype="multipart/form-data">
              <p>
                <input type="hidden" name="act" value="updatePortfollioBanner" />
                <input type="hidden" name="id" value="<?=$row['id']?>" />
                <input type="hidden" name="redirect_id" value="<?=$_GET['id']?>" />
              </p>
              <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="2" align="left" class="style2">&nbsp;Edit Page Section </td>
                  </tr>
                </thead>
                <tbody>
                 <tr class="row1">
                  <td colspan="2" align="left" class="redbuttonelements"><?=@$msg?></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Page Heading</td>
                  <td align="left"><input name="pageheading" type="text" class="forminputelement" id="pageheading" value="<?=stripslashes($row['pageHeading'])?>" readonly/></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Banner Title</td>
                  <td align="left"><input name="BannerTitle" type="text" class="forminputelement" id="BannerTitle" value="<?=stripslashes($row['BannerTitle'])?>" /></td>
                </tr>
        <!-- <tr class="row1">
          <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Content English</span> <span class="redstar">*</span></td>
          
          <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr class="row2">
         <td colspan="2" align="left">
          <textarea name="description1"  class="forminputelement" cols="80" id="description1" /><?=stripslashes($row['desc1'])?></textarea>
          <script>

                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description1' );
                  </script>
                </td>
              </tr>

              <tr class="row2">
               <td colspan="2" align="left">
                <textarea name="description2"  class="forminputelement" cols="80" id="description2" /><?=stripslashes($row['desc2'])?></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description2' );
                  </script>
                </td>
              </tr>
            -->
            <tr class="row2">
              <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Banner Image </span> </td>
              <td width="70%" colspan="4" align="left" valign="top"><input name="image" id="image" type="file" class="forminputelement"/>
                &nbsp;&nbsp; <img src="../images/<?=$row['bannerImg']?>"  width="70" align="top"/></td>
              </tr> 
              <tr class="row2">
                <td width="30%" align="left" class="leftBarText_new">Alt Tag</td>
                <td align="left"><input name="altTag" type="text" class="forminputelement" id="altTag" value="<?=stripslashes($row['altTag'])?>" /></td>
              </tr>
              <tr>
                
                <td align="center" colspan="2">
                  <a class="brownbttn" href="content.php">&lt;&lt;back</a>
                  <input type="submit" name="Save" id="Save" value="Save" class="loginbttn" />
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      <?php } 

       if($show =='editTechSupport'){
            $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' and id =1 and `bannerType`='tech-support'";
            $res  = $heart->sql_query($sql);
            $row  = $heart->sql_fetchrow($res);
            
            ?>
            <form action="content_process.php" method="post" name="frm" id="frm" enctype="multipart/form-data">
              <p>
                <input type="hidden" name="act" value="updateTechSupportBanner" />
                <input type="hidden" name="id" value="<?=$row['id']?>" />
                <input type="hidden" name="redirect_id" value="<?=$_GET['id']?>" />
              </p>
              <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="2" align="left" class="style2">&nbsp;Edit Page Section </td>
                  </tr>
                </thead>
                <tbody>
                 <tr class="row1">
                  <td colspan="2" align="left" class="redbuttonelements"><?=@$msg?></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Page Heading</td>
                  <td align="left"><input name="pageheading" type="text" class="forminputelement" id="pageheading" value="<?=stripslashes($row['pageHeading'])?>" readonly/></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Banner Title</td>
                  <td align="left"><input name="BannerTitle" type="text" class="forminputelement" id="BannerTitle" value="<?=stripslashes($row['BannerTitle'])?>" /></td>
                </tr>
        <!-- <tr class="row1">
          <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Content English</span> <span class="redstar">*</span></td>
          
          <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr class="row2">
         <td colspan="2" align="left">
          <textarea name="description1"  class="forminputelement" cols="80" id="description1" /><?=stripslashes($row['desc1'])?></textarea>
          <script>

                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description1' );
                  </script>
                </td>
              </tr>

              <tr class="row2">
               <td colspan="2" align="left">
                <textarea name="description2"  class="forminputelement" cols="80" id="description2" /><?=stripslashes($row['desc2'])?></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description2' );
                  </script>
                </td>
              </tr>
            -->
            <tr class="row2">
              <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Banner Image </span> </td>
              <td width="70%" colspan="4" align="left" valign="top"><input name="image" id="image" type="file" class="forminputelement"/>
                &nbsp;&nbsp; <img src="../images/<?=$row['bannerImg']?>"  width="70" align="top"/></td>
              </tr> 
              <tr class="row2">
                <td width="30%" align="left" class="leftBarText_new">Alt Tag</td>
                <td align="left"><input name="altTag" type="text" class="forminputelement" id="altTag" value="<?=stripslashes($row['altTag'])?>" /></td>
              </tr>
              <tr>
                
                <td align="center" colspan="2">
                  <a class="brownbttn" href="content.php">&lt;&lt;back</a>
                  <input type="submit" name="Save" id="Save" value="Save" class="loginbttn" />
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      <?php }

      if($show =='editIt-service'){
            $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' and `id` = 2 and `bannerType`='it-services'";
            $res  = $heart->sql_query($sql);
            $row  = $heart->sql_fetchrow($res);
            
            ?>
            <form action="content_process.php" method="post" name="frm" id="frm" enctype="multipart/form-data">
              <p>
                <input type="hidden" name="act" value="updateIt-ServiceBanner" />
                <input type="hidden" name="id" value="<?=$row['id']?>" />
                <input type="hidden" name="redirect_id" value="<?=$_GET['id']?>" />
              </p>
              <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="2" align="left" class="style2">&nbsp;Edit Page Section </td>
                  </tr>
                </thead>
                <tbody>
                 <tr class="row1">
                  <td colspan="2" align="left" class="redbuttonelements"><?=@$msg?></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Page Heading</td>
                  <td align="left"><input name="pageheading" type="text" class="forminputelement" id="pageheading" value="<?=stripslashes($row['pageHeading'])?>" readonly/></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Banner Title</td>
                  <td align="left"><input name="BannerTitle" type="text" class="forminputelement" id="BannerTitle" value="<?=stripslashes($row['BannerTitle'])?>" /></td>
                </tr>
        <!-- <tr class="row1">
          <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Content English</span> <span class="redstar">*</span></td>
          
          <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr class="row2">
         <td colspan="2" align="left">
          <textarea name="description1"  class="forminputelement" cols="80" id="description1" /><?=stripslashes($row['desc1'])?></textarea>
          <script>

                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description1' );
                  </script>
                </td>
              </tr>

              <tr class="row2">
               <td colspan="2" align="left">
                <textarea name="description2"  class="forminputelement" cols="80" id="description2" /><?=stripslashes($row['desc2'])?></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description2' );
                  </script>
                </td>
              </tr>
            -->
            <tr class="row2">
              <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Banner Image </span> </td>
              <td width="70%" colspan="4" align="left" valign="top"><input name="image" id="image" type="file" class="forminputelement"/>
                &nbsp;&nbsp; <img src="../images/<?=$row['bannerImg']?>"  width="70" align="top"/></td>
              </tr> 
              <tr class="row2">
                <td width="30%" align="left" class="leftBarText_new">Alt Tag</td>
                <td align="left"><input name="altTag" type="text" class="forminputelement" id="altTag" value="<?=stripslashes($row['altTag'])?>" /></td>
              </tr>
              <tr>
                
                <td align="center" colspan="2">
                  <a class="brownbttn" href="content.php">&lt;&lt;back</a>
                  <input type="submit" name="Save" id="Save" value="Save" class="loginbttn" />
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      <?php } 

      if($show =='editComputer-service'){
            $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' and `id` = 3 and `bannerType`='computer-services'";
            $res  = $heart->sql_query($sql);
            $row  = $heart->sql_fetchrow($res);
            
            ?>
            <form action="content_process.php" method="post" name="frm" id="frm" enctype="multipart/form-data">
              <p>
                <input type="hidden" name="act" value="update_ComputerTraining_Banner" />
                <input type="hidden" name="id" value="<?=$row['id']?>" />
                <input type="hidden" name="redirect_id" value="<?=$_GET['id']?>" />
              </p>
              <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="2" align="left" class="style2">&nbsp;Edit Page Section </td>
                  </tr>
                </thead>
                <tbody>
                 <tr class="row1">
                  <td colspan="2" align="left" class="redbuttonelements"><?=@$msg?></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Page Heading</td>
                  <td align="left"><input name="pageheading" type="text" class="forminputelement" id="pageheading" value="<?=stripslashes($row['pageHeading'])?>" readonly/></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Banner Title</td>
                  <td align="left"><input name="BannerTitle" type="text" class="forminputelement" id="BannerTitle" value="<?=stripslashes($row['BannerTitle'])?>" /></td>
                </tr>
        <!-- <tr class="row1">
          <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Content English</span> <span class="redstar">*</span></td>
          
          <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr class="row2">
         <td colspan="2" align="left">
          <textarea name="description1"  class="forminputelement" cols="80" id="description1" /><?=stripslashes($row['desc1'])?></textarea>
          <script>

                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description1' );
                  </script>
                </td>
              </tr>

              <tr class="row2">
               <td colspan="2" align="left">
                <textarea name="description2"  class="forminputelement" cols="80" id="description2" /><?=stripslashes($row['desc2'])?></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description2' );
                  </script>
                </td>
              </tr>
            -->
            <tr class="row2">
              <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Banner Image </span> </td>
              <td width="70%" colspan="4" align="left" valign="top"><input name="image" id="image" type="file" class="forminputelement"/>
                &nbsp;&nbsp; <img src="../images/<?=$row['bannerImg']?>"  width="70" align="top"/></td>
              </tr> 
              <tr class="row2">
                <td width="30%" align="left" class="leftBarText_new">Alt Tag</td>
                <td align="left"><input name="altTag" type="text" class="forminputelement" id="altTag" value="<?=stripslashes($row['altTag'])?>" /></td>
              </tr>
              <tr>
                
                <td align="center" colspan="2">
                  <a class="brownbttn" href="content.php">&lt;&lt;back</a>
                  <input type="submit" name="Save" id="Save" value="Save" class="loginbttn" />
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      <?php }
      if($show =='editMobile-development'){
            $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' and `id` = 4 and `bannerType`='mobile-development'";
            $res  = $heart->sql_query($sql);
            $row  = $heart->sql_fetchrow($res);
            
            ?>
            <form action="content_process.php" method="post" name="frm" id="frm" enctype="multipart/form-data">
              <p>
                <input type="hidden" name="act" value="update_MobileDevelopment_banner" />
                <input type="hidden" name="id" value="<?=$row['id']?>" />
                <input type="hidden" name="redirect_id" value="<?=$_GET['id']?>" />
              </p>
              <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="2" align="left" class="style2">&nbsp;Edit Page Section </td>
                  </tr>
                </thead>
                <tbody>
                 <tr class="row1">
                  <td colspan="2" align="left" class="redbuttonelements"><?=@$msg?></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Page Heading</td>
                  <td align="left"><input name="pageheading" type="text" class="forminputelement" id="pageheading" value="<?=stripslashes($row['pageHeading'])?>" readonly/></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Banner Title</td>
                  <td align="left"><input name="BannerTitle" type="text" class="forminputelement" id="BannerTitle" value="<?=stripslashes($row['BannerTitle'])?>" /></td>
                </tr>
        <!-- <tr class="row1">
          <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Content English</span> <span class="redstar">*</span></td>
          
          <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr class="row2">
         <td colspan="2" align="left">
          <textarea name="description1"  class="forminputelement" cols="80" id="description1" /><?=stripslashes($row['desc1'])?></textarea>
          <script>

                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description1' );
                  </script>
                </td>
              </tr>

              <tr class="row2">
               <td colspan="2" align="left">
                <textarea name="description2"  class="forminputelement" cols="80" id="description2" /><?=stripslashes($row['desc2'])?></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description2' );
                  </script>
                </td>
              </tr>
            -->
            <tr class="row2">
              <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Banner Image </span> </td>
              <td width="70%" colspan="4" align="left" valign="top"><input name="image" id="image" type="file" class="forminputelement"/>
                &nbsp;&nbsp; <img src="../images/<?=$row['bannerImg']?>"  width="70" align="top"/></td>
              </tr> 
              <tr class="row2">
                <td width="30%" align="left" class="leftBarText_new">Alt Tag</td>
                <td align="left"><input name="altTag" type="text" class="forminputelement" id="altTag" value="<?=stripslashes($row['altTag'])?>" /></td>
              </tr>
              <tr>
                
                <td align="center" colspan="2">
                  <a class="brownbttn" href="content.php">&lt;&lt;back</a>
                  <input type="submit" name="Save" id="Save" value="Save" class="loginbttn" />
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      <?php } 

      if($show =='editEcommerce-development'){
            $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' and `id` = 5 and `bannerType`='ecommerce-development'";
            $res  = $heart->sql_query($sql);
            $row  = $heart->sql_fetchrow($res);
            
            ?>
            <form action="content_process.php" method="post" name="frm" id="frm" enctype="multipart/form-data">
              <p>
                <input type="hidden" name="act" value="update_EcommerceDevelopment_banner" />
                <input type="hidden" name="id" value="<?=$row['id']?>" />
                <input type="hidden" name="redirect_id" value="<?=$_GET['id']?>" />
              </p>
              <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="2" align="left" class="style2">&nbsp;Edit Page Section </td>
                  </tr>
                </thead>
                <tbody>
                 <tr class="row1">
                  <td colspan="2" align="left" class="redbuttonelements"><?=@$msg?></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Page Heading</td>
                  <td align="left"><input name="pageheading" type="text" class="forminputelement" id="pageheading" value="<?=stripslashes($row['pageHeading'])?>" readonly/></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Banner Title</td>
                  <td align="left"><input name="BannerTitle" type="text" class="forminputelement" id="BannerTitle" value="<?=stripslashes($row['BannerTitle'])?>" /></td>
                </tr>
        <!-- <tr class="row1">
          <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Content English</span> <span class="redstar">*</span></td>
          
          <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr class="row2">
         <td colspan="2" align="left">
          <textarea name="description1"  class="forminputelement" cols="80" id="description1" /><?=stripslashes($row['desc1'])?></textarea>
          <script>

                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description1' );
                  </script>
                </td>
              </tr>

              <tr class="row2">
               <td colspan="2" align="left">
                <textarea name="description2"  class="forminputelement" cols="80" id="description2" /><?=stripslashes($row['desc2'])?></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description2' );
                  </script>
                </td>
              </tr>
            -->
            <tr class="row2">
              <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Banner Image </span> </td>
              <td width="70%" colspan="4" align="left" valign="top"><input name="image" id="image" type="file" class="forminputelement"/>
                &nbsp;&nbsp; <img src="../images/<?=$row['bannerImg']?>"  width="70" align="top"/></td>
              </tr> 
              <tr class="row2">
                <td width="30%" align="left" class="leftBarText_new">Alt Tag</td>
                <td align="left"><input name="altTag" type="text" class="forminputelement" id="altTag" value="<?=stripslashes($row['altTag'])?>" /></td>
              </tr>
              <tr>
                
                <td align="center" colspan="2">
                  <a class="brownbttn" href="content.php">&lt;&lt;back</a>
                  <input type="submit" name="Save" id="Save" value="Save" class="loginbttn" />
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      <?php }

        if($show =='editWeb-designing'){
            $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' and `id` = 6 and `bannerType`='web-designing'";
            $res  = $heart->sql_query($sql);
            $row  = $heart->sql_fetchrow($res);
            
            ?>
            <form action="content_process.php" method="post" name="frm" id="frm" enctype="multipart/form-data">
              <p>
                <input type="hidden" name="act" value="update_WebDesigning_banner" />
                <input type="hidden" name="id" value="<?=$row['id']?>" />
                <input type="hidden" name="redirect_id" value="<?=$_GET['id']?>" />
              </p>
              <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="2" align="left" class="style2">&nbsp;Edit Page Section </td>
                  </tr>
                </thead>
                <tbody>
                 <tr class="row1">
                  <td colspan="2" align="left" class="redbuttonelements"><?=@$msg?></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Page Heading</td>
                  <td align="left"><input name="pageheading" type="text" class="forminputelement" id="pageheading" value="<?=stripslashes($row['pageHeading'])?>" readonly/></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Banner Title</td>
                  <td align="left"><input name="BannerTitle" type="text" class="forminputelement" id="BannerTitle" value="<?=stripslashes($row['BannerTitle'])?>" /></td>
                </tr>
        <!-- <tr class="row1">
          <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Content English</span> <span class="redstar">*</span></td>
          
          <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr class="row2">
         <td colspan="2" align="left">
          <textarea name="description1"  class="forminputelement" cols="80" id="description1" /><?=stripslashes($row['desc1'])?></textarea>
          <script>

                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description1' );
                  </script>
                </td>
              </tr>

              <tr class="row2">
               <td colspan="2" align="left">
                <textarea name="description2"  class="forminputelement" cols="80" id="description2" /><?=stripslashes($row['desc2'])?></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description2' );
                  </script>
                </td>
              </tr>
            -->
            <tr class="row2">
              <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Banner Image </span> </td>
              <td width="70%" colspan="4" align="left" valign="top"><input name="image" id="image" type="file" class="forminputelement"/>
                &nbsp;&nbsp; <img src="../images/<?=$row['bannerImg']?>"  width="70" align="top"/></td>
              </tr> 
              <tr class="row2">
                <td width="30%" align="left" class="leftBarText_new">Alt Tag</td>
                <td align="left"><input name="altTag" type="text" class="forminputelement" id="altTag" value="<?=stripslashes($row['altTag'])?>" /></td>
              </tr>
              <tr>
                
                <td align="center" colspan="2">
                  <a class="brownbttn" href="content.php">&lt;&lt;back</a>
                  <input type="submit" name="Save" id="Save" value="Save" class="loginbttn" />
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      <?php }

        if($show =='editWeb-development'){
            $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' and `id` = 7 and `bannerType`='web-development'";
            $res  = $heart->sql_query($sql);
            $row  = $heart->sql_fetchrow($res);
            
            ?>
            <form action="content_process.php" method="post" name="frm" id="frm" enctype="multipart/form-data">
              <p>
                <input type="hidden" name="act" value="update_WebDevelopment_banner" />
                <input type="hidden" name="id" value="<?=$row['id']?>" />
                <input type="hidden" name="redirect_id" value="<?=$_GET['id']?>" />
              </p>
              <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="2" align="left" class="style2">&nbsp;Edit Page Section </td>
                  </tr>
                </thead>
                <tbody>
                 <tr class="row1">
                  <td colspan="2" align="left" class="redbuttonelements"><?=@$msg?></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Page Heading</td>
                  <td align="left"><input name="pageheading" type="text" class="forminputelement" id="pageheading" value="<?=stripslashes($row['pageHeading'])?>" readonly/></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Banner Title</td>
                  <td align="left"><input name="BannerTitle" type="text" class="forminputelement" id="BannerTitle" value="<?=stripslashes($row['BannerTitle'])?>" /></td>
                </tr>
        <!-- <tr class="row1">
          <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Content English</span> <span class="redstar">*</span></td>
          
          <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr class="row2">
         <td colspan="2" align="left">
          <textarea name="description1"  class="forminputelement" cols="80" id="description1" /><?=stripslashes($row['desc1'])?></textarea>
          <script>

                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description1' );
                  </script>
                </td>
              </tr>

              <tr class="row2">
               <td colspan="2" align="left">
                <textarea name="description2"  class="forminputelement" cols="80" id="description2" /><?=stripslashes($row['desc2'])?></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description2' );
                  </script>
                </td>
              </tr>
            -->
            <tr class="row2">
              <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Banner Image </span> </td>
              <td width="70%" colspan="4" align="left" valign="top"><input name="image" id="image" type="file" class="forminputelement"/>
                &nbsp;&nbsp; <img src="../images/<?=$row['bannerImg']?>"  width="70" align="top"/></td>
              </tr> 
              <tr class="row2">
                <td width="30%" align="left" class="leftBarText_new">Alt Tag</td>
                <td align="left"><input name="altTag" type="text" class="forminputelement" id="altTag" value="<?=stripslashes($row['altTag'])?>" /></td>
              </tr>
              <tr>
                
                <td align="center" colspan="2">
                  <a class="brownbttn" href="content.php">&lt;&lt;back</a>
                  <input type="submit" name="Save" id="Save" value="Save" class="loginbttn" />
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      <?php }

        if($show =='editSoftware-development'){
            $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' and `id` = 8 and `bannerType`='software-development'";
            $res  = $heart->sql_query($sql);
            $row  = $heart->sql_fetchrow($res);
            
            ?>
            <form action="content_process.php" method="post" name="frm" id="frm" enctype="multipart/form-data">
              <p>
                <input type="hidden" name="act" value="update_SoftwareDevelopment_banner" />
                <input type="hidden" name="id" value="<?=$row['id']?>" />
                <input type="hidden" name="redirect_id" value="<?=$_GET['id']?>" />
              </p>
              <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="2" align="left" class="style2">&nbsp;Edit Page Section </td>
                  </tr>
                </thead>
                <tbody>
                 <tr class="row1">
                  <td colspan="2" align="left" class="redbuttonelements"><?=@$msg?></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Page Heading</td>
                  <td align="left"><input name="pageheading" type="text" class="forminputelement" id="pageheading" value="<?=stripslashes($row['pageHeading'])?>" readonly/></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Banner Title</td>
                  <td align="left"><input name="BannerTitle" type="text" class="forminputelement" id="BannerTitle" value="<?=stripslashes($row['BannerTitle'])?>" /></td>
                </tr>
        <!-- <tr class="row1">
          <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Content English</span> <span class="redstar">*</span></td>
          
          <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr class="row2">
         <td colspan="2" align="left">
          <textarea name="description1"  class="forminputelement" cols="80" id="description1" /><?=stripslashes($row['desc1'])?></textarea>
          <script>

                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description1' );
                  </script>
                </td>
              </tr>

              <tr class="row2">
               <td colspan="2" align="left">
                <textarea name="description2"  class="forminputelement" cols="80" id="description2" /><?=stripslashes($row['desc2'])?></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description2' );
                  </script>
                </td>
              </tr>
            -->
            <tr class="row2">
              <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Banner Image </span> </td>
              <td width="70%" colspan="4" align="left" valign="top"><input name="image" id="image" type="file" class="forminputelement"/>
                &nbsp;&nbsp; <img src="../images/<?=$row['bannerImg']?>"  width="70" align="top"/></td>
              </tr> 
              <tr class="row2">
                <td width="30%" align="left" class="leftBarText_new">Alt Tag</td>
                <td align="left"><input name="altTag" type="text" class="forminputelement" id="altTag" value="<?=stripslashes($row['altTag'])?>" /></td>
              </tr>
              <tr>
                
                <td align="center" colspan="2">
                  <a class="brownbttn" href="content.php">&lt;&lt;back</a>
                  <input type="submit" name="Save" id="Save" value="Save" class="loginbttn" />
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      <?php }

      if($show =='editCodeigniter-development'){
            $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' and `id` = 9 and `bannerType`='codeigniter-development'";
            $res  = $heart->sql_query($sql);
            $row  = $heart->sql_fetchrow($res);
            
            ?>
            <form action="content_process.php" method="post" name="frm" id="frm" enctype="multipart/form-data">
              <p>
                <input type="hidden" name="act" value="update_CodeigniterDevelopment_banner" />
                <input type="hidden" name="id" value="<?=$row['id']?>" />
                <input type="hidden" name="redirect_id" value="<?=$_GET['id']?>" />
              </p>
              <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
                <thead>
                  <tr>
                    <td colspan="2" align="left" class="style2">&nbsp;Edit Page Section </td>
                  </tr>
                </thead>
                <tbody>
                 <tr class="row1">
                  <td colspan="2" align="left" class="redbuttonelements"><?=@$msg?></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Page Heading</td>
                  <td align="left"><input name="pageheading" type="text" class="forminputelement" id="pageheading" value="<?=stripslashes($row['pageHeading'])?>" readonly/></td>
                </tr>
                <tr class="row2">
                  <td width="30%" align="left" class="leftBarText_new">Banner Title</td>
                  <td align="left"><input name="BannerTitle" type="text" class="forminputelement" id="BannerTitle" value="<?=stripslashes($row['BannerTitle'])?>" /></td>
                </tr>
        <!-- <tr class="row1">
          <td class="leftBarText" align="left" valign="top"> <span class="leftBarText_new">Content English</span> <span class="redstar">*</span></td>
          
          <td  class="leftBarText" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr class="row2">
         <td colspan="2" align="left">
          <textarea name="description1"  class="forminputelement" cols="80" id="description1" /><?=stripslashes($row['desc1'])?></textarea>
          <script>

                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description1' );
                  </script>
                </td>
              </tr>

              <tr class="row2">
               <td colspan="2" align="left">
                <textarea name="description2"  class="forminputelement" cols="80" id="description2" /><?=stripslashes($row['desc2'])?></textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'description2' );
                  </script>
                </td>
              </tr>
            -->
            <tr class="row2">
              <td width="30%" align="left" class="leftBarText" valign="top"><span class="leftBarText_new">Banner Image </span> </td>
              <td width="70%" colspan="4" align="left" valign="top"><input name="image" id="image" type="file" class="forminputelement"/>
                &nbsp;&nbsp; <img src="../images/<?=$row['bannerImg']?>"  width="70" align="top"/></td>
              </tr> 
              <tr class="row2">
                <td width="30%" align="left" class="leftBarText_new">Alt Tag</td>
                <td align="left"><input name="altTag" type="text" class="forminputelement" id="altTag" value="<?=stripslashes($row['altTag'])?>" /></td>
              </tr>
              <tr>
                
                <td align="center" colspan="2">
                  <a class="brownbttn" href="content.php">&lt;&lt;back</a>
                  <input type="submit" name="Save" id="Save" value="Save" class="loginbttn" />
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      <?php }


      if($show=='viewTerms'){
     // $cfg['SESSION_SITE'] = 2;

        $sql="SELECT * FROM ".$cfg['DB_TERMS']." WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `status`='A'";
        $res=$heart->sql_query($sql);
        $row=$heart->sql_fetchrow($res);

        ?>
        <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="3" align="left" class="style2">&nbsp;View Page Details Section </td>
            </tr>
          </thead>
          <tbody>

            <tr class="row1">
              <td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
            <tr class="row2">
              <td colspan="3" align="right"><a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="content_process.php?act=edit&amp;id=<?=$row['id']?>">Edit</a></td>
            </tr>

            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Page Heading</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['desc1'])?></td>
            </tr>  
            
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Description1</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['desc2'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Description2</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['desc3'])?></td>
            </tr>        

            <tr class="row2">
              <td class="leftBarText_new" align="left">Status</td>
              <td colspan="2" align="left"><?=($row['status']=='A')?'Active':'Inactive'?></td>
            </tr>
            <tr>
              <td colspan="3" align="center" >&nbsp;<!--<a href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>--></td>
            </tr>
          </tbody>
        </table>

      <? }

      if($show=='viewClient'){
     // $cfg['SESSION_SITE'] = 2;
        $sql="SELECT * FROM ".$cfg['DB_CLIENT_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `status`='A'";
        $res=$heart->sql_query($sql);
        $row=$heart->sql_fetchrow($res);

        ?>
        <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="3" align="left" class="style2">&nbsp;View Page Details Section </td>
            </tr>
          </thead>
          <tbody>

            <tr class="row1">
              <td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
            <tr class="row2">
              <td colspan="3" align="right"><a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="content_process.php?act=edit&amp;id=<?=$_GET['id']?>">Edit</a></td>
            </tr>

            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Page Heading</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['pageHeading'])?></td>
            </tr>  
            
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Title</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['BannerTitle'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Image</td>
            </tr>
            
            <tr class="row1">
              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><img src="../images/<?=stripslashes($row['bannerImg']);?>" alt="<?=stripslashes($row['altTag'])?>" style="width:30%;height: auto;"></td>
            </tr>        
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Alt Tag</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['altTag'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left">Status</td>
              <td colspan="2" align="left"><?=($row['status']=='A')?'Active':'Inactive'?></td>
            </tr>
            <tr>
              <td colspan="3" align="center" >&nbsp;<!--<a href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>--></td>
            </tr>
            <tr> 
              <td align="center" colspan="2">
                <a class="brownbttn" href="content.php">&lt;&lt;back</a>

              </td> 
            </tbody>
          </table>

        <? }


        if($show=='viewRefund'){
     // $cfg['SESSION_SITE'] = 2;
          $sql="SELECT * FROM ".$cfg['DB_PRODUCT_REFUND']." WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `status`='A'";
          $res=$heart->sql_query($sql);
          $row=$heart->sql_fetchrow($res);

          ?>
          <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
            <thead>
              <tr>
                <td colspan="3" align="left" class="style2">&nbsp;View Page Details Section </td>
              </tr>
            </thead>
            <tbody>

              <tr class="row1">
                <td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
              </tr>
              <tr class="row2">
                <td colspan="3" align="right"><a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="content_process.php?act=edit&amp;id=<?=$row['id']?>">Edit</a></td>
              </tr>

              <tr class="row2">
                <td class="leftBarText_new" align="left" valign="top" colspan="3"> Page Heading</td>
              </tr>

              <tr class="row1">

                <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['desc1'])?></td>
              </tr>  

              <tr class="row2">
                <td class="leftBarText_new" align="left" valign="top" colspan="3"> Description1</td>
              </tr>

              <tr class="row1">

                <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['desc2'])?></td>
              </tr>
              <tr class="row2">
                <td class="leftBarText_new" align="left" valign="top" colspan="3"> Description2</td>
              </tr>

              <tr class="row1">

                <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['desc3'])?></td>
              </tr>        

              <tr class="row2">
                <td class="leftBarText_new" align="left">Status</td>
                <td colspan="2" align="left"><?=($row['status']=='A')?'Active':'Inactive'?></td>
              </tr>
              <tr>
                <td colspan="3" align="center" >&nbsp;<!--<a href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>--></td>
              </tr>
            </tbody>
          </table>

        <? }

      if($show=='viewPortfollio'){
     // $cfg['SESSION_SITE'] = 2;
        $sql="SELECT * FROM ".$cfg['DB_PORTFOLIO_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `status`='A'";
        $res=$heart->sql_query($sql);
        $row=$heart->sql_fetchrow($res);

        ?>
        <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="3" align="left" class="style2">&nbsp;View Page Details Section </td>
            </tr>
          </thead>
          <tbody>

            <tr class="row1">
              <td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
            <tr class="row2">
              <td colspan="3" align="right"><a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="content_process.php?act=edit&amp;id=<?=$_GET['id']?>">Edit</a></td>
            </tr>

            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Page Heading</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['pageHeading'])?></td>
            </tr>  
            
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Title</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['BannerTitle'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Image</td>
            </tr>
            
            <tr class="row1">
              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><img src="../images/<?=stripslashes($row['bannerImg']);?>" alt="<?=stripslashes($row['altTag'])?>" style="width:30%;height: auto;"></td>
            </tr>        
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Alt Tag</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['altTag'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left">Status</td>
              <td colspan="2" align="left"><?=($row['status']=='A')?'Active':'Inactive'?></td>
            </tr>
            <tr>
              <td colspan="3" align="center" >&nbsp;<!--<a href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>--></td>
            </tr>
            <tr> 
              <td align="center" colspan="2">
                <a class="brownbttn" href="content.php">&lt;&lt;back</a>

              </td> 
            </tbody>
          </table>

        <? }

        if($show=='viewTechSupport'){
    
        $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `status`='A' AND `id`=1 AND `bannerType`='tech-support'";
        $res=$heart->sql_query($sql);
        $row=$heart->sql_fetchrow($res);

        ?>
        <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="3" align="left" class="style2">&nbsp;View Page Details Section </td>
            </tr>
          </thead>
          <tbody>

            <tr class="row1">
              <td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
            <tr class="row2">
              <td colspan="3" align="right"><a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="content_process.php?act=edit&amp;id=<?=$_GET['id']?>">Edit</a></td>
            </tr>

            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Page Heading</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['pageHeading'])?></td>
            </tr>  
            
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Title</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['BannerTitle'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Image</td>
            </tr>
            
            <tr class="row1">
              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><img src="../images/<?=stripslashes($row['bannerImg']);?>" alt="<?=stripslashes($row['altTag'])?>" style="width:30%;height: auto;"></td>
            </tr>        
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Alt Tag</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['altTag'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left">Status</td>
              <td colspan="2" align="left"><?=($row['status']=='A')?'Active':'Inactive'?></td>
            </tr>
            <tr>
              <td colspan="3" align="center" >&nbsp;<!--<a href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>--></td>
            </tr>
            <tr> 
              <td align="center" colspan="2">
                <a class="brownbttn" href="content.php">&lt;&lt;back</a>

              </td> 
            </tbody>
          </table>

        <? }

    if($show=='viewIt-service'){
     // $cfg['SESSION_SITE'] = 2;
        $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `status`='A' AND `id`=2 AND `bannerType`='it-services'";
        $res=$heart->sql_query($sql);
        $row=$heart->sql_fetchrow($res);

        ?>
        <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="3" align="left" class="style2">&nbsp;View Page Details Section </td>
            </tr>
          </thead>
          <tbody>

            <tr class="row1">
              <td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
            <tr class="row2">
              <td colspan="3" align="right"><a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="content_process.php?act=edit&amp;id=<?=$_GET['id']?>">Edit</a></td>
            </tr>

            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Page Heading</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['pageHeading'])?></td>
            </tr>  
            
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Title</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['BannerTitle'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Image</td>
            </tr>
            
            <tr class="row1">
              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><img src="../images/<?=stripslashes($row['bannerImg']);?>" alt="<?=stripslashes($row['altTag'])?>" style="width:30%;height: auto;"></td>
            </tr>        
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Alt Tag</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['altTag'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left">Status</td>
              <td colspan="2" align="left"><?=($row['status']=='A')?'Active':'Inactive'?></td>
            </tr>
            <tr>
              <td colspan="3" align="center" >&nbsp;<!--<a href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>--></td>
            </tr>
            <tr> 
              <td align="center" colspan="2">
                <a class="brownbttn" href="content.php">&lt;&lt;back</a>

              </td> 
            </tbody>
          </table>

        <? }

    if($show=='viewComputer-training'){
     // $cfg['SESSION_SITE'] = 2;
        $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `status`='A' AND `id`=3 AND `bannerType`='computer-services'";
        $res=$heart->sql_query($sql);
        $row=$heart->sql_fetchrow($res);

        ?>
        <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="3" align="left" class="style2">&nbsp;View Page Details Section </td>
            </tr>
          </thead>
          <tbody>

            <tr class="row1">
              <td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
            <tr class="row2">
              <td colspan="3" align="right"><a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="content_process.php?act=edit&amp;id=<?=$_GET['id']?>">Edit</a></td>
            </tr>

            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Page Heading</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['pageHeading'])?></td>
            </tr>  
            
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Title</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['BannerTitle'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Image</td>
            </tr>
            
            <tr class="row1">
              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><img src="../images/<?=stripslashes($row['bannerImg']);?>" alt="<?=stripslashes($row['altTag'])?>" style="width:30%;height: auto;"></td>
            </tr>        
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Alt Tag</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['altTag'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left">Status</td>
              <td colspan="2" align="left"><?=($row['status']=='A')?'Active':'Inactive'?></td>
            </tr>
            <tr>
              <td colspan="3" align="center" >&nbsp;<!--<a href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>--></td>
            </tr>
            <tr> 
              <td align="center" colspan="2">
                <a class="brownbttn" href="content.php">&lt;&lt;back</a>

              </td> 
            </tbody>
          </table>

        <? }


        if($show=='viewRefund'){
     // $cfg['SESSION_SITE'] = 2;
          $sql="SELECT * FROM ".$cfg['DB_PRODUCT_REFUND']." WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `status`='A'";
          $res=$heart->sql_query($sql);
          $row=$heart->sql_fetchrow($res);

          ?>
          <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
            <thead>
              <tr>
                <td colspan="3" align="left" class="style2">&nbsp;View Page Details Section </td>
              </tr>
            </thead>
            <tbody>

              <tr class="row1">
                <td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
              </tr>
              <tr class="row2">
                <td colspan="3" align="right"><a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="content_process.php?act=edit&amp;id=<?=$row['id']?>">Edit</a></td>
              </tr>

              <tr class="row2">
                <td class="leftBarText_new" align="left" valign="top" colspan="3"> Page Heading</td>
              </tr>

              <tr class="row1">

                <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['desc1'])?></td>
              </tr>  

              <tr class="row2">
                <td class="leftBarText_new" align="left" valign="top" colspan="3"> Description1</td>
              </tr>

              <tr class="row1">

                <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['desc2'])?></td>
              </tr>
              <tr class="row2">
                <td class="leftBarText_new" align="left" valign="top" colspan="3"> Description2</td>
              </tr>

              <tr class="row1">

                <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['desc3'])?></td>
              </tr>        

              <tr class="row2">
                <td class="leftBarText_new" align="left">Status</td>
                <td colspan="2" align="left"><?=($row['status']=='A')?'Active':'Inactive'?></td>
              </tr>
              <tr>
                <td colspan="3" align="center" >&nbsp;<!--<a href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>--></td>
              </tr>
            </tbody>
          </table>

        <? }
        
        if($show=='viewPrivacy'){
     // $cfg['SESSION_SITE'] = 2;
          $sql="SELECT * FROM ".$cfg['DB_PRIVACY']." WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `status`='A'";
          $res=$heart->sql_query($sql);
          $row=$heart->sql_fetchrow($res);

          ?>
          <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
            <thead>
              <tr>
                <td colspan="3" align="left" class="style2">&nbsp;View Page Details Section </td>
              </tr>
            </thead>
            <tbody>

              <tr class="row1">
                <td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
              </tr>
              <tr class="row2">
                <td colspan="3" align="right"><a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="content_process.php?act=edit&amp;id=<?=$row['id']?>">Edit</a></td>
              </tr>
              <tr class="row2">
                <td width="30%" align="left" class="leftBarText_new">Page Name</td>
                <td align="left"><?=stripslashes($row['heading'])?></td>
              </tr>

              <tr class="row2">
                <td class="leftBarText_new" align="left" valign="top" colspan="3"> Page Heading</td>
              </tr>

              <tr class="row1">

                <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['desc1'])?></td>
              </tr>  

              <tr class="row2">
                <td class="leftBarText_new" align="left" valign="top" colspan="3"> Description1</td>
              </tr>

              <tr class="row1">

                <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['desc2'])?></td>
              </tr>
              <tr class="row2">
                <td class="leftBarText_new" align="left" valign="top" colspan="3"> Description2</td>
              </tr>

              <tr class="row1">

                <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['desc3'])?></td>
              </tr>        

              <tr class="row2">
                <td class="leftBarText_new" align="left">Status</td>
                <td colspan="2" align="left"><?=($row['status']=='A')?'Active':'Inactive'?></td>
              </tr>
              <tr>
                <td colspan="3" align="center" >&nbsp;<!--<a href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>--></td>
              </tr>
            </tbody>
          </table>

        <? }

        if($show=='viewContact'){
     // $cfg['SESSION_SITE'] = 2;
          $sql="SELECT * FROM ".$cfg['DB_CONTACT_US']." WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `status`='A'";
          $res=$heart->sql_query($sql);
          $row=$heart->sql_fetchrow($res);

          ?>
          <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
            <thead>
              <tr>
                <td colspan="3" align="left" class="style2">&nbsp;View Page Details Section </td>
              </tr>
            </thead>
            <tbody>

              <tr class="row1">
                <td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
              </tr>
              <tr class="row2">
                <td colspan="3" align="right"><a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="content_process.php?act=edit&amp;id=<?=$row['id']?>">Edit</a></td>
              </tr>
              <tr class="row1">
                <td width="17%" align="left" class="leftBarText_new">Page Heading</td>
                <td width="83%" colspan="2" align="left"><?=stripslashes($row['heading'])?></td>
              </tr>

              <tr class="row1">
                <td width="17%" align="left" class="leftBarText_new">Contact Image</td>
                <td width="83%" colspan="2" align="left"><img src="../images/<?php echo $row['image'];?>" alt="" style="width: 35%;height: auto"></td>
              </tr>

              <tr class="row1">
                <td width="17%" align="left" class="leftBarText_new">Image Alt Tag</td>
                <td width="83%" colspan="2" align="left"><?=stripslashes($row['imgAlt'])?></td>
              </tr>

              <tr class="row2">
                <td class="leftBarText_new" align="left" valign="top" colspan="3"> Address</td>
              </tr>

              <tr class="row1">

                <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['address'])?></td>
              </tr>
              <tr class="row2">
                <td class="leftBarText_new" align="left" valign="top" colspan="3"> Address2</td>
              </tr>

              <tr class="row1">
                <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['address2'])?></td>
              </tr>
              <tr class="row2">
                <td class="leftBarText_new" align="left" valign="top" colspan="3"> Address3</td>
              </tr>

              <tr class="row1">

                <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['address3'])?></td>
              </tr>

              <tr class="row1">
                <td width="17%" align="left" class="leftBarText_new">Phone1</td>
                <td width="83%" colspan="2" align="left"><?=stripslashes($row['phone1'])?></td>
              </tr> 
              <tr class="row1">
                <td width="17%" align="left" class="leftBarText_new">Phone2</td>
                <td width="83%" colspan="2" align="left"><?=stripslashes($row['phone2'])?></td>
              </tr> 
              <tr class="row1">
                <td width="17%" align="left" class="leftBarText_new">Tel</td>
                <td width="83%" colspan="2" align="left"><?=stripslashes($row['tel'])?></td>
              </tr>  
              <tr class="row1">
                <td width="17%" align="left" class="leftBarText_new">Email</td>
                <td width="83%" colspan="2" align="left"><?=stripslashes($row['email'])?></td>
              </tr>
              <tr class="row1">
                <td width="17%" align="left" class="leftBarText_new">Order Email</td>
                <td width="83%" colspan="2" align="left"><?=stripslashes($row['order_email'])?></td>
              </tr>
              <tr class="row1">
                <td width="17%" align="left" class="leftBarText_new">Manage Email</td>
                <td width="83%" colspan="2" align="left"><?=stripslashes($row['manager_email'])?></td>
              </tr>        

              <tr class="row2">
                <td class="leftBarText_new" align="left">Status</td>
                <td colspan="2" align="left"><?=($row['status']=='A')?'Active':'Inactive'?></td>
              </tr>
              <tr>
                <td colspan="3" align="center" >&nbsp;<!--<a href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>--></td>
              </tr>
            </tbody>
          </table>

        <? }

        if($show=='view'){
     // $cfg['SESSION_SITE'] = 2;
         $sql="SELECT * FROM ".$cfg['DB_PRODUCT_ABOUTUS']." WHERE `siteId`='".$cfg['SESSION_SITE']."'";
         $res=$heart->sql_query($sql);
         $row=$heart->sql_fetchrow($res);

         ?>
         <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="3" align="left" class="style2">&nbsp;View Page Details Section </td>
            </tr>
          </thead>
          <tbody>

            <tr class="row1">
              <td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
            <tr class="row2">
              <td colspan="3" align="right"><a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="content_process.php?act=edit&amp;id=<?=$row['id']?>">Edit</a></td>
            </tr>
            <tr class="row1">
              <td width="17%" align="left" class="leftBarText_new">Page Heading</td>
              <td width="83%" colspan="2" align="left"><?=stripslashes($row['title1'])?></td>
            </tr>
            <tr class="row1">
              <td width="17%" align="left" class="leftBarText_new">Title</td>
              <td width="83%" colspan="2" align="left"><?=stripslashes($row['title2'])?></td>
            </tr>
            
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Content</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['desc1'])?></td>
            </tr>

            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['desc2'])?></td>
            </tr>

            <tr class="row1">
              <td width="17%" align="left" class="leftBarText_new">Image1</td>

              <td width="83%" colspan="2" align="left"><img src="../images/<?=$row['image1']?>" width="200"></td>
            </tr>
            <tr class="row1">
              <td width="17%" align="left" class="leftBarText_new">Image2</td>

              <td width="83%" colspan="2" align="left"><img src="../images/<?=$row['image2']?>" width="200"></td>
            </tr> 
            

            <tr class="row2">
              <td class="leftBarText_new" align="left">Status</td>
              <td colspan="2" align="left"><?=($row['cmsStatus']=='A')?'Active':'Inactive'?></td>
            </tr>
            <tr>
              <td colspan="3" align="center" >&nbsp;<!--<a href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>--></td>
            </tr>
          </tbody>
        </table>

        <? } 
    if($show=='viewMobile-development'){
     // $cfg['SESSION_SITE'] = 2;
        $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `status`='A' AND `id`= 4 AND `bannerType`='mobile-development'";
        $res=$heart->sql_query($sql);
        $row=$heart->sql_fetchrow($res);

        ?>
        <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="3" align="left" class="style2">&nbsp;View Page Details Section </td>
            </tr>
          </thead>
          <tbody>

            <tr class="row1">
              <td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
            <tr class="row2">
              <td colspan="3" align="right"><a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="content_process.php?act=edit&amp;id=<?=$_GET['id']?>">Edit</a></td>
            </tr>

            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Page Heading</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['pageHeading'])?></td>
            </tr>  
            
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Title</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['BannerTitle'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Image</td>
            </tr>
            
            <tr class="row1">
              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><img src="../images/<?=stripslashes($row['bannerImg']);?>" alt="<?=stripslashes($row['altTag'])?>" style="width:30%;height: auto;"></td>
            </tr>        
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Alt Tag</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['altTag'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left">Status</td>
              <td colspan="2" align="left"><?=($row['status']=='A')?'Active':'Inactive'?></td>
            </tr>
            <tr>
              <td colspan="3" align="center" >&nbsp;<!--<a href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>--></td>
            </tr>
            <tr> 
              <td align="center" colspan="2">
                <a class="brownbttn" href="content.php">&lt;&lt;back</a>

              </td> 
            </tbody>
          </table>

        <? } 
      if($show=='viewEcommerce-development'){
     // $cfg['SESSION_SITE'] = 2;
        $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `status`='A' AND `id`= 5 AND `bannerType`='ecommerce-development'";
        $res=$heart->sql_query($sql);
        $row=$heart->sql_fetchrow($res);

        ?>
        <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="3" align="left" class="style2">&nbsp;View Page Details Section </td>
            </tr>
          </thead>
          <tbody>

            <tr class="row1">
              <td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
            <tr class="row2">
              <td colspan="3" align="right"><a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="content_process.php?act=edit&amp;id=<?=$_GET['id']?>">Edit</a></td>
            </tr>

            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Page Heading</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['pageHeading'])?></td>
            </tr>  
            
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Title</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['BannerTitle'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Image</td>
            </tr>
            
            <tr class="row1">
              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><img src="../images/<?=stripslashes($row['bannerImg']);?>" alt="<?=stripslashes($row['altTag'])?>" style="width:30%;height: auto;"></td>
            </tr>        
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Alt Tag</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['altTag'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left">Status</td>
              <td colspan="2" align="left"><?=($row['status']=='A')?'Active':'Inactive'?></td>
            </tr>
            <tr>
              <td colspan="3" align="center" >&nbsp;<!--<a href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>--></td>
            </tr>
            <tr> 
              <td align="center" colspan="2">
                <a class="brownbttn" href="content.php">&lt;&lt;back</a>

              </td> 
            </tbody>
          </table>

        <? }

     if($show=='viewWeb-designing'){
     // $cfg['SESSION_SITE'] = 2;
        $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `status`='A' AND `id`= 6 AND `bannerType`='web-designing'";
        $res=$heart->sql_query($sql);
        $row=$heart->sql_fetchrow($res);

        ?>
        <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="3" align="left" class="style2">&nbsp;View Page Details Section </td>
            </tr>
          </thead>
          <tbody>

            <tr class="row1">
              <td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
            <tr class="row2">
              <td colspan="3" align="right"><a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="content_process.php?act=edit&amp;id=<?=$_GET['id']?>">Edit</a></td>
            </tr>

            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Page Heading</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['pageHeading'])?></td>
            </tr>  
            
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Title</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['BannerTitle'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Image</td>
            </tr>
            
            <tr class="row1">
              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><img src="../images/<?=stripslashes($row['bannerImg']);?>" alt="<?=stripslashes($row['altTag'])?>" style="width:30%;height: auto;"></td>
            </tr>        
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Alt Tag</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['altTag'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left">Status</td>
              <td colspan="2" align="left"><?=($row['status']=='A')?'Active':'Inactive'?></td>
            </tr>
            <tr>
              <td colspan="3" align="center" >&nbsp;<!--<a href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>--></td>
            </tr>
            <tr> 
              <td align="center" colspan="2">
                <a class="brownbttn" href="content.php">&lt;&lt;back</a>

              </td> 
            </tbody>
          </table>

        <? }      
        if($show=='viewWeb-development') {
        // $cfg['SESSION_SITE'] = 2;
        $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `status`='A' AND `id`= 7 AND `bannerType`='web-development'";
        $res=$heart->sql_query($sql);
        $row=$heart->sql_fetchrow($res);

        ?>
        <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="3" align="left" class="style2">&nbsp;View Page Details Section </td>
            </tr>
          </thead>
          <tbody>

            <tr class="row1">
              <td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
            <tr class="row2">
              <td colspan="3" align="right"><a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="content_process.php?act=edit&amp;id=<?=$_GET['id']?>">Edit</a></td>
            </tr>

            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Page Heading</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['pageHeading'])?></td>
            </tr>  
            
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Title</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['BannerTitle'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Image</td>
            </tr>
            
            <tr class="row1">
              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><img src="../images/<?=stripslashes($row['bannerImg']);?>" alt="<?=stripslashes($row['altTag'])?>" style="width:30%;height: auto;"></td>
            </tr>        
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Alt Tag</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['altTag'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left">Status</td>
              <td colspan="2" align="left"><?=($row['status']=='A')?'Active':'Inactive'?></td>
            </tr>
            <tr>
              <td colspan="3" align="center" >&nbsp;<!--<a href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>--></td>
            </tr>
            <tr> 
              <td align="center" colspan="2">
                <a class="brownbttn" href="content.php">&lt;&lt;back</a>

              </td> 
            </tbody>
          </table>

        <? }
        if($show=='viewSoftware-development') {
        // $cfg['SESSION_SITE'] = 2;
        $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `status`='A' AND `id`= 8 AND `bannerType` = 'software-development'";
        $res=$heart->sql_query($sql);
        $row=$heart->sql_fetchrow($res);

        ?>
        <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="3" align="left" class="style2">&nbsp;View Page Details Section </td>
            </tr>
          </thead>
          <tbody>

            <tr class="row1">
              <td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
            <tr class="row2">
              <td colspan="3" align="right"><a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="content_process.php?act=edit&amp;id=<?=$_GET['id']?>">Edit</a></td>
            </tr>

            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Page Heading</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['pageHeading'])?></td>
            </tr>  
            
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Title</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['BannerTitle'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Image</td>
            </tr>
            
            <tr class="row1">
              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><img src="../images/<?=stripslashes($row['bannerImg']);?>" alt="<?=stripslashes($row['altTag'])?>" style="width:30%;height: auto;"></td>
            </tr>        
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Alt Tag</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['altTag'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left">Status</td>
              <td colspan="2" align="left"><?=($row['status']=='A')?'Active':'Inactive'?></td>
            </tr>
            <tr>
              <td colspan="3" align="center" >&nbsp;<!--<a href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>--></td>
            </tr>
            <tr> 
              <td align="center" colspan="2">
                <a class="brownbttn" href="content.php">&lt;&lt;back</a>

              </td> 
            </tbody>
          </table>

        <? } 
        if($show=='viewCodeigniter-development') {
        // $cfg['SESSION_SITE'] = 2;
        $sql="SELECT * FROM ".$cfg['DB_SERVICE_BANNER']." WHERE `siteId`='".$cfg['SESSION_SITE']."' AND `status`='A' AND `id`= 9 AND `bannerType` = 'codeigniter-development'";
        $res=$heart->sql_query($sql);
        $row=$heart->sql_fetchrow($res);

        ?>
        <table width="98%" align="center" cellpadding="6" cellspacing="1" class="tborder_new">
          <thead>
            <tr>
              <td colspan="3" align="left" class="style2">&nbsp;View Page Details Section </td>
            </tr>
          </thead>
          <tbody>

            <tr class="row1">
              <td colspan="3" align="right" class="redbuttonelements"><?=@$msg?></td>
            </tr>
            <tr class="row2">
              <td colspan="3" align="right"><a class="brownbttn" style="font-size:11px; padding:3px 7px;" href="content_process.php?act=edit&amp;id=<?=$_GET['id']?>">Edit</a></td>
            </tr>

            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Page Heading</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['pageHeading'])?></td>
            </tr>  
            
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Title</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['BannerTitle'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Image</td>
            </tr>
            
            <tr class="row1">
              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><img src="../images/<?=stripslashes($row['bannerImg']);?>" alt="<?=stripslashes($row['altTag'])?>" style="width:30%;height: auto;"></td>
            </tr>        
            <tr class="row2">
              <td class="leftBarText_new" align="left" valign="top" colspan="3"> Banner Alt Tag</td>
            </tr>
            
            <tr class="row1">

              <td colspan="3" align="left" style="padding-left:12px; padding-right:10px;"><?=stripslashes($row['altTag'])?></td>
            </tr>
            <tr class="row2">
              <td class="leftBarText_new" align="left">Status</td>
              <td colspan="2" align="left"><?=($row['status']=='A')?'Active':'Inactive'?></td>
            </tr>
            <tr>
              <td colspan="3" align="center" >&nbsp;<!--<a href="content.php?show=view&id=<?=$_REQUEST['id']?>">&lt;&lt;back</a>--></td>
            </tr>
            <tr> 
              <td align="center" colspan="2">
                <a class="brownbttn" href="content.php">&lt;&lt;back</a>

              </td> 
            </tbody>
          </table>

        <? } ?>
      </td>
      </tr>
      <tr height="16">
        <td colspan="2" style="background:url(images/foot_bg.jpg)center no-repeat;background-size:100%;">&nbsp;</td>
      </tr>
    </table> 
  </td>   

</tr>
<tr><td colspan="3" align="right"></td></tr>
</table>
