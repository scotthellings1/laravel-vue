<template>
    <div>
        <v-select :options="products" label="name" @input="getProduct"></v-select>
        <button class=" cursor-pointer mt-6 rounded-md px-2 py-2 text-white bg-green-700 hover:bg-green-600"
                @click="AddProductToQuote">Add
            Product to Quote
        </button>
    </div>
</template>

<script>
import vSelect from 'vue-select'

export default {
    name: "AddProduct",
    components: {
        vSelect,
    },
    data() {
        return {
            products: [],
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
        getProduct(product) {
            axios.get('/api/products/' + product.id)
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

<style>

.vs__search {
    border: none;

}

.vs__search, [type='search']:focus {
    --tw-ring-color: transparent;
    outline: none;
    border-color: transparent;
}
</style>
