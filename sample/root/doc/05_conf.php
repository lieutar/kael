<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\php_lib"
	  : ":../php_lib" ));

include_once("RPS_LIB.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/reds.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Brains</title>
<!-- InstanceEndEditable -->
<meta name="Keywords" content="�ۡ���ڡ������� ����塼����� �������ȳ�ȯ �ǥ����� ��ǥ�����ά">
<meta name="Description" content="�ϥ�������ƥ��ʵ��ѤȺ�Ŭ�ʥǥ�����ǥ�ˡ�������̥��Ū�ʥ���塼�����򤪵��ͤˤ���">
<link href="css/bg.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<meta name="description" content="FW MX DW MX HTML">
<script language="JavaScript">
<!--


/* Functions that swaps images. */

/* Functions that handle preload. */

function mmLoadMenus() {
  if (window.mm_menu_0917130537_0) return;
          window.mm_menu_0917130537_0 = new Menu("root",105,18,"Osaka, MS UI Gothic",10,"#ffffff","#ffffff","#666666","#99cc00","left","middle",2,0,100,-5,7,true,true,true,0,false,false);
  mm_menu_0917130537_0.addMenuItem("Brains�Ȥ�","location='02.html'");
  mm_menu_0917130537_0.addMenuItem("��ҳ���","location='0201.html'");
  mm_menu_0917130537_0.addMenuItem("�Ͽޡ������","location='0202.html'");
  mm_menu_0917130537_0.addMenuItem("��Ϣ���","location='0203.html'");
   mm_menu_0917130537_0.hideOnMouseOut=true;
   mm_menu_0917130537_0.bgColor='#555555';
   mm_menu_0917130537_0.menuBorder=1;
   mm_menu_0917130537_0.menuLiteBgColor='#ffffff';
   mm_menu_0917130537_0.menuBorderBgColor='#555555';
    window.mm_menu_0917130849_1 = new Menu("root",105,18,"Osaka, MS UI Gothic",10,"#ffffff","#ffffff","#666666","#99cc00","left","middle",2,0,100,-5,7,true,true,true,0,false,false);
  mm_menu_0917130849_1.addMenuItem("��������ԥ���","location='03.html'");
  mm_menu_0917130849_1.addMenuItem("����塼�����","location='0301.html'");
  mm_menu_0917130849_1.addMenuItem("�ǥ�����","location='0302.html'");
  mm_menu_0917130849_1.addMenuItem("�ץ���������","location='0303.html'");
  mm_menu_0917130849_1.addMenuItem("�ޥͥ�����","location='0304.html'");
  mm_menu_0917130849_1.addMenuItem("��̳����FAQ","location='03faq.php'");
   mm_menu_0917130849_1.hideOnMouseOut=true;
   mm_menu_0917130849_1.bgColor='#555555';
   mm_menu_0917130849_1.menuBorder=1;
   mm_menu_0917130849_1.menuLiteBgColor='#ffffff';
   mm_menu_0917130849_1.menuBorderBgColor='#555555';

mm_menu_0917130849_1.writeMenus();
} // mmLoadMenus()

//-->
</script>
<script language="JavaScript1.2" src="mm_menu.js"></script>
</head>
<body bgcolor="#FFFFFF" text="#666666" link="#333333" vlink="#333333" alink="#FF0000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="bg">
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr>
    <td width="770" height="170" background="images/bg2.gif"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="770" height="170">
        <param name=movie value="swf/faq.swf">
        <param name=quality value=high>
        <embed src="swf/faq.swf" quality=high pluginspage="http://www.macromedia.com/jp/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="770" height="170">
        </embed> 
      </object></td>
    <td background="images/bg2.gif">��</td>
  </tr>
  <tr>
    <td>
      <table width="770" border="0" cellspacing="0" cellpadding="0" height="100%" class="main_box">
        <tr>
          <td width="161">��</td>
          <td>
            <div align="center">
              <table width="580" border="0" cellspacing="0" cellpadding="0" class="faq_box">
                <tr>
                  <td>
                    <div align="center">
                      <table width="580" border="0" cellspacing="0" cellpadding="0" class="faq_box">
                        <tr valign="top"> 
                          <td width="580"> 
                            <form name="form1" action="05_submit.php" method="post">
                              <br>
                              <input type=hidden name=incuire_mailto value="a-naito@express.co.jp">
                              <!--input type=hidden name=incuire_mailto value="a-naito@express.co.jp"-->
                              <?
$f = new rps_form("form1");
$f->pass_values();
?>
                              <font color="#FF0000" class="font2_12_employ2">��������ɬ�����Ϲ��ܤǤ���</font> 
                              <table cellspacing=2 cellpadding=2 width="580">
                                <tr> 
                                  <th width="163"> 
                                    <div align="right" class="font2_12_dark"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">��</font></span>���䤤��碌�����ȥ�</div>
                                  </th>
                                  
                                  <td class="font2_12" width="384" > 
                                    <?ev2("subject")?>
                                  </td>
                                <tr> 
                                  <th width="163"> 
                                    <div align="right" class="font2_12_dark"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">��</font></span>���䤤��碌����</div>
                                  </th>
                                  <td class="font2_12" width="384"> 
                                    <?ev4("toiawase")?>
                                  </td>
                                <tr> 
                                  <th width="163"> 
                                    <div align="right" class="font2_12_dark"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">��</font></span>��̾��</div>
                                  </th>
                                  <td class="font2_12" width="384"> 
                                    <?ev2("seimei");?>
                                  </td>
                                <tr> 
                                  <th width="163"> 
                                    <div align="right" class="font2_12_employ">���̾���ع�̾</div>
                                  </th>
                                  <td class="font2_12" width="384"> 
                                    <?ev2("company")?>
                                  </td>
                                <tr> 
                                  <th width="163"> 
                                    <div align="right" class="font2_12_employ">���𡦳ز�</div>
                                  </th>
                                  <td class="font2_12" width="384"> 
                                    <?ev2("division")?>
                                  </td>
                                <tr> 
                                  <th width="163"> 
                                    <div align="right" class="font2_12_employ">��</div>
                                  </th>
                                  <td class="font2_12" width="384"> 
                                    <?ev2("position")?>
                                  </td>
                                <tr> 
                                  <th width="163"> 
                                    <div align="right" class="font2_12_employ">�����ֹ�</div>
                                  </th>
                                  <td class="font2_12" width="384"> 
                                    <?ev2("phone")?>
                                  </td>
                                <tr> 
                                  <th width="163"> 
                                    <div align="right" class="font2_12_employ">FAX�ֹ�</div>
                                  </th>
                                  <td class="font2_12" width="384"> 
                                    <?ev2("fax")?>
                                  </td>
                                <tr> 
                                  <th width="163"> 
                                    <div align="right" class="font2_12_dark"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">��</font></span>E-mail</div>
                                  </th>
                                  <td class="font2_12" width="384"> 
                                    <?ev2("EMAIL")?>
                                  </td>
                                <tr> 
                                  <th width="163"> 
                                    <div align="right" class="font2_12_employ">URL</div>
                                  </th>
                                  <td class="font2_12" width="384"> 
                                    <?ev2("weburl")?>
                                  </td>
                                <tr> 
                                  <th width="163"> 
                                    <div align="right" class="font2_12_employ">͹���ֹ�</div>
                                  </th>
                                  <td class="font2_12" width="384"> 
                                    <?ev2("zip")?>
                                <tr> 
                                  <th height="27" width="163"> 
                                    <div align="right" class="font2_12_employ">��ƻ�ܸ�</div>
                                  <td class="font2_12" height="27" width="384"> 
                                    <?ev2("prefecture")?>
                                  </td>
                                <tr> 
                                  <th width="163"> 
                                    <div align="right" class="font2_12_employ">��Į¼̾</div>
                                  </th>
                                  <td class="font2_12" width="384"> 
                                    <?ev2("city")?>
                                  </td>
                                <tr> 
                                  <th width="163"> 
                                    <div align="right" class="font2_12_employ">������</div>
                                  </th>
                                  <td class="font2_12" width="384"> 
                                    <?ev2("address")?>
                                  </td>
                                <tr> 
                                  <td colspan=3 style="text-align:center"> 
                                    <div align="center"> 
                                      <input type=image src="images/entry_faq.gif" width=100 height=21 border=0 value="���" name="submit">
                                      <input type=image src="images/correct_faq.gif" width=100 height=21 border=0 value="���Խ�" onClick="form1.action='05.php';form1.submit();" name="image">
                                    </div>
                                  </td>
                              </table>
                            </form>
                            <br>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
        <tr>
          <td>��</td>
          <td>
            <div align="right"><span class="font_m">|| <a href="index.php">HOME</a> 
              || <a href="01.php">����ե��᡼�����</a> 
              || <a href="02.html">��Ⱦ���</a> 
              || <a href="03.html">��̳����</a> 
              || <a href="04.php">���Ѿ���</a> 
              || <a href="05.php">����礻</a> 
              || <a href="06.html">�����ȥޥå�</a> 
              || <a href="07.html">English</a> 
              ||<img src="images/white.gif" width="8" height="8"><br>
              <img src="images/white.gif" width="8" height="15"> </span><br>
            </div>
          </td>
        </tr>
      </table>
    </td>
    <td>��</td>
  </tr>
  <tr>
    <td height="15" bgcolor="2D2E2E" width="770"> 
      <div align="right" class="copyright">Copyright:(C)2003 Brains., All Right Reserved.</div>
    </td>
    <td bgcolor="2D2E2E">��</td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
