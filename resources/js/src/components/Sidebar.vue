<script>
import { PhHouse, PhAddressBook, PhPhone } from "phosphor-vue";

export default {
    components: {
        PhHouse,
        PhAddressBook,
        PhPhone,
    },
    data: () => ({
        active: "home",
    }),
};
</script>

<template>
    <div class="w-[400px]">
        <vs-sidebar relative v-model="active" class="w-full" open>
            <template #logo>
                <img src="/asset/images/callon.png" />
            </template>
            <vs-sidebar-item id="home" to="/">
                <template #icon>
                    <PhHouse weight="duotone" />
                </template>
                Home
            </vs-sidebar-item>
            <vs-sidebar-item id="contacts" to="/contacts">
                <template #icon>
                    <PhAddressBook weight="duotone" />
                </template>
                Contacts
            </vs-sidebar-item>
            <vs-sidebar-item id="call-logs" to="/call-logs">
                <template #icon>
                    <PhPhone weight="duotone" />
                </template>
                Call Logs
            </vs-sidebar-item>
        </vs-sidebar>
    </div>
</template>

<style scoped></style>
