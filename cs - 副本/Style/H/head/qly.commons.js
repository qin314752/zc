var QlyCommonsMask = {
	_mask:"qly-commons-mask",
	display:function(){
		var _maskObj = $("#"+this._mask);
		//如果遮罩层没有创
		if (_maskObj.length <= 0) { 
			load_qly_commons();
		}
		_maskObj = $("#"+this._mask);
		_maskObj.show();
	},
	close:function(){
		var _maskObj = $("#"+this._mask);
		//如果遮罩层存在
		if (_maskObj.length > 0) {
			_maskObj.hide();
		}
	}
}


var load_qly_commons = function(){
	var _mask="qly-commons-mask";
	var _maskHtml = "<div  id='"+_mask+"'><div  id='"+_mask+"-img'></div></div>"
	$(document.body).append(_maskHtml);
}

$(document).ready(function () {
	load_qly_commons();
});