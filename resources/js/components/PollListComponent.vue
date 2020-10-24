<template>
        <div class="card">
            <div class="card-header">Polls</div>
            <div class="card-body">
		<div
			style="width:100%"
			 v-for="poll in polls"
			 :key="id in poll"
		>
		<a :href="'/poll/' + poll.id" class="btn btn-light mb-3" style="width:100%">
			{{ poll.title }}
		</a>
		</div>
            </div>
        </div>
</template>

<script>
    export default {
	data: function() {
		return {
			polls: [{
				id: 1,
				title: 'p'
			}]
		}
	},
        mounted() {
	    console.log('Component mounted.')
	    this.test()
	},
	methods: {
		test: function() {
			console.log('a')
		}
	}
    }
</script>
