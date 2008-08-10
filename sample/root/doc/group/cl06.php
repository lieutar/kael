<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\php_lib"
	  : ":../../php_lib" ));

include_once("RPS_LIB.php");
include_once("RPS_Calender.php");

$now = getdate();
list($cal,$db) = make_objects4calender(gv("year"),gv("mon"));

$MainForm = new rps_form("form1");
if(($page = gv("page")) == "") $page = 0;

if(gv("cond_from_y") == "")
{
  pv("cond_from_y",$now["year"]);
  pv("cond_from_m",$now["mon"]);
  pv("cond_from_d",$now["mday"]);
  pv("cond_until_y",$now["year"]);
  pv("cond_until_m",$now["mon"]);
  pv("cond_until_d",$now["mday"]);
  pv("all","yes");
}



switch(($mode = gv("mode")))
{
 case "edit":
   $data = $db->get_data($index);
   $data->init();
   pv("timestamp",time());
   if($_FILES["file_ovw"] != null)
     {
       echo unko;
       $data->check_file("file_ovw");
       pv("file",gv("file_ovw"));
     }
   $data->set_values();
   $data->reg();
   break;

 case "rm":
   $db->remove_data($index);
   break;

 case "find":
   $cond    = gv(   "cond");
   $subject = gv("subject") == "yes";
   $quarter = gv("quarter") == "yes";
   $text    = gv(   "text") == "yes";
   $num     = gv(    "num") == "yes";


   $ext = array();

   // 検索メソッドを用いず自力で検索
   if($all == "yes")
     {
       $datas = $db->datas;
       $ndatas = count($datas);

       if(preg_match("|^[ 　]*\$|",$cond))  break;
       if(!($subject || $quarter || $text) )break;

       for($i=0;$i<$ndatas;$i++)
	 {
	   $data = $db->get_data($i);
	   if(($subject && $data->match("subject",$cond))||
	      ($quarter && $data->match("quarter",$cond))||
	      ($text    && $data->match("text"   ,$cond)))
	     array_push($ext,$i);
	 }
       $db->extracted_indexs = $ext;
     }
   else
     {

       $db->set_from(gv("cond_from_y"),
		     gv("cond_from_m"),
		     gv("cond_from_d"));

       $db->set_until(gv("cond_until_y"),
		      gv("cond_until_m"),
		      gv("cond_until_d"));

       $db->extract_by_term();

       if(!preg_match("|^[ 　]*\$|",$cond))
	 {
	   $datas = $db->extracted_indexs;
	   for($i=0;$i<count($datas);$i++)
	     {
	       $data = $db->get_data($datas[$i]);
	       if(($subject && $data->match("subject",$cond))||
		  ($quarter && $data->match("quarter",$cond))||
		  ($text    && $data->match("text"   ,$cond)))
		 array_push($ext,$datas[$i]);
	     }
	   $db->extracted_indexs = $ext;
	 }
     }


   break;

 default:
   pv("num",1000);
   pv("quarter","yes");
   pv("subject","yes");
   pv("text"   ,"yes");
}
$db->set_page_length(GROUP_ADMIN_PAGELEN);
$db->set_page($page);
$db->init_cursor();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=EUC-JP">
<title>○○株式会社　社内システム</title>
<script type="text/javascript">
<!--
<?
$MainForm->js_check_term();
$MainForm->js_check_date();
?>


function check_all()
{
  
  if(document.form1.all.checked)
    {
      document.form1.cond_from_y.disabled =
	document.form1.cond_from_m.disabled =
	document.form1.cond_from_d.disabled =
	document.form1.cond_until_y.disabled =
	document.form1.cond_until_m.disabled =
	document.form1.cond_until_d.disabled = true;
    }
  else
    {
      document.form1.cond_from_y.disabled =
	document.form1.cond_from_m.disabled =
	document.form1.cond_from_d.disabled =
	document.form1.cond_until_y.disabled =
	document.form1.cond_until_m.disabled =
	document.form1.cond_until_d.disabled = false;
    }
}
//-->
</script>
</head>
<body link=#0000ff vlink=#0000ff bgcolor=#ffffff
      topmargin=4 background="img/bg2.gif"
      onLoad="check_all();">
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
                <td align=right  width=33% height=30
                  ><?echo date("Y 年 n 月 d 日");?></td>

            </table>



            <hr size=3 noshade>
            <p>
            <table width=95% cellspacing=0 cellpadding=2>
              <tr>
                <td width=25% nowrap><a href=cl.php>社内スケジュール</a></td>
                <th width=50% nowrap>　
                <td width=25% nowrap align=right>　 </td>


            </table>



            <hr size=3 noshade>
            <table width=95% border=0 cellspacing=0 cellpadding=2>


              <tr>
                <td>検索する</td>
                <td align=center>
