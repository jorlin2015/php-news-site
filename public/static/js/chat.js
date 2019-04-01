var chat = {
	_scrollBottom : function(){
		var wrap = $('.msg-container .msg-content'),
			height = $('.msg-content-scroll',wrap).height();
		wrap.scrollTop(height);
	},
	renderContacts : function(data){
		var tmpl = `
				${data.map(c=>`
				<li class="item"><a href="javascript:void(0);" data-type="${c.type}" data-id="${c.id}">${c.name}</a></li>
				`).join('')}
		`;
		$('.contacts-container').html(tmpl);
	},
	renderRoomMember : function(data){
		var tmpl = `
				${data.map(c=>`
				<li class="item">
					<span>${c.name}</span>
					${c.canChat ? `<a data-id="${c.id}" class="toBeFriend" href="javascript:void(0);">私聊</a>` : ``}
				</li>
				`).join('')}
		`;
		$('.msg-container').addClass('room-msg');
		$('.room-contacts-container').addClass('active').html(tmpl);
	},
	clearRoomMember : function(){
		$('.msg-container').removeClass('room-msg');
		$('.room-contacts-container').removeClass('active')
	},
	receiveMessage : function(c){
		c.time = DateUtil.format(new Date(), 'yyyy-MM-dd HH:mm:ss');
		var tmpl = `<div class="chat-item chat-other">
						<div class="chat-title">
							<span class="chat-name">${c.name}</span><span>:</span><span class="chat-time">${c.time}</span>
						</div>
						<div class="chat-content">
							<span class="chat-msg">${c.content}</span>
						</div>
					</div>`;
		$('.msg-container .msg-content .msg-content-scroll').append(tmpl);
		this._scrollBottom();
	},
	sendMessage : function(c){
		c.time = DateUtil.format(new Date(), 'yyyy-MM-dd HH:mm:ss');
		var tmpl = `<div class="chat-item chat-me">
						<div class="chat-title">
							<span class="chat-name">我</span><span>:</span><span class="chat-time">${c.time}</span>
						</div>
						<div class="chat-content">
							<span class="chat-msg">${c.content}</span>
						</div>
					</div>`;
		$('.msg-container .msg-content .msg-content-scroll').append(tmpl);
		this._scrollBottom();
	},
	//新消息并且之前没有聊过天
	newContact : function(c){
		var tmpl = `
				<li class="item"><a class="name" href="javascript:void(0);" data-type="${c.type}" data-id="${c.from}">${c.name}</a></li>
		`;
		$('.contacts-container').append(tmpl);
	},
	renderMessage : function(data,me){
		for(var i = 0; i < data.length; i++){
			var item = data[i],
				from = item.id;
			item.time = DateUtil.format(item.time, 'yyyy-MM-dd HH:mm:ss');
			if(from == me){
				item.className = 'chat-me';
				item.name = "我";
			}else{
				item.className = 'chat-other';
			}
		}
		var tmpl = `
				${data.map(c=>`
					<div class="chat-item ${c.className}">
						<div class="chat-title">
							<span class="chat-name">${c.name}</span><span>:</span><span class="chat-time">${c.time}</span>
						</div>
						<div class="chat-content">
							<span class="chat-msg">${c.content}</span>
						</div>
					</div>
				`).join('')}
		`;
		$('.msg-container .msg-content .msg-content-scroll').html(tmpl);
		this._scrollBottom();
	},
	renderTitle : function(type,id,name){
		$('.msg-title').html(`
				<span class="msg-name">${name}</span><a class="more" href="/history?type=${type}&id=${id}">更多</a>
		`);
	},
	renderHistory : function(data, me){
		this.renderMessage(data,me);
		//TODO 分页
	}
};