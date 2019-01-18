require('./bootstrap');

window.SlimScroll = require('./components/slimscroll/jquery.slimscroll.js');


jQuery(document).ready(function ($) {
	'use strict';

	var urlParams = new URLSearchParams(window.location.search);
	var order = urlParams.getAll('order');
	var section = urlParams.get('sort');
	if (order == 'desc') {
		$('#' + section).removeClass('fa-arrow-up');
		$('#' + section).addClass('fa-arrow-down');
	} else {
		$('#' + section).removeClass('fa-arrow-down');
		$('#' + section).addClass('fa-arrow-up');
	}

	// ==============================================================
	// Notification list
	// ==============================================================
	if ($(".notification-list").length) {

		$('.notification-list').slimScroll({
			height: '250px'
		});

	}

	// ==============================================================
	// Menu Slim Scroll List
	// ==============================================================


	if ($(".menu-list").length) {
		$('.menu-list').slimScroll({});
	}

	// ==============================================================
	// Sidebar scrollnavigation
	// ==============================================================

	if ($(".sidebar-nav-fixed a").length) {
		$('.sidebar-nav-fixed a')
		// Remove links that don't actually link to anything

			.click(function (event) {
				// On-page links
				if (
					location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
					location.hostname == this.hostname
				) {
					// Figure out element to scroll to
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
					// Does a scroll target exist?
					if (target.length) {
						// Only prevent default if animation is actually gonna happen
						event.preventDefault();
						$('html, body').animate({
							scrollTop: target.offset().top - 90
						}, 1000, function () {
							// Callback after animation
							// Must change focus!
							var $target = $(target);
							$target.focus();
							if ($target.is(":focus")) { // Checking if the target was focused
								return false;
							} else {
								$target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
								$target.focus(); // Set focus again
							}
						});
					}
				}
				$('.sidebar-nav-fixed a').each(function () {
					$(this).removeClass('active');
				})
				$(this).addClass('active');
			});

	}

	// ==============================================================
	// tooltip
	// ==============================================================
	if ($('[data-toggle="tooltip"]').length) {

		$('[data-toggle="tooltip"]').tooltip()

	}

	// ==============================================================
	// popover
	// ==============================================================
	if ($('[data-toggle="popover"]').length) {
		$('[data-toggle="popover"]').popover()

	}
	// ==============================================================
	// Chat List Slim Scroll
	// ==============================================================


	if ($('.chat-list').length) {
		$('.chat-list').slimScroll({
			color: 'false',
			width: '100%'


		});
	}
	// ==============================================================
	// dropzone script
	// ==============================================================

	//     if ($('.dz-clickable').length) {
	//            $(".dz-clickable").dropzone({ url: "/file/post" });
	// }

}); // AND OF JQUERY


// $(function() {
//     "use strict";


// var monkeyList = new List('test-list', {
//    valueNames: ['name']

// });
// var monkeyList = new List('test-list-2', {
//    valueNames: ['name']

// });


// });

window.importUser = function importUser() {
	$.ajax(
		{
			url: importUserURI,
			type: "GET",
			success: function (res) {
				location.reload();
			}
		}
	);
};

window.blockUser = function blockUser(id) {
	$.ajax({
		url: blockUserURI,
		type: "GET",
		data: {id: id},
		success: function (response) {
			var res = response.data;
			$('#' + res.id).find('#status').text('Block');
			$('#' + res.id).find('#action').html('');
			$('#' + res.id).find('#action').append(
				"<button class='btn btn-danger' onclick='blockUser(" + res.id + ")' disabled>Block User</button>" +
				" <button class='btn btn-success' onclick='unBlockUser(" + res.id + ")'>Unblock User</button>"
			)
		}
	});
}

window.unBlockUser = function unBlockUser(id) {
	$.ajax({
		url: unBlockUserURI,
		type: "GET",
		data: {id: id},
		success: function (response) {
			var res = response.data;
			if (res.status == 1) {
				$('#' + res.id).find('#status').text('Active');
			} else {
				$('#' + res.id).find('#status').text('Not Active');
			}
			$('#' + res.id).find('#action').html('');
			$('#' + res.id).find('#action').append(
				"<button class='btn btn-danger' onclick='blockUser(" + res.id + ")' >Block User</button>" +
				" <button class='btn btn-success' onclick='unBlockUser(" + res.id + ")' disabled>Unblock User</button>"
			)
		}
	})
}

window.searchUser = function searchUser() {
	var input = $('#search').val();
	window.location.href = "/admin?keywords=" + input;
}

window.searchPost = function searchPost() {
	var input = $('#search').val();
	window.location.href = "/admin/post?keywords=" + input;
}

window.sortUser = function sortUser(section) {
	var url = window.location.search;
	var sortOrder = new URLSearchParams(url);

	if (sortOrder.get('order') == 'desc') {
		window.location.href = "/admin?sort=" + section + "&order=asc";
	} else {
		window.location.href = "/admin?sort=" + section + "&order=desc";
	}
}

window.sortPost = function sortPost(section) {
	var url = window.location.search;
	var sortOrder = new URLSearchParams(url);

	if (sortOrder.get('order') == 'desc') {
		window.location.href = "/admin/post?sort=" + section + "&order=asc";
	} else {
		window.location.href = "/admin/post?sort=" + section + "&order=desc";
	}
}
