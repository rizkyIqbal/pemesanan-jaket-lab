<template>
    <AdminLayout>
        <p class="text-4xl mb-2">Pre Order Countdown</p>
        <div v-if="countdowns" v-for="countdown in countdowns.data">
            <div class="max-w-md">
                <div class="grid grid-cols-3 gap-3">
                    <p>Tanggal Mulai : </p>
                    <p>{{ countdown.started_at }}</p>
                </div>
            </div>
            <div class="max-w-md">
                <div class="grid grid-cols-3 gap-3">
                    <p>Tanggal Selesai : </p>
                    <p>{{ countdown.finish_at }}</p>
                </div>
            </div>
            <a class="text-sm text-red-500 underline-offset-1 underline" @click="deleteCountdown">
                Tutup Pre Order
            </a>
        </div>
        <p v-else>Data Countdown Kosong!</p>

        <div class="p-6 border-2 mt-6">
            <p class="text-xl mb-2">Create Pre Order Countdown</p>
            <form @submit.prevent="insert">
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900">Tanggal Mulai</label>
                    <input type="text"
                        class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        v-model="form.start" placeholder="13 Desember 2022" />
                </div>
                <div class="mb-4">
                    <label for="title" class="leading-7 text-sm text-gray-900">Tanggal Selesai</label>
                    <input type="text"
                        class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        v-model="form.end" placeholder="13 Desember 2022" />
                </div>

                <button class="flex items-center py-2 px-3 text-sm text-white bg-blue-500 rounded text-center"
                    type="submit">
                    Submit
                </button>
            </form>
        </div>
    </AdminLayout>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout";
import { Method } from "@inertiajs/inertia";
export default {
    props: {
        countdowns: Object
    },
    components: {
        AdminLayout,
    },
    data() {
        return {
            form: {
                start: "",
                end: "",
            },
        };
    },
    methods: {
        insert() {
            this.$inertia.post("/admin/countdown/tambah", this.form);
        },
        deleteCountdown() {
            this.$inertia.delete(this.route("admin.countdown.destroy"))
        }
    },
};
</script>
