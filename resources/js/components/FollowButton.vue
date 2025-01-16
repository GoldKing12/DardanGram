<!-- <template>
    <button 
      v-if="follows !== null"
      :class="{
        'px-4 py-2 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700 transition-colors duration-300': true
      }" 
      :disabled="isDisabled"
      @click="toggleFollow"
    >
      {{ follows ? 'Unfollow' : 'Follow' }}
    </button>
  </template>

<script>
    export default {
        
        props: ['userId', 'follows'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function() {
            return {
                status: this.follows,
            }
        },

        methods: {
            followUser() {
                axios.post('/follow/' + this.userId)
                .then(response => {
                    this.status = !this.status;
                    console.log(response.data);
                })
                .catch(errors => {
                    if(errors.response.status == 401){
                        window.location = '/login';
                    }
                });
            }
        },

        computed: {
            buttonText(){
                return (this.status) ? 'Unfollow' : 'Follow'
            }
        }
    }
</script> -->


<template>
    <div>
        <button @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {

        props: ['userId', 'follows'],

        data: function(){
            return {
                status: this.follows,
            }
        },

        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            followUser() {
                axios.post('/follow/' + this.userId)
                .then(response => {
                    this.status = !this.status;
                    console.log(response.data);
                })
                .catch(errors => {
                    if(errors.response.status == 401) {
                        window.location = '/login';
                    }
                });
            }
        },

        computed: {
            buttonText() {
                return this.status ? 'Unfollow' : 'Follow'
            }
        }
    }
</script>
