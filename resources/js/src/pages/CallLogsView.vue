<script>
import { PhTrash, PhPlus } from "phosphor-vue";
import DefaultPage from "../components/DefaultPage.vue";
import { mapState } from "vuex";
import { timestampToDate } from "../utils/helpers";

export default {
    components: {
        PhTrash,
        PhPlus,
        DefaultPage,
    },
    computed: {
        ...mapState({
            callLogs: (state) => state.contacts.callLogs,
        }),
    },
    data: () => ({
        allCheck: false,
        selected: [],
        dateRangeFilter: {
            from: "",
            to: "",
        },
    }),

    watch: {
        "dateRangeFilter.from"(val) {
            if (![val, this.dateRangeFilter.to].includes("")) {
                this.onChangeToDate();
            }
        },
        "dateRangeFilter.to"(val) {
            if (![val, this.dateRangeFilter.from].includes("")) {
                this.onChangeToDate();
            }
        },
    },

    methods: {
        timestampToDate(timestamp) {
            return timestampToDate(timestamp);
        },
        onChangeToDate() {
            this.$store.dispatch(
                "contacts/getAllCallLogs",
                this.dateRangeFilter
            );
        },
    },

    created() {
        this.$store.dispatch("contacts/getAllCallLogs");
    },
};
</script>

<template>
    <DefaultPage title="Call Logs" title-desc="List of Call Logs" :action="true">
        <template v-slot:action>
            <div class="flex flex-row justify-center items-center"></div>

            <div class="flex flex-row justify-center items-center gap-2">
                <span>Filters:</span>

                <vs-input type="date" color="primary" state="primary" v-model="dateRangeFilter.from" />
                <span> To </span>
                <vs-input type="date" color="primary" state="primary" v-model="dateRangeFilter.to" />
            </div>
        </template>

        <template v-slot:content>
            <vs-table v-model="callLogs">
                <template #thead>
                    <vs-tr>
                        <vs-th class="w-5">
                            <vs-checkbox :indeterminate="selected.length == callLogs.length
                                " v-model="allCheck" @change="
                                    selected = $vs.checkAll(selected, callLogs)
                                    " />
                        </vs-th>
                        <vs-th>Contact Name</vs-th>
                        <vs-th>Timestamp</vs-th>
                        <vs-th>Duration</vs-th>
                        <vs-th>Status</vs-th>
                    </vs-tr>
                </template>
                <template #tbody>
                    <vs-tr :key="i" v-for="(tr, i) in callLogs" :data="tr" :is-selected="!!selected.includes(tr)"
                        v-if="callLogs.length > 0">
                        <vs-td checkbox>
                            <vs-checkbox :val="tr" v-model="selected" />
                        </vs-td>
                        <vs-td>
                            {{ tr.contact_name }}
                        </vs-td>
                        <vs-td>
                            {{ timestampToDate(tr.created_at) }}
                        </vs-td>
                        <vs-td>
                            {{ tr.duration }}
                        </vs-td>
                        <vs-td>
                            <div v-if="tr.status == 'Missed'"
                                class="p-2 bg-red-200 text-red-600 font-medium rounded-lg text-center">
                                {{ tr.status }}
                            </div>

                            <div v-else class="p-2 bg-green-200 text-green-600 font-medium rounded-lg text-center">
                                {{ tr.status }}
                            </div>
                        </vs-td>
                    </vs-tr>
                </template>
            </vs-table>
        </template>
    </DefaultPage>
</template>
