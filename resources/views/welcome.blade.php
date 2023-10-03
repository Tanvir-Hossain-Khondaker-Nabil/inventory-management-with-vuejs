<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - SB Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>

<body class="sb-nav-fixed">
    <div id="app">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
                <i class="fas fa-bars"></i>
            </button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                        aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="#!">Settings</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#!">Activity Log</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item" href="#!">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">       
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#employee" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                Employee
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="collapse" id="employee" aria-labelledby="headingTwo"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <router-link to="/employee/create"  class="nav-link collapsed">
                                        Create
                                        <div class="sb-sidenav-collapse-arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                    </router-link> 
                                    <router-link to="/employee"  class="nav-link collapsed">
                                        Index
                                        <div class="sb-sidenav-collapse-arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                    </router-link>
                                </nav>
                            </div>                     
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#supplier" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                Supplier
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="collapse" id="supplier" aria-labelledby="headingTwo"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <router-link to="/supplier/create"  class="nav-link collapsed">
                                        Create
                                        <div class="sb-sidenav-collapse-arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                    </router-link> 
                                    <router-link to="/supplier"  class="nav-link collapsed">
                                        Index
                                        <div class="sb-sidenav-collapse-arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                    </router-link>
                                </nav>
                            </div>                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#category" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                Category
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="collapse" id="category" aria-labelledby="headingTwo"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <router-link to="/category/create"  class="nav-link collapsed">
                                        Create
                                        <div class="sb-sidenav-collapse-arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                    </router-link> 
                                    <router-link to="/category"  class="nav-link collapsed">
                                        Index
                                        <div class="sb-sidenav-collapse-arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                    </router-link>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#customer" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                Customer
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="collapse" id="customer" aria-labelledby="headingTwo"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <router-link to="/customer/create"  class="nav-link collapsed">
                                        Create
                                        <div class="sb-sidenav-collapse-arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                    </router-link> 
                                    <router-link to="/customer"  class="nav-link collapsed">
                                        Index
                                        <div class="sb-sidenav-collapse-arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                    </router-link>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#expense" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                Expense
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="collapse" id="expense" aria-labelledby="headingTwo"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <router-link to="/expense/create"  class="nav-link collapsed">
                                        Create
                                        <div class="sb-sidenav-collapse-arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                    </router-link> 
                                    <router-link to="/expense"  class="nav-link collapsed">
                                        Index
                                        <div class="sb-sidenav-collapse-arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                    </router-link>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#product" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                Product
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="collapse" id="product" aria-labelledby="headingTwo"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <router-link to="/product/create"  class="nav-link collapsed">
                                        Create
                                        <div class="sb-sidenav-collapse-arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                    </router-link> 
                                    <router-link to="/product"  class="nav-link collapsed">
                                        Index
                                        <div class="sb-sidenav-collapse-arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                    </router-link>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#salary" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                Salary
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="collapse" id="salary" aria-labelledby="headingTwo"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <router-link to="/given-salary"  class="nav-link collapsed">
                                        Pay Salary
                                        <div class="sb-sidenav-collapse-arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                    </router-link> 
                                    <router-link to="/salary"  class="nav-link collapsed">
                                        All Salary
                                        <div class="sb-sidenav-collapse-arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                    </router-link>
                                </nav>
                            </div>
                            <router-link to="/stock"  class="nav-link collapsed">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                Stock
                            </router-link> 
                        </div>
                    </div>
                    
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                       <router-view></router-view>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
        crossorigin="anonymous"></script>
    
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
</body>

</html>