var index = {
	message : {
		'room' : {},
		'friend' : {}
	},
	/**
	 *获取联系人列表，包括房间和好友
	 */
	getContacts : function(id){
		var self = this;
		$.ajax({
			url : '/index/getContacts',
			type : 'get',
			dataType : 'json',
			success : function(result){
				chat.renderContacts(result);
				self._listenMessage(result);
				if(id){
					$('.contacts-container .item a[data-id=' + id + ']').click();
				}else{
					$('.contacts-container .item a').first().click();
				}
			},
			error : function(){}
		});
	},
	/**
	 *绑定页面事件
	 */
	bindEvent : function(){
		var self = this;
		$('.contacts-container').on('click','.item a:not(.current)',function(){
			var type = $(this).data('type'),
				id = $(this).data('id'),
				name = $(this).text();
			$(this).parent().siblings().find('a').removeClass('current');
			$(this).addClass('current');
			// $('.msg-title').html(name);
			self.getMessage(type, id, name);
			if(type == 1){//房间
				self.getRoomMember(id);
			}else{
				chat.clearRoomMember();
			}
			self.to = id;
			self.type = type;
		});
		$('.msg-send-wrap').on('click','.msg-send-btn',function(){
			var item = $('.msg-send-wrap .msg-send-content'),
				message = item.val();
			item.val('');
			index.sendMessage(message);
		});
		$('.room-contacts-container').on('click','.toBeFriend',function(){
			var id = $(this).data('id'),
				friend = $('.contacts-container .item a[data-id=' + id + ']');
			if(friend.length){
				friend.click();
			}else{
				self.toBeFriend(id);
			}
		});
	},
	toBeFriend : function(id){
		var self = this;
		$.ajax({
			url : '/index/toBeFriend',
			type : 'post',
			dataType : 'json',
			data : {
				id : id
			},
			success : function(result){
				self.getContacts(id);
			},
			error : function(){}
		});
	},
	/**
	 *根据房间id获取在线成员
	 */
	getRoomMember : function(id){
		var self = this;
		$.ajax({
			url : '/index/getRoomMember',
			type : 'get',
			dataType : 'json',
			data : {
				id : id
			},
			success : function(result){
				for(var i = 0; i < result.length; i++){
					var item = result[i];
					if(item.id ==  self.from){
						item.canChat = false;
					}else{
						item.canChat = true;
					}
				}
				chat.renderRoomMember(result);
			},
			error : function(){}
		});
	},
	/**
	 *根据房间或者好友id获取消息列表
	 */
	getMessage : function(type, id, name){
		var self = this;
		chat.renderTitle(type,id,name);
		$.ajax({
			url : '/index/getMessage',
			type : 'get',
			dataType : 'json',
			data : {
				type : type,
				id : id
			},
			success : function(result){
				chat.renderMessage(result, self.from);
			},
			error : function(){}
		});
	},
	/**
	 *发布聊天信息
	 */
	sendMessage : function(content){
		var data = {
			action: 'message',
			type: this.type,//1:room 2:friend
			content: content,
			from : this.from,
			to: this.to
		};
		this.ws.send(JSON.stringify(data));
		chat.sendMessage(data);
	},
	_listenMessage : function(data){
		var data = {
			action: 'contacts',
			from : this.from,
			name : this.name,
			list : data
		};
		if(this.ws){
			this.ws.send(JSON.stringify(data));
		}else{
			setTimeout(()=>this._listenMessage(data),200);
		}
	},
	/**
	 *Socket 监听
	 */
	initSocket : function(){
		var ws = new WebSocket('ws://127.0.0.1:2346'),
			self = this;
		ws.onopen = function() {
		};
		ws.onmessage = function(e) {
			var data = JSON.parse(e.data);
			self._updateMessage(data);
			var type = data.type,
				id = type==1?data.to:data.from,
				item = $('.contacts-container .item a[data-id=' + id + '][data-type=' + type + ']');
			if(data.action == 'message' && item.length){
				if(item.hasClass('current')){
					chat.receiveMessage(data);
				}
			}else{
				chat.newContact(data);
			}
		};
		this.ws = ws;
	},
	/**
	 *更新缓存 TODO
	 */
	_updateMessage : function(){

	},
	from : $('body').data('id'),
	name : $('body').data('name')
};
index.initSocket();
index.bindEvent();
index.getContacts();
