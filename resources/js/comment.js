class Comment {
	constructor() {
		this.init()
	}

	init() {
		this.config()
		this.listen()
	}

	config() {
		this.element = {
			contentComment: $("#commentContent"),
			token: $("#csrf_token"),
			btnComment: $("#btnComment"),
			num: $("#commentNum"),
			commentList: $(".comment-list"),
			error_message: $("#error_message"),
		}
		this.apiURL = location.origin
	}

	listen() {
		this.addComment()
		this.btnCommentEnter()
	}

	addComment() {
		let url = `${this.apiURL}/post/comment`
		let commentList = this.element.commentList
		let content = this.element.contentComment
		let token = this.element.token
		let error_msg = this.element.error_message
		let comment_num = this.element.num
		this.element.btnComment.on('click', function (event) {
			let id = event.target.children.postId.value
			let data = {
				content: content.val(),
				_token: token.val()
			}
			$.ajax({
				url: `${url}/${id}`,
				type: "POST",
				data: data,
				success: function (response) {
					let res = response.data
					let value = comment_num.html()
					value++
					commentList.append(
						`<div class="author-img">
                <img class="img-responsive img-circle" src="../../images/avatar.png" alt="author"/>
            </div>
            <div class="author-post like-section">
                <h4>${res.user.name}</h4>
                <div class="post-meta comment">
                    <span><i class="fa fa-calendar-check-o post-meta-icon"></i> ${res.created_at}</span>
                </div>
                <p>${res.content}</p>
            </div>`)
					comment_num.text(value)
					content.val('')
				},
				error: function (res) {
					let response = res.responseJSON
					error_msg.html(response.message)
				}
			})
		})
	}

	btnCommentEnter() {
		let btnComment = this.element.btnComment
		let error_msg = this.element.error_message
		this.element.contentComment.keypress(function (event) {
			error_msg.html('')
			if(event.which === 13) {
				btnComment.click()
			}
		})
	}
}

export default Comment
