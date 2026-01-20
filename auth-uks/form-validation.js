/**
 * Form Validation Module
 * Provides client-side validation with user-friendly feedback
 * for login and registration forms
 */

/**
 * Validates email format
 * @param {string} email - Email address to validate
 * @returns {boolean} - True if email is valid
 */
function isValidEmail(email) {
    const emailPattern = /^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$/i;
    return emailPattern.test(email);
}

/**
 * Validates password strength
 * @param {string} password - Password to validate
 * @returns {object} - Validation result with message
 */
function validatePassword(password) {
    if (password.length < 6) {
        return {
            valid: false,
            message: 'Password minimal harus 6 karakter'
        };
    }
    return { valid: true, message: '' };
}

/**
 * Validates username format
 * @param {string} username - Username to validate
 * @returns {object} - Validation result with message
 */
function validateUsername(username) {
    if (username.length < 3) {
        return {
            valid: false,
            message: 'Username minimal harus 3 karakter'
        };
    }
    if (!/^[a-zA-Z0-9_]+$/.test(username)) {
        return {
            valid: false,
            message: 'Username hanya boleh huruf, angka, dan underscore'
        };
    }
    return { valid: true, message: '' };
}

/**
 * Shows validation error message below input field
 * @param {HTMLElement} inputElement - Input element that has error
 * @param {string} message - Error message to display
 */
function showFieldError(inputElement, message) {
    // Remove existing error message
    const existingError = inputElement.parentElement.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }

    // Add error class to input
    inputElement.classList.add('input-error');

    // Create and insert error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.textContent = message;
    errorDiv.setAttribute('role', 'alert');
    errorDiv.setAttribute('aria-live', 'polite');
    inputElement.parentElement.appendChild(errorDiv);
}

/**
 * Removes validation error from input field
 * @param {HTMLElement} inputElement - Input element to clear error from
 */
function clearFieldError(inputElement) {
    inputElement.classList.remove('input-error');
    const errorDiv = inputElement.parentElement.querySelector('.field-error');
    if (errorDiv) {
        errorDiv.remove();
    }
}

/**
 * Validates registration form before submission
 * @param {Event} event - Form submit event
 * @returns {boolean} - True if form is valid
 */
function validateRegisterForm(event) {
    event.preventDefault();
    
    const form = event.target;
    const submitBtn = form.querySelector("button[type='submit'], button:not([type])");
    const username = form.querySelector('#reg_username').value.trim();
    const email = form.querySelector('#reg_email').value.trim();
    const password = form.querySelector('#reg_password').value;
    
    let isValid = true;

    // Validate username
    const usernameValidation = validateUsername(username);
    if (!usernameValidation.valid) {
        showFieldError(form.querySelector('#reg_username'), usernameValidation.message);
        isValid = false;
    } else {
        clearFieldError(form.querySelector('#reg_username'));
    }

    // Validate email
    if (!isValidEmail(email)) {
        showFieldError(form.querySelector('#reg_email'), 'Format email tidak valid. Contoh: example@gmail.com');
        isValid = false;
    } else {
        clearFieldError(form.querySelector('#reg_email'));
    }

    // Validate password
    const passwordValidation = validatePassword(password);
    if (!passwordValidation.valid) {
        showFieldError(form.querySelector('#reg_password'), passwordValidation.message);
        isValid = false;
    } else {
        clearFieldError(form.querySelector('#reg_password'));
    }

    // If all validations pass, submit the form
    if (isValid) {
        form.submit();
    } else {
        // Re-enable submit button and restore text if transition script modified it
        if (submitBtn) {
            submitBtn.disabled = false;
            const original = submitBtn.dataset.originalText;
            if (original) {
                submitBtn.innerHTML = original;
            }
        }
        // Ensure page remains visible if any fade-out was triggered
        document.body.classList.remove('fade-out');
        document.body.classList.add('fade-in');
        document.body.style.opacity = '1';
    }

    return isValid;
}

/**
 * Sets up real-time validation for registration form fields
 */
function setupRegisterFormValidation() {
    const registerForm = document.getElementById('registerForm');
    if (!registerForm) return;

    const usernameInput = registerForm.querySelector('#reg_username');
    const emailInput = registerForm.querySelector('#reg_email');
    const passwordInput = registerForm.querySelector('#reg_password');

    // Real-time validation on blur
    if (usernameInput) {
        usernameInput.addEventListener('blur', function() {
            const value = this.value.trim();
            if (value) {
                const validation = validateUsername(value);
                if (!validation.valid) {
                    showFieldError(this, validation.message);
                } else {
                    clearFieldError(this);
                }
            }
        });
    }

    if (emailInput) {
        emailInput.addEventListener('blur', function() {
            const value = this.value.trim();
            if (value) {
                if (!isValidEmail(value)) {
                    showFieldError(this, 'Format email tidak valid');
                } else {
                    clearFieldError(this);
                }
            }
        });
    }

    if (passwordInput) {
        passwordInput.addEventListener('blur', function() {
            const value = this.value;
            if (value) {
                const validation = validatePassword(value);
                if (!validation.valid) {
                    showFieldError(this, validation.message);
                } else {
                    clearFieldError(this);
                }
            }
        });

        // Clear error on input
        passwordInput.addEventListener('input', function() {
            if (this.value.length >= 6) {
                clearFieldError(this);
            }
        });
    }

    // Form submission validation
    registerForm.addEventListener('submit', validateRegisterForm);
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    setupRegisterFormValidation();
});


