<div class="form-group row">
    <label for="awb_number" class="col-sm-2 col-form-label">AWB</label>
    <div class="col-sm-10">
        <input type="text" name="awb_number" id="awb_number" class="form-control" placeholder="Enter AWB" value="{{ $tracking->awb_number }}" readonly>
    </div>
</div>
<div class="form-group row">
    <label for="status" class="col-sm-2 col-form-label">Status</label>
    <div class="col-sm-10">
        <select name="status" id="status" class="form-control" required>
            <option value="Barang di Kemas" {{ $tracking->status == 'Barang di Kemas' ? 'selected' : '' }}>Barang di Kemas</option>
            <option value="Sedang Dikirim" {{ $tracking->status == 'Sedang Dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
            <option value="Sampai di Lokasi" {{ $tracking->status == 'Sampai di Lokasi' ? 'selected' : '' }}>Sampai di Lokasi</option>
            <option value="Diterima" {{ $tracking->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="location" class="col-sm-2 col-form-label">Location</label>
    <div class="col-sm-10">
        <input type="text" name="location" id="location" class="form-control" placeholder="Enter location" value="" required>
        <small>Existing Locations:</small>
        <ul>
            @foreach(explode(',', $tracking->location) as $loc)
            <li>{{ $loc }}</li>
            @endforeach
        </ul>
    </div>
</div>