<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\..\\php_lib"
	  : ":../../../php_lib" ));



include_once("RPS_LIB.php");

$MainForm = new rps_form("form1");

$vh  = gv("vhead");
$vf  = gv("vfoot");

if($koyoukeitai == null)$koyoukeitai = "社員";
if(gv("koyoukeitai_sonota") != "") $koyoukeitai = "その他";



function vfcbox($name,$value)
{
  global $vf;
  printf("<input type=checkbox name='vfoot[%s][]' value='%s'",
	 $name,$value);
  if(is_array($vf[$name]))
    {
      foreach($vf[$name] as $v)
	{
	  if($v == $value) echo " checked";
	}
    }
  echo ">$value";
}

function vhconst($name,$value,$num = "")
{
  printf("<input type=hidden name='vhead[%s][%s]' value='%s'>%s",
	 $name,$num,$value,$value);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title>新規入力：採用情報 管理</title>
<link href="../css/style.css" rel=stylesheet type="text/css">
<script type="text/javascript">
<!--
var essential = null;
var sonota    = null;
var df        = null;
var dfe       = null;

function init()
{
  df  = document.form1;
  dfe = document.form1.elements;
  essential =
    new Array( df.title                    ,         'タイトル' ,
	       /*
	       df.shokushu                 ,             '職種' ,
	       dfe['vhead[kyuyo][0]']      ,         '給与種別' ,
	       dfe['vhead[kyuyo][1]']      ,           '給与額' ,
	       df.shigotonaiyo             ,     '詳細仕事内容' ,
	       dfe['vhead[kinmujikan][0]'] ,     '勤務開始時間' ,
	       dfe['vhead[kinmujikan][1]'] ,     '勤務終了時間' ,
	       dfe['vhead[shikaku][1]']    , '応募資格年齢下限' ,
	       dfe['vhead[shikaku][3]']    , '応募資格年齢上限' ,
	       */
	       df.tantosha                 ,         '担当者名' ,
	       df.denwabango               ,         '電話番号' ,
	       df.email                    ,    '応募先Eメール' );

  for(i=0;i<df.koyoukeitai.length;i++)
    {
      if(df.koyoukeitai[i].value=="その他")
	{
	  sonota = df.koyoukeitai[i];
	  break;
	}
    }
}

<? $MainForm->js_check_date(); ?>

function check_sonota()
{
  if(sonota == null) init();
  if(sonota.checked == false)
    {
      df.koyoukeitai_sonota.value    = '';
      df.koyoukeitai_sonota.disabled = true;
    }
  else
    {
      df.koyoukeitai_sonota.disabled = false;
    }
}


function check_data()
{
  if(essential == null) init();


  for(i=0;i<essential.length;i+=2)
    {
      var e = essential[i];
      if(e.value.length == 0)
	{
	  alert('【'+essential[i+1]+'】が入力されていません');
	  return false;
	}
    }

  /*
  if(!dfe['vfoot[oubohoho][0]'].checked &&
     !dfe['vfoot[oubohoho][1]'].checked &&
     df.oubohoho.value.length == 0)
    {
      alert('【応募方法】が入力されていません');
      return false;
    };
  */

  if(sonota.checked && df.koyoukeitai_sonota.value.length < 1)
    {
      alert('【雇用形態】に「その他」が選択されていますが、'+
	    'その内容が記入されていません');
      return false;
    }

  if(df.koyoukeitai.length)
    for(i=0;i<df.koyoukeitai.length;i++)
      if(df.koyoukeitai[i].checked == true) return true;

  alert('【雇用形態】が未選択です');
  return false;
}


//-->
</script>
</head>

<body bgcolor="#FFFFFF"
      text   ="#000000"
      link   ="#0000FF"
      vlink  ="#0000FF"
      alink  ="#FF0000"
      onload = "check_sonota()">

<div align=center><a name=top></a><br>
  <table width="90%" border=1 cellpadding=3 cellspacing=0 bordercolor="#999999">
    <tr>
      <td width="75%" class=big><strong>採用情報 管理</strong></td>
      <td width="25%" align=right class=big>新規入力</td>


  </table>



  <br>
 <form name=form1 method=post action="conf.php"
       onsubmit="return check_data();">
  <input type=hidden name=mode value="<?echo $index != null ? "edit" : "add" ;?>">
<? if($index != null) :?>
  <input type=hidden name=index value=<?evf("index")?>>
<? endif;
$now = getdate();
?>
<input type=hidden name=input_y value=<?echo $now["year"]?>>
<input type=hidden name=input_m value=<?echo $now["mon"]?>>
<input type=hidden name=input_d value=<?echo $now["mday"]?>>

    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td width="100%"><input name=back type=button id=back value="戻る" onClick="location.href='index.php';">
          </td>


      <tr>
        <td>募集する内容を以下の項目にしたがって入力してください。（<font
            color="#FF0000">*</font>印は入力必須項目です）</td>

   </table>




    <hr width="80%">


    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr valign=top>
        <td width="20%" bgcolor="#FFFFCC"
         >雇用形態<font color="#FF0000">*</font></td>
        <td width="80%" bgcolor="#E6E6E6">


          <table width="100%" border=0 cellspacing=0 cellpadding=2>
            <tr>
              <td nowrap>
                <input type=radio
                       name=koyoukeitai
                       value="社員"<?if($koyoukeitai == "社員")
                                      echo " checked"?>
                       onClick="check_sonota()">社員
              <td nowrap>
<input type=radio name=koyoukeitai value="アルバイト"<?if($koyoukeitai == "アルバイト")echo " checked"?> onClick="check_sonota()">アルバイト
              <td nowrap>
<input type=radio name=koyoukeitai value="パート"<?if($koyoukeitai == "パート")echo " checked"?> onClick="check_sonota()">パート
              <td nowrap>
<input type=radio name=koyoukeitai value="契約社員"<?if($koyoukeitai == "契約社員")echo " checked"?> onClick="check_sonota()">契約社員
              <td nowrap>
<input type=radio name=koyoukeitai value="嘱託社員"<?if($koyoukeitai == "嘱託社員")echo " checked"?> onClick="check_sonota()">嘱託社員

            <tr>
              <td nowrap><input type=radio name=koyoukeitai value="派遣社員"<?if($koyoukeitai == "派遣社員")echo " checked"?> onClick="check_sonota()">派遣社員
              <td nowrap>
<input type=radio name=koyoukeitai value="期間従業員"<?if($koyoukeitai == "期間従業員")echo " checked"?> onClick="check_sonota()">期間従業員
              <td nowrap>
<input type=radio name=koyoukeitai value="紹介制"<?if($koyoukeitai == "紹介制")echo " checked"?> onClick="check_sonota()">紹介制
              <td nowrap>
<input type=radio name=koyoukeitai value="登録制"<?if($koyoukeitai == "登録制")echo " checked"?> onClick="check_sonota()">登録制
              <td nowrap>
<input type=radio name=koyoukeitai value="業務委託"<?if($koyoukeitai == "業務委託")echo " checked"?> onClick="check_sonota()">業務委託

<tr>
     <td nowrap colspan=5>
<input type=radio name=koyoukeitai value="その他"<?if($koyoukeitai == "その他")
echo " checked"?> onClick="check_sonota()">その他
<input name=koyoukeitai_sonota value="<?evf("koyoukeitai_sonota")?>">

          </table>



      <tr valign=top>
        <td bgcolor="#FFFFCC">タイトル<font color="#FF0000">*</font></td>
        <td bgcolor="#E6E6E6"><input name=title type=text size=60
                                     value="<?evf("title");?>"></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">職種</td>
        <td bgcolor="#E6E6E6"
         ><input name =shokushu
                 type =text
                 size =60
                 value="<? evf("shokushu"); ?>"></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">給与</td>
        <td bgcolor="#E6E6E6">

          <select name="vhead[kyuyo][0]">
            <option value="">お選びください</option>
            <option value="時給"
	      <?if($vf["kyuyo"][0] == "時給"  )echo "selected"?>>時給
            <option value="日給"
	      <?if($vf["kyuyo"][0] == "日給"  )echo "selected"?>>日給
            <option value="月給"
	      <?if($vf["kyuyo"][0] == "月給"  )echo "selected"?>>月給
            <option value="年俸制"
	      <?if($vf["kyuyo"][0] == "年俸制")echo "selected"?>>年俸制
          </select>

          <input type =text
                 name ="vhead[kyuyo][1]"
                 value="<?echo $vf["kyuyo"][1];?>">
          <?vhconst("kyuyo","円",2)?><br>
	      <input type=hidden name="vheaddep[kyuyo][2]" value="1">

          その他・補足説明<br>
          <textarea name=kyuyo cols=50 rows=3><?evf("kyuyo");?></textarea></td>

      <tr valign=top>
        <td bgcolor="#FFFFCC">詳細仕事内容</td>
        <td bgcolor="#E6E6E6"><textarea name=shigotonaiyo cols=50 rows=3
                              ><?evf("shigotonaiyo")?></textarea></td>

      <tr valign=top>
        <td bgcolor="#FFFFCC">勤務地</td>
        <td bgcolor="#E6E6E6"><textarea name=kinmuchi cols=50 rows=3
                             ><?evf("kinmuchi")?></textarea></td>

      <tr valign=top>
        <td bgcolor="#FFFFCC">勤務時間</td>
        <td bgcolor="#E6E6E6"
         ><table width="100%" border=0 cellspacing=0 cellpadding=0>
            <tr>
              <td colspan=2><input type=text
                                   name="vhead[kinmujikan][0]"
                                   size=10
                                   maxlength=10
	                           value="<?echo $vh["kinmujikan"][0]?>"
	        ><?vhconst("kinmujikan", "時〜", 1)?>
                <input type=text
                       name="vhead[kinmujikan][2]"
                       size=10
                       maxlength=10
	               value="<?echo $vh["kinmujikan"][2]?>"
	        ><?vhconst("kinmujikan","時迄",3)?>
	  <input type=hidden name="vheaddep[kinmujikan][1]" value=0>
	  <input type=hidden name="vheaddep[kinmujikan][3]" value=2>
            <tr>
              <td><?vfcbox("kinmujikan","残業有り");?>
	      <td><?vfcbox("kinmujikan","時間は応相談")?>>

            <tr>
              <td colspan=2> その他・補足説明<br>
               <textarea name="kinmujikan" cols=50 rows=3
               ><?evf("kinmujikan")?></textarea>
      </table>

      <tr valign=top>
        <td bgcolor="#FFFFCC">休日</td>
        <td bgcolor="#E6E6E6"><table width="100%"
                                     border=0 cellspacing=0 cellpadding=0>
            <tr>
              <td><?vfcbox("kyujitsu","土日祝")?>
              <td><?vfcbox("kyujitsu","シフト制")?>
              <td><?vfcbox("kyujitsu","不定期")?>

            <tr>
              <td colspan=3> その他・補足説明<br>
              <textarea name=kyujitsu cols=50 rows=3><?evf("kyujitsu")?></textarea>
       </table>





      <tr valign=top>
        <td bgcolor="#FFFFCC">勤務期間</td>
        <td bgcolor="#E6E6E6"
        ><table width="100%" border=0 cellspacing=0 cellpadding=0>
            <tr>
              <td><?vfcbox("kinmukikan","長期")?>
              <td><?vfcbox("kinmukikan","短期")?>
              <td><?vfcbox("kinmukikan","レギュラー")?>
              <td><?vfcbox("kinmukikan","一年以上")?>
            <tr>
              <td colspan=4> その他・補足説明<br>
              <textarea name=kinmukikan cols=50 rows=3
                ><?evf("kinmukikan")?></textarea>
      </table>





      <tr valign=top>
        <td bgcolor="#FFFFCC">資格</td>
        <td bgcolor="#E6E6E6"
           ><table width="100%" border=0 cellspacing=0 cellpadding=0>
            <tr>
              <td colspan=2>
	        <?vhconst("shikaku","年令",0);?>
                <input type=text name="vhead[shikaku][1]" size=10 maxlength=10
                       value="<?echo $vh["shikaku"][1]?>">
                <?vhconst("shikaku","才〜",2);?>
                <input type=text name="vhead[shikaku][3]" size=10 maxlength=10
                       value="<?echo $vh["shikaku"][3]?>">
                <?vhconst("shikaku","才迄",4);?>

		<input type=hidden name="vheaddep[shikaku][1][or][]" value=1>
		<input type=hidden name="vheaddep[shikaku][0][or][]" value=3>
		<input type=hidden name="vheaddep[shikaku][2]"       value=1>
		<input type=hidden name="vheaddep[shikaku][4]"       value=3>



            <tr>
              <td colspan=2>
                必要な資格（免許・英検など）<br>
                <input type=text name="shikaku" size=60 maxlength=200
                       value="<?evf("shikaku")?>">
            <tr>
              <td><?vfcbox("shikaku","未経験者歓迎")?>
              <td><?vfcbox("shikaku","経験者優遇")?>
            <tr>
              <td colspan=2> その他・補足説明<br>
              <textarea name="shikaku" cols=50 rows=3></textarea>
      </table>

    </td>

      <tr valign=top>
        <td bgcolor="#FFFFCC">待遇</td>
        <td bgcolor="#E6E6E6"
          ><table width="100%" border=0 cellspacing=0 cellpadding=0>
            <tr><td><?vfcbox("taigu","交通費支給")?>
                <td><?vfcbox("taigu","社員登用有")?>
            <tr><td><?vfcbox("taigu","昇給有り")?>
                <td><?vfcbox("taigu","研修期間有り")?>
            <tr>
              <td colspan=2> その他・補足説明（保険・福利厚生など）<br>
              <textarea name=taigu cols=50 rows=3><?evf("taigu");?></textarea>
      </table>


      <tr valign=top>
        <td bgcolor="#FFFFCC">応募方法</td>
        <td bgcolor="#E6E6E6"
         ><table width="100%" border=0 cellspacing=0 cellpadding=0>
            <tr><td><?vfcbox("oubohoho","応募フォームから")?>
            <tr><td><?vfcbox("oubohoho","電話連絡の上履歴書持参")?>
            <tr>
              <td> その他・補足説明<br>
              <textarea name="oubohoho" cols=50 rows=3
               ><?evf("oubohoho")?></textarea>
         </table>

      <tr valign=top>
        <td bgcolor="#FFFFCC">担当者名<font color="#FF0000">*</font></td>
        <td bgcolor="#E6E6E6"><input name=tantosha type=text size=60
                                     value="<?evf("tantosha")?>"></td>

      <tr valign=top>
        <td bgcolor="#FFFFCC">電話番号<font color="#FF0000">*</font></td>
        <td bgcolor="#E6E6E6"><input name=denwabango type=text size=60
                                     value="<?evf("denwabango");?>"></td>

      <tr valign=top>
        <td bgcolor="#FFFFCC">応募先Eメール<font color="#FF0000">*</font></td>
        <td bgcolor="#E6E6E6"><input name=email type=text size=60
                                     value="<?evf("email")?>">
          <br>
          ※半角英数で入力してください</td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">応募期間<font color="#FF0000">*</font></td>
        <td bgcolor="#E6E6E6"><?echo $MainForm->date_form("oubokikan");?></td>
    </table>

    <br>

    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr>
        <td align=center bgcolor="#CCCCCC">
        <input type=submit value="確認する">
        <input type=button value="戻る" onClick="location.href='index.php';">
        </td>


    </table>

    <br>

  </form>
</div>
</body>
</html>
