<template>
    <component :is="is" v-bind="props" contenteditable="true" ref="editor" @input="onInput"></component>
</template>

<script lang="ts">

import {defineComponent, PropType} from 'vue';

export default defineComponent({
    name: "ContentEditable",
    props: {
        is: {
            type: String as PropType<string>,
            required: true,
        },
        props: {
            type: Object as PropType<Object>,
            required: false,
        },
        modelValue: {
            type: String as PropType<string>,
            required: true,
        },
    },
    methods: {
        onInput(): void {
            this.$emit('update:modelValue', (this.$refs.editor as HTMLHtmlElement).innerText)
        },
        updateEditor(newValue: string): void {
            if ((this.$refs.editor as HTMLHtmlElement).innerText !== newValue) {
                (this.$refs.editor as HTMLHtmlElement).innerText = newValue;
            }
        }
    },
    watch: {
        modelValue(newValue: string): void {
            this.updateEditor(newValue);
        }
    },
    mounted() {
        this.updateEditor(this.modelValue);
    },
});

</script>