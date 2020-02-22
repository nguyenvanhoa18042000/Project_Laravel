<!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="/backend/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">My shop</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img style="width: 40px; height: 40px; border-radius: 50%; margin-right: 1%;" src="{{asset(Auth::user()->avatar)}}"> 
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{Auth::user()->name}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library 
                         thẻ li có class="menu-open" sau has-treeview 
                         thẻ a có class= "active" sau nav-link -->
                    <li class="nav-item has-treeview">
                        <a href="{{route('profile.index')}}" class="nav-link add-click">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Trang chủ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{route('profile.user.order')}}" class="nav-link add-click">
                            <i class="nav-icon fa fa-shopping-cart" aria-hidden="true"></i>
                            <p>
                                Đơn hàng của bạn
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{route('profile.user.rating')}}" class="nav-link add-click">
                            <i class="fa fa-star nav-icon" aria-hidden="true"></i>
                            <p>
                                Đánh giá của bạn
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{route('profile.change.password')}}" class="nav-link add-click">
                            <i class="nav-icon fas fa-key"></i>
                            <p>
                                Cập nhật mật khẩu
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{route('profile.form.setting.user')}}" class="nav-link add-click">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>
                                Cài đặt thông tin
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>