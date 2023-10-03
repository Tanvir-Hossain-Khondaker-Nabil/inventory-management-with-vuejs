<template>
    <div>
        <h1 class="mt-5">Salary</h1>

        <div class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Salary Salary Pay</li>
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
                                    <th>Name</th>
                                    <th>Month</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="salary in filtersearch" :key="salary.id">
                                    <td>{{ salary.id }}</td>
                                    <td>{{ salary.employee.name }}</td>
                                    <td>{{ salary.salary_month }}</td>
                                    <td>{{ salary.amount }}</td>
                                    <td>{{ salary.salary_date }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <router-link :to="{ name: 'edit-salary', params: { id: salary.id } }"
                                                class="btn btn-sm btn-warning">Edit Salary</router-link>
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
                    <!-- <router-link to="/salary/create" class="btn btn-primary btn-md">
                        ➥ Create
                    </router-link> -->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            salaries: {},
            search: "",
        };
    },
    computed: {
        filtersearch() {
            return this.salaries.filter((salary) => {
                return salary.employee.name.match(this.search);
            });
        },
    },
    methods: {
        async viewSalary() {
            await axios.get(`/api/salary/view/${this.$route.params.id}`)
                .then(({ data }) => (this.salaries = data))
                .catch(error => {
                    if (error.response.data) {
                        this.errors = error.response.data.errors
                    }
                });
        },
        // async editEmployee(id) {
        //     await axios.update("/api/salary/" + id).then().catch()
        // }
    },
    created() {
        this.viewSalary();
    },
};
</script>
<style>
a {
    text-decoration: none;
    color: black;
}
</style>
