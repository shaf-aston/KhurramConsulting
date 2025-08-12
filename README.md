# Khurram Hashmi Website - Email & Calendly Integration

This website includes a complete email contact form and Calendly integration for booking consultations.

## Features

### Email System
- ✅ Secure contact form with validation
- ✅ PHPMailer for reliable email delivery
- ✅ Rate limiting to prevent spam
- ✅ HTML email templates
- ✅ Error logging and monitoring
- ✅ CSRF protection and input sanitization

### Calendly Integration
- ✅ Popup booking widget
- ✅ Inline calendar widget
- ✅ Webhook handler for booking notifications
- ✅ Email notifications for new bookings
- ✅ Support for booking cancellations

## Setup Instructions

### 1. Email Configuration

1. **Enable 2-Factor Authentication** on your Gmail account
2. **Generate App Password**:
   - Go to https://myaccount.google.com/apppasswords
   - Generate a new app password for "Mail"
   - Copy the 16-character password

3. **Update Configuration**:
   - Open `backend/config.php`
   - Replace `'your-app-password'` with your Gmail app password
   - Update `'yourdomain.com'` with your actual domain

4. **Update Backend Files**:
   - In `backend/send_email.php`: Replace `'your-app-password'` with your app password
   - In `backend/calendly_webhook.php`: Replace `'your-app-password'` with your app password

### 2. Calendly Setup

1. **Calendly Account**:
   - Ensure your Calendly link `https://calendly.com/manmandem5/30min` is active
   - If you need to change it, update it in `html/contact.html`

2. **Webhook Configuration** (Optional but recommended):
   - Go to your Calendly account settings
   - Navigate to "Webhooks"
   - Add webhook URL: `https://yourdomain.com/backend/calendly_webhook.php`
   - Enable events: `invitee.created`, `invitee.canceled`
   - Copy the webhook secret and update `backend/config.php`

### 3. File Permissions

Ensure these directories are writable by the web server:
```bash
chmod 755 backend/
chmod 644 backend/*.php
```

### 4. Testing

1. **Test Contact Form**:
   - Go to the contact page
   - Fill out the form
   - Check if email is received

2. **Test Calendly**:
   - Click "Schedule a 30-Minute Consultation"
   - Book a test appointment
   - Check if webhook notification email is received

## File Structure

```
backend/
├── send_email.php          # Contact form handler
├── calendly_webhook.php    # Calendly webhook handler
├── config.php              # Configuration file
├── email_errors.log        # Email error logs (auto-generated)
├── calendly_webhook.log    # Calendly webhook logs (auto-generated)
└── rate_limit.json         # Rate limiting data (auto-generated)

html/
├── contact.html            # Contact page with forms and Calendly
└── ...

css/
├── style.css              # Main styles
└── ...
```

## Security Features

- **Rate Limiting**: Maximum 5 form submissions per hour per IP
- **Input Validation**: Server-side and client-side validation
- **CSRF Protection**: Security headers and token verification
- **Error Logging**: All errors are logged for monitoring
- **Webhook Verification**: Optional signature verification for Calendly

## Troubleshooting

### Email Not Sending
1. Check Gmail app password is correct
2. Verify 2FA is enabled on Gmail
3. Check `backend/email_errors.log` for error details
4. Ensure server supports SMTP connections

### Calendly Webhook Not Working
1. Verify webhook URL is accessible
2. Check Calendly webhook settings
3. Review `backend/calendly_webhook.log` for incoming events
4. Ensure webhook secret is configured if using signature verification

### Form Submission Issues
1. Check browser console for JavaScript errors
2. Verify form action points to correct backend file
3. Check server error logs
4. Test with different browsers

## Production Deployment

Before going live:

1. **Update Configuration**:
   - Set `'debug_mode' => false` in `config.php`
   - Update all placeholder URLs and emails
   - Enable webhook signature verification

2. **Security**:
   - Use HTTPS for all endpoints
   - Set up proper file permissions
   - Enable rate limiting
   - Monitor error logs regularly

3. **Testing**:
   - Test all forms thoroughly
   - Verify email delivery
   - Test Calendly integration
   - Check mobile responsiveness

## Support

For issues or questions about this integration, check:
1. Error logs in the `backend/` directory
2. Browser console for JavaScript errors
3. Server error logs
4. Calendly webhook logs

## Updates

To update the integration:
1. Backup current files
2. Update necessary files
3. Test thoroughly before deploying
4. Monitor logs for any issues
