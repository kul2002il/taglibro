<template>
    <div v-if="node" class="container p-4 rounded-2xl bg-white">
        <ContentEditable is="h1"  class="text-xl mb-4" @focusout="save" v-model="node.name"></ContentEditable>
        <ContentEditable is="div" class="font-mono"    @focusout="save" v-model="node.content"></ContentEditable>
    </div>
    <div v-else class="container p-4 rounded-2xl">
        <h1 class="text-xl mb-4">Нет выбранной заметки</h1>
        <div>
            Выберите заметку из меню слева.
        </div>
    </div>
</template>

<script lang="ts">

import NodeRepository from '@/api/NodeRepository';
import ContentEditable from '@/components/ContentEditable.vue';
import Node from '@/types/Node';
import {defineComponent, PropType} from 'vue';

export default defineComponent({
    name: "NodeEditor",
    components: {
        ContentEditable,
    },
    props: {
        node: {
            type: Object as PropType<Node|null>,
            required: false,
        }
    },
    methods: {
        save(): void {
            if (!this.node) {
                return;
            }

            (new NodeRepository()).save(this.node);
        },
    },
});

</script>