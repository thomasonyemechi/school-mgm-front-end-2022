<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="#" class="brand-link">
        <img src="{{env('API_ROOT_URL').user()->school->logo}}" alt="SchoolPetal Logo" class="brand-image img-circle elevation-3"
            style="opacity: .5">
        <span class="brand-text font-weight-bolder">School Petal</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">

            </div>
            <img src="{{env('API_ROOT_URL').user()->photo}}" class="profile_pics object-cover img-circle elevation-2   " alt="Img">

            <div class="info">
                <a href="#" class="d-block">{{ucwords(user()->name)}}</a>
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



                @if (user()->permission->registration == 1)
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

                @endif








                @if (user()->permission->other == 1)
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
                                <a href="/control/subject/assign" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Subject Teachers</p>
                                </a>
                            </li>


                        </ul>
                    </li>


                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-subscript"></i>
                            <p>
                                Results Mgm
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/control/result/check/" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Students Results</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/control/result/class/" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Class Result </p>
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
                                <a href="/control/setting/result" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Results Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/control/setting/permission" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permission Setup</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/control/setting/general" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>General Setup</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{(term()) ? '/control/setting/sub/'.term()->id : '#' }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registration Slots</p>
                                </a>
                            </li>

                        </ul>
                    </li>



                    <li class="nav-item">
                        <a href="/control/managepromotion" class="nav-link">
                            <i class="fas fa-scroll    "></i>
                            <p>Manage Promotions</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="/control/create/time_table" class="nav-link">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <p>Time Table Management</p>
                        </a>
                    </li>


                @endif


                @if (user()->permission->fee == 1)
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
                @endif


                @if (user()->permission->u_result == 1)
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            <p>
                                 Student Result
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/control/result/upload/" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Upload Result</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/control/broad-sheet" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Broad Sheet</p>
                                </a>
                            </li>


                        </ul>
                    </li>


                @endif


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <p>My Profile</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="/logout" onclick="return confirm('Are you sure you want to log out')" class="nav-link">
                        <i class="fa fa-power-off" aria-hidden="true"></i>
                        <p>Log Out</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
