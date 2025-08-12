# Contact Form Testing and Maintenance Guide

## Server Setup
1. **PHP Server Running**: `php -S localhost:8000 -t "c:\Users\Shaf\Downloads\Khurram Mahmou"`
2. **Access URL**: http://localhost:8000/html/contact.html

## What's Fixed:

### Backend (`backend/send_email.php`):
- ✅ **Free Email Solution**: Instead of paid APIs, form submissions are saved to `contact_submissions.json`
- ✅ **Input Validation**: Name, email, and message validation
- ✅ **Security Headers**: CORS, XSS protection, content type validation
- ✅ **Error Handling**: Proper error responses and logging
- ✅ **JSON Response Format**: Structured responses for frontend integration

### Frontend (`html/contact.html`):
- ✅ **Form Submission**: JavaScript handles form data and sends to backend
- ✅ **User Feedback**: Color-coded success/error messages
- ✅ **Form Reset**: Clears form after successful submission
- ✅ **Error Handling**: Handles server connection issues gracefully
- ✅ **Calendly Integration**: Fixed calendar URL to use correct Calendly link

### Calendar:
- ✅ **Calendly Widget**: Working with `https://calendly.com/manmandem5/30min`
- ✅ **Popup Integration**: Click-to-schedule functionality
- ✅ **Inline Calendar**: Embedded calendar view

## How to Use:

### Testing the Contact Form:
1. Open http://localhost:8000/html/contact.html
2. Fill out the form with test data
3. Submit and check for success message
4. View submissions in `backend/contact_submissions.json`

### Accessing Contact Submissions:
- All form submissions are saved in: `backend/contact_submissions.json`
- Each submission includes: timestamp, name, email, message, IP address
- You can check this file regularly to see new contact requests

### Running the Server:
```bash
php -S localhost:8000 -t "c:\Users\Shaf\Downloads\Khurram Mahmou"
```

## Benefits:
- 🆓 **100% Free**: No paid APIs or services required
- 📧 **Contact Capture**: All contact requests are saved locally
- 🔒 **Secure**: Input validation and security headers
- 📱 **Responsive**: Works on desktop and mobile
- 📅 **Calendar Integration**: Direct Calendly booking
- ⚡ **Fast**: Local file storage for instant responses
