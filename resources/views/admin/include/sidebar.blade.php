<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">

        </div>
        <div>
            <h4 class="logo-text"> تطبيق مراقد</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
     </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('dashboard')}}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">الرئيسية</div>
            </a>
        </li>




        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="person-outline"></ion-icon>

                </i>
                </div>

                <div class="menu-title"> إدارة المستخدمين</div>
            </a>
            <ul>
                <li> <a href="{{route('all.users')}}"><i class='bx bx-radio-circle'></i>عرض المستخدمين</a>
                </li>
                <li> <a href="{{route('add.user')}}"><i class='bx bx-radio-circle'></i>إضافة مستخدم جديد</a>
                </li>





            </ul>
        </li>




        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">المقابر</div>
            </a>
            <ul>
                <li> <a href="{{route('all.tomb')}}"><i class='bx bx-radio-circle'></i>عرض المقابر</a>
                </li>
                <li> <a href="{{route('add.tomb')}}"><i class='bx bx-radio-circle'></i>إضافة مقبرة</a>
                </li>





            </ul>
        </li>




        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">البلوكات</div>
            </a>
            <ul>
                <li> <a href="{{route('all.block')}}"><i class='bx bx-radio-circle'></i>عرض البلوكات</a>
                </li>
                <li> <a href="{{route('add.block')}}"><i class='bx bx-radio-circle'></i>إضافة بلوك</a>
                </li>





            </ul>
        </li>



        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">الأخبار</div>
            </a>
            <ul>
                <li> <a href="{{route('all.news')}}"><i class='bx bx-radio-circle'></i>عرض الأخبار</a>
                </li>
                <li> <a href="{{route('add.news')}}"><i class='bx bx-radio-circle'></i>إضافة الأخبار</a>
                </li>





            </ul>
        </li>



        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="notifications-outline"></ion-icon>
                </div>

                <div class="menu-title">ادارة الإشعارات</div>
            </a>
            <ul>
                <li> <a href="{{route('all.notification')}}"><i class='bx bx-radio-circle'></i>عرض الاشعارات</a>
                </li>
                <li> <a href="{{route('send.notification')}}"><i class='bx bx-radio-circle'></i>ارسال اشعار جديد</a>
                </li>





            </ul>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
<ion-icon name="phone-portrait-outline"></ion-icon>
                </div>

                <div class="menu-title">ادارة التطبيق</div>
            </a>
            <ul>
                <li> <a href="{{route('add.versions')}}"><i class='bx bx-radio-circle'></i>اصدار التطبيق</a>
                </li>






            </ul>
        </li>

{{--
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">البلوكات</div>
            </a>
            <ul>
                <li> <a href="{{route('all.category')}}"><i class='bx bx-radio-circle'></i>عرض البلوكات</a>
                </li>
                <li> <a href="{{route('add.category')}}"><i class='bx bx-radio-circle'></i>إضافة بلوك</a>
                </li>





            </ul>
        </li> --}}







{{--

        <li>
            <a href="{{route('add.ads')}}">
                <div class="parent-icon">
                    <ion-icon name="megaphone-outline"></ion-icon>

                </div>
                <div class="menu-title">ادارة التعازي</div>
            </a>
        </li>


        <li>
            <a href="{{route('report.view')}}">
                <div class="parent-icon">
                    <ion-icon name="stats-chart-outline"></ion-icon>

                </div>
                <div class="menu-title">الاحصائيات</div>
            </a>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <ion-icon name="notifications-outline"></ion-icon>
                </div>

                <div class="menu-title">ادارة الإشعارات</div>
            </a>
            <ul>
                <li> <a href="{{route('all.notification')}}"><i class='bx bx-radio-circle'></i>عرض الاشعارات</a>
                </li>
                <li> <a href="{{route('send.notification')}}"><i class='bx bx-radio-circle'></i>ارسال اشعار جديد</a>
                </li>





            </ul>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
<ion-icon name="phone-portrait-outline"></ion-icon>
                </div>

                <div class="menu-title">ادارة التطبيق</div>
            </a>
            <ul>
                <li> <a href="{{route('add.versions')}}"><i class='bx bx-radio-circle'></i>اصدار التطبيق</a>
                </li>






            </ul>
        </li> --}}




    </ul>
    <!--end navigation-->
</div>
