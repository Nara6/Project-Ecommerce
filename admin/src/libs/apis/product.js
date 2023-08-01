var productsApi = {
    async getAllProduct(cateforyId, itemId) {
        if(cateforyId == ""){
            const res = await fetch('http://localhost:3001/product/all',{
                method: 'GET',
                headers: {
                    'content-type': 'application/json',
                    origin: 'http://localhost:8080'
                }
            })
            const result = res.json();
            return result
        }else{
            const res = await fetch(`http://localhost:3001/product/all/${cateforyId}/${itemId}`,{
                method: 'GET',
                headers: {
                    'content-type': 'application/json',
                    origin: 'http://localhost:8080'
                }
            })
            const result = res.json();
            return result
        }
    },
    async create(formData) {
        // console.log(formData);
        const res = await fetch("http://localhost:3001/product/create", {
            method: "POST",
            credentials: "include",
            body: formData,
            // headers: {
            // "Content-type": "multipart/form-data",
            // }
        });

    const result = await res.json();
    return result;
    },
    async all() {
    const res = await fetch("http://localhost:3001/product/all", {
        method: "GET",
        credentials: "include",
        headers: {
        "Content-type": "application/json",
        Origin: "http://localhost:8080",
        },
    });

    const result = await res.json();
    if (!result?.length) return [];

    return result;
    },
    async getById(id){
        const res = await fetch(`http://localhost:3001/product/id/${id}`,{
            method: 'GET',
            credentials: "include",
            headers: {'Content-Type': 'application/json'},
            Origin: "http://localhost:8080",
        })
        const result = await res.json();
        // console.log(result);
        return result;
    }

}

export default productsApi;