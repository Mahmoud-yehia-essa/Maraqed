@extends('admin.master_admin')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">اضافة قبر جديد</div>
</div>
<!--end breadcrumb-->
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('add.tomb.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <h6 class="mb-0">العمر</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="BirtDate" type="number" class="form-control" value="{{ old('BirtDate') }}" />
                                    @error('BirtDate') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>





                            <!-- Last Name -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">تاريخ الوفاة</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="DeathDate" type="date" class="form-control" value="{{ old('DeathDate') }}" />
                                    @error('DeathDate') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

          <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">مكان الدفن</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="TombPlace" type="text" class="form-control" value="{{ old('TombPlace') }}" />
                                    @error('TombPlace') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>



                             <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">القطعة</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="BlockNumber" type="number" class="form-control" value="{{ old('BlockNumber') }}" />
                                    @error('BlockNumber') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">لاين</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Vertical" type="number" class="form-control" value="{{ old('Vertical') }}" />
                                    @error('Vertical') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>


                            {{-- <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">أفقي</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Horizontal" type="number" class="form-control" value="{{ old('Horizontal') }}" />
                                    @error('Horizontal') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div> --}}



                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">رقم القبر</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="TombNumber" type="number" class="form-control" value="{{ old('TombNumber') }}" />
                                    @error('TombNumber') <span class="text-danger">{{ $message }}</span> @enderror
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
                                    <input name="Photo2" type="file" id="image" class="form-control" />
                                    @error('Photo2') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Profile Picture Preview -->
                            <div class="row mb-3">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <img id="showImage" src="{{ url('no_image.jpg') }}" alt="Admin" width="110">
                                </div>
                            </div>






                                <!-- Profile Picture -->
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">صورة الشاهد</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="DeathPhoto" type="file" id="DeathPhoto" class="form-control" />
                                        @error('DeathPhoto') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Profile Picture Preview -->
                                <div class="row mb-3">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="showImageDeathPhoto" src="{{ url('no_image.jpg') }}" alt="Admin" width="110">
                                    </div>
                                </div>


                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="اضافة المقبرة" />
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
