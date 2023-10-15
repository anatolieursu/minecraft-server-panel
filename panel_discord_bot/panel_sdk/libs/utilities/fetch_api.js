class FetchAPI {
    async get(url) {
        try {
            const response = await fetch(url);
            if (!response.ok) {
                console.log(response)
                throw new Error('Cererea a eșuat');
            }
            return {
                "response": await response.json(),
                "status_code": response.status
            };
        } catch (error) {
            console.error('Eroare:', error);
            throw error; 
        }
    }
    async post(url, data) {
        const requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        };

        const response =  await fetch(url, requestOptions);
        if(response.ok) {
            return {
                "response": await response.json(),
                "status_code": response.status,
            }
        } else {
            return {
                "error_response": await response
            }
        }
    }
}

module.exports = FetchAPI;