<form action="cl06.php" method=get name=form2>
<input type=hidden name=mode         value=find>
<input type=hidden name=cond_from_y  value="<?evf("cond_from_y");?>">
<input type=hidden name=cond_from_m  value="<?evf("cond_from_m");?>">
<input type=hidden name=cond_from_d  value="<?evf("cond_from_d");?>">
<input type=hidden name=cond_until_y value="<?evf("cond_until_y");?>">
<input type=hidden name=cond_until_m value="<?evf("cond_until_m");?>">
<input type=hidden name=cond_until_d value="<?evf("cond_until_d");?>">
<input type=hidden name=page         value="<?evf("page");?>">
<input type=hidden name=all          value="<?evf("all");?>">
<input type=hidden name=cond         value="<?evf("cond");?>">
<input type=hidden name=subject      value="<?evf("subject");?>">
<input type=hidden name=quarter      value="<?evf("quarter");?>">
<input type=hidden name=text         value="<?evf("text");?>">
</form>
                  <form action="cl06.php" method=get name=form1>
                    <input type=hidden name=mode value=find>
                    <input type=hidden name=page value=<?echo $page?>>
                  <table cellspacing=0 border=0>
                    <tbody>
                    <tr>
                      <td noWrap>■ 検索文字列</td>
                      <td noWrap>
                        <input name=cond value=<?evf("cond");?>>
                        <input type=submit value="検索"
                               onClick="document.form1.page.value=0;">
                        <input type=checkbox <?if(gv("subject") == "yes")
                                                  echo "checked"; ?>
                               value=yes name=subject>
                        標題
                        <input type=checkbox <?if(gv("quarter") == "yes")
                                                  echo "checked";?>
                                value=yes name=quarter>
                        部署
                        <input type=checkbox <?if(gv("text") == "yes")
                                                  echo "checked";?>
                                 value=yes name=text>
                        本文</td>


                    <tr>
                      <td noWrap>■ 検索対期間　</td>
                      <td>
			 <?$MainForm->date_form("cond","true")?> 〜
			 <?$MainForm->date_form("cond","false")?>
			 <label><input type=checkbox value="yes"
				name=all <?
				 if(gv("all") == "yes")echo "checked";
                                ?> onClick="check_all()">すべて</label>
                      </td>


                    </tbody>
                  </table>
</form>
                </td>






              <tr align=center>
                <td colspan=2>
                  <hr size=1>
                  <table width=95% border=0 cellspacing=0 cellpadding=2>
                    <tr>
                      <td>■　検索結果</td>
                      <td>　</td>
                      <td>　</td>

                    <tr>
                      <td colspan=3>
                        <table width="100%" border=1 cellspacing=0
                               bordercolor="#CCCCCC" cellpadding=3>
                          <tr>
                            <td width=320>標題</td>
                            <td width=100>部署・投稿者</td>
                            <td>日付</td>


                        </table>



                      </td>

<?
while(($data = $db->next_data()) !== false)
{
?>
<tr>
  <td width=330><a href="cl06_2.php?index=<?echo $data->index?>"
    ><?if($data->get_value("file") != ""){
      ?><img src="img/btn_tenpu%5B1%5D.gif" border=0 width=15 height=17>
    <?}$data->ev2("subject");?></a></td>
    <td width=110>(<?$data->ev2("quarter")?>)</td>
    <td><?echo date("n月d日 G時i分",
		    $data->get_value("timestamp"));?></td>
<?
}
?>



                    <tr>
                      <td colspan=3>
                        <hr size=1>
                      </td>
<?
$is_newest  = $page == 0;
$first_page = $page == 0;
$last_page  = !$db->has_more_page();
?>

              <tr>
	      <td colspan=2><font color=gray><? if(!$is_newest)
                    echo "<a href=\"javascript:
                               document.form2.page.value=0;
                               document.form2.submit();\">"?>最新記事へ<?
		    if(!$is_newest) echo "</a>"?></font>
	         | <font color=gray><? if(!$first_page)
                     echo "<a href=\"javascript:
                               document.form2.page.value=".($page - 1).";
		               document.form2.submit();\">"; ?>&lt;&lt;
                  前の<?echo GROUP_ADMIN_PAGELEN
                      ?>件へ<? if(!$first_page) echo "</a>"; ?></font>
                 | <font color=gray><? if(!$last_page)
                     echo "<a href=\"javascript:
                               document.form2.page.value=".($page + 1).";
		               document.form2.submit();\">";?>次の<?
                 echo GROUP_ADMIN_PAGELEN ?>件へ
                  &gt;&gt;<?if(!$last_page) echo "</a>" ;?></font
                 ></td>


                  </table>



                  <br>
                </td>

              <tr align=right>
                <td colspan=2>　</td>


              <tr>
                <td colspan=2>
                  <hr size=1>
                </td>


            </table>



            <p>　</p>
            <table width=600 border=1 cellspacing=0 bordercolor="#CCCCCC">
              <tr>
                <td width="25%" align=center><a href=cl04.php><img src="img/icn_postnew%5B1%5D.gif" border=0 width=32 height=32 align=absmiddle>
                  [記事を書く]</a> </td>
                <td align=center width="25%">　 <a href=cl05.php><img src="img/icn_bumon%5B1%5D.gif" border=0 width=24 height=24 align=absmiddle>
                  [検索する]</a> </td>
                <td align=center width="25%"><a href=cl06.php><img src="img/jutyushinki%5B1%5D.gif" width=32 height=32 border=0 align=absmiddle>[管理画面]</a></td>
                <td align=center width="25%" height=40><a href=cl07.php><img src="img/shorui%5B1%5D.gif" width=32 height=32 align=absmiddle border=0>[オンラインヘルプ]</a></td>


            </table>



            <br>
            <hr size=1>
            <p>
            <table width=100%>
              <tr>
                <td align=left   width=33% nowrap><a href="http://www.reds.co.jp">[ホームページ管理画面]</a></td>
                <td align=center width=33%><a href=cl.php>[ログイン画面]</a></td>
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

