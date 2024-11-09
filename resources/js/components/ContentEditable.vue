<template>
    <component :is="is" class="input" v-bind="props" contenteditable="true" ref="editor" @input="onInput"></component>
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
            let text = (this.$refs.editor as HTMLHtmlElement).innerText;
            this.$emit('update:modelValue', text.trim())
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

<style scoped>
.input:empty::before{
    content: attr(placeholder);
    color: #555;
    display: block;
    pointer-events: none
}
</style>