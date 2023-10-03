<template>
    <div>
        <h1 class="mt-5">Expense</h1>

        <div class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">expense</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Expense List</h5>
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
                                    <th>Details</th>
                                    <th>Amount</th>
                                    <th>Expense Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="expense in filtersearch" :key="expense.id">
                                    <td>{{ expense.id }}</td>
                                    <td>{{ expense.details }}</td>
                                    <td>{{ expense.amount }}</td>
                                    <td>{{ expense.expense_date }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <router-link :to="{ name: 'editexpense', params: { id: expense.id } }"
                                                class="btn btn-sm btn-warning"><i
                                                    class="fa-solid fa-edit"></i></router-link>
                                            <button @click="deleteExpense(expense.id)" type="button" data-id=""
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
                    <router-link to="/expense/create" class="btn btn-primary btn-md">
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
            expenses: {},
            search: "",
        };
    },
    computed: {
        filtersearch() {
            return this.expenses.filter((expense) => {
                return expense.expense_date.match(this.search);
            });
        },
    },
    methods: {
        async allExpense() {
            await axios.get("/api/expense/").then(({ data }) => (this.expenses = data))
                .catch();
        },
        async deleteExpense(id) {
            await axios
                .delete("/api/expense/" + id)
                .then(() => {
                    this.expenses = this.expenses.filter(expense => {
                        return expense.id != id
                    })
                })
                .catch(() => {
                    this.$router.push("/expense");
                });
        },
        async editExpense(id) {
            await axios.update("/api/expense/" + id).then().catch()
        }
    },
    created() {
        this.allExpense();
    },
};
</script>
<style>
a {
    text-decoration: none;
    color: black;
}
</style>
