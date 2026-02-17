<?php
namespace App\Http\Controllers\Auth;
use App\Models\Pendaftar;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class PendaftarAuthController extends Controller
{
  public function formLogin()
  {
    return view('auth.login-pendaftar');
  }

  public function formRegister()
  {
    return view('auth.register-pendaftar');
  }

  public function register(Request $request)
  {
    $request->validate([
      'nama_lengkap' => 'required',
      'tempat_lahir' => 'required',
      'tanggal_lahir' => 'required|date',
      'jenis_kelamin' => 'required|in:L,P',
      'agama' => 'required',
      'alamat' => 'required',
      'whatsapp' => 'required',
      'email' => 'required|email|unique:pendaftar,email',
    ]);

    $nomorPendaftaran = 'PMB-' . now()->format('Ymd') . rand(1000, 9999);
    $kodeAksesPlain = Str::random(8);

    $whatsapp = preg_replace('/[^0-9]/', '', $request->whatsapp);
    $whatsapp = preg_replace('/^62/', '0', $whatsapp);

    if (!str_starts_with($whatsapp, '0')) {
      $whatsapp = '0' . $whatsapp;
    }

    $pendaftar = Pendaftar::create([
      'nomor_pendaftaran' => $nomorPendaftaran,
      'kode_akses' => Hash::make($kodeAksesPlain),
      'nama_lengkap' => $request->nama_lengkap,
      'tempat_lahir' => $request->tempat_lahir,
      'tanggal_lahir' => $request->tanggal_lahir,
      'jenis_kelamin' => $request->jenis_kelamin,
      'agama' => $request->agama,
      'alamat' => $request->alamat,
      'whatsapp' => $whatsapp,
      'email' => $request->email,
    ]);

    $token = JWTAuth::fromUser($pendaftar);



    $tokenFonnte = config('services.fonnte.api_key');
    $urlFonnte = config('services.fonnte.url');

    $messageWA = "Halo *{$request->nama_lengkap}*,\n\n"
      . "Akun PMB Anda berhasil dibuat ✅\n\n"
      . "📌 Nomor Pendaftaran:\n{$nomorPendaftaran}\n\n"
      . "🔐 Kode Akses:\n{$kodeAksesPlain}\n\n"
      . "Gunakan data tersebut untuk login ke sistem.\n\n"
      . "⚠ Mohon pesan ini dibalas ya agar nomor tidak terblokir sistem.\n\n"
      . "Terima kasih.";

    $targetWA = preg_replace('/^0/', '62', $whatsapp);

    $response = Http::asForm()
      ->withHeaders([
        'Authorization' => $tokenFonnte
      ])
      ->post($urlFonnte, [
        'target' => $targetWA,
        'message' => $messageWA
      ]);

    if (!$response->successful()) {
      \Log::error('WA Register Gagal: ' . $response->body());
    }


        $messageWeb = <<<TEXT
    Akun berhasil dibuat.

    Nomor Pendaftaran: {$nomorPendaftaran}
    Kode Akses: {$kodeAksesPlain}
    TEXT;

    return redirect()
      ->route('pendaftar.login.form')
      ->with('success', $messageWeb);
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'nomor_pendaftaran' => 'required',
      'kode_akses' => 'required',
    ]);

    $pendaftar = Pendaftar::where('nomor_pendaftaran', $credentials['nomor_pendaftaran'])->first();

    if (!$pendaftar || !Hash::check($credentials['kode_akses'], $pendaftar->kode_akses)) {
      return back()->with('error', 'Nomor pendaftaran atau kode akses salah');
    }

    Auth::guard('pendaftar')->login($pendaftar);

    $request->session()->regenerate();

    return redirect()->route('mahasiswa.periode.index');
  }
  public function logout(Request $request)
  {
    Auth::guard('pendaftar')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('pendaftar.login.form');
  }



}
