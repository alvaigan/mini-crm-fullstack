<script>
import {
    PhUserCircle,
    PhPhoneDisconnect,
    PhPhoneCall,
    PhPhone,
    PhPhoneSlash,
} from "phosphor-vue";
import { CALLING_STATUS } from "../utils/constant";
import Timer from "./Timer.vue";

export default {
    components: {
        PhUserCircle,
        PhPhoneDisconnect,
        PhPhoneCall,
        PhPhone,
        PhPhoneSlash,
        Timer,
    },
    props: ["value", "contactDial"],
    data: () => ({
        callingStatus: CALLING_STATUS.dialing,
        fullCallingTime: "00:00:00",
        timerStart: false,
        indicatorStyle: {
            bg: "bg-gray-200",
            color: "text-gray-700",
            animation: "animate-pulse",
        },
    }),
    computed: {
        show: {
            get() {
                return this.value;
            },
            set(val) {
                this.$emit("input", val);
                this.callingStatus = CALLING_STATUS.dialing;
            },
        },
        contact: {
            get() {
                return this.contactDial;
            },
        },
    },
    watch: {
        show(data) {
            if (data) this.startCalling(this.contactDial);
        },
        callingStatus(data) {
            if (data.name == CALLING_STATUS.active.name) {
                this.timerStart = true;
                this.indicatorStyle = {
                    bg: "bg-emerald-200",
                    color: "text-emerald-700",
                    animation: "",
                };
            } else if (
                data.name == CALLING_STATUS.dialing.name ||
                data.name == CALLING_STATUS.endCall.name
            ) {
                this.timerStart = false;
                this.indicatorStyle = {
                    bg: "bg-gray-200",
                    color: "text-gray-700",
                    animation: "animate-pulse",
                };
            } else if (data.name == CALLING_STATUS.noAnswer.name) {
                this.timerStart = false;
                this.indicatorStyle = {
                    bg: "bg-red-200",
                    color: "text-red-700",
                    animation: "",
                };
            }
        },
    },
    methods: {
        startCalling(data) {
            if (data.isCall) {
                setTimeout(() => {
                    this.callingStatus = CALLING_STATUS.active;
                }, 2000);
            } else {
                setTimeout(() => {
                    this.callingStatus = CALLING_STATUS.noAnswer;
                }, 2000);
            }
        },
        closeDialog: function () {
            this.storeCallLog();
            this.callingStatus = CALLING_STATUS.endCall;
            setTimeout(() => {
                this.show = !this.show;

                this.callingStatus = CALLING_STATUS.dialing;
            }, 1000);
            this.timerStart = false;
            console.log(this.fullCallingTime);
        },
        callingTime: function (data) {
            this.fullCallingTime = data;
        },
        storeCallLog() {
            var payloads = {
                contact_name: "",
                duration: "",
                status: "",
            };

            console.log("storeCallLog", this.callingStatus);

            if (
                this.callingStatus.name == "active" ||
                this.callingStatus.name == "no-answer"
            ) {
                payloads.contact_name = this.contact?.name ?? "-";
                payloads.duration = this.fullCallingTime ?? "00:00:00";
                payloads.status =
                    this.callingStatus?.name == "active"
                        ? "Completed"
                        : "Missed";

                this.$store.dispatch("contacts/createCallLog", payloads);
            }
        },
    },
};
</script>

<template>
    <div class="center">
        <vs-dialog not-close prevent-close v-model="show">
            <div
                :class="`w-full flex flex-row justify-center ${indicatorStyle.bg} p-2 rounded-xl ${indicatorStyle.animation}`">
                <PhPhoneCall v-if="callingStatus.name == 'dialing'" :size="24" weight="duotone"
                    :class="`me-2 ${indicatorStyle.color}`" />

                <PhPhone v-else-if="callingStatus.name == 'active'" :size="24" weight="duotone"
                    :class="`me-2 ${indicatorStyle.color}`" />

                <PhPhoneSlash v-else-if="callingStatus.name == 'no-answer'" :size="24" weight="duotone"
                    :class="`me-2 ${indicatorStyle.color}`" />

                <h4 :class="`text-lg ${indicatorStyle.color}`">
                    {{ callingStatus.label }}
                </h4>
            </div>

            <div clas="flex flex-col w-full justify-center">
                <div class="text-center my-5">
                    <!-- <h1 class="text-2xl">--:--:--</h1> -->
                    <h1 :class="`text-2xl ${indicatorStyle.animation}`">
                        <Timer @full-time="callingTime" v-model="timerStart" />
                    </h1>
                </div>
                <div class="w-full">
                    <PhUserCircle :size="100" weight="duotone" class="m-auto" />
                </div>
                <div class="flex flex-col justify-center text-center mb-5">
                    <h2 class="font-semibold text-2xl">
                        {{ contact.name ?? "-" }}
                    </h2>
                    <h3 class="font-medium">{{ contact.phone ?? "-" }}</h3>
                    <span class="text-xs">
                        {{ contact.company ?? "-" }} |
                        {{ contact.role?.label ?? "-" }}</span>
                </div>
            </div>

            <template #footer>
                <div class="flex flex-col w-full justify-center">
                    <vs-button circle danger @click="closeDialog" class="mx-auto">
                        <PhPhoneDisconnect :size="32" weight="duotone" />
                    </vs-button>
                </div>
            </template>
        </vs-dialog>
    </div>
</template>
