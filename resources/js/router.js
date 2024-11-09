import { createWebHistory, createRouter } from 'vue-router'

import NodeEditor from '@/components/NodeEditor.vue';

const routes = [
    {
        name: 'node',
        path: '/app/node/:id',
        component: NodeEditor
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router
