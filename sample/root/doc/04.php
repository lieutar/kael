<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\php_lib"
	  : ":../php_lib" ));

include_once("RPS_DB.php");
include_once("RPS_LIB.php");

$MainForm = new rps_form("form1");
$mode = gv("mode");

$db = recruit_db_class("./admin/data/recruit");

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
<link rel="stylesheet" href="css/bg.css" type="text/css">
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
<body bgcolor="#FFFFFF" text="#666666" link="#333333" vlink="#333333" alink="#FF0000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="bg">
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr> 
    <td height="170" width="770" background="images/bg_employ.gif" ><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="770" height="170">
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
          <td rowspan="2" width="161">　</td>
          <td>
            <div align="center">
              <table width="580" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr valign="top"> 
                  <td width="580"> 
                    <?

$now = getdate();

/*
for($i=0; $i < $db->len; $i++)
{
  $d = $db->get_data($i);
  list($oy,$om,$od) = $d->get_date();
  echo ("$oy - $om - $od<br>");
}
*/

$db->set_from($now["year"], $now[ "mon"], $now["mday"]);
$db->extract_by_term();

//echo "<hr>".$db->len."<hr>";

$new_ex = array();

foreach($db->extracted_indexs as $i)
{
  $d = $db->get_data($i);
  list($oy,$om,$od) = $d->get_date();
  //  echo ("$oy - $om - $od<br>");
  if(!( $now["year"] > $oy ||
	($now["year"] == $oy && $now["mon"] >  $om) ||
	($now["year"] == $oy && $now["mon"] == $om  && $now["mday"] > $od)))
    {
      array_push($new_ex,$i);
    }
}

$db->extracted_indexs = $new_ex;

if(count($new_ex) == 0):
?>
                    <span class="font2_12"><br>
                    現在、採用情報はありません 
                    <?
endif;

$db->set_page_length(10);
$db->set_page(gv("page"));
$db->init_cursor();


?>
                    </span> 
                    
                    <?
