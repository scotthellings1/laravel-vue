<template>
    <fragment>
        <tr v-show="!isEditing">
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="ml-4">
                    <div class="capitalize text-sm font-medium leading-5 text-gray-900">
                        {{ product.name }}
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="capitalize text-sm leading-5 text-gray-500">
                    {{ product.description }}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-500">
                    £{{ product.price.toFixed(2) }}
                </div>
            </td>
            <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                <svg class=" cursor-pointer w-6 h-6 text-blue-400" fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg" @click="isEditing = ! isEditing">
                    <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"/>
                </svg>
                <div v-show="isEditing" class="flex space-x-2 items-center " @click="isEditing = ! isEditing">
                    <span class=" cursor-pointer  rounded-md px-2 py-2 text-white bg-blue-400"
                          @click="updateProduct">SAVE</span>
                </div>
            </td>
            <td
                class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">

                <svg v-show="!isDeleting" class="w-6 h-6 text-red-400" fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg" @click="isDeleting = ! isDeleting ">
                    <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"/>
                </svg>
                <div v-show="isDeleting" class="flex space-x-2 items-center w-6 ">
                    <a class=" cursor-pointer rounded-md px-2 py-2 text-white bg-red-400"
                       @click="deleteProduct">DELETE</a>
                    <a class=" cursor-pointer rounded-md px-2 py-2 text-white bg-gray-400"
                       @click="closeDelete">CANCEL</a>
                </div>
            </td>
        </tr>

        <tr v-show="isEditing">
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="ml-4">
                    <div class="text-sm font-medium leading-5 text-gray-900">
                        <input v-model="product.name"

                               autofocus
                               class="bg-gray-100 p-2 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               name="name"
                               type="text"
                               @blur="() => { if (product.name === '') {
                           $swal({
                              toast: false,
                              position: 'top-end',
                              showConfirmButton: false,
                              timer: 3000,
                              icon: 'error',
                              text: 'Name is required',
                           })
                       }}">
                    </div>
                </div>
            </td>

            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-500">
                    <input v-model="product.description"
                           class="bg-gray-100 p-2 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           name="description"
                           type="text"

                           @blur="() => { if (product.description === '') {
                           $swal({
                              toast: false,
                              position: 'top-end',
                              showConfirmButton: false,
                              timer: 3000,
                              icon: 'error',
                              text: 'Description is required',
                           })
                       }}">
                </div>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-500">
                    <input v-model.number="product.price"
                           class="bg-gray-100 p-2 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           min="0.01"
                           name="price"
                           step="0.01"
                           type="number"
                           @blur="() => { if (product.price < 0.01 ) {
                               product.price = 0.01
                           $swal({
                              toast: false,
                              position: 'top-end',
                              showConfirmButton: false,
                              timer: 3000,
                              icon: 'error',
                              text: 'Price can not be less than £0.01 please update!',
                           })
                       }}">

                </div>
            </td>
            <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                <svg v-show="!isEditing" class=" cursor-pointer w-6 h-6 text-blue-400" fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg" @click="isEditing = ! isEditing">
                    <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"/>
                </svg>
                <div v-show="isEditing" class="flex space-x-2 items-center " @click="isEditing = ! isEditing">
                    <button :disabled="disabled" class=" cursor-pointer  rounded-md px-2 py-2 text-white bg-blue-400 disabled:bg-gray-400"
                            @click="updateProduct">
                        SAVE
                    </button>
                </div>
            </td>
            <td
                class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">

                <svg v-show="!isDeleting" class="w-6 h-6 text-red-400" fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg" @click="isDeleting = ! isDeleting ">
                    <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"/>
                </svg>
                <div v-show="isDeleting" class="flex space-x-2 items-center w-6 ">
                    <a class=" cursor-pointer rounded-md px-2 py-2 text-white bg-red-400"
                       @click="deleteProduct">DELETE</a>
                    <a class=" cursor-pointer rounded-md px-2 py-2 text-white bg-gray-400"
                       @click="closeDelete">CANCEL</a>
                </div>
            </td>
        </tr>

    </fragment>


</template>
<script>
import {Fragment} from 'vue-fragment'

export default {
    props: ['product'],
    components: {
        Fragment,
    },
    data() {
        return {
            errors: {},
            isEditing: false,
            isDeleting: false
        }
    },
    computed: {
        disabled() {
            if (this.product.name === '' || this.product.description === '') {
                return true
            }
        },
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


                })
                .catch((error) => {
                    this.isEditing = true
                    this.errors = error.response.data.errors
                })
                .finally(this.closeEdit)

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
