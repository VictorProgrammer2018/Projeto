<template>
	    <v-toolbar color="teal" dark>
		    <v-toolbar-side-icon></v-toolbar-side-icon>
		    <v-toolbar-title>{{logo || 'Logo Aqui'}}</v-toolbar-title>
		    <v-spacer></v-spacer>
		    <v-toolbar-items class="hidden-sm-and-down">
		      	<slot></slot>
		    </v-toolbar-items>
		  </v-toolbar>
</template>

<script>
export default {
	name: 'ToolBarVue',
	props: ['logo'],
	data: () => ({

	})
}
</script>