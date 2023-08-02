
var categoryApi = {
    async getCategoryItem() {
        const res = await fetch('/api/category/read',{
            method: 'GET',
            credentials: 'include',
            headers: {
                'Content-type': 'application/json',
            }
        })
        const result = await res.json();
        return result
    },
    async create({ name, description, image_url }) {
        const res = await fetch("http://localhost:3001/category/create", {
          method: "POST",
          credentials: "include",
          headers: {
            "Content-type": "application/json",
          },
          body: JSON.stringify({ name, description, image_url }),
        });
    
        const result = await res.json();
        console.log({name,description,image_url});
        return result;
      },
      async all() {
        const res = await fetch("/api/category/read", {
          method: "GET",
          headers: {
            "Content-type": "application/json"
          },
        });
        // console.log(await res);
        const result = await res.json();
        console.log(result);
        // console.log(result);
        // if (!result['data']?.length) return [];
    
        // return result['data'];
      }
    
}

export default categoryApi