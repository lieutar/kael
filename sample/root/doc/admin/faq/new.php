<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\..\\php_lib"
	  : ":../../../php_lib" ));



include_once("RPS_LIB.php");
include_once("RPS_DB.php");

$MainForm = new rps_form("form1");
$index = gv("index");
if($index != null &&
   gv("question") == "")
{
  $db = new RPS_DB("../data/faq",array("question",
				  "answer"),false);
  $data =$db->get_data($index);
  $data->put_values();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title><? echo $index == "" ? "新規登録" : "編集"; ?>：業務内容 ＦＡＱ 管理</title>
<link href="../css/style.css" rel=stylesheet type="text/css">
<script type="text/javascript">
<!--
function check_data()
{
  if(document.form1.question.value.length < 1)
    {
      alert("質問が入力されていません");
      return false;
    }

  if(document.form1.answer.value.length < 1)
    {
      alert("回答が入力されていません");
      return false;
    }

  document.form1.submit();
}
//-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#0000FF" alink="#FF0000">

<div align=center><a name=top></a><br>
  <table width="90%" border=1 cellpadding=3 cellspacing=0 bordercolor="#999999">
    <tr>
      <td width="75%" class=big><strong>業務内容 ＦＡＱ 管理</strong></td>
      <td width="25%" align=right class=big
        ><? echo $index == "" ? "新規登録" : "編集"; ?></td>
  </table>



  <br>
 <form name=form1 method=post action="conf.php">
  <input type=hidden
         name=mode
         value="<?echo $index != null ? "edit" : "add" ;?>">
<? if($index != null) :?>
  <input type=hidden name=index value=<?evf("index")?>>
<? endif; ?>

    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td width="100%"
       ><input name=back type=button id=back value="戻る"
               onClick="location.href='index.php';">
   </table>


    <hr width="80%">


    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr valign=top>
        <td width="20%" bgcolor="#FFFFCC">Q</td>
        <td width="80%" bgcolor="#E6E6E6"
         ><textarea name=question cols=50 rows=3 id=question
         ><?evf("question")?></textarea></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">A</td>
        <td bgcolor="#E6E6E6"><textarea name=answer cols=50 rows=10 id=answer
        ><?evf("answer")?></textarea></td>


    </table>



    <br>
    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr>
        <td align=center bgcolor="#CCCCCC">
        <input name=conf type=button value="確認画面へ"
               onClick="check_data();">
          <input name=back type=button id=back value="戻る"
                 onClick="location.href='index.php';">
        </td>
    </table>




    <br>
  </form>
</div>
</body>
</html>

