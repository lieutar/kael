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
<title>�����ǧ�����Ѿ��� ����</title>
<link href="../css/style.css" rel=stylesheet type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#0000FF" alink="#FF0000">

<div align=center><a name=top></a><br>
  <table width="90%" border=1 cellpadding=3 cellspacing=0 bordercolor="#999999">
    <tr>
      <td width="75%" class=big><strong>���Ѿ��� ����</strong></td>
      <td width="25%" align=right class=big>�����ǧ</td>


  </table>



  <br>
 <form name=form1 method=post action="index.php">
    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td>
<input name=back type=button id=back value="���" onClick="history.back(); return false;">
          </td>
        <td align=right>����������˳�ǧ���Ƥ���������</td>


   </table>




    <hr width="80%">


    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr valign=top>
        <td width="20%" bgcolor="#FFCCCC">������</td>
        <td width="80%" bgcolor="#E6E6E6"><? echo "$_y/$_m/$_d";?></td>

      <tr valign=top>
        <td bgcolor="#FFCCCC">���ѷ���</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("koyoukeitai")?></td>

      <tr valign=top>
        <td bgcolor="#FFCCCC">�����ȥ�</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("title")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">����</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("shokushu")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">��Ϳ</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("kyuyo")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">�ܺٻŻ�����</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("shigotonaiyo")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">��̳��</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("kinmuchi")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">��̳����</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("kinmujikan")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">����</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("kyujitsu")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">��̳����</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("kinmukikan")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">���</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("shikaku")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">�Զ�</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("taigu")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">������ˡ</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("oubohoho")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">ô����̾</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("tantosha")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">�����ֹ�</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("denwabango")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">������E�᡼��</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("email")?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">�������</td>
        <td bgcolor="#E6E6E6"><?$d->ev("oubokikan_y")
                           ?>/<?$d->ev("oubokikan_m")
                           ?>/<?$d->ev("oubokikan_d")?>�ޤ�</td>


    </table>



    <br>
<input type=hidden name=mode value=remove>
<input type=hidden name=index value=<?evf("index")?>>
    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr>
        <td align=center bgcolor="#CCCCCC">
<input name=delete type=submit id=delete value="�������">
          <input name=back type=button id=back value="���" onClick="location.href='index.php'">
        </td>


    </table>




    <br>
  </form>
</div>
</body>
</html>
