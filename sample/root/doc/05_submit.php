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
    <td height="170" width="770" background="images/bg2.gif"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="770" height="170">
        <param name=movie value="swf/faq.swf">
        <param name=quality value=high>
        <embed src="swf/faq.swf" quality=high pluginspage="http://www.macromedia.com/jp/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="770" height="170">
        </embed> 
      </object></td>
    <td height="170" background="images/bg2.gif">　</td>
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

include_once("RPS_LIB.php");
$csv      = "admin/data/inquiry/inquiry.csv";
$mailto   = rmmq(gv("incuire_mailto"));
$mailfrom = rmmq(gv("EMAIL"));
$subject  = "【問い合せ】 ".rmmq(gv("subject"));
$record   = array("カテゴリー"     => rmmq(gv("subject")),
		  "問い合せ内容"   => rmmq(gv("toiawase")),
		  "氏名"           => rmmq(gv("seimei")),
		  "会社名・学校名" => rmmq(gv("company")),
		  "部署・学科"     => rmmq(gv("division")),
		  "役職"           => rmmq(gv("position")),
		  "電話番号"       => rmmq(gv("phone")),
		  "FAX番号"        => rmmq(gv("fax")),
		  "E-mail"         => rmmq(gv("EMAIL")),
		  "URL"            => rmmq(gv("weburl")),
		  "郵便番号"       => rmmq(gv("zip")),
		  "都道府県"       => rmmq(gv("prefecture")),
		  "市町村名"       => rmmq(gv("city")),
		  "住所"           => rmmq(gv("address")));

oubo($subject,
     $mailto,
     $mailfrom,
     $csv,
     $record);
?>
              <span class="font_jp_14_B">お問合せありがとうございます。</span></p>
            <p class="font_jp_14">今後ともより良いサービスを目指して頑張ります 。<br>
              よろしくお願いいたします。 <br>
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
