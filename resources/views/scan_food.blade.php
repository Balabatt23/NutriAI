<x-layout title="Scan Makanan">
    <div class="flex-1">
        <div class="max-w-4xl mx-auto p-4 lg:p-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Scan Makanan</h1>
                    <p class="text-gray-600 mt-1">Gunakan kamera untuk memindai makanan</p>
                </div>
                <i data-feather="camera" class="w-6 h-6 text-gray-600"></i>
            </div>

            <!-- Video Stream -->
            <div class="relative rounded-2xl overflow-hidden shadow-md bg-black mb-6">
                <video id="video" autoplay playsinline class="w-full rounded-2xl"></video>
            </div>

            <!-- Tombol Ambil Gambar -->
            <div class="flex justify-center mb-6">
                <button onclick="takeSnapshot()" class="bg-green-500 hover:bg-green-600 text-white font-medium px-6 py-3 rounded-full flex items-center space-x-2">
                    <i data-feather="camera" class="w-5 h-5"></i>
                    <span>Ambil Foto</span>
                </button>
            </div>

            <!-- Gambar Hasil -->
            <div id="snapshotContainer" class="hidden mb-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-2">Hasil Foto</h2>
                <img id="snapshot" class="rounded-xl shadow-md" alt="Snapshot hasil">
            </div>
        </div>
    </div>

    <script>
        const video = document.getElementById('video');
        const snapshot = document.getElementById('snapshot');
        const snapshotContainer = document.getElementById('snapshotContainer');

        // Minta akses kamera
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                alert('Tidak bisa mengakses kamera: ' + err.message);
            });

       function dataURLtoBlob(dataURL) {
            const arr = dataURL.split(',');
            if (arr.length !== 2) {
                throw new Error("Invalid dataURL format");
            }

            const mimeMatch = arr[0].match(/:(.*?);/);
            if (!mimeMatch) {
                throw new Error("Invalid MIME type in dataURL");
            }

            const mime = mimeMatch[1];
            const bstr = atob(arr[1]);
            let n = bstr.length;
            const u8arr = new Uint8Array(n);

            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }

            return new Blob([u8arr], { type: mime });
        }



        function takeSnapshot() {
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            const imageData = canvas.toDataURL('image/png');
            snapshot.src = imageData;
            snapshotContainer.classList.remove('hidden');
        
            get_food_data(imageData);
        }

        function get_food_data(imgDataUrl) {
            const blob = dataURLtoBlob(imgDataUrl); // ✅ ubah data URL menjadi Blob

            const form = new FormData();
            form.append('file', blob, 'snapshot.png'); // ✅ kirim blob, bukan string base64

            fetch('/daily-consumption/create-by-pic', {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // jangan tambahkan Content-Type!
                },
                body: form
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => console.error('Upload error:', error));
        }

</script>
</x-layout>
