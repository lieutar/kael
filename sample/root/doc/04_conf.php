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
          <td width="161">　</td>
          <td > 
            <div align="center">
              <table width=580 border=0 cellspacing=0 cellpadding=0>
                <tr valign="top"> 
                  <td > <br>
                    <form name=form1 action="04_submit.php" method=post>
                      <?
$form = new rps_form("form1");
$form->pass_values();
?>
                      <div><font color="#FF0000" class="font2_12_employ2">※！印は必須入力項目です。</font></div>
                      <table width="580" cellpadding=5 cellspacing=0>
                        <tr> 
                          <th colspan=2 bgcolor="#CCCCCC" style="text-align:left" class="font_jp_14_B">パーソナル情報</th>
                        <tr> 
                          <th  class="font2_12_employ2" width="204"> 
                            <div align="right"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">！</font><font color="#ee0000" class="font2_12_dark">E-mail</font></span></div>
                          </th>
                          <td width="354" > <font color="#333333"> 
                            <? ev2("email") ?>
                            </font></td>
                        </tr>
                        <tr> 
                          <th class="font2_12_employ2" height="26" width="204" > 
                            <div align="right"><font class="font2_12_dark"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">！</font></span>お名前<span style="color:#ee0000;"></span></font></div>
                          </th>
                          <td height="26" width="354" > <font color="#333333"> 
                            <? ev2("namae") ?>
                            </font></td>
                        </tr>
                        <tr> 
                          <th class="font2_12_employ2" width="204" > 
                            <div align="right" class="font2_12_dark"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">！</font></span>フリガナ<font class="font2_12_employ2" color="#FF0000"></font></div>
                          </th>
                          <td width="354" > <font color="#333333"> 
                            <? ev2("kana")?>
                            </font></td>
                        </tr>
                        <tr> 
                          <th class="font2_12_employ2" width="204" > 
                            <div align="right"><font color="#FF0000" class="font2_12_employ2"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">！</font></span><span class="font2_12_dark">電話番号</span></font></div>
                          </th>
                          <td width="354" > <font color="#333333"> 
                            <? ev2("tel_day") ?>
                            </font></td>
                        </tr>
                        <tr> 
                          <th class="font2_12_employ2" width="204" > 
                            <div align="right"><font color="#FF0000" class="font2_12_employ2"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">！</font></span><span class="font2_12_dark">郵便番号</span></font></div>
                          </th>
                          <td width="354" > <font color="#333333"> 
                            <? ev2("zip_1") ?>
                            − 
                            <?ev2("zip_2")?>
                            </font></td>
                        </tr>
                        <tr> 
                          <th class="font2_12_employ2" width="204"> 
                            <div align="right"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">！</font></span><span class="font2_12_dark">連絡先住所</span></div>
                          </th>
                          <td width="354" > <font color="#333333"> 
                            <? ev2("address")?>
                            </font></td>
                        </tr>
                        <tr> 
                          <th class="font2_12_employ2" width="204" > 
                            <div align="right"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">！</font></span><span class="font2_12_dark">年齢</span></div>
                          </th>
                          <td width="354" > <font color="#333333"> 
                            <? ev2("age") ?>
                            </font></td>
                        </tr>
                        <tr> 
                          <th colspan=2 bgcolor="#CCCCCC" style="text-align:left" class="font_jp_14_B">キャリア・スキル項目</th>
                        <tr> 
                          <th class="font2_12_333333_b" width="204" > 
                            <div align="right">最終学歴</div>
                          </th>
                          <td width="354" > <font color="#333333"> 
                            <? ev2('study') ?>
                            </font></td>
                        </tr>
                        <tr> 
                          <th class="font2_12_333333_b" width="204" > 
                            <div align="right">現在もしくは<br>
                              直近の職務内容</div>
                          </th>
                          <td width="354" > <font color="#333333"> 
                            <? ev4('career_1') ?>
                            </font></td>
                        </tr>
                        <tr> 
                          <th class="font2_12_333333_b" width="204" > 
                            <div align="right">前の職務内容</div>
                          </th>
                          <td width="354" > <font color="#333333"> 
                            <? ev4('career_2')?>
                            </font></td>
                        </tr>
                        <tr> 
                          <th class="font2_12_333333_b" width="204" > 
                            <div align="right">保有資格・ 語学力</div>
                          </th>
                          <td width="354" > <font color="#333333"> 
                            <? ev4('career_3') ?>
                            </font></td>
                        </tr>
                        <tr> 
                          <th class="font2_12_333333_b" width="204" > 
                            <div align="right">勤務先</div>
                          </th>
                          <td width="354" > <font color="#333333"> 
                            <? ev2('com_name') ?>
                            </font></td>
                        </tr>
                        <tr> 
                          <th class="font2_12_333333_b" width="204" > 
                            <div align="right">勤務先業種</div>
                          </th>
                          <td width="354" > <font color="#333333"> 
                            <? ev2('career_4')?>
                            </font></td>
                        </tr>
                        <tr> 
                          <th class="font2_12_333333_b" width="204" > 
                            <div align="right">役職</div>
                          </th>
                          <td width="354" > <font color="#333333"> 
                            <? ev2('post') ?>
                            </font></td>
                        </tr>
                        <tr> 
                          <th colspan=2 bgcolor="#CCCCCC" style="text-align:left" class="font_jp_14_B">自由項目</th>
                        <tr> 
                          <th nowrap class="font2_12_333333_b" width="204" > 
                            <div align="right">当社への応募動機をご記入ください。</div>
                          </th>
                          <td width="354" > <font color="#333333"> 
                            <? ev4('free_01') ?>
                            </font></td>
                        </tr>
                        <tr> 
                          <th nowrap class="font2_12_333333_b" width="204" > 
                            <div align="right">あなたの自己PRをご記入ください。</div>
                          </th>
                          <td width="354" > <font color="#333333"> 
                            <? ev4('free_02') ?>
                            </font></td>
                        </tr>
                        <tr> 
                          <th nowrap class="font2_12_333333_b" width="204" > 
                            <div align="right">ご質問等があればご記入ください。</div>
                          </th>
                          <td width="354" > <font color="#333333"> 
                            <? ev4('free_03') ?>
                            </font></td>
                        </tr>
                        <tr align="center"> 
                          <td colspan=2> 
                            <input type=image src="images/entry_btn.gif" width=100 height=21 border=0 value="送信する" name="submit">
                            <input type=image src="images/correct_btn.gif" width=100 height=21 border=0 value="訂正する" onClick="form1.action='04_apply.php';form1.submit();" name="button">
                          </td>
                        </tr>
                      </table>
                    </form>
                    <br>
                  </td>
                </tr>
                <tr valign=top> 
                  <td width=550>　 </td>
              </table>
            </div>
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
