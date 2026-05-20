<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Unauthorized</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            height: 100vh;
        }

        .error-container {
            height: 100vh;
        }

        .error-code {
            font-size: 7rem;
            font-weight: 700;
            color: #dc3545;
        }

        .error-text {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .error-description {
            color: #6c757d;
        }

        .btn-home {
            padding: 10px 24px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center align-items-center error-container text-center">

        <div class="col-md-6">
            
            <div class="error-code">
                403
            </div>

            <div class="error-text mb-3">
                Page Not Found
            </div>

            <p class="error-description mb-4">
                The page you are looking for does not exist or has been moved.
            </p>

            <a href="{{ url('/dashboard') }}" class="btn btn-danger btn-home">
                Back to Front Page
            </a>

        </div>

    </div>
</div>

</body>
</html>