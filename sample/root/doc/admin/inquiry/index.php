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
<title>�ǡ������������䤤��碌 ����</title>
<link href="../css/style.css" rel=stylesheet type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#0000FF" alink="#FF0000">

<div align=center><br>
  <table width="90%" border=1 cellpadding=3 cellspacing=0 bordercolor="#999999">
    <tr>
      <td width="75%" class=big><strong>���䤤��碌����</strong></td>
      <td width="25%" align=right nowrap class=big>�ǡ�������</td>


  </table>



  <br>
 <form name=form1 method=post action="">
    <table width="80%" border=0 cellspacing=0 cellpadding=3>
      <tr>
        <td><?if($length > 0){?>���ߡ֤��䤤��碌�ǡ����פ�  <font
           color="#FF0000"><strong><span class=big
           ><?echo $length?>��</span></strong></font>  ����ޤ�<?}
          else{?>���ߡ֤��䤤��碌�ǡ����פϤ���ޤ���<?}?></td>


    </table>

<?if($length > 0){?>

    <br>
    <hr width="80%">
    <br>
    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td>
      <ul>
           <li><strong>�ǡ������������</strong><br>
            <br>
�֤��䤤��碌�ǡ����פ����������ɤ��뤳�Ȥ��Ǥ��ޤ���<br>
          </li>
          </ul></td>


      <tr>
        <td align=center><br>
          <input type=button onClick="
window.open('index.php?mode=download','_top');
"
                 value="��������ɤ���"></td>


   </table>



   <br>
    <hr width="80%">
    <br>
    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td>
      <ul>
           <li><strong>�ǡ����ꥻ�å�</strong><br>
            <br>
�֤��䤤��碌�ǡ����פ�ꥻ�åȤ��ޤ���<br>
              �ʢ��ꥻ�åȤ�Ԥ��Ƚ��ޤä��ǡ����������ޤ����ꥻ�åȤ������˥�������ɤ�����¸���Ƥ���������<br>
          </li>
          </ul></td>


      <tr>
        <td align=center><br>
          <input type=button onClick="location='index.php?mode=reset'" value="�ꥻ�åȤ���"></td>


   </table>




    <br>
<?}?>

  </form>
    </div>
</body>
</html>