while(($d = $db->next_data())!==false)
{
  $_y = $d->get_value("input_y");
  $_m = $d->get_value("input_m");
  $_d = $d->get_value("input_d");
  list($oy,$om,$od) = $d->get_date();
?>
                    <table width="100%" border=0 cellspacing=2 cellpadding=2>
                      <tr valign=top> 
                        <td colspan="2" class="small"> 
                          <? echo "$_y/$_m/$_d";?>
                        </td>
                      <tr valign=top> 
                        <td colspan="2" class="big"><img src="images/emlpoy_title.gif" width="400" height="43"><br>
                          <img src="images/spacer.gif" width="1" height="3"> </td>
                      
                      <tr valign=top> 
                        <td colspan="2" class="big" bgcolor="#999999"> <strong> 
                          <?$d->ev2("title")?>
                          </strong></td>
                      
                      <tr valign=top> 
                        <td width="20%" bgcolor="#E8F3FF" class="font2_12">雇用形態</td>
                        <td width="80%" bgcolor="#F7F7F7" class="font2_12"> 
                          <?$d->ev2("koyoukeitai")?>
                        </td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12">職種</td>
                        <td bgcolor="#F7F7F7" class="font2_12"> 
                          <?$d->ev2("shokushu")?>
                        </td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12">給与</td>
                        <td bgcolor="#F7F7F7" class="font2_12"> 
                          <?$d->ev2("kyuyo")?>
                        </td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12">詳細仕事内容</td>
                        <td bgcolor="#F7F7F7" class="font2_12"> 
                          <?$d->ev4("shigotonaiyo")?>
                        </td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12">勤務地</td>
                        <td bgcolor="#F7F7F7" class="font2_12"> 
                          <?$d->ev4("kinmuchi")?>
                        </td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12">勤務時間</td>
                        <td bgcolor="#F7F7F7" class="font2_12"> 
                          <?$d->ev4("kinmujikan")?>
                        </td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12">休日</td>
                        <td bgcolor="#F7F7F7" class="font2_12"> 
                          <?$d->ev4("kyujitsu")?>
                        </td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12">勤務期間</td>
                        <td bgcolor="#F7F7F7" class="font2_12"> 
                          <?$d->ev4("kinmukikan")?>
                        </td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12">資格</td>
                        <td bgcolor="#F7F7F7" class="font2_12"> 
                          <?$d->ev4("shikaku")?>
                        </td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12">待遇</td>
                        <td bgcolor="#F7F7F7" class="font2_12"> 
                          <?$d->ev4("taigu")?>
                        </td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12">応募方法</td>
                        <td bgcolor="#F7F7F7" class="font2_12"> 
                          <?$d->ev4("oubohoho")?>
                        </td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12">担当者名</td>
                        <td bgcolor="#F7F7F7" class="font2_12"> 
                          <?$d->ev2("tantosha")?>
                        </td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12">電話番号</td>
                        <td bgcolor="#F7F7F7" class="font2_12"> 
                          <?$d->ev2("denwabango")?>
                        </td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12">応募先Eメール</td>
                        <td bgcolor="#F7F7F7" class="font2_12"> 
                          <?$d->ev2("email")?>
                        </td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12">応募期間</td>
                        <td bgcolor="#F7F7F7" class="font2_12"> 
                          <?echo $oy?>
                          / 
                          <?echo $om?>
                          / 
                          <?echo $od?>
                          まで</td>
                    </table>
                    <table width="100%" border=0 cellspacing=2 cellpadding=2>
                      <tr> 
                        <td align=center bgcolor="<?echo $kigengire ? "#FF0000" : "#FFFFFF" ?>" class="font2_12"> 
                          <input name=edit type=image src="images/application_btn.gif" width=100 height=21 border=0 id=edit
	                       onClick="location='04_apply.php?index=<? echo $d->index; ?>'"
                           value="応募する">
                          <?if($kigengire){?>
                          ※この採用情報は応募期間を過ぎています 
                          <?}?>
                    </table>
                    <br>
                    <?
}
?>
                    <br>
                    <table width="100%" border=0 cellspacing=0 cellpadding=3>
                      <tr> 
                        <td width="20%" class="font2_12"> 
                          <? if(!$db->is_first_page()):?>
                          <a href="javascript:form1.page.value =<?echo $page-1?>;
                              form1.submit();">←前の１０件</a> 
                          <?endif;?>
                        <td align=center class="font2_12"><a href="#top">このページのトップへ↑</a> 
                        <td align=right width="20%" class="font2_12"> 
                          <? if($db->has_more_page()):?>
                          <a href="javascript:form1.page.value =<?echo $page+1?>;
                              form1.submit();">次の１０件→</a> 
                          <? endif; ?>
                    </table>
                    <img src="images/line.gif" width="500" height="10"><br>
                    <br>
                  </td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
        <tr> 
          <td>
            <div align="right" class="font_m">|| <a href="http://www.reds.co.jp/brains_test/foo/index.php">HOME</a> 
              || <a href="http://www.reds.co.jp/brains_test/foo/01.php">インフォメーション</a> 
              || <a href="http://www.reds.co.jp/brains_test/foo/02.html">企業情報</a> 
              || <a href="http://www.reds.co.jp/brains_test/foo/03.html">業務内容</a> 
              || <a href="http://www.reds.co.jp/brains_test/foo/04.php">採用情報</a> 
              || <a href="http://www.reds.co.jp/brains_test/foo/05.php">お問合せ</a> 
              || <a href="http://www.reds.co.jp/brains_test/foo/06.html">サイトマップ</a> 
              || <a href="http://www.reds.co.jp/brains_test/foo/07.html">English</a> 
              ||<img src="images/white.gif" width="5" height="1"><br>
              <img src="images/white.gif" width="1" height="15"> </div>
          </td>
        </tr>
      </table>
    </td>
    <td>　</td>
  </tr>
  <tr bgcolor="2D2E2E"> 
    <td height="15" width="770"> 
      <div align="right"><span class="copyright">Copyright:(C)2002 Brains., All 
        Right Reserved</span>.</div>
    </td>
    <td>　</td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
