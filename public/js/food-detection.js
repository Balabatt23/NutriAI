    // Food Detection JavaScript for Nutrition Dashboard

    document.addEventListener('DOMContentLoaded', function() {
        // Get elements
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('fileInput');
        const mealsContainer = document.getElementById('mealsContainer');
        const addMealBtn = document.getElementById('addMealBtn');
        const manualModal = document.getElementById('manualModal');
        const closeModal = document.getElementById('closeModal');
        const cancelBtn = document.getElementById('cancelBtn');
        const manualForm = document.getElementById('manualForm');
        const quickAddBtns = document.querySelectorAll('.quick-add-btn');
        const video = document.getElementById('video');
        const snapshot = document.getElementById('snapshot');
        const snapshotContainer = document.getElementById('snapshotContainer');
        const uploadTab = document.getElementById('uploadTab');
        const scanTab = document.getElementById('scanTab');
        const uploadSection = document.getElementById('uploadSection');
        const scanSection = document.getElementById('scanSection');

        // Current day calories and macros
        let currentCalories = parseInt(document.getElementById('calories-count').textContent.split('/')[0]) || 0;
        let currentProtein = parseInt(document.getElementById('protein-count').textContent.replace('g', '')) || 0;
        let currentCarbs = parseInt(document.getElementById('carbs-count').textContent.replace('g', '')) || 0;
        loadTodayMeals()

        // Dropzone click handler
        dropzone.addEventListener('click', function() {
            fileInput.click();
        });

        // File input change handler
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                handleFileUpload(file);
            }
        });

        // Drag and drop handlers
        dropzone.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropzone.classList.add('border-blue-400', 'bg-blue-50');
        });

        dropzone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            dropzone.classList.remove('border-blue-400', 'bg-blue-50');
        });

        dropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropzone.classList.remove('border-blue-400', 'bg-blue-50');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFileUpload(files[0]);
            }
        });

        dropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropzone.classList.remove('border-blue-400', 'bg-blue-50');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFileUpload(files[0]);
            }
        });

        // 👇 Pindahkan ke sini
        uploadTab.addEventListener('click', () => {
            uploadSection.classList.remove('hidden');
            scanSection.classList.add('hidden');
            uploadTab.classList.add('bg-blue-500', 'text-white');
            scanTab.classList.remove('bg-blue-500', 'text-white');
            scanTab.classList.add('bg-gray-100', 'text-gray-800');
        });

        scanTab.addEventListener('click', () => {
            uploadSection.classList.add('hidden');
            scanSection.classList.remove('hidden');
            scanTab.classList.add('bg-blue-500', 'text-white');
            uploadTab.classList.remove('bg-blue-500', 'text-white');
            uploadTab.classList.add('bg-gray-100', 'text-gray-800');
        });
        
        // Minta akses kamera
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                alert('Tidak bisa mengakses kamera: ' + err.message);
            });
        // Handle file upload and food detection
        async function handleFileUpload(file) {
            // Validate file type
            if (!file.type.startsWith('image/')) {
                showNotification('Please upload an image file', 'error');
                return;
            }

            // Show loading state
            showLoadingState();

            try {
                // Create FormData
                const formData = new FormData();
                formData.append('file', file);

                // Get CSRF token
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                            document.querySelector('input[name="_token"]')?.value;
                
                // Send to backend
                const response = await fetch('/daily-consumption/create-by-pic', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.success) {
                    // Add detected food to the UI
                    addMealToUI(result.data);
                    updateNutritionStats(result.data.kalori || 0, 0, 0);
                    showNotification('Food detected and added successfully!', 'success');
                } else {
                    showNotification(result.message || 'Failed to detect food', 'error');
                }

            } catch (error) {
                console.error('Error:', error);
                showNotification('Error uploading image. Please try again.', 'error');
            } finally {
                hideLoadingState();
            }
        }

        // Add meal to UI
        function addMealToUI(mealData) {
            console.log('Menambahkan ke UI:', mealData);
            const mealElement = document.createElement('div');
            mealElement.className = 'flex items-center justify-between py-3 px-4 bg-gray-50 rounded-lg';
            mealElement.innerHTML = `
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <i data-feather="camera" class="w-5 h-5 text-green-600"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900">${mealData.nama || mealData.food_name}</h4>
                        <p class="text-sm text-gray-500">${mealData.kalori || mealData.calories} • 15g protein • 45g carbs</p>
                    </div>
                </div>
                <button class="text-red-500 hover:text-red-700 delete-meal" data-meal-id="${mealData.id || 'temp-' + Date.now()}">
                    <i data-feather="trash-2" class="w-4 h-4"></i>
                </button>
            `;

            mealsContainer.appendChild(mealElement);
            
            // Re-render feather icons
            if (typeof feather !== 'undefined') {
                feather.replace();
            }

            // Add delete functionality
            mealElement.querySelector('.delete-meal').addEventListener('click', function() {
                deleteMeal(mealElement, mealData.kalori || mealData.calories || 0);
            });
        }

        async function loadTodayMeals() {
        try {
            const res = await fetch('/daily-consumption/today');
            const data = await res.json();

            console.log('Fetched meals:', data);

            // Jika data adalah array langsung
            if (Array.isArray(data)) {
                data.forEach(meal => {
                    addMealToUI(meal);
                });
            }
            // Jika data ada di dalam object { meals: [...] }
            else if (Array.isArray(data.meals)) {
                data.meals.forEach(meal => {
                    addMealToUI(meal);
                });
            }
        } catch (err) {
            console.error('Gagal memuat data makanan hari ini:', err);
        }
    }


        // Update nutrition statistics
        function updateNutritionStats(calories, protein, carbs) {
            currentCalories += parseInt(calories) || 0;
            currentProtein += parseInt(protein) || 0;
            currentCarbs += parseInt(carbs) || 0;

            // Update calories display
            document.getElementById('calories-count').textContent = `${currentCalories}/2000`;
            document.getElementById('calories-remaining').textContent = 2000 - currentCalories;
            
            // Update progress bar
            const progressPercentage = (currentCalories / 2000) * 100;
            document.getElementById('calories-progress').style.width = `${Math.min(progressPercentage, 100)}%`;
            
            // Update macros
            document.getElementById('protein-count').textContent = `${currentProtein}g`;
            document.getElementById('carbs-count').textContent = `${currentCarbs}g`;
        }

        // Show loading state
        function showLoadingState() {
            dropzone.innerHTML = `
                <div class="flex flex-col items-center">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500 mb-4"></div>
                    <p class="text-gray-600 mb-2">Analyzing food image...</p>
                    <p class="text-sm text-gray-500">Please wait while AI detects your food</p>
                </div>
            `;
        }

        // Hide loading state
        function hideLoadingState() {
            dropzone.innerHTML = `
                <i data-feather="upload" class="w-12 h-12 text-gray-400 mx-auto mb-4"></i>
                <p class="text-gray-600 mb-2">Drag & drop food image here</p>
                <p class="text-sm text-gray-500">or click to upload</p>
            `;
            
            // Re-render feather icons
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }

        // Show notification
        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg text-white max-w-sm ${
                type === 'success' ? 'bg-green-500' : 
                type === 'error' ? 'bg-red-500' : 'bg-blue-500'
            }`;
            notification.innerHTML = `
                <div class="flex items-center space-x-2">
                    <i data-feather="${type === 'success' ? 'check-circle' : type === 'error' ? 'x-circle' : 'info'}" class="w-5 h-5"></i>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);
            
            // Re-render feather icons
            if (typeof feather !== 'undefined') {
                feather.replace();
            }

            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.remove();
            }, 5000);
        }

        // Delete meal functionality
        function deleteMeal(mealElement, calories) {
            const deleteBtn = mealElement.querySelector('.delete-meal');
            const mealId = deleteBtn.dataset.mealId;

            // Jika ID tidak valid (temp), hapus langsung
            if (!mealId || mealId.startsWith('temp-')) {
                mealElement.remove();
                updateNutritionStats(-calories, 0, 0);
                showNotification('Meal removed', 'info');
                return;
            }

            // Konfirmasi
            if (!confirm('Yakin ingin menghapus makanan ini?')) return;

            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                        document.querySelector('input[name="_token"]')?.value;

            fetch(`/meals/${mealId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                }
            })
            .then(res => {
                if (!res.ok) throw new Error('Delete failed');
                return res.json();
            })
            .then(data => {
                mealElement.remove();
                updateNutritionStats(-calories, 0, 0);
                showNotification('Meal deleted successfully!', 'success');
            })
            .catch(err => {
                console.error(err);
                showNotification('Failed to delete meal', 'error');
            });
        }

        // Manual modal handlers
        addMealBtn.addEventListener('click', function() {
            manualModal.classList.remove('hidden');
        });

        closeModal.addEventListener('click', function() {
            manualModal.classList.add('hidden');
        });

        cancelBtn.addEventListener('click', function() {
            manualModal.classList.add('hidden');
        });

        // Manual form submission
        manualForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(manualForm);
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                        document.querySelector('input[name="_token"]')?.value;

            try {
                const response = await fetch('/daily-consumption/create', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.status) {
                    const mealData = {
                        nama: formData.get('food_name'),
                        kalori: formData.get('calories'),
                        protein: formData.get('protein'),
                        carbs: formData.get('carbs')
                    };

                    addMealToUI(mealData);
                    updateNutritionStats(
                        parseInt(mealData.kalori) || 0,
                        parseInt(mealData.protein) || 0,
                        parseInt(mealData.carbs) || 0
                    );
                    
                    manualModal.classList.add('hidden');
                    manualForm.reset();
                    showNotification('Meal added successfully!', 'success');
                } else {
                    showNotification(result.message || 'Failed to add meal', 'error');
                }

            } catch (error) {
                console.error('Error:', error);
                showNotification('Error adding meal. Please try again.', 'error');
            }
        });

        // Quick add buttons
        quickAddBtns.forEach(btn => {
            btn.addEventListener('click', async function() {
                const foodName = this.dataset.food;
                const calories = this.dataset.calories;

                const formData = new FormData();
                formData.append('food_name', foodName);
                formData.append('calories',calories);
                formData.append('protein',0);
                formData.append('carbs',0);

                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                document.querySelector('input[name="_token"]')?.value;

            try {
                const response = await fetch('/daily-consumption/create', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.status) {
                    const mealData = {
                        nama: foodName,
                        kalori: calories,
                        protein: 0,
                        carbs: 0
                    };

                    addMealToUI(mealData);
                    updateNutritionStats(
                        parseInt(calories) || 0,
                        0,
                        0
                    );
                    showNotification(`${foodName} added successfully!`, 'success');
                } else {
                    showNotification(result.message || 'Failed to add meal', 'error');
                }

            } catch (error) {
                console.error('Error:', error);
                showNotification('Error adding meal. Please try again.', 'error');
            }
            });
        });

        // Click outside modal to close
        manualModal.addEventListener('click', function(e) {
            if (e.target === manualModal) {
                manualModal.classList.add('hidden');
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        $(document).on('click', '.delete-meal', function () {
            const mealId = $(this).data('id'); // atau data('meal-id') jika atributnya seperti itu
            const parent = $(this).closest('.flex');

            if (confirm('Yakin ingin menghapus makanan ini?')) {
                $.ajax({
                    url: `/daily-consumption/${mealId}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        parent.remove(); // Hapus dari tampilan
                        console.log(response.message);
                    },
                    error: function (xhr) {
                        alert('Gagal menghapus makanan.');
                    }
                });
            }
        });
    });
    function dataURLtoBlob(dataURL) {
            const arr = dataURL.split(',');
            const mime = arr[0].match(/:(.*?);/)[1];
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
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                        document.querySelector('input[name="_token"]')?.value;

            const form = new FormData();
            form.append('file', blob, 'snapshot.png'); // ✅ kirim blob, bukan string base64

            fetch('/daily-consumption/create-by-pic', {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: form
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => console.error('Upload error:', error));
        }
