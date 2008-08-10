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
<script type="text/javascript"> 
function rst(){ 
    document.forms[0].reset();return false; 
} 
</script>
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
          <td width="161" height="1656">　</td>
          <td height="1656"> 
            <div align="center">
              <table width=580 border=0 cellspacing=0 cellpadding=0>
                <tr valign=top> 
                  <td width=550> 
                    <table width="100%" border=0 cellspacing=2 cellpadding=2 class="font2_12_employ">
                      <tr valign=top> 
                        <td colspan=2 class=small> <font color="#666666"> 
                          <? echo "$_y/$_m/$_d";?>
                          </font></td>
                      <tr valign=top bgcolor="#CCCCCC"> 
                        <td colspan=2> <font color="#666666"><strong> 
                          <?$d->ev2("title")?>
                          </strong></font></td>
                      <tr valign=top> 
                        <td width="20%" bgcolor="#E8F3FF" class="font2_12_employ"><font color="#666666">雇用形態</font></td>
                        <td width="80%" bgcolor="#F2F2F2"> <font color="#666666"> 
                          <?$d->ev2("koyoukeitai")?>
                          </font></td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12_employ"><font color="#666666">職種</font></td>
                        <td bgcolor="#F2F2F2"> <font color="#666666"> 
                          <?$d->ev2("shokushu")?>
                          </font></td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12_employ"><font color="#666666">給与</font></td>
                        <td bgcolor="#F2F2F2"> <font color="#666666"> 
                          <?$d->ev2("kyuyo")?>
                          </font></td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12_employ"><font color="#666666">詳細仕事内容</font></td>
                        <td bgcolor="#F2F2F2"> <font color="#666666"> 
                          <?$d->ev4("shigotonaiyo")?>
                          </font></td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12_employ"><font color="#666666">勤務地</font></td>
                        <td bgcolor="#F2F2F2"> <font color="#666666"> 
                          <?$d->ev4("kinmuchi")?>
                          </font></td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12_employ"><font color="#666666">勤務時間</font></td>
                        <td bgcolor="#F2F2F2"> <font color="#666666"> 
                          <?$d->ev4("kinmujikan")?>
                          </font></td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12_employ"><font color="#666666">休日</font></td>
                        <td bgcolor="#F2F2F2"> <font color="#666666"> 
                          <?$d->ev4("kyujitsu")?>
                          </font></td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12_employ"><font color="#666666">勤務期間</font></td>
                        <td bgcolor="#F2F2F2"> <font color="#666666"> 
                          <?$d->ev4("kinmukikan")?>
                          </font></td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12_employ"><font color="#666666">資格</font></td>
                        <td bgcolor="#F2F2F2"> <font color="#666666"> 
                          <?$d->ev4("shikaku")?>
                          </font></td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12_employ"><font color="#666666">待遇</font></td>
                        <td bgcolor="#F2F2F2"> <font color="#666666"> 
                          <?$d->ev4("taigu")?>
                          </font></td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12_employ"><font color="#666666">応募方法</font></td>
                        <td bgcolor="#F2F2F2"> <font color="#666666"> 
                          <?$d->ev4("oubohoho")?>
                          </font></td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12_employ"><font color="#666666">担当者名</font></td>
                        <td bgcolor="#F2F2F2"> <font color="#666666"> 
                          <?$d->ev2("tantosha")?>
                          </font></td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12_employ"><font color="#666666">電話番号</font></td>
                        <td bgcolor="#F2F2F2"> <font color="#666666"> 
                          <?$d->ev2("denwabango")?>
                          </font></td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12_employ"><font color="#666666">応募先Eメール</font></td>
                        <td bgcolor="#F2F2F2"> <font color="#666666"> 
                          <?$d->ev2("email")?>
                          </font></td>
                      <tr valign=top> 
                        <td bgcolor="#E8F3FF" class="font2_12_employ"><font color="#666666">応募期間</font></td>
                        <td bgcolor="#F2F2F2"> <font color="#666666"> 
                          <?echo $_y; ?>
                          / 
                          <? echo $_m; ?>
                          / 
                          <? echo $_d; ?>
                          まで</font></td>
                    </table>
                    <form name=form1 onSubmit="return checkdata()" action="04_conf.php" method=post>
                      <input type=hidden name=index value=<?ev("index")?>>
                      <font color="#FF0000" class="font2_12_employ2">※！印は必須入力項目です。</font> 
                      <table width="580" cellpadding=5 cellspacing=0 class="font2_12">
                        <tr> 
                          <th colspan=2 style="text-align:left" class="font_jp_14_B">パーソナル情報 
                        <tr> 
                          <th width="150" class="font2_12_employ2">
                            <div align="right"><font color="#FF0000" class="font2_12_333333_b"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">！</font></span>E-mail</font></div>
                          <td> 
                            <input size=40 name=email value="<?evf('email')?>">
                        <tr> 
                          <th width="150" class="font2_12_employ2">
                            <div align="right"><font color="#FF0000" class="font2_12_333333_b"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">！</font></span>お名前</font></div>
                          <td> 
                            <input size=40 name=namae  value="<?evf('namae')?>">
                        <tr> 
                          <th width="150" class="font2_12_employ2">
                            <div align="right"><font color="#FF0000" class="font2_12_333333_b"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">！</font></span>フリガナ</font></div>
                          <td> 
                            <input size=40 name=kana   value="<?evf('kana')?>">
                        <tr> 
                          <th width="150" class="font2_12_employ2">
                            <div align="right"><font color="#FF0000" class="font2_12_333333_b"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">！</font></span>電話番号</font></div>
                          <td> 
                            <input name=tel_day value="<?evf('tel_day')?>">
                        <tr> 
                          <th width="150" class="font2_12_employ2">
                            <div align="right"><font color="#FF0000" class="font2_12_333333_b"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">！</font></span>郵便番号</font></div>
                          <td> 
                            <input size=5 name=zip_1 value="<?evf('zip_1')?>">
                            − 
                            <input
      size=8 name=zip_2 value="<?evf('zip_2')?>">
                        <tr> 
                          <th width="150" class="font2_12_333333_b">
                            <div align="right"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">！</font></span>連絡先住所</div>
                          <td> 
                            <input size=40 name=address value="<?evf('address')?>">
                        <tr> 
                          <th width="150" class="font2_12_employ2">
                            <div align="right"><font color="#FF0000" class="font2_12_333333_b"><span style="color:#ee0000;"><font color="#FF0000" class="font2_12_employ2">！</font></span>年齢</font></div>
                          <td> 
                            <input size=6 name=age value="<? evf('age') ?>">
                        <tr> 
                          <th colspan=2 style="text-align:left" class="font_jp_14_B">キャリア・スキル項目 
                        <tr> 
                          <th width="150" class="font2_12_employ">
                            <div align="right">最終学歴 </div>
                          <td> 
                            <input size=40 name=study value="<?evf('study')?>">
                        <tr> 
                          <th width="150" class="font2_12_employ">
                            <div align="right">現在もしくは<br>
                              直近の職務内容 </div>
                          <td> 
                            <textarea name=career_1 rows=6 cols=40 wrap="hard"><?if(gv("career_1")==""){
?>職務内容：
経験年数：<?}else evf("career_1"); ?></textarea>
                        <tr> 
                          <th width="150" class="font2_12_employ">
                            <div align="right">前の職務内容 </div>
                          <td> 
                            <textarea name=career_2 rows=11 cols=40 wrap="hard"><? if(gv("career_2") == ""):?>1.前の職務内容：
