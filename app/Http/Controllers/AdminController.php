<?php

namespace App\Http\Controllers;

// Jika AdminController Anda berada di App\Http\Controllers\Admin, sesuaikan namespace
namespace App\Http\Controllers\Admin; // Anggap ini namespace yang benar

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Hapus semua use statement yang tidak diperlukan jika tidak ada fungsi lain di controller ini
// use App\Models\User;
// use App\Models\Answer;
// use App\Models\Spirit;
// use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Semua logika pengambilan data di sini dihilangkan
        // Karena data akan di-hardcode di Blade

        return view('admin.dashboard'); // Hanya mengembalikan view tanpa compact()
    }
}