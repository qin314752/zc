<?php


$v_oid   = trim($_POST['v_oid']);     //���մ��ݹ����Ķ����� 
$v_mid   = "22734325"; //merchant number  �˴���д�̻���    
$v_url   = "http://www.***.com/Pay/paynotice?payid=chinabank"; //�á��첽���յ�ַ���Ϳ���   

$key='dedaozhi';       //merchant MD5KEY   �̻���Կ                         

$billNo_md5=strtoupper(md5($v_oid.$key));

?>


<Form name=wq Action=https://pay3.chinabank.com.cn/receiveorder.jsp method=post>

<input type=hidden name="v_oid" value="<? echo $v_oid;?>">
<input type=hidden name="v_mid" value="<? echo $v_mid;?>">
<input type=hidden name="billNo_md5" value="<? echo $billNo_md5;?>">
<input type=hidden name="v_url" value="<? echo $v_url;?>">


</form>

<script language="javascript">

document.forms[0].submit();

</script>


