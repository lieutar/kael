<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\php_lib"
	  : ":../../php_lib" ));

include_once("RPS_LIB.php");
include_once("RPS_Calender.php");

$now = getdate();
list($cal,$db) = make_objects4calender(gv("year"),gv("mon"));

$page = gv("page");if($page === null) $page = 0;

switch(gv("mode"))
{
 case "add":
   $data = $db->get_blank_data(gv("date_y"),gv("date_m"),gv("date_d"));
   pv("timestamp",time());
   $data->check_file("file");
   $data->set_values();
   $data->reg();
   break;

 case "edit":
   $data = $db->get_data($index);
   list($y,$m,$d) = $data->get_date();

   if($y != gv("date_y") ||
      $m != gv("date_m") ||
      $d != gv("date_d"))
     {
       $file = $data->get_value("file");
       $fp   = $data->get_uploaded_file();
       $data = $db->get_blank_data(gv("date_y"),gv("date_m"),gv("date_d"));
       pv("timestamp",time());
       $data->check_file("file");

       if($_FILES["file_ovw"]['name'] != null)
	 {
	   //	   echo 1;
	   $data->check_file("file_ovw");
	   pv("file",gv("file_ovw"));
	   $data->set_values();
	 }
       elseif($file != "")
	 {
	   //	   echo 2;
	   $data->set_values();
	   $data->set_value("file",$file);
	   copy($fp,$data->get_uploaded_file());
	 }
       else
	 {
	   //	   echo 3;
	   $data->set_values();
	 }

       $data->reg();
       $db->remove_data($index);
       break;
     }
   $data->init();

   pv("timestamp",time());
   if($_FILES["file_ovw"]['name'] != null)
     {
       // echo 4;
       echo $_FILES["file_ovw"]['name'];
       $data->check_file("file_ovw");
       pv("file",gv("file_ovw"));
     }
   elseif($file != "")
     {
       // echo 5;
       $data->set_value("file",$file);
     }
   else
     {
       // echo 6;
     }

   $data->set_values();
   $data->reg();
   break;

 case "rm":
   $db->remove_data($index);
   break;
}

$db->init();

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=EUC-JP">
  <title>○○株式会社　社内システム</title>
</head>
<body link="#0000ff"
     vlink="#0000ff"
   bgcolor="#ffffff"
 topmargin="4"
background="img/bg2.gif">

<table width=700 border=0 cellspacing=0 align=center bgcolor="#666666">
  <tr>
    <td align=center>

      <table width=700 border=0 cellspacing=0 align=center bgcolor="#FFFFFF">
        <tr>
          <td align=center>

            <table width=100% bgcolor="#CCCCCC">
              <tr>
                <td align=left   width=33%>　○○株式会社</td>
                <td align=center width=33%>　</td>
                <td align=right  width=33% height=30>
                   <? echo date("Y 年 n 月 d 日") ?></td>

            </table>



            <hr size=3 noshade>
            <p>

<?/*********************************************************************
                         カレンダーのヘッダ
*********************************************************************/?>
            <table width=95% cellspacing=0 cellpadding=2>
              <tr>
                <td width=25% nowrap>社内スケジュール</td>
                <th width=50% nowrap
                  ><a href="cl.php?year=<?echo $cal->year - 1
                                ?>&mon=<?echo $cal->mon ?>"
                  ><img src  = "img/btn_back2%5B1%5D.gif"
                        width=25 height=13 border=0
                  ></a><a href="cl.php?year=<?
                                  echo $cal->get_year_of_previous_month();
                                ?>&mon=<?
                                  echo $cal->get_mon_of_previous_month(); ?>"
                  ><img src="img/btn_back%5B1%5D.gif"
                      width=25 height=13 border=0
                  ></a>　<?echo $cal->year ?> 年 <?echo $cal->mon  ?> 月
                  <a href="cl.php?year=<?
                                  echo $cal->get_year_of_next_month();
                                ?>&mon=<?
                                  echo $cal->get_mon_of_next_month(); ?>"
                  ><img src="img/btn_next%5B1%5D.gif"
                        width=25 height=13 border=0
                  ></a><a href="cl.php?year=<?echo $cal->year + 1
                                ?>&mon=<?echo $cal->mon ?>"
                  ><img src="img/btn_next2%5B1%5D.gif"
                     width=25 height=13 border=0></a>

                <td width=25% nowrap align=right>　 </td>
            </table>

<?/*********************************************************************
                          カレンダー本体
*********************************************************************/?>

            <table width=95% border=1 cellspacing=0 cellpadding=1>
              <tr bgcolor=#ffffff>
                <th width=14% bgcolor="#EE9FBF">日</th>
                <th width=14%>月</th>
                <th width=14%>火</th>
                <th width=14%>水</th>
                <th width=14%>木</th>
                <th width=14%>金</th>
                <th width=14% bgcolor="#66CCFF">土</th>
                <td><br>
                </td>

