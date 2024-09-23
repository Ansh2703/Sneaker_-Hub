// js/login.js

// Wait for the DOM to load
document.addEventListener('DOMContentLoaded', () => {
    const loginToggle = document.getElementById('login-toggle');
    const signupToggle = document.getElementById('signup-toggle');
    const loginForm = document.getElementById('login-form');
    const signupForm = document.getElementById('signup-form');

    // Function to activate Login form
    function showLogin() {
        loginToggle.classList.add('active');
        signupToggle.classList.remove('active');
        loginForm.classList.add('active');
        signupForm.classList.remove('active');
    }

    // Function to activate Signup form
    function showSignup() {
        signupToggle.classList.add('active');
        loginToggle.classList.remove('active');
        signupForm.classList.add('active');
        loginForm.classList.remove('active');
    }

    // Event listeners for toggle buttons
    loginToggle.addEventListener('click', showLogin);
    signupToggle.addEventListener('click', showSignup);
});
