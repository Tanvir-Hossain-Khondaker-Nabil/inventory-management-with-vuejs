<template>
    <div>
        <h1 class="mt-5">Employee</h1>

        <div class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Employee</li>
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
                                    <th>Salary</th>
                                    <th>NID</th>
                                    <th>Joining Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="employee in filtersearch" :key="employee.id">
                                    <td>{{ employee.id }}</td>
                                    <td>
                                        <img :src="employee.photo" class="img-thumbnail" style="
                        height: 45px;
                        width: 45px;
                        object-fit: cover;
                        border-radius: 100%;
                      " alt="" />
                                    </td>
                                    <td>{{ employee.name }}</td>
                                    <td>{{ employee.email }}</td>
                                    <td>{{ employee.phone }}</td>
                                    <td>{{ employee.address }}</td>
                                    <td>{{ employee.salary }}</td>
                                    <td>{{ employee.nid }}</td>
                                    <td>{{ employee.joining_date }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <router-link :to="{ name: 'editemployee', params: { id: employee.id } }"
                                                class="btn btn-sm btn-warning"><i
                                                    class="fa-solid fa-edit"></i></router-link>
                                            <button @click="deleteEmployee(employee.id)" type="button" data-id=""
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
                    <router-link to="/employee/create" class="btn btn-primary btn-md">
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
            employees: {},
            search: "",
        };
    },
    computed: {
        filtersearch() {
            return this.employees.filter((employee) => {
                return employee.name.match(this.search);
            });
        },
    },
    methods: {
        async allEmployee() {
            await axios
                .get("/api/employee/")
                .then(({ data }) => (this.employees = data))
                .catch();
        },
        async deleteEmployee(id) {
            await axios
                .delete("/api/employee/" + id)
                .then(() => {
                    this.employees = this.employees.filter(employee => {
                        return employee.id != id
                    })
                })
                .catch(() => {
                    this.$router.push("/employee");
                });
        },
        async editEmployee(id) {
            await axios.update("/api/employee/" + id).then().catch()
        }
    },
    created() {
        this.allEmployee();
    },
};
</script>
<style>
a {
    text-decoration: none;
    color: black;
}
</style>
