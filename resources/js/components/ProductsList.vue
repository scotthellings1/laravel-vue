<template>
    <div>
        <modal :showing="CreateProductsModalShow" @close="CreateProductsModalShow = false">
            <div>
                <add-product @onAddProduct="handleAddProduct"></add-product>
            </div>
        </modal>
        <table class="w-full">
            <thead>
            <tr>
                <th
                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                    Product
                </th>
                <th
                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                    description
                </th>
                <th
                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                    price
                </th>


                <th
                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                    Edit
                </th>
                <th
                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                    Delete
                </th>
            </tr>
            </thead>
            <tbody class="bg-white" v-for="(product, index) in products" >
            <Product :product="product" :key="index" @onProductDeleted="handleProductDeleted(index)"  />
            </tbody>
        </table>
    </div>

</template>

<script>
import Product from "./Product";
import Modal from "./Modal";
import AddProduct from "./AddProduct";
export default {
    components: {Product, Modal, AddProduct},
    name: "ProductsList",
    data() {
        return {
            CreateProductsModalShow: false,
            products: {},
        }
    },
    created() {
        this.getProducts()
    },
    methods: {
        getProducts(){
            axios.get('/api/products')
                .then(response => {
                    this.products = response.data.data
                })
        },
        handleAddProduct() {
            this.CreateProductsModalShow = false
            this.getProducts()
        },

        handleProductDeleted(index) {
            this.products.splice(index, 1)
        }
    }
}
</script>

<style scoped>

</style>
