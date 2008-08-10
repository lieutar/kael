<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\..\\php_lib"
	  : ":../../../php_lib" ));

include_once("RPS_LIB.php");

$csv  = "../data/recruit/oubo.csv";
$csv2 = "oubo.csv";
$length = -1;
if(gv("mode")=="reset")
{
  unlink($csv);
}
elseif(gv("mode")=="download")
{
  make_csv_for_download($csv,$csv2);
  exit;
}
elseif(file_exists($csv))
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
<title>データ処理：採用情報 管理</title>
<link href="../css/style.css" rel=stylesheet type="text/css">
</head>

<body bgcolor="#FFFFFF"
      text="#000000" link="#0000FF" vlink="#0000FF" alink="#FF0000">

<div align=center><br>
  <table width="90%" border=1 cellpadding=3 cellspacing=0 bordercolor="#999999">
    <tr>
      <td width="75%" class=big><strong>採用情報 管理</strong></td>
      <td width="25%" align=right class=big>データ処理</td>


  </table>



  <br>
 <form name=form1 method=post action="">
    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td><input name=back type=button id=back value="一覧へ戻る"
               onClick="location.href='index.php';"></td>
        <td align=right
        ><?if($length > 0){?>現在「応募データ」が  <font color="#FF0000"
        ><strong><span class=big><?echo $length?>件</span></strong></font
        >  あります<?}else{?>現在「応募データ」はありません<?}?></td>


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
「応募データ」を一括ダウンロードすることができます。<br>
          </li>
          </ul></td>


      <tr>
        <td align=center><br>
          <input type=button name="button"
                  onClick="window.open('data.php?mode=download','_top');"
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
「応募データ」をリセットします。<br>
              （※リセットを行うと集まったデータが失われます。リセットする前にダウンロードして保存してください）<br>
          </li>
          </ul></td>


      <tr>
        <td align=center><br>
          <input type=button name="Submit"
                 onClick="location='data.php?mode=reset'"
                 value="リセットする"></td>

   </table>
    <br>
<?}?>


  </form>
    </div>
</body>
</html>
