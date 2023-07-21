const auth = {
    async login(url,formData){
        const res = await fetch(url,{
            method: "POST",
            headers: {
                "Content-type": "application/json",
            },
            // credentials: "include",
            body: formData
        });
        const result = await res.json();
        console.log(result);
    }
}
export default auth