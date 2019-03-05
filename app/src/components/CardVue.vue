<template>
	<v-card>
		<v-card-text>{{title || 'Titulo Aqui'}}</v-card-text>
	  		<slot></slot>

	</v-card>
</template>

<script>
	export default {
		name: 'CardVue',
		props: ['title']
	}
</script>