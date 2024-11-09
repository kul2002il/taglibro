<template>
    <div v-if="node" class="container p-4 rounded-2xl bg-white">
        <ContentEditable is="h1"  class="text-xl mb-4" @input="touch" @focusout="save" v-model="node.name"    placeholder="Название заметки"></ContentEditable>
        <ContentEditable is="div" class="font-mono"    @input="touch" @focusout="save" v-model="node.content" placeholder="Текст заметки."></ContentEditable>
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
import ContentEditable from '@/components/ContentEditable.vue';
import { Node, NEW_NODE_ID } from '@/types/Node';
import { defineComponent, PropType } from 'vue';

export default defineComponent({
    name: "NodeEditor",
    components: {
        ContentEditable,
    },
    props: {
        node: {
            type: Object as PropType<Node|null>,
            required: false,
        }
    },
    methods: {
        touch(): void {
            if (!this.node || this.node.id === NEW_NODE_ID) {
                return;
            }

            this.node.updatedAt = Date.now();
            this.$emit('updateNode', this.node);
        },
        async save(): Promise<void> {
            if (!this.node) {
                return;
            }

            if (this.node.id === NEW_NODE_ID) {
                let node = await (new NodeRepository()).create(this.node);
                this.$emit('updateNode', node);
                return;
            }

            let node = await (new NodeRepository()).save(this.node);
            this.$emit('updateNode', node);
        },
    },
    emits: {
        updateNode: (node: Node) => true,
    }
});

</script>