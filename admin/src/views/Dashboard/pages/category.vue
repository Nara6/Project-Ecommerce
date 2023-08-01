<script >
import categoryApi from "@/libs/apis/category";
export default {
  data() {
    return {
      categories: [],
      name: "",
      description: "",
      image_url: "",
    };
  },
  methods: {
    async onSubmit(e) {
      e.preventDefault();
      const { name, description, image_url } = this;
      console.log(this.name,this.description,this.image_url);
      const result = await categoryApi.create({ name, description, image_url });
      if (!result) {
        alert(result.error);
        return;
      }

      this.categories = await categoryApi.all();
      this.name = this.description = this.image_url = "";
    },
  },
  async mounted() {
    this.categories = await categoryApi.all();
    console.log(this.categories);
  },
};
</script>

<template >
  <main>
    <div class="bg-gray-500 text-white py-2 text-lg text-center">
      <h1>Category</h1>
    </div>

    <div class="py-2">
      <form @submit="onSubmit" method="post">
        <div class="flex flex-row py-2 px-2 space-x-2 bg-gray-100">
          <div>
            <input
              v-model="name"
              name="name"
              type="text"
              placeholder="Name"
              required
            />
          </div>
          <div>
            <input
              v-model="description"
              name="desc"
              type="text"
              placeholder="Description"
              required
            />
          </div>
          <div>
            <input
              v-model="image_url"
              name="imageUrl"
              type="text"
              placeholder="ImageURL"
              required
            />
          </div>
          <div>
            <button
              type="submit"
              class="bg-blue-500 text-white p-1 px-2 rounded-md"
            >
              Add new
            </button>
          </div>
        </div>
      </form>
    </div>
    <div>
      <table id="customers">
        <tr class="bg-gray-200">
          <th>Name</th>
          <th>Description</th>
          <th>ImageURL</th>
        </tr>

        <tr v-for="cate in categories" :key="cate.name">
          <td>{{ cate.name }}</td>
          <td>{{ cate.description }}</td>
          <td>{{ cate.image_url }}</td>
        </tr>
      </table>
    </div>
  </main>
</template>

<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td,
#customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even) {
  background-color: #f2f2f2;
}

#customers tr:hover {
  background-color: #ddd;
}
</style>