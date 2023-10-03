<template>
    <div>
        <h1 class="mt-5">Supplier</h1>

        <div class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Supplier</li>
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
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Shop Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="supplier in filtersearch" :key="supplier.id">
                                    <td>{{ supplier.id }}</td>
                                    <td>
                                        <img :src="supplier.photo" class="img-thumbnail" style="
                        height: 60px;
                        width: 60px;
                        object-fit: cover;
                        border-radius: 100%;
                      " alt="" />
                                    </td>
                                    <td>{{ supplier.name }}</td>
                                    <td>{{ supplier.email }}</td>
                                    <td>{{ supplier.phone }}</td>
                                    <td>{{ supplier.address }}</td>
                                    <td>{{ supplier.shopname }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <router-link :to="{ name: 'editsupplier', params: { id: supplier.id } }"
                                                class="btn btn-sm btn-warning"><i
                                                    class="fa-solid fa-edit"></i></router-link>
                                            <button @click="deleteSupplier(supplier.id)" type="button" data-id=""
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
                    <router-link to="/supplier/create" class="btn btn-primary btn-md">
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
            suppliers: {},
            search: "",
        };
    },
    computed: {
        filtersearch() {
            return this.suppliers.filter((supplier) => {
                return supplier.name.match(this.search);
            });
        },
    },
    methods: {
        async allSupplier() {
            await axios
                .get("/api/supplier/")
                .then(({ data }) => (this.suppliers = data))
                .catch();
        },
        async deleteSupplier(id) {
            await axios
                .delete("/api/supplier/" + id)
                .then(() => {
                    this.suppliers = this.suppliers.filter(supplier => {
                        return supplier.id != id
                    })
                })
                .catch(() => {
                    this.$router.push("/supplier");
                });
        },
        async editSupplier(id) {
            await axios.update("/api/supplier/" + id).then().catch()
        }
    },
    created() {
        this.allSupplier();
    },
};
</script>
<style>
a {
    text-decoration: none;
    color: black;
}
</style>