　経験年数：
2.その前の職務内容：
　経験年数：<?else : evf("career_2"); endif;?></textarea>
                        <tr> 
                          <th width="150" class="font2_12_employ">
                            <div align="right">保有資格・語学力 </div>
                          <td
      > 
                            <textarea name=career_3 rows=3 cols=40 wrap="hard"><?evf("career_3")?></textarea>
                        <tr> 
                          <th width="150" class="font2_12_employ">
                            <div align="right">勤務先 </div>
                          <td> 
                            <input size=40 name=com_name value="<?evf('com_name')?>">
                        <tr> 
                          <th width="150" class="font2_12_employ">
                            <div align="right">勤務先業種 </div>
                          <td> 
                            <input size=40 name=career_4 value="<?evf('career_4')?>">
                        <tr> 
                          <th width="150" class="font2_12_employ">
                            <div align="right">役職 </div>
                          <td> 
                            <input size=40 name=post value="<?evf('post')?>">
                        <tr> 
                          <th colspan=2 style="text-align:left" class="font_jp_14_B">自由項目 
                        <tr> 
                          <th width="150" class="font2_12_employ">
                            <div align="right">当社への応募動機を<br>
                              ご記入ください。 </div>
                          <td> 
                            <textarea name=free_01 rows=4 cols=40 wrap="hard"><?evf('free_01')?></textarea>
                        <tr> 
                          <th width="150" class="font2_12_employ">
                            <div align="right">あなたの自己PRを<br>
                              ご記入ください。 </div>
                          <td> 
                            <textarea name=free_02 rows=4 cols=40 wrap="hard"><?evf('free_02')?></textarea>
                        <tr> 
                          <th width="150" class="font2_12_employ">
                            <div align="right">ご質問等があれば<br>
                              ご記入ください。 </div>
                          <td> 
                            <textarea name=free_03 rows=4 cols=40 wrap="hard"><?evf('free_03')?></textarea>
                            <tfoot> 
                        <tr align=center> 
                          <td colspan=2> 
                            <input type=image src="images/entry_btn.gif" width=100 height=21 border=0 value="送信する" name="submit">
                            <a href="JavaScript:document.FormName.reset();" onclick="return rst()" onkeypress="rst()"><img src="images/reset_btn.gif" width=100 height=21 border="0"></a>
                      </table>
                    </form>
                  </td>
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
