@extends('admin.master_admin')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">تعديل البلوك </div>
</div>
<!--end breadcrumb-->


@php
    $originalDateStart = $block->Start; // This must match the format below
    try {
        $formattedDate = \Carbon\Carbon::createFromFormat('d/m/Y', $originalDateStart)->format('Y-m-d');
    } catch (\Exception $e) {
        $formattedDate = $block->Start; // fallback if parsing fails
    }


    $originalDateEnd = $block->End; // This must match the format below
    try {
        $formattedDateEnd = \Carbon\Carbon::createFromFormat('d/m/Y', $originalDateEnd)->format('Y-m-d');
    } catch (\Exception $e) {
        $formattedDateEnd = $block->End; // fallback if parsing fails
    }
@endphp
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('edit.block.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf



                    <input type="hidden" name="id" value="{{ $block->id }}">
                    <input type="hidden" name="old_Photo" value="{{ $block->Photo }}">



                    <div class="card">
                        <div class="card-body">

                            <div class="row mb-3">
                                <div  style="cursor: pointer;"  onclick="showQrModal(this.innerHTML, 'qr_{{ $block->id }}')" class="col-sm-12 text-center">
                                {!! QrCode::size(100)->generate("https://maraqed.com/admin/public/tomb/" . $block->id) !!}

                            </div>
                        </div>
                            <!-- First Name -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">الاسم</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Name" type="text" class="form-control" value="{{ old('Name',$block->Name) }}" />
                                    @error('Name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>



                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">رقم البلوك</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="BlockNumber" type="number" class="form-control" value="{{ old('BlockNumber',$block->BlockNumber) }}" />
                                    @error('BlockNumber') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">اختر النوع</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">


                                    <select  name="category_id" class="form-select" aria-label="Default select example">


                                            <option {{ $block->BlockType == '1' ? 'selected' : '' }}  value="1">بلوك</option>

                                            <option {{ $block->BlockType == '2' ? 'selected' : '' }}  value="2">مسجد</option>

                                            <option {{ $block->BlockType == '3' ? 'selected' : '' }}  value="3">صالة عزاء</option>
                                            <option {{ $block->BlockType == '4' ? 'selected' : '' }}  value="4">مغسل</option>








                                    </select>

                                </div>
                            </div>








                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">من</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Start" type="text" class="form-control" value="{{ old('Start',$block->Start) }}" />
                                    @error('Start') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">إلى</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="End" type="text" class="form-control" value="{{ old('End',$block->End) }}" />
                                    @error('End') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
















                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Latitude</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Latitude" type="text" class="form-control" value="{{ old('Latitude',$block->Latitude) }}" />
                                    @error('Latitude') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Longitude</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Longitude" type="text" class="form-control" value="{{ old('Longitude',$block->Longitude) }}" />
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



                            <div class="row mb-3">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <img id="showImage" src="{{ (!empty($block->Photo)) ? url('blocks/'.$block->Photo):url('no_image.jpg') }}" alt="Admin" width="110">


                                </div>
                            </div>










                                @if ($block->Latitude && $block->Longitude &&  $block->Longitude != '0.0' &&  $block->Latitude != '0.0' &&  $block->Longitude != '' &&  $block->Latitude != '' )

                             <div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">الموقع على الخريطة</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <div id="map" style="height: 300px; border-radius: 8px;"></div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <a id="directionLink" class="btn btn-outline-primary" target="_blank">
                                            📍 الانتقال إلى الموقع
                                        </a>
                                    </div>
                                </div>

                            </div>

                            @endif


                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="تعديل البلوك" />
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const latInput = document.querySelector("input[name='Latitude']");
        const lngInput = document.querySelector("input[name='Longitude']");

        const initialLat = parseFloat(latInput.value) || 24.7136; // default to Riyadh
        const initialLng = parseFloat(lngInput.value) || 46.6753;
        const tombName = @json($block->Name);

        const map = L.map('map').setView([initialLat, initialLng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // ❌ Marker is now NOT draggable
        const marker = L.marker([initialLat, initialLng])
            .addTo(map)
            .bindPopup(tombName)
            .openPopup();

        // Optional: keep this if you want the marker to update when you edit inputs
        latInput.addEventListener("input", function () {
            const lat = parseFloat(latInput.value);
            const lng = parseFloat(lngInput.value);
            if (!isNaN(lat) && !isNaN(lng)) {
                marker.setLatLng([lat, lng]);
                map.setView([lat, lng], 15);
            }
        });

        lngInput.addEventListener("input", function () {
            const lat = parseFloat(latInput.value);
            const lng = parseFloat(lngInput.value);
            if (!isNaN(lat) && !isNaN(lng)) {
                marker.setLatLng([lat, lng]);
                map.setView([lat, lng], 15);
            }
        });
    });
</script>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        const latInput = document.querySelector("input[name='Latitude']");
        const lngInput = document.querySelector("input[name='Longitude']");
        const directionLink = document.getElementById("directionLink");

        function updateDirectionLink() {
            const lat = parseFloat(latInput.value);
            const lng = parseFloat(lngInput.value);
            if (!isNaN(lat) && !isNaN(lng)) {
                const googleMapsUrl = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
                directionLink.href = googleMapsUrl;
            } else {
                directionLink.href = "#";
            }
        }

        // Initialize the link on load
        updateDirectionLink();

        // Update when lat/lng change
        latInput.addEventListener("input", updateDirectionLink);
        lngInput.addEventListener("input", updateDirectionLink);
    });
</script>




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
