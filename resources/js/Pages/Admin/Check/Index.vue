<template>
    <AdminLayout>
        <p class="text-2xl font-semibold">Transactions Admin</p>
        <div class="intro-y font-body flex justify-between items-center my-2">
            <Link
                :href="route('admin.transaction.create')"
                class="flex items-center py-2 px-3 text-xs text-white bg-blue-500 rounded text-center"
            >
                <span>Tambah</span>
            </Link>
        </div>
        <div class="h-full">
            <div
                class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden"
            >
                <div class="table-responsive">
                    <table
                        class="min-w-full divide-y divide-gray-300"
                        id="dataTable"
                        width="100%"
                        cellspacing="0"
                    >
                        <thead>
                            <tr>
                                <th
                                    class="px-3 py-3 text-left text-sm font-semibold text-gray-900"
                                >
                                    NIM
                                </th>
                                <th
                                    class="px-3 py-3 text-left text-sm font-semibold text-gray-900"
                                >
                                    Size
                                </th>
                                <th
                                    class="px-3 py-3 text-left text-sm font-semibold text-gray-900"
                                >
                                    Custom
                                </th>
                                <th
                                    class="px-3 py-3 text-left text-sm font-semibold text-gray-900"
                                >
                                    Price
                                </th>
                                <th
                                    class="px-3 py-3 text-left text-sm font-semibold text-gray-900"
                                >
                                    Status
                                </th>
                                <th
                                    class="px-3 py-3 text-left text-sm font-semibold text-gray-900"
                                >
                                    Action
                                </th>
                                <th
                                    class="px-3 py-3 text-left text-sm font-semibold text-gray-900"
                                ></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(
                                    transaction, index
                                ) in transactions.data"
                                :key="transaction"
                            >
                                {{
                                    index + 1
                                }}
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ transaction.user_id }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ transaction.size_id }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ transaction.custom }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ transaction.price }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ transaction.track.name }}
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <select
                                                v-model="form.track[index]"
                                                name="size"
                                                id="size"
                                                class="bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                            >
                                                <option value="" disabled>
                                                    Pilih Track Jaket
                                                </option>
                                                <!-- <option value=""></option> -->
                                                <option
                                                    v-for="track in tracks.slice(
                                                        transaction.track_id,
                                                        8
                                                    )"
                                                    :key="track.id"
                                                    :value="track.id"
                                                >
                                                    {{ track.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button
                                        @click.prevent="tes(transaction, index)"
                                    >
                                        <a class="btn btn-danger w-100">
                                            Apply</a
                                        >
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
import AdminLayout from "@/Layouts/AdminLayout";
export default {
    components: {
        Link,
        AdminLayout,
    },
    props: { transactions: Object, tracks: Object },
    data() {
        return {
            // _value : this.transactions.id
            form: {
                track: [],
            },
        };
    },
    // computed:{
    //     getParam() {
    //         return (key) => {
    //             return this[key] ? this[key] : ''
    //         }
    //     }
    // },
    methods: {
        tes(transaction, index) {
            // console.log(this.form.track[index])
            this.$inertia.put(
                route("admin.check.update", {
                    id: transaction.id,
                    index: index,
                }),
                this.form
            );
        },
        deletearticle(transaction) {
            if (
                confirm(
                    `data ingin di hapus? transaksi dari ${transaction.user}`
                )
            ) {
                this.$inertia.delete(
                    route("admin.transaction.destroy", { id: transaction.id })
                );
            } else {
                return false;
            }
        },
    },
};
</script>
