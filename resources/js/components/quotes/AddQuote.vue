<template>
    <form class="overflow-y-auto" @submit.prevent="onSubmit">
        <div class="form-group mb-6">
            <label class="form-label inline-block mb-2 text-gray-700" for="customer_name">Customer Name</label>
            <input id="customer_name" v-model="customer_name" aria-describedby="emailHelp" class="form-control
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
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="customer_name"
                   placeholder="John Smith" type="text">
            <span v-if="errors.customer_name" class="text-sm mt-1 text-red-400">{{ errors.customer_name[0] }}</span>
        </div>

        <div class="form-group mb-6">
            <label class="form-label inline-block mb-2 text-gray-700" for="customer_email">Customer Email</label>
            <input id="customer_email" v-model="customer_email" class="form-control block
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
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="customer_email" placeholder="example@mail.com"
                   type="text">
            <span v-if="errors.customer_email" class="text-sm mt-1 text-red-400">{{ errors.customer_email[0] }}</span>
        </div>


        <button class="w-full px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700
                hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg
                transition duration-150 ease-in-out"
                type="submit">
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
            axios.post('/api/quotes', this.$data)
                .then((response) => {
                    this.$router.push({name: 'quotes.show', params: {id: response.data.data.id}});
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
