<template>
    <ul>
        <li v-for="node in nodes" :key="node.id">{{node.content}}</li>
    </ul>
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
