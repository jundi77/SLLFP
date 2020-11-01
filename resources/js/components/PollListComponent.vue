<template>
        <div class="card">
            <div class="card-header">Polls</div>
            <div class="card-body">
		<div
			style="width:100%"
			 v-for="poll in polls"
			 :key="poll.id"
		>
		<a :href="'/polls/' + poll.id" class="btn btn-light mb-3" style="width:100%">
			{{ poll.title }} <br />
			<small>Oleh {{ poll.users[0].name }}</small>
		</a>
		</div>
            </div>
        </div>
</template>

<script>
    export default {
	props: ['polls'],
	data: function() {
		return {
		}
	},
    	mounted() {
	    	console.log(this.polls)
	},
	methods: {
	}
    }
</script>
