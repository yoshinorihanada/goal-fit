<template>

  
    <button
        class=" bg-pink-500 text-white active:bg-pink-600 font-bold  uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
        type="button" v-on:click="toggleModal()">
        Add a fitness goal
    </button>
    <div v-if="showModal"
        class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
            <!--content-->
            <div
                class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                <!--header-->
                <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                    <h3 class="text-3xl font-semibold">
                        Add a new goal
                    </h3>

                </div>
                <!--body-->
                <div class="relative p-6 flex-auto">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="goal">
                            Goal
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="goal" type="text" placeholder="push up 100 times" v-model="goal.name">
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="due_date">
                            Due date
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 
                        text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="due_date" type="date"  v-model="goal.dueDate" >
                    </div>
                    <!--footer-->
                    <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
                        <button
                            class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button" v-on:click="toggleModal()">
                            Close
                        </button>
                        <button
                            class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button" v-on:click="addNewGoal()">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>




</template>

<script>
    export default {
        data: function () {
            return {
                goal: {
                    name: "",
                    dueDate: ""
                },
                showModal: false,
                
            }
        },
        methods: {
            
            toggleModal() {
                this.showModal = !this.showModal;
            },
            addNewGoal(){
                this.showModal = !this.showModal;
                if (this.goal.name == '') {
                    return;
                }
                

                axios.post('goal/store', {
                        goal: this.goal
                    })
                    .then(response => {
                        if (response.status == 201) {
                            this.goal.name = "";
                            this.goal.dueDate = "";
                            this.$emit("reloadlist");
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            getToday(){
                const date = new Date()
                const today = date.getFullYear()+'/'+(date.getMonth()+1)+'/'+date.getDate();
                return today;
            }
        }
    }

</script>

<style scoped>


    .active {
        color: #00CE25;
    }

    .inactive {
        color: #999999;
    }

   


</style>
