# Khurram Hashmi - Professional Portfolio Website

A modern, responsive portfolio website for hospitality consultant Khurram Hashmi, featuring advanced animations, secure contact forms, and professional design.

## 🚀 Features

- **Responsive Design**: Optimized for all devices and screen sizes
- **Advanced Animations**: Smooth CSS animations and transitions
- **Secure Contact Form**: Form submissions saved to JSON file (development mode)
- **Professional Portfolio**: Showcases experience, services, and training programs
- **Modern UI/UX**: Clean, professional design with hover effects and animations

## 📁 Project Structure

```
Khurram Mahmou/
├── html/                   # Frontend HTML files
│   ├── index.html         # Homepage
│   ├── about.html         # About page
│   ├── contact.html       # Contact form page
│   ├── experience.html    # Experience and projects
│   ├── services.html      # Services offered
│   ├── training.html      # Training programs
│   ├── header.html        # Reusable header component
│   └── footer.html        # Reusable footer component
├── css/                   # Stylesheets
│   ├── style.css         # Main styles with animations
│   ├── header.css        # Header-specific styles
│   └── footer.css        # Footer-specific styles
├── images/               # Image assets
│   ├── Portrait.jpg      # Professional portrait
│   ├── COTHM.jpg        # Training institution image
│   ├── favicon.png      # Site favicon
│   └── Logo.png         # Company logo
├── backend/              # Backend PHP files
│   ├── send_email.php   # Contact form handler
│   └── contact_submissions.json # Form submissions storage
└── vendor/              # Composer dependencies
```

## 🛠️ Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript ES6+
- **Backend**: PHP 8.2+
- **Styling**: CSS Variables, Flexbox, CSS Grid
- **Animations**: CSS Keyframes, Transitions, Transforms
- **Development**: PHP Built-in Server

## 🚀 Getting Started

### Prerequisites

- PHP 8.0 or higher
- Modern web browser

### Installation

1. **Clone or download the project**
2. **Navigate to the project directory**
3. **Start the backend server** (for contact form):
   ```bash
   php -S localhost:8000 -t backend
   ```
4. **Start the frontend server**:
   ```bash
   php -S localhost:8080 -t html
   ```
5. **Open your browser** and visit `http://localhost:8080`

## 📧 Contact Form

The contact form is configured for development mode:
- Submissions are saved to `backend/contact_submissions.json`
- No external email services required
- Form includes validation and error handling
- Responsive design with smooth animations

### Form Features

- ✅ Input validation (name, email, message)
- ✅ AJAX submission without page reload
- ✅ Success/error message display
- ✅ Form reset on successful submission
- ✅ CORS headers for cross-origin requests

## 🎨 Design Features

### Animations

- **Fade-in effects** for page sections
- **Hover animations** for interactive elements
- **Smooth transitions** for all state changes
- **Parallax effects** for visual depth
- **Loading animations** for images

### Responsive Design

- Mobile-first approach
- Flexible grid layouts
- Scalable typography
- Touch-friendly interactive elements

## 📱 Browser Support

- ✅ Chrome 70+
- ✅ Firefox 65+
- ✅ Safari 12+
- ✅ Edge 79+

## 🔧 Development

### File Organization

- **Modular CSS**: Separate files for different components
- **Reusable Components**: Header and footer included via JavaScript
- **Clean HTML**: Semantic markup with proper accessibility
- **Optimized Images**: Compressed for web performance

### Best Practices Implemented

- ✅ CSS Variables for consistent theming
- ✅ Mobile-first responsive design
- ✅ Semantic HTML structure
- ✅ Accessible navigation
- ✅ Optimized image loading
- ✅ Clean, commented code
- ✅ Security headers in PHP
- ✅ Input sanitization and validation

## 📊 Performance

- **Optimized CSS**: Efficient selectors and minimal redundancy
- **Compressed Images**: WebP format where possible
- **Minimal JavaScript**: Pure vanilla JS, no heavy frameworks
- **Fast Loading**: Optimized for quick page loads

## 🛡️ Security

- **Input Sanitization**: All form inputs are cleaned
- **CSRF Protection**: Security headers implemented
- **XSS Prevention**: Content encoding and validation
- **File Upload Security**: No file uploads to prevent vulnerabilities

## 📝 Customization

### Colors (CSS Variables)

```css
:root {
  --primary: #1a2233;    /* Dark blue */
  --secondary: #bfa14a;  /* Gold */
  --accent: #fff;        /* White */
  --gray: #f5f5f5;      /* Light gray */
  --text: #222;         /* Dark text */
}
```

### Fonts

- Headers: 'Montserrat', 'Open Sans', Arial, sans-serif
- Body: 'Open Sans', Arial, sans-serif

## 🤝 Contributing

1. Follow the existing code style
2. Test all changes thoroughly
3. Update documentation as needed
4. Ensure responsive design compatibility

## 📄 License

This project is proprietary and confidential.

## 📞 Support

For technical support or questions about this portfolio website, please contact through the contact form on the website.

---

**Built with ❤️ for Khurram Hashmi's Professional Portfolio**
