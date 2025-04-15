namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VaksinController extends Controller
{
    public function index()
    {
        $data = [
            [
                'id' => 1,
                'nama_vaksin' => 'Vaksin Covovax',
                'tanggal' => '2025-04-05',
                'dokter' => 'Dr. Argus',
                'pasien' => 'nopal',
                'alamat' => 'jakarta',
                'status' => 'Belum'
            ]
        ];

        return view('menu-vaksin', compact('data'));
    }
}
