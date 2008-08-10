<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\..\\php_lib"
	  : ":../../../php_lib" ));

include_once("RPS_DB.php");
include_once("RPS_LIB.php");



$MainForm = new rps_form("form1");
$mode = gv("mode");
$view_all = false;
if(gv("cond_from_y") === null)
{
  $view_all = true;
  $now = getdate();
  pv("cond_from_y" ,$now["year"]);
  pv("cond_from_m" ,$now[ "mon"]);
  pv("cond_from_d" ,$now["mday"]);
  pv("cond_until_y",$now["year"]);
  pv("cond_until_m",$now[ "mon"]);
  pv("cond_until_d",$now["mday"]);
}

$db = new RPS_DB("../data/info",array("ttl","ctgl","info"),true);
//$db = new RPS_DB("./data",array("ttl","ctgl","info"),false);


switch($mode)
{

 case "add":
   $data = $db->get_blank_data(gv("announs_y"),
			       gv("announs_m"),
			       gv("announs_d"));
   $data->set_values();
   $data->reg();
   break;


 case "edit":
   $data =  $db->update_sort_key(gv("index"),
				 gv("announs_y"),
				 gv("announs_m"),
				 gv("announs_d"));
   $data->set_values();
   $data->reg();
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
<title>一覧：インフォメーション管理</title>
<link href="../css/style.css" rel=stylesheet type="text/css">

<script type="text/javascript">
<!--
<?
$MainForm->js_check_term();
$MainForm->js_check_date();
?>
//-->
</script>

</head>

<body bgcolor="#FFFFFF"
      text   ="#000000"
      link   ="#0000FF"
      vlink  ="#0000FF"
      alink  ="#FF0000">

<div align=center><a name=top></a><br>
  <table width       = "90%"
         border      = 1
         cellpadding = 3
         cellspacing = 0
         bordercolor = "#999999">
    <tr>
      <td width="75%" class=big><strong
       >インフォメーション（ニュース）管理</strong></td>
      <td width="25%" align=right class=big>一覧</td>

  </table>


  <br>


 <form name=<?echo $MainForm->name?> method=get action="index.php">

 <input type=hidden name=page value=<? $p = gv("page"); echo $p + 0;?>>

    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td colspan=2
          ><input type=button value="新規登録の場合はこちら"
                  onClick="location='new.php'">
      <tr>
        <td><a href="../../index.php" target="_blank"
            >貴社ＷＥＢサイト：トップページを見る</a>
        <td><a href="../../01.php" target="_blank"
            >貴社ＷＥＢサイト：インフォメーションページを見る</a>
   </table>


   <br><hr width="80%"><br>


    <table width="80%" border=0 cellpadding=3 cellspacing=0 bgcolor="#99CCFF">
      <tr>
        <td colspan=2
          ><strong>登録済みインフォメーションの検索 </strong
          >（※確認・編集する際にご利用ください。）</td>

      <tr>
        <td colspan=2>発表日：
        <?if(false):?>
        <select name=from_year  size=1><option>年</select>
        <select name=from_month size=1><option>月</select>
        <select name=from_day   size=1><option>日</select>
        <?endif;
          $MainForm->date_form("cond","true");?>から

        <?if(false):?>
        <select name=until_year  size=1><option>年</select>
        <select name=until_month size=1><option>月</select>
        <select name=until_day   size=1><option>日</select>
        <?endif;
          $MainForm->date_form("cond","false")?>

      <tr>
        <td>語句：
          <input name=cond_string type=text size=40 maxlength=40
	   value="<?evf("cond_string")?>">
          を含む</td>
        <td><input type=button value="検索する"
                   onClick="document.form1.page.value=0;
                            document.form1.submit();">
    </table>

    <br><hr width="80%"><br>

<?
$db->set_page_length(10);
$db->set_page(gv("page"));

if(!$view_all)
     $db->extract(gv("cond_from_y") ,gv("cond_from_m") ,gv("cond_from_d"),
		  gv("cond_until_y"),gv("cond_until_m"),gv("cond_until_d"),
		  "info",gv("cond_string"));
?>


    <table width="80%" border=0 cellspacing=0 cellpadding=3>
      <tr>
        <td width="20%">
          <?if(!$db->is_first_page()):?>
	  <a href="<?if($view_all):?>index.php?page=<? echo $page -1;
                     else:?>javascript:form1.page.value='<?echo $page - 1;?>';
                              form1.submit();<?endif;?>">←前の１０件</a>
	  <?endif;?>
        <td align=center><strong>インフォメーション一覧</strong>
	<td align=right width="20%">
          <?if($db->has_more_page()):?>
          <a href="<?if($view_all):?>index.php?page=<? echo $page +1;
                     else:?>javascript:form1.page.value='<?echo $page + 1;?>';
                              form1.submit();<?endif;?>">次の１０件→</a>
          <?endif;?>
    </table>

    <br>

<?
//echo "<b>".$db->from."-".$db->until."</b><br>"; ####


$db->init_cursor();

while(($d = $db->next_data()) !== false)
{
  list($_y,$_m,$_d) = $d->get_date();
?>
    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr>
        <td bgcolor="#CCCCCC">
	  <input name=edit type=button id=edit
	      onClick="location='new.php?index=<? echo $d->index; ?>'"
              value="編集">
          <input name=delete type=button id=delete value="削除"
	      onClick="location = 'delete.php?index=<? echo $d->index; ?>'">
    </table>

    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <col width="20%" bgcolor="#FFFFCC">
      <col width="80%" bgcolor="#E6E6E6">
      <tr valign=top>
        <td>発表日<td  ><? echo "$_y/$_m/$_d"; ?>

      <tr valign=top>
        <td>タイトル<td><? $d->ev2("ttl"); ?>

      <tr valign=top>
        <td>分類<td    ><? $d->ev2("ctgl");?>

      <tr valign=top>
        <td>内容<td    ><? $d->ev4("info"); ?>
    </table>
    <br>
<?
}

?>



    <table width="80%" border=0 cellspacing=0 cellpadding=3>
      <tr>
        <td width="20%">
          <?if(!$db->is_first_page()):?>
	  <a href="<?if($view_all):?>index.php?page=<? echo $page -1;
                     else:?>javascript:form1.page.value='<?echo $page - 1;?>';
                              form1.submit();<?endif;?>">←前の１０件</a>
	  <?endif;?>
        <td align=center><a href="#top">このページのトップへ↑</a></td>
	<td align=right width="20%">
          <?if($db->has_more_page()):?>
          <a href="<?if($view_all):?>index.php?page=<? echo $page +1;
                     else:?>javascript:form1.page.value='<?echo $page + 1;?>';
                              form1.submit();<?endif;?>">次の１０件→</a>
          <?endif;?>
    </table>



  </form>
</div>
</body>
</html>
