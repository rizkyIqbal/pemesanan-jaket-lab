<template>
    <AdminLayout>
        <p class="text-2xl font-semibold">Jaket Admin</p>
        <div class="intro-y font-body flex justify-between items-center my-2">
            <Link
                :href="route('admin.jacket.create')"
                class="flex items-center py-2 px-3 text-xs text-white bg-blue-500 rounded text-center"
            >
                <span>Tambah</span>
            </Link>
        </div>
        <div class="h-full">
            <div
                class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden"
            >
                <div class="nodata" v-if="jackets.data == null">
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
                                    Name
                                </th>
                                <th
                                    class="px-3 py-3 text-left text-sm font-semibold text-gray-900"
                                >
                                    Image
                                </th>
                                <th
                                    class="px-3 py-3 text-left text-sm font-semibold text-gray-900"
                                >
                                    Color
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
                                v-for="jacket in jackets.data"
                                :key="jacket.slug"
                            >
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ jacket.name }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ jacket.image }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ jacket.color }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ jacket.price }}
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a
                                                class="btn btn-primary w-100"
                                                :href="
                                                    route('admin.jacket.edit', {
                                                        id: jacket.id,
                                                    })
                                                "
                                                >Update</a
                                            >
                                        </div>
                                        <div class="col-sm-6">
                                            <a
                                                class="btn btn-danger w-100"
                                                @click.prevent="
                                                    deletearticle(jacket)
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
    props: { jackets: Object },
    methods: {
        deletearticle(jacket) {
            if (confirm(`data ingin di hapus? data ${jacket.name}`)) {
                this.$inertia.delete(
                    route("admin.jacket.destroy", { id: jacket.id })
                );
            } else {
                return false;
            }
        },
    },
};
</script>
