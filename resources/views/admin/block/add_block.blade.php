@extends('admin.master_admin')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">اضافة بلوك جديد</div>
</div>
<!--end breadcrumb-->
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('add.block.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">

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
                                    <h6 class="mb-0">رقم البلوك</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="BlockNumber" type="number" class="form-control" value="{{ old('BlockNumber') }}" />
                                    @error('BlockNumber') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">اختر النوع</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">


                                    <select  name="BlockType" class="form-select" aria-label="Default select example">


                                            <option selected="selected" value="1">بلوك</option>
                                            <option value="2">مسجد</option>
                                            <option value="3">صالة عزاء</option>
                                            <option value="4">مغسل</option>



                                    </select>

                                </div>
                            </div>



                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">من</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Start" type="text" class="form-control" value="{{ old('Start') }}" />
                                    @error('Start') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">إلى</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="End" type="text" class="form-control" value="{{ old('End') }}" />
                                    @error('End') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>










                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Latitude</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Latitude" type="text" class="form-control" value="{{ old('Latitude') }}" />
                                    @error('Latitude') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Longitude</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Longitude" type="text" class="form-control" value="{{ old('Longitude') }}" />
                                    @error('Longitude') <span class="text-danger">{{ $message }}</span> @enderror
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
                                    <input type="submit" class="btn btn-primary px-4" value="اضافة البلوك" />
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
