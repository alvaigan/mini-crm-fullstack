<script>
import { PhTrash, PhPlus, PhUserCircle, PhStar } from "phosphor-vue";
import DefaultPage from "../components/DefaultPage.vue";
import { mapState } from "vuex";

export default {
    components: {
        PhTrash,
        PhPlus,
        PhUserCircle,
        PhStar,
        DefaultPage,
    },
    computed: {
        ...mapState({
            contacts: (state) => {
                let data = state.contacts.contacts;

                let mockContact = [];
                for (let [i, item] of data.entries()) {
                    if (i % 2 == 0) {
                        item.isCall = true;
                    } else {
                        item.isCall = false;
                    }

                    mockContact.push(item);
                }

                return mockContact;
            },
        }),
    },
    data: () => ({
        companyValue: "",
    }),
    created() {
        this.$store.dispatch("contacts/getAllContacts", { is_favorite: true });
    },
};
</script>

<template>
    <DefaultPage title="Favorite Contact" title-desc="All Contacts that frequently contacted" :action="true">
        <template v-slot:content>
            <div class="grid grid-cols-4 gap-4 mx-10 my-5">
                <div v-for="contact in contacts"
                    class="w-full max-w-sm bg-white hover:bg-blue-50 border border-gray-200 rounded-xl shadow-sm curosr-pointer">
                    <div class="flex flex-col">
                        <PhStar :size="32" weight="duotone" color="#ffbb00" class="mt-2 ml-2" />
                    </div>
                    <div class="flex flex-col items-center pb-10">
                        <div class="w-full">
                            <PhUserCircle :size="100" weight="duotone" class="m-auto" />
                        </div>

                        <h5 class="mb-1 text-xl font-medium text-gray-900">
                            {{ contact.name }}
                        </h5>
                        <span class="text-lg text-gray-700">{{
                            contact.phone
                            }}</span>
                        <span class="text-sm text-gray-500">{{ contact.company }} |
                            {{ contact.role.label }}</span>
                    </div>
                </div>
            </div>
        </template>
    </DefaultPage>
</template>
