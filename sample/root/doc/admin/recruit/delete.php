<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\..\\php_lib"
	  : ":../../../php_lib" ));

include_once("RPS_DB.php");
include_once("RPS_LIB.php");




$MainForm = new rps_form("form1");
$db = recruit_db_class("../data/recruit");

$d = $db->get_data(gv("index"));
list($_y,$_m,$_d) = $d->get_date();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC_JP">
<title>削除確認：採用情報 管理</title>
<link href="../css/style.css" rel=stylesheet type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#0000FF" alink="#FF0000">

<div align=center><a name=top></a><br>
  <table width="90%" border=1 cellpadding=3 cellspacing=0 bordercolor="#999999">
    <tr>
      <td width="75%" class=big><strong>採用情報 管理</strong></td>
      <td width="25%" align=right class=big>削除確認</td>


  </table>



  <br>
 <form name=form1 method=post action="index.php">
    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td>
<input name=back type=button id=back value="戻る" onClick="history.back(); return false;">
          </td>
        <td align=right>削除する前に確認してください。</td>


   </table>




    <hr width="80%">


    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr valign=top>
        <td width="20%" bgcolor="#FFCCCC">入力日</td>
        <td width="80%" bgcolor="#E6E6E6"><? echo "$_y/$_m/$_d";?></td>

      <tr valign=top>
        <td bgcolor="#FFCCCC">雇用形態</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("koyoukeitai")?></td>

      <tr valign=top>
        <td bgcolor="#FFCCCC">タイトル</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("title")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">職種</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("shokushu")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">給与</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("kyuyo")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">詳細仕事内容</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("shigotonaiyo")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">勤務地</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("kinmuchi")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">勤務時間</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("kinmujikan")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">休日</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("kyujitsu")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">勤務期間</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("kinmukikan")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">資格</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("shikaku")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">待遇</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("taigu")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">応募方法</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("oubohoho")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">担当者名</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("tantosha")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">電話番号</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("denwabango")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">応募先Eメール</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("email")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">応募期間</td>
        <td bgcolor="#E6E6E6"><?$d->ev("oubokikan_y")
                           ?>/<?$d->ev("oubokikan_m")
                           ?>/<?$d->ev("oubokikan_d")?>まで</td>


    </table>



    <br>
<input type=hidden name=mode value=remove>
<input type=hidden name=index value=<?evf("index")?>>
    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr>
        <td align=center bgcolor="#CCCCCC">
<input name=delete type=submit id=delete value="削除する">
          <input name=back type=button id=back value="戻る" onClick="location.href='index.php'">
        </td>


    </table>




    <br>
  </form>
</div>
</body>
</html>
