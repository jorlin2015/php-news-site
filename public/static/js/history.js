var historyMsg = {
	/**
	 *绑定页面事件
	 */
	bindEvent : function(){
		
	},
	/**
	 *根据房间或者好友id获取消息列表
	 */
	getMessage : function(type, id, page, size){
		var self = this;
		$.ajax({
			url : '/history/getMessage',
			type : 'get',
			dataType : 'json',
			data : {
				type : type,
				id : id,
				page : page,
				size : size
			},
			success : function(result){
				chat.renderHistory(result, $('body').data('id'));
			},
			error : function(){}
		});
	},
};
historyMsg.bindEvent();
historyMsg.getMessage(data.type, data.id, 1, 10);