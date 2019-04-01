var historyMsg = {
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
				self._renderPager(result, function(pn){
					self.getMessage(type, id, pn, size);
				});
				chat.renderHistory(result.list, $('body').data('id'));
			},
			error : function(){}
		});
	},
	_renderPager : function(result,callback){
		var params = {
			target : $('.msg-history .msg-pager'),
			totalCount : result.totalCount,
			pn : result.current_page,
			callback : callback
		};
		new Pager(params);
	}
};
historyMsg.getMessage(data.type, data.id, 1, 10);