<template>
	<site-template>
		<v-container grid-list-md text-xs-center>
		  <v-layout row wrap justify-center>
		    	<v-flex >
		    	  <card-vue title="Atualizar Perfil">
				    <form-vue class="px-2 mx-2 ">
				    	 <v-text-field
					        name="username"
					        label="Nome Completo"
					        id="username"
					        :type="'text'"
					        v-model="model.username"
				     	></v-text-field>
				      <v-text-field
				        name="email"
				        label="E-mail"
				        id="email"
				        :type="'email'"
				        v-model="model.email"
				      ></v-text-field>
				    <v-flex class="mb-5">
				     	<v-btn color="blue" block v-on:click="onUpdate">Atualizar</v-btn>

				     </v-flex>
				    </form-vue>
			    </card-vue>
		    	</v-flex>
		  </v-layout>
		</v-container>
	</site-template>
</template>

<script>
import FormVue from '../components/FormVue';
import CardVue from '../components/CardVue';
import SiteTemplate from '../templates/SiteTemplate'
export default {
	name: 'Register',
	components :{
		FormVue,
		CardVue,
		SiteTemplate
	},
	data: () => ({
		model: {
			username: '',
			email: ''
		},
		errors: '',
		user: '',
      	token: false
	}),
	created(){
	    let user = sessionStorage.getItem('user');
	    if(this.getToken){
	        this.user 	  = JSON.parse(user);
	        this.model.username = this.user.username;
	        this.model.email    = this.user.email;
	    }else{
	      return this.$router.push('/login');
	    }
	  },
	  computed: {
	    getToken(){
	      let token = sessionStorage.getItem('token');
	      if(token){
	        this.token = JSON.parse(token);
	        return true;
	      }
	      return false;
	    }
	},
	methods: {
		async onUpdate(e){
			await this.$http.post(this.$urlAPI + 'client/add', {
				username: 	this.model.username,
				email: 		this.model.email
			})
			.then(r => {
				if(r.data.status){
					console.log(r.data.message);
				}else if(r.data.status == false && r.data.validators){
					this.errors = '';
					for(let error of Object.values(r.data.message)){
						this.errors += error + " "
					}
					console.log(this.errors);
					// if(!this.errors.length){
					// 	return true;
					// }
				}
			})
			.catch(e => {
				console.log(Object.values(e));
				window.alert("Error! Servidor fora do ar");
			})
		}
	}
}
</script>