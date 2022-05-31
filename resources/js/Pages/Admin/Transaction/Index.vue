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
                <div class="nodata" v-if="transactions.data == null">
                    <h1>NO DATA!</h1>
                </div>
                <div v-else class="table-responsive">
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
                                    User
                                </th>
                                <th
                                    class="px-3 py-3 text-left text-sm font-semibold text-gray-900"
                                >
                                    Jaket
                                </th>
                                <th
                                    class="px-3 py-3 text-left text-sm font-semibold text-gray-900"
                                >
                                    Size
                                </th>
                                <th
                                    class="px-3 py-3 text-left text-sm font-semibold text-gray-900"
                                >
                                    Order Type
                                </th>
                                <th
                                    class="px-3 py-3 text-left text-sm font-semibold text-gray-900"
                                >
                                    Price
                                </th>
                                <th
                                    class="px-3 py-3 text-left text-sm font-semibold text-gray-900"
                                >
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="transaction in transactions.data"
                                :key="transaction.slug"
                            >
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ transaction.user_id }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ transaction.jacket_id }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ transaction.size_id }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ transaction.order_type }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ transaction.price }}
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a
                                                class="btn btn-primary w-100"
                                                :href="
                                                    route(
                                                        'admin.transaction.edit',
                                                        {
                                                            id: transaction.id,
                                                        }
                                                    )
                                                "
                                                >Update</a
                                            >
                                        </div>
                                        <div class="col-sm-6">
                                            <a
                                                class="btn btn-danger w-100"
                                                @click.prevent="
                                                    deletearticle(
                                                        `${transaction.id}`
                                                    )
                                                "
                                            >
                                                Delete</a
                                            >
                                        </div>
                                    </div>
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
    props: { transactions: Object },
    methods: {
        deletearticle(id) {
            if (confirm("data ingin di hapus?")) {
                this.$inertia.delete(
                    route("admin.transaction.destroy", { slug: slug })
                );
            } else {
                return false;
            }
        },
    },
};
</script>
