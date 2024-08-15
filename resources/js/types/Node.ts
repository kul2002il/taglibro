
export default interface Node {
    id: number,
    name: string,
    type: string,
    content: string,
    createdAt: number,
    updatedAt: number,
}

export const NEW_NODE_ID = -1;

export function newNode(): Node {
    return {
        id: NEW_NODE_ID,
        name: '',
        type: 'text',
        content: '',
        createdAt: Date.now(),
        updatedAt: Date.now(),
    }
}
