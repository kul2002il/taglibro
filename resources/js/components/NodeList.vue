<template>
    <div class="container max-w-sm p-4 rounded-2xl bg-white">
        <h2 class="mb-4 font-bold">Последние</h2>
        <ul>
            <li class="mb-2" v-for="node in nodes" :key="node.id">{{node.content}}</li>
        </ul>
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
    }
});

</script>
