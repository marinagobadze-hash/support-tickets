<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard - Support Tickets</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f4f7fa; }
        .navbar { background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); }
        .card { border: none; border-radius: 12px; transition: all 0.3s ease; }
        .card:hover { transform: translateY(-2px); }
        .form-control, .form-select { border-radius: 8px; padding: 10px 14px; border: 1px solid #e2e8f0; }
        .form-control:focus, .form-select:focus { box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15); border-color: #3b82f6; }
        .btn-primary { background-color: #3b82f6; border: none; border-radius: 8px; padding: 12px; font-weight: 600; }
        .btn-primary:hover { background-color: #2563eb; }
        .table-responsive { border-radius: 12px; overflow: hidden; }
        .table { margin-bottom: 0; }
        .table th { background-color: #f8fafc; color: #64748b; font-weight: 600; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; padding: 16px; }
        .table td { padding: 16px; color: #334155; }
        .badge-priority { font-weight: 600; font-size: 11px; padding: 6px 12px; border-radius: 30px; }
        .badge-status { font-weight: 600; font-size: 11px; padding: 6px 12px; border-radius: 6px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark px-4 py-3 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
                <span class="fs-4">🎫</span> Support Center
            </a>
            <form action="/logout" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light px-3 py-2" style="border-radius: 8px; font-weight: 500;">
                    Sign Out
                </button>
            </form>
        </div>
    </nav>

    <div class="container py-5">
        <div class="mb-5">
            <h1 class="fw-bold text-slate-800" style="color: #1e293b;">Welcome back, Marina!</h1>
            <p class="text-muted">Need assistance? Create a ticket and our team will get right on it.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm p-3 mb-4 d-flex align-items-center gap-2" style="border-radius: 10px; background-color: #ecfdf5; color: #065f46;">
                <span>✨</span> <span class="fw-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card shadow-sm p-2">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4" style="color: #1e293b;">Submit a Ticket</h4>
                        
                        <form action="/tickets" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">TICKET TITLE</label>
                                <input type="text" name="title" class="form-control" required placeholder="What's the main issue?">
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold">CATEGORY</label>
                                    <select name="category_id" class="form-select" required>
                                        <option value="1">Technical Issue (IT)</option>
                                        <option value="2">Billing / Payment</option>
                                        <option value="3">General Inquiry</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-bold">PRIORITY</label>
                                    <select name="priority_id" class="form-select" required>
                                        <option value="1">Low</option>
                                        <option value="2">Medium</option>
                                        <option value="3">High</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold">DETAILED DESCRIPTION</label>
                                <textarea name="description" class="form-control" rows="5" required placeholder="Describe the steps to reproduce the issue..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                Create Ticket <span>🚀</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-0 d-flex flex-column">
                        <div class="p-4 border-bottom">
                            <h4 class="fw-bold m-0" style="color: #1e293b;">Your Recent Tickets</h4>
                        </div>
                        
                        <div class="table-responsive flex-grow-1">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th class="ps-4">ID</th>
                                        <th>Ticket Details</th>
                                        <th>Priority</th>
                                        <th class="pe-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(\App\Models\Ticket::where('user_id', Auth::id())->get() as $ticket)
                                        <tr>
                                            <td class="ps-4 fw-bold text-muted">#{{ $ticket->id }}</td>
                                            <td>
                                                <div class="fw-semibold text-dark">{{ $ticket->title }}</div>
                                                <small class="text-muted">{{ $ticket->description }}</small>
                                            </td>
                                            <td>
                                                <span class="badge-priority" style="color: #10b981; background-color: #ecfdf5;">
                                                    {{ $ticket->priority_id == 3 ? 'High' : ($ticket->priority_id == 2 ? 'Medium' : 'Low') }}
                                                </span>
                                            </td>
                                            <td class="pe-4">
                                                <span class="badge-status bg-primary text-white">
                                                    {{ $ticket->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted">
                                                <div class="fs-2 mb-2">👋</div>
                                                <div class="fw-medium">No tickets found</div>
                                                <small>Any tickets you submit will appear here.</small>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>