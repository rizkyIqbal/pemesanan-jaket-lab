<template>
    <div
        class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-theme-primary d-flex sticky-top"
    >
        <div
            class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-white"
        >
            <a
                href="/"
                class="d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto text-white text-decoration-none"
            >
                <span class="fs-5"
                    >B<span class="d-none d-sm-inline">rand</span></span
                >
            </a>
            <ul
                class="nav nav-pills flex-sm-column flex-row flex-nowrap flex-shrink-1 flex-sm-grow-0 flex-grow-1 mb-sm-auto mb-0 justify-content-center align-items-center align-items-sm-start"
                id="menu"
            >
                <!-- Divider -->
                <hr class="sidebar-divider" />
                <li class="nav-admin">
                    <Link
                        :href="route('admin.index')"
                        class="nav-link px-sm-0 px-2"
                    >
                        <i class="fas fa-bars theme-secondary"></i>
                        <span class="ms-1 d-none d-sm-inline"> Dashboard</span>
                    </Link>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider" />
                <li class="nav-admin">
                    <Link
                        :href="route('admin.jacket.index')"
                        class="nav-link px-sm-0 px-2"
                    >
                        <i class="fas fa-tshirt theme-secondary"></i>
                        <span class="ms-1 d-none d-sm-inline">
                            Jaket</span
                        ></Link
                    >
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider" />
                <li class="nav-admin">
                    <Link href="#" class="nav-link px-sm-0 px-2">
                        <i class="far fa-credit-card theme-secondary"></i>
                        <span class="ms-1 d-none d-sm-inline"> Transaksi</span>
                    </Link>
                </li>
            </ul>
            <div
                class="dropdown py-sm-4 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1"
            >
                <a
                    href="#"
                    class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    id="dropdownUser1"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                    <img
                        src="https://github.com/mdo.png"
                        alt="hugenerd"
                        width="28"
                        height="28"
                        class="rounded-circle"
                    />
                    <span class="d-none d-sm-inline mx-1">Joe</span>
                </a>
                <ul
                    class="dropdown-menu dropdown-menu-dark text-small shadow"
                    aria-labelledby="dropdownUser1"
                >
                    <li>
                        <a class="dropdown-item" href="#">New project...</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Settings</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Profile</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Sign out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        Link,
    },
};
</script>
