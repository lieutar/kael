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
<title>一覧：採用情報 管理</title>
<link href="../css/style.css" rel=stylesheet type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#0000FF" alink="#FF0000">

<div align=center><a name=top></a><br>
  <table width="90%" border=1 cellpadding=3 cellspacing=0 bordercolor="#999999">
    <tr>
      <td width="75%" class=big><strong>採用情報 管理</strong></td>
      <td width="25%" align=right class=big>一覧</td>


  </table>



  <br>
 <form name=form1 method=post action="">
    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td colspan=2><input type=button onClick="location='new.php'" value="新規登録の場合はこちら">
      <tr>
        <td><input type=button onClick="location='data.php'"
                   value="応募データダウンロード"></td>
        <td><a href="../../04.php" target="_blank"
                   >貴社ＷＥＢサイト：採用情報ページを見る</a></td>


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
                              form1.submit();">←前の１０件</a>
          <?endif;?>
          <td align=center class=big><strong>採用情報一覧</strong>
          <td align=right width="20%">
	  <? if($db->has_more_page()):?>
	  <a href="javascript:form1.page.value=<?echo $page+1?>;
                              form1.submit();">次の１０件→</a>
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
              value="編集">
          <input name=delete type=button id=delete value="削除"
	      onClick="location = 'delete.php?index=<? echo $d->index; ?>'">
          <?if($kigengire){?>※この採用情報は応募期間を過ぎています<?}?>
    </table>



    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr valign=top>
        <td width="20%" bgcolor="#FFFFCC">入力日</td>
        <td width="80%" bgcolor="#E6E6E6"><? echo "$_y/$_m/$_d";?></td>

      <tr valign=top>
        <td bgcolor="#FFFFCC">雇用形態</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("koyoukeitai")?></td>

      <tr valign=top>
        <td bgcolor="#FFFFCC">タイトル</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("title")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">職種</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("shokushu")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">給与</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("kyuyo")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">詳細仕事内容</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("shigotonaiyo")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">勤務地</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("kinmuchi")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">勤務時間</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("kinmujikan")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">休日</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("kyujitsu")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">勤務期間</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("kinmukikan")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">資格</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("shikaku")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">待遇</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("taigu")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">応募方法</td>
        <td bgcolor="#E6E6E6"><?$d->ev4("oubohoho")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">担当者名</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("tantosha")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">電話番号</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("denwabango")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">応募先Eメール</td>
        <td bgcolor="#E6E6E6"><?$d->ev2("email")?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">応募期間</td>
        <td bgcolor="#E6E6E6"><?echo $oy;
                           ?>/<?echo $om;
                           ?>/<?echo $od;?>まで</td>


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
                              form1.submit();">←前の１０件</a>
          <?endif;?>
          <td align=center><a href="#top">このページのトップへ↑</a>
          <td align=right width="20%">
	  <? if($db->has_more_page()):?>
	  <a href="javascript:form1.page.value=<?echo $page+1?>;
                              form1.submit();">次の１０件→</a>
          <? endif; ?>
    </table>

  </form>
</div>
</body>
</html>
