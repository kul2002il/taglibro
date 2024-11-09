<template>
    <div v-if="node" class="container p-4 rounded-2xl bg-white">
        <ContentEditable is="h1"  class="text-xl mb-4" @input="touch" @focusout="save" v-model="node.name"    placeholder="Название заметки"></ContentEditable>
        <ContentEditable is="div" class="font-mono"    @input="touch" @focusout="save(node)" v-model="node.content" placeholder="Текст заметки."></ContentEditable>
    </div>
    <div v-else class="container p-4 rounded-2xl">
        <h1 class="text-xl mb-4">Нет выбранной заметки</h1>
        <div>
            Выберите заметку из меню слева.
        </div>
    </div>
</template>

<script setup lang="ts">

import { onMounted, ref, watchEffect } from 'vue';
import { useRoute } from 'vue-router';

import { Node, NEW_NODE_ID } from '@/types/Node';

import NodeRepository from '@/api/NodeRepository';
import ContentEditable from '@/components/ContentEditable.vue';

const route = useRoute();

const node = ref<Node|null>(null);
const repository = new NodeRepository();

const emit = defineEmits({
    updateNode: (node: Node) => true,
});

onMounted(async () => {
    openNodeByIdInUrl();
});
watchEffect(async () => {
    openNodeByIdInUrl()
});

async function openNodeByIdInUrl() {
    node.value = await repository.getOne(+route.params.id);
}

function touch(): void {
    if (!node.value || node.value.id === NEW_NODE_ID) {
        return;
    }

    node.value.updatedAt = Date.now();
    emit('updateNode', node.value);
}

async function save(nodeToSave: Node): Promise<void> {
    if (!nodeToSave) {
        return;
    }

    if (nodeToSave.id === NEW_NODE_ID) {
        let node = await repository.create(nodeToSave);
        emit('updateNode', node);
        return;
    }

    let node = await repository.save(nodeToSave);
    emit('updateNode', node);
}


</script>