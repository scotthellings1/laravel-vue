<template>
<div>
    <modal :showing="showAddProductModal" @close="showAddProductModal = false">

    </modal>
    <div class="flex justify-center">
        <div class="mb-3 xl:w-96">
            <select class="form-select appearance-none
      block
      w-full
      px-3
      py-1.5
      text-base
      font-normal
      text-gray-700
      bg-white bg-clip-padding bg-no-repeat
      border border-solid border-gray-300
      rounded
      transition
      ease-in-out
      m-0
      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example"
             @change="addProduct($event)">
                <option selected>Open this select menu</option>
                <option v-for="(product, index)  in products"  :value="product.id">{{ product.name }}</option>
        </div>
    </div>
    <div class="mt-8 w-full bg-white py-4 px-3">Customer: {{ quote.customer_name }}<br>
        Email: {{ quote.customer_email }}<br>
        Quote Status: {{ status }}</div>
</div>
</template>

<script>
import Modal from "../../components/Modal";
export default {
    name: "QuotesShow",
    components: {Modal},

    data() {
        return {
            showAddProductModal: false,
            quote: {
                id: null,
                customer_name: '',
                customer_email: '',
                accepted: '',
                subtotal: 0,
                vat: 0,
                total: 0,
            },
            products: {},
            quoteProducts: {}
        }
    },
    created() {
        axios.get('/api/quotes/' + this.$route.params.id)
        .then((response) => {
            this.quote = response.data.data
        })

        axios.get('/api/products')
        .then((response) => {
            this.products = response.data.data
        })
    },
    computed: {
        status() {
            if (this.quote.accepted === '0') {
                return 'Pending'
            }
        }
    },
    methods: {
        addProduct(event) {

        }
    },
}
</script>

<style scoped>

</style>
