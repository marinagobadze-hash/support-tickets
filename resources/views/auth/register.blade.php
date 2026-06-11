<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Support Ticket System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center style="min-height: 100vh;">

    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px; border-radius: 12px; margin-top: 100px;">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-primary">Create Account</h3>
            <p class="text-muted small">Join our Support Ticket System</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger py-2 small">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="/register" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-bold text-muted">FULL NAME</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Marina" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-muted">EMAIL ADDRESS</label>
                <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-muted">PASSWORD</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-muted">CONFIRM PASSWORD</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold py-2 mb-3" style="border-radius: 8px;">
                Sign Up
            </button>

            <div class="text-center small">
                <span class="text-muted">Already have an account?</span> 
                <a href="/login" class="fw-bold text-decoration-none">Sign In</a>
            </div>
        </form>
    </div>

</body>
</html>