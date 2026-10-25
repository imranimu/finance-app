<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name', 'Finance App') }}</title>
    <!-- Bootstrap 5 CSS (stable) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons for the camera placeholder -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'JetBrains Mono', monospace;
        }
        .logo {
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 20px;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .logo i {
            color: #10b981;
            font-size: 30px;
        }
        .logo-sub {
            display: block;
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 400;
        }
        .register-card {
            max-width: 500px;
            margin: 2rem auto;
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            border-top: 5px solid #10b981;
            border-radius: 20px;
        }
        .form-label {
            font-weight: 500;
        }
        .already-link {
            text-decoration: underline;
            text-underline-offset: 2px;
            color: #4b5563;
        }
        .already-link:hover {
            color: #111827;
        }
        .form-control:focus, .form-select:focus, .btn:focus {
            border-color: #a5b4fc;
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
        }
        .form-control[type="file"] {
            padding: 0.375rem 0.75rem;
        }

        /* ---------- Avatar preview styles ---------- */
        .avatar-preview-wrapper {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 0.5rem;
        }
        .avatar-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 2px dashed #cbd5e1;
            background-color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
            position: absolute;
            transition: border-color 0.2s ease;
            top: -15px;
            right: -25px;
        }
        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none; /* hidden until an image is loaded */
        }
        .avatar-preview img.is-visible {
            display: block;
        }
        .avatar-preview .placeholder-icon {
            font-size: 1.75rem;
            color: #94a3b8;
        }
        .avatar-preview.has-image {
            border-style: solid;
            border-color: #a5b4fc;
        }
        .avatar-preview.has-image .placeholder-icon {
            display: none;
        }
        .btn-primary{
            background-color: #10b981;
            border-color: #10b981;
        }
        .btn-primary:hover{
            background-color: #0f766e;
            border-color: #0f766e;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="logo">
            <i class="fas fa-chart-pie"></i>
            <div>
                Imran Pro
                <span class="logo-sub">Finance & Accounts</span>
            </div>
        </div>

        <div class="card register-card">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Avatar live preview script -->
    <script>
        (function () {
            const fileInput = document.getElementById('avatar');
            const previewWrapper = document.getElementById('avatarPreview');
            const previewImg = document.getElementById('avatarPreviewImg');

            fileInput.addEventListener('change', function (event) {
                const file = event.target.files && event.target.files[0];

                if (!file) {
                    // No file selected – reset to placeholder
                    resetPreview();
                    return;
                }

                // Only proceed for images
                if (!file.type.startsWith('image/')) {
                    resetPreview();
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.add('is-visible');
                    previewWrapper.classList.add('has-image');
                };

                reader.onerror = function () {
                    resetPreview();
                };

                reader.readAsDataURL(file);
            });

            function resetPreview() {
                previewImg.src = '';
                previewImg.classList.remove('is-visible');
                previewWrapper.classList.remove('has-image');
            }
        })();
    </script>
</body>
</html>
