<template>
    <div>
        <h1 class="mt-5">Employee</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Employee</li>
        </ol>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Create Class</h5>
                        <small class="text-muted float-end">Default label</small>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="handleForm">
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="form-label" for="name">Name <code>*</code></label>
                                    <input type="text" class="form-control" name="name" v-model="form.name"
                                        placeholder="Enter Your Name" />
                                    <p v-if="errors.name" class="text-danger">{{ errors.content[0] }}</p>
                                </div>
                                <div class="col-md">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" name="email" v-model="form.email"
                                        id="basic-default-company" placeholder="Enter Your Email" />
                                    <p v-if="errors.email" class="text-danger">{{ errors.content[0] }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md">
                                    <div class="col-md">
                                        <label class="form-label" for="salary">Salary</label>
                                        <input type="text" class="form-control" name="salary" v-model="form.salary"
                                            id="basic-default-company" placeholder="Enter Salary" />
                                        <p v-if="errors.salary" class="text-danger">{{ errors.salary[0] }}</p>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label class="form-label" for="salary_month">Salary Month</label>
                                    <select class="form-select" v-model="form.salary_month">
                                        <option value="Janaury">Janaury</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                    <p v-if="errors.salary_month" class="text-danger">{{ errors.salary_month[0] }}</p>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Pay Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                name: '',
                email: '',
                salary: '',
                salary_month: '',
            },
            errors: [],

        }
    },
    created() {
        axios.get(`/api/employee/${this.$route.params.id}`).then(({ data }) => (this.form = data)).catch();
    },
    methods: {
        async handleForm() {
            let data = new FormData();
            data.append('salary', this.form.salary);
            data.append('salary_month', this.form.salary_month);

            await axios.post(`/api/salary/paid/${this.$route.params.id}`, data)
                .then((result) => { this.$router.push('/given-salary') })
                .catch(error => {
                    if (error.response.data) {
                        this.errors = error.response.data.errors
                    }
                });
        },
    },

}
</script>
<style>
a {
    text-decoration: none;
    color: black
}
</style>
