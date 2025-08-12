@echo off
REM Khurram Hashmi Website Deployment Script (Windows)
REM This script helps deploy the website on Windows

echo 🚀 Starting deployment process...

REM Check if PHP is available
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ PHP is not installed or not in PATH
    pause
    exit /b 1
)

echo ✅ PHP is available

REM Check if all required directories exist
if not exist "html" (
    echo ❌ Required directory 'html' not found
    pause
    exit /b 1
)

if not exist "css" (
    echo ❌ Required directory 'css' not found
    pause
    exit /b 1
)

if not exist "images" (
    echo ❌ Required directory 'images' not found
    pause
    exit /b 1
)

if not exist "backend" (
    echo ❌ Required directory 'backend' not found
    pause
    exit /b 1
)

echo ✅ All required directories found

REM Check if required files exist
if not exist "backend\send_email.php" (
    echo ❌ Required file 'backend/send_email.php' not found
    pause
    exit /b 1
)

if not exist "html\index.html" (
    echo ❌ Required file 'html/index.html' not found
    pause
    exit /b 1
)

if not exist "css\style.css" (
    echo ❌ Required file 'css/style.css' not found
    pause
    exit /b 1
)

echo ✅ All required files found

REM Create contact submissions file if it doesn't exist
if not exist "backend\contact_submissions.json" (
    echo [] > backend\contact_submissions.json
    echo ✅ Created contact_submissions.json
)

REM Validate PHP syntax
echo 🔍 Validating PHP syntax...
for %%f in (backend\*.php) do (
    php -l "%%f" >nul 2>&1
    if %errorlevel% neq 0 (
        echo ❌ %%f has syntax errors
        pause
        exit /b 1
    )
    echo ✅ %%f syntax is valid
)

REM Start development server for testing
echo.
echo 🌐 Starting development server...
echo Server will be available at: http://localhost:8000
echo Homepage: http://localhost:8000/../html/index.html
echo Contact: http://localhost:8000/../html/contact.html
echo.
echo Press Ctrl+C to stop the server
echo.

php -S localhost:8000 -t backend
