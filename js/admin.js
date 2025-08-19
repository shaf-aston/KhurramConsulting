// Admin Panel JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const loginForm = document.getElementById('login-form');
    const adminLogin = document.getElementById('admin-login');
    const adminDashboard = document.getElementById('admin-dashboard');
    const logoutBtn = document.getElementById('logout-btn');
    const uploadForm = document.getElementById('upload-form');
    const imageGallery = document.getElementById('admin-image-gallery');
    const filterButtons = document.querySelectorAll('.filter-btn');

    // Check if user is already logged in
    if (localStorage.getItem('adminLoggedIn') === 'true') {
        showDashboard();
        loadImages();
    }

    // Login Form Submission
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Simple authentication (replace with secure authentication in production)
            if (username === 'admin' && password === 'portfolio123') {
                localStorage.setItem('adminLoggedIn', 'true');
                showDashboard();
                loadImages();
            } else {
                alert('Invalid credentials. Please try again.');
            }
        });
    }

    // Logout Button
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function() {
            localStorage.removeItem('adminLoggedIn');
            showLogin();
        });
    }

    // Upload Form Submission
    if (uploadForm) {
        uploadForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const title = document.getElementById('image-title').value;
            const description = document.getElementById('image-description').value;
            const imageFile = document.getElementById('image-file').files[0];
            const status = document.getElementById('image-status').value;
            
            if (!imageFile) {
                alert('Please select an image to upload.');
                return;
            }
            
            // Create FormData object to send file
            const formData = new FormData();
            formData.append('title', title);
            formData.append('description', description);
            formData.append('image', imageFile);
            formData.append('status', status);
            
            // Send to backend
            fetch('../backend/upload_image.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Image uploaded successfully!');
                    uploadForm.reset();
                    loadImages(); // Reload images
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while uploading the image.');
            });
        });
    }

    // Filter Buttons
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter images
            const imageItems = document.querySelectorAll('.image-item');
            imageItems.forEach(item => {
                const status = item.getAttribute('data-status');
                if (filter === 'all' || status === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Helper Functions
    function showDashboard() {
        adminLogin.style.display = 'none';
        adminDashboard.style.display = 'block';
    }

    function showLogin() {
        adminLogin.style.display = 'block';
        adminDashboard.style.display = 'none';
    }

    function loadImages() {
        fetch('../backend/get_images.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayImages(data.images);
                } else {
                    console.error('Error loading images:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function displayImages(images) {
        imageGallery.innerHTML = '';
        
        if (images.length === 0) {
            imageGallery.innerHTML = '<p>No images found. Upload some images to get started!</p>';
            return;
        }
        
        images.forEach(image => {
            const imageElement = document.createElement('div');
            imageElement.className = 'image-item';
            imageElement.setAttribute('data-status', image.status);
            
            const statusLabel = image.status === 'published' ? 'Published' : 'Draft';
            const statusClass = image.status === 'published' ? 'status-published' : 'status-draft';
            
            const toggleButton = image.status === 'published' 
                ? `<button class="action-btn unpublish-btn" data-id="${image.id}">Unpublish</button>`
                : `<button class="action-btn publish-btn" data-id="${image.id}">Publish</button>`;
            
            imageElement.innerHTML = `
                <img src="../uploads/${image.filename}" alt="${image.title}">
                <div class="image-info">
                    <h3 class="image-title">${image.title}</h3>
                    <p class="image-description">${image.description || 'No description'}</p>
                    <span class="image-status ${statusClass}">${statusLabel}</span>
                    <div class="image-actions">
                        ${toggleButton}
                        <button class="action-btn delete-btn" data-id="${image.id}">Delete</button>
                    </div>
                </div>
            `;
            
            imageGallery.appendChild(imageElement);
        });
        
        // Add event listeners to action buttons
        document.querySelectorAll('.publish-btn, .unpublish-btn').forEach(button => {
            button.addEventListener('click', function() {
                const imageId = this.getAttribute('data-id');
                const newStatus = this.classList.contains('publish-btn') ? 'published' : 'draft';
                
                updateImageStatus(imageId, newStatus);
            });
        });
        
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const imageId = this.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this image?')) {
                    deleteImage(imageId);
                }
            });
        });
    }

    function updateImageStatus(imageId, status) {
        fetch('../backend/update_image_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: imageId,
                status: status
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`Image ${status === 'published' ? 'published' : 'unpublished'} successfully!`);
                loadImages(); // Reload images
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the image status.');
        });
    }

    function deleteImage(imageId) {
        fetch('../backend/delete_image.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: imageId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Image deleted successfully!');
                loadImages(); // Reload images
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the image.');
        });
    }
});