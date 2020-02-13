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
                        <a href="{{route('backend.home')}}" class="nav-link add-click">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Trang chủ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Quản lý danh mục
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('backend.category.create') }}" class="nav-link" style="margin-left: 11%">
                                    <i class="nav-icon fas fa-plus"></i>
                                    <p>Tạo mới</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('backend.category.index') }}" class="nav-link" style="margin-left: 11%">
                                    <i class="nav-icon fa fa-list-alt" aria-hidden="true"></i>
                                    <p>Danh sách</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fab fa-product-hunt"></i>
                            <!-- <i class="nav-icon fas fa-shopping-basket"></i> -->
                            <p>
                                Quản lý sản phẩm
                                <i class="fas fa-angle-left right"></i>
                                <!-- <span class="badge badge-info right">6</span> -->
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('backend.product.create') }}" class="nav-link" style="margin-left: 11%">
                                    <i class="nav-icon fas fa-plus"></i>
                                    <p>Tạo mới</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('backend.product.index') }}" class="nav-link" style="margin-left: 11%">
                                    <i class="nav-icon fa fa-list-alt" aria-hidden="true"></i>
                                    <p>Danh sách</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-trademark" aria-hidden="true"></i>
                            <p>
                                Quản lý thương hiệu
                                <i class="fas fa-angle-left right"></i>
                                <!-- <span class="badge badge-info right">6</span> -->
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('backend.trademark.create') }}" class="nav-link" style="margin-left: 11%">
                                    <i class="nav-icon fas fa-plus"></i>
                                    <p>Tạo mới</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('backend.trademark.index') }}" class="nav-link" style="margin-left: 11%">
                                    <i class="nav-icon fa fa-list-alt" aria-hidden="true"></i>
                                    <p>Danh sách</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{route('backend.rating.index')}}" class="nav-link add-click">
                            <i class="fa fa-star nav-icon" aria-hidden="true"></i>
                            <p>
                                Quản lí đánh giá
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-shopping-cart" aria-hidden="true"></i>
                            <p>
                                Quản lý đơn hàng
                                <i class="fas fa-angle-left right"></i>
                                <!-- <span class="badge badge-info right">6</span> -->
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('backend.order.create') }}" class="nav-link" style="margin-left: 11%">
                                    <i class="nav-icon fas fa-plus"></i>
                                    <p>Tạo mới</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('backend.order.index') }}" class="nav-link" style="margin-left: 11%">
                                    <i class="nav-icon fa fa-list-alt" aria-hidden="true"></i>
                                    <p>Danh sách</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    @if(Auth::user()->role > 0)
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Quản lý người dùng
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(Auth::user()->role == 2)
                            <li class="nav-item">
                                <a href="{{ route('backend.user.create') }}" class="nav-link" style="margin-left: 11%">
                                    <i class="nav-icon fas fa-plus"></i>
                                    <p>Tạo mới</p>
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{ route('backend.user.index') }}" class="nav-link" style="margin-left: 11%">
                                    <i class="nav-icon fa fa-list-alt" aria-hidden="true"></i>
                                    <p>Danh sách</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Quản lý tin tức
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link" style="margin-left: 9%">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>Danh mục <i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('backend.news_category.create') }}" class="nav-link" style="margin-left: 17%">
                                            <i class="nav-icon fas fa-plus"></i>
                                            <p>Tạo mới</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('backend.news_category.index') }}" class="nav-link" style="margin-left: 17%">
                                            <i class="nav-icon fa fa-list-alt" aria-hidden="true"></i>
                                            <p>Danh sách</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" style="margin-left: 9%">
                                    <i class="nav-icon far fa-newspaper"></i>
                                    <p>Bài viết <i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('backend.post.create') }}" class="nav-link" style="margin-left: 17%">
                                            <i class="nav-icon fas fa-plus"></i>
                                            <p>Tạo mới</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('backend.post.index') }}" class="nav-link" style="margin-left: 17%">
                                            <i class="nav-icon fa fa-list-alt" aria-hidden="true"></i>
                                            <p>Danh sách</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-paper-plane"></i>
                            <p>
                                Quản lý liên hệ
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link" style="margin-left: 9%">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>Chủ đề <i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('backend.topic.create') }}" class="nav-link" style="margin-left: 17%">
                                            <i class="nav-icon fas fa-plus"></i>
                                            <p>Tạo mới</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('backend.topic.index') }}" class="nav-link" style="margin-left: 17%">
                                            <i class="nav-icon fa fa-list-alt" aria-hidden="true"></i>
                                            <p>Danh sách</p>
                                        </a>
                                    </li>
                                </ul>
                                <li class="nav-item">
                                    <a href="{{ route('backend.contact.index') }}" class="nav-link" style="margin-left: 9%">
                                        <i class="nav-icon fas fa-envelope"></i>
                                        <p>Liên hệ</p>
                                    </a>
                                </li>
                            </li>                         
                        </ul>
                    </li> -->
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>