<template>
    <div>
        <!-- Page Wrapper -->
        <div id="wrapper">
            <Sidebar />
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <Header />
                    <router-view></router-view>
                </div>
                <!-- End of Main Content -->
                <Footer />
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
    </div>
</template>

<script>
import Header from "../components/Header.vue";
import Sidebar from "../components/Sidebar.vue";
import Footer from "../components/Footer.vue";

export default {
    components: {
        Header,
        Sidebar,
        Footer
    }
};
</script>
