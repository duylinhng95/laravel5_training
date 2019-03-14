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
					commentList.append(
						res.view)
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
			if (event.which === 13) {
				btnComment.click()
			}
		})
	}
}

export default Comment