<?php

use App\Models\Menu;
use App\Models\Seat;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Factories\MenuFactory;
use Database\Factories\SeatFactory;


class ControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testFormTmptDuduk()
    {
        // Memanggil fungsi formTmptDuduk()
        $response = $this->get(route('tmptDuduk'));

        // Memastikan respons adalah sukses (status kode 200)
        $response->assertStatus(200);

        // Memastikan tampilan yang dikembalikan adalah 'v_testSeat'
        $response->assertViewIs('v_testSeat');

        // Mengambil data variabel 'seat' dari tampilan
        $seatData = $response->original->getData()['seat'];

        // Memeriksa apakah variabel 'seat' adalah instance dari Collection
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $seatData);

        // Memeriksa apakah setiap elemen dalam 'seatData' adalah instance dari Seat
        foreach ($seatData as $seat) {
            $this->assertInstanceOf(\App\Models\Seat::class, $seat);
        }
    }

    /* public function testSubmitTmptDudukWithValidData()
    {
        // Membuat data seat baru yang tersedia
        $seat = Seat::factory()->create(['is_available' => 1]);

        // Membuat data menu makanan dan minuman
        $makanan = Menu::factory()->count(5)->create([
            'jenis' => 'makanan',
            'harga' => '5000',
            'stok' => '20',
            'foto' => 'http://imageurl.com/saksk'
        ]);
        $minuman = Menu::factory()->count(5)->create([
            'jenis' => 'minuman',
            'harga' => '3000',
            'stok' => '25',
            'foto' => 'http://imageurl.com/ssada'
        ]);

        // Membuat instance Request dengan data valid
        $request = new Request([
            'waktu' => '08:00',
            'tempatDuduk' => $seat->nama,
        ]);

        // Melakukan request ke submitTmptDuduk()hm
        $response = $this->post('submitTmptDuduk', $request->all());

        // Memastikan respons adalah view testMenu
        $response->assertViewIs('testMenu');

        // Memastikan data menu dan variabel lainnya dikirim ke view
        $response->assertViewHasAll([
            'makanan' => $makanan,
            'minuman' => $minuman,
            'waktu' => '08:00',
            'tempatDuduk' => $seat->id,
            'nama_tempatDuduk' => $seat->nama,
        ]);

        // Membersihkan data setelah pengujian selesai
        $seat->delete();
        Menu::truncate();
    } */

    /* public function testUpdateStatusSeat()
    {
        
        // Membuat seat baru dengan status is_available = 1
        $seat = Seat::factory()->create(['is_available' => 1]);

        // Melakukan request ke metode updateStatusSeat()
        $response = $this->put(route('updateStatusSeat', ['seatId' => $seat->id]));

        // Memastikan respons adalah redirect
        $response->assertStatus(RedirectResponse::HTTP_FOUND);

        // Memastikan user diarahkan ke rute 'showTmptDuduk'
        $response->assertRedirect(route('showTmptDuduk'));

        // Memastikan pesan sesuai dengan seat yang diubah statusnya
        $response->assertSessionHas('pesan', "Mengganti Status Seat {$seat->nama} berhasil");

        // Memuat ulang data seat dari database
        $updatedSeat = Seat::find($seat->id);

        // Memastikan status seat telah diperbarui sesuai dengan logika yang diharapkan
        $expectedStatus = $seat->is_available ? 0 : 1;
        $this->assertEquals($expectedStatus, $updatedSeat->is_available);
    } */

    /* public function testAddMenu()
    {
        Storage::fake('public');

        $kategori = 'makanan';

        $formData = [
            'nama' => $this->faker->name,
            'harga' => 10000,
            'stok' => 10,
            'foto' => UploadedFile::fake()->image('menu.jpg'),
        ];

        $response = $this->post(route('addMenu', $kategori), $formData);

        $response->assertRedirect();

        if ($kategori == 'makanan') {
            $response->assertRedirect(route('showMakanan'));
        } else {
            $response->assertRedirect(route('showMinuman'));
        }

        $this->assertDatabaseHas('menus', [
            'nama' => $formData['nama'],
            'jenis' => $kategori,
            'harga' => $formData['harga'],
            'stok' => $formData['stok'],
            'foto' => $formData['foto']->getClientOriginalName(),
        ]);

        $this->assertFileExists(storage_path('img/' . $formData['foto']->getClientOriginalName()));
    } */

    /* public function testAdminSignInPost()
    {
        // Menyiapkan kondisi awal dengan membuat data admin dalam database
        $admin = Admin::create([
            'nama' => 'Admin',
            'email' => 'admin@example.com',
            'password' => md5('password123'),
            'telp' => '029391912',
            'alamat' => 'bandung',
        ]);

        // Membuat instansi Request
        $request = new Request();
        $request->merge([
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);

        // Melakukan request ke adminSignInPost()
        $response = $this->call('POST', 'admin/signIn', $request->all());

        // Memastikan status respons adalah redirect
        $this->assertEquals(302, $response->status());

        // Memastikan user diarahkan ke rute 'showOrder'
        $this->assertEquals(route('showOrder'), $response->headers->get('Location'));

        // Memastikan data sesi telah diatur dengan benar
        $this->assertEquals($admin->id, Session::get('id'));
        $this->assertEquals($admin->nama, Session::get('nama'));
        $this->assertEquals($admin->email, Session::get('email'));
        $this->assertEquals('admin', Session::get('level'));
        $this->assertTrue(Session::get('adminLogin'));

        // Membersihkan data admin setelah pengujian selesai
        $admin->delete();
    } */

    /* public function testAdminLogout()
    {

        // Memanggil metode adminLogout()
        $response = $this->call('GET', 'admin/logout');

        // Memastikan status respons adalah redirect
        $this->assertEquals(302, $response->status());

        // Memastikan user diarahkan ke rute 'adminSignIn'
        $this->assertEquals(route('adminSignIn'), $response->headers->get('Location'));

        // Memastikan session di-flash dan mengandung pesan 'Anda Telah Logout!'
        $this->assertTrue(Session::has('alertAdmin'));
        $this->assertEquals('Anda Telah Logout!', Session::get('alertAdmin'));
    } */
}
