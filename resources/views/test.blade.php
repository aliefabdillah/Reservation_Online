<form action="{{ route('check') }}" method="post">
    @csrf
    <input type="checkbox" name="menu[0]" value="1"/><input type="number" name="qty[]">
    <input type="checkbox" name="menu[1]" value="2"/><input type="number" name="qty[]">
    <input type="checkbox" name="menu[2]" value="3"/><input type="number" name="qty[]">
    <input type="checkbox" name="menu[3]" value="4"/><input type="number" name="qty[]">
    <input type="submit" value="submit">
</form>
