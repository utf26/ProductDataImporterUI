<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import {ref} from "vue";

defineProps({
    products: {
        type: Object,
    },
});

const selectedImage = ref(null);
const showModal = ref(false);

const parsedImages = (images) => JSON.parse(images);
const openImage = (image) => {
    selectedImage.value = image;
    showModal.value = true;
};
</script>

<template>
    <Head title="Products"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Products</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="product in products.data" :key="product.id"
                         class="bg-white shadow overflow-hidden rounded-lg">
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ product.title }}</h3>
                            <p class="mt-1 text-sm text-gray-500">{{ product.description }}</p>
                            <div class="mt-4">
                                <div class="flex flex-wrap">
                                    <div class="w-full sm:w-1/2 p-1">
                                        <strong>Price:</strong> ${{ product.price }}
                                    </div>
                                    <div class="w-full sm:w-1/2 p-1">
                                        <strong>Discount:</strong> {{ product.discountPercentage }}%
                                    </div>
                                    <div class="w-full sm:w-1/2 p-1">
                                        <strong>Rating:</strong> {{ product.rating }}
                                    </div>
                                    <div class="w-full sm:w-1/2 p-1">
                                        <strong>Stock:</strong> {{ product.stock }}
                                    </div>
                                    <div class="w-full sm:w-1/2 p-1">
                                        <strong>Brand:</strong> {{ product.brand }}
                                    </div>
                                    <div class="w-full sm:w-1/2 p-1">
                                        <strong>Category:</strong> {{ product.category }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 border-t border-gray-200">
                            <img :src="product.thumbnail" alt="Thumbnail"
                                 class="w-full h-48 object-cover rounded-md mb-2" @click="openImage(product.thumbnail)">
                            <div class="flex space-x-2 overflow-x-auto">
                                <img v-for="image in parsedImages(product.images)" :src="image" alt="Product Image"
                                     class="w-20 h-20 object-cover rounded-md cursor-pointer" :key="image"
                                     @click="openImage(image)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="flex justify-center my-8 space-x-4">
                <Link :href="products.prev_page_url" v-if="products.prev_page_url" class="px-4 py-2 border border-blue-500 rounded text-blue-500 hover:bg-blue-500 hover:text-white transition-colors duration-300">
                    Previous
                </Link>
                <Link :href="products.next_page_url" v-if="products.next_page_url" class="px-4 py-2 border border-blue-500 rounded text-blue-500 hover:bg-blue-500 hover:text-white transition-colors duration-300">
                    Next
                </Link>
            </div>
        </div>

        <!-- Image Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
             @click.self="showModal = false">
            <div class="relative top-20 mx-auto p-5 border w-3/4 shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <img :src="selectedImage" alt="Selected Image" class="w-auto max-h-96 mx-auto">
                    <button @click="showModal = false"
                            class="mt-3 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">Close
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
