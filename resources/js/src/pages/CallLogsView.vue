<script>
import { PhTrash, PhPlus } from "phosphor-vue";
import DefaultPage from "../components/DefaultPage.vue";

const roles = [
    {
        name: "all",
        label: "All Roles",
    },
    {
        name: "product-manager",
        label: "Product Manager",
    },
    {
        name: "project-manager",
        label: "Project Manager",
    },
    {
        name: "staff",
        label: "Staff",
    },
    {
        name: "ceo",
        label: "CEO",
    },
    {
        name: "team-leader",
        label: "Team Leader",
    },
];

export default {
    components: {
        PhTrash,
        PhPlus,
        DefaultPage,
    },
    data: () => ({
        roles: roles,
        selectedRoleValue: "",
        companyValue: "",
    }),
};
</script>

<template>
    <DefaultPage
        title="Call Logs"
        title-desc="List of Call Logs"
        :action="true"
    >
        <template v-slot:action>
            <div class="flex flex-row justify-center items-center">
                <vs-button danger :active="active == 1" @click="active = 1">
                    <PhTrash weight="duotone" class="me-1" /> Delete
                </vs-button>
            </div>

            <div class="flex flex-row justify-center items-center gap-2">
                <span>Filters:</span>

                <vs-input
                    v-model="companyValue"
                    state="primary"
                    placeholder="Type Company"
                    type="search"
                />

                <vs-select
                    placeholder="Choose Role"
                    state="primary"
                    color="primary"
                    v-model="selectedRoleValue"
                >
                    <vs-option
                        v-for="role in roles"
                        :label="role.label"
                        :value="role.name"
                        >{{ role.label }}</vs-option
                    >
                </vs-select>

                <vs-button :active="active == 1" @click="active = 1">
                    <PhPlus weight="duotone" class="me-1" />
                    Add New
                </vs-button>
            </div>
        </template>

        <template v-slot:content>
            <div>Call Logs</div>
            <div>{{ companyValue }}</div>
            <div>{{ selectedRoleValue }}</div>
        </template>
    </DefaultPage>
</template>
