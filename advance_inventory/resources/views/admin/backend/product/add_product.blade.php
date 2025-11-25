@extends('admin.admin_master')
@section('admin')
<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('all.product') }}" class="btn btn-sm btn-primary">
                                    <i class="ri-arrow-left-line align-middle me-1"></i> Back to Products
                                </a>
                            </li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add New Product</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form action="{{ route('store.product') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Product Information</h4>
                            <p class="text-muted font-14 mb-3">Fill in the basic product information below.</p>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" 
                                           placeholder="Enter product name" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Product Code <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ri-barcode-line"></i></span>
                                        <input type="text" name="code" class="form-control" 
                                               placeholder="Enter product code" required>
                                    </div>
                                    @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select name="category_id" id="category_id" class="form-select" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Brand <span class="text-danger">*</span></label>
                                    <select name="brand_id" id="brand_id" class="form-select" required>
                                        <option value="">Select Brand</option>
                                        @foreach ($brands as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Price <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="price" class="form-control" 
                                               placeholder="0.00" step="0.01" min="0" required>
                                    </div>
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Stock Alert <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ri-alert-line"></i></span>
                                        <input type="number" name="stock_alert" class="form-control" 
                                               placeholder="Enter stock alert" min="0" required>
                                    </div>
                                    <small class="text-muted">Get notified when stock is low</small>
                                    @error('stock_alert')
                                        <span class="text-danger d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Product Description</label>
                                    <textarea class="form-control" name="note" rows="3" 
                                              placeholder="Enter product description or notes"></textarea>
                                    @error('note')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-lg-4">
                    <!-- Image Upload Card -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4 class="header-title">Product Images</h4>
                            <p class="text-muted font-14">Upload product images (Multiple allowed)</p>
                            
                            <div class="mb-3">
                                <input type="file" name="image[]" id="multiImg" class="form-control" 
                                       accept=".png, .jpg, .jpeg" multiple required>
                                <small class="text-muted d-block mt-1">Allowed JPG, JPEG, PNG. Max 5MB</small>
                                @error('image')
                                    <span class="text-danger d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="row g-2" id="preview_img"></div>
                        </div>
                    </div>

                    <!-- Inventory Card -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Inventory Details</h4>
                            
                            <div class="mb-3">
                                <label class="form-label">Warehouse <span class="text-danger">*</span></label>
                                <select name="warehouse_id" id="warehouse_id" class="form-select" required>
                                    <option value="">Select Warehouse</option>
                                    @foreach ($warehouses as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('warehouse_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Supplier <span class="text-danger">*</span></label>
                                <select name="supplier_id" id="supplier_id" class="form-select" required>
                                    <option value="">Select Supplier</option>
                                    @foreach ($suppliers as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Initial Stock <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ri-stack-line"></i></span>
                                    <input type="number" name="product_qty" class="form-control" 
                                           placeholder="Enter initial stock quantity" min="1" required>
                                </div>
                                @error('product_qty')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="Received" selected>Received</option>
                                    <option value="Pending">Pending</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="reset" class="btn btn-light me-2">
                            <i class="ri-close-line align-middle me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ri-save-line align-middle me-1"></i> Save Product
                        </button>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </form>
    </div> <!-- container -->
</div>

<!-- Image Preview Script -->
<script>
    document.getElementById('multiImg').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('preview_img');
        previewContainer.innerHTML = ''; // Clear previous previews

        const files = Array.from(event.target.files); // Convert FileList to Array
        const input = event.target;

        // Limit to 5 images
        const allowedFiles = files.slice(0, 5);
        if (files.length > 5) {
            alert('You can only upload up to 5 images. The first 5 will be selected.');
            // Update the file input
            const dataTransfer = new DataTransfer();
            allowedFiles.forEach(file => dataTransfer.items.add(file));
            input.files = dataTransfer.files;
        }

        allowedFiles.forEach((file, index) => {
            // Check if the file is an image
            if (file.type.match('image.*')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Create preview container
                    const col = document.createElement('div');
                    col.className = 'col-6 col-md-4 mb-2';

                    // Create image
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-fluid rounded border';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';
                    img.alt = 'Preview ' + (index + 1);

                    // Create remove button
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'btn btn-danger btn-sm position-absolute';
                    removeBtn.style.top = '5px';
                    removeBtn.style.right = '5px';
                    removeBtn.style.padding = '0.15rem 0.35rem';
                    removeBtn.innerHTML = '&times;';
                    removeBtn.title = 'Remove Image';

                    // Create wrapper for positioning
                    const wrapper = document.createElement('div');
                    wrapper.className = 'position-relative d-inline-block';
                    wrapper.style.width = '100%';
                    wrapper.appendChild(img);
                    wrapper.appendChild(removeBtn);

                    // Remove button functionality
                    removeBtn.addEventListener('click', function() {
                        // Remove from preview
                        col.remove();
                        
                        // Remove from file input
                        const newFiles = Array.from(input.files).filter((_, i) => i !== index);
                        const dataTransfer = new DataTransfer();
                        newFiles.forEach(f => dataTransfer.items.add(f));
                        input.files = dataTransfer.files;
                    });

                    col.appendChild(wrapper);
                    previewContainer.appendChild(col);
                };

                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection