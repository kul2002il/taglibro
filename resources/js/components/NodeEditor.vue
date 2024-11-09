<template>
    <div v-if="node" class="container p-4 rounded-2xl bg-white">
        <h1 class="text-xl mb-4">Название заметки</h1>
        <div class="font-mono">{{ node.content }}</div>
    </div>
    <div v-else class="container p-4 rounded-2xl">
        <h1 class="text-xl mb-4">Нет выбранной заметки</h1>
        <div>
            Выберите заметку из меню слева.
        </div>
    </div>
</template>

<script lang="ts">

import Node from '@/types/Node';
import {defineComponent, PropType} from 'vue';

export default defineComponent({
    name: "NodeEditor",
    props: {
        node: {
            type: Object as PropType<Node>,
            required: false,
        }
    }
});

</script>