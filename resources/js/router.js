import { createWebHistory, createRouter } from "vue-router";

// supplier components
import supplier from "./component/supplier/index.vue";
import storesupplier from "./component/supplier/create.vue";
import editsupplier from "./component/supplier/edit.vue";
// category components
import category from "./component/category/index.vue";
import storecategory from "./component/category/create.vue";
import editcategory from "./component/category/edit.vue";
// customer components
import customer from "./component/customer/index.vue";
import storecustomer from "./component/customer/create.vue";
import editcustomer from "./component/customer/edit.vue";
// expense components
import expense from "./component/expense/index.vue";
import storeexpense from "./component/expense/create.vue";
import editexpense from "./component/expense/edit.vue";
// employee components
import employee from "./component/employee/index.vue";
import storeemployee from "./component/employee/create.vue";
import editemployee from "./component/employee/edit.vue";
// product components
import product from "./component/product/index.vue";
import storeproduct from "./component/product/create.vue";
import editproduct from "./component/product/edit.vue";
// salary components
import salary from "./component/salary/all_employee.vue";
import paysalary from "./component/salary/create.vue";
import allsalary from "./component/salary/index.vue";
import viewsalary from "./component/salary/view.vue";
import editsalary from "./component/salary/edit.vue";
// salary components
import stock from "./component/product/stock.vue";

const history = createWebHistory();
const routes = [
    // supplier router

    {
        path: "/supplier",
        component: supplier,
    },
    {
        path: "/supplier/create",
        component: storesupplier,
    },
    {
        path: "/supplier/edit/:id",
        component: editsupplier,
        name: "editsupplier",
    },

    // category router

    {
        path: "/category",
        component: category,
    },
    {
        path: "/category/create",
        component: storecategory,
    },
    {
        path: "/category/edit/:id",
        component: editcategory,
        name: "editcategory",
    },

    // customer router

    {
        path: "/customer",
        component: customer,
    },
    {
        path: "/customer/create",
        component: storecustomer,
    },
    {
        path: "/customer/edit/:id",
        component: editcustomer,
        name: "editcustomer",
    },

    // expense router

    {
        path: "/expense",
        component: expense,
    },
    {
        path: "/expense/create",
        component: storeexpense,
    },
    {
        path: "/expense/edit/:id",
        component: editexpense,
        name: "editexpense",
    },

    // employee router

    {
        path: "/employee",
        component: employee,
    },
    {
        path: "/employee/create",
        component: storeemployee,
    },
    {
        path: "/employee/edit/:id",
        component: editemployee,
        name: "editemployee",
    },

    // product router

    {
        path: "/product",
        component: product,
    },
    {
        path: "/product/create",
        component: storeproduct,
    },
    {
        path: "/product/edit/:id",
        component: editproduct,
        name: "editproduct",
    },

    // salary router

    {
        path: "/given-salary",
        component: salary,
    },
    {
        path: "/pay-salary/:id",
        component: paysalary,
    },
    {
        path: "/salary",
        component: allsalary,
    },
    {
        path: "/view-salary/:id",
        component: viewsalary,
        name: "view-salary",
    },
    {
        path: "/edit-salary/:id",
        component: editsalary,
        name: "edit-salary",
    },
    // salary router

    {
        path: "/stock",
        component: stock,
    },
];
const router = createRouter({
    history,
    routes,
});
export default router;