<?/* 週 */?>
<?
while(($week = $cal->next_row()) !== false)
{
?>
              <tr valign=top>
<?
while(($cell = $week->next_cell()) !== false)
{
?>
                <td bgcolor="<?echo $cell->get_color()?>" rowspan=2
                  ><?echo $cell->get_date()?><br>
        <? while(($data = $cell->next_data()) !== false){?>
                 <a href="cl02.php?index=<?echo $data->index?>"
                 ><?if($data->get_value("file") != ""){
                 ?><img src="img/btn_tenpu%5B1%5D.gif"
                       border=0 width=15 height=17></a><?}?><a
                 href="cl02.php?index=<?echo $data->index?>"
                 ><?echo RPS_Calender_Cell::trim4calender($data->get_value("subject"));?></a><br><?}?></td>
<?
}
?>
                <td bgcolor=#ffffff width=1 height=40><br>
                </td>

              <tr>
                <td bgcolor=#ffffff>　</td>
<?
}
?>
<?/* 週了 */?>

            </table>

<?/*********************************************************************
                            カレンダーのケツ表示
*********************************************************************/?>


            <table width=95%>
              <tr>
              <?for ($m = 1;$m <= 12;$m++):?>
              <td nowrap><a href="cl.php?year=<?echo $cal->year
                                      ?>&mon=<?echo $m?>"><font color="#0033FF"
                <? if($m == $cal->mon) echo "style=\"font-weight:bold;\"";
                  ?>><?echo $m ?>月</font></a></td>
              <?endfor;?>
                <td align=right nowrap>　 </td>
            </table>



            <hr size=3 noshade>


<?/*********************************************************************
                             最新記事一覧
*********************************************************************/?>
<?
$db->set_from(null);
$db->set_until(null);
$db->set_cond_string(null);
$db->set_page_length(GROUP_INDEX_PAGELEN);
$db->set_page($page);
$db->init();
$db->init_cursor();
?>
            <table width=95% border=0 cellspacing=0 cellpadding=2>
              <tr>
                <td colspan=2><b>最新記事一覧</b> 　 　
                  <hr noshade size=1>
                </td>

<?
while(($data = $db->next_data()) !== false)
{
?>
              <tr>
                <td><a href="cl02.php?index=<?echo $data->index?>"><?
                  if($data->get_value("file") != ""){
                  ?><img src="img/btn_tenpu%5B1%5D.gif"
                         border=0 width=15 height=17><?}
                  $data->ev2("subject")?></a></td>
                <td>( <?echo date("n月d日 G時i分",
				  $data->get_value("timestamp"));
				  ?>, <?$data->ev2("quarter")?>)</td>
<?
}

$first_page = $db->is_first_page();
$is_newest  = $first_page && ($cal->year == $now["year"] ||
			      $cal->mon == $now["mon"]);
$last_page  = !$db->has_more_page();
?>


              <tr>
	      <td colspan=2><font color=gray><? if(!$is_newest)
                    echo "<a href=\"cl.php?page=0&year=".$now["year"].
		         "&mon=".$now["mon"]."\">"?>最新記事へ<?
		    if(!$is_newest) echo "</a>"?></font>
	         | <font color=gray><? if(!$first_page)
                     echo "<a href=\"cl.php?page=".($page - 1)."&year=".
		     $cal->year ."&mon=".$cal->mon."\">"; ?>&lt;&lt;
                  前の<?echo GROUP_INDEX_PAGELEN?>件へ<? if(!$first_page) echo "</a>"; ?></font>
                 | <font color=gray><? if(!$last_page)
                     echo "<a href=\"cl.php?page=".($page + 1)."&year=".
		     $cal->year."&mon=".$cal->mon."\">";?>次の<?echo GROUP_INDEX_PAGELEN?>件へ
                  &gt;&gt;<?if(!$last_page) echo "</a>" ;?></font
                 ></td>

              <tr>
                <td colspan=2>
                  <hr size=1>
                </td>

            </table>


<?
/*********************************************************************
                              メニュー
*********************************************************************/
?>

            <p>　</p>
            <table width=600 border=1 cellspacing=0 bordercolor="#CCCCCC">
              <tr>
                <td width="25%" align=center><a href="cl04.php?year=<?
                                                        echo $cal->year
                                                      ?>&mon=<?
                                                        echo $cal->mon ?>"
                  ><img src="img/icn_postnew%5B1%5D.gif"
                        border=0 width=32 height=32 align=absmiddle>
                  [記事を書く]</a> </td>
                <td align=center width="25%">　 <a href=cl05.php
                  ><img src="img/icn_bumon%5B1%5D.gif"
                         border=0 width=24 height=24 align=absmiddle>
                  [検索する]</a> </td>
                <td align=center width="25%"><a href=cl06.php
                  ><img src="img/jutyushinki%5B1%5D.gif" width=32 height=32
                         border=0 align=absmiddle>[管理画面]</a></td>
                <td align=center width="25%" height=40><a href=cl07.php
                    ><img src="img/shorui%5B1%5D.gif" width=32 height=32
                          align=absmiddle border=0>[オンラインヘルプ]</a></td>

            </table>



            <br>
            <hr size=1>
            <p>



            <table width=100%>
              <tr>
                <td align=left   width=33% nowrap
                  ><a href="http://www.reds.co.jp">[ホームページ管理画面]</a
                  ></td>
                <td align=center width=33%><a href=cl.php>[ログイン画面]</a
                  ></td>

                <td align=right  width=33%><font size=-2 face="Geneva, Arial, Helvetica, san-serif"><a href="http://www.reds.co.jp">Copyright
                  (C)2002 Reds Inc.</a></font> </td>
              <tr>
                <td align=left colspan=3 nowrap height=5>　</td>
            </table>

          </td>
      </table>
    </td>
</table>



<p>　
</body>
</html>

