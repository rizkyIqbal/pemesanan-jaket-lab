<template>
    <UserLightLayout></UserLightLayout>
    <hr class="mt-5" />
    <main>
        <div class="w-full flex">
            <div class="w-1/2 py-12 pr-8 pl-40">
                <div class="w-full flex">
                    <p class="text-gray-500">Order</p>
                    <div
                        class="flex-grow border-t border-gray-300 mt-3 mx-4"
                    ></div>
                    <p class="text-gray-500">Payment</p>
                    <div
                        class="flex-grow border-t border-gray-300 mt-3 mx-4"
                    ></div>
                    <p class="text-amber-600">Receipt</p>
                </div>
                <div class="mt-14">
                    <p class="font-bold">Payment Details</p>
                    <div class="mt-4">
                        <div class="flex">
                            <div class="w-1/2">
                                <p class="text-sm">Nama</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-sm font-semibold text-right">
                                    {{ user_logins.full_name }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex">
                            <div class="w-1/2">
                                <p class="text-sm">NIM</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-sm font-semibold text-right">
                                    {{ user_logins.user_name }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex">
                            <div class="w-1/2">
                                <p class="text-sm">Size</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-sm font-semibold text-right">
                                    {{ sizes.name }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex">
                            <div class="w-1/2">
                                <p class="text-sm">Custom</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-sm font-semibold text-right">
                                    Tidak Ada
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex">
                            <div class="w-1/2">
                                <p class="text-sm font-bold">Total</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-sm font-bold text-right">
                                    Rp. 150.200
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/2">
                <form @submit.prevent="insert">
                    <div class="py-12 pl-8 pr-40">
                        <p class="font-bold">Payment Proof</p>
                        <div class="mt-4">
                            <div class="flex">
                                <div class="w-1/2">
                                    <p class="text-sm">Bank</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-sm font-semibold text-right">
                                        {{ transactions.bank }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="flex">
                                <div class="w-1/2">
                                    <p class="text-sm">CC Number</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-sm font-semibold text-right">
                                        32323444348
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8">
                            <div class="flex">
                                <p class="text-md">Upload Proof</p>
                            </div>
                            <div class="mt-2">
                                <input type="file" @change="upload" />
                            </div>
                        </div>
                        <p
                            class="text-sm text-red-700 mt-4"
                            v-if="
                                transactions.status == 3 &&
                                transactions.is_paid == 0
                            "
                        >
                            Data Anda Sedang Ditinjau
                        </p>
                        <div class="cont" v-if="transactions.is_paid == 1">
                            <p class="text-sm text-green-600 mt-4">
                                Silahkan Print Resi
                            </p>
                            <p
                                class="text-sm text-sky-500 underline-offset-1 underline"
                            >
                                Print Disini
                            </p>
                        </div>
                        <div
                            class="flex-grow border-t border-gray-300 mt-6"
                        ></div>
                        <div class="relative">
                            <div
                                class="flex absolute lg:inset-y-0 lg:right-0 mt-6 lg:h-12"
                            >
                                <p class="text-sm mr-5 lg:mt-4">Cancel Order</p>
                                <button
                                    class="flex items-center py-4 px-4 text-sm text-white bg-theme-primary rounded text-center"
                                    type="submit"
                                >
                                    Complete Order
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</template>
<script>
import UserLightLayout from "@/Layouts/UserLightLayout";
export default {
    components: {
        UserLightLayout,
    },
    props: {
        jacket: Object,
        sizes: Object,
        user_logins: Object,
        transactions: Object,
    },
    data() {
        return {
            form: {
                image: "",
                _method: "put",
            },
        };
    },
    methods: {
        insert() {
            this.$inertia.post(
                this.route("user.transaction.store_receipt"),
                this.form
            );
        },
        upload(e) {
            this.form.image = e.target.files[0];
        },
    },
};
</script>
