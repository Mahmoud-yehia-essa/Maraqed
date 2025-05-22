@extends('admin.master_admin')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">اضافة خبر جديد</div>
</div>
<!--end breadcrumb-->
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('add.news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">العنوان</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="title" type="text" class="form-control" value="{{ old('title') }}" />
                                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">الوصف</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <textarea name="des" class="form-control @error('des') is-invalid @enderror"
                                              id="input11" placeholder="الوصف" rows="3">{{ old('des') }}</textarea>
                                    @error('des')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Profile Picture -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">الصورة</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="photo" type="file" id="image" class="form-control" />
                                    @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
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
                                    <input type="submit" class="btn btn-primary px-4" value="اضافة الخبر" />
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
