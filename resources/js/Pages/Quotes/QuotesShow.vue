<template>
    <div>

        <modal :showing="showAddProductModal" @close="showAddProductModal = false">
            <add-product @onProductAddedToQuote="handleAddProductToQuote"></add-product>
        </modal>
        <div class="mt-8 w-full bg-white py-4 px-3">Customer: {{ quote.customer_name }}<br>
            Email: {{ quote.customer_email }}<br>
            Quote Status: {{ status }}
        </div>
        <div class="mt-8">
            <div class="mt-2 flex justify-between items-center w-full bg-white py-4 px-3" v-for="(product, index) in
            quoteProducts">
                <div class="flex w-full space-x-4 items-center">
                    <div class="mr-4">
                        Product: {{ product.name }}
                    </div>
                    <div class="mr-4">
                        Price: £{{ product.price.toFixed(2) }}
                    </div>
                    <div class="mr-4">
                        Qty:
                        <input type="number" min="1" v-model.number="product.qty"
                               @blur="updateQuoteProductQty(product, index)"
                               class=" inline  px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding
        border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white
         focus:border-blue-600 focus:outline-none">
                    </div>
                    <div class="mr-4">
                        £{{ productLineTotal(product.price, product.qty).toFixed(2) }}
                    </div>
                </div>

                    <svg @click="removeQuoteProduct(index, product)" xmlns="http://www.w3.org/2000/svg"
                         class="w-6 h-6 text-red-400 cursor-pointer"
                         fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>

            </div>
        </div>
        <button @click="showAddProductModal = true"
                class=" cursor-pointer my-4 rounded-md px-2 py-2 text-white bg-green-700 hover:bg-green-600">
            Add Product To Quote
        </button>
    </div>
</template>

<script>
import Modal from "../../components/Modal";
import AddProduct from "./AddProduct";

export default {
    name: "QuotesShow",
    components: {Modal, AddProduct},
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
            quoteProducts: []
        }
    },
    mounted() {
        this.getQuoteDetails()
        this.getQuoteProducts()
        this.getAllProducts()
    },
    computed: {
        status() {
            if (this.quote.accepted === 0) {
                return 'Pending'
            }
        },
    },
    methods: {
        getQuoteDetails() {
            axios.get('/api/quotes/' + this.$route.params.id)
                .then((response) => {
                    this.quote = response.data.data
                })
        },
        getQuoteProducts() {
            axios.get('/api/quotes/' + this.$route.params.id + '/products')
                .then((response) => {
                    this.quoteProducts = response.data.data
                })
        },
        getAllProducts() {
            axios.get('/api/products')
                .then((response) => {
                    this.products = response.data.data
                })
        },
        removeQuoteProduct(index, product) {
            axios.delete('/api/quotes/' + this.$route.params.id + '/products/' + product.id)
            .then(this.quoteProducts.splice(index, 1))
        },
        updateQuoteProductQty(product,){
                axios.put('/api/quotes/' + this.$route.params.id + '/products/' + product.id, {
                    qty: Math.abs(product.qty)
                })

        },
        handleAddProductToQuote(product) {
            this.showAddProductModal = false
            if (this.quoteProducts.filter(quoteProduct => quoteProduct.id === product.id).length > 0) {
                console.log('already added')
                // TODO add alert to user that product is already on the quotee
            } else {
                axios.post('/api/quotes/' + this.$route.params.id + '/products', {
                    'product_id': product.id
                })
                .then(this.getQuoteProducts)
            }
        },
        productLineTotal(price, qty) {
            return price * qty
        }
    }
}
</script>
