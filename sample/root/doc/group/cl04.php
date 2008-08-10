<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\php_lib"
	  : ":../../php_lib" ));

include_once("RPS_LIB.php");
include_once("RPS_Calender.php");

$mode = "add";

if(($index = gv("index"))."" !== "")
{
  $mode = "edit";
  list($cal,$db) = make_objects4calender(gv("year"),gv("mon"));
  $data = $db->get_data($index);
  list($y,$m,$d) = $data->get_date();

  pv("date_y" , $y);
  pv("date_m" , $m);
  pv("date_d" , $d);

  pv("subject", $data->get_value("subject"));
  pv("quarter", $data->get_value("quarter"));
  pv("text"   , $data->get_value("text"));

  $file    = $data->get_value("file");
}


$rf = new rps_form("form1");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=EUC-JP">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<title>○○株式会社　社内システム</title>
<script type="text/javascript">
<!--
<?$rf->js_check_date();?>
//-->
</script>
</head>
<body link=#0000ff vlink=#0000ff bgcolor=#ffffff
       topmargin=4 background="img/bg2.gif">
<form action=cl.php method=post enctype="multipart/form-data" name=form1>
<input type=hidden name=mode value="<?echo $mode?>">
<table width="700" border="0" cellspacing="0" align="center" bgcolor="#666666">
  <tr>
    <td align="center">
      <table width="700" border="0" cellspacing="0"
             align="center" bgcolor="#FFFFFF">
        <tr> 
          <td align="center"> 
            <table width=100% bgcolor="#CCCCCC">
              <tr> 
                <td align=left   width=33%>　○○株式会社</td>
                <td align=center width=33%>　</td>
                <td align=right  width=33% height="30"
                  ><?echo date("Y 年 n 月 d 日")?></td>
              </tr>
            </table>
            <hr size="3" noshade>
            <p> 
            <table width=95% cellspacing=0 cellpadding=2>
              <tr> 
                <td width=25% nowrap
                  ><a href="cl.php?year=<?evf("year")?>&mon=<?evf("mon")?>"
                  >社内スケジュール</a></td>
                <th width=50% nowrap>　
                <td width=25% nowrap align=right>　 </td>
              </tr>
            </table>
            <hr size="3" noshade>
            <table width=95% border=0 cellspacing=0 cellpadding=2>
              <tr> 
                <td colspan=2><b><a href="cl03.php">最新記事一覧</a></b>
                  <hr noshade size="1">
                </td>
              </tr>


              <tr> 
                <td>記事を書く</td>
                <td align="right">　</td>
              </tr>
              <tr align="center"> 
                <td colspan="2"> 
                  <hr size=1>
                  <table>
                    <tbody> 
                    <tr>
                      <td>日付
                      <td><?$rf->date_form("date")?>
                    <tr>
                      <td>部署名<br>
                        投稿者</td>
                      <td> 
                        <input maxlength=120 size=60 name=quarter
                               value="<?evf("quarter")?>">
                      </td>
                    </tr>
                    <tr> 
                      <td>標題</td>
                      <td> 
                        <input maxlength=120 size=60 name=subject
                               value="<?evf("subject")?>">
                      </td>
                    </tr>
                    <tr> 
                      <td valign=top>本文</td>
                      <td> 
                        <textarea name=text rows=15 wrap=virtual cols=60
                        ><?evf("text")?></textarea>
                      </td>
<?
if($mode == "edit" && $file != "")
{
?>
                    <tr> 
                      <td>旧添付ファイル</td>
                      <td><a
  href="cldl.php?file=<?echo $data->get_uploaded_file()
             ?>&filename=<?$data->ev("file")?>"
  ><img src="img/btn_tenpu%5B1%5D.gif"
  border=0 width=15 height=17 align=absmiddle
  >　<?$data->ev2("file")?></a>
                        <input type=hidden name=file value="<?echo $file?>">
                      </td>
                    </tr>
<?
}
?>
                    <tr> 
                      <td>添付<?if($mode == "edit" && $file != "" ) echo " (上書き) ";?></td>
                      <td>ファイル1 
                        <input type=file name=<?echo ($mode == "edit"
						      ? "file_ovw" : "file")?>>
                      </td>
                    </tr>
                    </tbody> 
                  </table>
                  <br><?
if($mode == "edit")
     echo "\n<input type=hidden name=index value=$index>";
?>
                  <input type=submit value="書き込む"  >
                  <input type=reset  value="入力し直す">
                  <hr size=1>
                </td>
              </tr>
              <tr align="right"> 
                <td colspan=2>　</td>
              </tr>
              <tr> 
                <td colspan=2> 
                  <hr size=1>
                </td>
              </tr>
            </table>
            <p>　</p>
            <table width="600" border="1" cellspacing="0" bordercolor="#CCCCCC">
              <tr> 
                <td width="25%" align="center"><a href="cl04.php"><img src="img/icn_postnew%5B1%5D.gif" border=0 width="32" height="32" align="absmiddle"> 
                  [記事を書く]</a> </td>
                <td align="center" width="25%">　 <a href="cl05.php"><img src="img/icn_bumon%5B1%5D.gif" border=0 width="24" height="24" align="absmiddle"> 
                  [検索する]</a> </td>
                <td align="center" width="25%"><a href="cl06.php"><img src="img/jutyushinki%5B1%5D.gif" width="32" height="32" border="0" align="absmiddle">[管理画面]</a></td>
                <td align="center" width="25%" height="40"><a href="cl07.php"><img src="img/shorui%5B1%5D.gif" width="32" height="32" align="absmiddle" border="0">[オンラインヘルプ]</a></td>
              </tr>
            </table>
            <br>
            <hr size=1>
            <p> 
            <table width=100%>
              <tr> 
                <td align=left   width=33% nowrap><a href="http://www.reds.co.jp">[ホームページ管理画面]</a></td>
                <td align=center width=33%><a href="cl.php">[ログイン画面]</a></td>
                <td align=right  width=33%><font size="-2" face="Geneva, Arial, Helvetica, san-serif"><a href="http://www.reds.co.jp">Copyright 
                  (C)2002 Reds Inc.</a></font> </td>
              </tr>
              <tr> 
                <td align=left colspan="3" nowrap height="5">　</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</form>
<p>　
</body>
</html>

