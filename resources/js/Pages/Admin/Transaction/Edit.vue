<template>
    <AdminLayout>
        <div class="p-6 border-2">
            <p class="text-xl mb-2">Edit Transaction</p>
            <form @submit.prevent="insert">
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900"
                        >User ID</label
                    >
                    <input
                        type="text"
                        class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        v-model="form.user_id"
                    />
                </div>
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900"
                        >Jacket ID</label
                    >
                    <input
                        type="text"
                        class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        v-model="form.jacket_id"
                    />
                </div>
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900"
                        >Size ID</label
                    >
                    <input
                        type="text"
                        class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        v-model="form.size_id"
                    />
                </div>
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900"
                        >Custom</label
                    >
                    <input
                        type="text"
                        class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        v-model="form.custom"
                    />
                </div>
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900"
                        >Price</label
                    >
                    <input
                        type="text"
                        class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        v-model="form.price"
                    />
                </div>
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900"
                        >Approval</label
                    >
                    <select
                        v-model="form.approve"
                        name="size"
                        id="size"
                        class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                    >
                        <option value="" disabled>Pilih Satu</option>
                        <option :value="0" selected>Not Approved</option>
                        <option :value="1">Approve Data</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900"
                        >Proof</label
                    >
                    <input type="file" @change="upload" />
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
    props: {
        transaction: Object,
    },
    data() {
        return {
            form: {
                user_id: this.transaction.user_id,
                jacket_id: this.transaction.jacket_id,
                size_id: this.transaction.size_id,
                custom: this.transaction.custom,
                price: this.transaction.price,
                proof: "",
                approve: "",
                is_paid: this.transaction.is_paid,
                _method: "put",
            },
        };
    },
    methods: {
        insert() {
            this.$inertia.post(
                this.route("admin.transaction.update", {
                    id: this.transaction.id,
                }),
                this.form
            );
        },
        upload(e) {
            this.form.proof = e.target.files[0];
        },
    },
};
</script>
