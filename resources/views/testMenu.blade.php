
<form action="{{ route('check') }}" method="POST">
    @csrf
    <input type="hidden" name="seat_id" value="{{$tempatDuduk}}"><br>
    <input type="hidden" name="waktu" value="{{$waktu}}"><br><p>Minimal Pesan 1 Item</p>
    @php($i = 0)
    <h2>Makanan</h2>
    @foreach ($makanan as $m)
        {{ $m->nama }} <br>
        {{ $m->harga }} <br>
        pesan <input type="checkbox" name="menu[{{$i++}}]" value="{{$m->id}}" onchange="checkbox(this)"><br>
        <input type="number" name="qty[]" style="display: none" onkeyup="noMinus(this)"><br>
    @endforeach
    <br><br>
    <h2>Minuman</h2>
    @foreach ($minuman as $m)
        {{ $m->nama }} <br>
        {{ $m->harga }} <br>

        pesan <input type="checkbox" name="menu[{{$i++}}]" value="{{$m->id}}" onchange="checkbox(this)"><br>
        <input type="number" name="qty[]" style="display: none" onkeydown="noMinus(this)"><br>
    @endforeach
    <input type="submit" value="Checkout" id="submit" disabled>
</form>

<script>
    function checkbox(element){
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
        if(checkedOne) document.getElementById("submit").disabled = false
        else document.getElementById("submit").disabled = true
        el = element.nextSibling.nextSibling.nextSibling;
        if(element.checked){
            el.style.display = "block"
            el.value = 1
        }
        else{
            el.style.display = "none"
            el.value = 0
        }
    }

    function noMinus(element){
        if(element.value < 1){
            element.value = 1
        }
    }
</script>
