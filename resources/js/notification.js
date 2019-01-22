class Notification {

	init(){
		this.config();
	}

	config(){
		this.element = {
			modal: $("#notification"),
			modalAlert: $("#notification .modal-body .alert"),
			success: function (msg) {
				this.modal.modal('show');
				this.modalAlert.removeClass('alert-danger').addClass('alert-success');
				this.modalAlert.html(msg);
				this.modal.on('hidden.bs.modal', function() {
					location.reload();
				});
			},
			error: function (msg) {
				this.modal.modal('show');
				this.modalAlert.removeClass('alert-success').addClass('alert-danger');
				this.modalAlert.html(msg);
			},
		}

	}
}

export default Notification
