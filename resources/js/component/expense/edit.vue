<template>
    <div>
        <h1 class="mt-5">Supplier</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Supplier</li>
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
                            <div class="mb-3">
                                <label class="form-label" for="phone">Details <code>*</code></label>
                                <textarea id="" cols="30" rows="10" class="form-control" v-model="form.details"
                                    placeholder="Enter Your Details"></textarea>
                                <p v-if="errors.details" class="text-danger">{{ errors.content[0] }}</p>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="form-label" for="address">Amount</label>
                                    <input type="number" class="form-control" v-model="form.amount"
                                        id="basic-default-company" placeholder="Enter Your Address" />
                                    <p v-if="errors.amount" class="text-danger">{{ errors.content[0] }}</p>
                                </div>
                                <div class="col-md">
                                    <label class="form-label" for="address">Expense Date</label>
                                    <input type="date" class="form-control" v-model="form.expense_date"
                                        id="basic-default-company" placeholder="Enter Expense Date" />
                                    <p v-if="errors.expense_date" class="text-danger">{{ errors.content[0] }}</p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Submit
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
                details: '',
                amount: '',
                expense_date: '',
            },
            errors: [],

        }
    },
    created() {
        axios.get(`/api/expense/${this.$route.params.id}`).then(({ data }) => (this.form = data)).catch();
    },
    methods: {
        async handleForm() {

            let data = new FormData();
            data.append('details', this.form.details);
            data.append('amount', this.form.amount);
            data.append('expense_date', this.form.expense_date);
            data.append('_method', 'put');

            await axios.post(`/api/expense/${this.$route.params.id}`, data)
                .then((result) => { this.$router.push('/expense') })
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
