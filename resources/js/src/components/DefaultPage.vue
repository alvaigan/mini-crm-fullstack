<script>
import ContentCard from "./ContentCard.vue";

export default {
    components: {
        ContentCard,
    },
    props: ["title", "titleDesc"],
};
</script>

<template>
    <div class="flex flex-col justify-start w-full">
        <div v-show="title" class="flex flex-col justify-center mt-10 mb-5">
            <h1 class="text-2xl font-semibold mb-2">{{ title }}</h1>
            <p class="text-sm font-light">{{ titleDesc }}</p>
        </div>

        <div v-show="$slots['action']" class="flex flex-row justify-between mt-2 mb-5">
            <slot name="action"></slot>
        </div>

        <ContentCard v-show="$slots['content']">
            <slot name="content"></slot>
        </ContentCard>
    </div>
</template>
