<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\php_lib"
	  : ":../php_lib" ));

include_once("RPS_DB.php");
include_once("RPS_LIB.php");




$MainForm = new rps_form("form1");
$db = recruit_db_class("./admin/data/recruit");

$d = $db->get_data(gv("index"));
list($_y,$_m,$_d) = $d->get_date();

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
<body bgcolor="#FFFFFF" text="#666666" link="#333333" vlink="#333333" alink="#FF0000" leftmargin=0 topmargin=0 marginwidth=0 marginheight=0 class="bg">
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr> 
    <td height="170" width="770" background="images/bg_employ.gif"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="770" height="170">
        <param name=movie value="swf/employ.swf">
        <param name=quality value=high>
        <embed src="swf/employ.swf" quality=high pluginspage="http://www.macromedia.com/jp/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="770" height="170">
        </embed> 
      </object></td>
    <td height="170" background="images/bg_employ.gif">��</td>
  </tr>
  <tr>
    <td>
      <table width="770" border="0" cellspacing="0" cellpadding="0" height="100%" class="main_box">
        <tr> 
          <td width="161" >��</td>
          <td width="500" align="center" valign="top"> 
            <p><br>
              <?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\php_lib"
	  : ":../php_lib" ));
include_once("RPS_DB.php");
include_once("RPS_LIB.php");



$db = recruit_db_class("./admin/data/recruit");

$d = $db->get_data(gv("index"));
list($_y,$_m,$_d) = $d->get_date();

$subject  = "�ڱ����".$d->get_value("title");
$csv      = "admin/data/recruit/oubo.csv";
$mailto   = preg_replace("/^([\\s\\r\\n]+|{\\s\\r\\n]+)$/",
			 "",
			 $d->get_value("email"));
$mailfrom = preg_replace("/^([\\s\\r\\n]+|{\\s\\r\\n]+)$/",
			 "",
			 rmmq(gv("email")));

$record   = array("������"        => "$_y/$_m/$_d",
		  "���ѷ���"      => $d->get_value( "koyoukeitai"),
		  "�����ȥ�"      => $d->get_value(       "title"),
		  "����"          => $d->get_value(    "shokushu"),
		  "��Ϳ"          => $d->get_value(       "kyuyo"),
		  "�ܺٻŻ�����"  => $d->get_value("shigotonaiyo"),
		  "��̳��"        => $d->get_value(    "kinmuchi"),
		  "��̳����"      => $d->get_value(  "kinmujikan"),
		  "����"          => $d->get_value(    "kyujitsu"),
		  "��̳����"      => $d->get_value(  "kinmukikan"),
		  "���"          => $d->get_value(     "shikaku"),
		  "������ˡ"      => $d->get_value(    "oubohoho"),
		  "ô����̾"      => $d->get_value(    "tantosha"),
		  "�����ֹ�"      => $d->get_value(  "denwabango"),
		  "������E�᡼��" => $d->get_value(       "email"),
		  "�������"      => sprintf("%d/%d/%d",
					     $d->get_value("oubokikan_y"),
					     $d->get_value("oubokikan_m"),
					     $d->get_value("oubokikan_d")),

		  "�����E�᡼��"             => rmmq(gv(   "email")),
		  "����Ի�̾"                => rmmq(gv(   "namae")),
		  "����ԥեꥬ��"            => rmmq(gv(    "kana")),
		  "����������ֹ�"            => rmmq(gv( "tel_day")),

		  "�����͹���ֹ�"            => (rmmq(gv(  "zip_1")) . "-" .
						  rmmq(gv(  "zip_2"))),

		  "����Խ���"                => rmmq(gv( "address")),
		  "�����ǯ��"                => rmmq(gv(     "age")),
		  "����Ժǽ�����"            => rmmq(gv(   "study")),
		  "����Կ�̳����(����/ľ��)" => rmmq(gv("career_1")),
		  "����Կ�̳����(����)"      => rmmq(gv("career_2��?????????;?????")),
		  "�������ͭ���"            => rmmq(gv("career_3")),
		  "����Զ�̳��"              => rmmq(gv("com_name")),
		  "����Զ�̳��ȼ�"          => rmmq(gv("career_4")),
		  "�������"                => rmmq(gv(    "post")),
		  "�����ư��"                => rmmq(gv( "free_01")),
		  "����Լ���PR"              => rmmq(gv( "free_02")),
		  "����Լ���"                => rmmq(gv( "free_03")));

oubo($subject,
     $mailto,
     $mailfrom,
     $csv,
     $record,
     $format);
?>
              <strong><span class="font_jp_14">�����礢�꤬�Ȥ��������ޤ���</span></strong></p>
            <p><span class="font_jp_14">ô���Ԥ���������Ϣ�������ޤ���</span><br>
            </p>
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
              <img src="images/white.gif" width="1" height="15"> </span></div>
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
