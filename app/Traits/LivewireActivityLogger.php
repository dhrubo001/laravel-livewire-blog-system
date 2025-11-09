<?php

namespace App\Traits;

use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;

trait LivewireActivityLogger
{

    public function logActivity(?string $description = null): void
    {
        if (! Auth::check()) {
            return;
        }

        // Try to auto-detect caller method to build a sensible description
        if (is_null($description)) {
            $caller = null;
            $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3);

            // trace[1] is usually the immediate caller method
            if (isset($trace[1]['function'])) {
                $caller = $trace[1]['function'];
            }

            $component = get_class($this);
            $description = $component . ($caller ? "@{$caller}" : '');
        }

        try {
            UserActivity::create([
                'user_id'     => Auth::id(),
                'url'         => request()->fullUrl(),
                'method'      => 'LIVEWIRE',
                'ip_address'  => request()->ip(),
                'user_agent'  => request()->header('User-Agent'),
                'description' => $description,
            ]);
        } catch (\Throwable $e) {
            \Log::error('LivewireActivityLogger failed: ' . $e->getMessage());
        }
    }
}
