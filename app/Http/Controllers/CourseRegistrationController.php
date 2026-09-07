<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseRegistrationController extends Controller
{
    /**
     * Daftar kelas
     */
    public function store(Request $request, Course $course)
    {
        $user = $request->user();

        // Pastikan hanya student yang bisa mendaftar
        if (!$user->isStudent()) {
            abort(403, 'Hanya student yang dapat mendaftar kelas.');
        }

        try {
            DB::transaction(function () use ($user, $course) {

                // Lock course agar pendaftaran bersamaan tidak
                // menyebabkan kuota melebihi batas.
                $course = Course::whereKey($course->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                // Cek apakah kelas masih aktif
                if (!$course->is_active) {
                    abort(422, 'Kelas ini sedang tidak aktif.');
                }

                // Cek kuota
                if ($course->registered_count >= $course->quota) {
                    abort(422, 'Maaf, kuota kelas ini sudah penuh.');
                }

                // Cek apakah student sudah pernah mendaftar
                $alreadyRegistered = CourseRegistration::where('user_id', $user->id)
                    ->where('course_id', $course->id)
                    ->exists();

                if ($alreadyRegistered) {
                    abort(422, 'Kamu sudah terdaftar di kelas ini.');
                }

                // Buat pendaftaran
                CourseRegistration::create([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                    'status' => 'registered',
                    'registered_at' => now(),
                ]);

                // Tambahkan jumlah peserta
                $course->increment('registered_count');
            });

        } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
            throw $e;
        }

        return redirect()
            ->route('student.courses')
            ->with('success', 'Berhasil mendaftar kelas!');
    }

    /**
     * Daftar kelas yang diikuti student
     */
    public function index(Request $request)
    {
        $registrations = $request->user()
            ->courseRegistrations()
            ->with('course')
            ->latest('registered_at')
            ->paginate(10);

        return view('student.courses', compact('registrations'));
    }

    /**
     * Membatalkan pendaftaran
     */
    public function cancel(Request $request, CourseRegistration $registration)
    {
        $user = $request->user();

        // Pastikan registration milik user yang sedang login
        if ($registration->user_id !== $user->id) {
            abort(403);
        }

        // Hanya pendaftaran aktif yang dapat dibatalkan
        if (!in_array($registration->status, ['registered', 'in_progress'])) {
            return back()->withErrors([
                'registration' => 'Pendaftaran ini tidak dapat dibatalkan.',
            ]);
        }

        DB::transaction(function () use ($registration) {

            $course = Course::whereKey($registration->course_id)
                ->lockForUpdate()
                ->first();

            if ($course) {
                $course->decrement('registered_count');

                if ($course->registered_count < 0) {
                    $course->update([
                        'registered_count' => 0,
                    ]);
                }
            }

            $registration->update([
                'status' => 'cancelled',
            ]);
        });

        return back()->with(
            'success',
            'Pendaftaran kelas berhasil dibatalkan.'
        );
    }
}