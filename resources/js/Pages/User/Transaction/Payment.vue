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
                    <p class="text-amber-600">Payment</p>
                    <div
                        class="flex-grow border-t border-gray-300 mt-3 mx-4"
                    ></div>
                    <p class="text-gray-500">Receipt</p>
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
                                <p class="text-sm">No.Telp</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-sm font-semibold text-right">
                                    {{ transactions.phone_number }}
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
                                <p
                                    class="text-sm font-semibold text-right"
                                    v-if="transactions.size_id == 0"
                                >
                                    Custom
                                </p>
                                <p
                                    class="text-sm font-semibold text-right"
                                    v-else
                                >
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
                                <p
                                    v-if="transactions.custom == null"
                                    class="text-sm font-semibold text-right"
                                >
                                    Tidak Ada
                                </p>
                                <p
                                    v-else
                                    class="text-sm font-semibold text-right"
                                >
                                    {{ transactions.custom }}
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
                                    Rp. {{ transactions.price }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/2">
                <form @submit.prevent="insert" class="space-y-6">
                    <div class="py-12 pl-8 pr-40">
                        <p class="font-bold">Choose Payment</p>
                        <div class="mt-4"
                                    v-for="bank in banks"
                                    :key="bank.id">
                            <div
                                class="bg-white border-2 border-gray-700 rounded w-full py-3 pl-4"
                                
                            >
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-400 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio"
                                    name="flexRadioDefault"
                                    id="flexRadioDefault1"
                                    v-model="form.bank"
                                    :value="bank.id"
                                />

                                <p class="ml-2">{{bank.bank}}</p>
                            </div>
                        </div>
                        <div
                            class="flex-grow border-t border-gray-300 mt-12"
                        ></div>
                        <div class="relative">
                            <div
                                class="flex absolute lg:inset-y-0 lg:right-0 mt-6 lg:h-12"
                            >
                                <a
                                    class="text-sm mr-5 lg:mt-4"
                                    :href="route('user.transaction.destroy')"
                                >
                                    Cancel Order
                                </a>
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
import footerlanding from "@/partials/user/FooterTransaction";
export default {
    components: {
        UserLightLayout,
        footerlanding,
    },
    props: {
        jacket: Object,
        sizes: Object,
        banks: Object,
        user_logins: Object,
        transactions: Object,
    },
    data() {
        return {
            form: {
                bank: "",
            },
        };
    },
    methods: {
        insert() {
            this.$inertia.post(
                this.route("user.transaction.store_payment"),
                this.form
            );
        },
    },
};
</script>
