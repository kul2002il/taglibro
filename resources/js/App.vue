<template>
    <div class="flex flex-row justify-stretch space-x-4 h-full p-6">
        <NodeList :nodes="nodes" @select-node="selectNode"/>
        <NodeEditor :node="editNode"/>
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
    editNode: Node|null
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
            editNode: null,
        };
    },
    created(): void {
        (new NodeRepository())
        .list()
        .then((nodes: Node[]) => this.nodes=nodes);
    },
    methods: {
        selectNode(id: number): void {
            this.editNode = this.nodes.find(e => e.id === id) || null;
        }
    }
});
</script>
