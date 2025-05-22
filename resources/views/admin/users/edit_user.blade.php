@extends('admin.master_admin')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">تعديل مستخدم جديد</div>
</div>
<!--end breadcrumb-->
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('edit.user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="hidden" name="old_Photo" value="{{ $user->Photo }}">

                    <div class="card">
                        <div class="card-body">
                            <!-- First Name -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">الاسم</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Name" type="text" class="form-control" value="{{ old('Name',$user->Name) }}" />
                                    @error('Name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>



                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">الصلاحية</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">


                                    <select  name="role" class="form-select" aria-label="Default select example">




                                            <option {{ $user->role == 'user' ? 'selected' : '' }}  value="user">مستخدم</option>
                                            <option {{ $user->role == 'admin' ? 'selected' : '' }}  value="admin">مدير</option>



                                    </select>

                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">البريد الإلكتروني</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="email" type="email" class="form-control" value="{{ old('email',$user->email) }}" />
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">الهاتف</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Tel" dir="ltr" type="text" class="form-control" value="{{ old('Tel',$user->Tel) }}" />
                                    @error('Tel') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>







                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">الهاتف 2</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Tel2" dir="ltr" type="text" class="form-control" value="{{ old('Tel2',$user->Tel2) }}" />
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
                                    <img id="showImage" src="{{ (!empty($user->Photo)) ? url('users/'.$user->Photo):url('no_image.jpg') }}" alt="Admin" width="110">
                                </div>
                            </div>








                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="تعديل مستخدم" />
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
