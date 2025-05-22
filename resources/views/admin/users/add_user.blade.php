@extends('admin.master_admin')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">اضافة مستخدم جديد</div>
</div>
<!--end breadcrumb-->
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('add.user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <!-- First Name -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">الاسم</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Name" type="text" class="form-control" value="{{ old('Name') }}" />
                                    @error('Name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">الصلاحية</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">


                                    <select  name="role" class="form-select" aria-label="Default select example">


                                            <option selected="selected" value="user">مستخدم</option>
                                            <option value="admin">مدير</option>




                                    </select>

                                </div>
                            </div>



                             <!-- Password -->
                             <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">كلمة المرور</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input autocomplete="new-password" name="password" type="password" class="form-control" />
                                    <small>اترك كلمة المرور فارغا اذا كان عضو عادي</small>

                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">البريد الإلكتروني</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="email" type="email" class="form-control" value="{{ old('email') }}" />
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">الهاتف</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Tel" type="text" class="form-control" value="{{ old('Tel') }}" />
                                    @error('Tel') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>







                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">الهاتف 2</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Tel2" type="text" class="form-control" value="{{ old('Tel2') }}" />
                                    @error('Tel2') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
























                            <!-- Profile Picture -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">الصورة</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Photo" type="file" id="image" class="form-control" />
                                    @error('Photo') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Profile Picture Preview -->
                            <div class="row mb-3">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <img id="showImage" src="{{ url('no_image.jpg') }}" alt="Admin" width="110">
                                </div>
                            </div>








                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="اضافة مستخدم جديد" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#DeathPhoto').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImageDeathPhoto').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
