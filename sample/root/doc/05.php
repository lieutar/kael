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
<script type="text/javascript"> 
function rst(){ 
    document.forms[0].reset();return false; 
} 
</script>
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
          <td width="161" >��</td>
          <td >
<div align="center">
<table width="580" border="0" cellspacing="0" cellpadding="0">
                <tr valign="top"> 
                  <td width="630"> 
                    <form name=form1 onSubmit="return checkdata()" 
      action="05_conf.php" method=post>
                      <br>
                      <font color="#FF0000" class="font2_12_employ2">��������ɬ�����Ϲ��ܤǤ���</font> 
                      <table cellspacing=0 cellpadding=5 width="100%">
                        <tbody> 
                        <!--
  <tr><th>���ƥ��꡼
      <td><SELECT name=subject>
          <OPTION value="">�����Ӥ�������
          <?
$subject = gv("subject");
             foreach(array("�����֥����ȤˤĤ��� ",
			   "�Ǻ����ƤˤĤ��� ",
			   "IR�ˤĤ��� ",
			   "��̳���ƤˤĤ��� ",
			   "���ҥ���ƥ�ĤˤĤ��� ",
			   "�ꥯ�롼�ȤˤĤ���") as $v): ?>
          <option value="<?echo $v?>"<?if($subject == $v)
              echo " selected";?>>�� <?echo $v?>
          <? endforeach; ?>
        </SELECT> -->
                        <tr> 
                          <th class="font2_12_dark" > 
                            <div align="right"><font color="#333333"><span class="font2_12_dark">���䤤��碌�����ȥ�</span></font><font color="#FF0000" class="font2_12_employ2">��</font></div>
                          </th>
                          <td class="font2_12" > 
                            <input name=subject value="<?evf(subject)?>">
                        <tr> 
                          <th class="font2_12_dark"> 
                            <div align="right"><font color="#333333" class="font2_12_dark">���䤤��碌����</font><font color="#FF0000" class="font2_12_employ2">��</font></div>
                          </th>
                          <td class="font2_12"> 
                            <textarea name=toiawase rows=8 wrap=hard cols=45><?evf("toiawase")?></textarea>
                        <tr> 
                          <th class="font2_12_dark"> 
                            <div align="right"><font color="#333333" class="font2_12_dark">��̾��</font><font color="#FF0000" class="font2_12_employ2">��</font></div>
                          </th>
                          <td class="font2_12"> 
                            <input name=seimei value="<?evf("seimei")?>">
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">���̾���ع�̾</div>
                          </th>
                          <td class="font2_12"> 
                            <input size=40 name=company value="<?evf('company')?>">
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">���𡦳ز�</div>
                          </th>
                          <td class="font2_12"> 
                            <input size=40 name=division value="<?evf('division')?>">
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">��</div>
                          </th>
                          <td class="font2_12"> 
                            <input size=40 name=position value="<?evf('position')?>">
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">�����ֹ�</div>
                          </th>
                          <td class="font2_12"> 
                            <input size=25 name=phone value="<?evf('phone')?>">
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">FAX�ֹ�</div>
                          </th>
                          <td class="font2_12"> 
                            <input size=25 name=fax value="<?evf('fax')?>">
                        <tr> 
                          <th class="font2_12_dark"> 
                            <div align="right"><font color="#333333" class="font2_12_dark">E-mail</font><font color="#FF0000" class="font2_12_employ2">��</font></div>
                          </th>
                          <td class="font2_12"> 
                            <input size=40 name=EMAIL value="<?evf('EMAIL')?>">
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">URL</div>
                          </th>
                          <td class="font2_12"> 
                            <input size=40 value="<?evf('weburl')?>" name=weburl>
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">͹���ֹ�</div>
                          </th>
                          <td class="font2_12"> 
                            <input size=25 name=zip value="<?evf('zip')?>" maxlength=8>
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">��ƻ�ܸ� </div>
                          <td class="font2_12"> 
                            <select name=prefecture>
                              <option value="">���򤷤Ƥ������� 
                              <?
	$prefecture = gv("prefecture");
        foreach( array( "�̳�ƻ", "�Ŀ���", "��긩",
			"�ܾ븩", "���ĸ�", "������", "ʡ�縩",
			"��븩", "���ڸ�", "���ϸ�",
			"��̸�", "���ո�", "�����", "�����",
			"���㸩", "�ٻ���", "���",
			"ʡ�温", "������", "Ĺ�",
			"���츩", "�Ų���", "���θ�", "���Ÿ�",
			"���츩", "������", "�����",
			"ʼ�˸�", "���ɸ�", "�²λ���",
			"Ļ�踩", "�纬��", "������",
			"���縩", "������",
			"���縩", "���", "��ɲ��", "���θ�",
			"ʡ����", "���츩", "Ĺ�긩", "���ܸ�", 
			"��ʬ��", "�ܺ긩", "�����縩",
			"���츩" ) as $p)
     printf("<option value='%s'%s>%s",
	    $p,
	    ($p == $prefecture ? " selected" : ""),
	    $p);
?>
                            </select>
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">��Į¼̾</div>
                          </th>
                          <td class="font2_12"> 
                            <input size=40 name=city value="<?evf('city')?>">
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">������</div>
                          </th>
                          <td class="font2_12"> 
                            <input size=40 name=address value="<?evf('address')?>">
                        <tr> 
                          <td colspan=2 style="text-align:center" class="font2_12_dark"> 
                            <div align="right"><img src="images/line.gif" width="500" height="10"><br>
                            </div>
                        <tr> 
                          <td colspan=2 style="text-align:center" class="font2_12_dark"> 
                            <div align="center">
                              <input type=image src="images/confirm_faq.gif" width=100 height=21 border=0 value="��ǧ���̤�" name="submit">
                              <a href="JavaScript:document.FormName.reset();" onclick="return rst()" onkeypress="rst()"><img src="images/reset_faq.gif" width=100 height=21 border="0"></a> 
                            </div>
                          
                        <tr> 
                          <td colspan=2 style="text-align:center" class="font2_12_dark"> 
                            <div align="right"><img src="images/line.gif" width="500" height="10"><br>
                            </div>
                      </table>
                    </form>
                  </td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
        <tr>
          <td height="25">��</td>
          <td>
            <div align="right"><span class="font_m">|| <a href="index.php">HOME</a> 
              || <a href="01.php">����ե��᡼�����</a> || <a href="02.html">��Ⱦ���</a> 
              || <a href="03.html">��̳����</a> || <a href="04.php">���Ѿ���</a> || <a href="05.php">����礻</a> 
              || <a href="06.html">�����ȥޥå�</a> || <a href="07.html">English</a> 
              ||</span><img src="images/white.gif" width="5" height="1"><br>
              <img src="images/spacer.gif" width="1" height="10"> <br>
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
