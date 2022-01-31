<template>
    <tr>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            <div class="ml-4">
                <div v-show="!isEditing" class="text-sm font-medium leading-5 text-gray-900">
                    {{ product.name }}

                </div>
                <div v-show="isEditing" class="text-sm font-medium leading-5 text-gray-900">
                    <input type="text"
                           name="name"
                           v-model="product.name"
                           autofocus
                           class="bg-gray-100 p-2 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>


            </div>
        </td>

        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            <div v-show="!isEditing" class="text-sm leading-5 text-gray-500">
                {{ product.description }}
            </div>
            <div v-show="isEditing" class="text-sm leading-5 text-gray-500">
                <input type="text"
                       v-model="product.description"
                       name="description"
                       class="bg-gray-100 p-2 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
        </td>

        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            <div v-show="!isEditing" class="text-sm leading-5 text-gray-500">
                £{{ product.price.toFixed(2) }}
            </div>
            <div v-show="isEditing" class="text-sm leading-5 text-gray-500">
                <input type="text"
                       v-model.number="product.price"
                       name="price"
                       class="bg-gray-100 p-2 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

            </div>
        </td>


        <td
            class="  px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">

            <svg v-show="!isEditing" @click="isEditing = ! isEditing" xmlns="http://www.w3.org/2000/svg"
                 class=" cursor-pointer w-6 h-6 text-blue-400"
                 fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            <div class="flex space-x-2 items-center " v-show="isEditing" @click="isEditing = ! isEditing">
                <span @click="updateProduct"
                      class=" cursor-pointer  rounded-md px-2 py-2 text-white bg-blue-400">SAVE</span>
            </div>
        </td>
        <td
            class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">

            <svg v-show="!isDeleting" @click="isDeleting = ! isDeleting " xmlns="http://www.w3.org/2000/svg"
                 class="w-6 h-6 text-red-400"
                 fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            <div class="flex space-x-2 items-center w-6 " v-show="isDeleting" >
                <a @click="deleteProduct"
                   class=" cursor-pointer rounded-md px-2 py-2 text-white bg-red-400">DELETE</a>
                <a @click="closeDelete"
                   class=" cursor-pointer rounded-md px-2 py-2 text-white bg-gray-400">CANCEL</a>
            </div>


        </td>
    </tr>

</template>
<script>
export default {
    props: ['product'],
    data() {
        return {
            isEditing: false,
            isDeleting: false
        }
    },

    methods: {
        updateProduct() {
            axios.put('/api/products/' + this.product.id,
                {
                    name: this.product.name,
                    description: this.product.description,
                    price: this.product.price
                })
                .then((response) => {
                    console.log(
                        response.data.message
                    )
                    this.$swal({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        text: response.data.message,
                    })
                    this.closeEdit

                })

        },
        closeEdit() {
            this.isEditing = false
        },
        closeDelete() {
            this.isDeleting = false
        },
        deleteProduct() {
            axios.delete('/api/products/' + this.product.id)
                .then((response) => {
                    this.closeDelete()
                    this.$swal({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        icon: 'success',
                        text: response.data.message,
                    })
                    this.$emit('onProductDeleted')
                })
            .catch(error => console.log(error.data))
        }
    }

}
</script>
