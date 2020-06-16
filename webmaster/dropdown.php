<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? 	$sql="SELECT * FROM ".$cfg['DB_SITE']."WHERE `status`='A' "; $res=$heart->sql_query($sql); ?>
<select name="" id="" onchange="getSes1(this.value);" class="forminputelement">
  <? while($row=$heart->sql_fetchrow($res)){?>
  <option value="<?=$row['s_id']?>" <? if($cfg['SESSION_SITE']==$row['s_id']){?> selected="selected"<? }?>>
  <?=$row['s_name']?>
  </option>
  <? }?>
</select>
&nbsp;&nbsp;&nbsp;
</html>