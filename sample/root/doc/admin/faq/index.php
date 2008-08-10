<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\..\\php_lib"
	  : ":../../../php_lib" ));

include_once("RPS_DB.php");
include_once("RPS_LIB.php");





$db = new RPS_DB("../data/faq",array("question","answer"),false);


switch(gv("mode"))
{
 case "add":
   $data = $db->get_blank_data();
   $data->set_values();
   $data->reg();
   break;

 case "edit":
   $data =  $db->get_data(gv("index"));
   $data->set_values();
   $data->reg();
   break;

 case "up":
   $db->up(gv("index"));
   break;

 case "down":
   $db->down(gv("index"));
   break;

 case "remove":
   $db->remove_data(gv("index"));
   break;

}

$db->init();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title>一覧：業務内容 ＦＡＱ 管理</title>
<link href="../css/style.css" rel=stylesheet type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#0000FF" alink="#FF0000">

<div align=center><a name=top></a><br>
  <table width="90%" border=1 cellpadding=3 cellspacing=0 bordercolor="#999999">
    <tr>
      <td width="75%" class=big><strong>業務内容 ＦＡＱ 管理</strong></td>
      <td width="25%" align=right class=big>一覧</td>


  </table>



  <br>
 <form name=form1 method=post action="">

    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr><td><input type=button
                    value="新規登録の場合はこちら"
                    onClick="location='new.php'">
         <td><a href="../../03faq.php" target="_blank"
             >貴社ＷＥＢサイト：業務内容 ＦＡＱページを見る</a></td>
   </table>

    <br>
    <hr width="80%">
    <br>

    <table width="80%" border=0 cellspacing=0 cellpadding=3>
      <tr>
        <td>登録済みQ&amp;A （※順序変更する際はボタンをクリックしてください）</td>
    </table>



    <table width="80%" border=0 cellspacing=2 cellpadding=2>

<?
$db->init_cursor();
$lpc = $db->last_position_of_cursor();
while(($d = $db->next_data()) !== false)
{
?>
      <tr>
        <td width="5%" valign=top nowrap bgcolor="#FFFFCC"
          >Q<?echo $d->index + 1;?></td>
        <td width="85%" valign=top bgcolor="#E6E6E6"
          ><a href="#<?echo $d->index?>"><?echo $d->ev4("question");?></a></td>
        <td width="5%" bgcolor="#FFCCCC"
          ><? if($d->index == 0 ) echo "&nbsp;";
	  else {?><input type=button
                         value="▲"
                         onClick="location.href='index.php?mode=up&index=<?
                         echo $d->index; ?>';"><?}?></td>
        <td width="5%" bgcolor="#99CCFF"
          ><? if($d->index == $lpc) echo "&nbsp;";
	  else {?><input type=button
                         value="▼"
                         onClick="location.href='index.php?mode=down&index=<?
                         echo $d->index;?>';"><?}?></td>
<?
}
?>
    </table>



    <br>
    <hr width="80%">
    <br>
    <table width="80%" border=0 cellspacing=0 cellpadding=3>
      <tr>
        <td align=center class=big><strong>FAQ一覧</strong></td>
    </table>

    <br>

<?
$db->init_cursor();
while(($d = $db->next_data()) !== false)
{
?>
    <a name=<?echo $d->index?>></a>

    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr>
        <td bgcolor="#CCCCCC">
            <input type=button
                   onClick="location='new.php?index=<?echo $d->index;?>';"
                   value="編集">
            <input type=button
                   value="削除"
                   onClick="location = 'delete.php?index=<?echo $d->index;?>'">
        </td>
    </table>



    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr valign=top>
        <td width="20%" bgcolor="#FFFFCC">Q<?echo $d->index + 1?></td>
        <td width="80%" bgcolor="#E6E6E6"><?echo $d->ev4("question");?></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">A<?echo $d->index + 1?></td>
        <td bgcolor="#E6E6E6"><?echo $d->ev4("answer");?>
   </table>
       <br>
<?
}
?>


    <br>


    <br>
    <table width="80%" border=0 cellspacing=0 cellpadding=3>
      <tr>
        <td align=center><a href="#top">このページのトップへ↑</a></td>


    </table>



  </form>
</div>
</body>
</html>
