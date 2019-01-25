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
			formData: $("#comment"),
			btnComment: $("#btnComment"),
			content: $("#commentContent"),
			num: $("#commentNum"),
			commentList: $(".comment-list"),
		}
		this.apiURL = location.origin
	}

	listen() {
		this.addComment()
	}

	addComment() {
		let data = this.element.formData
		let btn = this.element.btnComment
		let url = `${this.apiURL}/post/comment`
		let comment = this.element.commentList
		btn.on('click', function (event) {
			let id = event.target.children.postId.value
			data = data.serialize()
			$.ajax({
				url: `${url}/${id}`,
				type: "POST",
				data: data,
				success: function (response) {
					var res = response.data
					comment.append(
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
				}
			})
		})
	}
}

export default Comment
