// Import EmailJS SDK (ensure this is loaded in your HTML before using)
// <script src="https://cdn.emailjs.com/dist/email.min.js"></script>

// Replace these with your actual EmailJS credentials
const EMAILJS_SERVICE_ID = "service_1mge8la";
const EMAILJS_TEMPLATE_ID = "template_ckorlry";
const EMAILJS_PUBLIC_KEY = "nIuemom47keVB3DLl";

// Initialize EmailJS (v4-compatible); safe to call multiple times
let __emailjsInitialized = false;
function initEmailJS() {
  if (typeof emailjs === 'undefined') {
    console.warn('EmailJS SDK not loaded; cannot initialize.');
    return;
  }
  if (__emailjsInitialized) return;
  if (!EMAILJS_PUBLIC_KEY || EMAILJS_PUBLIC_KEY === 'your_public_key_here') {
    console.warn('EmailJS public key is not set. Please set EMAILJS_PUBLIC_KEY in email.js.');
    return;
  }
  try {
    if (typeof emailjs.init === 'function') {
      try {
        emailjs.init({ publicKey: EMAILJS_PUBLIC_KEY });
      } catch (e) {
        // Fallback for older SDKs
        emailjs.init(EMAILJS_PUBLIC_KEY);
      }
      __emailjsInitialized = true;
    }
  } catch (e) {
    console.warn('EmailJS init failed:', e);
  }
}

function sendEmail(name, email, message) {
  return new Promise((resolve, reject) => {
    if (typeof emailjs === 'undefined') {
      console.error('EmailJS SDK not loaded. Please include the EmailJS script in your HTML.');
      reject(new Error('EmailJS SDK not loaded'));
      return;
    }

    // Ensure EmailJS is initialized (safe to call multiple times)
    initEmailJS();

    emailjs.send(EMAILJS_SERVICE_ID, EMAILJS_TEMPLATE_ID, {
      from_name: name,
      from_email: email,
      message: message,
      to_email: "khurram.hashmi@gmail.com"
    })
    .then(function(response) {
      console.log('Email sent successfully!', response.status, response.text);
      resolve(response);
    })
    .catch(function(error) {
      console.error('Failed to send email:', error);
      reject(error);
    });
  });
}

// The recipient is set in your EmailJS template/dashboard.
// To change the receiver, update your EmailJS template settings.
