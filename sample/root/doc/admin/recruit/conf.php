<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\..\\php_lib"
	  : ":../../../php_lib" ));



include_once("RPS_LIB.php");
$mode = gv("mode");


if(rmmq(gv("koyoukeitai")) == "����¾")
     pv("koyoukeitai",
	rmmq(gv("koyoukeitai_sonota")));


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title><?echo $mode=="edit" ? "�Խ�" : "������Ͽ" ?>��ǧ�����Ѿ��� ����</title>
<link href="../css/style.css" rel=stylesheet type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#0000FF" alink="#FF0000">

<div align=center><a name=top></a><br>
  <table width="90%" border=1 cellpadding=3 cellspacing=0 bordercolor="#999999">
    <tr>
      <td width="75%" class=big><strong>���Ѿ��� ����</strong></td>
      <td width="25%" align=right class=big><?echo $mode=="edit" ? "�Խ�" : "������Ͽ" ?>��ǧ</td>


  </table>



  <br>
 <form name=form1 method=post action="index.php">
<?
$MainForm = new rps_form("form1");
$MainForm->pass_values();
?>
    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td width="100%"><input name=back type=button id=back value="���" onClick="history.back(); return false;">
          </td>


   </table>




    <hr width="80%">


    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr valign=top>
        <td width="20%" bgcolor="#FFFFCC">������</td>
        <td width="80%" bgcolor="#E6E6E6"><?ev("input_y")?>/<?ev("input_m")?>/<?ev("input_d")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">���ѷ���</td>
        <td bgcolor="#E6E6E6"><?ev2("koyoukeitai")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">�����ȥ�</td>
        <td bgcolor="#E6E6E6"><?ev2("title")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">����</td>
        <td bgcolor="#E6E6E6"><?ev2("shokushu")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">��Ϳ</td>
        <td bgcolor="#E6E6E6"><?ev5("kyuyo")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">�ܺٻŻ�����</td>
        <td bgcolor="#E6E6E6"><?ev5("shigotonaiyo")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">��̳��</td>
        <td bgcolor="#E6E6E6"><?ev5("kinmuchi")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">��̳����</td>
        <td bgcolor="#E6E6E6"><?ev5("kinmujikan")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">����</td>
        <td bgcolor="#E6E6E6"><?ev5("kyujitsu")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">��̳����</td>
        <td bgcolor="#E6E6E6"><?ev5("kinmukikan")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">���</td>
        <td bgcolor="#E6E6E6"><?ev5("shikaku")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">�Զ�</td>
        <td bgcolor="#E6E6E6"><?ev5("taigu")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">������ˡ</td>
        <td bgcolor="#E6E6E6"><?ev5("oubohoho")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">ô����̾</td>
        <td bgcolor="#E6E6E6"><?ev2("tantosha")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">�����ֹ�</td>
        <td bgcolor="#E6E6E6"><?ev2("denwabango")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">������E�᡼��</td>
        <td bgcolor="#E6E6E6"><?ev2("email")?>
        </td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">�������</td>
        <td bgcolor="#E6E6E6"><?ev("oubokikan_y")?>/<?ev("oubokikan_m")?>/<?ev("oubokikan_d")?>�ޤ� </td>


    </table>



    <br>
    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr>
        <td align=center bgcolor="#CCCCCC">
        <input name=conf
               type=submit
               value="<? echo $mode == 'edit' ? '�ѹ�����' : '��Ͽ����'; ?>">
        <input name=back
               type=button
               onClick="
                form1.action='<?echo $index == "" ? "new.php" : "edit.php";?>';
                form1.submit();"
               value="���">
    </table>




    <br>
  </form>
</div>
</body>
</html>
