<template>
    <div>
        <h1 class="mt-5">Customer</h1>

        <div class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Customer</li>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="customer in filtersearch" :key="customer.id">
                                    <td>{{ customer.id }}</td>
                                    <td>
                                        <img :src="customer.photo" class="img-thumbnail" style="
                        height: 60px;
                        width: 60px;
                        object-fit: cover;
                        border-radius: 100%;
                      " alt="" />
                                    </td>
                                    <td>{{ customer.name }}</td>
                                    <td>{{ customer.email }}</td>
                                    <td>{{ customer.phone }}</td>
                                    <td>{{ customer.address }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <router-link :to="{ name: 'editcustomer', params: { id: customer.id } }"
                                                class="btn btn-sm btn-warning"><i
                                                    class="fa-solid fa-edit"></i></router-link>
                                            <button @click="deleteCustomer(customer.id)" type="button" data-id=""
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
                    <router-link to="/customer/create" class="btn btn-primary btn-md">
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
            customers: {},
            search: "",
        };
    },
    computed: {
        filtersearch() {
            return this.customers.filter((customer) => {
                return customer.name.match(this.search);
            });
        },
    },
    methods: {
        async allSupplier() {
            await axios
                .get("/api/customer/")
                .then(({ data }) => (this.customers = data))
                .catch();
        },
        async deleteCustomer(id) {
            await axios
                .delete("/api/customer/" + id)
                .then(() => {
                    this.customers = this.customers.filter(customer => {
                        return customer.id != id
                    })
                })
                .catch(() => {
                    this.$router.push("/customer");
                });
        },
        async editSupplier(id) {
            await axios.update("/api/customer/" + id).then().catch()
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
