<script>
import {
    PhTrash,
    PhPlus,
    PhPencilSimple,
    PhPhone,
    PhStar,
    PhFolderSimpleStar,
} from "phosphor-vue";
import DefaultPage from "../components/DefaultPage.vue";
import CallingDialog from "../components/CallingDialog.vue";
import { mapState } from "vuex";
import queryString from "query-string";
import { useDebounce } from "../utils/helpers.js";

const changeQueryParams = (key, val) => {
    const searchURL = new URL(window.location);
    searchURL.searchParams.set(key, val);
    if (val == 0 || val == "") {
        searchURL.searchParams.delete(key);
    }
    window.history.pushState({}, "", searchURL);

    return window.location.href;
};

export default {
    components: {
        PhTrash,
        PhPlus,
        PhPencilSimple,
        PhPhone,
        PhStar,
        PhFolderSimpleStar,
        DefaultPage,
        CallingDialog,
    },
    computed: {
        ...mapState({
            roles: (state) => state.roles.roles,
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
        selectedRoleValue: "",
        companyValue: "",
        allCheck: false,
        selected: [],
        chooseRolePH: "Choose Role",
        url: "",
        show: false,
        contactDial: {},
    }),
    watch: {
        selected: function (val) {
            console.log(val);
        },
        roles: (newVal) => {
            console.log(newVal);
        },
        companyValue: useDebounce(function (val) {
            const newUrl = changeQueryParams("company", val);
            this.url = newUrl;
        }, 500),
        selectedRoleValue: function (val) {
            const newUrl = changeQueryParams("role", val);
            this.url = newUrl;
        },
        url: function (val) {
            console.log(val);
            let query = val.split("?");
            if (query.length > 1) {
                query = query[1];
            }

            const parseQuery = queryString.parse(query);

            console.log(Object.keys(parseQuery).length);

            if (Object.keys(parseQuery).length !== 0) {
                this.$store.dispatch("contacts/getAllContacts", parseQuery);
            } else {
                this.$store.dispatch("contacts/getAllContacts");
            }
        },
    },
    methods: {
        handleCalling: function (contactData) {
            this.contactDial = contactData;
            this.show = !this.show;
        },
        toggleFavorite: function (id) {
            this.$store.dispatch("contacts/toggleFavorite", id);
            this.$store.dispatch("contacts/getAllContacts");
        },
    },
    created() {
        this.$store.dispatch("contacts/getAllContacts");
        this.$store.dispatch("roles/getAllRoles");

        this.url = window.location.href;
    },
};
</script>

<template>
    <DefaultPage title="Contacts" title-desc="List of Contacts" :action="true">
        <template v-slot:action>
            <div class="flex flex-row justify-center items-center"></div>

            <div class="flex flex-row justify-center items-center gap-2">
                <span>Filters:</span>

                <vs-input v-model="companyValue" state="primary" placeholder="Type Company" type="search" />

                <vs-select :placeholder="chooseRolePH" state="primary" color="primary" v-model="selectedRoleValue"
                    v-if="roles.length > 0">
                    <vs-option :key="0" label="" :value="0"> All </vs-option>

                    <vs-option v-for="(role, index) in roles" :key="(index += 1)" :label="role.label" :value="role.id">
                        {{ role.label }}
                    </vs-option>
                </vs-select>
            </div>
        </template>

        <template v-slot:content>
            <vs-table>
                <template #thead>
                    <vs-tr>
                        <vs-th class="w-5">
                            <PhFolderSimpleStar :size="32" weight="fill" color="#ffbb00" />
                        </vs-th>
                        <vs-th> Name </vs-th>
                        <vs-th> Phone Number </vs-th>
                        <vs-th> Company Name </vs-th>
                        <vs-th> Role </vs-th>
                        <vs-th> Action </vs-th>
                    </vs-tr>
                </template>
                <template #tbody>
                    <vs-tr :key="i" v-for="(tr, i) in contacts" :data="tr" v-if="contacts.length > 0">
                        <vs-td>
                            <PhStar v-if="tr.is_favorite == true" :size="32" weight="duotone" color="#ffbb00"
                                @click="() => toggleFavorite(tr.id)" />
                            <PhStar v-else :size="32" weight="duotone" color="#333333"
                                @click="() => toggleFavorite(tr.id)" />
                        </vs-td>
                        <vs-td>
                            {{ tr.name }}
                        </vs-td>
                        <vs-td>
                            {{ tr.phone }}
                        </vs-td>
                        <vs-td>
                            {{ tr.company }}
                        </vs-td>
                        <vs-td>
                            {{ tr.role.label }}
                        </vs-td>
                        <vs-td>
                            <div class="flex flex-row justify-center">
                                <vs-button success size="large" @click="() => handleCalling(tr)">
                                    <PhPhone weight="duotone" />
                                </vs-button>
                            </div>
                        </vs-td>
                    </vs-tr>
                </template>
            </vs-table>

            <CallingDialog v-model="show" :contact-dial="contactDial" />
        </template>
    </DefaultPage>
</template>
