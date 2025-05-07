@extends('layouts.layout.admin')

@section('content')
<div class="container-fluid mt-5">

    <h5>Add New Car</h5>

    <form action="{{ route('carcreate.store') }}" method="post" enctype="multipart/form-data" id="carForm">
        @csrf
        
        {{-- User Information Section --}}
        <div class="p-4 border rounded bg-light mb-4">
            <div class="row w-100 mb-3 text-light">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Car Details Section --}}
        <div class="p-4 border rounded bg-light mt-3">
            <div class="row w-100 mb-3">
                <div class="col-md-6">
                    <label for="carMake" class="form-label">Select Car Make</label>
                    <select id="carMake" class="form-select" name="make">
                        <option selected>Select Make Car</option>
                    </select>
                    @error('make')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <button type="button" id="addModelBtn" class="btn btn-link mt-2 p-0">+ Add Other Model</button>
                    <input type="text" id="customModelInput" name="custom_model" class="form-control mt-2 d-none" placeholder="Enter new model name">
                </div>

                <div class="col-md-6">
                    <label for="carModel" class="form-label">Select Car Model</label>
                    <select id="carModel" class="form-select" name="model">
                        <option selected>Select Car Model</option>
                    </select>
                    @error('model')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="year" class="form-label">Year</label>
                    <input type="text" class="form-control" id="year" name="year" placeholder="Year" value="{{ old('year') }}">
                    @error('year')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" class="form-control" id="color" name="color" placeholder="Color" value="{{ old('color') }}">
                    @error('color')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="carNo" class="form-label">Car No.</label>
                    <input type="text" class="form-control" id="carNo" name="car_no" placeholder="Car No." value="{{ old('car_no') }}">
                    @error('car_no')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="km" class="form-label">Km</label>
                    <input type="number" class="form-control" id="km" name="km" placeholder="Km" min="0" value="{{ old('km') }}">
                    @error('km')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

<div class="">
<h4>Add Before Image</h4>
<input type="file" name="car_images[]" class="form-control" multiple>

