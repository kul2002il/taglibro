<template>
    <div class="hello">
        <h1>{{ msg }}</h1>
        <NodesList :nodes="nodes"/>
    </div>
</template>

<script lang="ts">
import {defineComponent} from 'vue';
import NodesList from '@/components/NodesList.vue';
import Node from '@/types/Node';
import NodeRepository from '@/api/NodeRepository';

interface State {
    nodes: Node[],
}

export default defineComponent({
    name: 'App',
    components: {
        NodesList,
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

<style scoped>

</style>
