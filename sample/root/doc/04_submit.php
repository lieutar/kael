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
<meta name="Keywords" content="ホームページ制作 ソリューション 新規事業開発 デザイン メディア戦略">
<meta name="Description" content="ハイクオリティな技術と最適なデザインでユニークかつ魅力的なソリューションをお客様にご提供">
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
  mm_menu_0917130537_0.addMenuItem("Brainsとは","location='02.html'");
  mm_menu_0917130537_0.addMenuItem("会社概要","location='0201.html'");
  mm_menu_0917130537_0.addMenuItem("地図・所在地","location='0202.html'");
  mm_menu_0917130537_0.addMenuItem("関連会社","location='0203.html'");
   mm_menu_0917130537_0.hideOnMouseOut=true;
   mm_menu_0917130537_0.bgColor='#555555';
   mm_menu_0917130537_0.menuBorder=1;
   mm_menu_0917130537_0.menuLiteBgColor='#ffffff';
   mm_menu_0917130537_0.menuBorderBgColor='#555555';
    window.mm_menu_0917130849_1 = new Menu("root",105,18,"Osaka, MS UI Gothic",10,"#ffffff","#ffffff","#666666","#99cc00","left","middle",2,0,100,-5,7,true,true,true,0,false,false);
  mm_menu_0917130849_1.addMenuItem("コアコンピタス","location='03.html'");
  mm_menu_0917130849_1.addMenuItem("ソリューション","location='0301.html'");
  mm_menu_0917130849_1.addMenuItem("デザイン","location='0302.html'");
  mm_menu_0917130849_1.addMenuItem("プロダクション","location='0303.html'");
  mm_menu_0917130849_1.addMenuItem("マネジメント","location='0304.html'");
  mm_menu_0917130849_1.addMenuItem("業務内容FAQ","location='03faq.php'");
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
    <td height="170" background="images/bg_employ.gif">　</td>
  </tr>
  <tr>
    <td>
      <table width="770" border="0" cellspacing="0" cellpadding="0" height="100%" class="main_box">
        <tr> 
          <td width="161" >　</td>
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

$subject  = "【応募】".$d->get_value("title");
$csv      = "admin/data/recruit/oubo.csv";
$mailto   = preg_replace("/^([\\s\\r\\n]+|{\\s\\r\\n]+)$/",
			 "",
			 $d->get_value("email"));
$mailfrom = preg_replace("/^([\\s\\r\\n]+|{\\s\\r\\n]+)$/",
			 "",
			 rmmq(gv("email")));

$record   = array("入力日"        => "$_y/$_m/$_d",
		  "雇用形態"      => $d->get_value( "koyoukeitai"),
		  "タイトル"      => $d->get_value(       "title"),
		  "職種"          => $d->get_value(    "shokushu"),
		  "給与"          => $d->get_value(       "kyuyo"),
		  "詳細仕事内容"  => $d->get_value("shigotonaiyo"),
		  "勤務地"        => $d->get_value(    "kinmuchi"),
		  "勤務時間"      => $d->get_value(  "kinmujikan"),
		  "休日"          => $d->get_value(    "kyujitsu"),
		  "勤務期間"      => $d->get_value(  "kinmukikan"),
		  "資格"          => $d->get_value(     "shikaku"),
		  "応募方法"      => $d->get_value(    "oubohoho"),
		  "担当者名"      => $d->get_value(    "tantosha"),
		  "電話番号"      => $d->get_value(  "denwabango"),
		  "応募先Eメール" => $d->get_value(       "email"),
		  "応募期間"      => sprintf("%d/%d/%d",
					     $d->get_value("oubokikan_y"),
					     $d->get_value("oubokikan_m"),
					     $d->get_value("oubokikan_d")),

		  "応募者Eメール"             => rmmq(gv(   "email")),
		  "応募者氏名"                => rmmq(gv(   "namae")),
		  "応募者フリガナ"            => rmmq(gv(    "kana")),
		  "応募者電話番号"            => rmmq(gv( "tel_day")),

		  "応募者郵便番号"            => (rmmq(gv(  "zip_1")) . "-" .
						  rmmq(gv(  "zip_2"))),

		  "応募者住所"                => rmmq(gv( "address")),
		  "応募者年齢"                => rmmq(gv(     "age")),
		  "応募者最終学歴"            => rmmq(gv(   "study")),
		  "応募者職務内容(現在/直近)" => rmmq(gv("career_1")),
		  "応募者職務内容(以前)"      => rmmq(gv("career_2∀?????????;?????")),
		  "応募者保有資格"            => rmmq(gv("career_3")),
		  "応募者勤務先"              => rmmq(gv("com_name")),
		  "応募者勤務先業種"          => rmmq(gv("career_4")),
		  "応募者役職"                => rmmq(gv(    "post")),
		  "応募者動機"                => rmmq(gv( "free_01")),
		  "応募者自己PR"              => rmmq(gv( "free_02")),
		  "応募者質問"                => rmmq(gv( "free_03")));

oubo($subject,
     $mailto,
     $mailfrom,
     $csv,
     $record,
     $format);
?>
              <strong><span class="font_jp_14">ご応募ありがとうございます。</span></strong></p>
            <p><span class="font_jp_14">担当者より後日、ご連絡いたします。</span><br>
            </p>
          </td>
        </tr>
        <tr> 
          <td>　</td>
          <td> 
            <div align="right"><span class="font_m">|| <a href="index.php">HOME</a> 
              || <a href="01.php">インフォメーション</a> 
              || <a href="02.html">企業情報</a> 
              || <a href="03.html">業務内容</a> 
              || <a href="04.php">採用情報</a> 
              || <a href="05.php">お問合せ</a> 
              || <a href="06.html">サイトマップ</a> 
              || <a href="07.html">English</a> 
              ||<img src="images/white.gif" width="8" height="8"><br>
              <img src="images/white.gif" width="1" height="15"> </span></div>
          </td>
        </tr>
      </table>
    </td>
    <td>　</td>
  </tr>
  <tr> 
    <td height="15" bgcolor="2D2E2E" width="770"> 
      <div align="right" class="copyright">Copyright:(C)2003 Brains., All Right Reserved.</div>
    </td>
    <td bgcolor="2D2E2E">　</td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
