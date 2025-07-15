<script>
import { PhHouse, PhAddressBook, PhPhone, PhDeviceMobile } from "phosphor-vue";

export default {
    components: {
        PhHouse,
        PhAddressBook,
        PhPhone,
        PhDeviceMobile,
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
                <div class="my-5 flex flex-row items-center">
                    <PhDeviceMobile :size="40" color="#185BFF" weight="duotone" />
                    <span class="text-2xl font-bold text-[#185BFF]">CallnMe</span>
                </div>
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
