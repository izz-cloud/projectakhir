# Git Workflow & Commit Messages

Dokumen ini berisi panduan workflow Git dan contoh commit messages untuk project ini.

## 🌿 Branch Strategy

Untuk project sekolah ini, disarankan menggunakan workflow sederhana:

### Branch Utama
- `main` atau `master` - Branch production/stable

### Feature Branches
- `feature/nama-fitur` - Untuk development fitur baru
- `fix/nama-bug` - Untuk perbaikan bug
- `improvement/nama-peningkatan` - Untuk peningkatan kode

## 📝 Contoh Commit Messages

Berikut adalah contoh commit messages yang baik untuk setiap improvement yang telah dilakukan:

### 1. Functionality Enhancements

```
feat: add comprehensive form validation with real-time feedback

- Implement client-side validation for registration form
- Add email format, password strength, and username validation
- Create reusable validation functions in form-validation.js
- Display user-friendly error messages below input fields
```

```
feat: implement Fetch API for dynamic dashboard statistics

- Create API endpoint (api/get_stats.php) for dashboard stats
- Add loadDashboardStats() function with error handling
- Implement number animation for stat updates
- Add fallback for API failures
```

### 2. UX & UI Improvements

```
feat: enhance responsive design for mobile and tablet devices

- Add tablet breakpoint (768px) with optimized layouts
- Improve mobile layout (480px) with better spacing
- Enhance form inputs for touch-friendly interaction
- Optimize table display for small screens
```

```
feat: add accessibility features (ARIA attributes and semantic HTML)

- Add ARIA labels to all interactive elements
- Implement proper label associations for form inputs
- Add role attributes for better screen reader support
- Include aria-live regions for dynamic content
```

```
feat: implement smooth CSS animations and transitions

- Add fade-in animations for table rows
- Create slide-down animation for error messages
- Enhance hover effects on cards and buttons
- Add loading state animations
```

### 3. Code Quality & Structure

```
refactor: improve JavaScript code organization and readability

- Separate validation logic into form-validation.js module
- Create dashboard.js for dashboard-specific functionality
- Add comprehensive JSDoc comments to all functions
- Use meaningful variable and function names
```

```
docs: add inline comments explaining important logic

- Document validation functions with parameter descriptions
- Add comments for complex DOM manipulations
- Explain API integration and error handling
- Document accessibility implementations
```

### 4. Documentation

```
docs: create comprehensive README with project documentation

- Add project description and features list
- Document technology stack and project structure
- Include setup instructions and database configuration
- Add learning reflection and challenges section
```

### 5. Bug Fixes

```
fix: correct password toggle accessibility attributes

- Update aria-pressed attribute on password toggle
- Fix aria-label to reflect current state
- Ensure keyboard navigation works properly
```

```
fix: resolve form validation error message display

- Fix error message positioning in mobile view
- Correct z-index issues with error messages
- Ensure error messages are properly announced by screen readers
```

## 🔄 Workflow Example

Berikut adalah contoh workflow untuk menambahkan fitur baru:

```bash
# 1. Buat feature branch
git checkout -b feature/form-validation

# 2. Lakukan perubahan dan commit
git add auth-uks/form-validation.js
git commit -m "feat: add comprehensive form validation module"

git add auth-uks/register.php
git commit -m "feat: integrate form validation in registration page"

# 3. Merge ke main
git checkout main
git merge feature/form-validation

# 4. Push ke remote
git push origin main
```

## 📋 Commit Message Format

Format yang disarankan:

```
<type>: <subject>

<body (optional)>

<footer (optional)>
```

### Types:
- `feat`: Fitur baru
- `fix`: Perbaikan bug
- `docs`: Perubahan dokumentasi
- `style`: Perubahan formatting (tidak mempengaruhi kode)
- `refactor`: Refactoring kode
- `test`: Menambah atau memperbaiki tests
- `chore`: Perubahan build process atau tools

### Subject:
- Gunakan imperative mood ("add" bukan "added" atau "adds")
- Maksimal 50 karakter
- Jangan gunakan period di akhir

### Body:
- Jelaskan "what" dan "why" bukan "how"
- Wrap pada 72 karakter
- Gunakan bullet points jika perlu

## ✅ Best Practices

1. **Commit Sering**: Commit setiap logical change, jangan tunggu sampai banyak perubahan
2. **Commit Messages yang Jelas**: Jelaskan apa yang diubah dan mengapa
3. **One Feature Per Branch**: Satu branch untuk satu fitur/peningkatan
4. **Test Sebelum Commit**: Pastikan kode berfungsi sebelum commit
5. **Review Sebelum Merge**: Review perubahan sebelum merge ke main

## 🎯 Contoh Workflow Lengkap

```bash
# Setup awal
git init
git add .
git commit -m "docs: initial project setup with README"

# Development fitur
git checkout -b feature/accessibility
# ... lakukan perubahan ...
git add .
git commit -m "feat: add ARIA attributes for accessibility"
git commit -m "feat: implement semantic HTML structure"
git commit -m "docs: update README with accessibility section"

# Merge dan cleanup
git checkout main
git merge feature/accessibility
git branch -d feature/accessibility
git push origin main
```

---

**Note**: Untuk project sekolah, workflow sederhana sudah cukup. Fokus pada commit messages yang jelas dan deskriptif.


