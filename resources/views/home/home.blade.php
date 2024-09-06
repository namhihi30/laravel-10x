
@if ($errors->any())
    <div class="alert alert-danger">
        Vui lòng kiểm tra dữ liệu
    </div>
@endif

<form action="/home" method="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>"><br>
    <input type="text" name="name" id="" placeholder="nhập name"> <br> <br>
    @error('name')
    <p style="color: red">{{ $message }}</p>
    @enderror
    <input type="number" name="price" id="" placeholder="nhập giá"><br><br>
    <input type="submit" value="Submit">
</form>
