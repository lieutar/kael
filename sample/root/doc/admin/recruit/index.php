<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\..\\php_lib"
	  : ":../../../php_lib" ));

include_once("RPS_DB.php");
include_once("RPS_LIB.php");




$MainForm = new rps_form("form1");
$mode = gv("mode");

$db = recruit_db_class("../data/recruit");


switch($mode)
{
 case "add":
   $data = $db->get_blank_data(gv("oubokikan_y"),
			       gv("oubokikan_m"),
			       gv("oubokikan_d"));
   $data->set_values();
   $data->reg();
   break;


 case "edit":
   $data =  $db->update_sort_key(gv("index"),
				 gv("oubokikan_y"),
				 gv("oubokikan_m"),
				 gv("oubokikan_d"));
   $data->set_values();
   $data->reg();
   break;


 case "remove":
   $db->remove_data(gv("index"));
   break;
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title>���������Ѿ��� ����</title>
<link href="../css/style.css" rel=stylesheet type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#0000FF" alink="#FF0000">

<div align=center><a name=top></a><br>
  <table width="90%" border=1 cellpadding=3 cellspacing=0 bordercolor="#999999">
    <tr>
      <td width="75%" class=big><strong>���Ѿ��� ����</strong></td>
      <td width="25%" align=right class=big>����</td>


  </table>



  <br>
 <form name=form1 method=post action="">
    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td colspan=2><input type=button onClick="location='new.php'" value="������Ͽ�ξ��Ϥ�����">
      <tr>
        <td><input type=button onClick="location='data.php'"
                   value="����ǡ������������"></td>
        <td><a href="../../04.php" target="_blank"
                   >���ңףţ¥����ȡ����Ѿ���ڡ����򸫤�</a></td>


   </table>



    <br>
    <hr width="80%">
    <br>


<?
$db->init();
$db->set_page_length(10);
$db->set_page(gv("page"));
$db->init_cursor();
?>


    <table width="80%" border=0 cellspacing=0 cellpadding=3>
      <tr><td width="20%">
          <? if(!$db->is_first_page()):?>
          <a href="javascript:form1.page.value=<?echo $page-1?>;
                              form1.submit();">�����Σ�����</a>
          <?endif;?>
          <td align=center class=big><strong>���Ѿ������</strong>
          <td align=right width="20%">
	  <? if($db->has_more_page()):?>
	  <a href="javascript:form1.page.value=<?echo $page+1?>;
                              form1.submit();">���Σ����</a>
          <? endif; ?>
    </table>


    <br>


<?
while(($d = $db->next_data())!==false)
{
  list($oy,$om,$od) = $d->get_date();
  $_y = $d->get_value("input_y");
  $_m = $d->get_value("input_m");
  $_d = $d->get_value("input_d");
  $now = getdate();
  $kigengire =
      $now["year"] > $oy ||
     ($now["year"] == $oy && $now["mon"] >  $om) ||
     ($now["year"] == $oy && $now["mon"] == $om  && $now["mday"] > $od);
?>
    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr>
        <td bgcolor="<?echo $kigengire ? "#FF0000" : "#CCCCCC" ?>">
	  <input name=edit type=button id=edit
	      onClick="location='edit.php?index=<? echo $d->index; ?>'"
              value="�Խ�">
          <input name=delete type=button id=delete value="���"
	      onClick="location = 'delete.php?index=<? echo $d->index; ?>'">
          <?if($kigengire){?>�����κ��Ѿ���ϱ�����֤�᤮�Ƥ��ޤ�<?}?>
    </table>



    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr valign=top>
        <td width="20%" bgcolor="#FFFFCC">������</td>
        <td width="80%" bgcolor="#E6E6E6"><? echo "$_y/$_m/$_d";?></td>

      <tr valign=top>
        <td bgcolor="#FFFFCC">���ѷ���</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("koyoukeitai")?></td>

      <tr valign=top>
        <td bgcolor="#FFFFCC">�����ȥ�</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("title")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">����</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("shokushu")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">��Ϳ</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("kyuyo")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">�ܺٻŻ�����</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("shigotonaiyo")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">��̳��</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("kinmuchi")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">��̳����</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("kinmujikan")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">����</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("kyujitsu")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">��̳����</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("kinmukikan")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">���</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("shikaku")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">�Զ�</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("taigu")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">������ˡ</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("oubohoho")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">ô����̾</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("tantosha")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">�����ֹ�</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("denwabango")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">������E�᡼��</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("email")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">�������</td>
        <td bgcolor="#E6E6E6"><?echo $oy;
                           ?>/<?echo $om;
                           ?>/<?echo $od;?>�ޤ�</td>


    </table>
    <br>
<?
}
?>
    <br>

    <table width="80%" border=0 cellspacing=0 cellpadding=3>
      <tr><td width="20%">
          <? if(!$db->is_first_page()):?>
          <a href="javascript:form1.page.value=<?echo $page-1?>;
                              form1.submit();">�����Σ�����</a>
          <?endif;?>
          <td align=center><a href="#top">���Υڡ����Υȥåפآ�</a>
          <td align=right width="20%">
	  <? if($db->has_more_page()):?>
	  <a href="javascript:form1.page.value=<?echo $page+1?>;
                              form1.submit();">���Σ����</a>
          <? endif; ?>
    </table>

  </form>
</div>
</body>
</html>
