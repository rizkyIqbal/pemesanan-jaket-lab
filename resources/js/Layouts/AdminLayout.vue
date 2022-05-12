<template>
    <link
        :href="'../vendor/fontawesome-free/css/all.min.css'"
        rel="stylesheet"
        type="text/css"
    />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"
    />

    <!-- Page Wrapper -->
    <div id="wrapper">
        <div
            class="container-fluid overflow-hidden"
            style="padding-left: 10px; padding-right: 10px"
        >
            <div class="row vh-100 custom-overflow">
                <!-- NAVBAR -->
                <NavbarAdmin></NavbarAdmin>
                <div class="col d-flex flex-column h-sm-100" style="padding: 0">
                    <main class="row overflow-auto">
                        <!-- Content Wrapper -->
                        <div id="content-wrapper" class="d-flex flex-column">
                            <!-- Main Content -->
                            <div id="content">
                                <!-- Topbar -->
                                <nav
                                    class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow pe-5 ps-5"
                                >
                                    <!-- Topbar Search -->
                                    <form
                                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                                    >
                                        <div class="input-group">
                                            <input
                                                type="text"
                                                class="form-control bg-light border-1 small"
                                                placeholder="Search for..."
                                                aria-label="Search"
                                                aria-describedby="basic-addon2"
                                            />
                                            <div class="input-group-append">
                                                <button
                                                    class="btn btn-primary bg-theme-primary"
                                                    type="button"
                                                >
                                                    <i
                                                        class="fas fa-search fa-sm"
                                                    ></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- Topbar Navbar -->
                                    <ul class="navbar-nav ml-auto">
                                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                                        <li
                                            class="nav-item dropdown no-arrow d-sm-none"
                                        >
                                            <a
                                                class="nav-link dropdown-toggle"
                                                href="#"
                                                id="searchDropdown"
                                                role="button"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <i
                                                    class="fas fa-search fa-fw"
                                                ></i>
                                            </a>
                                            <!-- Dropdown - Messages -->
                                            <div
                                                class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                                aria-labelledby="searchDropdown"
                                            >
                                                <form
                                                    class="form-inline mr-auto w-100 navbar-search"
                                                >
                                                    <div class="input-group">
                                                        <input
                                                            type="text"
                                                            class="form-control bg-light border-0 small"
                                                            placeholder="Search for..."
                                                            aria-label="Search"
                                                            aria-describedby="basic-addon2"
                                                        />
                                                        <div
                                                            class="input-group-append"
                                                        >
                                                            <button
                                                                class="btn btn-primary"
                                                                type="button"
                                                            >
                                                                <i
                                                                    class="fas fa-search fa-sm"
                                                                ></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </li>

                                        <div
                                            class="topbar-divider d-none d-sm-block"
                                        ></div>

                                        <!-- Nav Item - User Information -->
                                        <li class="nav-item dropdown no-arrow">
                                            <a
                                                class="nav-link dropdown-toggle"
                                                href="#"
                                                id="userDropdown"
                                                role="button"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <span
                                                    class="mr-2 d-none d-lg-inline text-gray-600 small"
                                                    >Douglas McGee</span
                                                >
                                                <img
                                                    class="img-profile rounded-circle"
                                                    src="img/undraw_profile.svg"
                                                />
                                            </a>
                                            <!-- Dropdown - User Information -->
                                            <div
                                                class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                                aria-labelledby="userDropdown"
                                            >
                                                <a
                                                    class="dropdown-item"
                                                    href="#"
                                                >
                                                    <i
                                                        class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"
                                                    ></i>
                                                    Profile
                                                </a>
                                                <a
                                                    class="dropdown-item"
                                                    href="#"
                                                >
                                                    <i
                                                        class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"
                                                    ></i>
                                                    Settings
                                                </a>
                                                <a
                                                    class="dropdown-item"
                                                    href="#"
                                                >
                                                    <i
                                                        class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"
                                                    ></i>
                                                    Activity Log
                                                </a>
                                                <div
                                                    class="dropdown-divider"
                                                ></div>
                                                <a
                                                    class="dropdown-item"
                                                    href="#"
                                                    data-toggle="modal"
                                                    data-target="#logoutModal"
                                                >
                                                    <i
                                                        class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                                                    ></i>
                                                    Logout
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </nav>
                                <!-- End of Topbar -->

                                <!-- Main Content -->
                                <div id="content">
                                    <!-- Begin Page Content -->
                                    <div class="container-fluid">
                                        <slot></slot>
                                    </div>
                                    <!-- /.container-fluid -->
                                </div>
                                <!-- End of Main Content -->

                                <!-- FOOTER -->
                                <FooterAdmin></FooterAdmin>
                            </div>
                            <!-- End of Content Wrapper -->
                        </div>
                    </main>
                </div>
                <!-- End of Page Wrapper -->
            </div>
        </div>
    </div>
</template>
<script>
import NavbarAdmin from "@/partials/admin/NavbarAdmin";
import FooterAdmin from "@/partials/admin/FooterAdmin";
export default {
    components: {
        NavbarAdmin,
        FooterAdmin,
    },
};
</script>
