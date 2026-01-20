/**
 * Dashboard JavaScript Module
 * Handles search functionality and form validation for dashboard pages
 */

/**
 * Initializes search functionality for data tables
 * Filters table rows based on search input
 */
function initializeTableSearch() {
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');
    
    if (!searchInput || !tableBody) return;

    const rows = Array.from(tableBody.querySelectorAll('tr'));

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        // Filter rows based on search term
        rows.forEach(row => {
            const rowText = row.innerText.toLowerCase();
            const shouldShow = rowText.includes(searchTerm);
            row.style.display = shouldShow ? '' : 'none';
            
            // Add animation class for smooth transitions
            if (shouldShow) {
                row.classList.add('fade-in-row');
            }
        });

        // Show empty state if no results
        const visibleRows = rows.filter(row => row.style.display !== 'none');
        const emptyState = tableBody.querySelector('.empty-state');
        
        if (visibleRows.length === 0 && searchTerm && emptyState) {
            // Show no results message
            if (!tableBody.querySelector('.no-results')) {
                const noResults = document.createElement('tr');
                noResults.className = 'no-results';
                noResults.innerHTML = `
                    <td colspan="${rows[0]?.querySelectorAll('td').length || 5}" class="empty-state">
                        <strong>Tidak ada hasil</strong>
                        Tidak ada data yang cocok dengan pencarian "${searchTerm}"
                    </td>
                `;
                tableBody.appendChild(noResults);
            }
        } else {
            // Remove no results message
            const noResults = tableBody.querySelector('.no-results');
            if (noResults) {
                noResults.remove();
            }
        }
    });
}

/**
 * Validates complaint form before submission
 * @param {Event} event - Form submit event
 * @returns {boolean} - True if form is valid
 */
function validateComplaintForm(event) {
    const form = event.target;
    const namaSiswa = form.querySelector('#nama_siswa').value.trim();
    const kelas = form.querySelector('#kelas').value.trim();
    const keluhan = form.querySelector('#keluhan').value.trim();
    
    let isValid = true;

    // Validate student name (letters and spaces only)
    const namePattern = /^[A-Za-z\s]+$/;
    if (!namePattern.test(namaSiswa)) {
        alert('Nama siswa hanya boleh mengandung huruf dan spasi');
        form.querySelector('#nama_siswa').focus();
        isValid = false;
    }

    // Validate class format
    const classPattern = /^(X|XI|XII)\s[A-Z]{2,4}\s[1-9]$/;
    if (!classPattern.test(kelas)) {
        alert('Format kelas tidak valid. Contoh: X RPL 3, XI TKJ 2, XII DKV 1');
        form.querySelector('#kelas').focus();
        isValid = false;
    }

    // Validate complaint (minimum 10 characters)
    if (keluhan.length < 10) {
        alert('Keluhan harus minimal 10 karakter untuk memberikan informasi yang cukup');
        form.querySelector('#keluhan').focus();
        isValid = false;
    }

    return isValid;
}

/**
 * Sets up form validation for complaint submission form
 */
function setupComplaintFormValidation() {
    const complaintForm = document.querySelector('form[action="proses_pengajuan.php"]');
    if (!complaintForm) return;

    // Add real-time validation feedback
    const namaSiswaInput = complaintForm.querySelector('#nama_siswa');
    const kelasInput = complaintForm.querySelector('#kelas');
    const keluhanInput = complaintForm.querySelector('#keluhan');

    // Validate name on input
    if (namaSiswaInput) {
        namaSiswaInput.addEventListener('input', function() {
            const value = this.value.trim();
            if (value && !/^[A-Za-z\s]+$/.test(value)) {
                this.setCustomValidity('Nama hanya boleh huruf dan spasi');
            } else {
                this.setCustomValidity('');
            }
        });
    }

    // Validate class format on input
    if (kelasInput) {
        kelasInput.addEventListener('input', function() {
            const value = this.value.trim().toUpperCase();
            if (value && !/^(X|XI|XII)\s[A-Z]{2,4}\s[1-9]$/.test(value)) {
                this.setCustomValidity('Format: X RPL 3 / XI TKJ 2 / XII DKV 1');
            } else {
                this.setCustomValidity('');
            }
        });
    }

    // Validate complaint length
    if (keluhanInput) {
        keluhanInput.addEventListener('input', function() {
            const value = this.value.trim();
            if (value && value.length < 10) {
                this.setCustomValidity('Keluhan harus minimal 10 karakter');
            } else {
                this.setCustomValidity('');
            }
        });
    }

    // Form submission validation
    complaintForm.addEventListener('submit', function(event) {
        if (!validateComplaintForm(event)) {
            event.preventDefault();
        }
    });
}

/**
 * Loads dashboard statistics using Fetch API
 * Updates summary cards dynamically without page reload
 */
function loadDashboardStats() {
    const summaryCards = document.querySelectorAll('.summary-value');
    if (summaryCards.length === 0) return;

    // Show loading state
    summaryCards.forEach(card => {
        card.textContent = '...';
    });

    // Fetch statistics from API
    fetch('api/get_stats.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success && data.stats) {
                // Update summary cards with animation
                const cards = document.querySelectorAll('.summary-value');
                if (cards.length >= 3) {
                    // Animate number updates
                    animateValue(cards[0], 0, data.stats.total, 500);
                    animateValue(cards[1], 0, data.stats.pending, 500);
                    animateValue(cards[2], 0, data.stats.selesai, 500);
                }
            }
        })
        .catch(error => {
            console.error('Error loading stats:', error);
            // Fallback: keep existing values
            summaryCards.forEach(card => {
                if (card.textContent === '...') {
                    card.textContent = '0';
                }
            });
        });
}

/**
 * Animates a number from start to end value
 * @param {HTMLElement} element - Element to update
 * @param {number} start - Starting value
 * @param {number} end - Ending value
 * @param {number} duration - Animation duration in ms
 */
function animateValue(element, start, end, duration) {
    const range = end - start;
    const increment = range / (duration / 16); // 60fps
    let current = start;

    const timer = setInterval(() => {
        current += increment;
        if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
            current = end;
            clearInterval(timer);
        }
        element.textContent = Math.floor(current);
    }, 16);
}

/**
 * Initializes all dashboard functionality
 */
function initializeDashboard() {
    initializeTableSearch();
    setupComplaintFormValidation();
    
    // Load stats dynamically (optional - can be used for auto-refresh)
    // loadDashboardStats();
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', initializeDashboard);

