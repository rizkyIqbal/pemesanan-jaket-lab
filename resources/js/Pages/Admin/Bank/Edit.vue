<template>
    <AdminLayout>
        <div class="p-6 border-2">
            <p class="text-xl mb-2">Edit Data Jacket</p>
            <form @submit.prevent="insert">
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900"
                        >Nama Bank</label
                    >
                    <input
                        type="text"
                        class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        v-model="form.bank"
                    />
                </div>
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900"
                        >Atas Nama</label
                    >
                    <input
                        type="text"
                        class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        v-model="form.name"
                    />
                </div>
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900"
                        >No Rekening</label
                    >
                    <input
                        type="text"
                        class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        v-model="form.account_number"
                    />
                </div>
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900"
                        >Angkatan</label
                    >
                    <input
                        type="text"
                        class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        v-model="form.generation"
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
    props: {
        bank: Object,
    },
    data() {
        return {
            form: {
                name: this.bank.name,
                bank: this.bank.bank,
                account_number: this.bank.account_number,
                generation: this.bank.generation,
            },
        };
    },
    methods: {
        insert() {
            this.$inertia.post(
                this.route("admin.bank.update", { id: this.bank.id }),
                this.form
            );
        },
    },
};
</script>
