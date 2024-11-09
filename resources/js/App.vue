<template>
    <div class="flex flex-row justify-stretch space-x-4 h-full p-6">
        <NodeList :nodes="nodes"/>
        <NodeEditor :node="nodes[0]"/>
    </div>
</template>

<script lang="ts">

import {defineComponent} from 'vue';
import NodeList from '@/components/NodeList.vue';
import Node from '@/types/Node';
import NodeRepository from '@/api/NodeRepository';
import NodeEditor from '@/components/NodeEditor.vue';

interface State {
    nodes: Node[],
}

export default defineComponent({
    name: 'App',
    components: {
        NodeList,
        NodeEditor,
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
