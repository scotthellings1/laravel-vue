<template>
    <form  @submit.prevent="onSubmit"  class="overflow-y-auto">
        <div class="form-group mb-6">
            <label for="customer_name" class="form-label inline-block mb-2 text-gray-700">Customer Name</label>
            <input type="text" name="customer_name" v-model="customer_name" class="form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="customer_name"
                   aria-describedby="emailHelp" placeholder="John Smith">
            <span class="text-sm mt-1 text-red-400" v-if="errors.customer_name">{{errors.customer_name[0]}}</span>
        </div>

        <div class="form-group mb-6">
            <label for="customer_email" class="form-label inline-block mb-2 text-gray-700">Customer Email</label>
            <input type="text" name="customer_email" v-model="customer_email"  class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="customer_email"
                   placeholder="example@mail.com">
            <span class="text-sm mt-1 text-red-400" v-if="errors.customer_email">{{errors.customer_email[0]}}</span>
        </div>



        <button type="submit"
                class="w-full px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700
                hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg
                transition duration-150 ease-in-out">
            Add Quote
        </button>
    </form>
</template>

<script>
export default {
    name: "AddQuote",
    data() {
        return {
            errors: {},
            customer_name: '',
            customer_email: ''
        }
    },
    methods: {
        onSubmit() {
            axios.post('/api/quotes' , this.$data)
            .then( (response) => {
                this.$router.push({ name: 'quotes.show', params: { id: response.data.data.id } });
            })
            .catch((error) => {
                this.errors = error.response.data.errors
            })
        },
    },
}
</script>

<style scoped>

</style>
