document.addEventListener('DOMContentLoaded', function() {
    // Get gallery container
    const galleryContainer = document.getElementById('gallery');
    
    // Load published images from Netlify CMS
    loadPublishedImages();
    
    function loadPublishedImages() {
        // First try to load from CMS-managed content
        fetch('/content/portfolio/index.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error('CMS content not available');
                }
                return response.json();
            })
            .then(data => {
                // Remove loading indicator
                galleryContainer.innerHTML = '';
                
                if (data && data.length > 0) {
                    // Filter to only show published items from CMS
                    const publishedItems = data.filter(item => !item.draft);
                    displayCmsImages(publishedItems);
                } else {
                    // Fallback to the original PHP backend if no CMS data
                    return fetch('../backend/get_published_images.php');
                }
            })
            .catch(error => {
                console.log('Falling back to PHP backend:', error);
                // Fallback to the original PHP backend
                return fetch('../backend/get_published_images.php')
                    .then(response => response.json());
            })
            .then(data => {
                if (data && data.success && data.images && data.images.length > 0) {
                    // Remove loading indicator if not already done
                    galleryContainer.innerHTML = '';
                    displayImages(data.images);
                } else if (galleryContainer.innerHTML === '') {
                    galleryContainer.innerHTML = '<div class="no-images">No portfolio images available at this time.</div>';
                }
            })
            .catch(error => {
                console.error('Error loading images:', error);
                galleryContainer.innerHTML = '<div class="no-images">Error loading gallery. Please try again later.</div>';
            });
    }
    
    function displayImages(images) {
        images.forEach(image => {
            const galleryItem = document.createElement('div');
            galleryItem.className = 'gallery-item';
            
            galleryItem.innerHTML = `
                <img src="../uploads/${image.filename}" alt="${image.title}">
                <div class="gallery-info">
                    <h3 class="gallery-title">${image.title}</h3>
                    <p class="gallery-description">${image.description || ''}</p>
                </div>
            `;
            
            galleryContainer.appendChild(galleryItem);
        });
    }
    
    function displayCmsImages(images) {
        images.forEach(image => {
            const galleryItem = document.createElement('div');
            galleryItem.className = 'gallery-item';
            
            galleryItem.innerHTML = `
                <img src="${image.image}" alt="${image.title}">
                <div class="gallery-info">
                    <h3 class="gallery-title">${image.title}</h3>
                    <p class="gallery-description">${image.description || ''}</p>
                    ${image.featured ? '<span class="featured-badge">Featured</span>' : ''}
                </div>
            `;
            
            galleryContainer.appendChild(galleryItem);
        });
    }
});