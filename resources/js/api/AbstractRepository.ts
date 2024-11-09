
export default abstract class AbstractRepository {
    basePath: string = window.location.origin + '/';

    async get(path: string): Promise<Object | Object[]>
    {
        let response = await fetch(this.basePath + path);
        return (await response.json()).data;
    }
}

