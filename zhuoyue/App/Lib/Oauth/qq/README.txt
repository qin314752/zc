====================PHP SDKʹ��˵��====================
������ֻ��Ҫ���������˵���޸ļ��д��룬�Ϳ�������վ��ʵ�֡�QQ��¼�����ܡ�
1. ʹ��ǰ���޸� comm/config.php �е���������
	$_SESSION["appid"];
	$_SESSION["appkey"];
	$_SESSION["callback"];  

2. ��ҳ�����QQ��¼��ť
	<a href="#" onclick='toQzoneLogin()'><img src="img/qq_login.png"></a>

3. ҳ����Ҫ��js����
	<script>
		function toQzoneLogin()
		{
			var A=window.open("oauth/redirect_to_login.php","TencentLogin","width=450,height=320,menubar=0,scrollbars=1, resizab
			le=1,status=1,titlebar=0,toolbar=0,location=1");
		} 
	</script>

4. SDK��ʹ��session�������Ҫ����Ϣ��Ϊ������վ���ڶ����������ͬһ����������ͬ��������ɵ�session�޷��������⣬�뿪���߰��ձ�SDK��comm/session.php�е�ע�Ͷ�session.php���б�Ҫ���޸ģ��Խ����2�����⡣


====================��ǰ�汾��Ϣ====================
��ǰ�汾��beta_V1.3

�������ڣ�2011-05-27

�ļ���С��23.6 K 


====================�޸���ʷ====================
V1.3  ֧������������session��֧�ֿ����������session
V1.2  ��������־�ӿڵ�SDK������ע�͹淶��
V1.1  �޸�php�Ͱ汾��֧��hash_hmac���������⡣
V1.0  beta���һ�淢����



====================�ļ��ṹ��Ϣ====================
comm�ļ��У�
	config.php:�����ļ������ô�����еĺ����
	util.php:  ������OAuth��֤�����л��õ��Ĺ��÷���
        session.php: ֧������������session��֧�ֿ����������session��

oauth�ļ��У�
	get_request_token.php: ��ȡ��ʱtoken
	redirect_to_login.php����Ӧ��¼��ť�¼��������û���ת��QQ��¼��Ȩҳ
	get_access_token����ȡ����Qzone����Ȩ�޵�access_token���洢��ȡ������Ϣ������������ʻ���openid�İ��߼�

user�ļ��У�
	get_user_info.php����ȡ�û���Ϣ

feeds�ļ��У�
        add_feeds.php����һ����̬��feeds��ͬ����QQ�ռ��У�չ�ָ�����

photo�ļ��У�
	add_album.php�� ��ȡ��¼�û�������б�
	list_album.php����¼�û��������
	upload_pic.php����¼�û��ϴ���Ƭ

blog�ļ��У�        
	add_blog.php����¼�û�����һƪ����־

img�ļ��У�
	QQ��¼ͼ�꣬�����н��������ͼƬ��Ϊ��ťͼ��



====================��ϵ����====================
QQ��¼������http://connect.opensns.qq.com/
��������ʹ�ù��������κ�����ͽ��飬�뷢�ʼ���connect@qq.com ���з�����
���⣬��Ҳ����ͨ����ҵQQ�����룺800030681��ֱ����QQ�ġ�������ϵ�ˡ���������뼴�ɿ�ʼ�Ի�����ѯ��

