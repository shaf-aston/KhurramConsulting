<?php

/**
 * Email and Calendly Configuration
 * 
 * Instructions:
 * 1. Replace 'your-app-password' with your Gmail App Password
 * 2. Enable 2-factor authentication on your Gmail account
 * 3. Generate an App Password: https://myaccount.google.com/apppasswords
 * 4. Replace 'your-calendly-webhook-secret' with your actual webhook secret from Calendly
 * 5. Set up webhook URL in Calendly: https://yourdomain.com/backend/calendly_webhook.php
 */

return [
  // Email Configuration
  'email' => [
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'smtp_username' => 'khurram.hashmi@gmail.com',
    'smtp_password' => 'your-app-password', // Replace with your Gmail App Password
    'from_email' => 'noreply@yourdomain.com',
    'from_name' => 'Khurram Hashmi Website',
    'to_email' => 'khurram.hashmi@gmail.com',
    'to_name' => 'Khurram Hashmi',
  ],

  // Calendly Configuration
  'calendly' => [
    'webhook_secret' => 'your-calendly-webhook-secret', // Replace with your Calendly webhook secret
    'booking_url' => 'https://calendly.com/manmandem5/30min',
  ],

  // Security Configuration
  'security' => [
    'rate_limit_max_requests' => 5, // Max requests per hour per IP
    'rate_limit_time_window' => 3600, // Time window in seconds (1 hour)
    'enable_webhook_signature_verification' => false, // Set to true when you add webhook secret
  ],

  // Application Configuration
  'app' => [
    'domain' => 'yourdomain.com', // Replace with your actual domain
    'timezone' => 'Asia/Karachi', // Set your timezone
    'debug_mode' => false, // Set to true for development
  ]
];
