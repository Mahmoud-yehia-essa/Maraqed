@extends('admin.master_admin')
@section('admin')
@php
    use Carbon\Carbon;
@endphp
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">كل المقابر</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">

        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            {{-- <a href="{{route('add.user')}}" > --}}

<button type="button" class="btn btn-primary">

    اضافة مقبرة جديدة

</button>
</a>


        </div>
    </div>
</div>
<!--end breadcrumb-->

<hr/>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
<tr>
<th>الرقم</th>
<th>اسم المرحوم</th>
<th>العمر</th>
{{-- <th>الوصول السريع</th> --}}
<th>تاريخ الميلاد</th>

<th>تاريخ الوفاة</th>
    <th>مكان الدفن</th>
                <th>القطعة</th>

<th> صورة الشاهد</th>
<th>الصورة الشخصية</th>

<th>الاجراء</th>


</tr>
</thead>
<tbody>
@foreach($tombs as $key => $item)
<tr>
<td> {{ $key+1 }}</td>
<td>{{ $item->Name }}</td>
<td>{{ $item->BirtDate }}</td>
<td>{{ $item->birthDateFull }}</td>



{{-- <td>
    <div onclick="showQrModal(this.innerHTML)" style="cursor: pointer;">
        {!! QrCode::size(60)->generate($item->id) !!}
    </div>
</td> --}}
{{-- <td>
    <div onclick="showQrModal(this.innerHTML, 'qr_{{ $item->id }}')" style="cursor: pointer;">
        {!! QrCode::size(60)->generate($item->id) !!}
    </div>
</td> --}}

<td>{{ $item->DeathDate ? $item->DeathDate : 'لم يتم التحديد' }}
    <br>
      @if ($item->DeathDate)
        {{ Carbon::parse($item->DeathDate)->diffForHumans() }} تقريبا
    @else
        لم يتم التحديد
    @endif


</td>

<td>{{ $item->TombPlace }}</td>

<td>{{ $item->BlockNumber }}</td>


<td>
    <img onclick="showImageModal(this.src)"
         class="rounded-circle img-fluid"
         src="{{ (!empty($item->DeathPhoto)) ? url('death_photos/'.$item->DeathPhoto):url('no_pathDeathPhoto.jpg') }}"
         style="width: 50px; height:50px; border: 2px solid #0aa2dd; cursor: pointer;">
</td>
<td>
    <img onclick="showImageModal(this.src)"
         class="rounded-circle img-fluid"
         src="{{ (!empty($item->Photo2)) ? url('photos2/'.$item->Photo2):url('no_photo2.jpg') }}"
         style="width: 50px; height:50px; border: 2px solid #0aa2dd; cursor: pointer;">
  </td>
<td>
    @if($item->status == 'active')
    <a href="{{ route('inactive.tomb', $item->id) }}" class="btn btn-primary" title="اخفاء">
        <i class="fa-solid fa-eye"></i>
    </a>
@else
    <a href="{{ route('active.tomb', $item->id) }}" class="btn btn-primary" title="اظهار">

        <i class="fa-solid fa-eye-slash"></i>

    </a>
@endif
<a href="{{ route('edit.tomb',$item->id) }}" class="btn btn-info" title="Edit Data"> <i class="fa fa-pencil"></i> </a>

<a href="{{ route('delete.tomb',$item->id) }}" class="btn btn-danger" id="delete" title="Delete Data" ><i class="fa fa-trash"></i></a>

</td>

</tr>
@endforeach


</tbody>
<tfoot>
<tr>
    <th>الرقم</th>
    <th>اسم المرحوم</th>
    <th>العمر</th>
    {{-- <th>الوصول السريع</th> --}}
    <th>تاريخ الميلاد</th>

    <th>تاريخ الوفاة</th>

        <th>مكان الدفن</th>
                <th>القطعة</th>



<th> صورة الشاهد</th>
<th>الصورة الشخصية</th>

    <th>الاجراء</th>
</tr>
</tfoot>
</table>
        </div>
    </div>
</div>

<!-- Image Modal -->
<!-- Image Modal -->
<!-- Image Modal -->
<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content position-relative bg-transparent border-0">

        <!-- Rectangular Close Button -->
        <button type="button"
                class="btn text-white"
                data-bs-dismiss="modal"
                aria-label="Close"
                style="
                  position: absolute;
                  top: 15px;
                  right: 15px;
                  background-color: black;
                  font-size: 30px;
                  padding: 1px 10px;
                  border-radius: 8px;
                  z-index: 1055;
                ">
            &times;
        </button>

        <!-- Image -->
        <img id="modalImage" src="" class="img-fluid rounded shadow" alt="image">
      </div>
    </div>
  </div>



  <script>
    function showImageModal(src) {
        document.getElementById('modalImage').src = src;
        var myModal = new bootstrap.Modal(document.getElementById('imageModal'));
        myModal.show();
    }
</script>




<!-- QR Modal -->
<!-- QR Modal -->
<div class="modal fade" id="qrModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-dark text-white position-relative">

        <div class="modal-header border-0">
          <h5 class="modal-title">رمز الاستجابة السريعة</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body text-center">
          <div id="modalQrContainer"></div>
          <button class="btn btn-primary mt-3" onclick="downloadQrImage()">تحميل QR </button>
        </div>

      </div>
    </div>
  </div>


  <script>
    let currentQrFilename = 'qr_code.png';

    function showImageModal(src) {
        document.getElementById('modalImage').src = src;
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
    }

    function showQrModal(svgContent, filename = 'qr_code') {
        currentQrFilename = filename + '.png';
        document.getElementById('modalQrContainer').innerHTML = svgContent;

        const svg = document.querySelector('#modalQrContainer svg');
        if (svg) {
            svg.style.width = '250px';
            svg.style.height = '250px';
            svg.setAttribute('id', 'qrSvg');
        }

        const modal = new bootstrap.Modal(document.getElementById('qrModal'));
        modal.show();
    }

    function downloadQrImage() {
        const svgElement = document.getElementById('qrSvg');
        if (!svgElement) return;

        const svgData = new XMLSerializer().serializeToString(svgElement);
        const svgBlob = new Blob([svgData], { type: 'image/svg+xml;charset=utf-8' });
        const url = URL.createObjectURL(svgBlob);

        const canvas = document.createElement('canvas');
        canvas.width = 500;
        canvas.height = 500;
        const ctx = canvas.getContext('2d');

        const img = new Image();
        img.onload = function () {
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

            const pngUrl = canvas.toDataURL('image/png');
            const a = document.createElement('a');
            a.href = pngUrl;
            a.download = currentQrFilename;
            a.click();
            URL.revokeObjectURL(url);
        };

        img.src = url;
    }
</script>


@endsection
