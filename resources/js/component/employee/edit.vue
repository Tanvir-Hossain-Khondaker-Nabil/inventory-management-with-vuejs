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
                        <form @submit.prevent="handleForm" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="form-label" for="name">Name <code>*</code></label>
                                    <input type="text" class="form-control" name="name" v-model="form.name"
                                        placeholder="Enter Your Name" />
                                    <p v-if="errors.name" class="text-danger">{{ errors.content[0] }}</p>
                                </div>
                                <div class="col-md">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" class="form-control" name="email" v-model="form.email"
                                        id="basic-default-company" placeholder="Enter Your Email" />
                                    <p v-if="errors.email" class="text-danger">{{ errors.content[0] }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="form-label" for="phone">Mobile <code>*</code></label>
                                    <input type="text" class="form-control" name="phone" v-model="form.phone"
                                        placeholder="Enter Your Mobile" />
                                    <p v-if="errors.phone" class="text-danger">{{ errors.content[0] }}</p>
                                </div>
                                <div class="col-md">
                                    <label class="form-label" for="address">Address</label>
                                    <input type="text" class="form-control" name="address" v-model="form.address"
                                        id="basic-default-company" placeholder="Enter Your Address" />
                                    <p v-if="errors.address" class="text-danger">{{ errors.content[0] }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="form-label" for="phone">Mobile <code>*</code></label>
                                    <input type="number" class="form-control" name="nid" v-model="form.nid"
                                        placeholder="Enter Your NID" />
                                    <p v-if="errors.nid" class="text-danger">{{ errors.content[0] }}</p>
                                </div>
                                <div class="col-md">
                                    <label class="form-label" for="address">Address</label>
                                    <input type="date" class="form-control" name="address" v-model="form.joining_date"
                                        id="basic-default-company" placeholder="Enter Date" />
                                    <p v-if="errors.joining_date" class="text-danger">{{ errors.content[0] }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="form-label" for="image">Upload Image <code>*</code></label>
                                    <input type="file" class="form-control" name="photo" @change="fileUpload">
                                    <p v-if="errors.photo" class="text-danger">{{ errors.content[0] }}</p>
                                </div>
                                <div class="col-md">
                                    <label class="form-label" for="salary">Salary</label>
                                    <input type="text" class="form-control" name="salary" v-model="form.salary"
                                        id="basic-default-company" placeholder="Enter Salary" />
                                    <p v-if="errors.salary" class="text-danger">{{ errors.salary[0] }}</p>
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
                name: '',
                email: '',
                phone: '',
                address: '',
                salary: '',
                photo: '',
                nid: '',
                joining_date: '',

            },
            errors: [],

        }
    },
    created() {
        axios.get(`/api/employee/${this.$route.params.id}`).then(({ data }) => (this.form = data)).catch();
    },
    methods: {
        fileUpload(e) {
            this.form.photo = e.target.files[0];
        },
        async handleForm() {
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            let data = new FormData();
            data.append('photo', this.form.photo);
            data.append('name', this.form.name);
            data.append('email', this.form.email);
            data.append('phone', this.form.phone);
            data.append('address', this.form.address);
            data.append('salary', this.form.salary);
            data.append('nid', this.form.nid);
            data.append('joining_date', this.form.joining_date);
            data.append('_method', 'put');

            await axios.post(`/api/employee/${this.$route.params.id}`, data, config)
                .then((result) => { this.$router.push('/employee') })
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
