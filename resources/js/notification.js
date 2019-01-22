class Notification {
	init(){
		this.config();
	}

	config(){
		this.element = {
			modal: $("#notification"),
			success: function (msg) {
				this.modal.modal('show');
				$('#notification .modal-body .alert').removeClass('alert-danger').addClass('alert-success');
				$('#notification .modal-body .alert').html(msg);
				this.modal.on('hidden.bs.modal', function() {
					location.reload();
				});
			},
			error: function () {
				this.modal.modal('show');
				$('#notification .modal-body .alert').removeClass('alert-success').addClass('alert-danger');
				$('#notification .modal-body .alert').html(msg);
			},
		}

	}
}

export {Notification}
