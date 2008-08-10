<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\php_lib"
	  : ":../php_lib" ));

include_once("RPS_DB.php");
include_once("RPS_LIB.php");


$db = new RPS_DB("./admin/data/info"         ,
		 array("ttl", "ctgl", "info"),
		 true);

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

<link rel="stylesheet" href="css/bg.css" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="bg" text="#666666" link="#333333" vlink="#333333">
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr> 
    <td width="770" height="170" background="images/bg2.gif"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="770" height="170">
        <param name=movie value="swf/index.swf">
        <param name=quality value=high>
        <embed src="swf/index.swf" quality=high pluginspage="http://www.macromedia.com/jp/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="770" height="170">
        </embed> 
      </object></td>
    <td background="images/bg2.gif">　</td>
  </tr>
  <tr> 
    <td width="770">
      <table width="770" border="0" cellspacing="0" cellpadding="0" class="main_box" height="100%">
        <tr> 
          <td width="161" rowspan="2">　</td>
          <td> 
            <div align="center"> 
              <table width="580" border="0" cellspacing="0" cellpadding="0" height="100%">
                <tr>
                  <td height="80"> 
                    <div align="right"><img src="images/home_title.gif" width="360" height="70"></div>
                  </td>
                </tr>
                <tr> 
                  <td> 
                    <div align="center">
                      <p align="right"> 
                        <?
$db->set_page_length(10);
$db->set_page(0);
$now = getdate();
$db->extract(0 ,0 ,0 , $now["year"],$now["mon"],$now["mday"] );
?>
                        <?

$db->init_cursor();
while(($d = $db->next_data()) !== false)
{
  list($_y,$_m,$_d) = $d->get_date();
?>
                        <br>
                      </p>
                      <table width="560" border="0" cellspacing="0" cellpadding="5">
                        <tr valign="top"> 
                          <td width="100" align="right" class="font2_12"> 
                            <? echo "$_y/$_m/$_d"; ?>
                            <br>
                            ( 
                            <? $d->ev2("ctgl");?>
                            )</td>
                          <td class="font2_12"><a href='01.php?page=0#<?echo $d->index?>'> 
                            <? $d->ev2("ttl"); ?>
                            </a><br>
                            <? $d->ev5("info");?>
                            (<a href='01.php?page=0#<?echo $d->index?>'>more info</a>)</td>
                        </tr>
                      </table>
                      <p> <br>
                        <?
}
?>
                        <!-- InstanceEndEditable -->
                      </p>
                    
                  </div>
                  </td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div align="right" class="font_m">|| <a href="index.php">HOME</a> 
              || <a href="01.php">インフォメーション</a> 
              || <a href="02.html">企業情報</a> 
              || <a href="03.html">業務内容</a> 
              || <a href="04.php">採用情報</a> 
              || <a href="05.php">お問合せ</a> 
              || <a href="06.html">サイトマップ</a> 
              || <a href="07.html">English</a> 
              ||<br>
              <img src="images/white.gif" width="1" height="15"> </div>
          </td>
        </tr>
      </table>
    </td>
    <td>　</td>
  </tr>
  <tr> 
    <td width="770" height="15" bgcolor="2D2E2E"> 
      <div align="right" class="copyright">Copyright:(C)2003 Brains., All Right Reserved.</div>
    </td>
    <td bgcolor="2D2E2E">　</td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
