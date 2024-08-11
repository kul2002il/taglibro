
import Node from "@/types/Node";
import AbstractRepository from "@/api/AbstractRepository";

export default class NodeRepository extends AbstractRepository
{
    async loadAll(): Promise<Node[]>
    {
        return (await this.get('api/nodes')) as Node[];
    }
}
