<?php
namespace App\Http\Controllers\Auth;
use App\Models\Pendaftar;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    $pendaftar = Pendaftar::create([
      'nomor_pendaftaran' => $nomorPendaftaran,
      'kode_akses' => Hash::make($kodeAksesPlain),
      'nama_lengkap' => $request->nama_lengkap,
      'tempat_lahir' => $request->tempat_lahir,
      'tanggal_lahir' => $request->tanggal_lahir,
      'jenis_kelamin' => $request->jenis_kelamin,
      'agama' => $request->agama,
      'alamat' => $request->alamat,
      'whatsapp' => $request->whatsapp,
      'email' => $request->email,
    ]);

    $token = JWTAuth::fromUser($pendaftar);

    return redirect()
      ->route('pendaftar.login.form')
      ->with(
        'success',
        "Akun berhasil dibuat. 
                Nomor Pendaftaran: $nomorPendaftaran 
                | Kode Akses: $kodeAksesPlain"
      );
  }

  public function login(Request $request)
  {
    Auth::guard('web')->logout();
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
    Auth::guard('web')->logout();
    Auth::guard('pendaftar')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('pendaftar.login.form');
  }



}
