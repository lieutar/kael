<?
ini_set("include_path",	ini_get("include_path") .
	( substr(php_uname(),0,7) == "Windows"
	  ? ";..\\..\\..\\php_lib"
	  : ":../../../php_lib" ));



include_once("RPS_LIB.php");

$MainForm = new rps_form("form1");

$vh  = gv("vhead");
$vf  = gv("vfoot");

if($koyoukeitai == null)$koyoukeitai = "�Ұ�";
if(gv("koyoukeitai_sonota") != "") $koyoukeitai = "����¾";



function vfcbox($name,$value)
{
  global $vf;
  printf("<input type=checkbox name='vfoot[%s][]' value='%s'",
	 $name,$value);
  if(is_array($vf[$name]))
    {
      foreach($vf[$name] as $v)
	{
	  if($v == $value) echo " checked";
	}
    }
  echo ">$value";
}

function vhconst($name,$value,$num = "")
{
  printf("<input type=hidden name='vhead[%s][%s]' value='%s'>%s",
	 $name,$num,$value,$value);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title>�������ϡ����Ѿ��� ����</title>
<link href="../css/style.css" rel=stylesheet type="text/css">
<script type="text/javascript">
<!--
var essential = null;
var sonota    = null;
var df        = null;
var dfe       = null;

function init()
{
  df  = document.form1;
  dfe = document.form1.elements;
  essential =
    new Array( df.title                    ,         '�����ȥ�' ,
	       /*
	       df.shokushu                 ,             '����' ,
	       dfe['vhead[kyuyo][0]']      ,         '��Ϳ����' ,
	       dfe['vhead[kyuyo][1]']      ,           '��Ϳ��' ,
	       df.shigotonaiyo             ,     '�ܺٻŻ�����' ,
	       dfe['vhead[kinmujikan][0]'] ,     '��̳���ϻ���' ,
	       dfe['vhead[kinmujikan][1]'] ,     '��̳��λ����' ,
	       dfe['vhead[shikaku][1]']    , '������ǯ�𲼸�' ,
	       dfe['vhead[shikaku][3]']    , '������ǯ����' ,
	       */
	       df.tantosha                 ,         'ô����̾' ,
	       df.denwabango               ,         '�����ֹ�' ,
	       df.email                    ,    '������E�᡼��' );

  for(i=0;i<df.koyoukeitai.length;i++)
    {
      if(df.koyoukeitai[i].value=="����¾")
	{
	  sonota = df.koyoukeitai[i];
	  break;
	}
    }
}

<? $MainForm->js_check_date(); ?>

function check_sonota()
{
  if(sonota == null) init();
  if(sonota.checked == false)
    {
      df.koyoukeitai_sonota.value    = '';
      df.koyoukeitai_sonota.disabled = true;
    }
  else
    {
      df.koyoukeitai_sonota.disabled = false;
    }
}


function check_data()
{
  if(essential == null) init();


  for(i=0;i<essential.length;i+=2)
    {
      var e = essential[i];
      if(e.value.length == 0)
	{
	  alert('��'+essential[i+1]+'�ۤ����Ϥ���Ƥ��ޤ���');
	  return false;
	}
    }

  /*
  if(!dfe['vfoot[oubohoho][0]'].checked &&
     !dfe['vfoot[oubohoho][1]'].checked &&
     df.oubohoho.value.length == 0)
    {
      alert('�ڱ�����ˡ�ۤ����Ϥ���Ƥ��ޤ���');
      return false;
    };
  */

  if(sonota.checked && df.koyoukeitai_sonota.value.length < 1)
    {
      alert('�ڸ��ѷ��֡ۤˡ֤���¾�פ����򤵤�Ƥ��ޤ�����'+
	    '�������Ƥ���������Ƥ��ޤ���');
      return false;
    }

  if(df.koyoukeitai.length)
    for(i=0;i<df.koyoukeitai.length;i++)
      if(df.koyoukeitai[i].checked == true) return true;

  alert('�ڸ��ѷ��֡ۤ�̤����Ǥ�');
  return false;
}


//-->
</script>
</head>

<body bgcolor="#FFFFFF"
      text   ="#000000"
      link   ="#0000FF"
      vlink  ="#0000FF"
      alink  ="#FF0000"
      onload = "check_sonota()">

<div align=center><a name=top></a><br>
  <table width="90%" border=1 cellpadding=3 cellspacing=0 bordercolor="#999999">
    <tr>
      <td width="75%" class=big><strong>���Ѿ��� ����</strong></td>
      <td width="25%" align=right class=big>��������</td>


  </table>



  <br>
 <form name=form1 method=post action="conf.php"
       onsubmit="return check_data();">
  <input type=hidden name=mode value="<?echo $index != null ? "edit" : "add" ;?>">
<? if($index != null) :?>
  <input type=hidden name=index value=<?evf("index")?>>
<? endif;
$now = getdate();
?>
<input type=hidden name=input_y value=<?echo $now["year"]?>>
<input type=hidden name=input_m value=<?echo $now["mon"]?>>
<input type=hidden name=input_d value=<?echo $now["mday"]?>>

    <table width="80%" border=0 cellspacing=0 cellpadding=3>
     <tr>
       <td width="100%"><input name=back type=button id=back value="���" onClick="location.href='index.php';">
          </td>


      <tr>
        <td>�罸�������Ƥ�ʲ��ι��ܤˤ������ä����Ϥ��Ƥ�����������<font
            color="#FF0000">*</font>��������ɬ�ܹ��ܤǤ���</td>

   </table>




    <hr width="80%">


    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr valign=top>
        <td width="20%" bgcolor="#FFFFCC"
         >���ѷ���<font color="#FF0000">*</font></td>
        <td width="80%" bgcolor="#E6E6E6">


          <table width="100%" border=0 cellspacing=0 cellpadding=2>
            <tr>
              <td nowrap>
                <input type=radio
                       name=koyoukeitai
                       value="�Ұ�"<?if($koyoukeitai == "�Ұ�")
                                      echo " checked"?>
                       onClick="check_sonota()">�Ұ�
              <td nowrap>
<input type=radio name=koyoukeitai value="����Х���"<?if($koyoukeitai == "����Х���")echo " checked"?> onClick="check_sonota()">����Х���
              <td nowrap>
<input type=radio name=koyoukeitai value="�ѡ���"<?if($koyoukeitai == "�ѡ���")echo " checked"?> onClick="check_sonota()">�ѡ���
              <td nowrap>
<input type=radio name=koyoukeitai value="����Ұ�"<?if($koyoukeitai == "����Ұ�")echo " checked"?> onClick="check_sonota()">����Ұ�
              <td nowrap>
<input type=radio name=koyoukeitai value="�����Ұ�"<?if($koyoukeitai == "�����Ұ�")echo " checked"?> onClick="check_sonota()">�����Ұ�

            <tr>
              <td nowrap><input type=radio name=koyoukeitai value="�ɸ��Ұ�"<?if($koyoukeitai == "�ɸ��Ұ�")echo " checked"?> onClick="check_sonota()">�ɸ��Ұ�
              <td nowrap>
<input type=radio name=koyoukeitai value="���ֽ��Ȱ�"<?if($koyoukeitai == "���ֽ��Ȱ�")echo " checked"?> onClick="check_sonota()">���ֽ��Ȱ�
              <td nowrap>
<input type=radio name=koyoukeitai value="�Ҳ���"<?if($koyoukeitai == "�Ҳ���")echo " checked"?> onClick="check_sonota()">�Ҳ���
              <td nowrap>
<input type=radio name=koyoukeitai value="��Ͽ��"<?if($koyoukeitai == "��Ͽ��")echo " checked"?> onClick="check_sonota()">��Ͽ��
              <td nowrap>
<input type=radio name=koyoukeitai value="��̳����"<?if($koyoukeitai == "��̳����")echo " checked"?> onClick="check_sonota()">��̳����

<tr>
     <td nowrap colspan=5>
<input type=radio name=koyoukeitai value="����¾"<?if($koyoukeitai == "����¾")
echo " checked"?> onClick="check_sonota()">����¾
<input name=koyoukeitai_sonota value="<?evf("koyoukeitai_sonota")?>">

          </table>



      <tr valign=top>
        <td bgcolor="#FFFFCC">�����ȥ�<font color="#FF0000">*</font></td>
        <td bgcolor="#E6E6E6"><input name=title type=text size=60
                                     value="<?evf("title");?>"></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">����</td>
        <td bgcolor="#E6E6E6"
         ><input name =shokushu
                 type =text
                 size =60
                 value="<? evf("shokushu"); ?>"></td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">��Ϳ</td>
        <td bgcolor="#E6E6E6">

          <select name="vhead[kyuyo][0]">
            <option value="">�����Ӥ�������</option>
            <option value="����"
	      <?if($vf["kyuyo"][0] == "����"  )echo "selected"?>>����
            <option value="����"
	      <?if($vf["kyuyo"][0] == "����"  )echo "selected"?>>����
            <option value="���"
	      <?if($vf["kyuyo"][0] == "���"  )echo "selected"?>>���
            <option value="ǯ����"
	      <?if($vf["kyuyo"][0] == "ǯ����")echo "selected"?>>ǯ����
          </select>

          <input type =text
                 name ="vhead[kyuyo][1]"
                 value="<?echo $vf["kyuyo"][1];?>">
          <?vhconst("kyuyo","��",2)?><br>
	      <input type=hidden name="vheaddep[kyuyo][2]" value="1">

          ����¾����­����<br>
          <textarea name=kyuyo cols=50 rows=3><?evf("kyuyo");?></textarea></td>

      <tr valign=top>
        <td bgcolor="#FFFFCC">�ܺٻŻ�����</td>
        <td bgcolor="#E6E6E6"><textarea name=shigotonaiyo cols=50 rows=3
                              ><?evf("shigotonaiyo")?></textarea></td>

      <tr valign=top>
        <td bgcolor="#FFFFCC">��̳��</td>
        <td bgcolor="#E6E6E6"><textarea name=kinmuchi cols=50 rows=3
                             ><?evf("kinmuchi")?></textarea></td>

      <tr valign=top>
        <td bgcolor="#FFFFCC">��̳����</td>
        <td bgcolor="#E6E6E6"
         ><table width="100%" border=0 cellspacing=0 cellpadding=0>
            <tr>
              <td colspan=2><input type=text
                                   name="vhead[kinmujikan][0]"
                                   size=10
                                   maxlength=10
	                           value="<?echo $vh["kinmujikan"][0]?>"
	        ><?vhconst("kinmujikan", "����", 1)?>
                <input type=text
                       name="vhead[kinmujikan][2]"
                       size=10
                       maxlength=10
	               value="<?echo $vh["kinmujikan"][2]?>"
	        ><?vhconst("kinmujikan","����",3)?>
	  <input type=hidden name="vheaddep[kinmujikan][1]" value=0>
	  <input type=hidden name="vheaddep[kinmujikan][3]" value=2>
            <tr>
              <td><?vfcbox("kinmujikan","�Ķ�ͭ��");?>
	      <td><?vfcbox("kinmujikan","���֤ϱ�����")?>>

            <tr>
              <td colspan=2> ����¾����­����<br>
               <textarea name="kinmujikan" cols=50 rows=3
               ><?evf("kinmujikan")?></textarea>
      </table>

      <tr valign=top>
        <td bgcolor="#FFFFCC">����</td>
        <td bgcolor="#E6E6E6"><table width="100%"
                                     border=0 cellspacing=0 cellpadding=0>
            <tr>
              <td><?vfcbox("kyujitsu","������")?>
              <td><?vfcbox("kyujitsu","���ե���")?>
              <td><?vfcbox("kyujitsu","�����")?>

            <tr>
              <td colspan=3> ����¾����­����<br>
              <textarea name=kyujitsu cols=50 rows=3><?evf("kyujitsu")?></textarea>
       </table>





      <tr valign=top>
        <td bgcolor="#FFFFCC">��̳����</td>
        <td bgcolor="#E6E6E6"
        ><table width="100%" border=0 cellspacing=0 cellpadding=0>
            <tr>
              <td><?vfcbox("kinmukikan","Ĺ��")?>
              <td><?vfcbox("kinmukikan","û��")?>
              <td><?vfcbox("kinmukikan","�쥮��顼")?>
              <td><?vfcbox("kinmukikan","��ǯ�ʾ�")?>
            <tr>
              <td colspan=4> ����¾����­����<br>
              <textarea name=kinmukikan cols=50 rows=3
                ><?evf("kinmukikan")?></textarea>
      </table>





      <tr valign=top>
        <td bgcolor="#FFFFCC">���</td>
        <td bgcolor="#E6E6E6"
           ><table width="100%" border=0 cellspacing=0 cellpadding=0>
            <tr>
              <td colspan=2>
	        <?vhconst("shikaku","ǯ��",0);?>
                <input type=text name="vhead[shikaku][1]" size=10 maxlength=10
                       value="<?echo $vh["shikaku"][1]?>">
                <?vhconst("shikaku","�͡�",2);?>
                <input type=text name="vhead[shikaku][3]" size=10 maxlength=10
                       value="<?echo $vh["shikaku"][3]?>">
                <?vhconst("shikaku","����",4);?>

		<input type=hidden name="vheaddep[shikaku][1][or][]" value=1>
		<input type=hidden name="vheaddep[shikaku][0][or][]" value=3>
		<input type=hidden name="vheaddep[shikaku][2]"       value=1>
		<input type=hidden name="vheaddep[shikaku][4]"       value=3>



            <tr>
              <td colspan=2>
                ɬ�פʻ�ʡ��ȵ����Ѹ��ʤɡ�<br>
                <input type=text name="shikaku" size=60 maxlength=200
                       value="<?evf("shikaku")?>">
            <tr>
              <td><?vfcbox("shikaku","̤�и��Դ���")?>
              <td><?vfcbox("shikaku","�и���ͥ��")?>
            <tr>
              <td colspan=2> ����¾����­����<br>
              <textarea name="shikaku" cols=50 rows=3></textarea>
      </table>

    </td>

      <tr valign=top>
        <td bgcolor="#FFFFCC">�Զ�</td>
        <td bgcolor="#E6E6E6"
          ><table width="100%" border=0 cellspacing=0 cellpadding=0>
            <tr><td><?vfcbox("taigu","������ٵ�")?>
                <td><?vfcbox("taigu","�Ұ�����ͭ")?>
            <tr><td><?vfcbox("taigu","����ͭ��")?>
                <td><?vfcbox("taigu","��������ͭ��")?>
            <tr>
              <td colspan=2> ����¾����­�������ݸ���ʡ�������ʤɡ�<br>
              <textarea name=taigu cols=50 rows=3><?evf("taigu");?></textarea>
      </table>


      <tr valign=top>
        <td bgcolor="#FFFFCC">������ˡ</td>
        <td bgcolor="#E6E6E6"
         ><table width="100%" border=0 cellspacing=0 cellpadding=0>
            <tr><td><?vfcbox("oubohoho","����ե����फ��")?>
            <tr><td><?vfcbox("oubohoho","����Ϣ��ξ���������")?>
            <tr>
              <td> ����¾����­����<br>
              <textarea name="oubohoho" cols=50 rows=3
               ><?evf("oubohoho")?></textarea>
         </table>

      <tr valign=top>
        <td bgcolor="#FFFFCC">ô����̾<font color="#FF0000">*</font></td>
        <td bgcolor="#E6E6E6"><input name=tantosha type=text size=60
                                     value="<?evf("tantosha")?>"></td>

      <tr valign=top>
        <td bgcolor="#FFFFCC">�����ֹ�<font color="#FF0000">*</font></td>
        <td bgcolor="#E6E6E6"><input name=denwabango type=text size=60
                                     value="<?evf("denwabango");?>"></td>

      <tr valign=top>
        <td bgcolor="#FFFFCC">������E�᡼��<font color="#FF0000">*</font></td>
        <td bgcolor="#E6E6E6"><input name=email type=text size=60
                                     value="<?evf("email")?>">
          <br>
          ��Ⱦ�ѱѿ������Ϥ��Ƥ�������</td>


      <tr valign=top>
        <td bgcolor="#FFFFCC">�������<font color="#FF0000">*</font></td>
        <td bgcolor="#E6E6E6"><?echo $MainForm->date_form("oubokikan");?></td>
    </table>

    <br>

    <table width="80%" border=0 cellspacing=2 cellpadding=2>
      <tr>
        <td align=center bgcolor="#CCCCCC">
        <input type=submit value="��ǧ����">
        <input type=button value="���" onClick="location.href='index.php';">
        </td>


    </table>

    <br>

  </form>
</div>
</body>
</html>
