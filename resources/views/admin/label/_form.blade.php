{{-- Group Pengirim --}}
<div class="form-group mb-4 p-4 bg-white shadow-sm rounded">
    <h5 class="mb-3">Informasi Pengirim</h5>
    <div class="form-group row">
        <label for="sender_name" class="col-sm-3 col-form-label">Nama Pengirim</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->sender->name)}}" type="text" name="sender_name" id="sender_name" class="form-control" placeholder="Masukkan nama pengirim" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="sender_street_address" class="col-sm-3 col-form-label">Alamat Pengirim</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->sender->street_address)}}" type="text" name="sender_street_address" id="sender_street_address" class="form-control" placeholder="Masukkan alamat jalan pengirim" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="sender_city" class="col-sm-3 col-form-label">Kota Pengirim</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->sender->city)}}" type="text" name="sender_city" id="sender_city" class="form-control" placeholder="Masukkan kota pengirim" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="sender_postal_code" class="col-sm-3 col-form-label">Kode Pos</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->sender->postal_code)}}" type="text" name="sender_postal_code" id="sender_postal_code" class="form-control" placeholder="Masukkan kode pos pengirim" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="sender_country" class="col-sm-3 col-form-label">Negara Pengirim</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->sender->country)}}" type="text" name="sender_country" id="sender_country" class="form-control" placeholder="Masukkan negara pengirim" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="sender_no_handphone" class="col-sm-3 col-form-label">Nomor Handphone Pengirim</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->sender->no_handphone)}}" type="text" name="sender_no_handphone" id="sender_no_handphone" class="form-control" placeholder="Masukkan nomor handphone pengirim" required>
        </div>
    </div>
</div>

{{-- Group Penerima --}}
<div class="form-group mb-4 p-4 bg-white shadow-sm rounded">
    <h5 class="mb-3">Informasi Penerima</h5>
    <div class="form-group row">
        <label for="receiver_name" class="col-sm-3 col-form-label">Nama Penerima</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->receiver->name)}}" type="text" name="receiver_name" id="receiver_name" class="form-control" placeholder="Masukkan nama penerima" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="receiver_street_address" class="col-sm-3 col-form-label">Alamat Penerima</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->receiver->street_address)}}" type="text" name="receiver_street_address" id="receiver_street_address" class="form-control" placeholder="Masukkan alamat jalan penerima" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="receiver_city" class="col-sm-3 col-form-label">Kota Penerima</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->receiver->city)}}" type="text" name="receiver_city" id="receiver_city" class="form-control" placeholder="Masukkan kota penerima" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="receiver_state" class="col-sm-3 col-form-label">Provinsi Penerima</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->receiver->state)}}" type="text" name="receiver_state" id="receiver_state" class="form-control" placeholder="Masukkan provinsi penerima" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="receiver_postal_code" class="col-sm-3 col-form-label">Kode Pos Penerima</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->receiver->postal_code)}}" type="text" name="receiver_postal_code" id="receiver_postal_code" class="form-control" placeholder="Masukkan kode pos penerima" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="receiver_country" class="col-sm-3 col-form-label">Negara Penerima</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->receiver->country)}}" type="text" name="receiver_country" id="receiver_country" class="form-control" placeholder="Masukkan negara penerima" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="receiver_no_handphone" class="col-sm-3 col-form-label">Nomor Handphone Penerima</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->receiver->no_handphone)}}" type="text" name="receiver_no_handphone" id="receiver_no_handphone" class="form-control" placeholder="Masukkan nomor handphone penerima" required>
        </div>
    </div>
</div>

{{-- Group Paket --}}
<div class="form-group mb-4 p-4 bg-white shadow-sm rounded">
    <h5 class="mb-3">Informasi Paket</h5>
    <div class="form-group row">
        <label for="type" class="col-sm-3 col-form-label">Tipe Paket</label>
        <div class="col-sm-9">
            <select name="type" id="type" class="form-control" required>
                <option value="">Pilih Tipe Paket</option>
                <option value="Elektronik" {{$shipment->type == 'Elektronik' ? 'selected': ''}}>Elektronik</option>
                <option value="Extra/Sensitive" {{$shipment->type == 'Extra/Sensitive' ? 'selected': ''}}>Extra/Sensitive</option>
                <option value="Komoditi Umum" {{$shipment->type == 'Komoditi Umum' ? 'selected': ''}}>Komoditi Umum</option>
                <option value="Kosmetik, Makanan atau Herbal" {{$shipment->type == 'Kosmetik, Makanan atau Herbal' ? 'selected': ''}}>Kosmetik, Makanan atau Herbal</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="package_description" class="col-sm-3 col-form-label">Deskripsi Paket</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->package_description)}}" name="package_description" id="package_description" class="form-control" placeholder="Masukkan deskripsi paket" required />
        </div>
    </div>
    <div class="form-group row">
        <label for="quantity" class="col-sm-3 col-form-label">Kuantitas</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->quantity)}}" type="number" name="quantity" id="quantity" class="form-control" placeholder="Masukkan jumlah barang" required min="1">
        </div>
    </div>
    <div class="form-group row">
        <label for="weight" class="col-sm-3 col-form-label">Berat Aktual (kg)</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->weight)}}" type="number" name="weight" id="weight" class="form-control" placeholder="Masukkan berat dalam kg" required min="0.1" step="0.01">
        </div>
    </div>
    <div class="form-group row">
        <label for="height" class="col-sm-3 col-form-label">Tinggi (cm)</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->height)}}" type="number" name="height" id="height" class="form-control dimension" placeholder="Masukkan tinggi paket" required min="0.1" step="0.01">
        </div>
    </div>
    <div class="form-group row">
        <label for="width" class="col-sm-3 col-form-label">Lebar (cm)</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->width)}}" type="number" name="width" id="width" class="form-control dimension" placeholder="Masukkan lebar paket" required min="0.1" step="0.01">
        </div>
    </div>
    <div class="form-group row">
        <label for="length" class="col-sm-3 col-form-label">Panjang (cm)</label>
        <div class="col-sm-9">
            <input value="{{old('', $shipment->length)}}" type="number" name="length" id="length" class="form-control dimension" placeholder="Masukkan panjang paket" required min="0.1" step="0.01">
        </div>
    </div>
    <div class="form-group row">
        <label for="volumetric" class="col-sm-3 col-form-label">Volumetric (kg)</label>
        <div class="col-sm-9">
            <input type="text" name="volumetric" id="volumetric" class="form-control" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="chargeable_weight" class="col-sm-3 col-form-label">Chargeable Weight (kg)</label>
        <div class="col-sm-9">
            <input type="text" name="chargeable_weight" id="chargeable_weight" class="form-control" readonly>
        </div>
    </div>
</div>