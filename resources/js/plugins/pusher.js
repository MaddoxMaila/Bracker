import Echo from 'laravel-echo'

window.Echo = new Echo({
	broadcaster : 'pusher',
	key : '2c51a2b4b42d0cf02673',
	cluster: 'mt1',
	auth : {
		headers : {
			'X-CSRF-TOKEN' : window.config.token/*document.querySelector('meta[name="csrf-token"]').getAttribute('content')*/
		}
	}
})


// window.pusher = var pusher = new Pusher('9a76c08ed76b527c3816', { cluster: 'eu' })