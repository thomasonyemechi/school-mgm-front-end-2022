<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset('assets/img/logo.png') }}" alt="SchoolPetal Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-bolder">School Petal</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">User Name</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="/control/dashboard" class="nav-link">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <p>Dashboard</p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        <p>
                            Manage Students
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/control/register_guardian" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Register Guardians</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/control/register_student" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Register Students</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/control/all_student" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Students</p>
                            </a>
                        </li>

                    </ul>
                </li>



                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-money-bill-wave-alt"></i>
                        <p>
                            School Fees Control
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/control/fee" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Fee Category</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/control/set_fee" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Set School Fee</p>
                            </a>
                        </li>


                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-plus"></i>
                        <p>
                            Staff Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/control/add_staff" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New Staff</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View All Staffs</p>
                            </a>
                        </li>


                    </ul>
                </li>



                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-clipboard" aria-hidden="true"></i>
                        <p>
                            Class Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/control/category_arm" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category/Arm</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/control/create_class" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Classes</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-subscript"></i>
                        <p>
                            Subjects Info
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/control/add_subject" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create/View Subjects</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/control/subject_teacher" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Subject Teachers</p>
                            </a>
                        </li>


                    </ul>
                </li>



                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-toolbox"> </i>
                        <p>
                            School Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Results Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/control/general_setup" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General Setup</p>
                            </a>
                        </li>
                    </ul>
                </li>



                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-sticky-note" aria-hidden="true"></i>
                        <p>
                            Levy Payment Report
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/control/fee/daily" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daily Payments</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/control/fee/weekly" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Weekly Payments</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/control/fee/termly" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Termly Payments</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/control/fee/range" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fee Across Date Range</p>
                            </a>
                        </li>
                    </ul>
                </li>




            </ul>
        </nav>
    </div>
</aside>
