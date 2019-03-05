<template>
	<client-template>
		<v-container grid-list-md text-xs-center>
		  <v-layout row wrap justify-center>
		    	<v-flex xs6>
		    	  <card-vue title="Login">
				    <form-vue class="px-2 mx-2">
				      <v-text-field
				        name="email"
				        label="E-mail"
				        id="email"
				        :type="'email'"
				        v-model="auth.email"
				      ></v-text-field>

				      <v-text-field
				        name="password"
				        label="Senha"
				        id="password"
				        :type="'password'"
				        v-model="auth.password"
				      ></v-text-field>
				      <v-flex >
				     	<v-btn color="primary" block  v-on:click="onLogin">Login</v-btn>
				     	<v-btn color="success" block >Cadastrar-se</v-btn>
				     </v-flex>
				    </form-vue>
			    </card-vue>
		    	</v-flex>
		  </v-layout>
		</v-container>
	</client-template>
</template>

<script>
import FormVue from '../components/FormVue';
import CardVue from '../components/CardVue';
import ClientTemplate from '../templates/ClientTemplate'
export default {
	name: 'Login',
	components :{
		FormVue,
		CardVue,
		ClientTemplate
	},
	data: () => ({
		auth: {
			email: '',
			password: ''
		},
		errors: []
	}),
	methods: {
		async onLogin(e){
			await this.$http.post(this.$urlAPI + 'login', {
				email:  this.auth.email,
				password: this.auth.password
			})
			.then(r => {
				if(r.data.status){
					sessionStorage.setItem('user', JSON.stringify(r.data.user));
					sessionStorage.setItem('token', JSON.stringify(r.data.token));

					if(sessionStorage.getItem('token') && sessionStorage.getItem('user')){
						window.alert(r.data.message);
						return this.$router.push('/');
					}
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

			});
		}
	}
}
</script>