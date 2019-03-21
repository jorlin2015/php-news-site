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
	receiveMessage : function(data){
		var tmpl = `<div class="chat-item chat-other">
						<span class="chat-name">${data.name}</span><span>:</span><span class="chat-msg">${data.content}</span>
					</div>`;
		$('.msg-container .msg-content .msg-content-scroll').append(tmpl);
		this._scrollBottom();
	},
	sendMessage : function(data){
		var tmpl = `<div class="chat-item chat-me">
						<span class="chat-name">我</span><span>:</span><span class="chat-msg">${data.content}</span>
					</div>`;
		$('.msg-container .msg-content .msg-content-scroll').append(tmpl);
		this._scrollBottom();
	},
	renderMessage : function(data,me){
		for(var i = 0; i < data.length; i++){
			var item = data[i],
				from = item.id;
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
						<span class="chat-name">${c.name}</span><span>:</span><span class="chat-msg">${c.content}</span>
					</div>
				`).join('')}
		`;
		$('.msg-container .msg-content .msg-content-scroll').html(tmpl);
		this._scrollBottom();
	}
};