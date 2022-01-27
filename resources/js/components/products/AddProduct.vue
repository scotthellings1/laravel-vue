<template>
    <form  @submit.prevent="onSubmit">
        <div class="form-group mb-6">
            <label for="name" class="form-label inline-block mb-2 text-gray-700">Product Name</label>
            <input type="text" name="name" v-model="name" class="form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="name"
                   aria-describedby="emailHelp" placeholder="Product Name">
            <span class="text-sm mt-1 text-red-400" v-if="errors.name">{{errors.name[0]}}</span>
        </div>
        <div class="form-group mb-6">
            <label for="description" class="form-label inline-block mb-2 text-gray-700">Description</label>
            <input type="text" name="description" v-model="description"  class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="description"
                   placeholder="Description">
            <span class="text-sm mt-1 text-red-400" v-if="errors.description">{{errors.description[0]}}</span>
        </div>
        <div class="form-group mb-6">
            <label for="price" class="form-label inline-block mb-2 text-gray-700">price</label>
            <input type="text" name="price" v-model="price"  class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="price"
                   placeholder="103.99">
            <span class="text-sm mt-1 text-red-400" v-if="errors.price ">{{errors.price [0]}}</span>
        </div>

        <button type="submit" class="
      w-full
      px-6
      py-2.5
      bg-blue-600
      text-white
      font-medium
      text-xs
      leading-tight
      uppercase
      rounded
      shadow-md
      hover:bg-blue-700 hover:shadow-lg
      focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
      active:bg-blue-800 active:shadow-lg
      transition
      duration-150
      ease-in-out">Add Product
        </button>
    </form>
</template>

<script>
export default {
    name: "AddProduct",
    data() {
        return {
            name: '',
            description: '',
            price: '',
            errors: {}
        }
    },
    methods: {
        onSubmit() {
            axios.post('/api/products', this.$data)
            .then(response => this.$emit('onAddProduct'))
            .catch(error => this.errors = error.response.data.errors)
        }
    }
}
</script>

<style scoped>

</style>
