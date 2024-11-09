<template>
    <div>
        <h1>{{ msg }}</h1>
        <NodeList :nodes="nodes"/>
    </div>
</template>

<script lang="ts">
import {defineComponent} from 'vue';
import NodeList from '@/components/NodeList.vue';
import Node from '@/types/Node';
import NodeRepository from '@/api/NodeRepository';

interface State {
    nodes: Node[],
}

export default defineComponent({
    name: 'App',
    components: {
        NodeList,
    },
    props: {
        msg: String,
    },
    data(): State {
        return {
            nodes: [],
        };
    },
    created(): void {
        (new NodeRepository())
        .loadAll()
        .then((nodes: Node[]) => this.nodes=nodes);
    },
});
</script>
