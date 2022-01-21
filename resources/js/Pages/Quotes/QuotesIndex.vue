<template>
    <div class="mt-8">
        <h1 class="text-2xl text-center">Quotes</h1>
        <quotes-list></quotes-list>
    </div>
</template>

<script>
import QuotesList from "../../components/quotes/QuotesList";
export default {
    name: "QuotesIndex",
    components: {QuotesList}
}
</script>

<style scoped>

</style>
