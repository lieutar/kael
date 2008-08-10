<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\..\\php_lib"
	  : ":../../../php_lib" ));



include_once("RPS_LIB.php");
$mode = gv("mode");


if(rmmq(gv("koyoukeitai")) == "その他")
     pv("koyoukeitai",
	rmmq(gv("koyoukeitai_sonota")));


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title><?echo $mode=="edit" ? "編集" : "新規登録" ?>確認：採用情報 管理</title>
<link href="../css/style.css" rel=stylesheet type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#0000FF" alink="#FF0000">

<div align=center><a name=top></a><br>
  <table width="90%" border=1 cellpadding=3 cellspacing=0 bordercolor="#999999">
    <tr>
      <td width="75%" class=big><strong>採用情報 管理</strong></td>
      <td width="25%" align=right class=big><?echo $mode=="edit" ? "編集" : "新規登録" ?>確認</td>


  </table>



  <br>
 <form name=form1 method=post action="index.php">
<?
$MainForm = new rps_form("form1");
$MainForm->pass_values();
?>
    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td width="100%"><input name=back type=button id=back value="戻る" onClick="history.back(); return false;">
          </td>


   </table>




    <hr width="80%">


    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr valign=top>
        <td width="20%" bgcolor="#FFFFCC">入力日</td>
        <td width="80%" bgcolor="#E6E6E6"><?ev("input_y")?>/<?ev("input_m")?>/<?ev("input_d")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">雇用形態</td>
        <td bgcolor="#E6E6E6"><?ev2("koyoukeitai")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">タイトル</td>
        <td bgcolor="#E6E6E6"><?ev2("title")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">職種</td>
        <td bgcolor="#E6E6E6"><?ev2("shokushu")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">給与</td>
        <td bgcolor="#E6E6E6"><?ev5("kyuyo")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">詳細仕事内容</td>
        <td bgcolor="#E6E6E6"><?ev5("shigotonaiyo")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">勤務地</td>
        <td bgcolor="#E6E6E6"><?ev5("kinmuchi")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">勤務時間</td>
        <td bgcolor="#E6E6E6"><?ev5("kinmujikan")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">休日</td>
        <td bgcolor="#E6E6E6"><?ev5("kyujitsu")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">勤務期間</td>
        <td bgcolor="#E6E6E6"><?ev5("kinmukikan")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">資格</td>
        <td bgcolor="#E6E6E6"><?ev5("shikaku")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">待遇</td>
        <td bgcolor="#E6E6E6"><?ev5("taigu")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">応募方法</td>
        <td bgcolor="#E6E6E6"><?ev5("oubohoho")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">担当者名</td>
        <td bgcolor="#E6E6E6"><?ev2("tantosha")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">電話番号</td>
        <td bgcolor="#E6E6E6"><?ev2("denwabango")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">応募先Eメール</td>
        <td bgcolor="#E6E6E6"><?ev2("email")?>
        </td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">応募期間</td>
        <td bgcolor="#E6E6E6"><?ev("oubokikan_y")?>/<?ev("oubokikan_m")?>/<?ev("oubokikan_d")?>まで </td>


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
                form1.action='<?echo $index == "" ? "new.php" : "edit.php";?>';
                form1.submit();"
               value="戻る">
    </table>




    <br>
  </form>
</div>
</body>
</html>
