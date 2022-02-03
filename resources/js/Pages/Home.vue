<template>
    <div class="mt-8">
        <h1 class="text-2xl text-center">Quote Builder</h1>

        <div class="bg-white mx-auto mt-11 p-11 max-w-4xl flex flex-col justify-center space-y-5 rounded shadow-2xl">
            <p class="text-lg">This is a basic quote builder built with Laravel and Vue JS</p>
            <p class="text-lg">Laravel is being used as an API to store and retrieve the data</p>
            <p class="text-lg">Vue JS is being used to create a single page application (SPA), a site that has
                multiple pages but no actual refresh of the browser window</p>
            <p class="text-lg">The main functions of the app are:</p>
            <ul class="list-disc ml-4 ">
                <li class="first-letter:uppercase">ability to create products</li>
                <li class="first-letter:uppercase">ability to create and edit a quote</li>
                <li class="first-letter:uppercase">ability to assign and remove products on a quote</li>
                <li class="first-letter:uppercase">ability to increase and decrease line item quantity</li>
                <li class="first-letter:uppercase">sub-total, vat total and total to automatically update on the quote when
                    adding/removing/editing
                    line items</li>
                <li class="first-letter:uppercase">ability to send a quote to the customer</li>
                <li class="first-letter:uppercase">cron that runs at the end of the day to give an overview of the quotes created that day with
                    totals via email</li>
            </ul>

        </div>
    </div>

</template>
