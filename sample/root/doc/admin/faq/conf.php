<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\..\\php_lib"
	  : ":../../../php_lib" ));

include_once("RPS_DB.php");
include_once("RPS_LIB.php");

$index = gv("index");
$mode  = gv("mode");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title><? echo $index == "" ? "新規登録" : "編集"; ?>確認：業務内容 ＦＡＱ 管理</title>
<link href="../css/style.css" rel=stylesheet type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#0000FF" alink="#FF0000">

<div align=center><a name=top></a><br>
  <table width="90%" border=1 cellpadding=3 cellspacing=0 bordercolor="#999999">
    <tr>
      <td width="75%" class=big><strong>業務内容 ＦＡＱ 管理</strong></td>
      <td width="25%" align=right class=big><? echo $index == "" ? "新規登録" : "編集"; ?>確認</td>


  </table>



  <br>
 <form name=form1 method=post action="index.php">
<?
$MainForm = new rps_form("form1");
$MainForm->pass_values();
?>

    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td width="100%"
       ><input name=back
               type=button
               onClick="
                   form1.action='new.php';
                   form1.submit();"
               value="戻る">
          </td>


   </table>




    <hr width="80%">


    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr valign=top>
        <td width="20%" bgcolor="#FFFFCC">Q</td>
        <td width="80%" bgcolor="#E6E6E6"><?ev4("question");?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">A</td>
        <td bgcolor="#E6E6E6"><?ev4("answer");?></td>


    </table>



    <br>
    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr>
        <td align=center bgcolor="#CCCCCC">
        <input name=conf
               type=submit
               value="<? echo $mode == 'edit' ? '変更する' : '登録する'; ?>">
        <input name=back
               type=button
               onClick="
                   form1.action='new.php';
                   form1.submit();"
               value="戻る"></td>


    </table>




    <br>
  </form>
</div>
</body>
</html>
