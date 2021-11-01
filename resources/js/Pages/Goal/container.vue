<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Make physical exercise an everyday habit  
            </h2>
        </template>

        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Todo />
                </div>
            </div>
        </div> -->

        <div class="goalListContainer">
            <div class="heading">
               
                <add-goal-form 
                v-on:reloadlist="getList()"/>
                

            </div>
            <list-view :goals="goals"
            v-on:reloadlist="getList()"/>
           
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Todo from './Todo.vue'
    import addGoalForm from "./addGoalForm.vue"
    import ListView from './listView.vue'

    export default defineComponent({
        components: {
            AppLayout,
            addGoalForm,
            ListView
        } ,
        data: function (){
            return {
                goals: []
            }
        },
        methods: {
            getList(){
                axios.get('api/goals')
                .then( response => {
                    this.goals = response.data
                })
                .catch(error => {
                    console.log(error);
                })
            }
        },
        created(){
            this.getList();
        }
    })
</script>

<style scoped>
    .goalListContainer {
        width: 350px;
        margin: auto;
    }

    .heading {
        background: #e6e6e6;
        padding: 10px;
    }

    #title {
        text-align: center;
    }
</style>