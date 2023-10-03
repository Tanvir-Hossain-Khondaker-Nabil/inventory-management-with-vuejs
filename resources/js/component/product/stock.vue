<template>
    <div>
        <h1 class="mt-5">Stock</h1>

        <div class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Stock</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Product List</h5>
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
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Buying Price</th>
                                    <th>Status</th>
                                    <th>Category Name</th>
                                    <th>Product Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in filtersearch" :key="product.id">
                                    <td>{{ product.id }}</td>
                                    <td>
                                        <img :src="product.photo" class="img-thumbnail" style="
                        height: 45px;
                        width: 45px;
                        object-fit: cover;
                        border-radius: 100%;
                      " alt="" />
                                    </td>
                                    <td>{{ product.product_name }}</td>
                                    <td>{{ product.product_code }}</td>
                                    <td>{{ product.buying_price }}</td>
                                    <td v-if="product.product_quantity >= 1"><span
                                            class="badge text-bg-success">Availble</span></td>
                                    <td v-else><span class="badge text-bg-danger">Stock Out</span></td>
                                    <td>{{ product.category.category_name }}</td>
                                    <td>{{ product.product_quantity }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <router-link :to="{ name: 'editproduct', params: { id: product.id } }"
                                                class="btn btn-sm btn-warning"><i
                                                    class="fa-solid fa-edit"></i></router-link>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="card-footer"></div> -->
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            products: {},
            search: "",
        };
    },
    computed: {
        filtersearch() {
            return this.products.filter((product) => {
                return product.product_name.match(this.search);
            });
        },
    },
    methods: {
        async allProduct() {
            await axios
                .get("/api/product/")
                .then(({ data }) => (this.products = data))
                .catch();
        },
        async editProduct(id) {
            await axios.update("/api/product/" + id).then().catch()
        }
    },
    created() {
        this.allProduct();
    },
};
</script>
<style>
a {
    text-decoration: none;
    color: black;
}
</style>
