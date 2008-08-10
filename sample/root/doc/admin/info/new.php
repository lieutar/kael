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
   gv("announs_y") == "")
{
  $db = new RPS_DB("../data/info",array("ttl", "ctgl", "info"));
  $data =$db->get_data($index);
  $data->put_values();
  $data->put_date_data("announs_y",
		       "announs_m",
		       "announs_d");
}




?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<meta http-equiv="Content-Script-Type" content="text/javascript">

<title><? echo $index != null ? "編集" : "新規入力" ;
       ?>：インフォメーション管理</title>
<link href="../css/style.css" rel=stylesheet type="text/css">


<script type="text/javascript">
<!--
<?$MainForm->js_check_date();?>

function check_data()
{
  if(document.form1.ttl.value.length < 1)
    {
      alert("【タイトル】が未入力です");
      return false;
    }

  if(document.form1.ctgl.value.length < 1)
    {
      alert("【分類】が未入力です");
      return false;
    }

  if(document.form1.info.value.length < 1)
    {
      alert("【内容】が未入力です");
      return false;
    }

  return document.form1.submit();
}
//-->
</script>


</head>

<body bgcolor="#FFFFFF"
      text   ="#000000"
      link   ="#0000FF"
      vlink  ="#0000FF"
      alink  ="#FF0000">

<div align=center><a name=top></a><br>
  <table width="90%" border=1 cellpadding=3 cellspacing=0 bordercolor="#999999">
    <tr>
      <td width="75%" class=big><strong>インフォメーション（ニュース）管理</strong></td>
      <td width="25%" align=right class=big><? echo $index != null ? "編集" : "新規入力" ;
       ?></td>


  </table>



  <br>

<form name=<?echo $MainForm->name;?> method=post action="conf.php">
  <input type=hidden name=mode value="<?echo $index != null ? "edit" : "add" ;?>">
<? if($index != null) :?>
  <input type=hidden name=index value=<?evf("index")?>>
<? endif; ?>

   <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr><td width="100%"
        ><input name    = back
                type    = button
                id      = back
                value   = "戻る"
                onClick = "history.back(); return false;"></table>




    <hr width="80%">


    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr valign=top>
        <td width="20%" bgcolor="#FFFFCC">発表日</td>
        <td width="80%" bgcolor="#E6E6E6">
<?if(false):?>
          <select name=year size=1 id=year>
            <option>年</option>
            <option>    </option>
          </select>
          <select name=month size=1 id=month>
            <option>月</option>
            <option>  </option>
          </select>
          <select name=day size=1 id=day>
            <option>日</option>
            <option>  </option>
          </select>
<?endif;
$MainForm->date_form("announs");
?>
</td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">タイトル</td>
        <td bgcolor="#E6E6E6"><input name=ttl type=text id=ttl size=60
                                     value='<?evf("ttl")?>'></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">分類</td>
        <td bgcolor="#E6E6E6"><input name=ctgl type=text id=ctgl size=60
                                     value='<?evf("ctgl")?>'></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">内容</td>
        <td bgcolor="#E6E6E6"
          ><textarea name=info cols=50 rows=20 id=info
           ><?evf("info")?></textarea></td>


    </table>


    <br>


    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr><td align=center bgcolor="#CCCCCC">
          <input type=button value="確認する"
                 onClick="check_data()">
          <input type=button value="戻る"
                 onClick="location.href='index.php';"></td></table>


    <br>


  </form>
</div>
</body>
</html>
