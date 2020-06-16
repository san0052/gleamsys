<table border="0" class="menuSelector" style="padding-left:14px; padding-bottom:6px;" cellpadding="5px;">
  <tr>
    <?
			 	$sql21="SELECT * FROM ".$cfg['DB_SITE']."   ";
				$res21=$heart->sql_query($sql21);	
				while($row21=$heart->sql_fetchrow($res21)){			
			 
				     if($cfg['SESSION_SITE']==$row21['s_id'])
					 {
				?>
    <td bgcolor="#0C7D7D"><a href="modeChanger.php?mode=<?=$row21['s_id']?>" style="color:#FFF; margin:5px;">
      <?=$row21['s_name']?>
      </a></font></td>
    <?
					 }
					 else
					 {
			    ?>
    <td bgcolor="#042828"><a href="modeChanger.php?mode=<?=$row21['s_id']?>" style="color:#FFF; margin:5px;">
      <?=$row21['s_name']?>
      </a></td>
    <?
					 }
				
				}
			 ?>
  </tr>
</table>
