<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Under Development</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }

        .under-development {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem;
        }

        .under-development h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .under-development p {
            font-size: 1.2rem;
            color: #6c757d;
        }

        .icon {
            font-size: 5rem;
            color: #0d6efd;
            margin-bottom: 1rem;
        }

        .agency-links {
            margin-top: 2rem;
        }

        .agency-links a {
            margin: 5px;
        }
    </style>
</head>

<body>
    <div class="under-development">
        <div class="icon">
            &#128679;
        </div>

        <h1>Website Under Development</h1>
        <p>We are working hard to get this page ready for you.<br>Check back soon!</p>

        <div class="agency-links">
            <h5 class="mt-4 mb-3">Admin Login</h5>

            <div class="d-flex flex-wrap justify-content-center">

                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Super Admin
                </a>

            </div>
        </div>

        <!-- Agency Login Row -->
        <div class="agency-links">
            <h5 class="mt-1 mb-1">Agency Login</h5>
            <span class="mb-4 fst-italic small text-muted">
                Agency Admin, Clients & Candidates login here
            </span>

            <div class="d-flex flex-wrap justify-content-center mt-3">
                @forelse($agencies as $agency)
                    <a href="http://{{ $agency->subdomain }}.lvh.me:8000/login" class="btn btn-outline-primary btn-sm">
                        {{ $agency->name }}
                    </a>
                @empty
                    <p class="text-muted">No agencies available.</p>
                @endforelse
            </div>
        </div>

        <a href="/" class="btn btn-primary btn-back mt-4">Go Back to Home</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
