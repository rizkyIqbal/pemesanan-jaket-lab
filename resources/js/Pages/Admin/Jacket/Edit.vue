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
    props: {
        jacket: Object,
    },
    data() {
        return {
            form: {
                name: this.jacket.name,
                image: this.jacket.image,
                color: this.jacket.color,
                price: this.jacket.price,
            },
        };
    },
    methods: {
        insert() {
            this.$inertia.put(
                this.route("admin.jacket.update", { id: this.jacket.id }),
                this.form
            );
        },
    },
};
</script>
