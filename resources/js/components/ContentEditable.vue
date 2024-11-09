<template>
    <component
        :is="is"
        class="input"
        v-bind="props"
        contenteditable="true"
        ref="editor"
        @input="onInput"
    ></component>
</template>

<script setup lang="ts">

import { PropType, onMounted, useTemplateRef, defineModel, defineProps, watchEffect } from 'vue';

const modelValue = defineModel<string>({default: ''});

const props = defineProps({
    is: {
        type: String as PropType<string>,
        required: true,
    },
    props: {
        type: Object as PropType<Object>,
        required: false,
    },
});

const editor = useTemplateRef<HTMLHtmlElement>('editor');

function onInput(): void {
    let text = (editor.value as HTMLHtmlElement).innerText;
    modelValue.value = text.trim();
}

function updateEditor(newValue: string): void {
    if ((editor.value as HTMLHtmlElement).innerText !== newValue) {
        (editor.value as HTMLHtmlElement).innerText = newValue;
    }
}

watchEffect(() => {
    if (!editor.value) {
        return;
    }

    updateEditor(modelValue.value);
})

onMounted(() => {
    updateEditor(modelValue.value);
});

</script>

<style module>
.input:empty::before {
    content: attr(placeholder);
    color: #555;
    display: block;
    pointer-events: none
}
</style>