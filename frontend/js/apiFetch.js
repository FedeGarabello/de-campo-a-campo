const apiFetch = async (endpoint, method, body = null) => {

    const url = `http://localhost:8080/api/v1${endpoint}`;

    const requestBody = (body) ? JSON.stringify(body) : null

    const resp = await fetch(url, {method, body: requestBody});
    const data = await resp.json();

    return data;
};