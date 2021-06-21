<template>
    <b-container>
        <h1>About Page</h1>
        {{ getProducts }}
    </b-container>
</template>
<script>
import { mapGetters,mapActions } from 'vuex';
export default {
    data(){
        return {
            p: 1
        }
    },
    middleware: 'auth',
    layout: 'master',
    head: {
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            {
                hid: 'description',
                name: 'description',
                content: 'custom meta tag seo'
            }
        ],
    },
    async fetch(){
        
    },
    computed: {
        ...mapGetters({
            getProducts: "getProducts"
        }),
    },
    created(){
       // this.LoadProducts();
    },
    mounted(){
        
    },
    methods: {
        ...mapActions({
            LoadProducts: "GetProduct"
        })

    },
}
</script>