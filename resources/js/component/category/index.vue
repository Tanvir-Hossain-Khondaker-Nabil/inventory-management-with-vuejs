<template>
    <div>
        <h1 class="mt-5">Category</h1>

        <div class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">category</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Category List</h5>
                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <input type="text" name="table_search" v-model="search" class="form-control float-right"
                                    placeholder="Search" />
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="category in filtersearch" :key="category.id">
                                    <td>{{ category.id }}</td>
                                    <td>{{ category.category_name }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <router-link :to="{ name: 'editcategory', params: { id: category.id } }"
                                                class="btn btn-sm btn-warning"><i
                                                    class="fa-solid fa-edit"></i></router-link>
                                            <button @click="deleteCatagory(category.id)" type="button" data-id=""
                                                class="delete btn btn-sm btn-danger mx-1">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="card-footer"></div> -->
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="col-12 my-5">
                    <router-link to="/category/create" class="btn btn-primary btn-md">
                        ➥ Create
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            categories: {},
            search: "",
        };
    },
    computed: {
        filtersearch() {
            return this.categories.filter((category) => {
                return category.category_name.match(this.search);
            });
        },
    },
    methods: {
        async allCategory() {
            await axios.get("/api/category/").then(({ data }) => (this.categories = data))
                .catch();
        },
        async deleteCatagory(id) {
            await axios
                .delete("/api/category/" + id)
                .then(() => {
                    this.categories = this.categories.filter(category => {
                        return category.id != id
                    })
                })
                .catch(() => {
                    this.$router.push("/category");
                });
        },
        async editCategory(id) {
            await axios.update("/api/category/" + id).then().catch()
        }
    },
    created() {
        this.allCategory();
    },
};
</script>
<style>
a {
    text-decoration: none;
    color: black;
}
</style>
