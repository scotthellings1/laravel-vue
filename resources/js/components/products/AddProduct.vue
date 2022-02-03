<template>
    <form @submit.prevent="onSubmit">
        <div class="form-group mb-6">
            <label class="form-label inline-block mb-2 text-gray-700" for="name">Product Name</label>
            <input id="name" v-model="name" aria-describedby="emailHelp" class="form-control
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
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="name"
                   placeholder="Product Name" type="text">
            <span v-if="errors.name" class="text-sm mt-1 text-red-400">{{ errors.name[0] }}</span>
        </div>
        <div class="form-group mb-6">
            <label class="form-label inline-block mb-2 text-gray-700" for="description">Description</label>
            <input id="description" v-model="description" class="form-control block
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
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="description" placeholder="Description"
                   type="text">
            <span v-if="errors.description" class="text-sm mt-1 text-red-400">{{ errors.description[0] }}</span>
        </div>
        <div class="form-group mb-6">
            <label class="form-label inline-block mb-2 text-gray-700" for="price">price</label>
            <input id="price" v-model="price" class="form-control block
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
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="price" placeholder="103.99"
                   type="text">
            <span v-if="errors.price " class="text-sm mt-1 text-red-400">{{ errors.price [0] }}</span>
        </div>

        <button class="
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
      ease-in-out" type="submit">Add Product
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
