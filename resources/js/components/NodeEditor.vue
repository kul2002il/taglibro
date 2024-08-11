<template>
    <div v-if="node" class="container p-4 rounded-2xl bg-white">
        <h1 class="text-xl mb-4">{{ node.name }}</h1>
        <div class="font-mono" contenteditable="true" @input="onInput" @focusout="save" ref="editor"></div>
    </div>
    <div v-else class="container p-4 rounded-2xl">
        <h1 class="text-xl mb-4">Нет выбранной заметки</h1>
        <div>
            Выберите заметку из меню слева.
        </div>
    </div>
</template>

<script lang="ts">

import NodeRepository from '@/api/NodeRepository';
import Node from '@/types/Node';
import {defineComponent, PropType} from 'vue';

export default defineComponent({
    name: "NodeEditor",
    props: {
        node: {
            type: Object as PropType<Node|null>,
            required: true,
        }
    },
    methods: {
        onInput(): void {
            if (!this.node) {
                return;
            }

            this.node.content = this.$refs.editor.innerText;
        },
        save(): void {
            if (!this.node) {
                return;
            }
            (new NodeRepository()).save(this.node);
        },
    },
    updated() {
        if (!this.node) {
            return;
        }

        this.$refs.editor.innerText = this.node.content;
    },
});

</script>