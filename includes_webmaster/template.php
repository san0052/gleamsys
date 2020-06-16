<?php
function page_header($HeaderTitle){
global $cfg;
echo <<<END
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML>
<HEAD>
<TITLE>
END;
echo $HeaderTitle;
echo <<<END
</TITLE>
<META http-equiv=Content-Type 
content="application/xhtml+xml; charset=UTF-8">
<LINK href="favicon.ico" rel="shortcut icon">
<style type="text/css">@import url(css/adminstyle.css);</style>
<SCRIPT language="JavaScript" src="scripts/common.js"></SCRIPT>
<SCRIPT language="JavaScript" src="scripts/popcalendar.js"></SCRIPT>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<META content="MSHTML 6.00.2900.2722" name=GENERATOR>

</HEAD>
<BODY>
<BR>
<div class="logsecc">
	<img src="images/logo.png">
</div>
<TABLE class="mainTable" cellSpacing="0" cellPadding="0" width="990" align="center" >
  <TBODY>
    <TR>
      <TD align=left vAlign=top colspan="6"><H2 class=myheader>ADMINISTRATION PANEL</H2></TD>
    </TR>
    <TR>
END;
}
function page_footer($scr=''){
	global $cfg;
echo <<<END
	<!-- End Body Here -->
        </TD>
    </TR>
    <TR>
      <TD vAlign=bottom align=middle></TD>
	</TR>
	<TR>
      <TD vAlign=bottom align=middle>
        <TABLE class=myfooter width="100%" align=center>
          <TBODY>
            <TR>
              <TD class="footxt" align="center">
END;
print $cfg['COPYRIGHT'];
echo <<<END
</TD>
            </TR>
          </TBODY>
        </TABLE>
       </TD>
    </TR>
  </TBODY>
</TABLE>
<BR>
</BODY>
</HTML>
END;
}
function headerbar($user='') {
	global $cfg;
$header_bar = "<table align=\"right\" width=\"99%\" cellpadding=\"0\" cellpadding=\"0\" class=\"portalpostheader\" border=\"0\">
  <tr>
    <td width=\"88%\" align=\"left\">&nbsp;Welcome&nbsp;".$user."</td>
    <td align=\"center\" width=\"6%\"><a href=\"admin.php\"><img src=\"".$cfg['IMAGES']."home.gif\" border=\"0\" alt=\"Home\" width=\"20\" height=\"20\"></a></td>
    <td align=\"center\" width=\"6%\"><a href=\"login.php?act=".md5("logout")."\"><img src=\"".$cfg['IMAGES']."logout.gif\" border=\"0\" alt=\"Logout\" width=\"18\" height=\"19\"></a></td>
  </tr>
</table>";
return $header_bar;
}
?>