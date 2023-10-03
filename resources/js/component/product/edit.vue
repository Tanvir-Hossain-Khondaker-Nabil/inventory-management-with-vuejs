<template>
    <div>
        <h1 class="mt-5">Product</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Product</li>
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
                                    <label class="form-label" for="name">Product Name <code>*</code></label>
                                    <input type="text" class="form-control" name="product_name" v-model="form.product_name"
                                        placeholder="Enter Your Product Name" />
                                    <p v-if="errors.product_name" class="text-danger">{{ errors.content[0] }}</p>
                                </div>
                                <div class="col-md">
                                    <label class="form-label" for="email">Product Code</label>
                                    <input type="number" class="form-control" name="product_code"
                                        v-model="form.product_code" id="basic-default-company"
                                        placeholder="Enter Your Email" />
                                    <p v-if="errors.product_code" class="text-danger">{{ errors.content[0] }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="form-label" for="phone">Buying Price <code>*</code></label>
                                    <input type="text" class="form-control" name="buying_price" v-model="form.buying_price"
                                        placeholder="Enter Your Buying Price" />
                                    <p v-if="errors.buying_price" class="text-danger">{{ errors.buying_price[0] }}</p>
                                </div>
                                <div class="col-md">
                                    <label class="form-label" for="address">Selling Price</label>
                                    <input type="text" class="form-control" name="selling_price"
                                        v-model="form.selling_price" id="basic-default-company"
                                        placeholder="Enter Your Selling Price" />
                                    <p v-if="errors.selling_price" class="text-danger">{{ errors.content[0] }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="form-label" for="phone">Root <code>*</code></label>
                                    <input type="number" class="form-control" name="root" v-model="form.root"
                                        placeholder="Enter Your root" />
                                    <p v-if="errors.root" class="text-danger">{{ errors.root[0] }}</p>
                                </div>
                                <div class="col-md">
                                    <label class="form-label" for="address">Buying Date</label>
                                    <input type="date" class="form-control" name="buying_date" v-model="form.buying_date"
                                        id="basic-default-company" placeholder="Enter Your Buying Date" />
                                    <p v-if="errors.buying_date" class="text-danger">{{ errors.content[0] }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="form-label" for="phone">Category <code>*</code></label>
                                    <select name="category_id" id="" class="form-select" v-model="form.category_id">
                                        <option value="">Select Category</option>
                                        <option v-for="category in categories" :key="category.id"
                                            v-bind:value="category.id">
                                            {{ category.category_name }}
                                        </option>
                                    </select>
                                    <p v-if="errors.category_id" class="text-danger">{{ errors.category_id[0] }}</p>
                                </div>
                                <div class="col-md">
                                    <label class="form-label" for="phone">supplier <code>*</code></label>
                                    <select name="supplier_id" id="" class="form-select" v-model="form.supplier_id">
                                        <option value="">Select Supplier</option>
                                        <option v-for="supplier in suppliers" :key="supplier.id" v-bind:value="supplier.id">
                                            {{ supplier.name }}
                                        </option>
                                    </select>
                                    <p v-if="errors.supplier_id" class="text-danger">{{ errors.supplier_id[0] }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label class="form-label" for="image">Upload Image <code>*</code></label>
                                    <input type="file" class="form-control" name="photo" @change="fileUpload">
                                    <p v-if="errors.photo" class="text-danger">{{ errors.content[0] }}</p>

                                </div>
                                <div class="col-md">
                                    <label class="form-label" for="shopname">Product Quantity</label>
                                    <input type="text" class="form-control" name="product_quantity"
                                        v-model="form.product_quantity" id="basic-default-company"
                                        placeholder="Enter Your Product Quantity" />
                                    <p v-if="errors.product_quantity" class="text-danger">{{ errors.product_quantity[0] }}
                                    </p>
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
                product_name: '',
                product_code: '',
                buying_price: '',
                selling_price: '',
                buying_date: '',
                photo: '',
                root: '',
                product_quantity: '',
                category_id: '',
                supplier_id: '',

            },
            errors: [],
            categories: {},
            suppliers: {},

        }
    },
    created() {
        axios.get(`/api/product/${this.$route.params.id}`).then(({ data }) => (this.form = data)).catch();
        axios.get('/api/category/').then(({ data }) => (this.categories = data))
        axios.get('/api/supplier/').then(({ data }) => (this.suppliers = data))
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
            data.append('product_name', this.form.product_name);
            data.append('product_code', this.form.product_code);
            data.append('buying_price', this.form.buying_price);
            data.append('buying_date', this.form.buying_date);
            data.append('selling_price', this.form.selling_price);
            data.append('photo', this.form.photo);
            data.append('root', this.form.root);
            data.append('product_quantity', this.form.product_quantity);
            data.append('category_id', this.form.category_id);
            data.append('supplier_id', this.form.supplier_id);
            data.append('_method', 'put');

            await axios.post(`/api/product/${this.$route.params.id}`, data, config)
                .then((result) => { this.$router.push('/product') })
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
