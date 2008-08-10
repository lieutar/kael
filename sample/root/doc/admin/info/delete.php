<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\..\\php_lib"
	  : ":../../../php_lib" ));

include_once("RPS_DB.php");
include_once("RPS_LIB.php");




$MainForm = new rps_form("form1");
$db = new RPS_DB("../data/info",array("ttl","ctgl","info"));


$data = $db->get_data(gv("index"));
list($_y,$_m,$_d) = $data->get_date();

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title>削除確認：インフォメーション管理</title>
<link href="../css/style.css" rel=stylesheet type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#0000FF" alink="#FF0000">

<div align=center><a name=top></a><br>
  <table width="90%" border=1 cellpadding=3 cellspacing=0 bordercolor="#999999">
    <tr>
      <td width="75%" class=big><strong>インフォメーション（ニュース）管理</strong></td>
      <td width="25%" align=right class=big>削除確認</td>


  </table>



  <br>
 <form name=form1 method=post action="index.php">
 <input type=hidden name=mode value=remove>
 <input type=hidden name=index value=<?ev("index");?>>
    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td width="50%"><input name=back type=button id=back value="戻る" onClick="history.back(); return false;">
          </td>
        <td width="50%" align=right>削除する前に確認してください。</td>


   </table>




    <hr width="80%">


    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr valign=top>
        <td width="20%" bgcolor="#FFCCCC">発表日</td>
        <td width="80%" bgcolor="#E6E6E6"><?echo "$_y/$_m/$_d";?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">タイトル</td>
        <td bgcolor="#E6E6E6"><?$data->ev2("ttl");?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">分類</td>
        <td bgcolor="#E6E6E6"><?$data->ev2("ctgl");?></td>


      <tr valign=top>
        <td bgcolor="#FFCCCC">内容</td>
        <td bgcolor="#E6E6E6"><?$data->ev4("info");?></td>
    </table>





    <br>
    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr>
        <td align=center bgcolor="#CCCCCC">
          <input type=submit value="削除する">
          <input type=button value="戻る"
                 onClick="location.href='index.php';">
        </td>


    </table>




    <br>
  </form>
</div>
</body>
</html>
