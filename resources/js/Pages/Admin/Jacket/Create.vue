<template>
    <AdminLayout>
        <div class="p-6 border-2">
            <p class="text-xl mb-2">Create Jacket</p>
            <form @submit.prevent="insert">
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900"
                        >Nama Jaket</label
                    >
                    <input
                        type="text"
                        class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        v-model="form.name"
                    />
                </div>
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900"
                        >Foto Size Chart</label
                    >
                    <input type="file" @change="uploadSizeChart" />
                </div> 
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900"
                        >Foto Jaket Depan</label
                    >
                    <input type="file" @change="uploadJacketFront" />
                </div>
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900"
                        >Foto Jaket Belakang</label
                    >
                    <input type="file" @change="uploadJacketBack" />
                </div>
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900"
                        >Harga Jaket</label
                    >
                    <input
                        type="text"
                        class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        v-model="form.price"
                    />
                </div>
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900"
                        >Harga Tambahan</label
                    >
                    <input
                        type="text"
                        class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        v-model="form.custom_price"
                    />
                </div>
                <button
                    class="flex items-center py-2 px-3 text-sm text-white bg-blue-500 rounded text-center"
                    type="submit"
                >
                    Submit
                </button>
            </form>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout";
export default {
    components: {
        AdminLayout,
    },
    data() {
        return {
            form: {
                name: "",
                image: "",
                image2: "",
                image_size_chart: "",
                price: "",
                custom_price: "",
            },
        };
    },
    methods: {
        insert() {
            this.$inertia.post("/admin/jaket/tambah", this.form);
        },
        uploadSizeChart(e) {
            this.form.image = e.target.files[0];
        },
        uploadJacketFront(e) {
            this.form.image2 = e.target.files[0];
        },
        uploadJacketBack(e) {
            this.form.image_size_chart = e.target.files[0];
        },
    },
};
</script>
