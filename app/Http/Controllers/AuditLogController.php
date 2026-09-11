<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'tanggal_awal' => ['nullable', 'date'],
            'tanggal_akhir' => ['nullable', 'date', 'after_or_equal:tanggal_awal'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'action' => ['nullable', 'in:CREATE,UPDATE,DELETE,LOGIN,LOGOUT,EXPORT,PAYMENT'],
            'module' => ['nullable', 'string', 'max:80'],
            'search' => ['nullable', 'string', 'max:100'],
        ]);

        $logs = AuditLog::with('user')
            ->when($filters['tanggal_awal'] ?? null, fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
            ->when($filters['tanggal_akhir'] ?? null, fn ($query, $date) => $query->whereDate('created_at', '<=', $date))
            ->when($filters['user_id'] ?? null, fn ($query, $userId) => $query->where('user_id', $userId))
            ->when($filters['action'] ?? null, fn ($query, $action) => $query->where('action', $action))
            ->when($filters['module'] ?? null, fn ($query, $module) => $query->where('module', $module))
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('description', 'like', '%' . $search . '%')
                        ->orWhere('ip_address', 'like', '%' . $search . '%')
                        ->orWhereHas('user', fn ($userQuery) => $userQuery
                            ->where('name', 'like', '%' . $search . '%'));
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('audit-log.index', [
            'logs' => $logs,
            'users' => User::orderBy('name')->get(),
            'modules' => AuditLog::query()->distinct()->orderBy('module')->pluck('module'),
            'filters' => $filters,
        ]);
    }
}
