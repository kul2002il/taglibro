<template>
    <div class="flex flex-row justify-stretch space-x-4 h-full p-6">
        <NodeList :nodes="nodes" @select-node="selectNode" @create-node="createNode"/>
        <NodeEditor :node="editNode" @update-node="updateNode"/>
    </div>
</template>

<script lang="ts">

import {defineComponent} from 'vue';
import NodeList from '@/components/NodeList.vue';
import { Node, NEW_NODE_ID, newNode } from '@/types/Node';
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
        createNode(): void {
            this.editNode = newNode();
        },
        selectNode(id: number): void {
            this.editNode = this.nodes.find((e: Node) => e.id === id) || null;
        },
        updateNode(updatedNode: Node): void {
            let index = this.nodes.findIndex(
                (node: Node) => node.id === updatedNode.id
            );

            if (index === -1) {
                this.nodes.push(updatedNode);
            } else {
                this.nodes[index] = updatedNode;
            }

            this.sortNodes();
        },
        sortNodes(): void {
            this.nodes.sort(
                (a: Node, b: Node) => {
                    if (a.updatedAt > b.updatedAt) {
                        return -1;
                    }
                    if (a.updatedAt < b.updatedAt) {
                        return 1;
                    }
                    return 0;
                }
            );
        },
    },
});
</script>
