<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\..\\php_lib"
	  : ":../../../php_lib" ));

include_once("RPS_LIB.php");

$csv  = "../data/inquiry/inquiry.csv";
$csv2 = "inquiry.csv";
$length = -1;

switch(gv("mode"))
{
 case "reset":
  unlink($csv);
  break;

 case "download":
  make_csv_for_download($csv,$csv2);
  exit;
}

if(file_exists($csv))
{
  $fp = fopen($csv,"r");
  if($fp !== false)
    {
      while(fgetcsv($fp,4096,",") !== false) $length++;
      fclose($fp);
    }
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title>データ処理：お問い合わせ 管理</title>
<link href="../css/style.css" rel=stylesheet type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#0000FF" alink="#FF0000">

<div align=center><br>
  <table width="90%" border=1 cellpadding=3 cellspacing=0 bordercolor="#999999">
    <tr>
      <td width="75%" class=big><strong>お問い合わせ管理</strong></td>
      <td width="25%" align=right nowrap class=big>データ処理</td>


  </table>



  <br>
 <form name=form1 method=post action="">
    <table width="80%" border=0 cellspacing=0 cellpadding=3>
      <tr>
        <td><?if($length > 0){?>現在「お問い合わせデータ」が  <font
           color="#FF0000"><strong><span class=big
           ><?echo $length?>件</span></strong></font>  あります<?}
          else{?>現在「お問い合わせデータ」はありません<?}?></td>


    </table>

<?if($length > 0){?>

    <br>
    <hr width="80%">
    <br>
    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td>
      <ul>
           <li><strong>データダウンロード</strong><br>
            <br>
「お問い合わせデータ」を一括ダウンロードすることができます。<br>
          </li>
          </ul></td>


      <tr>
        <td align=center><br>
          <input type=button onClick="
window.open('index.php?mode=download','_top');
"
                 value="ダウンロードする"></td>


   </table>



   <br>
    <hr width="80%">
    <br>
    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td>
      <ul>
           <li><strong>データリセット</strong><br>
            <br>
「お問い合わせデータ」をリセットします。<br>
              （※リセットを行うと集まったデータが失われます。リセットする前にダウンロードして保存してください）<br>
          </li>
          </ul></td>


      <tr>
        <td align=center><br>
          <input type=button onClick="location='index.php?mode=reset'" value="リセットする"></td>


   </table>




    <br>
<?}?>

  </form>
    </div>
</body>
</html>
