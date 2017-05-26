//选项卡切换
function secBoard_more(td,tr,m,n,downloadContent,downloadContent2,A,URL) {//m是选项卡数量,n是当前选项卡序号
	if(URL != ""){
		URL_A = URL.split("|")
	}
	//更新选项卡样式
	for(i=0;i<m;i++) { 
		if (i==n) {
			document.all(td+n).className=downloadContent;
			if(URL != ""){
				document.all(A).href=URL_A[i];
			}
		} else {
			document.all(td+i).className=downloadContent2;
		}
	}
	
	//隐藏和显示行
	for(i=0;i<m;i++) {
		if (i==n) {
			document.all(tr+n).style.display="";
		} else {
			document.all(tr+i).style.display="none";
		}
	}
}