<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معلومات عن المقبرة</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />

    <style>
        body {
            background-color: #f8f9fa;
            font-family: "Cairo", sans-serif;
            font-size: 1.15rem;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
        }
        .info-label {
            color: #6c757d;
            font-weight: bold;
        }
        .info-value {
            color: #212529;
        }
        #map {
            border-radius: 10px;
            height: 300px;
        }
        .divider {
            border-top: 1px solid #dee2e6;
            margin: 1rem 0;
        }
    </style>
</head>
<body>

    <div class="text-center mt-5">
    <h4 class="mb-3">حمّل تطبيق <span class="text-primary">مراقد</span> على هاتفك</h4>
    <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="https://play.google.com/store/apps/details?id=com.maraqed.app" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Download on Google Play" style="height:60px;">
        </a>
        <a href="https://apps.apple.com/us/app/maraqed/id6746356557" target="_blank">
            <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" alt="Download on App Store" style="height:60px;">
        </a>
    </div>
</div>
<div class="container py-5">
    <h2 class="mb-4 text-center text-primary">معلومات عن القبر</h2>

    <div class="card p-4">
        @php
            $fields = [
                'الاسم' => $tomb->Name,
                'تاريخ الميلاد' => $tomb->birthDateFull,
                'تاريخ الوفاة' => $tomb->DeathDate,
                                'العمر' => $tomb->BirtDate,

                'مكان الدفن' => $tomb->TombPlace,
                'القطعة' => $tomb->BlockNumber,
                'لاين' => $tomb->Vertical,
                'رقم القبر' => $tomb->TombNumber,
            ];
        @endphp

        @foreach ($fields as $label => $value)
            <div class="row mb-2">
                <div class="col-sm-4 info-label">{{ $label }}:</div>
                <div class="col-sm-8 info-value">{{ $value ?? '—' }}</div>
            </div>
            <div class="divider"></div>
        @endforeach

        <div class="row mb-4">
            <div class="col-sm-4 info-label">الصورة:</div>
            <div class="col-sm-8">
                <img onclick="showImageModal(this.src)"
                     src="{{ !empty($tomb->Photo2) ? url('photos2/'.$tomb->Photo2) : url('no_image.jpg') }}"
                     alt="الصورة"
                     class="img-thumbnail"
                     width="150"
                     style="cursor: pointer;">
            </div>
        </div>
        <div class="divider"></div>

        <div class="row mb-4">
            <div class="col-sm-4 info-label">الشاهد:</div>
            <div class="col-sm-8">
                <img onclick="showImageModal(this.src)"
                     src="{{ !empty($tomb->DeathPhoto) ? url('death_photos/'.$tomb->DeathPhoto) : url('no_image.jpg') }}"
                     alt="شهادة الوفاة"
                     class="img-thumbnail"
                     width="150"
                     style="cursor: pointer;">
            </div>
        </div>
        <div class="divider"></div>

        @if ($tomb->Latitude && $tomb->Longitude && $tomb->Latitude != '0.0' && $tomb->Longitude != '0.0')
            <div class="row mb-3">
                <div class="col-sm-12">
                    <div id="map"></div>
                </div>
            </div>

            <div class="text-center mt-3">
                <a id="directionLink" class="btn btn-outline-primary" target="_blank">
                    📍 الانتقال إلى الموقع على الخريطة
                </a>
            </div>
        @endif
    </div>

<div class="text-center mt-5">
    <h4 class="mb-3">حمّل تطبيق <span class="text-primary">مراقد</span> على هاتفك</h4>
    <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="https://play.google.com/store/apps/details?id=com.maraqed.app" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Download on Google Play" style="height:60px;">
        </a>
        <a href="https://apps.apple.com/us/app/maraqed/id6746356557" target="_blank">
            <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" alt="Download on App Store" style="height:60px;">
        </a>
    </div>
</div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const lat = parseFloat("{{ $tomb->Latitude }}");
        const lng = parseFloat("{{ $tomb->Longitude }}");
        const tombName = @json($tomb->Name);

        if (!isNaN(lat) && !isNaN(lng)) {
            const map = L.map('map').setView([lat, lng], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            L.marker([lat, lng]).addTo(map).bindPopup(tombName).openPopup();

            const googleMapsUrl = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
            document.getElementById("directionLink").href = googleMapsUrl;
        }
    });
</script>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content position-relative bg-transparent border-0">
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
                        z-index: 1055;">
                &times;
            </button>
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

</body>
</html>
