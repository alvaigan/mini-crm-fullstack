<script>
import Sidebar from "../components/Sidebar.vue";

export default {
    components: {
        Sidebar,
    },
};
</script>

<template>
    <div class="flex flex-row h-screen">
        <Sidebar />

        <router-view class="mt-16 mx-2 md:mx-10 lg:mx-20" />
    </div>
</template>
