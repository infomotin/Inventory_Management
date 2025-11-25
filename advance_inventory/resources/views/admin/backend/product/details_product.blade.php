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
                            <li class="breadcrumb-item"><a href="{{ route('all.product') }}" class="btn btn-sm btn-primary">
                                <i class="ri-arrow-left-line align-middle me-1"></i> Back to Products
                            </a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Product Details</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Product Images -->
                            <div class="col-lg-5">
                                <div class="border rounded p-3 mb-3">
                                    <h5 class="header-title mb-3">Product Gallery</h5>
                                    @if($product->images->count() > 0)
                                        <div class="row">
                                            @foreach($product->images as $image)
                                                <div class="col-md-4 col-6">
                                                    <div class="gallery-box">
                                                        <img src="{{ asset($image->image) }}" 
                                                             class="img-fluid rounded" 
                                                             alt="product-image"
                                                             style="height: 120px; width: 100%; object-fit: cover;">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="ri-image-line display-4 text-muted"></i>
                                            <p class="mt-2 mb-0">No images available</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="col-lg-7">
                                <div class="ps-xl-3">
                                    <h4 class="mb-3">{{ $product->name }} 
                                        <span class="badge bg-{{ $product->status === 'Active' ? 'success' : 'warning' }}">
                                            {{ $product->status }}
                                        </span>
                                    </h4>
                                    
                                    <div class="mt-3">
                                        <h5 class="text-primary">
                                            ${{ number_format($product->price, 2) }}
                                            @if($product->discount > 0)
                                                <small class="text-muted">
                                                    <del>${{ number_format($product->price + $product->discount, 2) }}</del>
                                                </small>
                                            @endif
                                        </h5>
                                    </div>

                                    <div class="mt-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <p class="text-muted mb-1">Product Code</p>
                                                    <h5 class="font-size-14">{{ $product->code ?? 'N/A' }}</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <p class="text-muted mb-1">Available Stock</p>
                                                    <h5 class="font-size-14">{{ $product->product_qty }} Units</h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <p class="text-muted mb-1">Category</p>
                                                    <h5 class="font-size-14">{{ $product->category->category_name ?? 'N/A' }}</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <p class="text-muted mb-1">Brand</p>
                                                    <h5 class="font-size-14">{{ $product->brand->name ?? 'N/A' }}</h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <p class="text-muted mb-1">Supplier</p>
                                                    <h5 class="font-size-14">{{ $product->supplier->name ?? 'N/A' }}</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <p class="text-muted mb-1">Warehouse</p>
                                                    <h5 class="font-size-14">{{ $product->warehouse->name ?? 'N/A' }}</h5>
                                                </div>
                                            </div>
                                        </div>

                                        @if($product->note)
                                            <div class="mb-3">
                                                <p class="text-muted mb-1">Notes</p>
                                                <p class="text-muted">{{ $product->note }}</p>
                                            </div>
                                        @endif

                                        <div class="mt-4">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a href="{{ route('edit.product', $product->id) }}" 
                                                       class="btn btn-warning waves-effect waves-light">
                                                        <i class="ri-edit-line align-middle me-2"></i> Edit Product
                                                    </a>
                                                </div>
                                                <div class="col-sm-6 text-sm-end mt-3 mt-sm-0">
                                                    <span class="text-muted d-block">Created: {{ \Carbon\Carbon::parse($product->created_at)->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="mt-4">
                            <div class="card">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#inventory-tab" role="tab">
                                                Inventory
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#activity-tab" role="tab">
                                                Activity
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="inventory-tab" role="tabpanel">
                                            <div class="table-responsive">
                                                <table class="table table-bordered mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Warehouse</th>
                                                            <th>Current Stock</th>
                                                            <th>Stock Alert</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $product->warehouse->name ?? 'N/A' }}</td>
                                                            <td>{{ $product->product_qty }} Units</td>
                                                            <td>
                                                                <span class="badge bg-{{ $product->product_qty <= $product->stock_alert ? 'danger' : 'success' }}">
                                                                    {{ $product->stock_alert }} Units
                                                                </span>
                                                            </td>
                                                            <td>
                                                                @if($product->status === 'Active')
                                                                    <span class="badge bg-success">Active</span>
                                                                @else
                                                                    <span class="badge bg-warning">Inactive</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="activity-tab" role="tabpanel">
                                            <div class="activity-feed">
                                                <div class="d-flex border-bottom pb-3 mb-3">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                                <i class="ri-add-line"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Product Created</h6>
                                                        <p class="text-muted mb-0">
                                                            {{ \Carbon\Carbon::parse($product->created_at)->format('M d, Y h:i A') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                @if($product->updated_at != $product->created_at)
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-xs">
                                                                <span class="avatar-title bg-soft-info text-info rounded-circle">
                                                                    <i class="ri-edit-line"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">Product Updated</h6>
                                                            <p class="text-muted mb-0">
                                                                {{ \Carbon\Carbon::parse($product->updated_at)->format('M d, Y h:i A') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container -->
</div>
@endsection
