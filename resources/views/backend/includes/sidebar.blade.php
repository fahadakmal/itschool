@inject('request', 'Illuminate\Http\Request')

<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/dashboard')) }}"
                   href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon icon-speedometer"></i> @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>


            <!--=======================Custom menus===============================-->
            @can('order_access')
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'orders' ? 'active' : '' }}"
                       href="{{ route('admin.orders.index') }}">
                        <i class="nav-icon icon-bag"></i>
                        <span class="title">@lang('menus.backend.sidebar.orders.title')</span>
                    </a>
                </li>
            @endcan
            @if ($logged_in_user->isAdmin())
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(2) == 'teachers' ? 'active' : '' }}"
                       href="{{ route('admin.teachers.index') }}">
                        <i class="nav-icon icon-directions"></i>
                        <span class="title">@lang('menus.backend.sidebar.teachers.title')</span>
                    </a>
                </li>
            @endif

            @if ($logged_in_user->isAdmin())
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(2) == 'user' ? 'active' : '' }}"
                       href="{{ route('admin.auth.user.index') }}">
                        <i class="nav-icon icon-directions"></i>
                        <span class="title">Users</span>
                    </a>
                </li>
            @endif

            

            @can('category_access')
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(2) == 'categories' ? 'active' : '' }}"
                       href="{{ route('admin.categories.index') }}">
                        <i class="nav-icon icon-folder-alt"></i>
                        <span class="title">@lang('menus.backend.sidebar.categories.title')</span>
                    </a>
                </li>
            @endcan
            @if((!$logged_in_user->hasRole('student')) && ($logged_in_user->hasRole('teacher') || $logged_in_user->isAdmin() || $logged_in_user->hasAnyPermission(['course_access','lesson_access','test_access','question_access','bundle_access'])))
                {{--@if($logged_in_user->hasRole('teacher') || $logged_in_user->isAdmin() || $logged_in_user->hasAnyPermission(['course_access','lesson_access','test_access','question_access','bundle_access']))--}}

                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern(['user/courses*','user/lessons*','user/tests*','user/questions*']), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/*')) }}"
                       href="#">
                        <i class="nav-icon icon-puzzle"></i> @lang('menus.backend.sidebar.courses.management')


                    </a>

                    <ul class="nav-dropdown-items">

                        @can('course_access')
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'courses' ? 'active' : '' }}"
                                   href="{{ route('admin.courses.index') }}">
                                    <span class="title">@lang('menus.backend.sidebar.courses.title')</span>
                                </a>
                            </li>
                        @endcan

                        @can('lesson_access')
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'lessons' ? 'active' : '' }}"
                                   href="{{ route('admin.lessons.index') }}">
                                    <span class="title">@lang('menus.backend.sidebar.lessons.title')</span>
                                </a>
                            </li>
                        @endcan

                        @can('test_access')
                            <li class="nav-item ">
                                <a class="nav-link {{ $request->segment(2) == 'tests' ? 'active' : '' }}"
                                   href="{{ route('admin.tests.index') }}">
                                    <span class="title">@lang('menus.backend.sidebar.tests.title')</span>
                                </a>
                            </li>
                        @endcan


                        @can('question_access')
                            <li class="nav-item">
                                <a class="nav-link {{ $request->segment(2) == 'questions' ? 'active' : '' }}"
                                   href="{{ route('admin.questions.index') }}">
                                    <span class="title">@lang('menus.backend.sidebar.questions.title')</span>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>

            @endif






            @if ($logged_in_user->hasRole('teacher'))
                <li class="nav-item ">
                    <a class="nav-link {{ $request->segment(1) == 'reviews' ? 'active' : '' }}"
                       href="{{ route('admin.reviews.index') }}">
                        <i class="nav-icon icon-speech"></i> <span
                                class="title">@lang('menus.backend.sidebar.reviews.title')</span>
                    </a>
                </li>
            @endif

            <li class="nav-item ">
                <a class="nav-link {{ $request->segment(1) == 'account' ? 'active' : '' }}"
                   href="{{ route('admin.account') }}">
                    <i class="nav-icon icon-key"></i>
                    <span class="title">@lang('menus.backend.sidebar.account.title')</span>
                </a>
            </li>
            @if ($logged_in_user->isAdmin())


                <li class="nav-title">
                    @lang('menus.backend.sidebar.system')
                </li>

                <!--==================================================================-->
                <li class="divider"></li>

                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/settings*')) }}"
                       href="#">
                        <i class="nav-icon icon-settings"></i> @lang('menus.backend.sidebar.settings.title')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/settings')) }}"
                               href="{{ route('admin.general-settings') }}">
                                @lang('menus.backend.sidebar.settings.general')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer/logs*')) }}"
                               href="{{ route('admin.social-settings') }}">
                                @lang('menus.backend.sidebar.settings.social-login')
                            </a>
                        </li>
                    </ul>
                </li>



            @endif

            @if ($logged_in_user->hasRole('teacher'))
            <!-- <li class="nav-item ">
                <a class="nav-link {{ $request->segment(2) == 'payments' ? 'active' : '' }}"
                    href="{{ route('admin.payments') }}">
                    <i class="nav-icon icon-wallet"></i>
                    <span class="title">@lang('menus.backend.sidebar.payments.title')</span>
                </a>
            </li> -->
            @endif

        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
