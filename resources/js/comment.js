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
						`<div class="article-content">
              <div class="article-comment-top">
                  <div class="comments-user">
                      <div class="user-name">${res.user.name}</div>
                      <div class="comment-post-date">Posted On
                          <span class="italics">${res.created_at}</span>
                      </div>
                  </div>
                  <div class="comments-content">
                      ${res.content}
                  </div>
              </div>
          </div>`)
				},
				error: function(res){
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
