@extends('admin.layouts.app')

@section('title', trans('messages.Banners'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1>{{ trans('messages.Banners') }}</h1>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBannerModal">
                            <i class="ti ti-plus"></i> {{ trans('messages.Create') }}
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ trans('messages.ID') }}</th>
                                    <th>{{ trans('messages.Image') }}</th>
                                    <th>{{ trans('messages.Title Ar') }}</th>
                                    <th>{{ trans('messages.Title En') }}</th>
                                    <th>{{ trans('messages.Type') }}</th>
                                    <th>{{ trans('messages.Platform') }}</th>
                                    <th>{{ trans('messages.Placement') }}</th>
                                    <th>{{ trans('messages.Status') }}</th>
                                    <th>{{ trans('messages.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($banners as $banner)
                                    <tr>
                                        <td>{{ $banner->id }}</td>
                                        <td>
                                            @if($banner->image)
                                                <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner Image" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $banner->title_ar }}</td>
                                        <td>{{ $banner->title_en }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ ucfirst($banner->type) }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ ucfirst($banner->platform) }}</span>
                                        </td>
                                        <td>{{ $banner->placement ?? '-' }}</td>
                                        <td>
                                            <button class="btn btn-sm {{ $banner->status ? 'btn-success' : 'btn-secondary' }}"
                                                onclick="changeStatus({{ $banner->id }})">
                                                @if ($banner->status)
                                                    <i class="ti ti-check"></i>
                                                @else
                                                    <i class="ti ti-x"></i>
                                                @endif
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary me-1"
                                                onclick="editBanner({{ $banner->id }})"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editBannerModal">
                                                <i class="ti ti-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="deleteBanner({{ $banner->id }})">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center">{{ trans('messages.No data found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Banner Modal -->
    <div class="modal fade" id="createBannerModal" tabindex="-1" aria-labelledby="createBannerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBannerModalLabel">{{ trans('messages.Create Banner') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createBannerForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="create_title_ar" class="form-label">{{ trans('messages.Title Ar') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="create_title_ar" name="title_ar" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="create_title_en" class="form-label">{{ trans('messages.Title En') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="create_title_en" name="title_en" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="create_description_ar" class="form-label">{{ trans('messages.Description Ar') }}</label>
                                    <textarea class="form-control" id="create_description_ar" name="description_ar" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="create_description_en" class="form-label">{{ trans('messages.Description En') }}</label>
                                    <textarea class="form-control" id="create_description_en" name="description_en" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="create_type" class="form-label">{{ trans('messages.Type') }}</label>
                                    <select class="form-select" id="create_type" name="type">
                                        <option value="">{{ trans('messages.Select Type') }}</option>
                                        <option value="image">Image</option>
                                        <option value="video">Video</option>
                                        <option value="audio">Audio</option>
                                        <option value="file">File</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="create_platform" class="form-label">{{ trans('messages.Platform') }}</label>
                                    <select class="form-select" id="create_platform" name="platform">
                                        <option value="">{{ trans('messages.Select Platform') }}</option>
                                        <option value="web">Web</option>
                                        <option value="app">App</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="create_position" class="form-label">{{ trans('messages.Position') }}</label>
                                    <select class="form-select" id="create_position" name="position">
                                        <option value="">{{ trans('messages.Select Position') }}</option>
                                        <option value="home">Home</option>
                                        <option value="category">Category</option>
                                        <option value="product">Product</option>
                                        <option value="blog">Blog</option>
                                        <option value="shop">Shop</option>
                                        <option value="delivery_man">Delivery Man</option>
                                        <option value="order">Order</option>
                                        <option value="issues">Issues</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="create_placement" class="form-label">{{ trans('messages.Placement') }}</label>
                                    <select class="form-select" id="create_placement" name="placement">
                                        <option value="">{{ trans('messages.Select Placement') }}</option>
                                        <option value="up">Up</option>
                                        <option value="down">Down</option>
                                        <option value="middle">Middle</option>
                                        <option value="left">Left</option>
                                        <option value="right">Right</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="create_link" class="form-label">{{ trans('messages.Link') }}</label>
                                    <input type="url" class="form-control" id="create_link" name="link" placeholder="https://example.com">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="create_image" class="form-label">{{ trans('messages.Image') }}</label>
                                    <input type="file" class="form-control" id="create_image" name="image" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('messages.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('messages.Create') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Banner Modal -->
    <div class="modal fade" id="editBannerModal" tabindex="-1" aria-labelledby="editBannerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBannerModalLabel">{{ trans('messages.Edit Banner') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editBannerForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_banner_id" name="banner_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_title_ar" class="form-label">{{ trans('messages.Title Ar') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_title_ar" name="title_ar" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_title_en" class="form-label">{{ trans('messages.Title En') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_title_en" name="title_en" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_description_ar" class="form-label">{{ trans('messages.Description Ar') }}</label>
                                    <textarea class="form-control" id="edit_description_ar" name="description_ar" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_description_en" class="form-label">{{ trans('messages.Description En') }}</label>
                                    <textarea class="form-control" id="edit_description_en" name="description_en" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="edit_type" class="form-label">{{ trans('messages.Type') }}</label>
                                    <select class="form-select" id="edit_type" name="type">
                                        <option value="">{{ trans('messages.Select Type') }}</option>
                                        <option value="image">Image</option>
                                        <option value="video">Video</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="edit_platform" class="form-label">{{ trans('messages.Platform') }}</label>
                                    <select class="form-select" id="edit_platform" name="platform">
                                        <option value="">{{ trans('messages.Select Platform') }}</option>
                                        <option value="web">Web</option>
                                        <option value="app">App</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="edit_position" class="form-label">{{ trans('messages.Position') }}</label>
                                    <select class="form-select" id="edit_position" name="position">
                                        <option value="">{{ trans('messages.Select Position') }}</option>
                                        <option value="home">Home</option>
                                        <option value="category">Category</option>
                                        <option value="product">Product</option>
                                        <option value="blog">Blog</option>
                                        <option value="shop">Shop</option>
                                        <option value="delivery_man">Delivery Man</option>
                                        <option value="order">Order</option>
                                        <option value="issues">Issues</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_placement" class="form-label">{{ trans('messages.Placement') }}</label>
                                    <select class="form-select" id="edit_placement" name="placement">
                                        <option value="">{{ trans('messages.Select Placement') }}</option>
                                        <option value="up">Up</option>
                                        <option value="down">Down</option>
                                        <option value="middle">Middle</option>
                                        <option value="left">Left</option>
                                        <option value="right">Right</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_link" class="form-label">{{ trans('messages.Link') }}</label>
                                    <input type="url" class="form-control" id="edit_link" name="link" placeholder="https://example.com">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_image" class="form-label">{{ trans('messages.Image') }}</label>
                                    <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
                                    <div id="current_image_preview" class="mt-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('messages.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('messages.Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
$(document).ready(function() {
    // Create banner form submission
    $('#createBannerForm').on('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            url: '{{ route("admin.banners.store") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '{{ trans("messages.Success") }}',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#createBannerModal').modal('hide');
                        location.reload();
                    });
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors || {};
                let errorMessage = '';

                Object.keys(errors).forEach(function(key) {
                    errorMessage += errors[key][0] + '\n';
                });

                Swal.fire({
                    icon: 'error',
                    title: '{{ trans("messages.Error") }}',
                    text: errorMessage || xhr.responseJSON?.message || '{{ trans("messages.Something went wrong") }}'
                });
            }
        });
    });

    // Edit banner form submission
    $('#editBannerForm').on('submit', function(e) {
        e.preventDefault();

        const bannerId = $('#edit_banner_id').val();
        const formData = new FormData(this);

        $.ajax({
            url: '{{ route("admin.banners.update", ":id") }}'.replace(':id', bannerId),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '{{ trans("messages.Success") }}',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editBannerModal').modal('hide');
                        location.reload();
                    });
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors || {};
                let errorMessage = '';

                Object.keys(errors).forEach(function(key) {
                    errorMessage += errors[key][0] + '\n';
                });

                Swal.fire({
                    icon: 'error',
                    title: '{{ trans("messages.Error") }}',
                    text: errorMessage || xhr.responseJSON?.message || '{{ trans("messages.Something went wrong") }}'
                });
            }
        });
    });
});

// Edit banner function
function editBanner(bannerId) {
    $.ajax({
        url: '{{ route("admin.banners.edit", ":id") }}'.replace(':id', bannerId),
        type: 'GET',
        success: function(response) {
            const banner = response.banner;

            // Fill form fields
            $('#edit_banner_id').val(banner.id);
            $('#edit_title_ar').val(banner.title_ar);
            $('#edit_title_en').val(banner.title_en);
            $('#edit_description_ar').val(banner.description_ar);
            $('#edit_description_en').val(banner.description_en);
            $('#edit_type').val(banner.type);
            $('#edit_platform').val(banner.platform);
            $('#edit_position').val(banner.position);
            $('#edit_placement').val(banner.placement);
            $('#edit_link').val(banner.link);

            // Show current image if exists
            const imagePreview = $('#current_image_preview');
            if (banner.image) {
                imagePreview.html(`
                    <div class="mt-2">
                        <small class="text-muted">{{ trans("messages.Current Image") }}:</small><br>
                        <img src="{{ asset('storage/') }}/${banner.image}" alt="Current Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                    </div>
                `);
            } else {
                imagePreview.empty();
            }
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: '{{ trans("messages.Error") }}',
                text: '{{ trans("messages.Banner not found") }}'
            });
        }
    });
}

// Delete banner function
function deleteBanner(bannerId) {
    Swal.fire({
        title: '{{ trans("messages.Are you sure?") }}',
        text: '{{ trans("messages.You will not be able to recover this banner") }}',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '{{ trans("messages.Yes, delete it") }}',
        cancelButtonText: '{{ trans("messages.Cancel") }}'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("admin.banners.destroy", ":id") }}'.replace(':id', bannerId),
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '{{ trans("messages.Deleted") }}',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: '{{ trans("messages.Error") }}',
                        text: xhr.responseJSON?.message || '{{ trans("messages.Cannot delete this banner") }}'
                    });
                }
            });
        }
    });
}

// Change status function
function changeStatus(bannerId) {
    $.ajax({
        url: '{{ route("admin.banners.changeStatus", ":id") }}'.replace(':id', bannerId),
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                toastr.success(response.message);
                location.reload();
            }
        },
        error: function(xhr) {
            toastr.error(xhr.responseJSON?.message || '{{ trans("messages.Something went wrong") }}');
        }
    });
}
</script>
@endpush
