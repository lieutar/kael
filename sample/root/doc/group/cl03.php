<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\php_lib"
	  : ":../../php_lib" ));

include_once("RPS_LIB.php");
include_once("RPS_Calender.php");
$now = getdate();
list($cal,$db) = make_objects4calender(gv("year"),gv("mon"));
if(($page = gv("page")) == "") $page = 0;


$db->set_page_length(20);
$db->set_page($page);
$db->init();

$first_page = $db->is_first_page();
$is_newest  = $first_page && ($cal->year == $now["year"] ||
			      $cal->mon == $now["mon"]);
$last_page  = !$db->has_more_page();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=EUC-JP">
<title>○○株式会社　社内システム</title></head>
<body link=#0000ff vlink=#0000ff bgcolor=#ffffff topmargin=4 background="img/bg2.gif">
<table width="700" border="0" cellspacing="0" align="center" bgcolor="#666666">
  <tr>
    <td align="center">
      <table width="700" border="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
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
                <td width=25% nowrap><a href="cl.php">社内スケジュール</a></td>
                <th width=50% nowrap>　
                <td width=25% nowrap align=right>　 </td>
              </tr>
            </table>
            <hr size="3" noshade>
            <table width=95% border=0 cellspacing=0 cellpadding=2>
              <tr> 
                <td colspan=2><b>最新記事一覧</b> 　 　 
                  <hr noshade size="1">
                </td>
              </tr>

<?
$db->init_cursor();
while(($data = $db->next_data())!==false)
{
?>
              <tr> 
                <td><a href="cl02.php?index=<?echo $data->index?>"
                  ><?if($data->get_value("file") != ""){
		    ?><img src="img/btn_tenpu%5B1%5D.gif"
                      border=0 width="15" height="17"> 
                  <?} $data->ev2("subject")?></a></td>
                <td>( <?echo date("n月d日 G時i分",
				  $data->get_value("timestamp"));
		      ?>,<? $data->ev2("quarter"); ?>)</td>
              </tr>
<?
}
?>

              <tr>
	      <td colspan=2><font color=gray><? if(!$is_newest)
                    echo "<a href=\"cl03.php?page=0&year=".$now["year"].
		         "&mon=".$now["mon"]."\">"?>最新記事へ<?
		    if(!$is_newest) echo "</a>"?></font>
	         | <font color=gray><? if(!$first_page)
                     echo "<a href=\"cl03.php?page=".($page - 1)."&year=".
		     $cal->year ."&mon=".$cal->mon."\">"; ?>&lt;&lt;
                  前の20件へ<? if(!$first_page) echo "</a>"; ?></font>
                 | <font color=gray><? if(!$last_page)
                     echo "<a href=\"cl03.php?page=".($page + 1)."&year=".
		     $cal->year."&mon=".$cal->mon."\">";?>次の20件へ
                  &gt;&gt;<?if(!$last_page) echo "</a>" ;?></font
                 ></td>
              </tr>

              <tr> 
                <td colspan=2> 
                  <hr size=1>
                </td>
              </tr>
            </table>
            <p>　</p><table width="600" border="1" cellspacing="0" bordercolor="#CCCCCC">
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
<p>　
</body>
</html>

