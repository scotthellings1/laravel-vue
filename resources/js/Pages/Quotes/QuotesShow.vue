<template>
<div>
    <modal :showing="showAddProductModal" @close="showAddProductModal = false">

    </modal>
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
            products: {}
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
}
</script>

<style scoped>

</style>
