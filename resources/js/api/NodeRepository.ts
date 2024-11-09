
import type {Node} from "@/types/Node";
import AbstractRepository from "@/api/AbstractRepository";

export default class NodeRepository extends AbstractRepository
{
    async list(): Promise<Node[]>
    {
        return (await this.get('api/nodes')) as Node[];
    }

    async getOne(id: number): Promise<Node>
    {
        return (await this.get('api/nodes/' + id)) as Node;
    }

    async create(node: Node): Promise<Node>
    {
        return (await this.postJson('api/nodes', node)) as Node;
    }

    async save(node: Node): Promise<Node>
    {
        return (await this.putJson('api/nodes/' + node.id, node)) as Node;
    }
}
