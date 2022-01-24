<template>
    <div>
        <select class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat-->
                    border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600
                    focus:outline-none"
                aria-label="Default select example"
                @change="getProduct($event)">
            <option selected>Add a Product</option>
            <option v-for="(product, index)  in products" :value="product.id">{{ product.name }}</option>
        </select>
        <button @click="AddProductToQuote"
                class=" cursor-pointer mb-6 rounded-md px-2 py-2 text-white bg-green-700 hover:bg-green-600">Add
            Quote</button>
    </div>
</template>

<script>
export default {
    name: "AddProduct",
    data() {
        return {
            products: {},
            product: {}
        }
    },
    created() {
        axios.get('/api/products')
            .then((response) => {
                this.products = response.data.data
            })
    },
    methods: {
        getProduct(event) {
            axios.get('/api/products/' + event.target.value)
            .then((response) => {
                this.product = response.data.data
            })
        },
        AddProductToQuote() {
            this.$emit('onProductAddedToQuote', this.product)
        }
    },
}
</script>

<style scoped>

</style>
