
export default abstract class AbstractRepository {
    basePath: string = window.location.origin + '/';

    async get(path: string): Promise<Object | Object[]>
    {
        let response = await fetch(this.basePath + path);
        return (await response.json()).data;
    }

    async postJson(path: string, body: Object): Promise<Object | Object[]>
    {
        let response = await fetch(this.basePath + path, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(body),
        });
        return (await response.json()).data;
    }

    async putJson(path: string, body: Object): Promise<Object | Object[]>
    {
        let response = await fetch(this.basePath + path, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(body),
        });
        return (await response.json()).data;
    }
}

