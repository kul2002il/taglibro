<template>
    <div class="container max-w-sm p-4 rounded-2xl bg-white">
        <h2 class="mb-4 font-bold">Последние</h2>
        <div class="mb-3 text-gray-600" @click="$emit('createNode')">+ Новая заметка</div>
        <TransitionGroup name="list" tag="ul">
            <li class="mb-2" v-for="node in nodes" :key="node.id" @click="$emit('selectNode', node.id)">• {{node.name}}</li>
        </TransitionGroup>
    </div>
</template>

<script lang="ts">

import {defineComponent, PropType} from 'vue';
import Node from '@/types/Node';

export default defineComponent({
    name: "NodesList",
    props: {
        nodes: {
            type: Array as PropType<Node[]>,
            required: true,
        }
    },
    emits: {
        selectNode: (id: number) => Number.isInteger(id),
        createNode: () => true,
    },
});

</script>

<style scoped>

.list-move,
.list-enter-active,
.list-leave-active {
  transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}

.list-leave-active {
  position: absolute;
}

</style>
