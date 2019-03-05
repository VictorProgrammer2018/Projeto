<template>
	<client-template>
		<v-container grid-list-md text-xs-center>
		  <v-layout row wrap justify-center>
		    	<v-flex >
		    	  <card-vue title="Register">
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

	
				    <v-layout row>
				      <v-flex xs6>
				      	<v-text-field
					        name="password"
					        label="Senha"
					        id="password"
					        :type="'password'"
					        v-model="model.password"
					    ></v-text-field>
				      </v-flex>

				      <v-flex xs6>
				      	<v-text-field
					        name="confirmation_password"
					        label="Confirmar Senha"
					        id="confirmation_password"
					        :type="'password'"
					        v-model="model.password_confirmation"
					      ></v-text-field>
				      </v-flex>
				    </v-layout>
				    <v-flex class="mb-5">
				     	<v-btn color="success" block v-on:click="onRegister">Registrar</v-btn>
				     	<v-btn color="primary" block >Já possui cadastro?</v-btn>

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
	name: 'Register',
	components :{
		FormVue,
		CardVue,
		ClientTemplate
	},
	data: () => ({
		model: {
			username: '',
			email: '',
			password: '',
			password_confirmation: ''
		},
		errors: '',
	}),
	methods: {
		async onRegister(e){
			await this.$http.post(this.$urlAPI + 'client/add', {
				username: 	this.model.username,
				email: 		this.model.email,
				password:   this.model.password,
				password_confirmation: this.model.password_confirmation
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