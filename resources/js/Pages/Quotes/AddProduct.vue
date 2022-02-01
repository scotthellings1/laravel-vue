<template>
    <div>
        <v-select label="name" :options="products"  @input="getProduct"></v-select>
<!--        <input list="products"-->
<!--            class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat&ndash;&gt;-->
<!--                    border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600-->
<!--                    focus:outline-none"-->
<!--                aria-label="Default select example"-->
<!--                @change="getProduct($event)">-->
<!--            <option selected disabled>select a Product</option>-->
<!--        <datalist id="products">-->
<!--            <option v-for="(product, index)  in products" data-product="{product.id}" :value="product.id">{{-->
<!--                    product.name }}</option>-->
<!--        </datalist>-->

        <button @click="AddProductToQuote"
                class=" cursor-pointer mt-6 rounded-md px-2 py-2 text-white bg-green-700 hover:bg-green-600">Add
            Quote</button>
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

<style >

.vs__search {
    border: none;

}
.vs__search, [type='search']:focus{
    --tw-ring-color: transparent;
    outline: none;
    border-color: transparent;
}
</style>
