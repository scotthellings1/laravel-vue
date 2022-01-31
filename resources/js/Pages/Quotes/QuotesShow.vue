<template>
    <div class="">

        <modal :showing="showAddProductModal" @close="showAddProductModal = false">
            <add-product @onProductAddedToQuote="handleAddProductToQuote"></add-product>
        </modal>
        <modal :showing="showEditQuoteModal" @close="showEditQuoteModal = false">
            <edit-quote @onEditQuote="handleEditQuote" :quote="quote" :disabled="disabled"></edit-quote>
        </modal>
        <div class="flex justify-between mt-8">
            <button @click="showEditQuoteModal = true"
                    class="px-2 py-2 mt-8 h-12 text-white bg-green-700 rounded-md cursor-pointer hover:bg-green-600"
            >
                Edit Quote Details
            </button>
            <button @click="sendQuoteEmail" :disabled="disabled"
                    class="px-2 py-2 mt-8 h-12 text-white bg-blue-700 rounded-md cursor-pointer hover:bg-blue-600 disabled:bg-gray-400"
            >
                Send Quote
            </button>
        </div>
        <div class="flex px-8 py-4 mt-4 bg-white">
            <div class="flex flex-col items-end space-y-2 font-bold">
                <div>Customer:</div>
                <div>Email:</div>
                <div>Quote Status:</div>
            </div>
            <div class="flex flex-col ml-2 space-y-2">
                <div>{{ quote.customer_name }}</div>
                <div>{{ quote.customer_email }}</div>
                <div>{{ quote.status }}</div>
            </div>
        </div>
        <div class="mt-8">
            <div v-show="quoteProducts.length > 0"
                 class="flex items-center px-3 pt-4 pb-2 space-x-4 w-full font-bold">
                <div class="mr-4 w-1/5">
                    Product
                </div>
                <div class="mr-4 w-1/5">
                    Unit Price
                </div>
                <div class="mr-4 w-1/5">
                    Qty
                </div>
                <div class="mr-4 w-2/5">
                    Subtotal
                </div>

            </div>
            <div class="flex justify-between items-center px-3 py-4 mt-2 w-full bg-white" v-for="(product, index) in
            quoteProducts">
                <div class="flex items-center space-x-4 w-full">
                    <div class="mr-4 w-1/5">
                         {{ product.name }}
                    </div>
                    <div class="mr-4 w-1/5">
                         £{{ product.price.toFixed(2) }}
                    </div>
                    <div class="mr-4 w-1/5">
                        <input type="number" min="1" v-model.number="product.qty"
                               @blur="updateQuoteProductQty(product)"
                               class=" inline  px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding
        border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white
         focus:border-blue-600 focus:outline-none">
                    </div>
                    <div class="mr-4 w-1/5">
                        £{{ productLineTotal(product.price, product.qty).toFixed(2) }}
                    </div>
                    <div class="mr-4 w-1/5">
                        <svg @click="removeQuoteProduct(index, product)" xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6 text-red-400 cursor-pointer"
                             fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>
                </div>



            </div>
        </div>
        <div class="flex justify-between w-full">
            <div class="h-12">
                <button @click="showAddProductModal = true"
                        class="px-2 py-2 my-4 h-12 text-white bg-green-700 rounded-md cursor-pointer hover:bg-green-600"
                        :disabled="disabled">
                    Add Product To Quote
                </button>
            </div>
            <div class="flex justify-center items-end px-8 py-4 mt-2 bg-white">
                <div class="flex flex-col items-end font-bold">
                    <div>Subtotal:</div>
                    <div>Vat:</div>
                    <div>Total:</div>
                </div>
                <div class="flex flex-col items-end ml-2">
                    <div>£{{ subtotal.toFixed(2) }}</div>
                    <div>£{{ vat.toFixed(2) }}</div>
                    <div>£{{ quoteTotal.toFixed(2) }}</div>
                </div>

            </div>

        </div>

    </div>
</template>

<script>
import Modal from "../../components/Modal";
import AddProduct from "./AddProduct";
import EditQuote from "../../components/quotes/EditQuote";
import _ from "lodash"

export default {
    name: "QuotesShow",
    components: {Modal, AddProduct, EditQuote},
    data() {
        return {
            showAddProductModal: false,
            showEditQuoteModal: false,
            quote: {
                total: this.quoteTotal,
            },
            quoteProducts: []
        }
    },
    created() {
        this.getQuoteProducts()
        this.getQuoteDetails()
    },
    watch: {
        'quote.total': _.debounce(function () {
            this.updateQuoteTotal()
        }, 500)
    },
    computed: {
        disabled() {
          if (this.quote.status === 'accepted' || this.quote.status === 'sent') {
              return true
          }
        },
        quoteTotal() {
            let total = 0
            this.quoteProducts.forEach(product => {
                total += product.price * product.qty
            })
            this.quote.total = total.toFixed(2)
            return total
        },
        subtotal() {
            let subtotal = 0
            subtotal = this.quoteTotal - this.vat
            this.quote.subtotal = subtotal.toFixed(2)
            return subtotal

        },
        vat() {
            let vatRate = 1.20
            let vat = 0
            let totalLessVat = this.quoteTotal / vatRate
            vat = this.quoteTotal - totalLessVat
            this.quote.vat = vat.toFixed(2)
            return vat
        }
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
        removeQuoteProduct(index, product) {
            axios.delete('/api/quotes/' + this.$route.params.id + '/products/' + product.id)
                .then(this.quoteProducts.splice(index, 1))
        },
        updateQuoteProductQty(product) {
            axios.put('/api/quotes/' + this.$route.params.id + '/products/' + product.id, {
                qty: Math.abs(product.qty)
            })
        },
        handleAddProductToQuote(product) {
            this.showAddProductModal = false
            if (this.quoteProducts.filter(quoteProduct => quoteProduct.id === product.id).length > 0) {
                this.$swal({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    icon: 'warning',
                    text: 'Product already Addded!',
                })
            } else {
                axios.post('/api/quotes/' + this.$route.params.id + '/products', {
                    'product_id': product.id
                })
                    .then(this.getQuoteProducts)
            }
        },
        productLineTotal(price, qty) {
            return price * qty
        },
        updateQuoteTotal() {
            axios.put('/api/quotes/' + this.$route.params.id, {
                'customer_email' : this.quote.customer_email,
                'customer_name': this.quote.customer_name,
                'total': this.quote.total
            })
        },
        handleEditQuote() {
            this.showEditQuoteModal = false
        },
        sendQuoteEmail(){
            axios.get('/api/quotes/send/' + this.$route.params.id)
            .then(
                this.$swal({
                    toast: false,
                    showConfirmButton: false,
                    timer: 3000,
                    icon: 'success',
                    text: 'Quote Sent!',
                })

            )
            axios.put('/api/quotes/' + this.$route.params.id, {
                'customer_email' : this.quote.customer_email,
                'customer_name': this.quote.customer_name,
                'status': 'sent'
            })
            .then(
                this.getQuoteDetails
            )
        }
    },

}
</script>
