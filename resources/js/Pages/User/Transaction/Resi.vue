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
                            <a
                                class="text-sm text-sky-500 underline-offset-1 underline"
                                :href="route('pdf')"
                            >
                                Print Disini
                            </a>
                        </div>
                        <div
                            class="flex-grow border-t border-gray-300 mt-6"
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
        <TransitionRoot appear :show="isOpen" as="template">
            <Dialog as="div" @close="closeModal" class="relative z-10">
                <TransitionChild
                    as="template"
                    enter="duration-300 ease-out"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="duration-200 ease-in"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-black bg-opacity-25" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div
                        class="flex min-h-full items-center justify-center p-4 text-center"
                    >
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95"
                        >
                            <DialogPanel
                                class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                            >
                                <DialogTitle
                                    as="h3"
                                    class="text-lg font-medium leading-6 text-gray-900"
                                >
                                    Payment successful
                                </DialogTitle>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Your payment has been successfully
                                        submitted. You can print the receipt
                                        after you close this dialog.
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <button
                                        type="button"
                                        class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                        @click="closeModal"
                                    >
                                        Got it, thanks!
                                    </button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </main>
</template>
<script>
import { ref } from "vue";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";

const isOpen = ref(false);

import UserLightLayout from "@/Layouts/UserLightLayout";
export default {
    setup() {
        return {
            isOpen,
        };
    },
    components: {
        UserLightLayout,
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogPanel,
        DialogTitle,
        isOpen,
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
    // computed: {
    //     display() {
    //         if (this.transactions.is_paid == 1) {
    //             isOpen.value = true;
    //         }
    //     },
    // },
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
        // openModal() {
        //     // console.log("haha");
        //     isOpen.value = true;
        // },
        closeModal() {
            isOpen.value = false;
        },
    },
    watch: {
        transactions: {
            immediate: true,
            handler(val) {
                if (val.is_paid == 1) {
                    isOpen.value = true;
                }
            },
            // deep: true,
        },
    },
};
</script>
