<script>
export default {
    props: ["value"],
    computed: {
        start: {
            get() {
                return this.value;
            },
            set(val) {
                this.$emit("input", val);
                // this.callingStatus = CALLING_STATUS.dialing;
            },
        },
    },
    data: () => ({
        second: 0,
        minute: 0,
        hour: 0,
    }),
    computed: {
        stringSecond: function () {
            if (this.second < 10) {
                return `0${this.second}`;
            } else {
                return `${this.second}`;
            }
        },
        stringMinute: function () {
            if (this.minute < 10) {
                return `0${this.minute}`;
            } else {
                return `${this.minute}`;
            }
        },
        stringHour: function () {
            if (this.hour < 10) {
                return `0${this.hour}`;
            } else {
                return `${this.hour}`;
            }
        },
    },
    watch: {
        second: function (val) {
            this.$emit(
                "full-time",
                `${this.stringHour}:${this.stringMinute}:${this.stringSecond}`
            );
        },
        value: function (val) {
            // this.second = 0;
            // this.minute = 0;
            // this.hour = 0;

            const intervalTimer = setInterval(() => {
                this.updateTime(val);
            }, 1000);

            if (val == false) {
                clearInterval(intervalTimer);
            }
        },
    },
    methods: {
        updateTime: function () {
            if (this.value) {
                this.second += 1;
            } else {
                this.second = 0;
            }
            if (this.second == 60) {
                this.second = 0;
                this.minute += 1;
            }

            if (this.minute == 60) {
                this.minute = 0;
                this.hour += 1;
            }
        },
    },
};
</script>

<template>
    <div>{{ stringHour }}:{{ stringMinute }}:{{ stringSecond }}</div>
</template>
