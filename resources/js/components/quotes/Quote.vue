<template>
    <tr>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            <div class="text-sm text-red-400 font-medium leading-5 text-gray-900">
                {{ quote.id }}
            </div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            <div class="text-sm capitalize font-medium leading-5 text-gray-900">
                {{ quote.customer_name }}
            </div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            <div class="text-sm font-medium leading-5 text-gray-900">
                {{ quote.customer_email }}
            </div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            <div class="text-sm font-medium leading-5 text-gray-900">
                £{{ quote.total.toFixed(2) }}
            </div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            <div :class="quote.status === 'pending' ?
                'text-blue-400' : quote.status === 'accepted' ? 'text-green-500' : 'text-red-400'  " class="capitalize font-medium leading-5 ">
                {{ quote.status }}
            </div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            <router-link :to="{name: 'quotes.show', params: {id:quote.id}}">
                <svg class="w-6 h-6 text-green-400" fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"/>
                    <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"/>
                </svg>
            </router-link>
        </td>
    </tr>
</template>

<script>
export default {
    name: "Quote",
    props: ['quote'],
}
</script>
