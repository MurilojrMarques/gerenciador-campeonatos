<form action="{{ route('times.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="times">Digite os nomes dos 8 times:</label>
        <div class="team-inputs">
            <input type="text" class="form-control mb-2" id="times" name="times[]" placeholder="Time 1" required><br><br>
            <input type="text" class="form-control mb-2" id="times" name="times[]" placeholder="Time 2" required><br><br>
            <input type="text" class="form-control mb-2" id="times" name="times[]" placeholder="Time 3" required><br><br>
            <input type="text" class="form-control mb-2" id="times" name="times[]" placeholder="Time 4" required><br><br>
            <input type="text" class="form-control mb-2" id="times" name="times[]" placeholder="Time 5" required><br><br>
            <input type="text" class="form-control mb-2" id="times" name="times[]" placeholder="Time 6" required><br><br>
            <input type="text" class="form-control mb-2" id="times" name="times[]" placeholder="Time 7" required><br><br>
            <input type="text" class="form-control mb-2" id="times" name="times[]" placeholder="Time 8" required><br><br>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Cadastrar Times</button>
</form>
