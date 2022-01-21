<template>
    <div>
        <modal :showing="CreateQuoteModalShow" @close="CreateQuoteModalShow = false">
            <div class="overflow-y-auto">
                <add-quote @onAddQuote="handleAddQuote"></add-quote>
            </div>
        </modal>
        <button @click="CreateQuoteModalShow = true"
                class=" cursor-pointer mb-6 rounded-md px-2 py-2 text-white bg-green-700 hover:bg-green-600">Add
            Quote</button>

    <table class="w-full">
        <thead>
        <tr>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                Quote number
            </th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                Customer Name
            </th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                Customer Email
            </th>


            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                invoice total
            </th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                status
            </th>
            <th
                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                view
            </th>
        </tr>
        </thead>
        <tbody class="bg-white" v-for="(quote, index) in quotes" >
            <quote :quote="quote" :key="index"></quote>
        </tbody>
    </table>
    </div>

</template>

<script>
import Modal from "../Modal";
import AddQuote from "./AddQuote";
import Quote from "./Quote";

export default {
    name: "QuotesList",
    components: {Modal, AddQuote, Quote},
    data() {
        return {
            CreateQuoteModalShow: false,
            quotes: {}
        }
    },
    created() {
        this.getQuotes()
    },
    methods: {
        handleAddQuote() {
            this.CreateQuoteModalShow = false
        },
        getQuotes(){
            axios.get('/api/quotes')
                .then(response => {
                    this.quotes = response.data.data
                })
        }
    },

}
</script>

<style scoped>

</style>
