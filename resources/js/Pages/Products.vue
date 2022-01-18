<template>
    <div class="mt-8">
        <modal :showing="CreateProductsModalShow" @close="CreateProductsModalShow = false">
            <div>
                <add-product @productAdded="CreateProductsModalShow = false"></add-product>
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

            <tbody class="bg-white" v-for="(product, index) in products" @deleted="remove(index)">
                <Product :items="product"  />
            </tbody>
        </table>
    </div>
</template>
<script>
import Product from "../components/Product";
import  Modal from "../components/Modal"
import AddProduct from "../components/AddProduct";


export default {
    components: {AddProduct, Product, Modal},
    data() {
        return {
            products: this.data,
            CreateProductsModalShow: false

        }
    },
    created() {
       this.getProducts()
    },
    methods: {
        getProducts(){
            axios.get('http://localhost:8000/api/products')
                .then(response => {
                    this.products = response.data.data
                })
        },
       remove(index) {
           this.products.splice(index,  1)

       }
    }
}
</script>