</div>
            </div>
        </div>

        {{-- Spare Parts Section --}}
        <div class="mt-5 bg-light border p-4 mb-5">
            <h2>Spare Parts</h2>

            <div id="sparePartForm">
                <div class="mb-3 row">
                    <label for="type" class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-3">
                        <select class="form-select" id="type" name="type">
                            <option selected>Spare parts</option>
                            <option value="description">Repair</option>
                        </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <label for="item" class="col-sm-2 col-form-label">Item</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="item" name="item" placeholder="Ex: item name">
                        @error('item')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}">
                    </div>
                    @error('quantity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label for="price" class="col-sm-2 col-form-label">Price per Part</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}">
                    </div>
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="button" id="addPartBtn" class="btn btn-primary">Add Part</button>
            </div>

            <hr>

            <table class="table table-striped mt-5" id="partsTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Type</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <div class="row mt-4">
                <div class="col-md-6">
                    <label for="netAmount">Net Amount</label>
                    <input type="text" id="netAmount" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label for="discount">Discount</label>
                    <input type="text" id="discount" class="form-control">
                </div>
            </div>
        </div>
        <input type="hidden" id="sparePartsJson" name="spare_parts_data">

        <button type="submit" class="btn btn-danger mt-2">Submit</button>
    </form>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const carMakeSelect = document.getElementById('carMake');
            const carModelSelect = document.getElementById('carModel');
            const customModelInput = document.getElementById('customModelInput');
            const addModelBtn = document.getElementById('addModelBtn');

            // Load car makes
            fetch('https://vpic.nhtsa.dot.gov/api/vehicles/GetMakesForVehicleType/car?format=json')
                .then(response => response.json())
                .then(data => {
                    const makes = data.Results;
                    carMakeSelect.innerHTML = '<option selected disabled>Select Make Car</option>';
                    makes.forEach(make => {
                        const option = document.createElement('option');
                        option.value = make.MakeName;
                        option.textContent = make.MakeName;
                        carMakeSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching car makes:', error));

            // Load car models when a make is selected
            carMakeSelect.addEventListener('change', function () {
                const selectedMake = this.value;
                carModelSelect.innerHTML = '<option selected disabled>Loading models...</option>';

                fetch(`https://vpic.nhtsa.dot.gov/api/vehicles/GetModelsForMake/${selectedMake}?format=json`)
                    .then(response => response.json())
                    .then(data => {
                        const models = data.Results;
                        carModelSelect.innerHTML = '<option selected disabled>Select Car Model</option>';
                        models.forEach(model => {
                            const option = document.createElement('option');
                            option.value = model.Model_Name;
                            option.textContent = model.Model_Name;
                            carModelSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching car models:', error);
                        carModelSelect.innerHTML = '<option selected disabled>Error loading models</option>';
                    });
            });

            addModelBtn.addEventListener('click', function () {
                addModelBtn.classList.add('d-none');
                customModelInput.classList.remove('d-none');

                customModelInput.addEventListener('blur', function () {
                    const newModel = customModelInput.value.trim();

                    if (newModel) {
                        const option = document.createElement('option');
                        option.value = newModel;
                        option.textContent = newModel;
                        carModelSelect.appendChild(option);
                        customModelInput.value = '';  
                        carModelSelect.value = newModel;
                    }
                });
            });
        });

        // Spare Parts script
document.getElementById('addPartBtn').addEventListener('click', function () {
    const type = document.getElementById('type').value;
    const item = document.getElementById('item').value.trim(); // إزالة الفراغات الزائدة
    const quantity = parseFloat(document.getElementById('quantity').value);
    const price = parseFloat(document.getElementById('price').value);

    // تحقق من أن الحقول المطلوبة ليست فارغة أو غير صالحة
    if (!item) {
        alert('The item field is required.');
        return; // إيقاف العملية إذا كان الحقل فارغًا
    }

    if (isNaN(quantity) || quantity <= 0) {
        alert('Please enter a valid quantity.');
        return;
    }

    if (isNaN(price) || price <= 0) {
        alert('Please enter a valid price.');
        return;
    }

    const totalPrice = price * quantity;

    const table = document.getElementById('partsTable').getElementsByTagName('tbody')[0];
    const newRow = table.insertRow();

    const cell1 = newRow.insertCell(0);
    const cell2 = newRow.insertCell(1);
    const cell3 = newRow.insertCell(2);
    const cell4 = newRow.insertCell(3);
    const cell5 = newRow.insertCell(4);
    const cell6 = newRow.insertCell(5);

    cell1.textContent = table.rows.length;
    cell2.textContent = type;
    cell3.textContent = item;
    cell4.textContent = quantity;
    cell5.textContent = totalPrice.toFixed(2);

    const removeButton = document.createElement('button');
    removeButton.textContent = 'Remove';
    removeButton.classList.add('btn', 'btn-danger');
    removeButton.addEventListener('click', function () {
        table.deleteRow(newRow.rowIndex - 1);
        updateNetAmount();
    });
    cell6.appendChild(removeButton);

    updateNetAmount();

    // إعادة تعيين الحقول بعد إضافة العنصر
    document.getElementById('type').value = 'Spare parts';
    document.getElementById('item').value = '';
    document.getElementById('quantity').value = '1';
    document.getElementById('price').value = '0';
    updateSparePartsJson();
});

        function updateNetAmount() {
            const table = document.getElementById('partsTable').getElementsByTagName('tbody')[0];
            let total = 0;

            for (let i = 0; i < table.rows.length; i++) {
                const priceCell = table.rows[i].cells[4].textContent;
                const priceValue = parseFloat(priceCell.replace(' QAR', '').trim());
                total += priceValue;
            }

            document.getElementById('netAmount').value = total.toFixed(2);
        }

  function updateSparePartsJson() {
    const table = document.getElementById('partsTable').getElementsByTagName('tbody')[0];
    let parts = [];
    const carId = document.getElementById('carMake').value; // أخذ car_id من الاختيار (اختيار الماركة أو النموذج)

    for (let i = 0; i < table.rows.length; i++) {
        const row = table.rows[i];
        parts.push({
            car_id: carId,  // إضافة car_id إلى الـ JSON
            type: row.cells[1].textContent,
            item: row.cells[2].textContent,
            quantity: row.cells[3].textContent,
            price: row.cells[4].textContent
        });
    }

    document.getElementById('sparePartsJson').value = JSON.stringify(parts);  // وضع الـ JSON في الحقل المخفي
}

        // Update JSON after discount changes
        document.getElementById('discount').addEventListener('input', function () {
            updateSparePartsJson();
        });

document.getElementById('carForm').addEventListener('submit', function (e) {
    // منع إرسال النموذج بشكل افتراضي
    e.preventDefault();

    // جمع البيانات من الجدول
    const table = document.getElementById('partsTable').getElementsByTagName('tbody')[0];
    let parts = [];

    // جلب كل صف في الجدول
    for (let i = 0; i < table.rows.length; i++) {
        const row = table.rows[i];
        parts.push({
            type: row.cells[1].textContent,
            item: row.cells[2].textContent,
            quantity: row.cells[3].textContent,
            price: row.cells[4].textContent
        });
    }

    // وضع البيانات في الحقل المخفي
    document.getElementById('sparePartsJson').value = JSON.stringify(parts);

    e.preventDefault();
        updateSparePartsJson();
    // بعد تحديث الحقل المخفي، يمكننا إرسال النموذج
    this.submit();
});



    </script>
    @endpush

</div>
@endsection

