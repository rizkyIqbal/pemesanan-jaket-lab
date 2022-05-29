<template>
        <div class="flex flex-no-wrap bg-white">
            <NavbarAdmin></NavbarAdmin>
            <!-- Remove class [ h-64 ] when adding a card block -->
        <div class="container mx-auto py-10 h-64 md:w-4/5 w-11/12 px-6">
                <!-- Place your content here -->
                <slot></slot>
        </div>
    </div>
</template>
<script>
import NavbarAdmin from "@/partials/admin/SidebarAdmin";
import FooterAdmin from "@/partials/admin/FooterAdmin";
export default {
    components: {
        NavbarAdmin,
        FooterAdmin,
    },
};
</script>
