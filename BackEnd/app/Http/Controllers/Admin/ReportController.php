<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HelpReport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $reports = HelpReport::query()
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->string('status')))
            ->when($request->filled('category'), fn ($q) => $q->where('category', $request->string('category')))
            ->when($request->filled('q'), function ($query) use ($request) {
                $q = $request->string('q');
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('booking_code', 'like', "%{$q}%")
                        ->orWhere('message', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'total' => HelpReport::count(),
            'pending' => HelpReport::where('status', 'pending')->count(),
            'in_progress' => HelpReport::where('status', 'in_progress')->count(),
            'resolved' => HelpReport::where('status', 'resolved')->count(),
        ];

        return view('pages.admin.reports.index', [
            'reports' => $reports,
            'stats' => $stats,
            'filters' => [
                'status' => $request->string('status'),
                'category' => $request->string('category'),
                'q' => $request->string('q'),
            ],
        ]);
    }

    public function show(HelpReport $report): View
    {
        return view('pages.admin.reports.show', [
            'report' => $report,
        ]);
    }

    public function update(Request $request, HelpReport $report): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,in_progress,resolved,closed'],
            'admin_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $report->update($validated);

        return redirect()->route('admin.reports.show', $report)
            ->with('status', 'Status laporan berhasil diperbarui.');
    }

    public function destroy(HelpReport $report): RedirectResponse
    {
        $report->delete();

        return redirect()->route('admin.reports.index')
            ->with('status', 'Laporan berhasil dihapus.');
    }
}
