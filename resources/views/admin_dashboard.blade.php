<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Support System</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f4f7fa; }
        .navbar { background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%); }
        .card { border: none; border-radius: 12px; }
        .table-responsive { border-radius: 12px; overflow: hidden; }
        .badge-priority { font-weight: 600; font-size: 11px; padding: 6px 12px; border-radius: 30px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark px-4 py-3 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
                <span>🛠️</span> Admin Control Panel
            </a>
            <form action="/logout" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light px-3 py-2" style="border-radius: 8px;">Sign Out</button>
            </form>
        </div>
    </nav>

    <div class="container py-5">
        <div class="mb-5">
            <h1 class="fw-bold" style="color: #1e293b;">Hello, Admin {{ Auth::user()->name }}!</h1>
            <p class="text-muted">Manage and resolve incoming customer support tickets.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 10px;">
                ✨ {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="p-4 border-bottom">
                    <h4 class="fw-bold m-0" style="color: #1e293b;">All Customer Tickets</h4>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Client Name</th>
                                <th>Ticket Details</th>
                                <th>Priority</th>
                                <th>Current Status</th>
                                <th class="pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Ticket::with(['user', 'category', 'priority'])->get() as $ticket)
                                <tr>
                                    <td class="ps-4 fw-bold text-muted">#{{ $ticket->id }}</td>
                                    <td class="fw-semibold">{{ $ticket->user->name ?? 'Unknown' }}</td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $ticket->title }}</div>
                                        <small class="text-muted">{{ $ticket->description }}</small>
                                    </td>
                                    <td>
                                        @php
                                            $prioName = $ticket->priority->name ?? 'Low';
                                            $prioColor = $prioName == 'High' ? '#ef4444' : ($prioName == 'Medium' ? '#f59e0b' : '#10b981');
                                            $prioBg = $prioName == 'High' ? '#fef2f2' : ($prioName == 'Medium' ? '#fffbeb' : '#ecfdf5');
                                        @endphp
                                        <span class="badge-priority" style="color: {{ $prioColor }}; background-color: {{ $prioBg }};">
                                            {{ $prioName }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $ticket->status == 'New' ? 'bg-primary' : ($ticket->status == 'Resolved' ? 'bg-success' : 'bg-warning') }} px-2.5 py-1.5" style="border-radius: 6px;">
                                            {{ $ticket->status }}
                                        </span>
                                    </td>
                                    <td class="pe-4">
                                        @if($ticket->status !== 'Resolved')
                                            <form action="/admin/tickets/{{ $ticket->id }}/resolve" method="POST" class="m-0">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success px-3 py-1.5 fw-semibold" style="border-radius: 6px;">
                                                    Mark Resolved ✓
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-success small fw-bold">Completed</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">No tickets available in the system.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>