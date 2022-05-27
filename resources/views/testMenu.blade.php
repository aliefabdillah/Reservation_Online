
<form action="{{ route('check') }}" method="POST">
    @csrf
    <input type="hidden" name="seat_id" value="{{$tempatDuduk}}">
    <input type="hidden" name="waktu" value="{{$waktu}}">
    @php($i = 0)
    @foreach ($makanan as $m)
        <input type="checkbox" name="menu[{{$i++}}]" value="{{$m->id}}">
        <input type="text" name="qty[]">
    @endforeach
    @foreach ($minuman as $m)
        <input type="checkbox" name="menu[{{$i++}}]" value="{{$m->id}}">
        <input type="text" name="qty[]">
    @endforeach
    <input type="submit" value="submit">
</form>
