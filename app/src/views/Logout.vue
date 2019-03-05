<template>
	
</template>

<script>
	export default{
		name: 'Logout',
		data () {
		     return {
		      user: '',
		      token: false
		    }
		  },
		  mounted(){
		    this.logout;
		  },
		  computed: {
		   
		  logout(){
		  	sessionStorage.clear();
		  	return this.$router.push('/login');
		  	
		  }
		}
	}
</script>