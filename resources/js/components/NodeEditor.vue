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

<script setup lang="ts">

import NodeRepository from '@/api/NodeRepository';
import ContentEditable from '@/components/ContentEditable.vue';
import { Node, NEW_NODE_ID } from '@/types/Node';
import { defineComponent, PropType } from 'vue';

const props = defineProps({
    node: {
        type: Object as PropType<Node|null>,
        required: false,
    }
});

const emit = defineEmits({
    updateNode: (node: Node) => true,
});

function touch(): void {
    if (!props.node || props.node.id === NEW_NODE_ID) {
        return;
    }

    props.node.updatedAt = Date.now();
    emit('updateNode', props.node);
}

async function save(): Promise<void> {
    if (!props.node) {
        return;
    }

    if (props.node.id === NEW_NODE_ID) {
        let node = await (new NodeRepository()).create(props.node);
        emit('updateNode', node);
        return;
    }

    let node = await (new NodeRepository()).save(props.node);
    emit('updateNode', node);
}

</script>