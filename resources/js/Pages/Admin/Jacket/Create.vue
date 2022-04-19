<template>
    <div>
        <form @submit.prevent="insert">
            Nama Jaket :
            <input type="text" v-model="form.name" />
            Foto Jaket :
            <input type="text" v-model="form.image" />
            Warna Jaket :
            <input type="text" v-model="form.color" />
            Harga Jaket :
            <input type="text" v-model="form.price" />
            <button type="submit">Submit</button>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            form: {
                name: "",
                image: "",
                color: "",
                price: "",
            },
        };
    },
    methods: {
        insert() {
            this.$inertia.post("/admin/jaket/tambah", this.form);
        },
    },
};
</script>
