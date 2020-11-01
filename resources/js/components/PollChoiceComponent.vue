<template>
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header" v-if="!aboutPoll.poll.closed && !aboutPoll.poll.hasVoted">Pilih!</div>
                <div class="card-header" v-else>Hasil polling!</div>
                <div class="card-body" v-if="!aboutPoll.poll.closed && !aboutPoll.poll.hasVoted">
                    <h2>{{ aboutPoll.poll.title }}</h2>
                    <small>Oleh {{ aboutPoll.author.name }}</small>
                    <br>
                    <br>
                    <p style="color: blue;">Pilihan vote:</p>
                    <form method="post" action="#">
                        <input type="hidden" name="_token" :value="csrf">
                        <button type="submit" class="btn btn-outline-primary" v-for="choice in aboutPoll.choices" :key="choice.id" name="choice" :value="choice.id" style="width: 100%">{{ choice.value }}</button>
                    </form>
                </div>
                <div class="card-body" v-else>
                    <h2>{{ aboutPoll.poll.title }}</h2>
                    <small>Oleh {{ aboutPoll.author.name }}</small>
                    <br>
                    <br>
                    <p style="color: blue;">Hasil:</p>
                    <hr>
                    <p v-for="choice in aboutPoll.choices" :key="choice.id">{{ choice.value }} sebanyak {{ result.hasOwnProperty(choice.id)? result[choice.id] : 0 }}</p><br>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">Vote History</div>
                <div class="card-body">
                    <p v-for="(vote, index) in history.votes" :key="index">{{ vote.respondent_name }} telah memilih</p>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        props: ['aboutPoll', 'history'],
        data: function () {
                return {
                    csrf: '',
                    result: {}
                }
            },
        methods: {
            pusherConnect() {
                Echo.private(`vote-channel-${this.aboutPoll.poll.id}`)
                    .listen('VoteStoredEvent', (vote) => {
                        this.history.votes.push(vote.data)
                        if (!this.result.hasOwnProperty(vote.data.choice_id)) {
                            this.result[vote.data.choice_id] = 1
                        } else ++this.result[vote.data.choice_id]
                        console.log(this.result)
                        console.log(this.history.votes)
                        this.$forceUpdate();
                    })
            }
        },
        created() {
            this.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            console.log(this.aboutPoll, this.history)
            if (this.aboutPoll.poll.closed || this.aboutPoll.poll.hasVoted) {
                console.log(this.history.votes.map((val) => {
                    if (!this.result.hasOwnProperty(val.choice_id)) {
                        this.result[val.choice_id] = 1
                    } else ++this.result[val.choice_id]
                }))
                console.log(this.result)
            }
            this.pusherConnect()
        },
    }
</script>
