<!-- resources/views/times/create.blade.php -->
<form action="{{ route('times.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="times">Digite os nomes dos 8 times:</label>
        <input type="text" class="form-control" id="times" name="times[]" required>
        <input type="text" class="form-control" id="times" name="times[]" required>
        <input type="text" class="form-control" id="times" name="times[]" required>
        <input type="text" class="form-control" id="times" name="times[]" required>
        <input type="text" class="form-control" id="times" name="times[]" required>
        <input type="text" class="form-control" id="times" name="times[]" required>
        <input type="text" class="form-control" id="times" name="times[]" required>
        <input type="text" class="form-control" id="times" name="times[]" required>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar Times</button>
</form>
