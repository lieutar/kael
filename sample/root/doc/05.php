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
<body bgcolor="#FFFFFF" text="#666666" link="#333333" vlink="#333333" alink="#FF0000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="bg">
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr>
    <td width="770" height="170" background="images/bg2.gif"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="770" height="170">
        <param name=movie value="swf/faq.swf">
        <param name=quality value=high>
        <embed src="swf/faq.swf" quality=high pluginspage="http://www.macromedia.com/jp/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="770" height="170">
        </embed> 
      </object></td>
    <td background="images/bg2.gif">　</td>
  </tr>
  <tr>
    <td>
      <table width="770" border="0" cellspacing="0" cellpadding="0" height="100%" class="main_box">
        <tr>
          <td width="161" >　</td>
          <td >
<div align="center">
<table width="580" border="0" cellspacing="0" cellpadding="0">
                <tr valign="top"> 
                  <td width="630"> 
                    <form name=form1 onSubmit="return checkdata()" 
      action="05_conf.php" method=post>
                      <br>
                      <font color="#FF0000" class="font2_12_employ2">※！印は必須入力項目です。</font> 
                      <table cellspacing=0 cellpadding=5 width="100%">
                        <tbody> 
                        <!--
  <tr><th>カテゴリー
      <td><SELECT name=subject>
          <OPTION value="">お選びください
          <?
$subject = gv("subject");
             foreach(array("ウェブサイトについて ",
			   "掲載内容について ",
			   "IRについて ",
			   "業務内容について ",
			   "自社コンテンツについて ",
			   "リクルートについて") as $v): ?>
          <option value="<?echo $v?>"<?if($subject == $v)
              echo " selected";?>>■ <?echo $v?>
          <? endforeach; ?>
        </SELECT> -->
                        <tr> 
                          <th class="font2_12_dark" > 
                            <div align="right"><font color="#333333"><span class="font2_12_dark">お問い合わせタイトル</span></font><font color="#FF0000" class="font2_12_employ2">！</font></div>
                          </th>
                          <td class="font2_12" > 
                            <input name=subject value="<?evf(subject)?>">
                        <tr> 
                          <th class="font2_12_dark"> 
                            <div align="right"><font color="#333333" class="font2_12_dark">お問い合わせ内容</font><font color="#FF0000" class="font2_12_employ2">！</font></div>
                          </th>
                          <td class="font2_12"> 
                            <textarea name=toiawase rows=8 wrap=hard cols=45><?evf("toiawase")?></textarea>
                        <tr> 
                          <th class="font2_12_dark"> 
                            <div align="right"><font color="#333333" class="font2_12_dark">お名前</font><font color="#FF0000" class="font2_12_employ2">！</font></div>
                          </th>
                          <td class="font2_12"> 
                            <input name=seimei value="<?evf("seimei")?>">
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">会社名・学校名</div>
                          </th>
                          <td class="font2_12"> 
                            <input size=40 name=company value="<?evf('company')?>">
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">部署・学科</div>
                          </th>
                          <td class="font2_12"> 
                            <input size=40 name=division value="<?evf('division')?>">
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">役職</div>
                          </th>
                          <td class="font2_12"> 
                            <input size=40 name=position value="<?evf('position')?>">
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">電話番号</div>
                          </th>
                          <td class="font2_12"> 
                            <input size=25 name=phone value="<?evf('phone')?>">
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">FAX番号</div>
                          </th>
                          <td class="font2_12"> 
                            <input size=25 name=fax value="<?evf('fax')?>">
                        <tr> 
                          <th class="font2_12_dark"> 
                            <div align="right"><font color="#333333" class="font2_12_dark">E-mail</font><font color="#FF0000" class="font2_12_employ2">！</font></div>
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
                            <div align="right">郵便番号</div>
                          </th>
                          <td class="font2_12"> 
                            <input size=25 name=zip value="<?evf('zip')?>" maxlength=8>
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">都道府県 </div>
                          <td class="font2_12"> 
                            <select name=prefecture>
                              <option value="">選択してください 
                              <?
	$prefecture = gv("prefecture");
        foreach( array( "北海道", "青森県", "岩手県",
			"宮城県", "秋田県", "山形県", "福島県",
			"茨城県", "栃木県", "群馬県",
			"埼玉県", "千葉県", "東京都", "神奈川県",
			"新潟県", "富山県", "石川県",
			"福井県", "山梨県", "長野県",
			"岐阜県", "静岡県", "愛知県", "三重県",
			"滋賀県", "京都府", "大阪府",
			"兵庫県", "奈良県", "和歌山県",
			"鳥取県", "島根県", "岡山県",
			"広島県", "山口県",
			"徳島県", "香川県", "愛媛県", "高知県",
			"福岡県", "佐賀県", "長崎県", "熊本県", 
			"大分県", "宮崎県", "鹿児島県",
			"沖縄県" ) as $p)
     printf("<option value='%s'%s>%s",
	    $p,
	    ($p == $prefecture ? " selected" : ""),
	    $p);
?>
                            </select>
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">市町村名</div>
                          </th>
                          <td class="font2_12"> 
                            <input size=40 name=city value="<?evf('city')?>">
                        <tr> 
                          <th class="font2_12"> 
                            <div align="right">ご住所</div>
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
                              <input type=image src="images/confirm_faq.gif" width=100 height=21 border=0 value="確認画面へ" name="submit">
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
          <td height="25">　</td>
          <td>
            <div align="right"><span class="font_m">|| <a href="index.php">HOME</a> 
              || <a href="01.php">インフォメーション</a> || <a href="02.html">企業情報</a> 
              || <a href="03.html">業務内容</a> || <a href="04.php">採用情報</a> || <a href="05.php">お問合せ</a> 
              || <a href="06.html">サイトマップ</a> || <a href="07.html">English</a> 
              ||</span><img src="images/white.gif" width="5" height="1"><br>
              <img src="images/spacer.gif" width="1" height="10"> <br>
            </div>
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
