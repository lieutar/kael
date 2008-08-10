<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\..\\php_lib"
	  : ":../../../php_lib" ));



include_once("RPS_LIB.php");

$MainForm = new rps_form("form1");
$index = gv("index");
if($index != null &&
   gv("oubokikan_y") == "")
{
  $db = recruit_db_class("../data/recruit");
  $data =$db->get_data($index);
  $data->put_values();
  $data->put_date_data("oubokikan_y",
		       "oubokikan_m",
		       "oubokikan_d");
}




?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title><?echo $index != "" ? "編集" : "新規登録" ?>：採用情報 管理</title>
<link href="../css/style.css" rel=stylesheet type="text/css">
<script type="text/javascript">
<!--
<? $MainForm->js_check_date(); ?>

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

<body bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#0000FF" alink="#FF0000">

<div align=center><a name=top></a><br>
  <table width="90%"
         border=1 cellpadding=3 cellspacing=0 bordercolor="#999999">
    <tr>
      <td width="75%" class=big><strong>採用情報 管理</strong></td>
      <td width="25%" align=right class=big><?echo $index != "" ? "編集" : "新規登録" ?></td>

  </table>



  <br>
 <form name=form1 method=post action="conf.php"
onsubmit="return check_data();">
  <input type=hidden name=mode value="<?echo $index != null ? "edit" : "add" ;?>">
<? if($index != null) :?>
  <input type=hidden name=index value=<?evf("index")?>>
<? endif; ?>

    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td width="100%"><input name=back type=button id=back value="戻る" onClick="location.href='index.php';">
    </table>




    <hr width="80%">


    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr valign=top>
        <td width="20%" bgcolor="#FFFFCC">入力日</td>
        <td width="80%" bgcolor="#E6E6E6"
         ><? $MainForm->date_form("input") ?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">雇用形態</td>
        <td bgcolor="#E6E6E6"><input name=koyoukeitai type=text value="<?evf("koyoukeitai")?>" size=60></td>

<?if(gv("title")!=""):?>      <tr valign=top>
        <td bgcolor="#FFFFCC">タイトル</td>
        <td bgcolor="#E6E6E6"><input name=title type=text value="<?evf("title")?>" size=60></td>

<?endif;if(gv("shokushu")!=""):?>
      <tr valign=top>
        <td bgcolor="#FFFFCC">職種</td>
        <td bgcolor="#E6E6E6"><input name=shokushu type=text value="<?evf("shokushu")?>" size=60></td>

<?endif;if(gv("kyuyo")!=""):?>
      <tr valign=top>
        <td bgcolor="#FFFFCC">給与</td>
        <td bgcolor="#E6E6E6"><textarea name=kyuyo cols=50 rows=3><?evf("kyuyo")?></textarea></td>

<?endif;if(gv("shigotonaiyo")!=""):?>
      <tr valign=top>
        <td bgcolor="#FFFFCC">詳細仕事内容</td>
        <td bgcolor="#E6E6E6"><textarea name=shigotonaiyo cols=50 rows=3><?evf("shigotonaiyo")?></textarea></td>

<?endif;if(gv("kinmuchi")!=""):?>
      <tr valign=top>
        <td bgcolor="#FFFFCC">勤務地</td>
        <td bgcolor="#E6E6E6"><textarea name=kinmuchi cols=50 rows=3><?evf("kinmuchi")?></textarea></td>

<?endif;if(gv("kinmujikan")!=""):?>
      <tr valign=top>
        <td bgcolor="#FFFFCC">勤務時間</td>
        <td bgcolor="#E6E6E6"><textarea name=kinmujikan cols=50 rows=3><?evf("kinmujikan")?></textarea></td>

<?endif;if(gv("kyujitsu")!=""):?>
      <tr valign=top>
        <td bgcolor="#FFFFCC">休日</td>
        <td bgcolor="#E6E6E6"><textarea name=kyujitsu cols=50 rows=3><?evf("kyujitsu")?></textarea></td>

<?endif;if(gv("kinmukikan")!=""):?>
      <tr valign=top>
        <td bgcolor="#FFFFCC">勤務期間</td>
        <td bgcolor="#E6E6E6"><textarea name=kinmukikan cols=50 rows=3><?evf("kinmukikan")?></textarea></td>

<?endif;if(gv("shikaku")!=""):?>
      <tr valign=top>
        <td bgcolor="#FFFFCC">資格</td>
        <td bgcolor="#E6E6E6"><textarea name=shikaku cols=50 rows=3><?evf("shikaku")?></textarea></td>

<?endif;if(gv("taigu")!=""):?>
      <tr valign=top>
        <td bgcolor="#FFFFCC">待遇</td>
        <td bgcolor="#E6E6E6"><textarea name=taigu cols=50 rows=3><?evf("taigu")?></textarea></td>

<?endif;if(gv("oubohoho")!=""):?>
      <tr valign=top>
        <td bgcolor="#FFFFCC">応募方法</td>
        <td bgcolor="#E6E6E6"><textarea name=oubohoho cols=50 rows=3><?evf("oubohoho")?></textarea></td>

<?endif;if(gv("tantosha")!=""):?>
      <tr valign=top>
        <td bgcolor="#FFFFCC">担当者名</td>
        <td bgcolor="#E6E6E6"><input name=tantosha type=text value="<?evf("tantosha")?>" size=60></td>

<?endif;if(gv("denwabango")!=""):?>
      <tr valign=top>
        <td bgcolor="#FFFFCC">電話番号</td>
        <td bgcolor="#E6E6E6"><input name=denwabango type=text value="<?evf("denwabango")?>" size=60></td>

<?endif;if(gv("email")!=""):?>

      <tr valign=top>
        <td bgcolor="#FFFFCC">応募先Eメール</td>
        <td bgcolor="#E6E6E6"><input name=email type=text value="<?evf("email")?>" size=60>
        </td>

<?endif;if(gv("oubokikan_y")!=""):?>

      <tr valign=top>
        <td bgcolor="#FFFFCC">応募期間</td>
        <td bgcolor="#E6E6E6"><?echo $MainForm->date_form("oubokikan");
                              ?>まで</td>

<?endif?>
    </table>



    <br>
    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr>
        <td align=center bgcolor="#CCCCCC">
        <input type=submit
               value="確認画面へ"
               onClick="
         var df  = document.form1;
         var dfe = document.form1.elements;
         var essential =
             new Array( df.koyoukeitai              ,         '雇用形態' ,
                        df.title                    ,         'タイトル' ,
		        df.shokushu                 ,             '職種' ,
	   	        df.kyuyo                    ,         '給与種別' ,
                        df.shigotonaiyo             ,     '詳細仕事内容' ,
                        df.kinmujikan               ,         '勤務時間' ,
                        df.shikaku                  ,         '応募資格' ,
                        df.oubohoho                 ,         '応募方法' ,
                        df.tantosha                 ,         '担当者名' ,
                        df.denwabango               ,         '電話番号' ,
                        df.email                    ,    '応募先Eメール' );

         for(i=0;i<essential.length;i+=2)
           {
             var e = essential[i];

             if(e.value.length == 0)
               {
                 alert('【'+essential[i+1]+'】が入力されていません');
                 return false;
               }
           }

        return true;">
          <input type=button value="戻る"
	         onClick="location.href='index.php';">
        </td>
    </table>




    <br>
  </form>
</div>
</body>
</html>
