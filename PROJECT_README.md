# Khurram Hashmi Professional Website

A modern, responsive website showcasing the professional portfolio and services of Khurram Hashmi, a hospitality consultant and trainer.

## 🌟 Features

### Frontend
- **Responsive Design**: Optimized for desktop, tablet, and mobile devices
- **Advanced Animations**: Smooth transitions, hover effects, and micro-interactions
- **Professional Layout**: Clean, modern design with consistent branding
- **Interactive Elements**: Enhanced buttons, cards, and navigation
- **Performance Optimized**: Fast loading with optimized assets

### Backend
- **Contact Form Processing**: Secure form handling with validation
- **Data Storage**: JSON-based submission storage (no database required)
- **CORS Support**: Proper cross-origin resource sharing configuration
- **Error Handling**: Comprehensive error logging and user feedback
- **Security**: Input sanitization and XSS protection

## 📁 Project Structure

```
Khurram Mahmou/
├── html/                    # Frontend HTML files
│   ├── index.html          # Homepage
│   ├── about.html          # About page
│   ├── services.html       # Services page
│   ├── experience.html     # Experience page
│   ├── training.html       # Training page
│   ├── contact.html        # Contact page
│   ├── header.html         # Header component
│   └── footer.html         # Footer component
├── css/                     # Stylesheets
│   ├── style.css           # Main stylesheet
│   ├── header.css          # Header styles
│   └── footer.css          # Footer styles
├── images/                  # Image assets
│   ├── Logo.png            # Company logo
│   ├── Portrait.jpg        # Professional portrait
│   ├── COTHM.jpg          # COTHM certification image
│   └── favicon.png         # Site favicon
├── backend/                 # Backend PHP files
│   ├── send_email.php      # Contact form handler
│   ├── config.php          # Configuration file
│   └── contact_submissions.json # Form submissions storage
├── js/                      # JavaScript files
└── vendor/                  # PHP dependencies
```

## 🚀 Getting Started

### Prerequisites
- PHP 7.4 or higher
- Modern web browser
- Local development server (optional)

### Installation

1. **Clone/Download the project**
   ```bash
   git clone <repository-url>
   cd "Khurram Mahmou"
   ```

2. **Start PHP Development Server**
   ```bash
   php -S localhost:8000 -t backend
   ```

3. **Open in Browser**
   - Homepage: `http://localhost:8000/../html/index.html`
   - Contact Page: `http://localhost:8000/../html/contact.html`

### Configuration

1. **Backend Configuration**
   - Contact form submissions are automatically saved to `backend/contact_submissions.json`
   - No additional setup required for basic functionality

2. **Customization**
   - Update colors in `css/style.css` (CSS variables in `:root`)
   - Modify content in HTML files
   - Replace images in `images/` directory

## 🎨 Design Features

### Color Scheme
- **Primary**: #1a2233 (Dark Navy)
- **Secondary**: #bfa14a (Gold)
- **Accent**: #fff (White)
- **Gray**: #f5f5f5 (Light Gray)

### Typography
- **Headers**: Montserrat, Open Sans
- **Body**: Open Sans

### Animations
- **Fade-in effects** on scroll
- **Hover animations** for buttons and cards
- **Smooth transitions** throughout
- **Micro-interactions** for enhanced UX

## 📧 Contact Form

### Features
- **Real-time validation** of form fields
- **Secure data handling** with PHP sanitization
- **JSON storage** of submissions
- **Success/error feedback** to users
- **Responsive design** for all devices

### Form Fields
- Name (minimum 2 characters)
- Email (validated format)
- Message (minimum 10 characters)

### Data Storage
Submissions are stored in `backend/contact_submissions.json` with:
- Timestamp
- User IP address
- Form data
- Validation status

## 🔧 Technical Details

### Frontend Technologies
- **HTML5**: Semantic markup
- **CSS3**: Advanced styling with flexbox/grid
- **JavaScript**: ES6+ for interactions
- **Responsive Design**: Mobile-first approach

### Backend Technologies
- **PHP 8.2**: Server-side processing
- **JSON**: Data storage format
- **CORS**: Cross-origin support
- **Security**: Input validation and sanitization

### Performance Optimizations
- **Optimized images** for fast loading
- **Minified CSS** for production
- **Efficient animations** with CSS transforms
- **Lazy loading** techniques

## 🛠️ Maintenance

### Regular Tasks
1. **Monitor submissions**: Check `contact_submissions.json`
2. **Update content**: Modify HTML files as needed
3. **Backup data**: Regular backup of submissions
4. **Security updates**: Keep PHP updated

### Troubleshooting

#### Common Issues
1. **Contact form not working**
   - Check PHP server is running
   - Verify file permissions on `backend/` directory
   - Check browser console for JavaScript errors

2. **Images not loading**
   - Verify image file paths
   - Check file permissions
   - Ensure images exist in `images/` directory

3. **Styling issues**
   - Clear browser cache
   - Check CSS file paths
   - Validate CSS syntax

## 📱 Browser Support

- **Chrome** 80+
- **Firefox** 75+
- **Safari** 13+
- **Edge** 80+
- **Mobile browsers** (iOS Safari, Chrome Mobile)

## 🔐 Security Features

- **Input sanitization** for all form fields
- **XSS protection** headers
- **CSRF protection** considerations
- **File upload restrictions** (if applicable)
- **Rate limiting** considerations for production

## 🚀 Deployment

### Production Deployment
1. **Upload files** to web server
2. **Configure PHP** environment
3. **Set file permissions** appropriately
4. **Update paths** if necessary
5. **Test functionality** thoroughly

### Recommended Hosting
- **Shared hosting** with PHP support
- **VPS** for more control
- **Cloud platforms** (AWS, DigitalOcean, etc.)

## 📞 Support

For technical support or questions:
- **Email**: khurram.hashmi@gmail.com
- **Phone**: +92-300-8489686
- **LinkedIn**: [Khurram Hashmi](https://www.linkedin.com/in/khurram-hashmi-38a145a)

## 📄 License

This project is proprietary and confidential. All rights reserved.

---

**Last Updated**: August 2025
**Version**: 1.0.0
**Developed by**: GitHub Copilot for Khurram Hashmi
