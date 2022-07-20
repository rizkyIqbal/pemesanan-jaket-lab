<template>
    <AdminLayout>
        <p class="text-2xl font-semibold">Ukuran Admin</p>
        <div class="intro-y font-body flex justify-between items-center my-2">
            <Link
                :href="route('admin.size.create')"
                class="flex items-center py-2 px-3 text-xs text-white bg-blue-500 rounded text-center"
            >
                <span>Tambah</span>
            </Link>
        </div>
        <div class="h-full">
            <div
                class="border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden"
            >
                <div class="nodata" v-if="sizes.data == null">
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
                                    A
                                </th>
                                <th
                                    class="px-3 py-3 text-left text-sm font-semibold text-gray-900"
                                >
                                    B
                                </th>
                                <th
                                    class="px-3 py-3 text-left text-sm font-semibold text-gray-900"
                                >
                                    C
                                </th>
                                <th
                                    class="px-3 py-3 text-left text-sm font-semibold text-gray-900"
                                >
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="size in sizes.data" :key="size.slug">
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ size.name }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ size.a }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ size.b }}
                                </td>
                                <td
                                    class="whitespace-nowrap py-2 px-3 text-sm font-medium text-gray-900"
                                >
                                    {{ size.c }}
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a
                                                class="btn btn-primary w-100"
                                                :href="
                                                    route('admin.size.edit', {
                                                        id: size.id,
                                                    })
                                                "
                                                >Update</a
                                            >
                                        </div>
                                        <div class="col-sm-6">
                                            <button
                                                @click.prevent="
                                                    deletearticle(size)
                                                "
                                            >
                                                <a class="btn btn-danger w-100">
                                                    Delete</a
                                                >
                                            </button>
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
    props: { sizes: Object },
    methods: {
        deletearticle(size) {
            if (confirm(`data ingin di hapus?  data ${size.name}`)) {
                this.$inertia.delete(
                    route("admin.size.destroy", { id: size.id })
                );
            } else {
                return false;
            }
        },
    },
};
</script>
