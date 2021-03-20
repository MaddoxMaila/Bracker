<template>
	
	<div class="wrapper">
		
		<Navigation>
			
			<div class="media-body align-self-center">
				
				<span class="app-max-text">Alerts</span>

			</div>

			<div class="media-right"></div>

		</Navigation>

		<div class="space-large"></div>
		<div class="space-large"></div>
		<div class="space-large"></div>

		<div class="" v-if="loading">
			
			LOADING

		</div>
		<div class="" v-else>
			
			<div class="grey-matter app-shared-post" v-if="notif.error">
				
				<center>
					<span class="app-bold-text">
						{{ notif.message }}
					</span>
				</center>

			</div>

				<div class="list-group" v-else>
					
					<div class="list-group-item" v-for="(notification, index) in notif.notifications" :key="index">
						
						<div class="media">
							
							<div class="media-body">
								
								<span class="app-max-text">
									{{ notification.name }}
								</span>
								<span class="app-small-text">
									{{ notification.message }}
								</span>

							</div>
							<div class="media-right align-self-center">
								
								{{ notification.time }}

							</div>

						</div>

					</div>

				</div>

		</div>

	</div>

</template>

<script type="text/javascript">

	import axios from 'axios'
	
	export default {

		name : "notification",
		data  : () => ({
			notif : {

				notifications : [],
				message : '',
				error   : false

			},
			loading : true,
		}),
		methods : {

			getNotifications : function(){

				this.loading = true

				 axios.get('/api/alerts/all').then(resp => {

				 		let data = resp.data

				 		if(data.error){
				 			console.log(data.message)
				 		}else{

				 			this.notif.message = data.message
				 			this.notif.error = data.error
				 			this.notif.notifications = data.notifications

				 		}

				 		this.loading = false

				 })

			}

		},
		mounted : function(){
			this.getNotifications()
		}

	};

</script>

<style>




</style>