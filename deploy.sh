#!/bin/bash

# Khurram Hashmi Website Deployment Script
# This script helps deploy the website to a production server

echo "🚀 Starting deployment process..."

# Check if PHP is available
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed or not in PATH"
    exit 1
fi

echo "✅ PHP is available"

# Check if all required directories exist
required_dirs=("html" "css" "images" "backend")
for dir in "${required_dirs[@]}"; do
    if [ ! -d "$dir" ]; then
        echo "❌ Required directory '$dir' not found"
        exit 1
    fi
done

echo "✅ All required directories found"

# Check if required files exist
required_files=("backend/send_email.php" "html/index.html" "css/style.css")
for file in "${required_files[@]}"; do
    if [ ! -f "$file" ]; then
        echo "❌ Required file '$file' not found"
        exit 1
    fi
done

echo "✅ All required files found"

# Set proper permissions for backend directory
if [ -d "backend" ]; then
    chmod 755 backend
    chmod 644 backend/*.php
    chmod 666 backend/contact_submissions.json 2>/dev/null || touch backend/contact_submissions.json && chmod 666 backend/contact_submissions.json
    echo "✅ Backend permissions set"
fi

# Validate PHP syntax
echo "🔍 Validating PHP syntax..."
for php_file in backend/*.php; do
    if [ -f "$php_file" ]; then
        php -l "$php_file" >/dev/null
        if [ $? -eq 0 ]; then
            echo "✅ $php_file syntax is valid"
        else
            echo "❌ $php_file has syntax errors"
            exit 1
        fi
    fi
done

# Start development server for testing
echo "🌐 Starting development server..."
echo "Server will be available at: http://localhost:8000"
echo "Homepage: http://localhost:8000/../html/index.html"
echo "Contact: http://localhost:8000/../html/contact.html"
echo ""
echo "Press Ctrl+C to stop the server"

php -S localhost:8000 -t backend
