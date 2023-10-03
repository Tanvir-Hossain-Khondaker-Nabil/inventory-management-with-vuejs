<template>
    <div>
        <h1 class="mt-5">Category</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Category</li>
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
                                <label class="form-label" for="category_name">Category Name <code>*</code></label>
                                <input type="text" class="form-control" name="category_name" v-model="form.name"
                                    placeholder="Enter Your Name" />
                                <p v-if="errors.category_name" class="text-danger">{{ errors.content[0] }}</p>
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
                name: '',
            },
            errors: [],

        }
    },
    methods: {
        async handleForm() {
            let data = new FormData();
            data.append('category_name', this.form.name);

            await axios.post('/api/category/', data)
                .then((result) => { this.$router.push('/category') })
                .catch(error => {
                    if (error.response.data) {
                        this.errors = error.response.data.errors
                    }
                });


        },
    }
}
</script>
<style>
a {
    text-decoration: none;
    color: black
}
</style>
