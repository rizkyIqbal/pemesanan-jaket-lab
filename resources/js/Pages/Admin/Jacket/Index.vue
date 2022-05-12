<template>
    <AdminLayout>
        <div class="row align-items-center mb-3">
            <div class="col-sm-10">
                <h1 class="h3 mb-2 text-gray-800">Jaket Admin</h1>
            </div>
            <div
                class="col-sm-2 d-flex align-items-end flex-column bd-highlight mb-3"
            >
                <Link
                    class="btn btn-primary align-right"
                    :href="route('admin.jacket.create')"
                    >Tambah</Link
                >
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    DataTables Example
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table
                        class="table table-bordered"
                        id="dataTable"
                        width="100%"
                        cellspacing="0"
                    >
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Color</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Color</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr
                                v-for="jacket in jackets.data"
                                :key="jacket.slug"
                            >
                                <td>{{ jacket.name }}</td>
                                <td>{{ jacket.image }}</td>
                                <td>{{ jacket.color }}</td>
                                <td>{{ jacket.price }}</td>
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
                                                    deletearticle(
                                                        `${jacket.id}`
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
    props: { jackets: Object },
    methods: {
        deletearticle(id) {
            if (confirm("data ingin di hapus?")) {
                this.$inertia.delete(
                    route("admin.jacket.destroy", { slug: slug })
                );
            } else {
                return false;
            }
        },
    },
};
</script>
